<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ScriptingMethodsTrait {

	abstract protected function protocol(array $args);
	abstract protected function exe($string, $count = 1);

	/**
	 * exeute a Lua script server side
	 * for complete documentation: http://redis.io/commands#scripting
	 * @params script numkeys key [key ...] arg [arg ...]
	 */
	public function evalLua($script, array $keys, array $args = null) {
		if(count($keys) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol([ "eval", $script, count($keys), $keys, $args ]) );
	}

	/**
	 * exeute a Lua script server side
	 * for complete documentation: http://redis.io/commands#scripting
	 * @params sha1 numkeys key [key ...] arg [arg ...]
	 */
	public function evalsha($sha1, $numkeys, array $keys, array $args = null) {
		if(count($keys) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $sha1, count($keys), $keys, $args ]) );
	}

	/**
	 * Check existence of scripts in the script cache.
	 * for complete documentation: http://redis.io/commands#scripting
	 * @params EXISTS script [script ...]
	 */
	public function scriptExists(array $scripts) {
		if(count($scripts) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one script is required.");
		}
		return $this->exe( $this->protocol([ "script", "exists", $scripts ]) );
	}

	/**
	 * Remove all the scripts from the script cache.
	 * for complete documentation: http://redis.io/commands#scripting
	 * @params FLUSH
	 */
	public function scriptFlush() {
		return $this->exe( $this->protocol([ "script", "flush" ]) );
	}

	/**
	 * Kill the script currently in exeution.
	 * for complete documentation: http://redis.io/commands#scripting
	 * @params KILL
	 */
	public function scriptKill() {
		return $this->exe( $this->protocol([ "script", "kill" ]) );
	}

	/**
	 * Load the specified Lua script into the script cache.
	 * for complete documentation: http://redis.io/commands#scripting
	 * @params LOAD script
	 */
	public function scriptLoad($script) {
		return $this->exe( $this->protocol([ "script", "load", $script ]) );
	}


}
