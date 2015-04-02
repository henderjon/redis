<?php

namespace Redis\Traits;

use Redis\RedisException;

trait SetMethodsTrait {

	/**
	 * Add one or more members to a set
	 * for complete documentation: http://redis.io/commands#set
	 * key@params  member [member ...]
	 */
	public function sadd($key, array $members) {
		if(count($members) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one member is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, $key, $members ) );
	}

	/**
	 * Get the number of members in a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key
	 */
	public function scard($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Subtract multiple sets
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [key ...]
	 */
	public function sdiff(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, $keys ) );
	}

	/**
	 * Subtract multiple sets and store the resulting set in a key
	 * for complete documentation: http://redis.io/commands#set
	 * @params destination key [key ...]
	 */
	public function sdiffstore($dest, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, $dest, $keys ) );
	}

	/**
	 * Intersect multiple sets
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [key ...]
	 */
	public function sinter(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, $keys ) );
	}

	/**
	 * Intersect multiple sets and store the resulting set in a key
	 * for complete documentation: http://redis.io/commands#set
	 * @params destination key [key ...]
	 */
	public function sinterstore($dest, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, $dest, $keys ) );
	}

	/**
	 * Determine if a given value is a member of a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key member
	 */
	public function sismember($key, $member) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $member ) );
	}

	/**
	 * Get all the members in a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key
	 */
	public function smembers($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Move a member from one set to another
	 * for complete documentation: http://redis.io/commands#set
	 * @params source destination member
	 */
	public function smove($source, $dest, $member) {
		return $this->exe( $this->protocol( __FUNCTION__, $source, $dest, $member ) );
	}

	/**
	 * Remove and return one or multiple random members from a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [count]
	 */
	public function spop($key, $count = 1) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $count ) );
	}

	/**
	 * Get one or multiple random members from a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [count]
	 */
	public function srandmember($key, $count = 1) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $count ) );
	}

	/**
	 * Remove one or more members from a set
	 * for complete documentation: http://redis.io/commands#set
	 * @params key member [member ...]
	 */
	public function srem($key, array $members) {
		if(count($members) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one member is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, $key, $members ) );
	}

	/**
	 * Add multiple sets
	 * for complete documentation: http://redis.io/commands#set
	 * @params key [key ...]
	 */
	public function sunion(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, $keys ) );
	}

	/**
	 * Add multiple sets and store the resulting set in a key
	 * for complete documentation: http://redis.io/commands#set
	 * @params destination key [key ...]
	 */
	public function sunionstore($dest, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, $dest, $keys ) );
	}

	/**
	 * Incrementally iterate Set elements
	 * for complete documentation: http://redis.io/commands#set
	 * @params key cursor [MATCH pattern] [COUNT count]
	 */
	public function sscan($key, $cursor, $pattern = null, $count = null) {

		if($pattern){
			$pattern = ["match", $pattern];
		}

		if($count){
			$count = ["count", $count];
		}

		return $this->exe( $this->protocol( __FUNCTION__, $key, $cursor, $pattern, $count) );
	}


}
