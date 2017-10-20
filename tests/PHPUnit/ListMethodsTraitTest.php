<?php

namespace ListMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\ListMethodsTrait;
	protected function exe($string, $count = 1){
		return $string;
	}
}

class ListMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_blpop() {
		$actual   = $this->getInst()->blpop("testkey1", ["testkey2", "testkey3"]);
		$expected = "*5\r\n$5\r\nblpop\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$1\r\n0\r\n";
		$this->assertEquals($expected, $actual, "blpop's converstion to Redis protocol failed.");
	}

	function test_brpop() {
		$actual   = $this->getInst()->brpop("testkey1", ["testkey2", "testkey3"]);
		$expected = "*5\r\n$5\r\nbrpop\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$1\r\n0\r\n";
		$this->assertEquals($expected, $actual, "brpop's converstion to Redis protocol failed.");
	}

	function test_brpoplpush() {
		$actual   = $this->getInst()->brpoplpush("testkey1", "testkey2");
		$expected = "*4\r\n$10\r\nbrpoplpush\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$1\r\n0\r\n";
		$this->assertEquals($expected, $actual, "brpoplpush's converstion to Redis protocol failed.");
	}

	function test_lindex() {
		$actual   = $this->getInst()->lindex("testkey1", 5);
		$expected = "*3\r\n$6\r\nlindex\r\n$8\r\ntestkey1\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "lindex's converstion to Redis protocol failed.");
	}

	function test_linsert() {
		$actual   = $this->getInst()->linsert("testkey1", true, 5, 6);
		$expected = "*5\r\n$7\r\nlinsert\r\n$8\r\ntestkey1\r\n$6\r\nbefore\r\n$1\r\n5\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "linsert's converstion to Redis protocol failed.");
	}

	function test_llen() {
		$actual   = $this->getInst()->llen("testkey1");
		$expected = "*2\r\n$4\r\nllen\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "llen's converstion to Redis protocol failed.");
	}

	function test_lpop() {
		$actual   = $this->getInst()->lpop("testkey1");
		$expected = "*2\r\n$4\r\nlpop\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "lpop's converstion to Redis protocol failed.");
	}

	function test_lpush() {
		$actual   = $this->getInst()->lpush("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$5\r\nlpush\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "lpush's converstion to Redis protocol failed.");
	}

	function test_lpushx() {
		$actual   = $this->getInst()->lpushx("testkey1", "testkey2");
		$expected = "*3\r\n$6\r\nlpushx\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "lpushx's converstion to Redis protocol failed.");
	}

	function test_lrange() {
		$actual   = $this->getInst()->lrange("testkey1", 3, 5);
		$expected = "*4\r\n$6\r\nlrange\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "lrange's converstion to Redis protocol failed.");
	}

	function test_lrem() {
		$actual   = $this->getInst()->lrem("testkey1", 0, 5);
		$expected = "*4\r\n$4\r\nlrem\r\n$8\r\ntestkey1\r\n$1\r\n0\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "lrem's converstion to Redis protocol failed.");
	}

	function test_lset() {
		$actual   = $this->getInst()->lset("testkey1", 3, 5);
		$expected = "*4\r\n$4\r\nlset\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "lset's converstion to Redis protocol failed.");
	}

	function test_ltrim() {
		$actual   = $this->getInst()->ltrim("testkey1", 3, 5);
		$expected = "*4\r\n$5\r\nltrim\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "ltrim's converstion to Redis protocol failed.");
	}

	function test_rpop() {
		$actual   = $this->getInst()->rpop("testkey1");
		$expected = "*2\r\n$4\r\nrpop\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "rpop's converstion to Redis protocol failed.");
	}

	function test_rpoplpush() {
		$actual   = $this->getInst()->rpoplpush("testkey1", "testkey2");
		$expected = "*3\r\n$9\r\nrpoplpush\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "rpoplpush's converstion to Redis protocol failed.");
	}

	function test_rpush() {
		$actual   = $this->getInst()->rpush("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$5\r\nrpush\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "rpush's converstion to Redis protocol failed.");
	}

	function test_rpushx() {
		$actual   = $this->getInst()->rpushx("testkey1", "testkey2");
		$expected = "*3\r\n$6\r\nrpushx\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "rpushx's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_lpush_exception() {
		$this->getInst()->lpush("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_rpush_exception() {
		$this->getInst()->rpush("testkey1", []);
	}

}
