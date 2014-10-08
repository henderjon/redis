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

$redis = new \Redis\Redis;

$redis->connect($config["hostname"], $config["hostport"]);

$messages = [
	"first message"  => 1,
	"second message" => 3,
	"third message"  => 2,
	"fourth message" => 2,
	"fifth message"  => 2,
];

$channel = "channel-two";

foreach($messages as $message => $sleep){
	$redis->publish($channel, "{$message} -- {$sleep}");
	sleep($sleep);
}

