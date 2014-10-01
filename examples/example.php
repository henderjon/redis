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

// $redis->auth($config["password"]);
// $redis->select($config["database"]);

$hmset = require(__DIR__ . "/hmset.php");
$hmset($redis);

$sscan = require(__DIR__ . "/sscan.php");
$sscan($redis);