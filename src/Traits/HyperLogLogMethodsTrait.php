<?php

namespace Redis\Traits;

use Redis\RedisException;

trait HyperLogLogMethodsTrait {

	/**
	 * Adds the specified elements to the specified HyperLogLog.
	 * for complete documentation: http://redis.io/commands#hyperloglog
	 * key element [element ...]
	 */
	public function pfadd($key, array $elements) {
		if(count($elements) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one element is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $key, $elements ) );
	}

	/**
	 * Return the approximated cardinality of the set(s) observed by the HyperLogLog at key(s).
	 * for complete documentation: http://redis.io/commands#hyperloglog
	 * key [key ...]
	 */
	public function pfcount(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $keys ) );
	}

	/**
	 * Merge N different HyperLogLogs into a single one.
	 * for complete documentation: http://redis.io/commands#hyperloglog
	 * destkey sourcekey [sourcekey ...]
	 */
	public function pfmerge($dest, array $sources) {
		if(count($sources) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one source key is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $dest, $sources ) );
	}


}