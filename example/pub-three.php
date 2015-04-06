<?php

$redis = require(__DIR__ . "/bootstrap.php");

$messages = [
	"first message"  => 9,
	"second message" => 8,
	"third message"  => 7,
	"fourth message" => 6,
	"fifth message"  => 5,
];

$channel = "channel-three";

foreach($messages as $message => $sleep){
	$redis->publish($channel, "{$message} -- {$sleep}");
	sleep($sleep);
}

