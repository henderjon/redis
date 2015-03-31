<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ClusterMethodsTrait {

	/**
	 * Assign new hash slots to receiving node
	 * ADDSLOTS slot [slot ...]
	 */
	function clusterAddSlots(array $slots) {
		if(count($slots) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one slot is required.");
		}
		return $this->exec( $this->protocol( "CLUSTER", "GETNAME", $slots ) );
	}

	/**
	 * Return the number of failure reports active for a given node
	 * COUNT-FAILURE-REPORTS node-id
	 */
	function clusterCountFailureReports($node_id) {
		return $this->exec( $this->protocol( "CLUSTER", "COUNT-FAILURE-REPORTS", $node_id ) );
	}

	/**
	 * Return the number of local keys in the specified hash slot
	 * COUNTKEYSINSLOT slot
	 */
	function clusterCountKeysInSlot($slot) {
		return $this->exec( $this->protocol( "CLUSTER", "COUNTKEYSINSLOT", $slot ) );
	}

	/**
	 * Set hash slots as unbound in receiving node
	 * DELSLOTS slot [slot ...]
	 */
	function clusterDelSlots(array $slots) {
		if(count($slots) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one slot is required.");
		}
		return $this->exec( $this->protocol( "CLUSTER", "DELSLOTS", $slots ) );
	}

	/**
	 * Forces a slave to perform a manual failover of its master.
	 * FAILOVER [FORCE|TAKEOVER]
	 */
	function clusterFailover() {
		return $this->exec( $this->protocol( "CLUSTER", "FAILOVER" ) );
	}

	/**
	 * Forces a slave to perform a manual failover of its master.
	 * FAILOVER [FORCE|TAKEOVER]
	 */
	function clusterFailoverForce() {
		return $this->exec( $this->protocol( "CLUSTER", "FAILOVER", "FORCE" ) );
	}

	/**
	 * Forces a slave to perform a manual failover of its master.
	 * FAILOVER [FORCE|TAKEOVER]
	 */
	function clusterFailoverTakeover() {
		return $this->exec( $this->protocol( "CLUSTER", "FAILOVER", "TAKEOVER" ) );
	}

	/**
	 * Remove a node from the nodes table
	 * FORGET node-id
	 */
	function clusterForget($node_id) {
		return $this->exec( $this->protocol( "CLUSTER", "FORGET", $node_id ) );
	}

	/**
	 * Return local key names in the specified hash slot
	 * GETKEYSINSLOT slot count
	 */
	function clusterGetKeysInSlot($slot, $count) {
		return $this->exec( $this->protocol( "CLUSTER", "GETKEYSINSLOT", $slot, $count ) );
	}

	/**
	 * Provides info about Redis Cluster node state
	 * INFO
	 */
	function clusterInfo() {
		return $this->exec( $this->protocol( "CLUSTER", "INFO" ) );
	}

	/**
	 * Returns the hash slot of the specified key
	 * KEYSLOT key
	 */
	function clusterKeySlot($key) {
		return $this->exec( $this->protocol( "CLUSTER", "KEYSLOT", $key ) );
	}

	/**
	 * Force a node cluster to handshake with another node
	 * MEET ip port
	 */
	function clusterMeet($ip, $port) {
		return $this->exec( $this->protocol( "CLUSTER", "MEET", $ip, $port ) );
	}

	/**
	 * Get Cluster config for the node
	 * NODES
	 */
	function clusterNodes() {
		return $this->exec( $this->protocol( "CLUSTER", "NODES" ) );
	}

	/**
	 * Reconfigure a node as a slave of the specified master node
	 * REPLICATE node-id
	 */
	function clusterReplicate($node_id) {
		return $this->exec( $this->protocol( "CLUSTER", "REPLICATE", $node_id ) );
	}

	/**
	 * Reset a Redis Cluster node
	 * RESET [HARD|SOFT]
	 */
	function clusterReset($hard = false) {
		$hard = $hard ? "HARD" : "SOFT";
		return $this->exec( $this->protocol( "CLUSTER", "RESET", $hard ) );
	}

	/**
	 * Forces the node to save cluster state on disk
	 * SAVECONFIG
	 */
	function clusterSaveConfig() {
		return $this->exec( $this->protocol( "CLUSTER", "SAVECONFIG" ) );
	}

	/**
	 * Set the configuration epoch in a new node
	 * SET-CONFIG-EPOCH config-epoch
	 */
	function clusterSetConfigEpoch($epoch) {
		return $this->exec( $this->protocol( "CLUSTER", "SET-CONFIG-EPOCH", $epoch ) );
	}

	/**
	 * Bind an hash slot to a specific node
	 * SETSLOT slot IMPORTING|MIGRATING|STABLE|NODE [node-id]
	 */
	function clusterSetSlot($slot, $status, $node_id) {
		throw new RedisException("(" . __FUNCTION__ . ") Not implemented.");
	}

	/**
	 * List slave nodes of the specified master node
	 * SLAVES node-id
	 */
	function clusterSlaves($node_id) {
		return $this->exec( $this->protocol( "CLUSTER", "SLAVES", $node_id ) );
	}

	/**
	 * Get array of Cluster slot to node mappings
	 * SLOTS
	 */
	function clusterSlots() {
		return $this->exec( $this->protocol( "CLUSTER", "SLOTS" ) );
	}


}