<?php

class RedisSubscriptionTest extends PHPUnit_Framework_TestCase {

	function getInst($memory){
		$inst = new \Redis\RedisSubscription;
		$reflection = new ReflectionClass($inst);
		$handle = $reflection->getProperty("handle");
		$handle->setAccessible(true);
		$handle->setValue($inst, $memory);
		return $inst;
	}

	function test_subscribe_command(){
		$memory = fopen("php://memory", "rw+");
		$inst = $this->getInst($memory);

		$inst->subscribe(["channel"]);

		rewind($memory);
		$expected = "*2\r\n$9\r\nsubscribe\r\n$7\r\nchannel\r\n";
		$result = fread($memory, strlen($expected));

		$this->assertEquals($expected, $result);
	}

	function test_subscribe_closure(){
		$memory = fopen("php://memory", "rw+");
		$inst = $this->getInst($memory);

		// coverage ...
		$timeout = $inst->setTimeout(12);
		// php://memory isn't a socket, doesn't have a timeout
		// $this->assertEquals(true, $timeout);

		list($details, $looper) = $inst->subscribe(["channel"]);

		$this->assertInstanceOf("\\Closure", $looper);
	}

	function test_subscribe_callback(){
		$memory = fopen("php://memory", "rw+");
		$inst = $this->getInst($memory);

		list($details, $looper) = $inst->subscribe(["channel"]);

		ftruncate($memory, 0);
		$raw_message = "*3\r\n$7\r\nmessage\r\n$7\r\nchannel\r\n$12\r\nHello World!\r\n";
		fwrite($memory, $raw_message);
		rewind($memory);

		$result = $looper();

		$expected = ["message", "channel", "Hello World!"];

		$this->assertEquals($expected, $result);
	}

}