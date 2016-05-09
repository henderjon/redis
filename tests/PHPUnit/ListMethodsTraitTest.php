<?php

namespace ListMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\ListMethodsTrait;

}

class ListMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_blpop($inst) {
		$inst->blpop("testkey1", ["testkey2", "testkey3"]);
		return "*5 $5 blpop $8 testkey1 $8 testkey2 $8 testkey3 $1 0 ";
	}

	function do_brpop($inst) {
		$inst->brpop("testkey1", ["testkey2", "testkey3"]);
		return "*5 $5 brpop $8 testkey1 $8 testkey2 $8 testkey3 $1 0 ";
	}

	function do_brpoplpush($inst) {
		$inst->brpoplpush("testkey1", "testkey2");
		return "*4 $10 brpoplpush $8 testkey1 $8 testkey2 $1 0 ";
	}

	function do_lindex($inst) {
		$inst->lindex("testkey1", 5);
		return "*3 $6 lindex $8 testkey1 $1 5 ";
	}

	function do_linsert($inst) {
		$inst->linsert("testkey1", true, 5, 6);
		return "*5 $7 linsert $8 testkey1 $6 before $1 5 $1 6 ";
	}

	function do_llen($inst) {
		$inst->llen("testkey1");
		return "*2 $4 llen $8 testkey1 ";
	}

	function do_lpop($inst) {
		$inst->lpop("testkey1");
		return "*2 $4 lpop $8 testkey1 ";
	}

	function do_lpush($inst) {
		$inst->lpush("testkey1", ["testkey2", "testkey3"]);
		return "*4 $5 lpush $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_lpushx($inst) {
		$inst->lpushx("testkey1", "testkey2");
		return "*3 $6 lpushx $8 testkey1 $8 testkey2 ";
	}

	function do_lrange($inst) {
		$inst->lrange("testkey1", 3, 5);
		return "*4 $6 lrange $8 testkey1 $1 3 $1 5 ";
	}

	function do_lrem($inst) {
		$inst->lrem("testkey1", 0, 5);
		return "*4 $4 lrem $8 testkey1 $1 0 $1 5 ";
	}

	function do_lset($inst) {
		$inst->lset("testkey1", 3, 5);
		return "*4 $4 lset $8 testkey1 $1 3 $1 5 ";
	}

	function do_ltrim($inst) {
		$inst->ltrim("testkey1", 3, 5);
		return "*4 $5 ltrim $8 testkey1 $1 3 $1 5 ";
	}

	function do_rpop($inst) {
		$inst->rpop("testkey1");
		return "*2 $4 rpop $8 testkey1 ";
	}

	function do_rpoplpush($inst) {
		$inst->rpoplpush("testkey1", "testkey2");
		return "*3 $9 rpoplpush $8 testkey1 $8 testkey2 ";
	}

	function do_rpush($inst) {
		$inst->rpush("testkey1", ["testkey2", "testkey3"]);
		return "*4 $5 rpush $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_rpushx($inst) {
		$inst->rpushx("testkey1", "testkey2");
		return "*3 $6 rpushx $8 testkey1 $8 testkey2 ";
	}


	/**
	 * @expectedException Redis\RedisException
	 */
	function test_lpush_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->lpush("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_rpush_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->rpush("testkey1", []);
	}

}
