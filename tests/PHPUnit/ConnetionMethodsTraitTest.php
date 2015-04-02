<?php

namespace ConnetionMethodsTraitTest;

class ProperRedis extends \Redis\RedisConstants {

	use \Redis\Traits\ConnetionMethodsTrait;

}

class ConnetionMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_auth($inst) {
		$inst->auth("password");
		return "*2 $4 auth $8 password ";
	}

	// function $inst) {
	// 	$inst->echo("message");
	// 	return "*2 $4 echo $7 message ";
	// }

	function do_ping($inst) {
		$inst->ping();
		return "*1 $4 ping ";
	}

	function do_quit($inst) {
		$inst->quit();
		return "*1 $4 quit ";
	}

	function do_select($inst) {
		$inst->select(5);
		return "*2 $6 select $1 5 ";
	}

}