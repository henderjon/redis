<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ConnetionMethodsTrait {

    /**
     * Authenticate to the server
     * password
     */
    function auth($password) {
        return $this->exe( $this->protocol( __FUNCTION__, $password ) );
    }

    /**
     * Echo the given string
     * message
     */
    // function echo($message) {
    //     throw new RedisException("(" . __FUNCTION__ . ") Not implemented.");
    // }

    /**
     * Ping the server
     */
    function ping() {
        return $this->exe( $this->protocol( __FUNCTION__ ) );
    }

    /**
     * Close the connection
     */
    function quit() {
        return $this->exe( $this->protocol( __FUNCTION__ ) );
    }

    /**
     * Change the selected database for the current connection
     * index
     */
    function select($index) {
        return $this->exe( $this->protocol( __FUNCTION__, $index ) );
    }


}