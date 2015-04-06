<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ClusterMethodsTrait {

	abstract protected function protocol(array $args);
	abstract protected function exe($string, $count = 1);

	/**
	 * Assign new hash slots to receiving node
	 * for complete documentation: http://redis.io/commands#cluster
	 * ADDSLOTS slot [slot ...]
	 */
	public function clusterGetName() {
		return $this->exe( $this->protocol([ "cluster", "getname" ]) );
	}

	/**
	 * Assign new hash slots to receiving node
	 * for complete documentation: http://redis.io/commands#cluster
	 * ADDSLOTS slot [slot ...]
	 */
	public function clusterAddSlots(array $slots) {
		if(count($slots) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one slot is required.");
		}
		return $this->exe( $this->protocol([ "cluster", "addslots", $slots ]) );
	}

	/**
	 * Return the number of failure reports active for a given node
	 * for complete documentation: http://redis.io/commands#cluster
	 * COUNT-FAILURE-REPORTS node-id
	 */
	public function clusterCountFailureReports($node_id) {
		return $this->exe( $this->protocol([ "cluster", "count-failure-reports", $node_id ]) );
	}

	/**
	 * Return the number of local keys in the specified hash slot
	 * for complete documentation: http://redis.io/commands#cluster
	 * COUNTKEYSINSLOT slot
	 */
	public function clusterCountKeysInSlot($slot) {
		return $this->exe( $this->protocol([ "cluster", "countkeysinslot", $slot ]) );
	}

	/**
	 * Set hash slots as unbound in receiving node
	 * for complete documentation: http://redis.io/commands#cluster
	 * DELSLOTS slot [slot ...]
	 */
	public function clusterDelSlots(array $slots) {
		if(count($slots) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one slot is required.");
		}
		return $this->exe( $this->protocol([ "cluster", "delslots", $slots ]) );
	}

	/**
	 * Forces a slave to perform a manual failover of its master.
	 * for complete documentation: http://redis.io/commands#cluster
	 * FAILOVER [FORCE|TAKEOVER]
	 */
	public function clusterFailover() {
		return $this->exe( $this->protocol([ "cluster", "failover" ]) );
	}

	/**
	 * Forces a slave to perform a manual failover of its master.
	 * for complete documentation: http://redis.io/commands#cluster
	 * FAILOVER [FORCE|TAKEOVER]
	 */
	public function clusterFailoverForce() {
		return $this->exe( $this->protocol([ "cluster", "failover", "force" ]) );
	}

	/**
	 * Forces a slave to perform a manual failover of its master.
	 * for complete documentation: http://redis.io/commands#cluster
	 * FAILOVER [FORCE|TAKEOVER]
	 */
	public function clusterFailoverTakeover() {
		return $this->exe( $this->protocol([ "cluster", "failover", "takeover" ]) );
	}

	/**
	 * Remove a node from the nodes table
	 * for complete documentation: http://redis.io/commands#cluster
	 * FORGET node-id
	 */
	public function clusterForget($node_id) {
		return $this->exe( $this->protocol([ "cluster", "forget", $node_id ]) );
	}

	/**
	 * Return local key names in the specified hash slot
	 * for complete documentation: http://redis.io/commands#cluster
	 * GETKEYSINSLOT slot count
	 */
	public function clusterGetKeysInSlot($slot, $count) {
		return $this->exe( $this->protocol([ "cluster", "getkeysinslot", $slot, $count ]) );
	}

	/**
	 * Provides info about Redis Cluster node state
	 * for complete documentation: http://redis.io/commands#cluster
	 * INFO
	 */
	public function clusterInfo() {
		return $this->exe( $this->protocol([ "cluster", "info" ]) );
	}

	/**
	 * Returns the hash slot of the specified key
	 * for complete documentation: http://redis.io/commands#cluster
	 * KEYSLOT key
	 */
	public function clusterKeySlot($key) {
		return $this->exe( $this->protocol([ "cluster", "keyslot", $key ]) );
	}

	/**
	 * Force a node cluster to handshake with another node
	 * for complete documentation: http://redis.io/commands#cluster
	 * MEET ip port
	 */
	public function clusterMeet($ip, $port) {
		return $this->exe( $this->protocol([ "cluster", "meet", $ip, $port ]) );
	}

	/**
	 * Get Cluster config for the node
	 * for complete documentation: http://redis.io/commands#cluster
	 * NODES
	 */
	public function clusterNodes() {
		return $this->exe( $this->protocol([ "cluster", "nodes" ]) );
	}

	/**
	 * Reconfigure a node as a slave of the specified master node
	 * for complete documentation: http://redis.io/commands#cluster
	 * REPLICATE node-id
	 */
	public function clusterReplicate($node_id) {
		return $this->exe( $this->protocol([ "cluster", "replicate", $node_id ]) );
	}

	/**
	 * Reset a Redis Cluster node
	 * for complete documentation: http://redis.io/commands#cluster
	 * RESET [HARD|SOFT]
	 */
	public function clusterReset($hard = false) {
		$hard = $hard ? "hard" : "soft";
		return $this->exe( $this->protocol([ "cluster", "reset", $hard ]) );
	}

	/**
	 * Forces the node to save cluster state on disk
	 * for complete documentation: http://redis.io/commands#cluster
	 * SAVECONFIG
	 */
	public function clusterSaveConfig() {
		return $this->exe( $this->protocol([ "cluster", "saveconfig" ]) );
	}

	/**
	 * Set the configuration epoch in a new node
	 * for complete documentation: http://redis.io/commands#cluster
	 * SET-CONFIG-EPOCH config-epoch
	 */
	public function clusterSetConfigEpoch($epoch) {
		return $this->exe( $this->protocol([ "cluster", "set-config-epoch", $epoch ]) );
	}

	/**
	 * Bind an hash slot to a specific node
	 * for complete documentation: http://redis.io/commands#cluster
	 * SETSLOT slot IMPORTING|MIGRATING|STABLE|NODE [node-id]
	 */
	public function clusterSetSlot($slot, $status, $node_id) {
		throw new RedisException("(" . __FUNCTION__ . ") Not implemented.");
	}

	/**
	 * List slave nodes of the specified master node
	 * for complete documentation: http://redis.io/commands#cluster
	 * SLAVES node-id
	 */
	public function clusterSlaves($node_id) {
		return $this->exe( $this->protocol([ "cluster", "slaves", $node_id ]) );
	}

	/**
	 * Get array of Cluster slot to node mappings
	 * for complete documentation: http://redis.io/commands#cluster
	 * SLOTS
	 */
	public function clusterSlots() {
		return $this->exe( $this->protocol([ "cluster", "slots" ]) );
	}


}
