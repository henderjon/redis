<?php

namespace Redis\Interfaces;

interface RedisProtocolInterface extends RedisInterface {
	public function pipe();
}
