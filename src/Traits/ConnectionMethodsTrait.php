<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ConnectionMethodsTrait {

	/**
	 * Authenticate to the server
	 * for complete documentation: http://redis.io/commands#connection
	 * password
	 */
	public function auth($password) {
		return $this->exe( $this->protocol( __FUNCTION__, $password ) );
	}

	/**
	 * Echo the given string
	 * for complete documentation: http://redis.io/commands#connection
	 * message
	 */
	// public function echo($message) {
	//     throw new RedisException("(" . __FUNCTION__ . ") Not implemented.");
	// }

	/**
	 * Ping the server
	 * for complete documentation: http://redis.io/commands#connection
	 */
	public function ping() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Close the connection
	 * for complete documentation: http://redis.io/commands#connection
	 */
	public function quit() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Change the selected database for the current connection
	 * for complete documentation: http://redis.io/commands#connection
	 * index
	 */
	public function select($index) {
		return $this->exe( $this->protocol( __FUNCTION__, $index ) );
	}


}
