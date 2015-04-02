<?php

namespace Redis\Interfaces;

interface PubSubMethodsInterface {

	function psubscribe(array $patterns);
	function pubsubChannels(array $args = null);
	function pubsubNumsub(array $args = null);
	function pubsubNumpat(array $args = null);
	function publish($chan, $message);
	function punsubscribe(array $patterns = null);
	function subscribe(array $channels);
	function unsubscribe(array $channels = null);

}