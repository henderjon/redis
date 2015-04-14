### Class: StringMethodsTrait \[ `\Redis\Traits` \]



#### Undocumented Method: `StringMethodsTrait->getExpx($expx)`
#### Undocumented Method: `StringMethodsTrait->getNxxx($expx)`

---

#### Method: `StringMethodsTrait->append($key, $value)`

Append a value to a key

---

#### Method: `StringMethodsTrait->bitcount($key [, $start = null [, $end = null]])`

Count set bits in a string
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->bitopAnd($destkey, $keys)`

Perform bitwise operations between strings
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->bitopOr($destkey, $keys)`

Perform bitwise operations between strings
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->bitopXor($destkey, $keys)`

Perform bitwise operations between strings
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->bitopNot($destkey, $keys)`

Perform bitwise operations between strings
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->bitpos($key, $bit [, $start = null [, $end = null]])`

Find first bit set or clear in a string
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->decr($key)`

Decrement the integer value of a key by one
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->decrby($key, $decr)`

Decrement the integer value of a key by the given number
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->get($key)`

Get the value of a key
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->getbit($key, $offset)`

Returns the bit value at offset in the string value stored at key
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->getrange($key, $start, $end)`

Get a substring of the string stored at a key
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->getset($key, $value)`

Set the string value of a key and return its old value
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->incr($key)`

Increment the integer value of a key by one
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->incrby($key, $incr)`

Increment the integer value of a key by the given amount
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->incrbyfloat($key, $incr)`

Increment the float value of a key by the given amount
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->mget($keys)`

Get the values of all the given keys
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->mset($map)`

Set multiple keys to multiple values
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->msetnx($map)`

Set multiple keys to multiple values, only if none of the keys exist
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->psetex($key, $milliseconds, $value)`

Set the value and expiration in milliseconds of a key
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->set($key, $value [, $expire = null [, $expx = null [, $nxxx = null]]])`

Set the string value of a key
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->setbit($key, $offset, $value)`

Sets or clears the bit at offset in the string value stored at key
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->setex($key, $seconds, $value)`

Set the value and expiration of a key
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->setnx($key, $value)`

Set the value of a key, only if the key does not exist
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->setrange($key, $offset, $value)`

Overwrite part of a string at key starting at the specified offset
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

---

#### Method: `StringMethodsTrait->strlen($key)`

Get the length of the value stored in a key
for complete documentation: [redis.io/commands#string](http://redis.io/commands#string)

