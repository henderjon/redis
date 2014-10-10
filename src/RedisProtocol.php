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
	 * Constant line ending according to Redis protocol
	 */
	protected $DELIM = "\r\n";

	/**
	 * the chunk size (in bytes) to read out of the stream at a time
	 */
	protected $CHUNK = 1024;

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
		$response = [];
		for( $n = 0; $n < $count; $n++ ){

			$type  = fgetc($handle);
			$bytes = trim( fgets($handle) );

			switch( $type ){
				case( '-' ): //error
					throw new RedisException($bytes);
				break;
				case( '+' ): //single line
				case( ':' ): //integer
					$response[] = $bytes;
				break;
				case( '$' ): //bulk
					$response[] = $this->pull( $handle, $bytes );
				break;
				case( '*' ): //multi-bulk
					$response[] = $this->read( $handle, $bytes );
				break;
			}

		}
		return $response;
	}

	/**
	 * the open ended listener for the SUB of pub/sub
	 * @param Resource $handle The resouce, usually a socket connection
	 * @return array
	 */
	protected function sub( $handle ){

		// these values don't change and need to be read
		// out of the stream before we parse out the response
		$type  = fgetc($handle); // always "*"
		$bytes = trim( fgets($handle) ); // always 3

		return $this->read($handle, $bytes);
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
	 * Take a mixed number of strings and arrays, assuming that they are all
	 * relevant to ONE command and create a string that conforms to the Redis
	 * protocol
	 * @return string
	 */
	protected function protocol(){

		$args  = func_get_args();
		$iter1 = new \RecursiveArrayIterator($args);
		$iter2 = new \RecursiveIteratorIterator($iter1);
		$cmd   = "";
		$i     = 0;

		for($iter2->rewind(); $iter2->valid(); $iter2->next()){
			++$i;
			$cmd .= "$" . strlen($iter2->current());
			$cmd .= $this->DELIM;
			$cmd .= $iter2->current();
			$cmd .= $this->DELIM;
		}

		$command = sprintf("*%d%s%s", $i, $this->DELIM, $cmd);
		return $command;

	}

}


