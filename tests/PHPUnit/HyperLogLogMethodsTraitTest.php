<?php

namespace HyperLogLogMethodsTraitTest;

class ProperRedis extends \Redis\RedisConstants {

	use \Redis\Traits\HyperLogLogMethodsTrait;

}

class HyperLogLogMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_pfadd($inst) {
		$inst->pfadd("testkey1", ["testkey2", "testkey3"]);
		return "*4 $5 pfadd $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

	function do_pfcount($inst) {
		$inst->pfcount(["testkey2", "testkey3"]);
		return "*3 $7 pfcount $8 testkey2 $8 testkey3 ";
	}

	function do_pfmerge($inst) {
		$inst->pfmerge("testkey1", ["testkey2", "testkey3"]);
		return "*4 $7 pfmerge $8 testkey1 $8 testkey2 $8 testkey3 ";
	}

}