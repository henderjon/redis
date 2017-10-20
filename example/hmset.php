<?php

return function(\Redis\Redis $redis){

	$label = "==== HMSET =====";

	echo "\n\n{$label}\n\n";

	$redis->hmset("hash:one", ["key:one", "value:one"]);
	$redis->hmset("hash:one", ["key:two", "value:two"]);
	$redis->hmset("hash:two", ["key:two", "value:two"]);

	//NOT AN ASSOCIATIVE ARRAY
	$redis->hmset("hash:three", [
		"key:one", 1, "key:two", 2
	]);

	$keys   = $redis->hkeys("hash:three");
	$values = $redis->hvals("hash:three");

	echo "Keys: ". implode(", ", $keys) . "\n";
	echo "Values: ". implode(", ", $values) . "\n";

	echo "\n\n".str_repeat("=", strlen($label))."\n\n";

};
