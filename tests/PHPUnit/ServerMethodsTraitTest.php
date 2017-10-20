<?php

namespace ServerMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\ServerMethodsTrait;
	protected function exe($string, $count = 1){
		return $string;
	}
}

class ServerMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_bgrewriteaof() {
		$actual   = $this->getInst()->bgrewriteaof();
		$expected = "*1\r\n$12\r\nbgrewriteaof\r\n";
		$this->assertEquals($expected, $actual, "bgrewriteaof's converstion to Redis protocol failed.");
	}

	function test_bgsave() {
		$actual   = $this->getInst()->bgsave();
		$expected = "*1\r\n$6\r\nbgsave\r\n";
		$this->assertEquals($expected, $actual, "bgsave's converstion to Redis protocol failed.");
	}

	function test_clientKillAddr() {
		$actual   = $this->getInst()->clientKillAddr("ip:port", true);
		$expected = "*6\r\n$6\r\nclient\r\n$4\r\nkill\r\n$4\r\naddr\r\n$7\r\nip:port\r\n$6\r\nskipme\r\n$3\r\nyes\r\n";
		$this->assertEquals($expected, $actual, "clientKillAddr's converstion to Redis protocol failed.");
	}

	function test_clientKillId() {
		$actual   = $this->getInst()->clientKillId("id", true);
		$expected = "*6\r\n$6\r\nclient\r\n$4\r\nkill\r\n$2\r\nid\r\n$2\r\nid\r\n$6\r\nskipme\r\n$3\r\nyes\r\n";
		$this->assertEquals($expected, $actual, "clientKillId's converstion to Redis protocol failed.");
	}

	function test_clientKillType() {
		$actual   = $this->getInst()->clientKillType("normal", $skipme = true);
		$expected = "*6\r\n$6\r\nclient\r\n$4\r\nkill\r\n$4\r\ntype\r\n$6\r\nnormal\r\n$6\r\nskipme\r\n$3\r\nyes\r\n";
		$this->assertEquals($expected, $actual, "clientKillType's converstion to Redis protocol failed.");
	}

	function test_clientList() {
		$actual   = $this->getInst()->clientList();
		$expected = "*2\r\n$6\r\nclient\r\n$4\r\nlist\r\n";
		$this->assertEquals($expected, $actual, "clientList's converstion to Redis protocol failed.");
	}

	function test_clientGetName() {
		$actual   = $this->getInst()->clientGetName();
		$expected = "*2\r\n$6\r\nclient\r\n$7\r\ngetname\r\n";
		$this->assertEquals($expected, $actual, "clientGetName's converstion to Redis protocol failed.");
	}

	function test_clientPause() {
		$actual   = $this->getInst()->clientPause("12");
		$expected = "*3\r\n$6\r\nclient\r\n$5\r\npause\r\n$2\r\n12\r\n";
		$this->assertEquals($expected, $actual, "clientPause's converstion to Redis protocol failed.");
	}

	function test_clientSetName() {
		$actual   = $this->getInst()->clientSetName("Keith");
		$expected = "*3\r\n$6\r\nclient\r\n$7\r\nsetname\r\n$5\r\nKeith\r\n";
		$this->assertEquals($expected, $actual, "clientSetName's converstion to Redis protocol failed.");
	}

	function test_command() {
		$actual   = $this->getInst()->command();
		$expected = "*1\r\n$7\r\ncommand\r\n";
		$this->assertEquals($expected, $actual, "command's converstion to Redis protocol failed.");
	}

	function test_commandCount() {
		$actual   = $this->getInst()->commandCount();
		$expected = "*2\r\n$7\r\ncommand\r\n$5\r\ncount\r\n";
		$this->assertEquals($expected, $actual, "commandCount's converstion to Redis protocol failed.");
	}

	function test_commandGetKeys() {
		$actual   = $this->getInst()->commandGetKeys();
		$expected = "*2\r\n$7\r\ncommand\r\n$7\r\ngetkeys\r\n";
		$this->assertEquals($expected, $actual, "commandGetKeys's converstion to Redis protocol failed.");
	}

	function test_commandInfo() {
		$actual   = $this->getInst()->commandInfo(["one", "two"]);
		$expected = "*4\r\n$7\r\ncommand\r\n$4\r\ninfo\r\n$3\r\none\r\n$3\r\ntwo\r\n";
		$this->assertEquals($expected, $actual, "commandInfo's converstion to Redis protocol failed.");
	}

	function test_configGet() {
		$actual   = $this->getInst()->configGet("name");
		$expected = "*3\r\n$6\r\nconfig\r\n$3\r\nget\r\n$4\r\nname\r\n";
		$this->assertEquals($expected, $actual, "configGet's converstion to Redis protocol failed.");
	}

	function test_configRewrite() {
		$actual   = $this->getInst()->configRewrite();
		$expected = "*2\r\n$6\r\nconfig\r\n$7\r\nrewrite\r\n";
		$this->assertEquals($expected, $actual, "configRewrite's converstion to Redis protocol failed.");
	}

	function test_configSet() {
		$actual   = $this->getInst()->configSet("name", "Keith");
		$expected = "*4\r\n$6\r\nconfig\r\n$3\r\nset\r\n$4\r\nname\r\n$5\r\nKeith\r\n";
		$this->assertEquals($expected, $actual, "configSet's converstion to Redis protocol failed.");
	}

	function test_configResetStat() {
		$actual   = $this->getInst()->configResetStat();
		$expected = "*2\r\n$6\r\nconfig\r\n$9\r\nresetstat\r\n";
		$this->assertEquals($expected, $actual, "configResetStat's converstion to Redis protocol failed.");
	}

	function test_dbsize() {
		$actual   = $this->getInst()->dbsize();
		$expected = "*1\r\n$6\r\ndbsize\r\n";
		$this->assertEquals($expected, $actual, "dbsize's converstion to Redis protocol failed.");
	}

	function test_debugObject() {
		$actual   = $this->getInst()->debugObject("Keith");
		$expected = "*3\r\n$5\r\ndebug\r\n$6\r\nobject\r\n$5\r\nKeith\r\n";
		$this->assertEquals($expected, $actual, "debugObject's converstion to Redis protocol failed.");
	}

	function test_debugSegFault() {
		$actual   = $this->getInst()->debugSegFault();
		$expected = "*2\r\n$5\r\ndebug\r\n$8\r\nsegfault\r\n";
		$this->assertEquals($expected, $actual, "debugSegFault's converstion to Redis protocol failed.");
	}

	function test_flushall() {
		$actual   = $this->getInst()->flushall();
		$expected = "*1\r\n$8\r\nflushall\r\n";
		$this->assertEquals($expected, $actual, "flushall's converstion to Redis protocol failed.");
	}

	function test_flushdb() {
		$actual   = $this->getInst()->flushdb();
		$expected = "*1\r\n$7\r\nflushdb\r\n";
		$this->assertEquals($expected, $actual, "flushdb's converstion to Redis protocol failed.");
	}

	function test_info() {
		$actual   = $this->getInst()->info("names");
		$expected = "*2\r\n$4\r\ninfo\r\n$5\r\nnames\r\n";
		$this->assertEquals($expected, $actual, "info's converstion to Redis protocol failed.");
	}

	function test_lastsave() {
		$actual   = $this->getInst()->lastsave();
		$expected = "*1\r\n$8\r\nlastsave\r\n";
		$this->assertEquals($expected, $actual, "lastsave's converstion to Redis protocol failed.");
	}

	function test_monitor() {
		$actual   = $this->getInst()->monitor();
		$expected = "*1\r\n$7\r\nmonitor\r\n";
		$this->assertEquals($expected, $actual, "monitor's converstion to Redis protocol failed.");
	}

	function test_role() {
		$actual   = $this->getInst()->role();
		$expected = "*1\r\n$4\r\nrole\r\n";
		$this->assertEquals($expected, $actual, "role's converstion to Redis protocol failed.");
	}

	function test_save() {
		$actual   = $this->getInst()->save();
		$expected = "*1\r\n$4\r\nsave\r\n";
		$this->assertEquals($expected, $actual, "save's converstion to Redis protocol failed.");
	}

	function test_shutdown() {
		$actual   = $this->getInst()->shutdown();
		$expected = "*1\r\n$8\r\nshutdown\r\n";
		$this->assertEquals($expected, $actual, "shutdown's converstion to Redis protocol failed.");
	}

	function test_shutdownSave() {
		$actual   = $this->getInst()->shutdownSave();
		$expected = "*2\r\n$8\r\nshutdown\r\n$4\r\nsave\r\n";
		$this->assertEquals($expected, $actual, "shutdownSave's converstion to Redis protocol failed.");
	}

	function test_shutdownNoSave() {
		$actual   = $this->getInst()->shutdownNoSave();
		$expected = "*2\r\n$8\r\nshutdown\r\n$6\r\nnosave\r\n";
		$this->assertEquals($expected, $actual, "shutdownNoSave's converstion to Redis protocol failed.");
	}

	function test_slaveof() {
		$actual   = $this->getInst()->slaveof("127.0.0.1", "6637");
		$expected = "*3\r\n$7\r\nslaveof\r\n$9\r\n127.0.0.1\r\n$4\r\n6637\r\n";
		$this->assertEquals($expected, $actual, "slaveof's converstion to Redis protocol failed.");
	}

	function test_slowlog() {
		$actual   = $this->getInst()->slowlog("Keith");
		$expected = "*2\r\n$7\r\nslowlog\r\n$5\r\nKeith\r\n";
		$this->assertEquals($expected, $actual, "slowlog's converstion to Redis protocol failed.");
	}

	function test_sync() {
		$actual   = $this->getInst()->sync();
		$expected = "*1\r\n$4\r\nsync\r\n";
		$this->assertEquals($expected, $actual, "sync's converstion to Redis protocol failed.");
	}

	function test_time() {
		$actual   = $this->getInst()->time();
		$expected = "*1\r\n$4\r\ntime\r\n";
		$this->assertEquals($expected, $actual, "time's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_clientKillType_exception() {
		$this->getInst()->clientKillType(E_NOTICE);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_commandInfo_exception() {
		$this->getInst()->commandInfo([]);
	}

}
