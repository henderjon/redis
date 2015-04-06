<?php

namespace Redis\Interfaces;

interface SetMethodsInterface {

	function sadd($key, array $members);
	function scard($key);
	function sdiff(array $keys);
	function sdiffstore($dest, array $keys);
	function sinter(array $keys);
	function sinterstore($dest, array $keys);
	function sismember($key, $member);
	function smembers($key);
	function smove($source, $dest, $member);
	function spop($key, $count = 1);
	function srandmember($key, $count = 1);
	function srem($key, array $members);
	function sunion(array $keys);
	function sunionstore($dest, array $keys);
	function sscan($key, $cursor, $pattern = null, $count = null);

}
