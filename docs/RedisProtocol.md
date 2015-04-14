### Class: RedisProtocol \[ `\Redis` \]

Class to talk to redis at a low level ... http://redis.io/topics/protocol

#### Method: `RedisProtocol->connect($ip, $port, $timeout)`

Connect to a Redis instance. This isn't in the constructor so
that the tests can instantiate this object and replace the
socket handle.

##### Parameters:

- ***string*** `$ip` - The IP of the Redis instance
- ***string*** `$port` - The port of the Redis instance
- ***int*** `$timeout` - The number of seconds to wait when connecting

##### Returns:

- ***\Redis\Redis***

---

#### Method: `RedisProtocol->__call($func, $args)`

Catch all calls to Redis functions and pass them to the underlying
connection

##### Parameters:

- ***string*** `$func` - The function name
- ***mixed*** `$args` - The string(s) or array(s) of the arguments

##### Returns:

- ***mixed***

---

#### Method: `RedisProtocol->pipe()`

Take an array of arrays of mixed string/arrays and pipe them all
to Redis. Since Protocol::protocol takes strings and arrays and
assumes that they're all one specific command, this funciton takes
an array of those.

##### Returns:

- ***mixed***

---

#### Method: `RedisProtocol->marshal($array)`

method to take an indexed array and transform it to an associatvie array.

##### Parameters:

- ***mixed*** `$array` - The indexed array

##### Returns:

- ***array***

---

#### Method: `RedisProtocol->unmarshal($array)`

method to take an associatvie array and transform it to an indexed array.

##### Parameters:

- ***mixed*** `$array` - The indexed array

##### Returns:

- ***array***