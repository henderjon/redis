<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ClusterMethodsTrait {

	/**
	 * Assign new hash slots to receiving node
	 * ADDSLOTS slot [slot ...]
	 */
	function clusterGetName() {
		return $this->exe( $this->protocol( "cluster", "getname" ) );
	}

	/**
	 * Assign new hash slots to receiving node
	 * ADDSLOTS slot [slot ...]
	 */
	function clusterAddSlots(array $slots) {
		if(count($slots) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one slot is required.");
		}
		return $this->exe( $this->protocol( "cluster", "addslots", $slots ) );
	}

	/**
	 * Return the number of failure reports active for a given node
	 * COUNT-FAILURE-REPORTS node-id
	 */
	function clusterCountFailureReports($node_id) {
		return $this->exe( $this->protocol( "cluster", "count-failure-reports", $node_id ) );
	}

	/**
	 * Return the number of local keys in the specified hash slot
	 * COUNTKEYSINSLOT slot
	 */
	function clusterCountKeysInSlot($slot) {
		return $this->exe( $this->protocol( "cluster", "countkeysinslot", $slot ) );
	}

	/**
	 * Set hash slots as unbound in receiving node
	 * DELSLOTS slot [slot ...]
	 */
	function clusterDelSlots(array $slots) {
		if(count($slots) < 1){
			throw new RedisException("(" . __FUNCTION__ . ") At least one slot is required.");
		}
		return $this->exe( $this->protocol( "cluster", "delslots", $slots ) );
	}

	/**
	 * Forces a slave to perform a manual failover of its master.
	 * FAILOVER [FORCE|TAKEOVER]
	 */
	function clusterFailover() {
		return $this->exe( $this->protocol( "cluster", "failover" ) );
	}

	/**
	 * Forces a slave to perform a manual failover of its master.
	 * FAILOVER [FORCE|TAKEOVER]
	 */
	function clusterFailoverForce() {
		return $this->exe( $this->protocol( "cluster", "failover", "force" ) );
	}

	/**
	 * Forces a slave to perform a manual failover of its master.
	 * FAILOVER [FORCE|TAKEOVER]
	 */
	function clusterFailoverTakeover() {
		return $this->exe( $this->protocol( "cluster", "failover", "takeover" ) );
	}

	/**
	 * Remove a node from the nodes table
	 * FORGET node-id
	 */
	function clusterForget($node_id) {
		return $this->exe( $this->protocol( "cluster", "forget", $node_id ) );
	}

	/**
	 * Return local key names in the specified hash slot
	 * GETKEYSINSLOT slot count
	 */
	function clusterGetKeysInSlot($slot, $count) {
		return $this->exe( $this->protocol( "cluster", "getkeysinslot", $slot, $count ) );
	}

	/**
	 * Provides info about Redis Cluster node state
	 * INFO
	 */
	function clusterInfo() {
		return $this->exe( $this->protocol( "cluster", "info" ) );
	}

	/**
	 * Returns the hash slot of the specified key
	 * KEYSLOT key
	 */
	function clusterKeySlot($key) {
		return $this->exe( $this->protocol( "cluster", "keyslot", $key ) );
	}

	/**
	 * Force a node cluster to handshake with another node
	 * MEET ip port
	 */
	function clusterMeet($ip, $port) {
		return $this->exe( $this->protocol( "cluster", "meet", $ip, $port ) );
	}

	/**
	 * Get Cluster config for the node
	 * NODES
	 */
	function clusterNodes() {
		return $this->exe( $this->protocol( "cluster", "nodes" ) );
	}

	/**
	 * Reconfigure a node as a slave of the specified master node
	 * REPLICATE node-id
	 */
	function clusterReplicate($node_id) {
		return $this->exe( $this->protocol( "cluster", "replicate", $node_id ) );
	}

	/**
	 * Reset a Redis Cluster node
	 * RESET [HARD|SOFT]
	 */
	function clusterReset($hard = false) {
		$hard = $hard ? "hard" : "soft";
		return $this->exe( $this->protocol( "cluster", "reset", $hard ) );
	}

	/**
	 * Forces the node to save cluster state on disk
	 * SAVECONFIG
	 */
	function clusterSaveConfig() {
		return $this->exe( $this->protocol( "cluster", "saveconfig" ) );
	}

	/**
	 * Set the configuration epoch in a new node
	 * SET-CONFIG-EPOCH config-epoch
	 */
	function clusterSetConfigEpoch($epoch) {
		return $this->exe( $this->protocol( "cluster", "set-config-epoch", $epoch ) );
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
		return $this->exe( $this->protocol( "cluster", "slaves", $node_id ) );
	}

	/**
	 * Get array of Cluster slot to node mappings
	 * SLOTS
	 */
	function clusterSlots() {
		return $this->exe( $this->protocol( "cluster", "slots" ) );
	}


}