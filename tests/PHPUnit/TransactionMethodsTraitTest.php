<?php

namespace TransactionMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\TransactionMethodsTrait;
	protected function exe($string, $count = 1){
		return $string;
	}
}

class TransactionMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_discard() {
		$actual   = $this->getInst()->discard();
		$expected = "*1\r\n$7\r\ndiscard\r\n";
		$this->assertEquals($expected, $actual, "discard's converstion to Redis protocol failed.");
	}

	function test_exec() {
		$actual   = $this->getInst()->exec();
		$expected = "*1\r\n$4\r\nexec\r\n";
		$this->assertEquals($expected, $actual, "exec's converstion to Redis protocol failed.");
	}

	function test_multi() {
		$actual   = $this->getInst()->multi();
		$expected = "*1\r\n$5\r\nmulti\r\n";
		$this->assertEquals($expected, $actual, "multi's converstion to Redis protocol failed.");
	}

	function test_unwatch() {
		$actual   = $this->getInst()->unwatch();
		$expected = "*1\r\n$7\r\nunwatch\r\n";
		$this->assertEquals($expected, $actual, "unwatch's converstion to Redis protocol failed.");
	}

	function test_watch() {
		$actual   = $this->getInst()->watch(["testkey1", "testkey2"]);
		$expected = "*3\r\n$5\r\nwatch\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "watch's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_watch_exception() {
		$this->getInst()->watch([]);
	}

}
