<?php

namespace SortedSetMethodsTraitTest;

class ProperRedis extends \Redis\Redis {
	use \Redis\Traits\SortedSetMethodsTrait;
}

class SortedSetMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_zadd($inst) {
		$inst->zadd("testkey1", ["testkey2", "testkey3"]);
		return "*4 $4 zadd $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_zcard($inst) {
		$inst->zcard("testkey1");
		return "*2 $5 zcard $8 testkey1 ";
	}

	function do_zcount($inst) {
		$inst->zcount("testkey1", 2, 6);
		return "*4 $6 zcount $8 testkey1 $1 2 $1 6 ";
	}

	function do_zincrby($inst) {
		$inst->zincrby("testkey1", 2, 6);
		return "*4 $7 zincrby $8 testkey1 $1 2 $1 6 ";
	}

	function do_zinterstore($inst) {
		$inst->zinterstore("testkey1", ["testkey2", "testkey3"], [1], ProperRedis::ZAGG_SUM);
		return "*9 $11 zinterstore $8 testkey1 $1 2 $8 testkey2 $8 testkey3 $7 WEIGHTS $1 1 $9 AGGREGATE $3 SUM ";
	}

	function do_zlexcount($inst) {
		$inst->zlexcount("testkey1", 2, 6);
		return "*4 $9 zlexcount $8 testkey1 $1 2 $1 6 ";
	}

	function do_zrange($inst) {
		$inst->zrange("testkey1", 2, 6);
		return "*4 $6 zrange $8 testkey1 $1 2 $1 6 ";
	}

	function do_zrangebylex($inst) {
		$inst->zrangebylex("testkey1", 2, 6, 2, 6);
		return "*7 $11 zrangebylex $8 testkey1 $1 2 $1 6 $5 LIMIT $1 2 $1 6 ";
	}

	function do_zrevrangebylex($inst) {
		$inst->zrevrangebylex("testkey1", 2, 6, 2);
		return "*6 $14 zrevrangebylex $8 testkey1 $1 2 $1 6 $5 LIMIT $1 2 ";
	}

	function do_zrangebyscore($inst) {
		$inst->zrangebyscore("testkey1", 2, 6, true, 2);
		return "*7 $13 zrangebyscore $8 testkey1 $1 2 $1 6 $10 WITHSCORES $5 LIMIT $1 2 ";
	}

	function do_zrank($inst) {
		$inst->zrank("testkey1", "testkey2");
		return "*3 $5 zrank $8 testkey1 $8 testkey2 ";
	}

	function do_zrem($inst) {
		$inst->zrem("testkey1", ["testkey2", "testkey3"]);
		return "*4 $4 zrem $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_zremrangebylex($inst) {
		$inst->zremrangebylex("testkey1", 2, 6);
		return "*4 $14 zremrangebylex $8 testkey1 $1 2 $1 6 ";
	}

	function do_zremrangebyrank($inst) {
		$inst->zremrangebyrank("testkey1", 2, 6);
		return "*4 $15 zremrangebyrank $8 testkey1 $1 2 $1 6 ";
	}

	function do_zremrangebyscore($inst) {
		$inst->zremrangebyscore("testkey1", 2, 6);
		return "*4 $16 zremrangebyscore $8 testkey1 $1 2 $1 6 ";
	}

	function do_zrevrange($inst) {
		$inst->zrevrange("testkey1", 2, 6, true);
		return "*5 $9 zrevrange $8 testkey1 $1 2 $1 6 $10 WITHSCORES ";
	}

	function do_zrevrangebyscore($inst) {
		$inst->zrevrangebyscore("testkey1", 2, 6, true, 5, 13);
		return "*8 $16 zrevrangebyscore $8 testkey1 $1 2 $1 6 $10 WITHSCORES $5 LIMIT $1 5 $2 13 ";
	}

	function do_zrevrank($inst) {
		$inst->zrevrank("testkey1", "testkey2");
		return "*3 $8 zrevrank $8 testkey1 $8 testkey2 ";
	}

	function do_zscore($inst) {
		$inst->zscore("testkey1", "testkey2");
		return "*3 $6 zscore $8 testkey1 $8 testkey2 ";
	}

	function do_zunionstore($inst) {
		$inst->zunionstore("testkey1", ["testkey2", "testkey3"], [1], ProperRedis::ZAGG_SUM);
		return "*9 $11 zunionstore $8 testkey1 $1 2 $8 testkey2 $8 testkey3 $7 WEIGHTS $1 1 $9 AGGREGATE $3 SUM ";
	}

	function do_zscan($inst) {
		$inst->zscan("testkey1", "testkey2", "p:*:p");
		return "*5 $5 zscan $8 testkey1 $8 testkey2 $5 MATCH $5 p:*:p ";
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zadd_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zadd("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zinterstore_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zinterstore("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zinterstore_exception_2() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zinterstore("testkey1", ["testkey2"], [], E_NOTICE);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrangebylex_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zrangebylex("testkey1", 0, 5, null, 6);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrevrangebylex_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zrevrangebylex("testkey1", 0, 5, null, 6);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrangebyscore_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zrangebyscore("testkey1", 0, 5, true, null, 3);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrem_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zrem("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zrevrangebyscore_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zrevrangebyscore("testkey1", 0, 5, true, null, 3);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zunionstore_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zunionstore("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_zunionstore_exception2() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->zunionstore("testkey1", ["testkey2"], [], E_NOTICE);
	}


}
