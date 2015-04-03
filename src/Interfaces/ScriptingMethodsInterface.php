<?php

namespace Redis\Interfaces;

interface ScriptingMethodsInterface {

	function evalLua($script, array $keys, array $args = null);
	function evalsha($sha1, array $keys, array $args = null);
	function scriptExists(array $scripts);
	function scriptFlush();
	function scriptKill();
	function scriptLoad($script);

}
