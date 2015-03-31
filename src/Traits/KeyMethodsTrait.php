<?php

namespace Redis\Traits;

use Redis\RedisException;

trait KeyMethodsTrait {

	/**
	 * Delete a key
	 * key [key ...]
	 */
	function del(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exec( $this->protocol( __FUNCTION__, $keys ) );
	}

	/**
	 * Return a serialized version of the value stored at the specified key.
	 * key
	 */
	function dump($key) {
		return $this->exec( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Determine if a key exists
	 * key
	 */
	function exists($key) {
		return $this->exec( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Set a key's time to live in seconds
	 * key seconds
	 */
	function expire($key, $seconds) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $seconds ) );
	}

	/**
	 * Set the expiration for a key as a UNIX timestamp
	 * key timestamp
	 */
	function expireat($key, $timestamp) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $timestamp ) );
	}

	/**
	 * Find all keys matching the given pattern
	 * pattern
	 */
	function keys($pattern) {
		return $this->exec( $this->protocol( __FUNCTION__, $pattern ) );
	}

	/**
	 * Atomically transfer a key from a Redis instance to another one.
	 * host port key destination-db timeout [COPY] [REPLACE]
	 */
	function migrate($host, $port, $key, $dest, $timeout) {
		return $this->exec( $this->protocol( __FUNCTION__, $host, $port, $key, $dest, $timeout ) );
	}

	/**
	 * Move a key to another database
	 * key db
	 */
	function move($key, $db) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $db ) );
	}

	/**
	 * Inspect the internals of Redis objects
	 * returns the number of references of the value associated with the specified key. This command is mainly useful for debugging.
	 * subcommand [arguments [arguments ...]]
	 */
	function objectRefcount($keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exec( $this->protocol( "OBJECT", "REFCOUNT", $keys ) );
	}

	/**
	 * Inspect the internals of Redis objects
	 * returns the kind of internal representation used in order to store the value associated with a key.
	 * subcommand [arguments [arguments ...]]
	 */
	function objectEncoding($keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exec( $this->protocol( "OBJECT", "ENCODING", $keys ) );
	}

	/**
	 * Inspect the internals of Redis objects
	 * returns the number of seconds since the object stored at the specified key is idle (not requested by read or write operations).
	 * While the value is returned in seconds the actual resolution of this timer is 10 seconds, but may vary in future implementations.
	 * subcommand [arguments [arguments ...]]
	 */
	function objectIdletime($keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exec( $this->protocol( "OBJECT", "IDLETIME", $keys ) );
	}

	/**
	 * Remove the expiration from a key
	 * key
	 */
	function persist($key) {
		return $this->exec( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Set a key's time to live in milliseconds
	 * key milliseconds
	 */
	function pexpire($key, $milliseconds) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $milliseconds ) );
	}

	/**
	 * Set the expiration for a key as a UNIX timestamp specified in milliseconds
	 * key milliseconds-timestamp
	 */
	function pexpireat($key, $timestamp) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $timeout ) );
	}

	/**
	 * Get the time to live for a key in milliseconds
	 * key
	 */
	function pttl($key) {
		return $this->exec( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Return a random key from the keyspace
	 */
	function randomkey() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Rename a key
	 * key newkey
	 */
	function rename($key, $newKey) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $newKey ) );
	}

	/**
	 * Rename a key, only if the new key does not exist
	 * key newkey
	 */
	function renamenx($key, $newKey) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $newKey ) );
	}

	/**
	 * Create a key using the provided serialized value, previously obtained using DUMP.
	 * key ttl serialized-value [REPLACE]
	 */
	function restore($key, $ttl, $serialValue, $replace = true) {
		$replace = $replace ? "REPLACE" : "";
		return $this->exec( $this->protocol( __FUNCTION__, $key, $ttl, $serialValue, $replace ) );
	}

	/**
	 * Sort the elements in a list, set or sorted set
	 * key [BY pattern] [LIMIT offset count] [GET pattern [GET pattern ...]] [ASC|DESC] [ALPHA] [STORE destination]
	 */
	function sort($key, $by, $offset, $count, array $pattern, $asc, $alpha, $dest) {
		throw new RedisException("(" . __FUNCTION__ . ") Not implemented.");
	}

	/**
	 * Get the time to live for a key
	 * key
	 */
	function ttl($key) {
		return $this->exec( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Determine the type stored at key
	 * key
	 */
	function type($key) {
		return $this->exec( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Incrementally iterate the keys space
	 * cursor [MATCH pattern] [COUNT count]
	 */
	function scan($cursor, $pattern = "", $count = 10) {
		if($pattern){
			$pattern = "MATCH {$pattern}";
		}
		if($count){
			$count = "COUNT {$count}";
		}

		return $this->exec( $this->protocol( __FUNCTION__, $cursor, $pattern, $count ) );
	}


}