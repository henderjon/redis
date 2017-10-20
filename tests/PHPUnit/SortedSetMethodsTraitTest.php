<?php

namespace SortedSetMethodsTraitTest;

class ProperRedis extends \Redis\Redis {
	use \Redis\Traits\SortedSetMethodsTrait;
	protected function exe($string, $count = 1){
		return $string;
	}
}

class SortedSetMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_zadd() {
		$actual   = $this->getInst()->zadd("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$4\r\nzadd\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "zadd's converstion to Redis protocol failed.");
	}

	function test_zcard() {
		$actual   = $this->getInst()->zcard("testkey1");
		$expected = "*2\r\n$5\r\nzcard\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "zcard's converstion to Redis protocol failed.");
	}

	function test_zcount() {
		$actual   = $this->getInst()->zcount("testkey1", 2, 6);
		$expected = "*4\r\n$6\r\nzcount\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "zcount's converstion to Redis protocol failed.");
	}

	function test_zincrby() {
		$actual   = $this->getInst()->zincrby("testkey1", 2, 6);
		$expected = "*4\r\n$7\r\nzincrby\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "zincrby's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zinterstore1() {

		$actual   = $this->getInst()->zinterstore("testkey1", ["testkey2", "testkey3"], [1], ProperRedis::ZAGG_SUM);
		$expected = "*7\r\n$11\r\nzinterstore\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$7\r\nWEIGHTS\r\n$1\r\n1\r\n$9\r\nAGGREGATE\r\n$3\r\nSUM\r\n";

		$this->assertEquals($expected, $actual, "zinterstore1's converstion to Redis protocol failed.");
	}

	function test_zinterstore2() {
		$actual   = $this->getInst()->zinterstore("testkey1", ["testkey2", "testkey3"], [], ProperRedis::ZAGG_SUM);
		$expected = "*7\r\n$11\r\nzinterstore\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$9\r\nAGGREGATE\r\n$3\r\nSUM\r\n";
		$this->assertEquals($expected, $actual, "zinterstore2's converstion to Redis protocol failed.");
	}

	function test_zinterstore3() {
		$actual   = $this->getInst()->zinterstore("testkey1", ["testkey2", "testkey3"], [1, 2], ProperRedis::ZAGG_SUM);
		$expected = "*10\r\n$11\r\nzinterstore\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$7\r\nWEIGHTS\r\n$1\r\n1\r\n$1\r\n2\r\n$9\r\nAGGREGATE\r\n$3\r\nSUM\r\n";
		$this->assertEquals($expected, $actual, "zinterstore3's converstion to Redis protocol failed.");
	}

	function test_zlexcount() {
		$actual   = $this->getInst()->zlexcount("testkey1", 2, 6);
		$expected = "*4\r\n$9\r\nzlexcount\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "zlexcount's converstion to Redis protocol failed.");
	}

	function test_zrange() {
		$actual   = $this->getInst()->zrange("testkey1", 2, 6);
		$expected = "*4\r\n$6\r\nzrange\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "zrange's converstion to Redis protocol failed.");
	}

	function test_zrangebylex() {
		$actual   = $this->getInst()->zrangebylex("testkey1", 2, 6, 2, 6);
		$expected = "*7\r\n$11\r\nzrangebylex\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n$5\r\nLIMIT\r\n$1\r\n2\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "zrangebylex's converstion to Redis protocol failed.");
	}

	function test_zrevrangebylex() {
		$actual   = $this->getInst()->zrevrangebylex("testkey1", 2, 6, 2);
		$expected = "*6\r\n$14\r\nzrevrangebylex\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n$5\r\nLIMIT\r\n$1\r\n2\r\n";
		$this->assertEquals($expected, $actual, "zrevrangebylex's converstion to Redis protocol failed.");
	}

	function test_zrangebyscore() {
		$actual   = $this->getInst()->zrangebyscore("testkey1", 2, 6, true, 2);
		$expected = "*7\r\n$13\r\nzrangebyscore\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n$10\r\nWITHSCORES\r\n$5\r\nLIMIT\r\n$1\r\n2\r\n";
		$this->assertEquals($expected, $actual, "zrangebyscore's converstion to Redis protocol failed.");
	}

