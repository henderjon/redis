<?php

namespace SetMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\SetMethodsTrait;

	protected function exe($string, $count = 1){
		return $string;
	}

}

class SetMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_sadd() {
		$actual   = $this->getInst()->sadd("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$4\r\nsadd\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "sadd's converstion to Redis protocol failed.");
	}

	function test_scard() {
		$actual   = $this->getInst()->scard("testkey1");
		$expected = "*2\r\n$5\r\nscard\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "scard's converstion to Redis protocol failed.");
	}

	function test_sdiff() {
		$actual   = $this->getInst()->sdiff(["testkey1", "testkey2"]);
		$expected = "*3\r\n$5\r\nsdiff\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "sdiff's converstion to Redis protocol failed.");
	}

	function test_sdiffstore() {
		$actual   = $this->getInst()->sdiffstore("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$10\r\nsdiffstore\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "sdiffstore's converstion to Redis protocol failed.");
	}

	function test_sinter() {
		$actual   = $this->getInst()->sinter(["testkey1", "testkey2"]);
		$expected = "*3\r\n$6\r\nsinter\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "sinter's converstion to Redis protocol failed.");
	}

	function test_sinterstore() {
		$actual   = $this->getInst()->sinterstore("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$11\r\nsinterstore\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "sinterstore's converstion to Redis protocol failed.");
	}

	function test_sismember() {
		$actual   = $this->getInst()->sismember("testkey1", "testkey2");
		$expected = "*3\r\n$9\r\nsismember\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "sismember's converstion to Redis protocol failed.");
	}

	function test_smembers() {
		$actual   = $this->getInst()->smembers("testkey1");
		$expected = "*2\r\n$8\r\nsmembers\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "smembers's converstion to Redis protocol failed.");
	}

	function test_smove() {
		$actual   = $this->getInst()->smove("testkey1", "testkey2", "testkey3");
		$expected = "*4\r\n$5\r\nsmove\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "smove's converstion to Redis protocol failed.");
	}

	function test_spop() {
		$actual   = $this->getInst()->spop("testkey1", 5);
		$expected = "*3\r\n$4\r\nspop\r\n$8\r\ntestkey1\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "spop's converstion to Redis protocol failed.");
	}

	function test_srandmember() {
		$actual   = $this->getInst()->srandmember("testkey1", 4);
		$expected = "*3\r\n$11\r\nsrandmember\r\n$8\r\ntestkey1\r\n$1\r\n4\r\n";
		$this->assertEquals($expected, $actual, "srandmember's converstion to Redis protocol failed.");
	}

	function test_srem() {
		$actual   = $this->getInst()->srem("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$4\r\nsrem\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "srem's converstion to Redis protocol failed.");
	}

	function test_sunion() {
		$actual   = $this->getInst()->sunion(["testkey1", "testkey2"]);
		$expected = "*3\r\n$6\r\nsunion\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "sunion's converstion to Redis protocol failed.");
	}

	function test_sunionstore() {
		$actual   = $this->getInst()->sunionstore("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$11\r\nsunionstore\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "sunionstore's converstion to Redis protocol failed.");
	}

	function test_sscan() {
		$actual   = $this->getInst()->sscan("testkey1", "testkey2", "p:*:p", 5);
		$expected = "*7\r\n$5\r\nsscan\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$5\r\nmatch\r\n$5\r\np:*:p\r\n$5\r\ncount\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "sscan's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_sadd_exception() {
		$this->getInst()->sadd("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_sdiff_exception() {
		$this->getInst()->sdiff([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_sdiffstore_exception() {
		$this->getInst()->sdiffstore("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_sinter_exception() {
		$this->getInst()->sinter([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_sinterstore_exception() {
		$this->getInst()->sinterstore("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_srem_exception() {
		$this->getInst()->srem("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_sunion_exception() {
		$this->getInst()->sunion([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_sunionstore_exception() {
		$this->getInst()->sunionstore("testkey1", []);
	}


}
