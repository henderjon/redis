<?php

trait SortedSetMethodsTrait {

    const AGGREGATE_SUM = 101;
    const AGGREGATE_MIN = 102;
    const AGGREGATE_MAX = 103;

    protected $aggregates = [
        101 => "AGGREGATE SUM",
        102 => "AGGREGATE MIN",
        103 => "AGGREGATE MAX",
    ];

    const ZMIN = "-";
    const ZMAX = "+";

    /**
     * Add one or more members to a sorted set, or update its score if it already exists
     * @params key score member [score member ...]
     */
    function zadd($key, array $map) {
        if(count($map) < 2 || (count($map) % 2 != 0)){
            throw new RedisException("(" . __METHOD__ . ") At least one key is required.");
        }
        return $this->exec( $this->protocol( __METHOD__, $key, $map ) );
    }

    /**
     * Get the number of members in a sorted set
     * @params key
     */
    function zcard($key) {
        return $this->exec( $this->protocol( __METHOD__, $key ) );
    }

    /**
     * Count the members in a sorted set with scores within the given values
     * @params key min max
     */
    function zcount($key, $min, $max) {
        return $this->exec( $this->protocol( __METHOD__, $key, $min, $max ) );
    }

    /**
     * Increment the score of a member in a sorted set
     * @params key increment member
     */
    function zincrby($key, $incr, $member) {
        return $this->exec( $this->protocol( __METHOD__, $key, $incr, $member ) );
    }

    /**
     * Intersect multiple sorted sets and store the resulting sorted set in a new key
     * @params destination numkeys key [key ...] [WEIGHTS weight [weight ...]] [AGGREGATE SUM|MIN|MAX]
     */
    function zinterstore($dest, array $keys, array $weights = [1], $aggregate = static::AGGREGATE_SUM) {
        if(count($keys) < 1 ){
            throw new RedisException("(" . __METHOD__ . ") At least one key is required.");
        }

        $weight[] = "WEIGHTS";
        foreach($weights as $w){
            $weight[] = $w;
        }

        if($aggregate){
            if(!array_key_exists($aggregate, $this->aggregates)){
                throw new RedisException("(" . __METHOD__ . ") A valid aggregate is required.");
            }else{
                $aggregate = $this->aggregates[$aggregate];
            }
        }

        return $this->exec( $this->protocol( __METHOD__, $dest, count($keys), $keys, $weight, $aggregate ) );
    }

    /**
     * Count the number of members in a sorted set between a given lexicographical range
     * @params key min max
     */
    function zlexcount($key, $min, $max) {
        return $this->exec( $this->protocol( __METHOD__, $key, $min, $max ) );
    }

    /**
     * Return a range of members in a sorted set, by index
     * @params key start stop [WITHSCORES]
     */
    function zrange($key, $start, $stop, $withScores = false) {
        $withScores = $withScores ? "WITHSCORES" : "";
        return $this->exec( $this->protocol( __METHOD__, $key, $start, $stop, $withScores ) );
    }

    /**
     * Return a range of members in a sorted set, by lexicographical range
     * @params key min max [LIMIT offset count]
     */
    function zrangebylex($key, $min, $max, $offset = "", $count = "") {
        if($count && !$offset){
            throw new RedisException("(" . __METHOD__ . ") Both an `offest` and `count` are required.");
        }

        if($offset){
            $limit = ["LIMIT", $offset, $count];
        }
        return $this->exec( $this->protocol( __METHOD__, $key, $min, $max, $limit ) );
    }

    /**
     * Return a range of members in a sorted set, by lexicographical range, ordered from higher to lower strings.
     * @params key max min [LIMIT offset count]
     */
    function zrevrangebylex($key, $max, $min, $offset = "", $count = "") {
        if($count && !$offset){
            throw new RedisException("(" . __METHOD__ . ") Both an `offest` and `count` are required.");
        }

        if($offset){
            $limit = ["LIMIT", $offset, $count];
        }
        return $this->exec( $this->protocol( __METHOD__, $key, $max, $min, $limit ) );
    }

