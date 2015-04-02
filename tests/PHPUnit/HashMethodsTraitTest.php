<?php

namespace HashMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\HashMethodsTrait;

}

class HashMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_hdel($inst) {
		$inst->hdel("testkey1", ["testkey2", "testkey3"]);
		return "*4 $4 hdel $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_hexists($inst) {
		$inst->hexists("testkey1", "testkey2");
		return "*3 $7 hexists $8 testkey1 $8 testkey2 ";
	}

	function do_hget($inst) {
		$inst->hget("testkey1", "testkey2");
		return "*3 $4 hget $8 testkey1 $8 testkey2 ";
	}

	function do_hgetall($inst) {
		$inst->hgetall("testkey1");
		return "*2 $7 hgetall $8 testkey1 ";
	}

	function do_hincrby($inst) {
		$inst->hincrby("testkey1", "testkey2", 4);
		return "*4 $7 hincrby $8 testkey1 $8 testkey2 $1 4 ";
	}

	function do_hincrbyfloat($inst) {
		$inst->hincrbyfloat("testkey1", "testkey2", 4.4);
		return "*4 $12 hincrbyfloat $8 testkey1 $8 testkey2 $3 4.4 ";
	}

	function do_hkeys($inst) {
		$inst->hkeys("testkey1");
		return "*2 $5 hkeys $8 testkey1 ";
	}

	function do_hlen($inst) {
		$inst->hlen("testkey1");
		return "*2 $4 hlen $8 testkey1 ";
	}

	function do_hmget($inst) {
		$inst->hmget("testkey1", ["testkey2", "testkey3"]);
		return "*4 $5 hmget $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_hmset($inst) {
		$inst->hmset("testkey1", ["testkey2", "testkey3"]);
		return "*4 $5 hmset $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_hset($inst) {
		$inst->hset("testkey1", "testkey2", "testkey3");
		return "*4 $4 hset $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_hsetnx($inst) {
		$inst->hsetnx("testkey1", "testkey2", "testkey3");
		return "*4 $6 hsetnx $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_hstrlen($inst) {
		$inst->hstrlen("testkey1", "testkey2");
		return "*3 $7 hstrlen $8 testkey1 $8 testkey2 ";
	}

	function do_hvals($inst) {
		$inst->hvals("testkey1");
		return "*2 $5 hvals $8 testkey1 ";
	}

	function do_hscan($inst) {
		$inst->hscan("testkey1", "testkey2", "p:*:p");
		return "*5 $5 hscan $8 testkey1 $8 testkey2 $5 match $5 p:*:p ";
	}

}
