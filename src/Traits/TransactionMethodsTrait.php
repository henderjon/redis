<?php

namespace Redis\Traits;

use Redis\RedisException;

trait TransactionMethodsTrait {

	abstract protected function protocol(array $args);
	abstract protected function exe($string, $count = 1);

	/**
	 * Discard all commands issued after MULTI
	 * for complete documentation: http://redis.io/commands#transactions
	 */
	public function discard() {
		return $this->exe( $this->protocol([ __FUNCTION__ ]) );
	}

	/**
	 * Execute all commands issued after MULTI
	 * for complete documentation: http://redis.io/commands#transactions
	 */
	public function exec() {
		return $this->exe( $this->protocol([ __FUNCTION__ ]) );
	}

	/**
	 * Mark the start of a transaction block
	 * for complete documentation: http://redis.io/commands#transactions
	 */
	public function multi() {
		return $this->exe( $this->protocol([ __FUNCTION__ ]) );
	}

	/**
	 * Forget about all watched keys
	 * for complete documentation: http://redis.io/commands#transactions
	 */
	public function unwatch() {
		return $this->exe( $this->protocol([ __FUNCTION__ ]) );
	}

	/**
	 * Watch the given keys to determine execution of the MULTI/EXEC block
	 * for complete documentation: http://redis.io/commands#transactions
	 * @params key [key ...]
	 */
	public function watch(array $keys) {
		if(count($keys) < 1){
			throw new RedisException("At least one key is required.");
		}

		return $this->exe( $this->protocol([ __FUNCTION__, $keys ]) );
	}


}
