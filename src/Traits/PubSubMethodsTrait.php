<?php

trait PubSubMethodsTrait {

    function psubscribe(array $patterns) {
        //  pattern [pattern ...] Listen for messages published to channels matching the given patterns
    }

    function pubsub($subcommand, array $args) {
        //  subcommand [argument [argument ...]] Inspect the state of the Pub/Sub subsystem
    }

    function publish($chan, $message) {
        //  channel message Post a message to a channel
    }

    function punsubscribe(array $patterns) {
        //  [pattern [pattern ...]] Stop listening for messages posted to channels matching the given patterns
    }

    function subscribe(array $channels) {
        //  channel [channel ...] Listen for messages published to the given channels
    }

    function unsubscribe(array $channels) {
        //  [channel [channel ...]] Stop listening for messages posted to the given channels
    }


}