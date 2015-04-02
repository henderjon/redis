<?php

namespace Redis\Traits;

use Redis\RedisException;

trait HashMethodsTrait {

	/**
	 * Delete one or more hash fields
	 * key field [field ...]
	 */
	function hdel($key, array $fields) {
		if(count($fields) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one field is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $key, $fields ) );
	}

	/**
	 * Determine if a hash field exists
	 * key field
	 */
	function hexists($key, $field) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field ) );
	}

	/**
	 * Get the value of a hash field
	 * key field
	 */
	function hget($key, $field) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field ) );
	}

	/**
	 * Get all the fields and values in a hash
	 * key
	 */
	function hgetall($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Increment the integer value of a hash field by the given number
	 * key field increment
	 */
	function hincrby($key, $field, $incr) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field, $incr ) );
	}

	/**
	 * Increment the float value of a hash field by the given amount
	 * key field increment
	 */
	function hincrbyfloat($key, $field, $incr) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field, $incr ) );
	}

	/**
	 * Get all the fields in a hash
	 * key
	 */
	function hkeys($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Get the number of fields in a hash
	 * key
	 */
	function hlen($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Get the values of all the given hash fields
	 * key field [field ...]
	 */
	function hmget($key, array $fields) {
		if(count($fields) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one field is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $key, $fields ) );
	}

	/**
	 * Set multiple hash fields to multiple values
	 * key field value [field value ...]
	 */
	function hmset($key, array $map) {
        if(count($map) < 2 && (count($map) % 2 != 0)){
            throw new RedisException("(" . __FUNCTION__ . ") An even number of args is required (e.g. [key, value]).");
        }
        return $this->exe( $this->protocol( __FUNCTION__, $key, $map ) );
	}

	/**
	 * Set the string value of a hash field
	 * key field value
	 */
	function hset($key, $field, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field, $value ) );
	}

	/**
	 * Set the value of a hash field, only if the field does not exist
	 * key field value
	 */
	function hsetnx($key, $field, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field, $value ) );
	}

	/**
	 * Get the length of the value of a hash field
	 * key field
	 */
	function hstrlen($key, $field) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $field ) );
	}

	/**
	 * Get all the values in a hash
	 * key
	 */
	function hvals($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Incrementally iterate hash fields and associated values
	 * key cursor [MATCH pattern] [COUNT count]
	 */
	function hscan($key, $cursor, $pattern = null, $count = null) {
		if($pattern){
			$pattern = ["match", $pattern];
		}
		if($count){
			$count = ["count", $count];
		}

		return $this->exe( $this->protocol( __FUNCTION__, $key, $cursor, $pattern, $count ) );
	}

}