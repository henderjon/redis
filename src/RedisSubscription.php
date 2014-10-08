<?php

namespace Redis;

class RedisSubscription extends Redis {

	function subscribe(array $channels, $p = false){

		$command = $this->protocol( ($p ? "psubscribe" : "subscribe"), $channels );
		$details = $this->exec( $command, count($channels) );

		return [$details, function(){
			return $this->sub($this->handle);
		}];
	}

	function setTimeout($sec, $micro = 0){
		return stream_set_timeout($this->handle, $sec, $micro);
	}

}