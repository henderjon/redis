<?php

$redis = require(__DIR__ . "/bootstrap.php");

$label = "==== SSCAN =====";

echo "\n\n{$label}\n\n";

$i = 1;
while(($i += 1) < 2000){
	$redis->sadd("testkey", $i);
}

$cursor = 0;
while(list($cursor, $elems) = $redis->sscan("testkey", $cursor)){

	echo "Cursor: {$cursor} ... Count: " . count($elems) . "\n";

	if($cursor == 0){ break; }
}

echo "\n\n".str_repeat("=", strlen($label))."\n\n";





