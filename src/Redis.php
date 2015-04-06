<?php

namespace Redis;
/**
 * public API to interact with redis, based on Redis v2.8.19
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

	const EXPIRE_EX = "EX";
	const EXPIRE_PX = "PX";

	protected function getExpx($expx){
		if(!in_array($expx, [static::EXPIRE_EX, static::EXPIRE_PX])){
			return null;
		}
		return $expx;
	}

	const SET_NX    = "NX";
	const SET_XX    = "XX";

	protected function getNxxx($nxxx){
		if(!in_array($nxxx, [static::SET_NX, static::SET_XX])){
			return null;
		}
		return $nxxx;
	}

	const ZAGG_SUM = "SUM";
	const ZAGG_MIN = "MIN";
	const ZAGG_MAX = "MAX";

	protected function getZagg($zagg){
		if(!in_array($zagg, [static::ZAGG_SUM, static::ZAGG_MIN, static::ZAGG_MAX])){
			return null;
		}
		return $zagg;
	}

	const ZMIN = "-";
	const ZMAX = "+";

	const KILL_TYPE_NORMAL = "normal";
	const KILL_TYPE_SLAVE  = "slave";
	const KILL_TYPE_PUBSUB = "pubsub";

	protected function getKillType($type){
		if(!in_array($type, [static::KILL_TYPE_NORMAL, static::KILL_TYPE_SLAVE, static::KILL_TYPE_PUBSUB])){
			return null;
		}
		return $type;
	}

}
