<?php

namespace ConnectionMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\ConnectionMethodsTrait;

	protected function exe($string, $count = 1){
		return $string;
	}
}

class ConnectionMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_auth() {
		$actual   = $this->getInst()->auth("password");
		$expected = "*2\r\n$4\r\nauth\r\n$8\r\npassword\r\n";
		$this->assertEquals($expected, $actual, "auth's converstion to Redis protocol failed.");
	}

	function test_ping() {
		$actual   = $this->getInst()->ping();
		$expected = "*1\r\n$4\r\nping\r\n";
		$this->assertEquals($expected, $actual, "ping's converstion to Redis protocol failed.");
	}

	function test_quit() {
		$actual   = $this->getInst()->quit();
		$expected = "*1\r\n$4\r\nquit\r\n";
		$this->assertEquals($expected, $actual, "quit's converstion to Redis protocol failed.");
	}

	function test_select() {
		$actual   = $this->getInst()->select(5);
		$expected = "*2\r\n$6\r\nselect\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "select's converstion to Redis protocol failed.");
	}

}