    /**
     * Return a range of members in a sorted set, by score
     * @params key min max [WITHSCORES] [LIMIT offset count]
     */
    function zrangebyscore($key, $min, $max, $withScores = false, $offset = "", $count = "") {
        if($count && !$offset){
            throw new RedisException("(" . __METHOD__ . ") Both an `offest` and `count` are required.");
        }

        $withScores = $withScores ? "WITHSCORES" : "";

        if($offset){
            $limit = ["LIMIT", $offset, $count];
        }
        return $this->exec( $this->protocol( __METHOD__, $key, $min, $max, $withScores, $limit ) );
    }

    /**
     * Determine the index of a member in a sorted set
     * @params key member
     */
    function zrank($key, $member) {
        return $this->exec( $this->protocol( __METHOD__, $key, $member ) );
    }

    /**
     * Remove one or more members from a sorted set
     * @params key member [member ...]
     */
    function zrem($key, array $members) {
        if(count($members) < 1 ){
            throw new RedisException("(" . __METHOD__ . ") At least one member is required.");
        }
        return $this->exec( $this->protocol( __METHOD__, $key, $members ) );
    }

    /**
     * Remove all members in a sorted set between the given lexicographical range
     * @params key min max
     */
    function zremrangebylex($key, $min, $max) {
        return $this->exec( $this->protocol( __METHOD__, $key, $min, $max ) );
    }

    /**
     * Remove all members in a sorted set within the given indexes
     * @params key start stop
     */
    function zremrangebyrank($key, $start, $stop) {
        return $this->exec( $this->protocol( __METHOD__, $key, $start, $stop ) );
    }

    /**
     * Remove all members in a sorted set within the given scores
     * @params key min max
     */
    function zremrangebyscore($key, $min, $max) {
        return $this->exec( $this->protocol( __METHOD__, $key, $min, $max ) );
    }

    /**
     * Return a range of members in a sorted set, by index, with scores ordered from high to low
     * @params key start stop [WITHSCORES]
     */
    function zrevrange($key, $start, $stop, $withScores) {
        return $this->exec( $this->protocol( __METHOD__, $key, $start, $stop, $withScores ) );
    }

    /**
     * Return a range of members in a sorted set, by score, with scores ordered from high to low
     * @params key max min [WITHSCORES] [LIMIT offset count]
     */
    function zrevrangebyscore($key, $max, $min, $withScores = false, $offset = "", $count = "") {
        if($count && !$offset){
            throw new RedisException("(" . __METHOD__ . ") Both an `offest` and `count` are required.");
        }

        $withScores = $withScores ? "WITHSCORES" : "";

        if($offset){
            $limit = ["LIMIT", $offset, $count];
        }
        return $this->exec( $this->protocol( __METHOD__, $key, $max, $min, $withScores, $limit ) );
    }

    /**
     * Determine the index of a member in a sorted set, with scores ordered from high to low
     * @params key member
     */
    function zrevrank($key, $member) {
        return $this->exec( $this->protocol( __METHOD__, $key, $member ) );
    }

    /**
     * Get the score associated with the given member in a sorted set
     * @params key member
     */
    function zscore($key, $member) {
        return $this->exec( $this->protocol( __METHOD__, $key, $member ) );
    }

    /**
     * Add multiple sorted sets and store the resulting sorted set in a new key
     * @params destination numkeys key [key ...] [WEIGHTS weight [weight ...]] [AGGREGATE SUM|MIN|MAX]
     */
    function zunionstore($dest, array $keys, array $weights = [1], $aggregate = static::AGGREGATE_SUM) {
        if(count($keys) < 1 ){
            throw new RedisException("(" . __METHOD__ . ") At least one key is required.");
        }

        $weight[] = "WEIGHTS";
        foreach($weights as $w){
            $weight[] = $w;
        }

        if($aggregate){
            if(!array_key_exists($aggregate, $this->aggregates)){
                throw new RedisException("(" . __METHOD__ . ") A valid aggregate is required.");
            }else{
                $aggregate = $this->aggregates[$aggregate];
            }
        }

        return $this->exec( $this->protocol( __METHOD__, $dest, count($keys), $keys, $weight, $aggregate ) );
    }

    /**
     * Incrementally iterate sorted sets elements and associated scores
     * @params key cursor [MATCH pattern] [COUNT count]
     */
    function zscan($key, $cursor, $pattern = "", $count = "") {
        $pattern = $pattern ? "MATCH {$pattern}" : "";
        $count   = $count   ? "COUNT {$count}"   : "";
        return $this->exec( $this->protocol( __METHOD__, $key, $cursor, $pattern, $count ) );
    }


}