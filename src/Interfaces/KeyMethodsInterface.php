<?php

namespace Redis\Interfaces;

interface KeyMethodsInterface {

	function del(array $keys);
	function dump($key);
	function exists($key);
	function expire($key, $seconds);
	function expireat($key, $timestamp);
	function keys($pattern);
	function migrate($host, $port, $key, $dest, $timeout);
	function move($key, $db);
	function objectRefcount($keys);
	function objectEncoding($keys);
	function objectIdletime($keys);
	function persist($key);
	function pexpire($key, $milliseconds);
	function pexpireat($key, $timestamp);
	function pttl($key);
	function randomkey();
	function rename($key, $newKey);
	function renamenx($key, $newKey);
	function restore($key, $ttl, $serialValue, $replace = true);
	// function sort($key, $by, $offset, $count, array $pattern, $asc, $alpha, $dest);
	function ttl($key);
	function type($key);
	function scan($cursor, $pattern = null, $count = null);

}
