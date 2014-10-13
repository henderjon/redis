<?php

$redis = require(__DIR__ . "/bootstrap.php");

$messages = [
	"first message"  => 2,
	"second message" => 4,
	"third message"  => 1,
	"fourth message" => 6,
	"fifth message"  => 2,
];

$channel = "channel-one";

foreach($messages as $message => $sleep){
	$redis->publish($channel, "{$message} -- {$sleep}");
	sleep($sleep);
}

