<?php

require "vendor/autoload.php";

$config = array(
	"hostname" => "",
	"hostport" => "",
	"password" => "",
	"database" => "",
);

//overwrite our examples
$conf = dirname(__DIR__) . "/conf/config.ini";
if(file_exists($conf)){
	$config = parse_ini_file($conf);
}

$redis = (new \Redis\RedisSubscription)->connect($config["hostname"], $config["hostport"]);

list($details, $listener) = $redis->subscribe(["channel-one", "channel-two"]);

foreach($details as $info){
	// print_r($channel);
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





