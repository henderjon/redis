<?php

namespace ClusterMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\ClusterMethodsTrait;

}

class ClusterMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst($memory){
		$inst = new ProperRedis;
		$reflection = new \ReflectionClass($inst);
		$handle = $reflection->getProperty("handle");
		$methods = $reflection->getMethods();
		$handle->setAccessible(true);
		$handle->setValue($inst, $memory);
		return [$inst, $methods];
	}

	function test_all_the_things(){
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);

		$seek = 0;
		foreach($methods as $method){

			$message = strtoupper($method->getName()) . "'s converstion to Redis protocol failed.";
			$method = "do_{$method->getName()}";

			if(!method_exists($this, $method)){ continue; }

			$expected = $this->$method($inst);
			$expected = str_replace(" ", "\r\n", $expected);

			fseek($memory, $seek);
			$result = fread($memory, strlen($expected));
			$seek += strlen($expected);

			$this->assertEquals($expected, $result, $message);
		}
	}

	function do_clusterGetName($inst) {
		$inst->clusterGetName();
		return "*2 $7 cluster $7 getname ";
	}

	function do_clusterAddSlots($inst) {
		$inst->clusterAddSlots(["testkey1", "testkey2"]);
		return "*4 $7 cluster $8 addslots $8 testkey1 $8 testkey2 ";
	}

	function do_clusterCountFailureReports($inst) {
		$inst->clusterCountFailureReports(45);
		return "*3 $7 cluster $21 count-failure-reports $2 45 ";
	}

	function do_clusterCountKeysInSlot($inst) {
		$inst->clusterCountKeysInSlot(45);
		return "*3 $7 cluster $15 countkeysinslot $2 45 ";
	}

	function do_clusterDelSlots($inst) {
		$inst->clusterDelSlots(["testkey1", "testkey2"]);
		return "*4 $7 cluster $8 delslots $8 testkey1 $8 testkey2 ";
	}

	function do_clusterFailover($inst) {
		$inst->clusterFailover();
		return "*2 $7 cluster $8 failover ";
	}

	function do_clusterFailoverForce($inst) {
		$inst->clusterFailoverForce();
		return "*3 $7 cluster $8 failover $5 force ";
	}

	function do_clusterFailoverTakeover($inst) {
		$inst->clusterFailoverTakeover();
		return "*3 $7 cluster $8 failover $8 takeover ";
	}

	function do_clusterForget($inst) {
		$inst->clusterForget(45);
		return "*3 $7 cluster $6 forget $2 45 ";
	}

	function do_clusterGetKeysInSlot($inst) {
		$inst->clusterGetKeysInSlot("testkey1", 45);
		return "*4 $7 cluster $13 getkeysinslot $8 testkey1 $2 45 ";
	}

	function do_clusterInfo($inst) {
		$inst->clusterInfo();
		return "*2 $7 cluster $4 info ";
	}

	function do_clusterKeySlot($inst) {
		$inst->clusterKeySlot("testkey1");
		return "*3 $7 cluster $7 keyslot $8 testkey1 ";
	}

	function do_clusterMeet($inst) {
		$inst->clusterMeet("127.0.0.1", "6637");
		return "*4 $7 cluster $4 meet $9 127.0.0.1 $4 6637 ";
	}

	function do_clusterNodes($inst) {
		$inst->clusterNodes();
		return "*2 $7 cluster $5 nodes ";
	}

	function do_clusterReplicate($inst) {
		$inst->clusterReplicate(45);
		return "*3 $7 cluster $9 replicate $2 45 ";
	}

	function do_clusterReset($inst) {
		$inst->clusterReset();
		return "*3 $7 cluster $5 reset $4 soft ";
	}

	function do_clusterSaveConfig($inst) {
		$inst->clusterSaveConfig();
		return "*2 $7 cluster $10 saveconfig ";
	}

	function do_clusterSetConfigEpoch($inst) {
		$inst->clusterSetConfigEpoch(12345);
		return "*3 $7 cluster $16 set-config-epoch $5 12345 ";
	}

	// function $inst) {
	// 	$inst->clusterSetSlot();
	// 	return "$7 cluster";
	// }

	function do_clusterSlaves($inst) {
		$inst->clusterSlaves(45);
		return "*3 $7 cluster $6 slaves $2 45 ";
	}

	function do_clusterSlots($inst) {
		$inst->clusterSlots();
		return "*2 $7 cluster $5 slots ";
	}


}