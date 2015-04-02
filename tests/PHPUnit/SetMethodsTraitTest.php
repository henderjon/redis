<?php

namespace SetMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\SetMethodsTrait;

}

class SetMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_sadd($inst) {
		$inst->sadd("testkey1", ["testkey2", "testkey3"]);
		return "*4 $4 sadd $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_scard($inst) {
		$inst->scard("testkey1");
		return "*2 $5 scard $8 testkey1 ";
	}

	function do_sdiff($inst) {
		$inst->sdiff(["testkey1", "testkey2"]);
		return "*3 $5 sdiff $8 testkey1 $8 testkey2 ";
	}

	function do_sdiffstore($inst) {
		$inst->sdiffstore("testkey1", ["testkey2", "testkey3"]);
		return "*4 $10 sdiffstore $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_sinter($inst) {
		$inst->sinter(["testkey1", "testkey2"]);
		return "*3 $6 sinter $8 testkey1 $8 testkey2 ";
	}

	function do_sinterstore($inst) {
		$inst->sinterstore("testkey1", ["testkey2", "testkey3"]);
		return "*4 $11 sinterstore $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_sismember($inst) {
		$inst->sismember("testkey1", "testkey2");
		return "*3 $9 sismember $8 testkey1 $8 testkey2 ";
	}

	function do_smembers($inst) {
		$inst->smembers("testkey1");
		return "*2 $8 smembers $8 testkey1 ";
	}

	function do_smove($inst) {
		$inst->smove("testkey1", "testkey2", "testkey3");
		return "*4 $5 smove $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_spop($inst) {
		$inst->spop("testkey1", 5);
		return "*3 $4 spop $8 testkey1 $1 5 ";
	}

	function do_srandmember($inst) {
		$inst->srandmember("testkey1", 4);
		return "*3 $11 srandmember $8 testkey1 $1 4 ";
	}

	function do_srem($inst) {
		$inst->srem("testkey1", ["testkey2", "testkey3"]);
		return "*4 $4 srem $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_sunion($inst) {
		$inst->sunion(["testkey1", "testkey2"]);
		return "*3 $6 sunion $8 testkey1 $8 testkey2 ";
	}

	function do_sunionstore($inst) {
		$inst->sunionstore("testkey1", ["testkey2", "testkey3"]);
		return "*4 $11 sunionstore $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_sscan($inst) {
		$inst->sscan("testkey1", "testkey2", "p:*:p", 5);
		return "*7 $5 sscan $8 testkey1 $8 testkey2 $5 match $5 p:*:p $5 count $1 5";
	}

}