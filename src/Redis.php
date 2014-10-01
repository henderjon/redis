<?php

namespace Redis;

/**
 * Class to talk to redis at a low level ... http://redis.io/topics/protocol
 */
class Redis {

	use Traits\RedisProtocolTrait;

	/***/
	private $handle;

	public  $db = 0;

	/**
	 * Connect to a Redis instance. This isn't in the constructor so
	 * that the tests can instantiate this object and replace the
	 * socket handle.
	 * @param string $ip The IP of the Redis instance
	 * @param string $port The port of the Redis instance
	 * @return
	 */
	function connect( $ip, $port ){
		$errno = $error = "";
		$sock = "tcp://{$ip}:{$port}";
		$this->handle = @stream_socket_client($sock, $errno, $error);

		if( !$this->handle || $errno ){
			throw new RedisException($error, $errno);
		}
	}

	/**
	 * Catch all calls to Redis functions and pass them to the underlying
	 * connection
	 * @param string $func The function name
	 * @param mixed $args The string(s) or array(s) of the arguments
	 * @return mixed
	 */
	function __call($func, $args){

		// track the current db ...
		if($func == strtolower("select")){
			$this->db = reset($args);
		}

		$command = $this->protocol( $func, $args );
		return $this->exec( $command, 1 );
	}

	/**
	 * Take an array of arrays of mixed string/arrays and pipe them all
	 * to Redis. Since Protocol::protocol takes strings and arrays and
	 * assumes that they're all one specific command, this funciton takes
	 * an array of those.
	 * @param mixed $args The string(s) or array(s) of the arguments
	 * @return mixed
	 */
	function pipe(){
		$args = func_get_args();

		if( count($args) == 1 ){
			$args = reset($args);
		}

		$commands = [];
		foreach($args as $arg){
			$commands[] = $this->protocol($arg);
		}

		$command = implode("\r\n", $commands). "\r\n";

		return $this->exec( $command, count($commands) );
	}

	/**
	 * Both __call() and pipe() do the filtering work of creating a single
	 * string of our command(s), this function simply writes and reads
	 * to our underlying connection
	 * @param string $string The command(s) in protocol format
	 * @param int $count The number of commands sent/expected responses
	 * @return mixed
	 */
	protected function exec( $string, $count ){

		// list( $count, $string ) = $this->protocol( $commands );
		$length   = $this->write( $this->handle, $string );
		$response = $this->read( $this->handle, $count );

		return count( $response ) == 1 ? reset( $response ) : $response;
	}

	/**
	 * method to take an indexed array and transform it to an associatvie array.
	 * @param $array The indexed array
	 * @return array
	 */
	function index2assoc( array $array ){
		$final = [];
		while( $key = array_shift( $array ) ){
			$final[ $key ] = array_shift( $array );
		}
		return $final;
	}

}