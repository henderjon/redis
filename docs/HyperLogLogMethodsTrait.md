### Class: HyperLogLogMethodsTrait \[ `\Redis\Traits` \]

#### Method: `HyperLogLogMethodsTrait->pfadd($key, $elements)`

Adds the specified elements to the specified HyperLogLog.

for complete documentation: [redis.io/commands#hyperloglog](http://redis.io/commands#hyperloglog)

**args** key element [element ...]

---

#### Method: `HyperLogLogMethodsTrait->pfcount($keys)`

Return the approximated cardinality of the set(s) observed by the HyperLogLog at key(s).

for complete documentation: [redis.io/commands#hyperloglog](http://redis.io/commands#hyperloglog)

**args** key [key ...]

---

#### Method: `HyperLogLogMethodsTrait->pfmerge($dest, $sources)`

Merge N different HyperLogLogs into a single one.

for complete documentation: [redis.io/commands#hyperloglog](http://redis.io/commands#hyperloglog)

**args** destkey sourcekey [sourcekey ...]

