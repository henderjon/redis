<?php

namespace HyperLogLogMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\HyperLogLogMethodsTrait;
	protected function exe($string, $count = 1){
		return $string;
	}

}

class HyperLogLogMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_pfadd() {
		$actual   = $this->getInst()->pfadd("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$5\r\npfadd\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "pfadd's converstion to Redis protocol failed.");
	}

	function test_pfcount() {
		$actual   = $this->getInst()->pfcount(["testkey2", "testkey3"]);
		$expected = "*3\r\n$7\r\npfcount\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "pfcount's converstion to Redis protocol failed.");
	}

	function test_pfmerge() {
		$actual   = $this->getInst()->pfmerge("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$7\r\npfmerge\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "pfmerge's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_pfadd_exception() {
		$this->getInst()->pfadd("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_pfcount_exception() {
		$this->getInst()->pfcount([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_pfmerge_exception() {
		$this->getInst()->pfmerge("testkey1", []);
	}

}
