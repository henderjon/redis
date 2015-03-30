<?php

trait HyperLogLogMethodsTrait {

    function pfadd($key, array $elements) {
        //  key element [element ...] Adds the specified elements to the specified HyperLogLog.
    }

    function pfcount(array $keys) {
        //  key [key ...] Return the approximated cardinality of the set(s) observed by the HyperLogLog at key(s).
    }

    function pfmerge($dest, array $sources) {
        //  destkey sourcekey [sourcekey ...] Merge N different HyperLogLogs into a single one.
    }


}