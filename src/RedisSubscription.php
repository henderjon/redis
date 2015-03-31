<?php

namespace Redis;
/**
 * use the Redis "subscribe" feature
 *
 * @package henderjon/redis
 * @author @henderjon
 */
class RedisSubscription extends Redis {

	/**
	 * subscribe to channel(s)
	 *
	 * @param array $channels An array of channels to subscribe to
	 * @param bool $p Whether to use a pattern (psubscribe)
	 * @return array
	 */
	function subscribeTo(array $channels){

		$command = $this->protocol( "subscribe", $channels );
		$details = $this->exe( $command, count($channels) );

		// all returns: list($type, $channel, $message) = $details;
		return [$details, function(){
			return $this->sub($this->handle);
		}];
	}

	/**
	 * subscribe to channel(s)
	 *
	 * @param array $channels An array of channels to subscribe to
	 * @param bool $pattern Whether to use a pattern (psubscribe)
	 * @return array
	 */
	function pSubscribeTo(array $channels){

		$command = $this->protocol( "psubscribe", $channels );
		$details = $this->exe( $command, count($channels) );

		$that = $this;
		return array($details, function()use($that){
			return $that->sub($that->handle);
		});
	}

	/**
	 * set the socket timeout for quiet/long lived sub channels
	 * @param int $sec the number of whole seconds
	 * @param float $micro the number of micro seconds
	 * @return bool
	 */
	function setTimeout($sec, $micro = 0){
		return stream_set_timeout($this->handle, $sec, $micro);
	}

}