### Class: HashMethodsTrait \[ `\Redis\Traits` \]

#### Method: `HashMethodsTrait->hdel($key, $fields)`

Delete one or more hash fields
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field [field .
..]

---

#### Method: `HashMethodsTrait->hexists($key, $field)`

Determine if a hash field exists
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field

---

#### Method: `HashMethodsTrait->hget($key, $field)`

Get the value of a hash field
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field

---

#### Method: `HashMethodsTrait->hgetall($key)`

Get all the fields and values in a hash
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key

---

#### Method: `HashMethodsTrait->hincrby($key, $field, $incr)`

Increment the integer value of a hash field by the given number
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field increment

---

#### Method: `HashMethodsTrait->hincrbyfloat($key, $field, $incr)`

Increment the float value of a hash field by the given amount
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field increment

---

#### Method: `HashMethodsTrait->hkeys($key)`

Get all the fields in a hash
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key

---

#### Method: `HashMethodsTrait->hlen($key)`

Get the number of fields in a hash
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key

---

#### Method: `HashMethodsTrait->hmget($key, $fields)`

Get the values of all the given hash fields
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field [field .
..]

---

#### Method: `HashMethodsTrait->hmset($key, $map)`

Set multiple hash fields to multiple values
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field value [field value .
..]

---

#### Method: `HashMethodsTrait->hset($key, $field, $value)`

Set the string value of a hash field
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field value

---

#### Method: `HashMethodsTrait->hsetnx($key, $field, $value)`

Set the value of a hash field, only if the field does not exist
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field value

---

#### Method: `HashMethodsTrait->hstrlen($key, $field)`

Get the length of the value of a hash field
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key field

---

#### Method: `HashMethodsTrait->hvals($key)`

Get all the values in a hash
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key

---

#### Method: `HashMethodsTrait->hscan($key, $cursor [, $pattern = null [, $count = null]])`

Incrementally iterate hash fields and associated values
for complete documentation: [redis.io/commands#hash](http://redis.io/commands#hash)
key cursor [MATCH pattern] [COUNT count]

