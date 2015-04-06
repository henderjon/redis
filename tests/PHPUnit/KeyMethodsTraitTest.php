<?php

namespace KeyMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\KeyMethodsTrait;

}

class KeyMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_del($inst) {
		$inst->del(["testkey1", "testkey2"]);
		return "*3 $3 del $8 testkey1 $8 testkey2 ";
	}

	function do_dump($inst) {
		$inst->dump("testkey1");
		return "*2 $4 dump $8 testkey1 ";
	}

	function do_exists($inst) {
		$inst->exists("testkey1");
		return "*2 $6 exists $8 testkey1 ";
	}

	function do_expire($inst) {
		$inst->expire("testkey1", 5);
		return "*3 $6 expire $8 testkey1 $1 5";
	}

	function do_expireat($inst) {
		$inst->expireat("testkey1", 12345678);
		return "*3 $8 expireat $8 testkey1 $8 12345678 ";
	}

	function do_keys($inst) {
		$inst->keys("pattern");
		return "*2 $4 keys $7 pattern ";
	}

	function do_migrate($inst) {
		$inst->migrate("host", "port", "key", "dest", "timeout");
		return "*6 $7 migrate $4 host $4 port $3 key $4 dest $7 timeout ";
	}

	function do_move($inst) {
		$inst->move("testkey1", 5);
		return "*3 $4 move $8 testkey1 $1 5 ";
	}

	function do_objectRefcount($inst) {
		$inst->objectRefcount(["testkey1", "testkey2"]);
		return "*4 $6 object $8 refcount $8 testkey1 $8 testkey2 ";
	}

	function do_objectEncoding($inst) {
		$inst->objectEncoding(["testkey1", "testkey2"]);
		return "*4 $6 object $8 encoding $8 testkey1 $8 testkey2 ";
	}

	function do_objectIdletime($inst) {
		$inst->objectIdletime(["testkey1", "testkey2"]);
		return "*4 $6 object $8 idletime $8 testkey1 $8 testkey2 ";
	}

	function do_persist($inst) {
		$inst->persist("testkey1");
		return "*2 $7 persist $8 testkey1 ";
	}

	function do_pexpire($inst) {
		$inst->pexpire("testkey1", 1234);
		return "*3 $7 pexpire $8 testkey1 $4 1234 ";
	}

	function do_pexpireat($inst) {
		$inst->pexpireat("testkey1", 1234);
		return "*3 $9 pexpireat $8 testkey1 $4 1234 ";
	}

	function do_pttl($inst) {
		$inst->pttl("testkey1");
		return "*2 $4 pttl $8 testkey1 ";
	}

	function do_randomkey($inst) {
		$inst->randomkey();
		return "*1 $9 randomkey ";
	}

	function do_rename($inst) {
		$inst->rename("testkey1", "testkey2");
		return "*3 $6 rename $8 testkey1 $8 testkey2 ";
	}

	function do_renamenx($inst) {
		$inst->renamenx("testkey1", "testkey2");
		return "*3 $8 renamenx $8 testkey1 $8 testkey2 ";
	}

	function do_restore($inst) {
		$inst->restore("testkey1", "ttl", "serialValue");
		return "*5 $7 restore $8 testkey1 $3 ttl $11 serialValue $7 replace ";
	}

	// function do_sort($inst) {
	// 	$inst->sort("testkey1");
	// 	return "* ";
	// }

	function do_ttl($inst) {
		$inst->ttl("testkey1");
		return "*2 $3 ttl $8 testkey1 ";
	}

	function do_type($inst) {
		$inst->type("testkey1");
		return "*2 $4 type $8 testkey1 ";
	}

	function do_scan($inst) {
		$inst->scan("testkey1", "p:*:p", 5);
		return "*6 $4 scan $8 testkey1 $5 match $5 p:*:p $5 count $1 5 ";
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_del_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->del([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_objectRefcount_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->objectRefcount([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_objectEncoding_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->objectEncoding([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_objectIdletime_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->objectIdletime([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_sort_exception() {
		$memory = fopen("php://memory", "rw+");
		list($inst, $methods) = $this->getInst($memory);
		$inst->sort("", "", "", "", [], "", "", "");
	}

}
