<?php

namespace Redis\Interfaces;

interface ServerMethodsInterface {

	function bgrewriteaof();
	function bgsave();
	function clientKillAddr($ip, $skipme = true);
	function clientKillId($id, $skipme = true);
	function clientKillType($type, $skipme = true);
	function clientList();
	function clientGetName();
	function clientPause($timeout);
	function clientSetName($name);
	function command();
	function commandCount();
	function commandGetKeys();
	function commandInfo(array $commands);
	function configGet($param);
	function configRewrite();
	function configSet($param, $value);
	function configResetStat();
	function dbsize();
	function debugObject($key);
	function debugSegFault();
	function flushall();
	function flushdb();
	function info($section = null);
	function lastsave();
	function monitor();
	function role();
	function save();
	function shutdown();
	function shutdownSave();
	function shutdownNoSave();
	function slaveof($host, $port);
	function slowlog($subcommand, $arg = null);
	function sync();
	function time();

}
