<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ServerMethodsTrait {

	const KILL_TYPE_NORMAL = 101;
	const KILL_TYPE_SLAVE  = 102;
	const KILL_TYPE_PUBSUB = 103;

	protected $kill_types = [
		101 => "normal",
		102 => "slave",
		103 => "pubsub",
	];

	/**
	 * Asynchronously rewrite the append-only file
	 */
	function bgrewriteaof() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Asynchronously save the dataset to disk
	 */
	function bgsave() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Kill the connection of a client
	 * @params KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no]
	 */
	function clientKillAddr($ip, $skipme = true) {
		$skipme = $skipme ? "yes" : "no";
		return $this->exec( $this->protocol( "CLIENT", "KILL", "ADDR", $ip, "SKIPME", $skipme ) );
	}

	/**
	 * Kill the connection of a client
	 * @params KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no]
	 */
	function clientKillId($id, $skipme = true) {
		$skipme = $skipme ? "yes" : "no";
		return $this->exec( $this->protocol( "CLIENT", "KILL", "ID", $id, "SKIPME", $skipme ) );
	}

	/**
	 * Kill the connection of a client
	 * @params KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no]
	 */
	function clientKillType($type, $skipme = true) {
		if(!array_key_exists($type, $this->kill_types)){
			throw new RedisException("(" . __FUNCTION__ . ") A valid type is required (e.g. normal|slave|pubsub).");
		}

		$type   = $this->kill_types[$type];
		$skipme = $skipme ? "yes" : "no";
		return $this->exec( $this->protocol( "CLIENT", "KILL", "TYPE", $type, "SKIPME", $skipme ) );
	}

	/**
	 * Get the list of client connections
	 * @params LIST
	 */
	function clientList() {
		return $this->exec( $this->protocol( "CLIENT", "LIST" ) );
	}

	/**
	 * Get the current connection name
	 * @params GETNAME
	 */
	function clientGetName() {
		return $this->exec( $this->protocol( "CLIENT", "GETNAME" ) );
	}

	/**
	 * Stop processing commands from clients for some time
	 * @params PAUSE timeout
	 */
	function clientPause($timeout) {
		return $this->exec( $this->protocol( "CLIENT", "PAUSE", $timeout ) );
	}

	/**
	 * Set the current connection name
	 * @params SETNAME connection-name
	 */
	function clientSetName($name) {
		return $this->exec( $this->protocol( "CLIENT", "SETNAME", $name ) );
	}

	/**
	 * Get array of Redis command details
	 */
	function command() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Get total number of Redis commands
	 * @params COUNT
	 */
	function commandCount() {
		return $this->exec( $this->protocol( "COMMAND", "COUNT" ) );
	}

	/**
	 * Extract keys given a full Redis command
	 * @params GETKEYS
	 */
	function commandGetKeys() {
		return $this->exec( $this->protocol( "COMMAND", "GETKEYS" ) );
	}

	/**
	 * Get array of specific Redis command details
	 * @params INFO command-name [command-name ...]
	 */
	function commandInfo(array $commands) {
		if(count($commands) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one command is required.");
		}
		return $this->exec( $this->protocol( "COMMAND", "INFO", $commands ) );
	}

	/**
	 * Get the value of a configuration parameter
	 * @params GET parameter
	 */
	function configGet($param) {
		return $this->exec( $this->protocol( "CONFIG", "GET", $param ) );
	}

	/**
	 * Rewrite the configuration file with the in memory configuration
	 * @params REWRITE
	 */
	function configRewrite() {
		return $this->exec( $this->protocol( "CONFIG", "REWRITE" ) );
	}

	/**
	 * Set a configuration parameter to the given value
	 * @params SET parameter value
	 */
	function configSet($param, $value) {
		return $this->exec( $this->protocol( "CONFIG", "SET", $param, $value ) );
	}

	/**
	 * Reset the stats returned by INFO
	 * @params RESETSTAT
	 */
	function configResetStat() {
		return $this->exec( $this->protocol( "CONFIG", "RESETSTAT" ) );
	}

	/**
	 * Return the number of keys in the selected database
	 */
	function dbsize() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Get debugging information about a key
	 * @params OBJECT key
	 */
	function debugObject($key) {
		return $this->exec( $this->protocol( "DEBUG", "OBJECT", $key ) );
	}

	/**
	 * Make the server crash
	 * @params SEGFAULT
	 */
	function debugSegFault() {
		return $this->exec( $this->protocol( "DEBUG", "SEGFAULT" ) );
	}

	/**
	 * Remove all keys from all databases
	 */
	function flushall() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Remove all keys from the current database
	 */
	function flushdb() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Get information and statistics about the server
	 * @params [section]
	 */
	function info($section = "") {
		return $this->exec( $this->protocol( __FUNCTION__, $section ) );
	}

	/**
	 * Get the UNIX time stamp of the last successful save to disk
	 */
	function lastsave() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Listen for all requests received by the server in real time
	 */
	function monitor() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Return the role of the instance in the context of replication
	 */
	function role() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Synchronously save the dataset to disk
	 */
	function save() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * @params [NOSAVE] [SAVE]
	 */
	function shutdown() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * @params [NOSAVE] [SAVE]
	 */
	function shutdownSave() {
		return $this->exec( $this->protocol( "SHUTDOWN", "SAVE" ) );
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * @params [NOSAVE] [SAVE]
	 */
	function shutdownNoSave() {
		return $this->exec( $this->protocol( "SHUTDOWN", "NOSAVE" ) );
	}

	/**
	 * Make the server a slave of another instance, or promote it as master
	 * @params host port
	 */
	function slaveof($host, $port) {
		return $this->exec( $this->protocol( __FUNCTION__, $host, $port ) );
	}

	/**
	 * Manages the Redis slow queries log
	 * @params subcommand [argument]
	 */
	function slowlog($subcommand, $arg = "") {
		return $this->exec( $this->protocol( __FUNCTION__, $subcommand, $arg ) );
	}

	/**
	 * Internal command used for replication
	 */
	function sync() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Return the current server time
	 */
	function time() {
		return $this->exec( $this->protocol( __FUNCTION__ ) );
	}


}