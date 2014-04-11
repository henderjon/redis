<?php
/**
 * There is a limitation in this test in that the IO to a memory buffer
 * only verifies that The class is writing correctly. In a real Redis
 * environment, the buffer woul dhave NEW contents after being written
 * to.
 *
 * Redis::exec can't really be tested because the memory buffer we're
 * using needs to be rewound mid-function. It is however a safe bet that
 * if the protocol passes it's tests that reading/writing should be
 * fine.
 */

require_once "vendor/autoload.php";

FUnit::fixture("handle", function($inst, $memory){
		$reflection = new ReflectionClass($inst);
		$handle = $reflection->getProperty("handle");
		$handle->setAccessible(true);
		$handle->setValue($inst, $memory);
		return $inst;
	});

FUnit::test("Redis::__call() simple", function(){

	$redis = new \Redis\Redis;

	$memory = fopen("php://memory", "rw+");
	$handle = FUnit::fixture("handle");
	$redis = $handle($redis, $memory);

	$redis->sadd("key", "value");

	rewind($memory);
	$result = fread($memory, 36);

	$expected = "*3\r\n$4\r\nsadd\r\n$3\r\nkey\r\n$5\r\nvalue\r\n";

	FUnit::equal($expected, $result);

});

FUnit::test("Redis::__call() complex", function(){

	$redis = new \Redis\Redis;

	$memory = fopen("php://memory", "rw+");
	$handle = FUnit::fixture("handle");
	$redis = $handle($redis, $memory);

	$redis->sadd(array("key", "value"));

	rewind($memory);
	$result = fread($memory, 36);

	$expected = "*3\r\n$4\r\nsadd\r\n$3\r\nkey\r\n$5\r\nvalue\r\n";

	FUnit::equal($expected, $result);

});

FUnit::test("Redis::pipe() simple", function(){

	$base = array(
		array("sadd", "testkey1", "testvalue1"),
		array("sadd", "testkey2", "testvalue2"),
	);

	$redis = new \Redis\Redis;

	$memory = fopen("php://memory", "rw+");
	$handle = FUnit::fixture("handle");
	$redis = $handle($redis, $memory);

	$redis->pipe($base);

	rewind($memory);
	$result = fread($memory, 94);

	$expected = "*3\r\n$4\r\nsadd\r\n$8\r\ntestkey1\r\n$10\r\ntestvalue1\r\n\r\n*3\r\n$4\r\nsadd\r\n$8\r\ntestkey2\r\n$10\r\ntestvalue2\r\n\r\n";

	FUnit::equal($expected, $result);

});

FUnit::test("Redis::pipe() complex", function(){

	$base = array(
		array("sadd", array("testkey1", "testvalue1") ),
		array("sadd", array("testkey2", "testvalue2") ),
	);

	$redis = new \Redis\Redis;

	$memory = fopen("php://memory", "rw+");
	$handle = FUnit::fixture("handle");
	$redis = $handle($redis, $memory);

	$r = $redis->pipe($base);


	rewind($memory);
	$result = fread($memory, 94);

	$expected = "*3\r\n$4\r\nsadd\r\n$8\r\ntestkey1\r\n$10\r\ntestvalue1\r\n\r\n*3\r\n$4\r\nsadd\r\n$8\r\ntestkey2\r\n$10\r\ntestvalue2\r\n\r\n";

	FUnit::equal($expected, $result);

});

