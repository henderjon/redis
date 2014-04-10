<?php

require_once "vendor/autoload.php";

FUnit::fixture("handle", function ( $string ){
	$handle = fopen("php://memory", "rw+");
	fwrite($handle, $string);
	rewind($handle);
	return $handle;
});

FUnit::test("Protocol::pull() null", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("$-1");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$pull = $reflection->getMethod("pull");
	$pull->setAccessible(true);

	$bytes = $pull->invoke( $redis, $handle, "-1" );
	$expected = null;

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::pull() small", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("*4\r\n$4\r\nabcd\r\n$4\r\nefgh\r\n$4\r\nijklm\r\n$4\r\nnopq");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$pull = $reflection->getMethod("pull");
	$pull->setAccessible(true);

	$bytes = $pull->invoke( $redis, $handle, 16 );
	$expected = "*4\r\n$4\r\nabcd\r\n$4";

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::pull() large", function(){

	$str = str_repeat("*4\r\n$4\r\nabcd\r\n$4\r\nefgh\r\n$4\r\nijklm\r\n$4\r\nnopq", 500);

	$handle = FUnit::fixture("handle");
	$handle = $handle($str);
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$pull = $reflection->getMethod("pull");
	$pull->setAccessible(true);

	$bytes = $pull->invoke( $redis, $handle, 1500 );
	$expected = substr($str, 0, 1500);

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::protocol() simple", function(){

	$base = array("sadd", "testkey", "testvalue");

	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$protocol = $reflection->getMethod("protocol");
	$protocol->setAccessible(true);

	$string = $protocol->invoke( $redis, $base );
	$expected = "*3\r\n$4\r\nsadd\r\n$7\r\ntestkey\r\n$9\r\ntestvalue\r\n";

	// FUnit::equal(1, $count, "Redis::protocol (simple) failed to return the proper number of commands");
	FUnit::equal($expected, $string);

});

FUnit::test("Protocol::pull() complex", function(){

	$base = array("sadd", array("testkey", "testvalue") );

	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$protocol = $reflection->getMethod("protocol");
	$protocol->setAccessible(true);

	$string = $protocol->invoke( $redis, $base );
	$expected = "*3\r\n$4\r\nsadd\r\n$7\r\ntestkey\r\n$9\r\ntestvalue\r\n";

	// FUnit::equal(2, $count, "Redis::protocol (complex) failed to return the proper number of commands");
	FUnit::equal($expected, $string);

});

FUnit::test("Protocol::write()", function(){

	$handle = fopen("php://memory", "rw+");

	$string = "*1\r\n$4\r\nPING\r\n";

	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$write = $reflection->getMethod("write");
	$write->setAccessible(true);

	$bytes = $write->invoke( $redis, $handle, $string );
	$expected = 14;

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::read() single", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("+OK");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$bytes = $read->invoke( $redis, $handle, 1 );
	$expected = array("OK");

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::pull() int", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle(":1234");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$bytes = $read->invoke( $redis, $handle, 1 );
	$expected = array("1234");

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::read() err", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("-ERR Operation not permitted");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$catched = false;

	try{
		$bytes = $read->invoke( $redis, $handle, 1 );
	}catch(\Exception $e){
		$catched = true;
	}

	FUnit::ok($catched);

});

FUnit::test("Protocol::read() bulk", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("$4\r\nPONG\r\n");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$bytes = $read->invoke( $redis, $handle, 1 );
	$expected = array("PONG");

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::read() bulk empty", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("$0\r\n\r\n");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$bytes = $read->invoke( $redis, $handle, 1 );
	$expected = array("");

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::read() bulk null", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("$-1\r\n");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$bytes = $read->invoke( $redis, $handle, 1 );
	$expected = array(null);

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::read() bulk multi", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("*2\r\n$4\r\nPING\r\n$4\r\nPONG\r\n");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$bytes = $read->invoke( $redis, $handle, 1 );
	$expected = array(array("PING", "PONG"));

	FUnit::equal($expected, $bytes);

});


FUnit::test("Protocol::read() bulk multi multi", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("$4\r\nPING\r\n$4\r\nPONG\r\n");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$bytes = $read->invoke( $redis, $handle, 2 );
	$expected = array("PING", "PONG");

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::read() bulk nested multi", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("*2\r\n*2\r\n$4\r\nPING\r\n$4\r\nPONG\r\n*2\r\n$4\r\nPING\r\n$4\r\nPONG\r\n");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$bytes = $read->invoke( $redis, $handle, 1 );
	$expected = array(array(array("PING", "PONG"), array("PING", "PONG")));

	FUnit::equal($expected, $bytes);

});

FUnit::test("Protocol::read() bulk mixed multi", function(){

	$handle = FUnit::fixture("handle");
	$handle = $handle("*2\r\n*2\r\n$4\r\nPING\r\n$4\r\nPONG\r\n$8\r\nPINGPONG\r\n");
	$redis = new \Redis\Redis;

	$reflection = new ReflectionClass($redis);
	$read = $reflection->getMethod("read");
	$read->setAccessible(true);

	$bytes = $read->invoke( $redis, $handle, 1 );
	$expected = array(array(array("PING", "PONG"), "PINGPONG"));

	FUnit::equal($expected, $bytes);

});


