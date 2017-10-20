<?php

class ProperRedis extends \Redis\RedisSubscription {

	protected function exe($string, $count = 1){
		return $string;
	}
}

class RedisSubscriptionTest extends PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_subscribeTo_command(){
		$actual   = $this->getInst()->subscribeTo(array("channel"));
		$expected = "*2\r\n$9\r\nsubscribe\r\n$7\r\nchannel\r\n";

		$this->assertEquals($expected, $result);
	}

	function test_subscribeTo_closure(){

		// coverage ...
		$timeout = $this->getInst()->setTimeout(12);
		// php://memory isn't a socket, doesn't have a timeout
		// $this->assertEquals(true, $timeout);

		list($details, $looper) = $this->getInst()->subscribeTo(array("channel"));

		$this->assertInstanceOf("\\Closure", $looper);
	}

	function do_subscribeTo_callback(){
		$memory = fopen("php://memory", "rw+");
		$inst = $this->getInst($memory);

		list($details, $looper) = $this->getInst()->subscribeTo(array("channel"));

		ftruncate($memory, 0);
		$raw_message = "*3\r\n$7\r\nmessage\r\n$7\r\nchannel\r\n$12\r\nHello World!\r\n";
		fwrite($memory, $raw_message);
		rewind($memory);

		$result = call_user_func($looper);

		$expected = array("message", "channel", "Hello World!");

		$this->assertEquals($expected, $result);
	}

	function test_psubscribeTo_command(){
		$actual = $this->getInst()->psubscribeTo(array("channel"));
		$expected = "*2\r\n$10\r\npsubscribe\r\n$7\r\nchannel\r\n";

		$this->assertEquals($expected, $actual);
	}

	function test_psubscribeTo_closure(){

		// coverage ...
		$timeout = $this->getInst()->setTimeout(12);
		// php://memory isn't a socket, doesn't have a timeout
		// $this->assertEquals(true, $timeout);

		list($details, $looper) = $this->getInst()->psubscribeTo(array("channel"));

		$this->assertInstanceOf("\\Closure", $looper);
	}

	function do_psubscribeTo_callback(){
		$memory = fopen("php://memory", "rw+");
		$inst = $this->getInst($memory);

		list($details, $looper) = $this->getInst()->psubscribeTo(array("channel"));

		ftruncate($memory, 0);
		$raw_message = "*3\r\n$7\r\nmessage\r\n$7\r\nchannel\r\n$12\r\nHello World!\r\n";
		fwrite($memory, $raw_message);
		rewind($memory);

		$result = call_user_func($looper);

		$expected = array("message", "channel", "Hello World!");

		$this->assertEquals($expected, $result);
	}

}
