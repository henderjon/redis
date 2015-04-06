<?php

namespace Redis;
/**
 * use the Redis "subscribe" feature
 *
 * @package henderjon/redis
 * @author @henderjon
 */
class RedisSubscription extends RedisProtocol {

	/**
	 * subscribe to channel(s)
	 *
	 * @param array $channels An array of channels to subscribe to
	 * @return array
	 */
	public function subscribeTo(array $channels){

		$command = $this->protocol([ "subscribe", $channels ]);
		$details = $this->exe( $command, count($channels) );

		// all returns: list($type, $channel, $message) = $details;
		return [$details, function(){
			return $this->loop($this->handle);
		}];
	}

	/**
	 * subscribe to channel(s)
	 *
	 * @param array $channels An array of channels to subscribe to
	 * @return array
	 */
	public function pSubscribeTo(array $channels){

		$command = $this->protocol([ "psubscribe", $channels ]);
		$details = $this->exe( $command, count($channels) );

		return array($details, function(){
			return $this->loop($this->handle);
		});
	}

	/**
	 * set the socket timeout for quiet/long lived sub channels
	 * @param int $sec the number of whole seconds
	 * @param float $micro the number of micro seconds
	 * @return bool
	 */
	public function setTimeout($sec, $micro = 0){
		return stream_set_timeout($this->handle, $sec, $micro);
	}

	/**
	 * the open ended listener for the SUB of pub/sub
	 * @param Resource $handle The resouce, usually a socket connection
	 * @return array
	 */
	protected function loop( $handle ){

		// these values don't change and need to be read
		// out of the stream before we parse out the response
		$type  = fgetc($handle); // always "*"
		$bytes = trim( fgets($handle) ); // always 3

		return $this->read($handle, $bytes);
	}

}