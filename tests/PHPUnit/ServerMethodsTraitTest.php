<?php

namespace ServerMethodsTraitTest;

class ProperRedis extends \Redis\RedisConstants {

	use \Redis\Traits\ServerMethodsTrait;

}

class ServerMethodsTraitTest extends \PHPUnit_Framework_TestCase {

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

	function do_bgrewriteaof($inst) {
		$inst->bgrewriteaof();
		return "*1 $12 bgrewriteaof ";
	}

	function do_bgsave($inst) {
		$inst->bgsave();
		return "*1 $6 bgsave ";
	}

	function do_clientKillAddr($inst) {
		$inst->clientKillAddr("ip:port", true);
		return "*6 $6 client $4 kill $4 addr $7 ip:port $6 skipme $3 yes ";
	}

	function do_clientKillId($inst) {
		$inst->clientKillId("id", true);
		return "*6 $6 client $4 kill $2 id $2 id $6 skipme $3 yes ";
	}

	function do_clientKillType($inst) {
		$inst->clientKillType("normal", $skipme = true);
		return "*6 $6 client $4 kill $4 type $6 normal $6 skipme $3 yes ";
	}

	function do_clientList($inst) {
		$inst->clientList();
		return "*2 $6 client $4 list ";
	}

	function do_clientGetName($inst) {
		$inst->clientGetName();
		return "*2 $6 client $7 getname ";
	}

	function do_clientPause($inst) {
		$inst->clientPause("12");
		return "*3 $6 client $5 pause $2 12 ";
	}

	function do_clientSetName($inst) {
		$inst->clientSetName("Keith");
		return "*3 $6 client $7 setname $5 Keith ";
	}

	function do_command($inst) {
		$inst->command();
		return "*1 $7 command ";
	}

	function do_commandCount($inst) {
		$inst->commandCount();
		return "*2 $7 command $5 count ";
	}

	function do_commandGetKeys($inst) {
		$inst->commandGetKeys();
		return "*2 $7 command $7 getkeys ";
	}

	function do_commandInfo($inst) {
		$inst->commandInfo(["one", "two"]);
		return "*4 $7 command $4 info $3 one $3 two ";
	}

	function do_configGet($inst) {
		$inst->configGet("name");
		return "*3 $6 config $3 get $4 name ";
	}

	function do_configRewrite($inst) {
		$inst->configRewrite();
		return "*2 $6 config $7 rewrite ";
	}

	function do_configSet($inst) {
		$inst->configSet("name", "Keith");
		return "*4 $6 config $3 set $4 name $5 Keith ";
	}

	function do_configResetStat($inst) {
		$inst->configResetStat();
		return "*2 $6 config $9 resetstat ";
	}

	function do_dbsize($inst) {
		$inst->dbsize();
		return "*1 $6 dbsize ";
	}

	function do_debugObject($inst) {
		$inst->debugObject("Keith");
		return "*3 $5 debug $6 object $5 Keith";
	}

	function do_debugSegFault($inst) {
		$inst->debugSegFault();
		return "*2 $5 debug $8 segfault ";
	}

	function do_flushall($inst) {
		$inst->flushall();
		return "*1 $8 flushall ";
	}

	function do_flushdb($inst) {
		$inst->flushdb();
		return "*1 $7 flushdb ";
	}

	function do_info($inst) {
		$inst->info("names");
		return "*2 $4 info $5 names ";
	}

	function do_lastsave($inst) {
		$inst->lastsave();
		return "*1 $8 lastsave ";
	}

	function do_monitor($inst) {
		$inst->monitor();
		return "*1 $7 monitor ";
	}

	function do_role($inst) {
		$inst->role();
		return "*1 $4 role ";
	}

	function do_save($inst) {
		$inst->save();
		return "*1 $4 save ";
	}

	function do_shutdown($inst) {
		$inst->shutdown();
		return "*1 $8 shutdown ";
	}

	function do_shutdownSave($inst) {
		$inst->shutdownSave();
		return "*2 $8 shutdown $4 save ";
	}

	function do_shutdownNoSave($inst) {
		$inst->shutdownNoSave();
		return "*2 $8 shutdown $6 nosave ";
	}

	function do_slaveof($inst) {
		$inst->slaveof("127.0.0.1", "6637");
		return "*3 $7 slaveof $9 127.0.0.1 $4 6637 ";
	}

	function do_slowlog($inst) {
		$inst->slowlog("Keith");
		return "*2 $7 slowlog $5 Keith ";
	}

	function do_sync($inst) {
		$inst->sync();
		return "*1 $4 sync ";
	}

	function do_time($inst) {
		$inst->time();
		return "*1 $4 time ";
	}

}