<?php

namespace Redis\Interfaces;

interface HashMethodsInterface {

	function hdel($key, array $fields);
	function hexists($key, $field);
	function hget($key, $field);
	function hgetall($key);
	function hincrby($key, $field, $incr);
	function hincrbyfloat($key, $field, $incr);
	function hkeys($key);
	function hlen($key);
	function hmget($key, array $fields);
	function hmset($key, array $map);
	function hset($key, $field, $value);
	function hsetnx($key, $field, $value);
	function hstrlen($key, $field);
	function hvals($key);
	function hscan($key, $cursor, $pattern = null, $count = null);

}