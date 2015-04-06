<?php

namespace Redis\Traits;

use Redis\RedisException;

trait PubSubMethodsTrait {

	abstract protected function protocol(array $args);
	abstract protected function exe($string, $count = 1);

	/**
	 * Listen for messages published to channels matching the given patterns
	 * for complete documentation: http://redis.io/commands#pubsub
	 * pattern [pattern ...]
	 */
	public function psubscribe(array $patterns) {
		if(count($patterns) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one pattern is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $patterns ]) );
	}

	/**
	 * Inspect the state of the Pub/Sub subsystem
	 * for complete documentation: http://redis.io/commands#pubsub
	 * subcommand [argument [argument ...]]
	 */
	public function pubsubChannels(array $args = null) {
		return $this->exe( $this->protocol([ "pubsub", "channels", $args ]) );
		// CHANNELS, NUMSUB, NUMPAT
	}

	/**
	 * Inspect the state of the Pub/Sub subsystem
	 * for complete documentation: http://redis.io/commands#pubsub
	 * subcommand [argument [argument ...]]
	 */
	public function pubsubNumsub(array $args = null) {
		return $this->exe( $this->protocol([ "pubsub", "numsub", $args ]) );
		// CHANNELS, NUMSUB, NUMPAT
	}

	/**
	 * Inspect the state of the Pub/Sub subsystem
	 * for complete documentation: http://redis.io/commands#pubsub
	 * subcommand [argument [argument ...]]
	 */
	public function pubsubNumpat(array $args = null) {
		return $this->exe( $this->protocol([ "pubsub", "numpat", $args ]) );
		// CHANNELS, NUMSUB, NUMPAT
	}

	/**
	 * Post a message to a channel
	 * for complete documentation: http://redis.io/commands#pubsub
	 * channel message
	 */
	public function publish($chan, $message) {
		return $this->exe( $this->protocol([ __FUNCTION__, $chan, $message ]) );
	}

	/**
	 * Stop listening for messages posted to channels matching the given patterns
	 * for complete documentation: http://redis.io/commands#pubsub
	 * [pattern [pattern ...]]
	 */
	public function punsubscribe(array $patterns = null) {
		return $this->exe( $this->protocol([ __FUNCTION__, $patterns ]) );
	}

	/**
	 * Listen for messages published to the given channels
	 * for complete documentation: http://redis.io/commands#pubsub
	 * channel [channel ...]
	 */
	public function subscribe(array $channels) {
		if(count($channels) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one channel is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $channels ]) );
	}

	/**
	 * Stop listening for messages posted to the given channels
	 * for complete documentation: http://redis.io/commands#pubsub
	 * [channel [channel ...]]
	 */
	public function unsubscribe(array $channels = null) {
		return $this->exe( $this->protocol([ __FUNCTION__, $channels ]) );
	}


}
