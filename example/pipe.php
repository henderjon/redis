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

$redis = (new \Redis\RedisProtocol)->connect($config["hostname"], $config["hostport"]);

// $redis->auth($config["password"]);
// $redis->select($config["database"]);


$pipe = [
	["set", "one", 5],
	["set", "two", 6],
	["set", "three", 7],
];

$redis->pipe($pipe);

echo $redis->get("three");
