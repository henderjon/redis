<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ScriptingMethodsTrait {

    /**
     * Execute a Lua script server side
     * @params script numkeys key [key ...] arg [arg ...]
     */
    function eval($script, array $keys, array $args = []) {
        if(count($keys) < 1 ){
            throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
        }
        return $this->exec( $this->protocol( __FUNCTION__, $script, count($keys), $keys, $args ) );
    }

    /**
     * Execute a Lua script server side
     * @params sha1 numkeys key [key ...] arg [arg ...]
     */
    function evalsha($sha1, $numkeys, array $keys, array $args = []) {
        if(count($keys) < 1 ){
            throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
        }
        return $this->exec( $this->protocol( __FUNCTION__, $sha1, count($keys), $keys, $args ) );
    }

    /**
     * Check existence of scripts in the script cache.
     * @params EXISTS script [script ...]
     */
    function scriptExists(array $scripts) {
        if(count($scripts) < 1 ){
            throw new RedisException("(" . __FUNCTION__ . ") At least one script is required.");
        }
        return $this->exec( $this->protocol( "SCRIPT", "EXISTS", $scripts ) );
    }

    /**
     * Remove all the scripts from the script cache.
     * @params FLUSH
     */
    function scriptFlush() {
        return $this->exec( $this->protocol( "SCRIPT", "FLUSH" ) );
    }

    /**
     * Kill the script currently in execution.
     * @params KILL
     */
    function scriptKill() {
        return $this->exec( $this->protocol( "SCRIPT", "KILL" ) );
    }

    /**
     * Load the specified Lua script into the script cache.
     * @params LOAD script
     */
    function scriptLoad($script) {
        return $this->exec( $this->protocol( "SCRIPT", "LOAD", $script ) );
    }


}