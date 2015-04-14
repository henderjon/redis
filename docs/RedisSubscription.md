### Class: RedisSubscription \[ `\Redis` \]

use the Redis "subscribe" feature

#### Method: `RedisSubscription->subscribeTo($channels)`

subscribe to channel(s)

##### Parameters:

- ***array*** `$channels` - An array of channels to subscribe to

##### Returns:

- ***array***

---

#### Method: `RedisSubscription->pSubscribeTo($channels)`

subscribe to channel(s)

##### Parameters:

- ***array*** `$channels` - An array of channels to subscribe to

##### Returns:

- ***array***

---

#### Method: `RedisSubscription->setTimeout($sec, $micro)`

set the socket timeout for quiet/long lived sub channels

##### Parameters:

- ***int*** `$sec` - the number of whole seconds
- ***float*** `$micro` - the number of micro seconds

##### Returns:

- ***bool***

---