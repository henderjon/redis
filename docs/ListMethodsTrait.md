### Class: ListMethodsTrait \[ `\Redis\Traits` \]

#### Method: `ListMethodsTrait->blpop($key, $keys, $timeout)`

Remove and get the first element in a list, or block until one is available

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->brpop($key, $keys, $timeout)`

Remove and get the last element in a list, or block until one is available

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->brpoplpush($source, $destination, $timeout)`

Pop a value from a list, push it to another list and return it; or block until one is available

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->lindex($key, $index)`

Get an element from a list by its index

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->linsert($key, $pivot, $value [, $before = true])`

Insert an element before or after another element in a list

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->llen($key)`

Get the length of a list

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->lpop($key)`

Remove and get the first element in a list

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->lpush($key, $values)`

Prepend one or multiple values to a list

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->lpushx($key, $value)`

Prepend a value to a list, only if the list exists

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->lrange($key, $start, $stop)`

Get a range of elements from a list

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->lrem($key, $count, $value)`

Remove elements from a list

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->lset($key, $index, $value)`

Set the value of an element in a list by its index

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->ltrim($key, $start, $stop)`

Trim a list to the specified range

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->rpop($key)`

Remove and get the last element in a list

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->rpoplpush($source, $destination)`

Remove the last element in a list, prepend it to another list and return it

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->rpush($key, $values)`

Append one or multiple values to a list

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

---

#### Method: `ListMethodsTrait->rpushx($key, $value)`

Append a value to a list, only if the list exists

for complete documentation: [redis.io/commands#list](http://redis.io/commands#list)

