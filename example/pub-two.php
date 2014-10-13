<?php

$redis = require(__DIR__ . "/bootstrap.php");

$messages = [
	"first message"  => 1,
	"second message" => 3,
	"SUBSCRIBE"  => 2,
	"third message"  => 2,
	"fourth message" => 2,
	"fifth message"  => 2,
];

$channel = "channel-two";

foreach($messages as $message => $sleep){
	$redis->publish($channel, "{$message} -- {$sleep}");
	sleep($sleep);
}

