### Class: KeyMethodsTrait \[ `\Redis\Traits` \]

#### Method: `KeyMethodsTrait->del($keys)`

Delete a key
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key [key .
..]

---

#### Method: `KeyMethodsTrait->dump($key)`

Return a serialized version of the value stored at the specified key.
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key

---

#### Method: `KeyMethodsTrait->exists($key)`

Determine if a key exists
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key

---

#### Method: `KeyMethodsTrait->expire($key, $seconds)`

Set a key's time to live in seconds
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key seconds

---

#### Method: `KeyMethodsTrait->expireat($key, $timestamp)`

Set the expiration for a key as a UNIX timestamp
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key timestamp

---

#### Method: `KeyMethodsTrait->keys($pattern)`

Find all keys matching the given pattern
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
pattern

---

#### Method: `KeyMethodsTrait->migrate($host, $port, $key, $dest, $timeout)`

Atomically transfer a key from a Redis instance to another one.
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
host port key destination-db timeout [COPY] [REPLACE]

---

#### Method: `KeyMethodsTrait->move($key, $db)`

Move a key to another database
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key db

---

#### Method: `KeyMethodsTrait->objectRefcount($keys)`

Inspect the internals of Redis objects
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
returns the number of references of the value associated with the specified key. This command is mainly useful for debugging.
subcommand [arguments [arguments ...]]

---

#### Method: `KeyMethodsTrait->objectEncoding($keys)`

Inspect the internals of Redis objects
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
returns the kind of internal representation used in order to store the value associated with a key.
subcommand [arguments [arguments ...]]

---

#### Method: `KeyMethodsTrait->objectIdletime($keys)`

Inspect the internals of Redis objects
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
returns the number of seconds since the object stored at the specified key is idle (not requested by read or write operations).
While the value is returned in seconds the actual resolution of this timer is 10 seconds, but may vary in future implementations.
subcommand [arguments [arguments ...]]

---

#### Method: `KeyMethodsTrait->persist($key)`

Remove the expiration from a key
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key

---

#### Method: `KeyMethodsTrait->pexpire($key, $milliseconds)`

Set a key's time to live in milliseconds
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key milliseconds

---

#### Method: `KeyMethodsTrait->pexpireat($key, $timestamp)`

Set the expiration for a key as a UNIX timestamp specified in milliseconds
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key milliseconds-timestamp

---

#### Method: `KeyMethodsTrait->pttl($key)`

Get the time to live for a key in milliseconds
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key

---

#### Method: `KeyMethodsTrait->randomkey()`

Return a random key from the keyspace
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)

---

#### Method: `KeyMethodsTrait->rename($key, $newKey)`

Rename a key
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key newkey

---

#### Method: `KeyMethodsTrait->renamenx($key, $newKey)`

Rename a key, only if the new key does not exist
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key newkey

---

#### Method: `KeyMethodsTrait->restore($key, $ttl, $serialValue [, $replace = true])`

Create a key using the provided serialized value, previously obtained using DUMP.
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key ttl serialized-value [REPLACE]

---

#### Method: `KeyMethodsTrait->sort($key, $by, $offset, $count, $pattern, $asc, $alpha, $dest)`

Sort the elements in a list, set or sorted set
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key [BY pattern] [LIMIT offset count] [GET pattern [GET pattern .
..]] [ASC|DESC] [ALPHA] [STORE destination]

---

#### Method: `KeyMethodsTrait->ttl($key)`

Get the time to live for a key
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key

---

#### Method: `KeyMethodsTrait->type($key)`

Determine the type stored at key
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
key

---

#### Method: `KeyMethodsTrait->scan($cursor [, $pattern = null [, $count = null]])`

Incrementally iterate the keys space
for complete documentation: [redis.io/commands#generic](http://redis.io/commands#generic)
cursor [MATCH pattern] [COUNT count]

