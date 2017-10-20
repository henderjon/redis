### Class: PubSubMethodsTrait \[ `\Redis\Traits` \]

#### Method: `PubSubMethodsTrait->psubscribe($patterns)`

Listen for messages published to channels matching the given patterns

for complete documentation: [redis.io/commands#pubsub](http://redis.io/commands#pubsub)

**args** pattern [pattern ...]

---

#### Method: `PubSubMethodsTrait->pubsubChannels([ $args = null])`

Inspect the state of the Pub/Sub subsystem

for complete documentation: [redis.io/commands#pubsub](http://redis.io/commands#pubsub)

**args** subcommand [argument [argument ...]]

---

#### Method: `PubSubMethodsTrait->pubsubNumsub([ $args = null])`

Inspect the state of the Pub/Sub subsystem

for complete documentation: [redis.io/commands#pubsub](http://redis.io/commands#pubsub)

**args** subcommand [argument [argument ...]]

---

#### Method: `PubSubMethodsTrait->pubsubNumpat([ $args = null])`

Inspect the state of the Pub/Sub subsystem

for complete documentation: [redis.io/commands#pubsub](http://redis.io/commands#pubsub)

**args** subcommand [argument [argument ...]]

---

#### Method: `PubSubMethodsTrait->publish($chan, $message)`

Post a message to a channel

for complete documentation: [redis.io/commands#pubsub](http://redis.io/commands#pubsub)

**args** channel message

---

#### Method: `PubSubMethodsTrait->punsubscribe([ $patterns = null])`

Stop listening for messages posted to channels matching the given patterns

for complete documentation: [redis.io/commands#pubsub](http://redis.io/commands#pubsub)

**args** [pattern [pattern ...]]

---

#### Method: `PubSubMethodsTrait->subscribe($channels)`

Listen for messages published to the given channels

for complete documentation: [redis.io/commands#pubsub](http://redis.io/commands#pubsub)

**args** channel [channel ...]

---

#### Method: `PubSubMethodsTrait->unsubscribe([ $channels = null])`

Stop listening for messages posted to the given channels

for complete documentation: [redis.io/commands#pubsub](http://redis.io/commands#pubsub)

**args** [channel [channel ...]]

