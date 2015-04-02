<?php

namespace Redis\Interfaces;

interface SortedSetMethodsInterface {

	function zadd($key, array $map);
	function zcard($key);
	function zcount($key, $min, $max);
	function zincrby($key, $incr, $member);
	function zinterstore($dest, array $keys, array $weights = [1], $aggregate = self::ZAGG_SUM);
	function zlexcount($key, $min, $max);
	function zrange($key, $start, $stop, $withScores = null);
	function zrangebylex($key, $min, $max, $offset = null, $count = null);
	function zrevrangebylex($key, $max, $min, $offset = null, $count = null);
	function zrangebyscore($key, $min, $max, $withScores = null, $offset = null, $count = null);
	function zrank($key, $member);
	function zrem($key, array $members);
	function zremrangebylex($key, $min, $max);
	function zremrangebyrank($key, $start, $stop);
	function zremrangebyscore($key, $min, $max);
	function zrevrange($key, $start, $stop, $withScores = null);
	function zrevrangebyscore($key, $max, $min, $withScores = null, $offset = null, $count = null);
	function zrevrank($key, $member);
	function zscore($key, $member);
	function zunionstore($dest, array $keys, array $weights = [1], $aggregate = self::ZAGG_SUM);
	function zscan($key, $cursor, $pattern = null, $count = null);

}