<?php

namespace Redis;

/**
 * Class to talk to redis at a low level ... http://redis.io/topics/protocol
 *
 * @package henderjon/redis
 * @author @henderjon
 */
class RedisProtocol {


	/**
	 * the socket handle
	 */
	protected $handle;

	/**
	 * the db to use
	 */
	public $db = 0;

	/**
	 * Constant line ending according to Redis protocol
	 */
	protected $DELIM = "\r\n";

	/**
	 * the chunk size (in bytes) to read out of the stream at a time
	 */
	protected $CHUNK = 1024;

	/**
	 * a string representing the last successful connection string
	 */
	protected $sock;

	/**
	 * a string representing the last timeout used
	 */
	protected $timeout;

	/**
	 * Connect to a Redis instance. This isn't in the constructor so
	 * that the tests can instantiate this object and replace the
	 * socket handle.
	 * @param string $ip The IP of the Redis instance
	 * @param string $port The port of the Redis instance
	 * @param int $timeout The number of seconds to wait when connecting
	 * @return Redis
	 */
	public function connect( $ip, $port, $timeout = 0 ){
		$errno = $error = null;
		$sock = "tcp://{$ip}:{$port}";
		$timeout = $timeout ?: ini_get("default_socket_timeout");
		$this->handle = @stream_socket_client($sock, $errno, $error, $timeout);

		if( !$this->handle || $errno ){
			throw new RedisException($error, $errno);
		}

		$this->sock = $sock;
		$this->timeout = $timeout;

		return $this;
	}

	/**
	 * Reconnect to a Redis instance. Use the last known socket and timeout values
	 * and it accepts a callback to re-do bootstrapping that might have been lost
	 * @param callable $setup A function that takes this instance as an arg
	 * @return Redis
	 */
	public function reconnect(callable $setup = null){
		$errno = $error = null;
		$this->handle = @stream_socket_client($this->sock, $errno, $error, $this->timeout);

		if( !$this->handle || $errno ){
			throw new RedisException($error, $errno);
		}

		if(is_callable($setup)){
			call_user_func($setup, $this);
		}

		return $this;
	}

	/**
	 * Catch all calls to Redis functions and pass them to the underlying
	 * connection
	 * @param string $func The function name
	 * @param mixed $args The string(s) or array(s) of the arguments
	 * @return mixed
	 */
	public function __call($func, $args){

		// track the current db ...
		if($func == strtolower("select")){
			$this->db = reset($args);
		}

		$command = $this->protocol([$func, $args]);
		return $this->exe( $command, 1 );
	}

	/**
	 * Take an array of arrays of mixed string/arrays and pipe them all
	 * to Redis. Since Protocol::protocol takes strings and arrays and
	 * assumes that they're all one specific command, this funciton takes
	 * an array of those.
	 * @return mixed
	 */
	public function pipe(){
		$args = func_get_args();

		if( count($args) == 1 ){
			$args = reset($args);
		}

		$commands = array();
		foreach($args as $arg){
			$commands[] = $this->protocol([$arg]);
		}

		$command = implode("\r\n", $commands). "\r\n";

		return $this->exe( $command, count($commands) );
	}

	/**
	 * method to take an indexed array and transform it to an associatvie array.
	 * @param $array The indexed array
	 * @return array
	 */
	public function marshal( array $array ){
		$final = array();

		while( $key = array_shift( $array ) ){
			$final[ $key ] = array_shift( $array );
		}
		return $final;
	}

	/**
	 * method to take an associatvie array and transform it to an indexed array.
	 * @param $array The indexed array
	 * @return array
	 */
	public function unmarshal( array $array ){
		$final = [];
		foreach($array as $k => $v){
			$final[] = $k;
			$final[] = $v;
		}
		return $final;
	}

	/**
	 * Both __call() and pipe() do the filtering work of creating a single
	 * string of our command(s), this function simply writes and reads
	 * to our underlying connection
	 * @param string $string The command(s) in protocol format
	 * @param int $count The number of commands sent/expected responses
	 * @return mixed
	 */
	protected function exe( $string, $count = 1 ){

		$length   = $this->write( $this->handle, $string );
		$response = $this->read( $this->handle, $count );

		return count( $response ) == 1 ? reset( $response ) : $response;
	}

	/**
	 * Write a string to the handle
	 * @param Resource $handle The resouce, usually a socket connection
	 * @param string $str The string to write
	 * @return int
	 */
	protected function write( $handle, $str ){
		$write = fwrite( $handle, $str );
		return strlen( $str );
	}

	/**
	 * Read/Parse a given number of responses out of the given handle
	 * @param Resource $handle The resouce, usually a socket connection
	 * @param int $count The number of responses to read
	 * @return array
	 */
	protected function read( $handle, $count ){
		$response = array();
		for( $n = 0; $n < $count; $n++ ){

			$type  = fgetc($handle);
			$bytes = trim( fgets($handle) );

			switch( $type ){
				case ('-'): //error
					throw new RedisException($bytes);
					// break;
				case ('+'): //single line
				case (':'): //integer
					$response[] = $bytes;
				break;
				case ('$'): //bulk
					$response[] = $this->pull( $handle, $bytes );
				break;
				case ('*'): //multi-bulk
					$response[] = $this->read( $handle, $bytes );
				break;
				default:
					throw new RedisProtocolException("unknown type character: {$type}");
				break;
			}

		}
		return $response;
	}

	/**
	 * Read a specific number of bytes out of the handle
	 * @param Resource $handle The resouce, usually a socket connection
	 * @param int $size The number of bytes to read
	 * @return string
	 */
	protected function pull( $handle, $size ){

		if($size == '-1') return null;

		$response = "";

		while( $size ){
			$chunk = $size > $this->CHUNK ? $this->CHUNK : $size;
			$response .= fread( $handle, $chunk );
			$size -= $chunk;
		}

		fread( $handle, 2 );
		return $response;

	}

	/**
	 * Take an array of mixed strings and arrays, assuming that they are all
	 * relevant to ONE command and create a string that conforms to the Redis
	 * protocol
	 * @return string
	 */
	protected function protocol(array $args){

		$iter1 = new \RecursiveArrayIterator($args);
		$iter2 = new \RecursiveIteratorIterator($iter1);
		$cmd   = "";
		$i     = 0;

		for($iter2->rewind(); $iter2->valid(); $iter2->next()){
			if(is_null($iter2->current())){ continue; }

			++$i;
			$cmd .= "$" . strlen($iter2->current());
			$cmd .= $this->DELIM;
			$cmd .= $iter2->current();
			$cmd .= $this->DELIM;
		}

		$command = sprintf("*%d%s%s", $i, $this->DELIM, $cmd);
		return $command;

	}

	/**
	 * Close the socket when we fall out of scope.
	 */
	function __destruct() {
		if(is_resource($this->handle)) {
			@fclose($this->handle);
		}
	}

}


