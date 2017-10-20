<?php

namespace KeyMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\KeyMethodsTrait;

	protected function exe($string, $count = 1){
		return $string;
	}
}

class KeyMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_del() {
		$actual   = $this->getInst()->del(["testkey1", "testkey2"]);
		$expected = "*3\r\n$3\r\ndel\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "del's converstion to Redis protocol failed.");
	}

	function test_dump() {
		$actual   = $this->getInst()->dump("testkey1");
		$expected = "*2\r\n$4\r\ndump\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "dump's converstion to Redis protocol failed.");
	}

	function test_exists() {
		$actual   = $this->getInst()->exists("testkey1");
		$expected = "*2\r\n$6\r\nexists\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "exists's converstion to Redis protocol failed.");
	}

	function test_expire() {
		$actual   = $this->getInst()->expire("testkey1", 5);
		$expected = "*3\r\n$6\r\nexpire\r\n$8\r\ntestkey1\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "expire's converstion to Redis protocol failed.");
	}

	function test_expireat() {
		$actual   = $this->getInst()->expireat("testkey1", 12345678);
		$expected = "*3\r\n$8\r\nexpireat\r\n$8\r\ntestkey1\r\n$8\r\n12345678\r\n";
		$this->assertEquals($expected, $actual, "expireat's converstion to Redis protocol failed.");
	}

	function test_keys() {
		$actual   = $this->getInst()->keys("pattern");
		$expected = "*2\r\n$4\r\nkeys\r\n$7\r\npattern\r\n";
		$this->assertEquals($expected, $actual, "keys's converstion to Redis protocol failed.");
	}

	function test_migrate() {
		$actual   = $this->getInst()->migrate("host", "port", "key", "dest", "timeout");
		$expected = "*6\r\n$7\r\nmigrate\r\n$4\r\nhost\r\n$4\r\nport\r\n$3\r\nkey\r\n$4\r\ndest\r\n$7\r\ntimeout\r\n";
		$this->assertEquals($expected, $actual, "migrate's converstion to Redis protocol failed.");
	}

	function test_move() {
		$actual   = $this->getInst()->move("testkey1", 5);
		$expected = "*3\r\n$4\r\nmove\r\n$8\r\ntestkey1\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "move's converstion to Redis protocol failed.");
	}

	function test_objectRefcount() {
		$actual   = $this->getInst()->objectRefcount(["testkey1", "testkey2"]);
		$expected = "*4\r\n$6\r\nobject\r\n$8\r\nrefcount\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "'s cobjectRefcountonverstion to Redis protocol failed.");
	}

	function test_objectEncoding() {
		$actual   = $this->getInst()->objectEncoding(["testkey1", "testkey2"]);
		$expected = "*4\r\n$6\r\nobject\r\n$8\r\nencoding\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "'s cobjectEncodingonverstion to Redis protocol failed.");
	}

	function test_objectIdletime() {
		$actual   = $this->getInst()->objectIdletime(["testkey1", "testkey2"]);
		$expected = "*4\r\n$6\r\nobject\r\n$8\r\nidletime\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "'s cobjectIdletimeonverstion to Redis protocol failed.");
	}

	function test_persist() {
		$actual   = $this->getInst()->persist("testkey1");
		$expected = "*2\r\n$7\r\npersist\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "persist's converstion to Redis protocol failed.");
	}

	function test_pexpire() {
		$actual   = $this->getInst()->pexpire("testkey1", 1234);
		$expected = "*3\r\n$7\r\npexpire\r\n$8\r\ntestkey1\r\n$4\r\n1234\r\n";
		$this->assertEquals($expected, $actual, "pexpire's converstion to Redis protocol failed.");
	}

	function test_pexpireat() {
		$actual   = $this->getInst()->pexpireat("testkey1", 1234);
		$expected = "*3\r\n$9\r\npexpireat\r\n$8\r\ntestkey1\r\n$4\r\n1234\r\n";
		$this->assertEquals($expected, $actual, "'s cpexpireatonverstion to Redis protocol failed.");
	}

	function test_pttl() {
		$actual   = $this->getInst()->pttl("testkey1");
		$expected = "*2\r\n$4\r\npttl\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "pttl's converstion to Redis protocol failed.");
	}

	function test_randomkey() {
		$actual   = $this->getInst()->randomkey();
		$expected = "*1\r\n$9\r\nrandomkey\r\n";
		$this->assertEquals($expected, $actual, "'s crandomkeyonverstion to Redis protocol failed.");
	}

	function test_rename() {
		$actual   = $this->getInst()->rename("testkey1", "testkey2");
		$expected = "*3\r\n$6\r\nrename\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "rename's converstion to Redis protocol failed.");
	}

	function test_renamenx() {
		$actual   = $this->getInst()->renamenx("testkey1", "testkey2");
		$expected = "*3\r\n$8\r\nrenamenx\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "renamenx's converstion to Redis protocol failed.");
	}

	function test_restore() {
		$actual   = $this->getInst()->restore("testkey1", "ttl", "serialValue");
		$expected = "*5\r\n$7\r\nrestore\r\n$8\r\ntestkey1\r\n$3\r\nttl\r\n$11\r\nserialValue\r\n$7\r\nreplace\r\n";
		$this->assertEquals($expected, $actual, "restore's converstion to Redis protocol failed.");
	}

	function test_ttl() {
		$actual   = $this->getInst()->ttl("testkey1");
		$expected = "*2\r\n$3\r\nttl\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "ttl's converstion to Redis protocol failed.");
	}

	function test_type() {
		$actual   = $this->getInst()->type("testkey1");
		$expected = "*2\r\n$4\r\ntype\r\n$8\r\ntestkey1\r\n";
		$this->assertEquals($expected, $actual, "type's converstion to Redis protocol failed.");
	}

	function test_scan() {
		$actual   = $this->getInst()->scan("testkey1", "p:*:p", 5);
		$expected = "*6\r\n$4\r\nscan\r\n$8\r\ntestkey1\r\n$5\r\nmatch\r\n$5\r\np:*:p\r\n$5\r\ncount\r\n$1\r\n5\r\n";
		$this->assertEquals($expected, $actual, "scan's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_del_exception() {
		$this->getInst()->del([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_objectRefcount_exception() {
		$this->getInst()->objectRefcount([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_objectEncoding_exception() {
		$this->getInst()->objectEncoding([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_objectIdletime_exception() {
		$this->getInst()->objectIdletime([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_sort_exception() {
		$this->getInst()->sort("", "", "", "", [], "", "", "");
	}

}
