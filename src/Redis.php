<?php

namespace Redis;
/**
 * public API to interact with redis, based on Redis v3.0
 *
 * @package henderjon/redis
 * @author @henderjon
 */
class Redis extends RedisProtocol implements Interfaces\RedisInterface {

	use Traits\ClusterMethodsTrait;
	use Traits\ConnectionMethodsTrait;
	use Traits\HashMethodsTrait;
	use Traits\HyperLogLogMethodsTrait;
	use Traits\KeyMethodsTrait;
	use Traits\ListMethodsTrait;
	use Traits\PubSubMethodsTrait;
	use Traits\ScriptingMethodsTrait;
	use Traits\ServerMethodsTrait;
	use Traits\SetMethodsTrait;
	use Traits\SortedSetMethodsTrait;
	use Traits\StringMethodsTrait;
	use Traits\TransactionMethodsTrait;

	protected function getExpx($expx){
		if(!in_array($expx, [static::EXPIRE_EX, static::EXPIRE_PX])){
			return null;
		}
		return $expx;
	}

	protected function getNxxx($nxxx){
		if(!in_array($nxxx, [static::SET_NX, static::SET_XX])){
			return null;
		}
		return $nxxx;
	}

	protected function getZagg($zagg){
		if(!in_array($zagg, [static::ZAGG_SUM, static::ZAGG_MIN, static::ZAGG_MAX])){
			return null;
		}
		return $zagg;
	}

	protected function getKillType($type){
		if(!in_array($type, [static::KILL_TYPE_NORMAL, static::KILL_TYPE_SLAVE, static::KILL_TYPE_PUBSUB])){
			return null;
		}
		return $type;
	}

}
