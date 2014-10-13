<?php

$redis = require(__DIR__ . "/bootstrap.php");

list($details, $listener) = $redis->subscribe(["channel-one", "channel-two"]);

foreach($details as $info){
	list($type, $channel, $message) = $info;
	echo "Type:    {$type}\n";
	echo "Channel: {$channel}\n";
	echo "Message: {$message}\n";
	echo "===================\n\n";
}

echo "\n\n";

while(list($type, $channel, $message) = $listener()){
	echo "Type:    {$type}\n";
	echo "Channel: {$channel}\n";
	echo "Message: {$message}\n";
	echo "===================\n\n";

	if(strpos($message, "SUBSCRIBE") !== false){
		list($details, $listener) = $redis->subscribe(["channel-three"]);
		list($type, $channel, $message) = $details;
		echo "Type:    {$type}\n";
		echo "Channel: {$channel}\n";
		echo "Message: {$message}\n";
		echo "===================\n\n";
	}

}





