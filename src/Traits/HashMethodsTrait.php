<?php

namespace Redis\Traits;

use Redis\RedisException;

trait HashMethodsTrait {

	abstract protected function protocol();
	abstract protected function exe($string, $count = 1);

	/**
	 * Delete one or more hash fields
	 * for complete documentation: http://redis.io/commands#hash
	 * key field [field ...]
	 */
	public function hdel($key, array $fields) {
		if(count($fields) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one field is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $key, $fields ) );
	}

	/**
	 * Determine if a hash field exists
	 * for complete documentation: http://redis.io/commands#hash
	 * key field
	 */
	public function hexists($key, $field) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field ) );
	}

	/**
	 * Get the value of a hash field
	 * for complete documentation: http://redis.io/commands#hash
	 * key field
	 */
	public function hget($key, $field) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field ) );
	}

	/**
	 * Get all the fields and values in a hash
	 * for complete documentation: http://redis.io/commands#hash
	 * key
	 */
	public function hgetall($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Increment the integer value of a hash field by the given number
	 * for complete documentation: http://redis.io/commands#hash
	 * key field increment
	 */
	public function hincrby($key, $field, $incr) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field, $incr ) );
	}

	/**
	 * Increment the float value of a hash field by the given amount
	 * for complete documentation: http://redis.io/commands#hash
	 * key field increment
	 */
	public function hincrbyfloat($key, $field, $incr) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field, $incr ) );
	}

	/**
	 * Get all the fields in a hash
	 * for complete documentation: http://redis.io/commands#hash
	 * key
	 */
	public function hkeys($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Get the number of fields in a hash
	 * for complete documentation: http://redis.io/commands#hash
	 * key
	 */
	public function hlen($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Get the values of all the given hash fields
	 * for complete documentation: http://redis.io/commands#hash
	 * key field [field ...]
	 */
	public function hmget($key, array $fields) {
		if(count($fields) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one field is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $key, $fields ) );
	}

	/**
	 * Set multiple hash fields to multiple values
	 * for complete documentation: http://redis.io/commands#hash
	 * key field value [field value ...]
	 */
	public function hmset($key, array $map) {
        if(count($map) < 2 || (count($map) % 2 != 0)){
            throw new RedisException("(" . __FUNCTION__ . ") An even number of args is required (e.g. [key, value]).");
        }
        return $this->exe( $this->protocol( __FUNCTION__, $key, $map ) );
	}

	/**
	 * Set the string value of a hash field
	 * for complete documentation: http://redis.io/commands#hash
	 * key field value
	 */
	public function hset($key, $field, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field, $value ) );
	}

	/**
	 * Set the value of a hash field, only if the field does not exist
	 * for complete documentation: http://redis.io/commands#hash
	 * key field value
	 */
	public function hsetnx($key, $field, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field, $value ) );
	}

	/**
	 * Get the length of the value of a hash field
	 * for complete documentation: http://redis.io/commands#hash
	 * key field
	 */
	public function hstrlen($key, $field) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field ) );
	}

	/**
	 * Get all the values in a hash
	 * for complete documentation: http://redis.io/commands#hash
	 * key
	 */
	public function hvals($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Incrementally iterate hash fields and associated values
	 * for complete documentation: http://redis.io/commands#hash
	 * key cursor [MATCH pattern] [COUNT count]
	 */
	public function hscan($key, $cursor, $pattern = null, $count = null) {
		if($pattern){
			$pattern = ["match", $pattern];
		}
		if($count){
			$count = ["count", $count];
		}

		return $this->exe( $this->protocol( __FUNCTION__, $key, $cursor, $pattern, $count ) );
	}

}
