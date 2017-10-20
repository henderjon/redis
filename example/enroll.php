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

$redis = (new \Redis\Redis)->connect($config["hostname"], $config["hostport"]);
$redis->select(12);

$errors = [
	JSON_ERROR_NONE                  => "JSON_ERROR_NONE",
	JSON_ERROR_DEPTH                 => "JSON_ERROR_DEPTH",
	JSON_ERROR_STATE_MISMATCH        => "JSON_ERROR_STATE_MISMATCH",
	JSON_ERROR_CTRL_CHAR             => "JSON_ERROR_CTRL_CHAR",
	JSON_ERROR_SYNTAX                => "JSON_ERROR_SYNTAX",
	JSON_ERROR_UTF8                  => "JSON_ERROR_UTF8",
	JSON_ERROR_RECURSION             => "JSON_ERROR_RECURSION",
	JSON_ERROR_INF_OR_NAN            => "JSON_ERROR_INF_OR_NAN",
	JSON_ERROR_UNSUPPORTED_TYPE      => "JSON_ERROR_UNSUPPORTED_TYPE",
	JSON_ERROR_INVALID_PROPERTY_NAME => "JSON_ERROR_INVALID_PROPERTY_NAME",
	JSON_ERROR_UTF16                 => "JSON_ERROR_UTF16",
];

// execution
$accountId = $argv[1];
$type      = "noop";
$key       = sprintf("/queue/%d/%s", $accountId, $type);
$cursor    = 0;
$page      = [];
while (true) {
	list ($cursor, $elems) = $redis->sscan($key, $cursor, null, 1000);
	foreach ($elems as $elem) {

		fputcsv(STDOUT, [
			$cursor, count($elems), $elem,
		]);

		$page[] = json_decode($elem, true);
		if(($err = json_last_error()) !== JSON_ERROR_NONE){
			fwrite(STDERR, $elem . PHP_EOL);
			fwrite(STDERR, $errors[$err] . "\t" . json_last_error_msg() . PHP_EOL);
			exit();
		}

	}

	if (! $page) {
		drop($page);
	}

	// echo count($page) . PHP_EOL;

	$page = [];
	// if ($cursor == 0) { break; }
}


