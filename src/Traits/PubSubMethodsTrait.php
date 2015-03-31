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
		return $this->exec( $this->protocol( __FUNCTION__, $patterns ) );
	}

	/**
	 * Inspect the state of the Pub/Sub subsystem
	 * subcommand [argument [argument ...]]
	 */
	function pubsubChannels(array $args = []) {
		return $this->exec( $this->protocol( "PUBSUB", "CHANNELS", $args ) );
		// CHANNELS, NUMSUB, NUMPAT
	}

	/**
	 * Inspect the state of the Pub/Sub subsystem
	 * subcommand [argument [argument ...]]
	 */
	function pubsubNumsub(array $args = []) {
		return $this->exec( $this->protocol( "PUBSUB", "NUMSUB", $args ) );
		// CHANNELS, NUMSUB, NUMPAT
	}

	/**
	 * Inspect the state of the Pub/Sub subsystem
	 * subcommand [argument [argument ...]]
	 */
	function pubsubNumpat(array $args = []) {
		return $this->exec( $this->protocol( "PUBSUB", "NUMPAT", $args ) );
		// CHANNELS, NUMSUB, NUMPAT
	}

	/**
	 * Post a message to a channel
	 * channel message
	 */
	function publish($chan, $message) {
		return $this->exec( $this->protocol( __FUNCTION__, $chan, $message ) );
	}

	/**
	 * Stop listening for messages posted to channels matching the given patterns
	 * [pattern [pattern ...]]
	 */
	function punsubscribe(array $patterns = []) {
		return $this->exec( $this->protocol( __FUNCTION__, $patterns ) );
	}

	/**
	 * Listen for messages published to the given channels
	 * channel [channel ...]
	 */
	function subscribe(array $channels) {
		if(count($channels) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one channel is required.");
		}
		return $this->exec( $this->protocol( __FUNCTION__, $channels ) );
	}

	/**
	 * Stop listening for messages posted to the given channels
	 * [channel [channel ...]]
	 */
	function unsubscribe(array $channels = []) {
		return $this->exec( $this->protocol( __FUNCTION__, $channels ) );
	}


}