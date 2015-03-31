<?php

namespace Redis\Traits;

use Redis\RedisException;

trait ConnetionMethodsTrait {

    /**
     * Authenticate to the server
     * password
     */
    function auth($password) {
        return $this->exec( $this->protocol( __FUNCTION__, $password ) );
    }

    /**
     * Echo the given string
     * message
     */
    function echo($message) {
        return $this->exec( $this->protocol( __FUNCTION__, $message ) );
    }

    /**
     * Ping the server
     */
    function ping() {
        return $this->exec( $this->protocol( __FUNCTION__ ) );
    }

    /**
     * Close the connection
     */
    function quit() {
        return $this->exec( $this->protocol( __FUNCTION__ ) );
    }

    /**
     * Change the selected database for the current connection
     * index
     */
    function select($index) {
        return $this->exec( $this->protocol( __FUNCTION__, $index ) );
    }


}