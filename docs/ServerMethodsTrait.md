### Class: ServerMethodsTrait \[ `\Redis\Traits` \]

#### Method: `ServerMethodsTrait->bgrewriteaof()`

Asynchronously rewrite the append-only file

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->bgsave()`

Asynchronously save the dataset to disk

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->clientKillAddr($ip [, $skipme = true])`

Kill the connection of a client

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->clientKillId($id [, $skipme = true])`

Kill the connection of a client

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->clientKillType($type [, $skipme = true])`

Kill the connection of a client

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->clientList()`

Get the list of client connections

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->clientGetName()`

Get the current connection name

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->clientPause($timeout)`

Stop processing commands from clients for some time

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->clientSetName($name)`

Set the current connection name

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->command()`

Get array of Redis command details

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->commandCount()`

Get total number of Redis commands

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->commandGetKeys()`

Extract keys given a full Redis command

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->commandInfo($commands)`

Get array of specific Redis command details

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->configGet($param)`

Get the value of a configuration parameter

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->configRewrite()`

Rewrite the configuration file with the in memory configuration

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->configSet($param, $value)`

Set a configuration parameter to the given value

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->configResetStat()`

Reset the stats returned by INFO

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->dbsize()`

Return the number of keys in the selected database

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->debugObject($key)`

Get debugging information about a key

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->debugSegFault()`

Make the server crash

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->flushall()`

Remove all keys from all databases

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->flushdb()`

Remove all keys from the current database

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->info([ $section = null])`

Get information and statistics about the server

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->lastsave()`

Get the UNIX time stamp of the last successful save to disk

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->monitor()`

Listen for all requests received by the server in real time

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->role()`

Return the role of the instance in the context of replication

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->save()`

Synchronously save the dataset to disk

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->shutdown()`

Synchronously save the dataset to disk and then shut down the server

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->shutdownSave()`

Synchronously save the dataset to disk and then shut down the server

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->shutdownNoSave()`

Synchronously save the dataset to disk and then shut down the server

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->slaveof($host, $port)`

Make the server a slave of another instance, or promote it as master

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->slowlog($subcommand [, $arg = null])`

Manages the Redis slow queries log

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->sync()`

Internal command used for replication

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

---

#### Method: `ServerMethodsTrait->time()`

Return the current server time

for complete documentation: [redis.io/commands#server](http://redis.io/commands#server)

