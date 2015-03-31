<?php

namespace Redis;
// 2.8.19

class RedisConstants extends Redis {

	const EXPIRE_EX = "EX";
	const EXPIRE_PX = "PX";

	function getExpx($expx){
		if(!in_array($expx, [static::EXPIRE_EX, static::EXPIRE_PX])){
			return null;
		}
		return $expx;
	}

	const SET_NX    = "NX";
	const SET_XX    = "XX";

	function getNxxx($nxxx){
		if(!in_array($nxxx, [static::SET_NX, static::SET_XX])){
			return null;
		}
		return $nxxx;
	}

	const ZAGG_SUM = "SUM";
	const ZAGG_MIN = "MIN";
	const ZAGG_MAX = "MAX";

	function getZagg($zagg){
		if(!in_array($zagg, [static::ZAGG_SUM, static::ZAGG_MIN, static::ZAGG_MAX])){
			return null;
		}
		return $zagg;
	}

	const ZMIN = "-";
	const ZMAX = "+";

}