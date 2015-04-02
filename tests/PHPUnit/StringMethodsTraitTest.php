<?php

namespace StringMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\StringMethodsTrait;

}

class StringMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_append($inst) {
		$inst->append("testkey1", "testvalue");
		return "*3\r\n$6\r\nappend\r\n$8\r\ntestkey1\r\n$9\r\ntestvalue\r\n";
	}

	function do_bitcount($inst) {
		$inst->bitcount("testkey1", 2, 5);
		return "*4\r\n$8\r\nbitcount\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$1\r\n5\r\n";
	}

	function do_bitopAnd($inst) {
		$inst->bitopAnd("testkey1", ["testkey2", "testkey3"]);
		return "*5\r\n$8\r\nbitopAnd\r\n$3\r\nAND\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
	}

	function do_bitopOr($inst) {
		$inst->bitopOr("testkey1", ["testkey2", "testkey3"]);
		return "*5\r\n$7\r\nbitopOr\r\n$2\r\nOR\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
	}

	function do_bitopXor($inst) {
		$inst->bitopXor("testkey1", ["testkey2", "testkey3"]);
		return "*5\r\n$8\r\nbitopXor\r\n$3\r\nXOR\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
	}

	function do_bitopNot($inst) {
		$inst->bitopNot("testkey1", ["testkey2", "testkey3"]);
		return "*5\r\n$8\r\nbitopNot\r\n$3\r\nNOT\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
	}

	function do_bitpos($inst) {
		$inst->bitpos("testkey1", 1);
		return "*3\r\n$6\r\nbitpos\r\n$8\r\ntestkey1\r\n$1\r\n1\r\n";
	}

	function do_decr($inst) {
		$inst->decr("testkey1");
		return "*2\r\n$4\r\ndecr\r\n$8\r\ntestkey1\r\n";
	}

	function do_decrby($inst) {
		$inst->decrby("testkey1", 2);
		return "*3\r\n$6\r\ndecrby\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n";
	}

	function do_get($inst) {
		$inst->get("testkey1");
		return "*2\r\n$3\r\nget\r\n$8\r\ntestkey1\r\n";
	}

	function do_getbit($inst) {
		$inst->getbit("testkey1", 3);
		return "*3\r\n$6\r\ngetbit\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n";
	}

	function do_getrange($inst) {
		$inst->getrange("testkey1", 3, 5);
		return "*4\r\n$8\r\ngetrange\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$1\r\n5\r\n";
	}

	function do_getset($inst) {
		$inst->getset("testkey1", 3);
		return "*3\r\n$6\r\ngetset\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n";
	}

	function do_incr($inst){
		$inst->incr("testkey1");
		return "*2\r\n$4\r\nincr\r\n$8\r\ntestkey1\r\n";
	}

	function do_incrby($inst) {
		$inst->incrby("testkey1", 1);
		return "*3\r\n$6\r\nincrby\r\n$8\r\ntestkey1\r\n$1\r\n1\r\n";
	}

	function do_incrbyfloat($inst) {
		$inst->incrbyfloat("testkey1", 1.2);
		return "*3\r\n$11\r\nincrbyfloat\r\n$8\r\ntestkey1\r\n$3\r\n1.2\r\n";
	}

	function do_mget($inst) {
		$inst->mget(["testkey1", "testkey2"]);
		return "*3\r\n$4\r\nmget\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
	}

	function do_mset($inst) {
		$inst->mset(["testkey1", "testkey2", "testkey3", "testkey4"]);
		return "*5\r\n$4\r\nmset\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$8\r\ntestkey4\r\n";
	}

	function do_msetnx($inst) {
		$inst->msetnx(["testkey1", "testkey2", "testkey3", "testkey4"]);
		return "*5\r\n$6\r\nmsetnx\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n$8\r\ntestkey4\r\n";
	}

	function do_psetex($inst) {
		$inst->psetex("testkey1", 3, "testkey2");
		return "*4\r\n$6\r\npsetex\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$8\r\ntestkey2\r\n";
	}

	function do_set($inst) {
		$inst->set("testkey1", "testkey2");
		return "*3\r\n$3\r\nset\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
	}

	function do_setbit($inst) {
		$inst->setbit("testkey1", 3, "testkey2");
		return "*4\r\n$6\r\nsetbit\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$8\r\ntestkey2\r\n";
	}

	function do_setex($inst) {
		$inst->setex("testkey1", 3, "testkey2");
		return "*4\r\n$5\r\nsetex\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$8\r\ntestkey2\r\n";
	}

	function do_setnx($inst) {
		$inst->setnx("testkey1", "testkey2");
		return "*3\r\n$5\r\nsetnx\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
	}

	function do_setrange($inst) {
		$inst->setrange("testkey1", 3, "testkey2");
		return "*4\r\n$8\r\nsetrange\r\n$8\r\ntestkey1\r\n$1\r\n3\r\n$8\r\ntestkey2\r\n";
	}

	function do_strlen($inst) {
		$inst->strlen("testkey1");
		return "*2\r\n$6\r\nstrlen\r\n$8\r\ntestkey1\r\n";
	}

}


