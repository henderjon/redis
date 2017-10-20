<?php

namespace PubSubMethodsTraitTest;

class ProperRedis extends \Redis\Redis {

	use \Redis\Traits\PubSubMethodsTrait;
	protected function exe($string, $count = 1){
		return $string;
	}
}

class PubSubMethodsTraitTest extends \PHPUnit_Framework_TestCase {

	function getInst(){
		return new ProperRedis;
	}

	function test_psubscribe() {
		$actual   = $this->getInst()->psubscribe(["testkey1", "testkey2"]);
		$expected = "*3\r\n$10\r\npsubscribe\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "psubscribe's converstion to Redis protocol failed.");
	}

	function test_pubsubChannels() {
		$actual   = $this->getInst()->pubsubChannels(["testkey1", "testkey2"]);
		$expected = "*4\r\n$6\r\npubsub\r\n$8\r\nchannels\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "pubsubChannels's converstion to Redis protocol failed.");
	}

	function test_pubsubNumsub() {
		$actual   = $this->getInst()->pubsubNumsub(["testkey1", "testkey2"]);
		$expected = "*4\r\n$6\r\npubsub\r\n$6\r\nnumsub\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "pubsubNumsub's converstion to Redis protocol failed.");
	}

	function test_pubsubNumpat() {
		$actual   = $this->getInst()->pubsubNumpat(["testkey1", "testkey2"]);
		$expected = "*4\r\n$6\r\npubsub\r\n$6\r\nnumpat\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "pubsubNumpat's converstion to Redis protocol failed.");
	}

	function test_publish() {
		$actual   = $this->getInst()->publish(["testkey1", "testkey2"], "Hello-Keith");
		$expected = "*4\r\n$7\r\npublish\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n$11\r\nHello-Keith\r\n";
		$this->assertEquals($expected, $actual, "publish's converstion to Redis protocol failed.");
	}

	function test_punsubscribe() {
		$actual   = $this->getInst()->punsubscribe(["testkey1", "testkey2"]);
		$expected = "*3\r\n$12\r\npunsubscribe\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "punsubscribe's converstion to Redis protocol failed.");
	}

	function test_subscribe() {
		$actual   = $this->getInst()->subscribe(["testkey1", "testkey2"]);
		$expected = "*3\r\n$9\r\nsubscribe\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "subscribe's converstion to Redis protocol failed.");
	}

	function test_unsubscribe() {
		$actual   = $this->getInst()->unsubscribe(["testkey1", "testkey2"]);
		$expected = "*3\r\n$11\r\nunsubscribe\r\n$8\r\ntestkey1\r\n$8\r\ntestkey2\r\n";
		$this->assertEquals($expected, $actual, "unsubscribe's converstion to Redis protocol failed.");
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_psubscribe_exception() {
		$this->getInst()->psubscribe([]);
	}

	/**
	 * @expectedException Redis\RedisException
	 */
	function test_subscribe_exception() {
		$this->getInst()->subscribe([]);
	}

}
