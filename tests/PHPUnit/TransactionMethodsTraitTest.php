<?php

namespace TransactionMethodsTraitTest;

class ProperRedis extends \Redis\RedisConstants {

	use \Redis\Traits\TransactionMethodsTrait;

}

class TransactionMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

			fseek($memory, $seek);
			$result = fread($memory, strlen($expected));
			$seek += strlen($expected);

			$this->assertEquals($expected, $result, $message);
		}
	}

	function do_discard($inst) {
		$inst->discard();
		return "*1\r\n$7\r\ndiscard\r\n";
	}

	function do_exec($inst) {
		$inst->exec();
		return "*1\r\n$4\r\nexec\r\n";
	}

	function do_multi($inst) {
		$inst->multi();
		return "*1\r\n$5\r\nmulti\r\n";
	}

	function do_unwatch($inst) {
		$inst->unwatch();
		return "*1\r\n$7\r\nunwatch\r\n";
	}

	function do_watch($inst) {
		$inst->watch(["testkey1", "testkey2"]);
		return "*3\r\n$5\r\nwatch\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
	}


}