<?php

namespace Redis\Traits;

use Redis\RedisException;

trait PubSubMethodsTrait {

	/**
	 * Listen for messages published to channels matching the given patterns
	 * pattern [pattern ...]
	 */
	function psubscribe(array $patterns) {
		if(count($patterns) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one pattern is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $patterns ) );
	}

	/**
	 * Inspect the state of the Pub/Sub subsystem
	 * subcommand [argument [argument ...]]
	 */
	function pubsubChannels(array $args = null) {
		return $this->exe( $this->protocol( "pubsub", "channels", $args ) );
		// CHANNELS, NUMSUB, NUMPAT
	}

	/**
	 * Inspect the state of the Pub/Sub subsystem
	 * subcommand [argument [argument ...]]
	 */
	function pubsubNumsub(array $args = null) {
		return $this->exe( $this->protocol( "pubsub", "numsub", $args ) );
		// CHANNELS, NUMSUB, NUMPAT
	}

	/**
	 * Inspect the state of the Pub/Sub subsystem
	 * subcommand [argument [argument ...]]
	 */
	function pubsubNumpat(array $args = null) {
		return $this->exe( $this->protocol( "pubsub", "numpat", $args ) );
		// CHANNELS, NUMSUB, NUMPAT
	}

	/**
	 * Post a message to a channel
	 * channel message
	 */
	function publish($chan, $message) {
		return $this->exe( $this->protocol( __FUNCTION__, $chan, $message ) );
	}

	/**
	 * Stop listening for messages posted to channels matching the given patterns
	 * [pattern [pattern ...]]
	 */
	function punsubscribe(array $patterns = null) {
		return $this->exe( $this->protocol( __FUNCTION__, $patterns ) );
	}

	/**
	 * Listen for messages published to the given channels
	 * channel [channel ...]
	 */
	function subscribe(array $channels) {
		if(count($channels) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one channel is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $channels ) );
	}

	/**
	 * Stop listening for messages posted to the given channels
	 * [channel [channel ...]]
	 */
	function unsubscribe(array $channels = null) {
		return $this->exe( $this->protocol( __FUNCTION__, $channels ) );
	}


}