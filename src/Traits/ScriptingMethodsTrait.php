<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ScriptingMethodsTrait {

	/**
	 * exeute a Lua script server side
	 * @params script numkeys key [key ...] arg [arg ...]
	 */
	function evalLua($script, array $keys, array $args = null) {
		if(count($keys) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol( "eval", $script, count($keys), $keys, $args ) );
	}

	/**
	 * exeute a Lua script server side
	 * @params sha1 numkeys key [key ...] arg [arg ...]
	 */
	function evalsha($sha1, $numkeys, array $keys, array $args = null) {
		if(count($keys) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol( __FUNCTION__, $sha1, count($keys), $keys, $args ) );
	}

	/**
	 * Check existence of scripts in the script cache.
	 * @params EXISTS script [script ...]
	 */
	function scriptExists(array $scripts) {
		if(count($scripts) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one script is required.");
		}
		return $this->exe( $this->protocol( "script", "exists", $scripts ) );
	}

	/**
	 * Remove all the scripts from the script cache.
	 * @params FLUSH
	 */
	function scriptFlush() {
		return $this->exe( $this->protocol( "script", "flush" ) );
	}

	/**
	 * Kill the script currently in exeution.
	 * @params KILL
	 */
	function scriptKill() {
		return $this->exe( $this->protocol( "script", "kill" ) );
	}

	/**
	 * Load the specified Lua script into the script cache.
	 * @params LOAD script
	 */
	function scriptLoad($script) {
		return $this->exe( $this->protocol( "script", "load", $script ) );
	}


}