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

