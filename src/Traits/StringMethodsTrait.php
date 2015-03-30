<?php

trait StringMethodsTrait {

    /**
     *  Append a value to a key
     */
    function append($key, $value) {
        return $this->exec( $this->protocol( __METHOD__, $key, $value ) );
    }

    /**
     * Count set bits in a string
     * for complete documentation: http://redis.io/commands#string
     * @params key [start end]
     */
    function bitcount($key, $start = "", $end = "") {
        return $this->exec( $this->protocol( __METHOD__, $key, $start, $end ) );
    }

    /**
     * Perform bitwise operations between strings
     * for complete documentation: http://redis.io/commands#string
     * @params operation destkey key [key ...]
     */
    function bitop($operation, $destkey, array $keys) {
        if(count($keys) < 1){
            throw new RedisException("(" . __METHOD__ . ") At least one key is required.");
        }

        return $this->exec( $this->protocol( __METHOD__, $operation, $destkey, $keys ) );
    }

    /**
     * Find first bit set or clear in a string
     * for complete documentation: http://redis.io/commands#string
     * @params key bit [start] [end]
     */
    function bitpos($key, $bit, $start = "", $end = "") {
        return $this->exec( $this->protocol( __METHOD__, $key, $bit, $start, $end ) );
    }

    /**
     * Decrement the integer value of a key by one
     * for complete documentation: http://redis.io/commands#string
     * @params key
     */
    function decr($key) {
        return $this->exec( $this->protocol( __METHOD__, $key ) );
    }

    /**
     * Decrement the integer value of a key by the given number
     * for complete documentation: http://redis.io/commands#string
     * @params key decrement
     */
    function decrby($key, $decr) {
        return $this->exec( $this->protocol( __METHOD__, $key, $decr ) );
    }

    /**
     * Get the value of a key
     * for complete documentation: http://redis.io/commands#string
     * @params key
     */
    function get($key) {
        return $this->exec( $this->protocol( __METHOD__, $key ) );
    }

    /**
     * Returns the bit value at offset in the string value stored at key
     * for complete documentation: http://redis.io/commands#string
     * @params key offset
     */
    function getbit($key, $offset) {
        return $this->exec( $this->protocol( __METHOD__, $key, $offset ) );
    }

    /**
     * Get a substring of the string stored at a key
     * for complete documentation: http://redis.io/commands#string
     * @params key start end
     */
    function getrange($key, $start, $end) {
        return $this->exec( $this->protocol( __METHOD__, $key, $start, $end ) );
    }

    /**
     * Set the string value of a key and return its old value
     * for complete documentation: http://redis.io/commands#string
     * @params key value
     */
    function getset($key, $value) {
        return $this->exec( $this->protocol( __METHOD__, $key, $value ) );
    }

    /**
     * Increment the integer value of a key by one
     * for complete documentation: http://redis.io/commands#string
     * @params key
     */
    function incr($key) {
        return $this->exec( $this->protocol( __METHOD__, $key ) );
    }

    /**
     * Increment the integer value of a key by the given amount
     * for complete documentation: http://redis.io/commands#string
     * @params key increment
     */
    function incrby($key, $incr) {
        return $this->exec( $this->protocol( __METHOD__, $key, $incr ) );
    }

    /**
     * Increment the float value of a key by the given amount
     * for complete documentation: http://redis.io/commands#string
     * @params key increment
     */
    function incrbyfloat($key, $incr) {
        return $this->exec( $this->protocol( __METHOD__, $key, $incr ) );
    }

    /**
     * Get the values of all the given keys
     * for complete documentation: http://redis.io/commands#string
     * @params key [key ...]
     */
    function mget(array $keys) {
        if(count($keys) < 1){
            throw new RedisException("(" . __METHOD__ . ") At least one key is required.");
        }
        return $this->exec( $this->protocol( __METHOD__, $keys ) );
    }

    /**
     * Set multiple keys to multiple values
     * for complete documentation: http://redis.io/commands#string
     * @params key value [key value ...]
     */
    function mset(array $map) {
        if(count($map) < 2 || (count($map) % 2 != 0)){
            throw new RedisException("(" . __METHOD__ . ") An even number of args is required (e.g. [key, value]).");
        }
        return $this->exec( $this->protocol( __METHOD__, $map ) );
    }

    /**
     * Set multiple keys to multiple values, only if none of the keys exist
     * for complete documentation: http://redis.io/commands#string
     * @params key value [key value ...]
     */
    function msetnx(array $map) {
        if(count($map) < 2 || (count($map) % 2 != 0)){
            throw new RedisException("(" . __METHOD__ . ") An even number of args is required (e.g. [key, value]).");
        }
        return $this->exec( $this->protocol( __METHOD__, $map ) );
    }

    /**
     * Set the value and expiration in milliseconds of a key
     * for complete documentation: http://redis.io/commands#string
     * @params key milliseconds value
     */
    function psetex($key, $milliseconds, $value) {
        return $this->exec( $this->protocol( __METHOD__, $key, $milliseconds, $value ) );
    }

    /**
     * Set the string value of a key
     * for complete documentation: http://redis.io/commands#string
     * @params key value [EX seconds] [PX milliseconds] [NX|XX]
     */
    function set($key, $value, $expire = "", $expx = "", $nxxx = "") {
        if($expire && !$expx){
            throw new RedisException("(" . __METHOD__ . ") You must specify either seconds or milliseconds.");
        }

        if($expire && $expx){
            $expire = "{$expx} {$expire}";
        }
        return $this->exec( $this->protocol( __METHOD__, $key, $value, $expire, $nxxx ) );
    }

    /**
     * Sets or clears the bit at offset in the string value stored at key
     * for complete documentation: http://redis.io/commands#string
     * @params key offset value
     */
    function setbit($key, $offset, $value) {
        return $this->exec( $this->protocol( __METHOD__, $key, $offset, $value ) );
    }

    /**
     * Set the value and expiration of a key
     * for complete documentation: http://redis.io/commands#string
     * @params key seconds value
     */
    function setex($key, $seconds, $value) {
        return $this->exec( $this->protocol( __METHOD__, $key, $seconds, $value ) );
    }

    /**
     * Set the value of a key, only if the key does not exist
     * for complete documentation: http://redis.io/commands#string
     * @params key value
     */
    function setnx($key, $value) {
        return $this->exec( $this->protocol( __METHOD__, $key, $value ) );
    }

    /**
     * Overwrite part of a string at key starting at the specified offset
     * for complete documentation: http://redis.io/commands#string
     * @params key offset value
     */
    function setrange($key, $offset, $value) {
        return $this->exec( $this->protocol( __METHOD__, $key, $offset, $value ) );
    }

    /**
     * Get the length of the value stored in a key
     * for complete documentation: http://redis.io/commands#string
     * @params key
     */
    function strlen($key) {
        return $this->exec( $this->protocol( __METHOD__, $key ) );
    }


}