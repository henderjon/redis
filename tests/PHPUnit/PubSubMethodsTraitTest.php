<?php

namespace PubSubMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\PubSubMethodsTrait;

}

class PubSubMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_psubscribe($inst) {
		$inst->psubscribe(["testkey1", "testkey2"]);
		return "*3 $10 psubscribe $8 testkey1 $8 testkey2 ";
	}

	function do_pubsubChannels($inst) {
		$inst->pubsubChannels(["testkey1", "testkey2"]);
		return "*4 $6 pubsub $8 channels $8 testkey1 $8 testkey2 ";
	}

	function do_pubsubNumsub($inst) {
		$inst->pubsubNumsub(["testkey1", "testkey2"]);
		return "*4 $6 pubsub $6 numsub $8 testkey1 $8 testkey2 ";
	}

	function do_pubsubNumpat($inst) {
		$inst->pubsubNumpat(["testkey1", "testkey2"]);
		return "*4 $6 pubsub $6 numpat $8 testkey1 $8 testkey2 ";
	}

	function do_publish($inst) {
		$inst->publish(["testkey1", "testkey2"], "Hello-Keith");
		return "*4 $7 publish $8 testkey1 $8 testkey2 $11 Hello-Keith ";
	}

	function do_punsubscribe($inst) {
		$inst->punsubscribe(["testkey1", "testkey2"]);
		return "*3 $12 punsubscribe $8 testkey1 $8 testkey2 ";
	}

	function do_subscribe($inst) {
		$inst->subscribe(["testkey1", "testkey2"]);
		return "*3 $9 subscribe $8 testkey1 $8 testkey2 ";
	}

	function do_unsubscribe($inst) {
		$inst->unsubscribe(["testkey1", "testkey2"]);
		return "*3 $11 unsubscribe $8 testkey1 $8 testkey2 ";
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_psubscribe_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->psubscribe([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_subscribe_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->subscribe([]);
	}

}