	function test_zrank() {
		$actual   = $this->getInst()->zrank("testkey1", "testkey2");
		$expected = "*3\r\n$5\r\nzrank\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "zrank's converstion to Redis protocol failed.");
	}

	function test_zrem() {
		$actual   = $this->getInst()->zrem("testkey1", ["testkey2", "testkey3"]);
		$expected = "*4\r\n$4\r\nzrem\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "zrem's converstion to Redis protocol failed.");
	}

	function test_zremrangebylex() {
		$actual   = $this->getInst()->zremrangebylex("testkey1", 2, 6);
		$expected = "*4\r\n$14\r\nzremrangebylex\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "zremrangebylex's converstion to Redis protocol failed.");
	}

	function test_zremrangebyrank() {
		$actual   = $this->getInst()->zremrangebyrank("testkey1", 2, 6);
		$expected = "*4\r\n$15\r\nzremrangebyrank\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "zremrangebyrank's converstion to Redis protocol failed.");
	}

	function test_zremrangebyscore() {
		$actual   = $this->getInst()->zremrangebyscore("testkey1", 2, 6);
		$expected = "*4\r\n$16\r\nzremrangebyscore\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n";
		$this->assertEquals($expected, $actual, "zremrangebyscore's converstion to Redis protocol failed.");
	}

	function test_zrevrange() {
		$actual   = $this->getInst()->zrevrange("testkey1", 2, 6, true);
		$expected = "*5\r\n$9\r\nzrevrange\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n$10\r\nWITHSCORES\r\n";
		$this->assertEquals($expected, $actual, "zrevrange's converstion to Redis protocol failed.");
	}

	function test_zrevrangebyscore() {
		$actual   = $this->getInst()->zrevrangebyscore("testkey1", 2, 6, true, 5, 13);
		$expected = "*8\r\n$16\r\nzrevrangebyscore\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n6\r\n$10\r\nWITHSCORES\r\n$5\r\nLIMIT\r\n$1\r\n5\r\n$2\r\n13\r\n";
		$this->assertEquals($expected, $actual, "zrevrangebyscore's converstion to Redis protocol failed.");
	}

	function test_zrevrank() {
		$actual   = $this->getInst()->zrevrank("testkey1", "testkey2");
		$expected = "*3\r\n$8\r\nzrevrank\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "zrevrank's converstion to Redis protocol failed.");
	}

	function test_zscore() {
		$actual   = $this->getInst()->zscore("testkey1", "testkey2");
		$expected = "*3\r\n$6\r\nzscore\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "zscore's converstion to Redis protocol failed.");
	}

	function test_zunionstore() {
		$actual   = $this->getInst()->zunionstore("testkey1", ["testkey2", "testkey3"], [1], ProperRedis::ZAGG_SUM);
		$expected = "*9\r\n$11\r\nzunionstore\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$7\r\nWEIGHTS\r\n$1\r\n1\r\n$9\r\nAGGREGATE\r\n$3\r\nSUM\r\n";
		$this->assertEquals($expected, $actual, "zunionstore's converstion to Redis protocol failed.");
	}

	function test_zscan() {
		$actual   = $this->getInst()->zscan("testkey1", "testkey2", "p:*:p");
		$expected = "*5\r\n$5\r\nzscan\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$5\r\nMATCH\r\n$5\r\np:*:p\r\n";
		$this->assertEquals($expected, $actual, "zscan's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zadd_exception() {
		$this->getInst()->zadd("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zinterstore_exception() {
		$this->getInst()->zinterstore("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zinterstore_exception_2() {
		$this->getInst()->zinterstore("testkey1", ["testkey2"], [], E_NOTICE);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrangebylex_exception() {
		$this->getInst()->zrangebylex("testkey1", 0, 5, null, 6);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrevrangebylex_exception() {
		$this->getInst()->zrevrangebylex("testkey1", 0, 5, null, 6);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrangebyscore_exception() {
		$this->getInst()->zrangebyscore("testkey1", 0, 5, true, null, 3);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrem_exception() {
		$this->getInst()->zrem("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrevrangebyscore_exception() {
		$this->getInst()->zrevrangebyscore("testkey1", 0, 5, true, null, 3);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zunionstore_exception() {
		$this->getInst()->zunionstore("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zunionstore_exception2() {
		$this->getInst()->zunionstore("testkey1", ["testkey2"], [], E_NOTICE);
	}


}
