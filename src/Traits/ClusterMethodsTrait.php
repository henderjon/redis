<?php

trait ClusterMethodsTrait {

    function clusterAddSlots(array $slots) {
        //  ADDSLOTS slot [slot ...] Assign new hash slots to receiving node
    }

    function clusterCountFailureReports($node_id) {
        //  COUNT-FAILURE-REPORTS node-id Return the number of failure reports active for a given node
    }

    function clusterCountKeysInSlot($slot) {
        //  COUNTKEYSINSLOT slot Return the number of local keys in the specified hash slot
    }

    function clusterDelSlots(array $slots) {
        //  DELSLOTS slot [slot ...] Set hash slots as unbound in receiving node
    }

    function clusterFailover($slave) {
        //  FAILOVER [FORCE|TAKEOVER] Forces a slave to perform a manual failover of its master.
    }

    function clusterForget($node_id) {
        //  FORGET node-id Remove a node from the nodes table
    }

    function clusterGetKeysInSlot($slot, $count) {
        //  GETKEYSINSLOT slot count Return local key names in the specified hash slot
    }

    function clusterInfo() {
        //  INFO Provides info about Redis Cluster node state
    }

    function clusterKeySlot($key) {
        //  KEYSLOT key Returns the hash slot of the specified key
    }

    function clusterMeet($ip, $port) {
        //  MEET ip port Force a node cluster to handshake with another node
    }

    function clusterNodes() {
        //  NODES Get Cluster config for the node
    }

    function clusterReplicate($node_id) {
        //  REPLICATE node-id Reconfigure a node as a slave of the specified master node
    }

    function clusterReset($hard) {
        //  RESET [HARD|SOFT] Reset a Redis Cluster node
    }

    function clusterSaveConfig() {
        //  SAVECONFIG Forces the node to save cluster state on disk
    }

    function clusterSetConfigEpoch() {
        //  SET-CONFIG-EPOCH config-epoch Set the configuration epoch in a new node
    }

    function clusterSetSlot($slot, $status, $node_id) {
        //  SETSLOT slot IMPORTING|MIGRATING|STABLE|NODE [node-id] Bind an hash slot to a specific node
    }

    function clusterSlaves($node_id) {
        //  SLAVES node-id List slave nodes of the specified master node
    }

    function clusterSlots() {
        //  SLOTS Get array of Cluster slot to node mappings
    }


}