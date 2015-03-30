<?php

trait KeyMethodsTrait {

    function del(array $keys) {
        //  key [key ...] Delete a key
    }

    function dump($key) {
        //  key Return a serialized version of the value stored at the specified key.
    }

    function exists($key) {
        //  key Determine if a key exists
    }

    function expire($key, $seconds) {
        //  key seconds Set a key's time to live in seconds
    }

    function expireat($key, $timestamp) {
        //  key timestamp Set the expiration for a key as a UNIX timestamp
    }

    function keys($pattern) {
        //  pattern Find all keys matching the given pattern
    }

    function migrate($host, $port, $key, $dest, $timeout, $type) {
        //  host port key destination-db timeout [COPY] [REPLACE] Atomically transfer a key from a Redis instance to another one.
    }

    function move($key, $db) {
        //  key db Move a key to another database
    }

    function object($subcommand, array $args) {
        //  subcommand [arguments [arguments ...]] Inspect the internals of Redis objects
    }

    function persist($key) {
        //  key Remove the expiration from a key
    }

    function pexpire($key, $milliseconds) {
        //  key milliseconds Set a key's time to live in milliseconds
    }

    function pexpireat($key, $timestamp) {
        //  key milliseconds-timestamp Set the expiration for a key as a UNIX timestamp specified in milliseconds
    }

    function pttl($key) {
        //  key Get the time to live for a key in milliseconds
    }

    function randomkey() {
        //  Return a random key from the keyspace
    }

    function rename($key, $newKey) {
        //  key newkey Rename a key
    }

    function renamenx($key, $newKey) {
        //  key newkey Rename a key, only if the new key does not exist
    }

    function restore($key, $ttl, $serialValue, $replace) {
        //  key ttl serialized-value [REPLACE] Create a key using the provided serialized value, previously obtained using DUMP.
    }

    function sort($key, $pattern, $offset, $count, array $pattern, $asc, $alpha, $dest) {
        //  key [BY pattern] [LIMIT offset count] [GET pattern [GET pattern ...]] [ASC|DESC] [ALPHA] [STORE destination] Sort the elements in a list, set or sorted set
    }

    function ttl($key) {
        //  key Get the time to live for a key
    }

    function type($key) {
        //  key Determine the type stored at key
    }

    function scan($cursor, $pattern, $count) {
        //  cursor [MATCH pattern] [COUNT count] Incrementally iterate the keys space
    }


}