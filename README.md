# henderjon/redis

a simple and (in)complete redis library

Peruse the tests or, if present, the examples directory to see usage.

[![Latest Stable Version](https://poser.pugx.org/henderjon/redis/v/stable.svg)](https://packagist.org/packages/henderjon/redis)
[![Build Status](https://travis-ci.org/henderjon/redis.svg?branch=master)](https://travis-ci.org/henderjon/redis)

## RedisProtocol

`RedisProtocol` is responsible for holding a connection to a Redis server,
translating PHP functions/args into the Redis
[protocol](http://redis.io/topics/protocol), and reading/writing to the
connection. It allows for [pipelining](http://redis.io/topics/pipelining) (via
`pipe()`) and uses `__call()` to allow for the variability in Redis function
names and arguments. Extending `RedisProtocol` is simple and effective if
you're 1) not interested in [pub/sub](http://redis.io/topics/pubsub) and 2)
familiar with Redis.

## RedisSubscription

`RedisSubscription` is a wrapper/shorthand to the
[pub/sub](http://redis.io/topics/pubsub) model of Redis and returns lambdas
that allow for looping/listening as part of a subscription
([example](example/sub.php)). Extend `RedisSubscription` to get all of
`RedisProtocol` + pub/sub in PHP.

## RedisExceptions

All exceptions thrown are RedisExceptions.

## Redis

The `Redis` class implements all\** the methods that Redis has available as of
v3.0 and has a few constants for those instances where keywords are used as
switches within a Redis function. It composes a series of traits that
represent the divisions present in the Redis [command documentation](http://redis.io/commands).

Interfaces are included--also broken into sections via the Redis command documentation.
This allows the usage of individual traits/interfaces if only a subset of Redis
functionality is desired.

I would recommend against using the `PubSubTrait` methods as
`RedisSubscription` abstracts a lot of the dirty work.

There are a few instances where one Redis function has been broken into two or
more PHP functions as Redis uses some keywords as arguments. For example
`bitop` has been broken into `Redis::bitopAnd()`, `Redis::bitopOr()`,
`Redis::bitopXor()`, `Redis::bitopNot()` for (potentially) clearer PHP
implementation(s).

\**There are a handful of exceptions: `Redis::clusterSetSlot()`,
`Redis::echo()`, and `Redis::sort()`

I recommend looking through the code and the examples. However, I've auto
generated some [documentation](docs/README.md) for your delight and
edification.




















































