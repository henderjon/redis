<?php

namespace ClusterMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\ClusterMethodsTrait;

	protected function exe($string, $count = 1){
		return $string;
	}

}

class ClusterMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_clusterGetName() {
		$actual   = $this->getInst()->clusterGetName();
		$expected = "*2\r\n$7\r\ncluster\r\n$7\r\ngetname\r\n";
		$this->assertEquals($expected, $actual, "clusterGetName's converstion to Redis protocol failed.");
	}

	function test_clusterAddSlots() {
		$actual   = $this->getInst()->clusterAddSlots(["testkey1", "testkey2"]);
		$expected = "*4\r\n$7\r\ncluster\r\n$8\r\naddslots\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "clusterAddSlots's converstion to Redis protocol failed.");
	}

	function test_clusterCountFailureReports() {
		$actual   = $this->getInst()->clusterCountFailureReports(45);
		$expected = "*3\r\n$7\r\ncluster\r\n$21\r\ncount-failure-reports\r\n$2\r\n45\r\n";
		$this->assertEquals($expected, $actual, "clusterCountFailureReports's converstion to Redis protocol failed.");
	}

	function test_clusterCountKeysInSlot() {
		$actual   = $this->getInst()->clusterCountKeysInSlot(45);
		$expected = "*3\r\n$7\r\ncluster\r\n$15\r\ncountkeysinslot\r\n$2\r\n45\r\n";
		$this->assertEquals($expected, $actual, "clusterCountKeysInSlot's converstion to Redis protocol failed.");
	}

	function test_clusterDelSlots() {
		$actual   = $this->getInst()->clusterDelSlots(["testkey1", "testkey2"]);
		$expected = "*4\r\n$7\r\ncluster\r\n$8\r\ndelslots\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "clusterDelSlots's converstion to Redis protocol failed.");
	}

	function test_clusterFailover() {
		$actual   = $this->getInst()->clusterFailover();
		$expected = "*2\r\n$7\r\ncluster\r\n$8\r\nfailover\r\n";
		$this->assertEquals($expected, $actual, "clusterFailover's converstion to Redis protocol failed.");
	}

	function test_clusterFailoverForce() {
		$actual   = $this->getInst()->clusterFailoverForce();
		$expected = "*3\r\n$7\r\ncluster\r\n$8\r\nfailover\r\n$5\r\nforce\r\n";
		$this->assertEquals($expected, $actual, "clusterFailoverForce's converstion to Redis protocol failed.");
	}

	function test_clusterFailoverTakeover() {
		$actual   = $this->getInst()->clusterFailoverTakeover();
		$expected = "*3\r\n$7\r\ncluster\r\n$8\r\nfailover\r\n$8\r\ntakeover\r\n";
		$this->assertEquals($expected, $actual, "clusterFailoverTakeover's converstion to Redis protocol failed.");
	}

	function test_clusterForget() {
		$actual   = $this->getInst()->clusterForget(45);
		$expected = "*3\r\n$7\r\ncluster\r\n$6\r\nforget\r\n$2\r\n45\r\n";
		$this->assertEquals($expected, $actual, "clusterForget's converstion to Redis protocol failed.");
	}

	function test_clusterGetKeysInSlot() {
		$actual   = $this->getInst()->clusterGetKeysInSlot("testkey1", 45);
		$expected = "*4\r\n$7\r\ncluster\r\n$13\r\ngetkeysinslot\r\n$8\r\ntestkey1\r\n$2\r\n45\r\n";
		$this->assertEquals($expected, $actual, "clusterGetKeysInSlot's converstion to Redis protocol failed.");
	}

	function test_clusterInfo() {
		$actual   = $this->getInst()->clusterInfo();
		$expected = "*2\r\n$7\r\ncluster\r\n$4\r\ninfo\r\n";
		$this->assertEquals($expected, $actual, "clusterInfo's converstion to Redis protocol failed.");
	}

	function test_clusterKeySlot() {
		$actual   = $this->getInst()->clusterKeySlot("testkey1");
		$expected = "*3\r\n$7\r\ncluster\r\n$7\r\nkeyslot\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "clusterKeySlot's converstion to Redis protocol failed.");
	}

	function test_clusterMeet() {
		$actual   = $this->getInst()->clusterMeet("127.0.0.1", "6637");
		$expected = "*4\r\n$7\r\ncluster\r\n$4\r\nmeet\r\n$9\r\n127.0.0.1\r\n$4\r\n6637\r\n";
		$this->assertEquals($expected, $actual, "clusterMeet's converstion to Redis protocol failed.");
	}

	function test_clusterNodes() {
		$actual   = $this->getInst()->clusterNodes();
		$expected = "*2\r\n$7\r\ncluster\r\n$5\r\nnodes\r\n";
		$this->assertEquals($expected, $actual, "clusterNodes's converstion to Redis protocol failed.");
	}

	function test_clusterReplicate() {
		$actual   = $this->getInst()->clusterReplicate(45);
		$expected = "*3\r\n$7\r\ncluster\r\n$9\r\nreplicate\r\n$2\r\n45\r\n";
		$this->assertEquals($expected, $actual, "clusterReplicate's converstion to Redis protocol failed.");
	}

	function test_clusterReset() {
		$actual   = $this->getInst()->clusterReset();
		$expected = "*3\r\n$7\r\ncluster\r\n$5\r\nreset\r\n$4\r\nsoft\r\n";
		$this->assertEquals($expected, $actual, "clusterReset's converstion to Redis protocol failed.");
	}

	function test_clusterSaveConfig() {
		$actual   = $this->getInst()->clusterSaveConfig();
		$expected = "*2\r\n$7\r\ncluster\r\n$10\r\nsaveconfig\r\n";
		$this->assertEquals($expected, $actual, "clusterSaveConfig's converstion to Redis protocol failed.");
	}

	function test_clusterSetConfigEpoch() {
		$actual   = $this->getInst()->clusterSetConfigEpoch(12345);
		$expected = "*3\r\n$7\r\ncluster\r\n$16\r\nset-config-epoch\r\n$5\r\n12345\r\n";
		$this->assertEquals($expected, $actual, "clusterSetConfigEpoch's converstion to Redis protocol failed.");
	}

	function test_clusterSlaves() {
		$actual   = $this->getInst()->clusterSlaves(45);
		$expected = "*3\r\n$7\r\ncluster\r\n$6\r\nslaves\r\n$2\r\n45\r\n";
		$this->assertEquals($expected, $actual, "clusterSlaves's converstion to Redis protocol failed.");
	}

	function test_clusterSlots() {
		$actual   = $this->getInst()->clusterSlots();
		$expected = "*2\r\n$7\r\ncluster\r\n$5\r\nslots\r\n";
		$this->assertEquals($expected, $actual, "clusterSlots's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_clusterAddSlots_exception() {
		$this->getInst()->clusterAddSlots([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_clusterDelSlots_exception() {
		$this->getInst()->clusterDelSlots([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_clusterSetSlot_exception() {
		$this->getInst()->clusterSetSlot("", "", "");
	}


}
