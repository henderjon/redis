<?php

class RedisTest extends PHPUnit_Framework_TestCase {

	function test_getExpx(){
		$inst       = new \Redis\Redis;
		$reflection = new ReflectionClass($inst);

		$expx = $reflection->getMethod("getExpx");
		$expx->setAccessible(true);

		$result = $expx->invokeArgs($inst, [\Redis\Redis::EXPIRE_EX]);
		$this->assertEquals(\Redis\Redis::EXPIRE_EX, $result);

		$result = $expx->invokeArgs($inst, [E_NOTICE]);
		$this->assertEquals(null, $result);
	}

	function test_getNxxx(){
		$inst       = new \Redis\Redis;
		$reflection = new ReflectionClass($inst);

		$nxxx = $reflection->getMethod("getNxxx");
		$nxxx->setAccessible(true);

		$result = $nxxx->invokeArgs($inst, [\Redis\Redis::SET_NX]);
		$this->assertEquals(\Redis\Redis::SET_NX, $result);

		$result = $nxxx->invokeArgs($inst, [E_NOTICE]);
		$this->assertEquals(null, $result);
	}

	function test_getZagg(){
		$inst       = new \Redis\Redis;
		$reflection = new ReflectionClass($inst);

		$zagg = $reflection->getMethod("getZagg");
		$zagg->setAccessible(true);

		$result = $zagg->invokeArgs($inst, [\Redis\Redis::ZAGG_SUM]);
		$this->assertEquals(\Redis\Redis::ZAGG_SUM, $result);

		$result = $zagg->invokeArgs($inst, [E_NOTICE]);
		$this->assertEquals(null, $result);
	}

	function test_getKillType(){
		$inst       = new \Redis\Redis;
		$reflection = new ReflectionClass($inst);

		$type = $reflection->getMethod("getKillType");
		$type->setAccessible(true);

		$result = $type->invokeArgs($inst, [\Redis\Redis::KILL_TYPE_NORMAL]);
		$this->assertEquals(\Redis\Redis::KILL_TYPE_NORMAL, $result);

		$result = $type->invokeArgs($inst, [E_NOTICE]);
		$this->assertEquals(null, $result);
	}

}