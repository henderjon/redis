<?php

namespace Redis\Traits;

use Redis\RedisException;

trait SortedSetMethodsTrait {

	abstract protected function protocol(array $args);
	abstract protected function exe($string, $count = 1);

	abstract protected function getZagg($zagg);

	/**
	 * Add one or more members to a sorted set, or update its score if it already exists
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key score member [score member ...]
	 */
	public function zadd($key, array $map) {
		if(count($map) < 2 || (count($map) % 2 != 0)){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $map ]) );
	}

	/**
	 * Get the number of members in a sorted set
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key
	 */
	public function zcard($key) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key ]) );
	}

	/**
	 * Count the members in a sorted set with scores within the given values
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key min max
	 */
	public function zcount($key, $min, $max) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $min, $max ]) );
	}

	/**
	 * Increment the score of a member in a sorted set
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key increment member
	 */
	public function zincrby($key, $incr, $member) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $incr, $member ]) );
	}

	/**
	 * Intersect multiple sorted sets and store the resulting sorted set in a new key
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params destination numkeys key [key ...] [WEIGHTS weight [weight ...]] [AGGREGATE SUM|MIN|MAX]
	 */
	public function zinterstore($dest, array $keys, array $weights = [], $aggregate = self::ZAGG_SUM) {
		if(count($keys) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		$weight = [];
		if($weights){
			if(count($keys) != count($weights) ){
				throw new RedisException("(" . __FUNCTION__ . ") The number of weights provided should be equal to the number of keys.");
			}

			$weight = ["WEIGHTS"];
			foreach($weights as $w){
				$weight[] = $w;
			}
		}

		if(!($aggregate = $this->getZagg($aggregate))){
			throw new RedisException("(" . __FUNCTION__ . ") A valid aggregate is required.");
		}

		$aggregate = ["AGGREGATE", $aggregate];

		return $this->exe( $this->protocol([ __FUNCTION__, $dest, count($keys), $keys, $weight, $aggregate ]) );
	}

	/**
	 * Count the number of members in a sorted set between a given lexicographical range
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key min max
	 */
	public function zlexcount($key, $min, $max) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $min, $max ]) );
	}

	/**
	 * Return a range of members in a sorted set, by index
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key start stop [WITHSCORES]
	 */
	public function zrange($key, $start, $stop, $withScores = null) {
		$withScores = $withScores ? "WITHSCORES" : null;
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $start, $stop, $withScores ]) );
	}

	/**
	 * Return a range of members in a sorted set, by lexicographical range
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key min max [LIMIT offset count]
	 */
	public function zrangebylex($key, $min, $max, $offset = null, $count = null) {
		if($count && !$offset){
			throw new RedisException("(" . __FUNCTION__ . ") Both an `offest` and `count` are required.");
		}

		if($offset){
			$offset = ["LIMIT", $offset, $count];
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $min, $max, $offset ]) );
	}

	/**
	 * Return a range of members in a sorted set, by lexicographical range, ordered from higher to lower strings.
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key max min [LIMIT offset count]
	 */
	public function zrevrangebylex($key, $max, $min, $offset = null, $count = null) {
		if($count && !$offset){
			throw new RedisException("(" . __FUNCTION__ . ") Both an `offest` and `count` are required.");
		}

		if($offset){
			$offset = ["LIMIT", $offset, $count];
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $max, $min, $offset ]) );
	}

	/**
	 * Return a range of members in a sorted set, by score
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key min max [WITHSCORES] [LIMIT offset count]
	 */
	public function zrangebyscore($key, $min, $max, $withScores = null, $offset = null, $count = null) {
		if($count && !$offset){
			throw new RedisException("(" . __FUNCTION__ . ") Both an `offest` and `count` are required.");
		}

		$withScores = $withScores ? "WITHSCORES" : null;

		if($offset){
			$offset = ["LIMIT", $offset, $count];
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $min, $max, $withScores, $offset ]) );
	}

	/**
	 * Determine the index of a member in a sorted set
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key member
	 */
	public function zrank($key, $member) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $member ]) );
	}

	/**
	 * Remove one or more members from a sorted set
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key member [member ...]
	 */
	public function zrem($key, array $members) {
		if(count($members) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one member is required.");
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $members ]) );
	}

	/**
	 * Remove all members in a sorted set between the given lexicographical range
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key min max
	 */
	public function zremrangebylex($key, $min, $max) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $min, $max ]) );
	}

	/**
	 * Remove all members in a sorted set within the given indexes
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key start stop
	 */
	public function zremrangebyrank($key, $start, $stop) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $start, $stop ]) );
	}

	/**
	 * Remove all members in a sorted set within the given scores
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key min max
	 */
	public function zremrangebyscore($key, $min, $max) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $min, $max ]) );
	}

	/**
	 * Return a range of members in a sorted set, by index, with scores ordered from high to low
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key start stop [WITHSCORES]
	 */
	public function zrevrange($key, $start, $stop, $withScores = null) {
		$withScores = $withScores ? "WITHSCORES" : null;
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $start, $stop, $withScores ]) );
	}

	/**
	 * Return a range of members in a sorted set, by score, with scores ordered from high to low
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key max min [WITHSCORES] [LIMIT offset count]
	 */
	public function zrevrangebyscore($key, $max, $min, $withScores = null, $offset = null, $count = null) {
		if($count && !$offset){
			throw new RedisException("(" . __FUNCTION__ . ") Both an `offest` and `count` are required.");
		}

		$withScores = $withScores ? "WITHSCORES" : null;

		if($offset){
			$offset = ["LIMIT", $offset, $count];
		}
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $max, $min, $withScores, $offset ]) );
	}

	/**
	 * Determine the index of a member in a sorted set, with scores ordered from high to low
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key member
	 */
	public function zrevrank($key, $member) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $member ]) );
	}

	/**
	 * Get the score associated with the given member in a sorted set
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key member
	 */
	public function zscore($key, $member) {
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $member ]) );
	}

	/**
	 * Add multiple sorted sets and store the resulting sorted set in a new key
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params destination numkeys key [key ...] [WEIGHTS weight [weight ...]] [AGGREGATE SUM|MIN|MAX]
	 */
	public function zunionstore($dest, array $keys, array $weights = [1], $aggregate = self::ZAGG_SUM) {
		if(count($keys) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one key is required.");
		}

		$weight = ["WEIGHTS"];
		foreach($weights as $w){
			$weight[] = $w;
		}

		if(!($aggregate = $this->getZagg($aggregate))){
			throw new RedisException("(" . __FUNCTION__ . ") A valid aggregate is required.");
		}

		$aggregate = ["AGGREGATE", $aggregate];

		return $this->exe( $this->protocol([ __FUNCTION__, $dest, count($keys), $keys, $weight, $aggregate ]) );
	}

	/**
	 * Incrementally iterate sorted sets elements and associated scores
	 * for complete documentation: http://redis.io/commands#sorted_set
	 * @params key cursor [MATCH pattern] [COUNT count]
	 */
	public function zscan($key, $cursor, $pattern = null, $count = null) {
		$pattern = $pattern ? ["MATCH", $pattern] : null;
		$count   = $count   ? ["COUNT", $count]   : null;
		return $this->exe( $this->protocol([ __FUNCTION__, $key, $cursor, $pattern, $count ]) );
	}


}
