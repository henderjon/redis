<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ServerMethodsTrait {

	/**
	 * Asynchronously rewrite the append-only file
	 */
	function bgrewriteaof() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Asynchronously save the dataset to disk
	 */
	function bgsave() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Kill the connection of a client
	 * @params KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no]
	 */
	function clientKillAddr($ip, $skipme = true) {
		$skipme = $skipme ? "yes" : "no";
		return $this->exe( $this->protocol( "client", "kill", "addr", $ip, "skipme", $skipme ) );
	}

	/**
	 * Kill the connection of a client
	 * @params KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no]
	 */
	function clientKillId($id, $skipme = true) {
		$skipme = $skipme ? "yes" : "no";
		return $this->exe( $this->protocol( "client", "kill", "id", $id, "skipme", $skipme ) );
	}

	/**
	 * Kill the connection of a client
	 * @params KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no]
	 */
	function clientKillType($type, $skipme = true) {
		if(!($type = $this->getKillType($type))){
			throw new RedisException("(" . __FUNCTION__ . ") A valid type is required (e.g. normal|slave|pubsub).");
		}

		$skipme = $skipme ? "yes" : "no";
		return $this->exe( $this->protocol( "client", "kill", "type", $type, "skipme", $skipme ) );
	}

	/**
	 * Get the list of client connections
	 * @params LIST
	 */
	function clientList() {
		return $this->exe( $this->protocol( "client", "list" ) );
	}

	/**
	 * Get the current connection name
	 * @params GETNAME
	 */
	function clientGetName() {
		return $this->exe( $this->protocol( "client", "getname" ) );
	}

	/**
	 * Stop processing commands from clients for some time
	 * @params PAUSE timeout
	 */
	function clientPause($timeout) {
		return $this->exe( $this->protocol( "client", "pause", $timeout ) );
	}

	/**
	 * Set the current connection name
	 * @params SETNAME connection-name
	 */
	function clientSetName($name) {
		return $this->exe( $this->protocol( "client", "setname", $name ) );
	}

	/**
	 * Get array of Redis command details
	 */
	function command() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Get total number of Redis commands
	 * @params COUNT
	 */
	function commandCount() {
		return $this->exe( $this->protocol( "command", "count" ) );
	}

	/**
	 * Extract keys given a full Redis command
	 * @params GETKEYS
	 */
	function commandGetKeys() {
		return $this->exe( $this->protocol( "command", "getkeys" ) );
	}

	/**
	 * Get array of specific Redis command details
	 * @params INFO command-name [command-name ...]
	 */
	function commandInfo(array $commands) {
		if(count($commands) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one command is required.");
		}
		return $this->exe( $this->protocol( "command", "info", $commands ) );
	}

	/**
	 * Get the value of a configuration parameter
	 * @params GET parameter
	 */
	function configGet($param) {
		return $this->exe( $this->protocol( "config", "get", $param ) );
	}

	/**
	 * Rewrite the configuration file with the in memory configuration
	 * @params REWRITE
	 */
	function configRewrite() {
		return $this->exe( $this->protocol( "config", "rewrite" ) );
	}

	/**
	 * Set a configuration parameter to the given value
	 * @params SET parameter value
	 */
	function configSet($param, $value) {
		return $this->exe( $this->protocol( "config", "set", $param, $value ) );
	}

	/**
	 * Reset the stats returned by INFO
	 * @params RESETSTAT
	 */
	function configResetStat() {
		return $this->exe( $this->protocol( "config", "resetstat" ) );
	}

	/**
	 * Return the number of keys in the selected database
	 */
	function dbsize() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Get debugging information about a key
	 * @params OBJECT key
	 */
	function debugObject($key) {
		return $this->exe( $this->protocol( "debug", "object", $key ) );
	}

	/**
	 * Make the server crash
	 * @params SEGFAULT
	 */
	function debugSegFault() {
		return $this->exe( $this->protocol( "debug", "segfault" ) );
	}

	/**
	 * Remove all keys from all databases
	 */
	function flushall() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Remove all keys from the current database
	 */
	function flushdb() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Get information and statistics about the server
	 * @params [section]
	 */
	function info($section = null) {
		return $this->exe( $this->protocol( __FUNCTION__, $section ) );
	}

	/**
	 * Get the UNIX time stamp of the last successful save to disk
	 */
	function lastsave() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Listen for all requests received by the server in real time
	 */
	function monitor() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Return the role of the instance in the context of replication
	 */
	function role() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Synchronously save the dataset to disk
	 */
	function save() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * @params [NOSAVE] [SAVE]
	 */
	function shutdown() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * @params [NOSAVE] [SAVE]
	 */
	function shutdownSave() {
		return $this->exe( $this->protocol( "shutdown", "save" ) );
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * @params [NOSAVE] [SAVE]
	 */
	function shutdownNoSave() {
		return $this->exe( $this->protocol( "shutdown", "nosave" ) );
	}

	/**
	 * Make the server a slave of another instance, or promote it as master
	 * @params host port
	 */
	function slaveof($host, $port) {
		return $this->exe( $this->protocol( __FUNCTION__, $host, $port ) );
	}

	/**
	 * Manages the Redis slow queries log
	 * @params subcommand [argument]
	 */
	function slowlog($subcommand, $arg = null) {
		return $this->exe( $this->protocol( __FUNCTION__, $subcommand, $arg ) );
	}

	/**
	 * Internal command used for replication
	 */
	function sync() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Return the current server time
	 */
	function time() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}


}