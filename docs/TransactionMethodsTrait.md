### Class: TransactionMethodsTrait \[ `\Redis\Traits` \]

#### Method: `TransactionMethodsTrait->discard()`

Discard all commands issued after MULTI

for complete documentation: [redis.io/commands#transactions](http://redis.io/commands#transactions)

---

#### Method: `TransactionMethodsTrait->exec()`

Execute all commands issued after MULTI

for complete documentation: [redis.io/commands#transactions](http://redis.io/commands#transactions)

---

#### Method: `TransactionMethodsTrait->multi()`

Mark the start of a transaction block

for complete documentation: [redis.io/commands#transactions](http://redis.io/commands#transactions)

---

#### Method: `TransactionMethodsTrait->unwatch()`

Forget about all watched keys

for complete documentation: [redis.io/commands#transactions](http://redis.io/commands#transactions)

---

#### Method: `TransactionMethodsTrait->watch($keys)`

Watch the given keys to determine execution of the MULTI/EXEC block

for complete documentation: [redis.io/commands#transactions](http://redis.io/commands#transactions)