<?php

namespace StringMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\StringMethodsTrait;
	protected function exe($string, $count = 1){
		return $string;
	}
}

class StringMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_append() {
		$actual   = $this->getInst()->append("testkey1", "testvalue");
		$expected = "*3\r\n$6\r\nappend\r\n$8\r\ntestkey1\r\n$9\r\ntestvalue\r\n";
		$this->assertEquals($expected, $actual, "append's converstion to Redis protocol failed.");
	}

	function test_bitcount() {
		$actual   = $this->getInst()->bitcount("testkey1", 2, 5);
		$expected = "*4\r\n$8\r\nbitcount\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "bitcount's converstion to Redis protocol failed.");
	}

	function test_bitopAnd() {
		$actual   = $this->getInst()->bitopAnd("testkey1", ["testkey2", "testkey3"]);
		$expected = "*5\r\n$8\r\nbitopAnd\r\n$3\r\nAND\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "bitopAnd's converstion to Redis protocol failed.");
	}

	function test_bitopOr() {
		$actual   = $this->getInst()->bitopOr("testkey1", ["testkey2", "testkey3"]);
		$expected = "*5\r\n$7\r\nbitopOr\r\n$2\r\nOR\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "bitopOr's converstion to Redis protocol failed.");
	}

	function test_bitopXor() {
		$actual   = $this->getInst()->bitopXor("testkey1", ["testkey2", "testkey3"]);
		$expected = "*5\r\n$8\r\nbitopXor\r\n$3\r\nXOR\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "bitopXor's converstion to Redis protocol failed.");
	}

	function test_bitopNot() {
		$actual   = $this->getInst()->bitopNot("testkey1", ["testkey2", "testkey3"]);
		$expected = "*5\r\n$8\r\nbitopNot\r\n$3\r\nNOT\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "bitopNot's converstion to Redis protocol failed.");
	}

	function test_bitpos() {
		$actual   = $this->getInst()->bitpos("testkey1", 1);
		$expected = "*3\r\n$6\r\nbitpos\r\n$8\r\ntestkey1\r\n$1\r\n1\r\n";
		$this->assertEquals($expected, $actual, "bitpos's converstion to Redis protocol failed.");
	}

	function test_decr() {
		$actual   = $this->getInst()->decr("testkey1");
		$expected = "*2\r\n$4\r\ndecr\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "decr's converstion to Redis protocol failed.");
	}

	function test_decrby() {
		$actual   = $this->getInst()->decrby("testkey1", 2);
		$expected = "*3\r\n$6\r\ndecrby\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n";
		$this->assertEquals($expected, $actual, "decrby's converstion to Redis protocol failed.");
	}

	function test_get() {
		$actual   = $this->getInst()->get("testkey1");
		$expected = "*2\r\n$3\r\nget\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "get's converstion to Redis protocol failed.");
	}

	function test_getbit() {
		$actual   = $this->getInst()->getbit("testkey1", 3);
		$expected = "*3\r\n$6\r\ngetbit\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n";
		$this->assertEquals($expected, $actual, "getbit's converstion to Redis protocol failed.");
	}

	function test_getrange() {
		$actual   = $this->getInst()->getrange("testkey1", 3, 5);
		$expected = "*4\r\n$8\r\ngetrange\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "getrange's converstion to Redis protocol failed.");
	}

	function test_getset() {
		$actual   = $this->getInst()->getset("testkey1", 3);
		$expected = "*3\r\n$6\r\ngetset\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n";
		$this->assertEquals($expected, $actual, "getset's converstion to Redis protocol failed.");
	}

	function test_incr(){
		$actual   = $this->getInst()->incr("testkey1");
		$expected = "*2\r\n$4\r\nincr\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "incr's converstion to Redis protocol failed.");
	}

	function test_incrby() {
		$actual   = $this->getInst()->incrby("testkey1", 1);
		$expected = "*3\r\n$6\r\nincrby\r\n$8\r\ntestkey1\r\n$1\r\n1\r\n";
		$this->assertEquals($expected, $actual, "incrby's converstion to Redis protocol failed.");
	}

	function test_incrbyfloat() {
		$actual   = $this->getInst()->incrbyfloat("testkey1", 1.2);
		$expected = "*3\r\n$11\r\nincrbyfloat\r\n$8\r\ntestkey1\r\n$3\r\n1.2\r\n";
		$this->assertEquals($expected, $actual, "incrbyfloat's converstion to Redis protocol failed.");
	}

	function test_mget() {
		$actual   = $this->getInst()->mget(["testkey1", "testkey2"]);
		$expected = "*3\r\n$4\r\nmget\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "mget's converstion to Redis protocol failed.");
	}

	function test_mset() {
		$actual   = $this->getInst()->mset(["testkey1", "testkey2", "testkey3", "testkey4"]);
		$expected = "*5\r\n$4\r\nmset\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$8\r\ntestkey4\r\n";
		$this->assertEquals($expected, $actual, "mset's converstion to Redis protocol failed.");
	}

	function test_msetnx() {
		$actual   = $this->getInst()->msetnx(["testkey1", "testkey2", "testkey3", "testkey4"]);
		$expected = "*5\r\n$6\r\nmsetnx\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$8\r\ntestkey4\r\n";
		$this->assertEquals($expected, $actual, "msetnx's converstion to Redis protocol failed.");
	}

	function test_psetex() {
		$actual   = $this->getInst()->psetex("testkey1", 3, "testkey2");
		$expected = "*4\r\n$6\r\npsetex\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "psetex's converstion to Redis protocol failed.");
	}

	function test_set() {
		$actual   = $this->getInst()->set("testkey1", "testkey2", 1234, ProperRedis::EXPIRE_EX, ProperRedis::SET_NX);
		$expected = "*6\r\n$3\r\nset\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$2\r\nEX\r\n$4\r\n1234\r\n$2\r\nNX\r\n";
		$this->assertEquals($expected, $actual, "set's converstion to Redis protocol failed.");
	}

	function test_setbit() {
		$actual   = $this->getInst()->setbit("testkey1", 3, "testkey2");
		$expected = "*4\r\n$6\r\nsetbit\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "setbit's converstion to Redis protocol failed.");
	}

	function test_setex() {
		$actual   = $this->getInst()->setex("testkey1", 3, "testkey2");
		$expected = "*4\r\n$5\r\nsetex\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "setex's converstion to Redis protocol failed.");
	}

	function test_setnx() {
		$actual   = $this->getInst()->setnx("testkey1", "testkey2");
		$expected = "*3\r\n$5\r\nsetnx\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "setnx's converstion to Redis protocol failed.");
	}

	function test_setrange() {
		$actual   = $this->getInst()->setrange("testkey1", 3, "testkey2");
		$expected = "*4\r\n$8\r\nsetrange\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "setrange's converstion to Redis protocol failed.");
	}

	function test_strlen() {
		$actual   = $this->getInst()->strlen("testkey1");
		$expected = "*2\r\n$6\r\nstrlen\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "strlen's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_bitopAnd_exception() {
		$this->getInst()->bitopAnd("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_bitopOr_exception() {
		$this->getInst()->bitopOr("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_bitopXor_exception() {
		$this->getInst()->bitopXor("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_bitopNot_exception() {
		$this->getInst()->bitopNot("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_mget_exception() {
		$this->getInst()->mget([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_mset_exception() {
		$this->getInst()->mset(["testkey2", "testkey3", "testkey4"]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_msetnx_exception() {
		$this->getInst()->msetnx(["testkey2", "testkey3", "testkey4"]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_set_exception2() {
		$this->getInst()->set("testkey1", "testkey2", 12345);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_set_exception3() {
		$this->getInst()->set("testkey1", "testkey2", 12345, E_NOTICE);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_set_exception4() {
		$this->getInst()->set("testkey1", "testkey2", 12345, ProperRedis::EXPIRE_EX, E_NOTICE);
	}

}


