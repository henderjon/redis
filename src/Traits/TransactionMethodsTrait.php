<?php

trait TransactionMethodsTrait {

    /**
     * Discard all commands issued after MULTI
     * for complete documentation: http://redis.io/commands#transactions
     */
    function discard() {
        return $this->exec( $this->protocol( __METHOD__ ) );
    }

    /**
     * Execute all commands issued after MULTI
     * for complete documentation: http://redis.io/commands#transactions
     */
    function exec() {
        return $this->exec( $this->protocol( __METHOD__ ) );
    }

    /**
     * Mark the start of a transaction block
     * for complete documentation: http://redis.io/commands#transactions
     */
    function multi() {
        return $this->exec( $this->protocol( __METHOD__ ) );
    }

    /**
     * Forget about all watched keys
     * for complete documentation: http://redis.io/commands#transactions
     */
    function unwatch() {
        return $this->exec( $this->protocol( __METHOD__ ) );
    }

    /**
     * Watch the given keys to determine execution of the MULTI/EXEC block
     * for complete documentation: http://redis.io/commands#transactions
     * @params key [key ...]
     */
    function watch(array $keys) {
        if(count($keys) < 1){
            throw new RedisException("At least one key is required.");
        }

        return $this->exec( $this->protocol( __METHOD__, $keys ) );
    }


}