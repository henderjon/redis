<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ListMethodsTrait {

	abstract protected function protocol(array $args);
	abstract protected function exe($string, $count = 1);

	/**
	 * Remove and get the first element in a list, or block until one is available
	 * for complete documentation: http://redis.io/commands#list
	 * @params key [key ...] timeout
	 */
	public function blpop($key, array $keys, $timeout = 0) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $keys, $timeout ]) );
	}

	/**
	 * Remove and get the last element in a list, or block until one is available
	 * for complete documentation: http://redis.io/commands#list
	 * @params key [key ...] timeout
	 */
	public function brpop($key, array $keys, $timeout = 0) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $keys, $timeout ]) );
	}

	/**
	 * Pop a value from a list, push it to another list and return it; or block until one is available
	 * for complete documentation: http://redis.io/commands#list
	 * @params source destination timeout
	 */
	public function brpoplpush($source, $destination, $timeout = 0) {
		return $this->exe( $this->protocol([ __FUNCTION__, $source, $destination, $timeout ]) );
	}

	/**
	 * Get an element from a list by its index
	 * for complete documentation: http://redis.io/commands#list
	 * @params key index
	 */
	public function lindex($key, $index) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $index ]) );
	}

	/**
	 * Insert an element before or after another element in a list
	 * for complete documentation: http://redis.io/commands#list
	 * @params key BEFORE|AFTER pivot value
	 */
	public function linsert($key, $before = true, $pivot, $value) {
		$position = $before ? "before" : "after";
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $position, $pivot, $value ]) );
	}

	/**
	 * Get the length of a list
	 * for complete documentation: http://redis.io/commands#list
	 * @params key
	 */
	public function llen($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Remove and get the first element in a list
	 * for complete documentation: http://redis.io/commands#list
	 * @params key
	 */
	public function lpop($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Prepend one or multiple values to a list
	 * for complete documentation: http://redis.io/commands#list
	 * @params key value [value ...]
	 */
	public function lpush($key, array $values) {
		if(count($values) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one value is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $values ]) );
	}

	/**
	 * Prepend a value to a list, only if the list exists
	 * for complete documentation: http://redis.io/commands#list
	 * @params key value
	 */
	public function lpushx($key, $value) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $value ]) );
	}

	/**
	 * Get a range of elements from a list
	 * for complete documentation: http://redis.io/commands#list
	 * @params key start stop
	 */
	public function lrange($key, $start, $stop) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $start, $stop ]) );
	}

	/**
	 * Remove elements from a list
	 * for complete documentation: http://redis.io/commands#list
	 * @params key count value
	 */
	public function lrem($key, $count, $value) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $count, $value ]) );
	}

	/**
	 * Set the value of an element in a list by its index
	 * for complete documentation: http://redis.io/commands#list
	 * @params key index value
	 */
	public function lset($key, $index, $value) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $index, $value ]) );
	}

	/**
	 * Trim a list to the specified range
	 * for complete documentation: http://redis.io/commands#list
	 * @params key start stop
	 */
	public function ltrim($key, $start, $stop) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $start, $stop ]) );
	}

	/**
	 * Remove and get the last element in a list
	 * for complete documentation: http://redis.io/commands#list
	 * @params key
	 */
	public function rpop($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Remove the last element in a list, prepend it to another list and return it
	 * for complete documentation: http://redis.io/commands#list
	 * @params source destination
	 */
	public function rpoplpush($source, $destination) {
		return $this->exe( $this->protocol([ __FUNCTION__, $source, $destination ]) );
	}

	/**
	 * Append one or multiple values to a list
	 * for complete documentation: http://redis.io/commands#list
	 * @params key value [value ...]
	 */
	public function rpush($key, array $values) {
		if(count($values) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one value is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $values ]) );
	}

	/**
	 * Append a value to a list, only if the list exists
	 * for complete documentation: http://redis.io/commands#list
	 * @params key value
	 */
	public function rpushx($key, $value) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $value ]) );
	}

}

