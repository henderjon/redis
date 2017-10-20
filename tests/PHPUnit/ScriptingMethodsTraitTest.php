<?php

namespace ScriptingMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\ScriptingMethodsTrait;
	protected function exe($string, $count = 1){
		return $string;
	}
}

class ScriptingMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_evalLua() {
		$actual   = $this->getInst()->evalLua("testkey1", ["testkey2"]);
		$expected = "*4\r\n$4\r\neval\r\n$8\r\ntestkey1\r\n$1\r\n1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "evalLua's converstion to Redis protocol failed.");
	}

	function test_evalsha() {
		$actual   = $this->getInst()->evalsha("testkey1", ["testkey2", "testkey3"]);
		$expected = "*5\r\n$7\r\nevalsha\r\n$8\r\ntestkey1\r\n$1\r\n2\r\n$8\r\ntestkey2\r\n$8\r\ntestkey3\r\n";
		$this->assertEquals($expected, $actual, "evalsha's converstion to Redis protocol failed.");
	}

	function test_scriptExists() {
		$actual   = $this->getInst()->scriptExists(["testkey1", "testkey2"]);
		$expected = "*4\r\n$6\r\nscript\r\n$6\r\nexists\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "scriptExists's converstion to Redis protocol failed.");
	}


	function test_scriptFlush() {
		$actual   = $this->getInst()->scriptFlush();
		$expected = "*2\r\n$6\r\nscript\r\n$5\r\nflush\r\n";
		$this->assertEquals($expected, $actual, "scriptFlush's converstion to Redis protocol failed.");
	}

	function test_scriptKill() {
		$actual   = $this->getInst()->scriptKill();
		$expected = "*2\r\n$6\r\nscript\r\n$4\r\nkill\r\n";
		$this->assertEquals($expected, $actual, "scriptKill's converstion to Redis protocol failed.");
	}

	function test_scriptLoad() {
		$actual   = $this->getInst()->scriptLoad("testkey1");
		$expected = "*3\r\n$6\r\nscript\r\n$4\r\nload\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "scriptLoad's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_evalLua_exception() {
		$this->getInst()->evalLua("script", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_evalsha_exception() {
		$this->getInst()->evalsha("testkey1", []);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_scriptExists_exception() {
		$this->getInst()->scriptExists([]);
	}


}
