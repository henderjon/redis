<?php

namespace Redis\Traits;

use Redis\RedisException;

trait SetMethodsTrait {

	/**
	 * Add one or more members to a set
	 * for complete documentation: http://redis.io/commands#set
	 * key@params  member [member ...]
	 */
	function sadd($key, array $members) {
		if(count($members) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one member is required.");
		}

		return $this->exec( $this->protocol( __FUNCTION__, $key, $members ) );
	}

	/**
	 * Get the number of members in a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key
	 */
	function scard($key) {
		return $this->exec( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Subtract multiple sets
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [key ...]
	 */
	function sdiff(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exec( $this->protocol( __FUNCTION__, $keys ) );
	}

	/**
	 * Subtract multiple sets and store the resulting set in a key
	 * for complete documentation: http://redis.io/commands#set
	 * @params destination key [key ...]
	 */
	function sdiffstore($dest, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exec( $this->protocol( __FUNCTION__, $dest, $keys ) );
	}

	/**
	 * Intersect multiple sets
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [key ...]
	 */
	function sinter(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exec( $this->protocol( __FUNCTION__, $keys ) );
	}

	/**
	 * Intersect multiple sets and store the resulting set in a key
	 * for complete documentation: http://redis.io/commands#set
	 * @params destination key [key ...]
	 */
	function sinterstore($dest, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exec( $this->protocol( __FUNCTION__, $dest, $keys ) );
	}

	/**
	 * Determine if a given value is a member of a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key member
	 */
	function sismember($key, $member) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $member ) );
	}

	/**
	 * Get all the members in a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key
	 */
	function smembers($key) {
		return $this->exec( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Move a member from one set to another
	 * for complete documentation: http://redis.io/commands#set
	 * @params source destination member
	 */
	function smove($source, $dest, $member) {
		return $this->exec( $this->protocol( __FUNCTION__, $source, $dest, $member ) );
	}

	/**
	 * Remove and return one or multiple random members from a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [count]
	 */
	function spop($key, $count = 1) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $count ) );
	}

	/**
	 * Get one or multiple random members from a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [count]
	 */
	function srandmember($key, $count = 1) {
		return $this->exec( $this->protocol( __FUNCTION__, $key, $count ) );
	}

	/**
	 * Remove one or more members from a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key member [member ...]
	 */
	function srem($key, array $members) {
		if(count($members) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one member is required.");
		}

		return $this->exec( $this->protocol( __FUNCTION__, $key, $members ) );
	}

	/**
	 * Add multiple sets
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [key ...]
	 */
	function sunion(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exec( $this->protocol( __FUNCTION__, $keys ) );
	}

	/**
	 * Add multiple sets and store the resulting set in a key
	 * for complete documentation: http://redis.io/commands#set
	 * @params destination key [key ...]
	 */
	function sunionstore($dest, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exec( $this->protocol( __FUNCTION__, $dest, $keys ) );
	}

	/**
	 * Incrementally iterate Set elements
	 * for complete documentation: http://redis.io/commands#set
	 * @params key cursor [MATCH pattern] [COUNT count]
	 */
	function sscan($key, $cursor, $pattern = "", $count = "") {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		$args = [$key, $cursor];

		if($pattern){
			$args[] = "MATCH";
			$args[] = $pattern;
		}

		if($count){
			$args[] = "COUNT";
			$args[] = $count;
		}


		return $this->exec( $this->protocol( __FUNCTION__, $args ) );
	}


}