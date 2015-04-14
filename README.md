# henderjon/redis

a simple and (in)complete redis library

Peruse the tests or, if present, the examples directory to see usage.

[![Latest Stable Version](https://poser.pugx.org/henderjon/redis/v/stable.svg)](https://packagist.org/packages/henderjon/redis)
[![Build Status](https://travis-ci.org/henderjon/redis.svg?branch=master)](https://travis-ci.org/henderjon/redis)

`RedisProtocol` is responsible for holding a connection to a Redis server, translating PHP functions/args into
the Redis protocol, and reading/writing to the connection. It allows for piping and uses __call() to allow
for the variability in Redis function names and argument lists. Extending `RedisProtocol` is simple and effective if you're
1) not interested in pub/sub and 2) familiar with Redis.

`RedisSubscription` are shortcuts to the pub/sub model of Redis and return lambdas that allow for looping/listening
as part of a subscription ([example](example/sub.php)). Extend `RedisSubscription` to get a pub/sub in PHP.

All exceptions thrown are RedisExceptions.

The `Redis` class has a few constants for those instances where keywords are used as switches within a Redis function.
Beyond that, it composes a series of traits. These traits represent the divisions present in the Redis [documentation](http://redis.io/commands).

Interfaces are included--also broken into sections via the Redis Command docs. This allows the usage of individual traits if only a subset of Redis
functionality is desired.

This lib implements all\** the methods that Redis has available as of v3.0. However, there are a few instances where one Redis
function has been broken into two or more PHP functions as Redis uses some keywords as arguments. For example `bitop` has been broken into
`Redis::bitopAnd()`, `Redis::bitopOr()`, `Redis::bitopXor()`, `Redis::bitopNot()` for (potentially) clearer PHP implementation.

I would recommend against using the `PubSubTrait` methods as `RedisSubscription` abstracts a lot of the dirty work.

\**There are a handful of exceptions: `Redis::clusterSetSlot()`, `Redis::echo()`, and `Redis::sort()`

I recommend looking through the code and the examples. However, I've auto generated some [documentation](docs/README.md) for your
delight and edification.




















































