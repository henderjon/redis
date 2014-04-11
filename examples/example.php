<?php

require "vendor/autoload.php";

$config = array(
	"hostname" => "",
	"hostport" => "",
	"password" => "",
	"database" => "",
);

//overwrite our examples
if(file_exists("conf/config.ini")){
	$config = parse_ini_file("conf/config.ini");
}

$redis = new \Redis\Redis;

$redis->connect($config["hostname"], $config["hostport"]);

$redis->auth($config["password"]);
$redis->select($config["database"]);

$redis->hmset("hash:one", "key:one", "value:one");
$redis->hmset("hash:one", "key:two", "value:two");
$redis->hmset("hash:two", "key:two", "value:two");

$redis->hmset("hash:three", array(
	"key:one", 1, "key:two", 2
));

$keys   = $redis->hkeys("hash:three");
$values = $redis->hvals("hash:three");

print_r($keys);
print_r($values);