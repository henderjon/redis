<?php

trait ScriptingMethodsTrait {

    function eval($script, $numkeys, array $keys, array $args) {
        //  script numkeys key [key ...] arg [arg ...] Execute a Lua script server side
    }

    function evalsha($sha1, $numkeys, array $keys, array $args) {
        //  sha1 numkeys key [key ...] arg [arg ...] Execute a Lua script server side
    }

    function scriptExists(array $scripts) {
        //  EXISTS script [script ...] Check existence of scripts in the script cache.
    }

    function scriptFlush() {
        //  FLUSH Remove all the scripts from the script cache.
    }

    function scriptKill() {
        //  KILL Kill the script currently in execution.
    }

    function scriptLoad($script) {
        //  LOAD script Load the specified Lua script into the script cache.
    }


}