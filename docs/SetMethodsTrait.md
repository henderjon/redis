### Class: SetMethodsTrait \[ `\Redis\Traits` \]

#### Method: `SetMethodsTrait->sadd($key, $members)`

Add one or more members to a set

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)

**args** key member [member ...]

---

#### Method: `SetMethodsTrait->scard($key)`

Get the number of members in a set

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->sdiff($keys)`

Subtract multiple sets

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->sdiffstore($dest, $keys)`

Subtract multiple sets and store the resulting set in a key

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->sinter($keys)`

Intersect multiple sets

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->sinterstore($dest, $keys)`

Intersect multiple sets and store the resulting set in a key

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->sismember($key, $member)`

Determine if a given value is a member of a set

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->smembers($key)`

Get all the members in a set

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->smove($source, $dest, $member)`

Move a member from one set to another

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->spop($key [, $count = 1])`

Remove and return one or multiple random members from a set

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->srandmember($key [, $count = 1])`

Get one or multiple random members from a set

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->srem($key, $members)`

Remove one or more members from a set

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->sunion($keys)`

Add multiple sets

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->sunionstore($dest, $keys)`

Add multiple sets and store the resulting set in a key

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


---

#### Method: `SetMethodsTrait->sscan($key, $cursor [, $pattern = null [, $count = null]])`

Incrementally iterate Set elements

for complete documentation: [redis.io/commands#set](http://redis.io/commands#set)


