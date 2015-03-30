<?php

trait HashMethodsTrait {

    function hdel($key, array $fields) {
        //  key field [field ...] Delete one or more hash fields
    }

    function hexists($key, $field) {
        //  key field Determine if a hash field exists
    }

    function hget($key, $field) {
        //  key field Get the value of a hash field
    }

    function hgetall($key) {
        //  key Get all the fields and values in a hash
    }

    function hincrby($key, $field, $inrc) {
        //  key field increment Increment the integer value of a hash field by the given number
    }

    function hincrbyfloat($key, $field, $incr) {
        //  key field increment Increment the float value of a hash field by the given amount
    }

    function hkeys($key) {
        //  key Get all the fields in a hash
    }

    function hlen($key) {
        //  key Get the number of fields in a hash
    }

    function hmget($key, array $fields) {
        //  key field [field ...] Get the values of all the given hash fields
    }

    function hmset($key, array $map) {
        //  key field value [field value ...] Set multiple hash fields to multiple values
    }

    function hset($key, $field, $value) {
        //  key field value Set the string value of a hash field
    }

    function hsetnx($key, $field, $value) {
        //  key field value Set the value of a hash field, only if the field does not exist
    }

    function hstrlen($key, $field) {
        //  key field Get the length of the value of a hash field
    }

    function hvals($key) {
        //  key Get all the values in a hash
    }

    function hscan($key, $cursor, $pattern, $count) {
        //  key cursor [MATCH pattern] [COUNT count] Incrementally iterate hash fields and associated values
    }

}