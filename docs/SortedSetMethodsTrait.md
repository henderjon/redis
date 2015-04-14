### Class: SortedSetMethodsTrait \[ `\Redis\Traits` \]

#### Method: `SortedSetMethodsTrait->zadd($key, $map)`

Add one or more members to a sorted set, or update its score if it already exists
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zcard($key)`

Get the number of members in a sorted set
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zcount($key, $min, $max)`

Count the members in a sorted set with scores within the given values
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zincrby($key, $incr, $member)`

Increment the score of a member in a sorted set
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zinterstore($dest, $keys [, $weights = array(1) [, $aggregate = self::ZAGG_SUM]])`

Intersect multiple sorted sets and store the resulting sorted set in a new key
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zlexcount($key, $min, $max)`

Count the number of members in a sorted set between a given lexicographical range
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zrange($key, $start, $stop [, $withScores = null])`

Return a range of members in a sorted set, by index
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zrangebylex($key, $min, $max [, $offset = null [, $count = null]])`

Return a range of members in a sorted set, by lexicographical range
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zrevrangebylex($key, $max, $min [, $offset = null [, $count = null]])`

Return a range of members in a sorted set, by lexicographical range, ordered from higher to lower strings.
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zrangebyscore($key, $min, $max [, $withScores = null [, $offset = null [, $count = null]]])`

Return a range of members in a sorted set, by score
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zrank($key, $member)`

Determine the index of a member in a sorted set
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zrem($key, $members)`

Remove one or more members from a sorted set
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zremrangebylex($key, $min, $max)`

Remove all members in a sorted set between the given lexicographical range
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zremrangebyrank($key, $start, $stop)`

Remove all members in a sorted set within the given indexes
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zremrangebyscore($key, $min, $max)`

Remove all members in a sorted set within the given scores
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zrevrange($key, $start, $stop [, $withScores = null])`

Return a range of members in a sorted set, by index, with scores ordered from high to low
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zrevrangebyscore($key, $max, $min [, $withScores = null [, $offset = null [, $count = null]]])`

Return a range of members in a sorted set, by score, with scores ordered from high to low
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zrevrank($key, $member)`

Determine the index of a member in a sorted set, with scores ordered from high to low
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zscore($key, $member)`

Get the score associated with the given member in a sorted set
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zunionstore($dest, $keys [, $weights = array(1) [, $aggregate = self::ZAGG_SUM]])`

Add multiple sorted sets and store the resulting sorted set in a new key
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

---

#### Method: `SortedSetMethodsTrait->zscan($key, $cursor [, $pattern = null [, $count = null]])`

Incrementally iterate sorted sets elements and associated scores
for complete documentation: [redis.io/commands#sorted_set](http://redis.io/commands#sorted_set)

