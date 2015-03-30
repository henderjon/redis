<?php

trait ServerMethodsTrait {

    function bgrewriteaof() {
        //  Asynchronously rewrite the append-only file
    }

    function bgsave() {
        //  Asynchronously save the dataset to disk
    }

    function clientKill($ip, $id, $type, $addr, $skipme) {
        //  KILL [ip:port] [ID client-id] [TYPE normal|slave|pubsub] [ADDR ip:port] [SKIPME yes/no] Kill the connection of a client
    }

    function clientList() {
        //  LIST Get the list of client connections
    }

    function clientGetName() {
        //  GETNAME Get the current connection name
    }

    function clientPause($timeout) {
        //  PAUSE timeout Stop processing commands from clients for some time
    }

    function clientSetName($name) {
        //  SETNAME connection-name Set the current connection name
    }

    function command() {
        //  Get array of Redis command details
    }

    function commandCount() {
        //  COUNT Get total number of Redis commands
    }

    function commandGetKeys() {
        //  GETKEYS Extract keys given a full Redis command
    }

    function commandInfo(array $commands) {
        //  INFO command-name [command-name ...] Get array of specific Redis command details
    }

    function configGet($param) {
        //  GET parameter Get the value of a configuration parameter
    }

    function configRewrite() {
        //  REWRITE Rewrite the configuration file with the in memory configuration
    }

    function configSet($param, $value) {
        //  SET parameter value Set a configuration parameter to the given value
    }

    function configResetStat() {
        //  RESETSTAT Reset the stats returned by INFO
    }

    function dbsize() {
        //  Return the number of keys in the selected database
    }

    function debugObject($key) {
        //  OBJECT key Get debugging information about a key
    }

    function debugSegFault() {
        //  SEGFAULT Make the server crash
    }

    function flushall() {
        //  Remove all keys from all databases
    }

    function flushdb() {
        //  Remove all keys from the current database
    }

    function info($section = "") {
        //  [section] Get information and statistics about the server
    }

    function lastsave() {
        //  Get the UNIX time stamp of the last successful save to disk
    }

    function monitor() {
        //  Listen for all requests received by the server in real time
    }

    function role() {
        //  Return the role of the instance in the context of replication
    }

    function save() {
        //  Synchronously save the dataset to disk
    }

    function shutdown($save) {
        //  [NOSAVE] [SAVE] Synchronously save the dataset to disk and then shut down the server
    }

    function slaveof($host, $port) {
        //  host port Make the server a slave of another instance, or promote it as master
    }

    function slowlog($subcommand, $arg = "") {
        //  subcommand [argument] Manages the Redis slow queries log
    }

    function sync() {
        //  Internal command used for replication
    }

    function time() {
        //  Return the current server time
    }


}