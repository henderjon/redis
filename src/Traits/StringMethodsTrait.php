<?php

namespace Redis\Traits;

use Redis\RedisException;

trait StringMethodsTrait {

	abstract public function getExpx($expx);

	abstract public function getNxxx($expx);

	/**
	 *  Append a value to a key
	 */
	public function append($key, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $value ) );
	}

	/**
	 * Count set bits in a string
	 * for complete documentation: http://redis.io/commands#string
	 * @params key [start end]
	 */
	public function bitcount($key, $start = null, $end = null) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $start, $end ) );
	}

	/**
	 * Perform bitwise operations between strings
	 * for complete documentation: http://redis.io/commands#string
	 * @params operation destkey key [key ...]
	 */
	public function bitopAnd($destkey, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, "AND", $destkey, $keys ) );
	}

	/**
	 * Perform bitwise operations between strings
	 * for complete documentation: http://redis.io/commands#string
	 * @params operation destkey key [key ...]
	 */
	public function bitopOr($destkey, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, "OR", $destkey, $keys ) );
	}

	/**
	 * Perform bitwise operations between strings
	 * for complete documentation: http://redis.io/commands#string
	 * @params operation destkey key [key ...]
	 */
	public function bitopXor($destkey, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, "XOR", $destkey, $keys ) );
	}

	/**
	 * Perform bitwise operations between strings
	 * for complete documentation: http://redis.io/commands#string
	 * @params operation destkey key [key ...]
	 */
	public function bitopNot($destkey, array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		return $this->exe( $this->protocol( __FUNCTION__, "NOT", $destkey, $keys ) );
	}

	/**
	 * Find first bit set or clear in a string
	 * for complete documentation: http://redis.io/commands#string
	 * @params key bit [start] [end]
	 */
	public function bitpos($key, $bit, $start = null, $end = null) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $bit, $start, $end ) );
	}

	/**
	 * Decrement the integer value of a key by one
	 * for complete documentation: http://redis.io/commands#string
	 * @params key
	 */
	public function decr($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Decrement the integer value of a key by the given number
	 * for complete documentation: http://redis.io/commands#string
	 * @params key decrement
	 */
	public function decrby($key, $decr) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $decr ) );
	}

	/**
	 * Get the value of a key
	 * for complete documentation: http://redis.io/commands#string
	 * @params key
	 */
	public function get($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Returns the bit value at offset in the string value stored at key
	 * for complete documentation: http://redis.io/commands#string
	 * @params key offset
	 */
	public function getbit($key, $offset) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $offset ) );
	}

	/**
	 * Get a substring of the string stored at a key
	 * for complete documentation: http://redis.io/commands#string
	 * @params key start end
	 */
	public function getrange($key, $start, $end) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $start, $end ) );
	}

	/**
	 * Set the string value of a key and return its old value
	 * for complete documentation: http://redis.io/commands#string
	 * @params key value
	 */
	public function getset($key, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $value ) );
	}

	/**
	 * Increment the integer value of a key by one
	 * for complete documentation: http://redis.io/commands#string
	 * @params key
	 */
	public function incr($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}

	/**
	 * Increment the integer value of a key by the given amount
	 * for complete documentation: http://redis.io/commands#string
	 * @params key increment
	 */
	public function incrby($key, $incr) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $incr ) );
	}

	/**
	 * Increment the float value of a key by the given amount
	 * for complete documentation: http://redis.io/commands#string
	 * @params key increment
	 */
	public function incrbyfloat($key, $incr) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $incr ) );
	}

	/**
	 * Get the values of all the given keys
	 * for complete documentation: http://redis.io/commands#string
	 * @params key [key ...]
	 */
	public function mget(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $keys ) );
	}

	/**
	 * Set multiple keys to multiple values
	 * for complete documentation: http://redis.io/commands#string
	 * @params key value [key value ...]
	 */
	public function mset(array $map) {
		if(count($map) < 2 || (count($map) % 2 != 0)){
			throw new RedisException("(" . __FUNCTION__ . ") An even number of args is required (e.g. [key, value]).");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $map ) );
	}

	/**
	 * Set multiple keys to multiple values, only if none of the keys exist
	 * for complete documentation: http://redis.io/commands#string
	 * @params key value [key value ...]
	 */
	public function msetnx(array $map) {
		if(count($map) < 2 || (count($map) % 2 != 0)){
			throw new RedisException("(" . __FUNCTION__ . ") An even number of args is required (e.g. [key, value]).");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $map ) );
	}

	/**
	 * Set the value and expiration in milliseconds of a key
	 * for complete documentation: http://redis.io/commands#string
	 * @params key milliseconds value
	 */
	public function psetex($key, $milliseconds, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $milliseconds, $value ) );
	}

	/**
	 * Set the string value of a key
	 * for complete documentation: http://redis.io/commands#string
	 * @params key value [EX seconds] [PX milliseconds] [NX|XX]
	 */
	public function set($key, $value, $expire = null, $expx = null, $nxxx = null) {
		if($expire && !$expx){
			throw new RedisException("(" . __FUNCTION__ . ") You must specify either seconds or milliseconds.");
		}

		if(!is_null($expx) && !($expx = $this->getExpx($expx))){
			throw new RedisException("(" . __FUNCTION__ . ") Invalid identifier for seconds/milliseconds. (e.g. EX|PX)");
		}

		if(!is_null($nxxx) && !($nxxx = $this->getNxxx($nxxx))){
			throw new RedisException("(" . __FUNCTION__ . ") Invalid identifier for `set` operation. (e.g. NX|XX)");
		}

		if($expire && $expx){
			$expire = [$expx, $expire];
		}

		return $this->exe( $this->protocol( __FUNCTION__, $key, $value, $expire, $nxxx ) );
	}

	/**
	 * Sets or clears the bit at offset in the string value stored at key
	 * for complete documentation: http://redis.io/commands#string
	 * @params key offset value
	 */
	public function setbit($key, $offset, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $offset, $value ) );
	}

	/**
	 * Set the value and expiration of a key
	 * for complete documentation: http://redis.io/commands#string
	 * @params key seconds value
	 */
	public function setex($key, $seconds, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $seconds, $value ) );
	}

	/**
	 * Set the value of a key, only if the key does not exist
	 * for complete documentation: http://redis.io/commands#string
	 * @params key value
	 */
	public function setnx($key, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $value ) );
	}

	/**
	 * Overwrite part of a string at key starting at the specified offset
	 * for complete documentation: http://redis.io/commands#string
	 * @params key offset value
	 */
	public function setrange($key, $offset, $value) {
		return $this->exe( $this->protocol( __FUNCTION__, $key, $offset, $value ) );
	}

	/**
	 * Get the length of the value stored in a key
	 * for complete documentation: http://redis.io/commands#string
	 * @params key
	 */
	public function strlen($key) {
		return $this->exe( $this->protocol( __FUNCTION__, $key ) );
	}


}
