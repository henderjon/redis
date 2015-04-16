### Class: ClusterMethodsTrait \[ `\Redis\Traits` \]

#### Method: `ClusterMethodsTrait->clusterGetName()`

Assign new hash slots to receiving node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** ADDSLOTS slot [slot ...]

---

#### Method: `ClusterMethodsTrait->clusterAddSlots($slots)`

Assign new hash slots to receiving node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** ADDSLOTS slot [slot ...]

---

#### Method: `ClusterMethodsTrait->clusterCountFailureReports($node_id)`

Return the number of failure reports active for a given node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** COUNT-FAILURE-REPORTS node-id

---

#### Method: `ClusterMethodsTrait->clusterCountKeysInSlot($slot)`

Return the number of local keys in the specified hash slot

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** COUNTKEYSINSLOT slot

---

#### Method: `ClusterMethodsTrait->clusterDelSlots($slots)`

Set hash slots as unbound in receiving node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** DELSLOTS slot [slot ...]

---

#### Method: `ClusterMethodsTrait->clusterFailover()`

Forces a slave to perform a manual failover of its master.

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** FAILOVER [FORCE|TAKEOVER]

---

#### Method: `ClusterMethodsTrait->clusterFailoverForce()`

Forces a slave to perform a manual failover of its master.

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** FAILOVER [FORCE|TAKEOVER]

---

#### Method: `ClusterMethodsTrait->clusterFailoverTakeover()`

Forces a slave to perform a manual failover of its master.

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** FAILOVER [FORCE|TAKEOVER]

---

#### Method: `ClusterMethodsTrait->clusterForget($node_id)`

Remove a node from the nodes table

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** FORGET node-id

---

#### Method: `ClusterMethodsTrait->clusterGetKeysInSlot($slot, $count)`

Return local key names in the specified hash slot

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** GETKEYSINSLOT slot count

---

#### Method: `ClusterMethodsTrait->clusterInfo()`

Provides info about Redis Cluster node state

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** INFO

---

#### Method: `ClusterMethodsTrait->clusterKeySlot($key)`

Returns the hash slot of the specified key

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** KEYSLOT key

---

#### Method: `ClusterMethodsTrait->clusterMeet($ip, $port)`

Force a node cluster to handshake with another node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** MEET ip port

---

#### Method: `ClusterMethodsTrait->clusterNodes()`

Get Cluster config for the node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** NODES

---

#### Method: `ClusterMethodsTrait->clusterReplicate($node_id)`

Reconfigure a node as a slave of the specified master node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** REPLICATE node-id

---

#### Method: `ClusterMethodsTrait->clusterReset([ $hard = false])`

Reset a Redis Cluster node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** RESET [HARD|SOFT]

---

#### Method: `ClusterMethodsTrait->clusterSaveConfig()`

Forces the node to save cluster state on disk

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** SAVECONFIG

---

#### Method: `ClusterMethodsTrait->clusterSetConfigEpoch($epoch)`

Set the configuration epoch in a new node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** SET-CONFIG-EPOCH config-epoch

---

#### Method: `ClusterMethodsTrait->clusterSetSlot($slot, $status, $node_id)`

Bind an hash slot to a specific node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** SETSLOT slot IMPORTING|MIGRATING|STABLE|NODE [node-id]

---

#### Method: `ClusterMethodsTrait->clusterSlaves($node_id)`

List slave nodes of the specified master node

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** SLAVES node-id

---

#### Method: `ClusterMethodsTrait->clusterSlots()`

Get array of Cluster slot to node mappings

for complete documentation: [redis.io/commands#cluster](http://redis.io/commands#cluster)

**args** SLOTS