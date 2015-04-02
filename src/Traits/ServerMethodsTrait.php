<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ServerMethodsTrait {

	abstract protected function getKillType($type);

	/**
	 * Asynchronously rewrite the append-only file
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function bgrewriteaof() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Asynchronously save the dataset to disk
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function bgsave() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Kill the connection of a client
	 * for complete documentation: http://redis.io/commands#server
	 * @params KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no]
	 */
	public function clientKillAddr($ip, $skipme = true) {
		$skipme = $skipme ? "yes" : "no";
		return $this->exe( $this->protocol( "client", "kill", "addr", $ip, "skipme", $skipme ) );
	}

	/**
	 * Kill the connection of a client
	 * for complete documentation: http://redis.io/commands#server
	 * @params KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no]
	 */
	public function clientKillId($id, $skipme = true) {
		$skipme = $skipme ? "yes" : "no";
		return $this->exe( $this->protocol( "client", "kill", "id", $id, "skipme", $skipme ) );
	}

	/**
	 * Kill the connection of a client
	 * for complete documentation: http://redis.io/commands#server
	 * @params KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no]
	 */
	public function clientKillType($type, $skipme = true) {
		if(!($type = $this->getKillType($type))){
			throw new RedisException("(" . __FUNCTION__ . ") A valid type is required (e.g. normal|slave|pubsub).");
		}

		$skipme = $skipme ? "yes" : "no";
		return $this->exe( $this->protocol( "client", "kill", "type", $type, "skipme", $skipme ) );
	}

	/**
	 * Get the list of client connections
	 * for complete documentation: http://redis.io/commands#server
	 * @params LIST
	 */
	public function clientList() {
		return $this->exe( $this->protocol( "client", "list" ) );
	}

	/**
	 * Get the current connection name
	 * for complete documentation: http://redis.io/commands#server
	 * @params GETNAME
	 */
	public function clientGetName() {
		return $this->exe( $this->protocol( "client", "getname" ) );
	}

	/**
	 * Stop processing commands from clients for some time
	 * for complete documentation: http://redis.io/commands#server
	 * @params PAUSE timeout
	 */
	public function clientPause($timeout) {
		return $this->exe( $this->protocol( "client", "pause", $timeout ) );
	}

	/**
	 * Set the current connection name
	 * for complete documentation: http://redis.io/commands#server
	 * @params SETNAME connection-name
	 */
	public function clientSetName($name) {
		return $this->exe( $this->protocol( "client", "setname", $name ) );
	}

	/**
	 * Get array of Redis command details
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function command() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Get total number of Redis commands
	 * for complete documentation: http://redis.io/commands#server
	 * @params COUNT
	 */
	public function commandCount() {
		return $this->exe( $this->protocol( "command", "count" ) );
	}

	/**
	 * Extract keys given a full Redis command
	 * for complete documentation: http://redis.io/commands#server
	 * @params GETKEYS
	 */
	public function commandGetKeys() {
		return $this->exe( $this->protocol( "command", "getkeys" ) );
	}

	/**
	 * Get array of specific Redis command details
	 * for complete documentation: http://redis.io/commands#server
	 * @params INFO command-name [command-name ...]
	 */
	public function commandInfo(array $commands) {
		if(count($commands) < 1 ){
			throw new RedisException("(" . __FUNCTION__ . ") At least one command is required.");
		}
		return $this->exe( $this->protocol( "command", "info", $commands ) );
	}

	/**
	 * Get the value of a configuration parameter
	 * for complete documentation: http://redis.io/commands#server
	 * @params GET parameter
	 */
	public function configGet($param) {
		return $this->exe( $this->protocol( "config", "get", $param ) );
	}

	/**
	 * Rewrite the configuration file with the in memory configuration
	 * for complete documentation: http://redis.io/commands#server
	 * @params REWRITE
	 */
	public function configRewrite() {
		return $this->exe( $this->protocol( "config", "rewrite" ) );
	}

	/**
	 * Set a configuration parameter to the given value
	 * for complete documentation: http://redis.io/commands#server
	 * @params SET parameter value
	 */
	public function configSet($param, $value) {
		return $this->exe( $this->protocol( "config", "set", $param, $value ) );
	}

	/**
	 * Reset the stats returned by INFO
	 * for complete documentation: http://redis.io/commands#server
	 * @params RESETSTAT
	 */
	public function configResetStat() {
		return $this->exe( $this->protocol( "config", "resetstat" ) );
	}

	/**
	 * Return the number of keys in the selected database
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function dbsize() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Get debugging information about a key
	 * for complete documentation: http://redis.io/commands#server
	 * @params OBJECT key
	 */
	public function debugObject($key) {
		return $this->exe( $this->protocol( "debug", "object", $key ) );
	}

	/**
	 * Make the server crash
	 * for complete documentation: http://redis.io/commands#server
	 * @params SEGFAULT
	 */
	public function debugSegFault() {
		return $this->exe( $this->protocol( "debug", "segfault" ) );
	}

	/**
	 * Remove all keys from all databases
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function flushall() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Remove all keys from the current database
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function flushdb() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Get information and statistics about the server
	 * for complete documentation: http://redis.io/commands#server
	 * @params [section]
	 */
	public function info($section = null) {
		return $this->exe( $this->protocol( __FUNCTION__, $section ) );
	}

	/**
	 * Get the UNIX time stamp of the last successful save to disk
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function lastsave() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Listen for all requests received by the server in real time
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function monitor() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Return the role of the instance in the context of replication
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function role() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Synchronously save the dataset to disk
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function save() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * for complete documentation: http://redis.io/commands#server
	 * @params [NOSAVE] [SAVE]
	 */
	public function shutdown() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * for complete documentation: http://redis.io/commands#server
	 * @params [NOSAVE] [SAVE]
	 */
	public function shutdownSave() {
		return $this->exe( $this->protocol( "shutdown", "save" ) );
	}

	/**
	 * Synchronously save the dataset to disk and then shut down the server
	 * for complete documentation: http://redis.io/commands#server
	 * @params [NOSAVE] [SAVE]
	 */
	public function shutdownNoSave() {
		return $this->exe( $this->protocol( "shutdown", "nosave" ) );
	}

	/**
	 * Make the server a slave of another instance, or promote it as master
	 * for complete documentation: http://redis.io/commands#server
	 * @params host port
	 */
	public function slaveof($host, $port) {
		return $this->exe( $this->protocol( __FUNCTION__, $host, $port ) );
	}

	/**
	 * Manages the Redis slow queries log
	 * for complete documentation: http://redis.io/commands#server
	 * @params subcommand [argument]
	 */
	public function slowlog($subcommand, $arg = null) {
		return $this->exe( $this->protocol( __FUNCTION__, $subcommand, $arg ) );
	}

	/**
	 * Internal command used for replication
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function sync() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}

	/**
	 * Return the current server time
	 * for complete documentation: http://redis.io/commands#server
	 */
	public function time() {
		return $this->exe( $this->protocol( __FUNCTION__ ) );
	}


}