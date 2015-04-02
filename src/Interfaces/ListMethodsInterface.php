<?php

namespace Redis\Interfaces;

interface ListMethodsInterface {

	function blpop($key, array $keys, $timeout = 0);
	function brpop($key, array $keys, $timeout = 0);
	function brpoplpush($source, $destination, $timeout = 0);
	function lindex($key, $index);
	function linsert($key, $before = true, $pivot, $value);
	function llen($key);
	function lpop($key);
	function lpush($key, array $values);
	function lpushx($key, $value);
	function lrange($key, $start, $stop);
	function lrem($key, $count, $value);
	function lset($key, $index, $value);
	function ltrim($key, $start, $stop);
	function rpop($key);
	function rpoplpush($source, $destination);
	function rpush($key, array $values);
	function rpushx($key, $value);

}