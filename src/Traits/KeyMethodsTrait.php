<?php

namespace Redis\Traits;

use Redis\RedisException;

trait KeyMethodsTrait {

	abstract protected function protocol(array $args);
	abstract protected function exe($string, $count = 1);

	/**
	 * Delete a key
	 * for complete documentation: http://redis.io/commands#generic
	 * key [key ...]
	 */
	public function del(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $keys ]) );
	}

	/**
	 * Return a serialized version of the value stored at the specified key.
	 * for complete documentation: http://redis.io/commands#generic
	 * key
	 */
	public function dump($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Determine if a key exists
	 * for complete documentation: http://redis.io/commands#generic
	 * key
	 */
	public function exists($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Set a key's time to live in seconds
	 * for complete documentation: http://redis.io/commands#generic
	 * key seconds
	 */
	public function expire($key, $seconds) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $seconds ]) );
	}

	/**
	 * Set the expiration for a key as a UNIX timestamp
	 * for complete documentation: http://redis.io/commands#generic
	 * key timestamp
	 */
	public function expireat($key, $timestamp) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $timestamp ]) );
	}

	/**
	 * Find all keys matching the given pattern
	 * for complete documentation: http://redis.io/commands#generic
	 * pattern
	 */
	public function keys($pattern) {
		return $this->exe( $this->protocol([ __FUNCTION__, $pattern ]) );
	}

	/**
	 * Atomically transfer a key from a Redis instance to another one.
	 * for complete documentation: http://redis.io/commands#generic
	 * host port key destination-db timeout [COPY] [REPLACE]
	 */
	public function migrate($host, $port, $key, $dest, $timeout) {
		return $this->exe( $this->protocol([ __FUNCTION__, $host, $port, $key, $dest, $timeout ]) );
	}

	/**
	 * Move a key to another database
	 * for complete documentation: http://redis.io/commands#generic
	 * key db
	 */
	public function move($key, $db) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $db ]) );
	}

	/**
	 * Inspect the internals of Redis objects
	 * for complete documentation: http://redis.io/commands#generic
	 * returns the number of references of the value associated with the specified key. This command is mainly useful for debugging.
	 * subcommand [arguments [arguments ...]]
	 */
	public function objectRefcount($keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol([ "object", "refcount", $keys ]) );
	}

	/**
	 * Inspect the internals of Redis objects
	 * for complete documentation: http://redis.io/commands#generic
	 * returns the kind of internal representation used in order to store the value associated with a key.
	 * subcommand [arguments [arguments ...]]
	 */
	public function objectEncoding($keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol([ "object", "encoding", $keys ]) );
	}

	/**
	 * Inspect the internals of Redis objects
	 * for complete documentation: http://redis.io/commands#generic
	 * returns the number of seconds since the object stored at the specified key is idle (not requested by read or write operations).
	 * While the value is returned in seconds the actual resolution of this timer is 10 seconds, but may vary in future implementations.
	 * subcommand [arguments [arguments ...]]
	 */
	public function objectIdletime($keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol([ "object", "idletime", $keys ]) );
	}

	/**
	 * Remove the expiration from a key
	 * for complete documentation: http://redis.io/commands#generic
	 * key
	 */
	public function persist($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Set a key's time to live in milliseconds
	 * for complete documentation: http://redis.io/commands#generic
	 * key milliseconds
	 */
	public function pexpire($key, $milliseconds) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $milliseconds ]) );
	}

	/**
	 * Set the expiration for a key as a UNIX timestamp specified in milliseconds
	 * for complete documentation: http://redis.io/commands#generic
	 * key milliseconds-timestamp
	 */
	public function pexpireat($key, $timestamp) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $timestamp ]) );
	}

	/**
	 * Get the time to live for a key in milliseconds
	 * for complete documentation: http://redis.io/commands#generic
	 * key
	 */
	public function pttl($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Return a random key from the keyspace
	 * for complete documentation: http://redis.io/commands#generic
	 */
	public function randomkey() {
		return $this->exe( $this->protocol([ __FUNCTION__ ]) );
	}

	/**
	 * Rename a key
	 * for complete documentation: http://redis.io/commands#generic
	 * key newkey
	 */
	public function rename($key, $newKey) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $newKey ]) );
	}

	/**
	 * Rename a key, only if the new key does not exist
	 * for complete documentation: http://redis.io/commands#generic
	 * key newkey
	 */
	public function renamenx($key, $newKey) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $newKey ]) );
	}

	/**
	 * Create a key using the provided serialized value, previously obtained using DUMP.
	 * for complete documentation: http://redis.io/commands#generic
	 * key ttl serialized-value [REPLACE]
	 */
	public function restore($key, $ttl, $serialValue, $replace = true) {
		$replace = $replace ? "replace" : null;
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $ttl, $serialValue, $replace ]) );
	}

	/**
	 * Sort the elements in a list, set or sorted set
	 * for complete documentation: http://redis.io/commands#generic
	 * key [BY pattern] [LIMIT offset count] [GET pattern [GET pattern ...]] [ASC|DESC] [ALPHA] [STORE destination]
	 */
	public function sort($key, $by, $offset, $count, array $pattern, $asc, $alpha, $dest) {
		throw new RedisException("(" . __FUNCTION__ . ") Not implemented.");
	}

	/**
	 * Get the time to live for a key
	 * for complete documentation: http://redis.io/commands#generic
	 * key
	 */
	public function ttl($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Determine the type stored at key
	 * for complete documentation: http://redis.io/commands#generic
	 * key
	 */
	public function type($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Incrementally iterate the keys space
	 * for complete documentation: http://redis.io/commands#generic
	 * cursor [MATCH pattern] [COUNT count]
	 */
	public function scan($cursor, $pattern = null, $count = null) {
		if($pattern){
			$pattern = ["match", $pattern];
		}
		if($count){
			$count = ["count", $count];
		}

		return $this->exe( $this->protocol([ __FUNCTION__, $cursor, $pattern, $count ]) );
	}


}
