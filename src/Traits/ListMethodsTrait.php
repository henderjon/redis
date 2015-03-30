<?php

trait ListMethodsTrait {

    function blpop($key, array $key, $timeout) {
        //  key [key ...] timeout Remove and get the first element in a list, or block until one is available
    }

    function brpop($key, array $key, $timeout) {
        //  key [key ...] timeout Remove and get the last element in a list, or block until one is available
    }

    function brpoplpush($source, $destination, $timeout) {
        //  source destination timeout Pop a value from a list, push it to another list and return it; or block until one is available
    }

    function lindex($key, $index) {
        //  key index Get an element from a list by its index
    }

    function linsert($key, $position, $pivot, $value) {
        //  key BEFORE|AFTER pivot value Insert an element before or after another element in a list
    }

    function llen($key) {
        //  key Get the length of a list
    }

    function lpop($key) {
        //  key Remove and get the first element in a list
    }

    function lpush($key, array $values) {
        //  key value [value ...] Prepend one or multiple values to a list
    }

    function lpushx($key, $value) {
        //  key value Prepend a value to a list, only if the list exists
    }

    function lrange($key, $start, $stop) {
        //  key start stop Get a range of elements from a list
    }

    function lrem($key, $count, $value) {
        //  key count value Remove elements from a list
    }

    function lset($key, $index, $value) {
        //  key index value Set the value of an element in a list by its index
    }

    function ltrim($key, $start, $stop) {
        //  key start stop Trim a list to the specified range
    }

    function rpop($key) {
        //  key Remove and get the last element in a list
    }

    function rpoplpush($source, $destination) {
        //  source destination Remove the last element in a list, prepend it to another list and return it
    }

    function rpush($key, array $values) {
        //  key value [value ...] Append one or multiple values to a list
    }

    function rpushx($key, $value) {
        //  key value Append a value to a list, only if the list exists
    }

}