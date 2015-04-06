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

list($details, $listener) = $redis->subscribeTo(["channel-one", "channel-two"]);

print_r($details);

while($r = $listener()){
	print_r($r);
	echo "\n\n";
}





