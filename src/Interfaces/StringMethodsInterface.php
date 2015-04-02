<?php

namespace Redis\Interfaces;

interface StringMethodsInterface {

	function append($key, $value);
	function bitcount($key, $start = null, $end = null);
	function bitopAnd($destkey, array $keys);
	function bitopOr($destkey, array $keys);
	function bitopXor($destkey, array $keys);
	function bitopNot($destkey, array $keys);
	function bitpos($key, $bit, $start = null, $end = null);
	function decr($key);
	function decrby($key, $decr);
	function get($key);
	function getbit($key, $offset);
	function getrange($key, $start, $end);
	function getset($key, $value);
	function incr($key);
	function incrby($key, $incr);
	function incrbyfloat($key, $incr);
	function mget(array $keys);
	function mset(array $map);
	function msetnx(array $map);
	function psetex($key, $milliseconds, $value);
	function set($key, $value, $expire = null, $expx = null, $nxxx = null);
	function setbit($key, $offset, $value);
	function setex($key, $seconds, $value);
	function setnx($key, $value);
	function setrange($key, $offset, $value);
	function strlen($key);

}
