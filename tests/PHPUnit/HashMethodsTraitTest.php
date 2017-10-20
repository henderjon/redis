<?php

namespace HashMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\HashMethodsTrait;
	protected function exe($string, $count = 1){
		return $string;
	}
}

class HashMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_hdel() {
		$actual   = $this->getInst()->hdel("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$4\r\nhdel\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "hdel's converstion to Redis protocol failed.");
	}

	function test_hexists() {
		$actual   = $this->getInst()->hexists("testkey1", "testkey2");
		$expected = "*3\r\n$7\r\nhexists\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "hexists's converstion to Redis protocol failed.");
	}

	function test_hget() {
		$actual   = $this->getInst()->hget("testkey1", "testkey2");
		$expected = "*3\r\n$4\r\nhget\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "hget's converstion to Redis protocol failed.");
	}

	function test_hgetall() {
		$actual   = $this->getInst()->hgetall("testkey1");
		$expected = "*2\r\n$7\r\nhgetall\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "hgetall's converstion to Redis protocol failed.");
	}

	function test_hincrby() {
		$actual   = $this->getInst()->hincrby("testkey1", "testkey2", 4);
		$expected = "*4\r\n$7\r\nhincrby\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$1\r\n4\r\n";
		$this->assertEquals($expected, $actual, "hincrby's converstion to Redis protocol failed.");
	}

	function test_hincrbyfloat() {
		$actual   = $this->getInst()->hincrbyfloat("testkey1", "testkey2", 4.4);
		$expected = "*4\r\n$12\r\nhincrbyfloat\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$3\r\n4.4\r\n";
		$this->assertEquals($expected, $actual, "hincrbyfloat's converstion to Redis protocol failed.");
	}

	function test_hkeys() {
		$actual   = $this->getInst()->hkeys("testkey1");
		$expected = "*2\r\n$5\r\nhkeys\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "hkeys's converstion to Redis protocol failed.");
	}

	function test_hlen() {
		$actual   = $this->getInst()->hlen("testkey1");
		$expected = "*2\r\n$4\r\nhlen\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "hlen's converstion to Redis protocol failed.");
	}

	function test_hmget() {
		$actual   = $this->getInst()->hmget("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$5\r\nhmget\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "hmget's converstion to Redis protocol failed.");
	}

	function test_hmset() {
		$actual   = $this->getInst()->hmset("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$5\r\nhmset\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "hmset's converstion to Redis protocol failed.");
	}

	function test_hset() {
		$actual   = $this->getInst()->hset("testkey1", "testkey2", "testkey3");
		$expected = "*4\r\n$4\r\nhset\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "hset's converstion to Redis protocol failed.");
	}

	function test_hsetnx() {
		$actual   = $this->getInst()->hsetnx("testkey1", "testkey2", "testkey3");
		$expected = "*4\r\n$6\r\nhsetnx\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "hsetnx's converstion to Redis protocol failed.");
	}

	function test_hstrlen() {
		$actual   = $this->getInst()->hstrlen("testkey1", "testkey2");
		$expected = "*3\r\n$7\r\nhstrlen\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "hstrlen's converstion to Redis protocol failed.");
	}

	function test_hvals() {
		$actual   = $this->getInst()->hvals("testkey1");
		$expected = "*2\r\n$5\r\nhvals\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "hvals's converstion to Redis protocol failed.");
	}

	function test_hscan() {
		$actual   = $this->getInst()->hscan("testkey1", "testkey2", "p:*:p", 6);
		$expected = "*7\r\n$5\r\nhscan\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$5\r\nmatch\r\n$5\r\np:*:p\r\n$5\r\ncount\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "hscan's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_hdel_exception() {
		$this->getInst()->hdel("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_hmget_exception() {
		$this->getInst()->hmget("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_hmset_exception() {
		$this->getInst()->hmset("testkey1", ["testkey2", "testkey3", "testkey4"]);
	}

}
