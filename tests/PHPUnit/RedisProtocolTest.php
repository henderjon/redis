<?php

class RedisProtocolTest extends PHPUnit_Framework_TestCase {

	function getInst($memory){
		$inst = new \Redis\RedisProtocol;
		$reflection = new ReflectionClass($inst);
		$handle = $reflection->getProperty("handle");
		$handle->setAccessible(true);
		$handle->setValue($inst, $memory);
		return $inst;
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_connect_exception(){
		// $inst = (new \Redis\RedisProtocol)->connect("123.123.123.123", "12345", 2);
		$inst = new \Redis\RedisProtocol;
		$inst = $inst->connect("123.123.123.123", "12345", 2);
		// $this->assertTrue(($inst InstanceOf \Redis\RedisProtocol));
	}

	function test_select(){
		$memory = fopen("php://memory", "rw+");
		$inst = $this->getInst($memory);
		$inst->select(4);
		$this->assertEquals(4, $inst->db);
	}

	function test_pipe(){
		$memory = fopen("php://memory", "rw+");
		$inst = $this->getInst($memory);

		$base = array(
			array("sadd", "testkey1", "testvalue1"),
			array("sadd", "testkey2", "testvalue2"),
		);

		$inst->pipe($base);

		$expected = "*3\r\n$4\r\nsadd\r\n$8\r\ntestkey1\r\n$10\r\ntestvalue1\r\n\r\n*3\r\n$4\r\nsadd\r\n$8\r\ntestkey2\r\n$10\r\ntestvalue2\r\n\r\n";

		rewind($memory);
		$result = fread($memory, strlen($expected));

		$this->assertEquals($expected, $result);

	}

	function test___call_set(){
		$memory = fopen("php://memory", "rw+");
		$inst = $this->getInst($memory);

		$inst->set("testkey1", "testvalue1");

		$expected = "*3\r\n$3\r\nset\r\n$8\r\ntestkey1\r\n$10\r\ntestvalue1\r\n";

		rewind($memory);
		$result = fread($memory, strlen($expected));

		$this->assertEquals($expected, $result);
	}

	function test___call_get(){
		$memory = fopen("php://memory", "rw+");
		$inst = $this->getInst($memory);

		$inst->set("testkey1", "testvalue1");

		rewind($memory);
		// $result = fread($memory, strlen($expected));

		$result = $inst->get("testkey1");

		$expected = "testvalue1";

		$this->assertEquals($expected, $result);
	}

	function test_marshal(){
		$inst = new \Redis\RedisProtocol;

		$expected = array(
			"one" => "qwer",
			"two" => "asdf",
		);

		$result = $inst->marshal(array(
			"one", "qwer", "two", "asdf"
		));

		$this->assertEquals($expected, $result);
	}

	function test_unmarshal(){
		$inst = new \Redis\RedisProtocol;

		$expected = array(
			"one","qwer",
			"two","asdf",
		);

		$result = $inst->unmarshal(array(
			"one" => "qwer",
			"two" => "asdf",
		));

		$this->assertEquals($expected, $result);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_read_exception(){
		$memory = fopen("php://memory", "rw+");
		fwrite($memory, "-ERR Operation not permitted");
		rewind($memory);

		$inst       = new \Redis\RedisProtocol;
		$reflection = new ReflectionClass($inst);
		$read       = $reflection->getMethod("read");

		$read->setAccessible(true);
		$read->invokeArgs($inst, [$memory, 1]);
	}

	function test_read_string(){
		$memory = fopen("php://memory", "rw+");
		fwrite($memory, "+this is a single line?");
		rewind($memory);

		$inst       = new \Redis\RedisProtocol;
		$reflection = new ReflectionClass($inst);
		$read       = $reflection->getMethod("read");

		$read->setAccessible(true);
		$response = $read->invokeArgs($inst, [$memory, 1]);

		// RedisProtocol::exe() would usually reset for us, but we're skipping it here ...
		$this->assertEquals("this is a single line?", reset($response));
	}

	function test_read_int(){
		$memory = fopen("php://memory", "rw+");
		fwrite($memory, ":1234");
		rewind($memory);

		$inst       = new \Redis\RedisProtocol;
		$reflection = new ReflectionClass($inst);
		$read       = $reflection->getMethod("read");

		$read->setAccessible(true);
		$response = $read->invokeArgs($inst, [$memory, 1]);

		// RedisProtocol::exe() would usually reset for us, but we're skipping it here ...
		$this->assertEquals("1234", reset($response));
	}

	function test_read_bulk(){
		$memory = fopen("php://memory", "rw+");
		fwrite($memory, "*2\r\n$4\r\nasdf\r\n$5\r\n12345\r\n");
		rewind($memory);

		$inst       = new \Redis\RedisProtocol;
		$reflection = new ReflectionClass($inst);
		$read       = $reflection->getMethod("read");

		$read->setAccessible(true);
		$response = $read->invokeArgs($inst, [$memory, 1]);

		// RedisProtocol::exe() would usually reset for us, but we're skipping it here ...
		$this->assertEquals(["asdf", "12345"], reset($response));
	}

}


