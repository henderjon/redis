<?php

namespace Redis\Interfaces;

interface ClusterMethodsInterface {

	function clusterGetName();
	function clusterAddSlots(array $slots);
	function clusterCountFailureReports($node_id);
	function clusterCountKeysInSlot($slot);
	function clusterDelSlots(array $slots);
	function clusterFailover();
	function clusterFailoverForce();
	function clusterFailoverTakeover();
	function clusterForget($node_id);
	function clusterGetKeysInSlot($slot, $count);
	function clusterInfo();
	function clusterKeySlot($key);
	function clusterMeet($ip, $port);
	function clusterNodes();
	function clusterReplicate($node_id);
	function clusterReset($hard = false);
	function clusterSaveConfig();
	function clusterSetConfigEpoch($epoch);
	function clusterSetSlot($slot, $status, $node_id);
	function clusterSlaves($node_id);
	function clusterSlots();

}

