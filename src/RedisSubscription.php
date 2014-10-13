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
	 * to avoid strings in checking response type
	 */
	const TYPE_SUBSCRIBE   = "subscribe";

	/**
	 * to avoid strings in checking response type
	 */
	const TYPE_UNSUBSCRIBE = "unsubscribe";

	/**
	 * to avoid strings in checking response type
	 */
	const TYPE_MESSAGE     = "message";

	/**
	 * subscribe to channel(s)
	 *
	 * @param array $channels An array of channels to subscribe to
	 * @param bool $pattern Whether to use a pattern (psubscribe)
	 * @return array
	 */
	function subscribe(array $channels, $pattern = false){

		$command = $this->protocol( ($pattern ? "psubscribe" : "subscribe"), $channels );
		$details = $this->exec( $command, count($channels) );

		// all returns: list($type, $channel, $message) = $details;
		return [$details, function(){
			return $this->sub($this->handle);
		}];
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