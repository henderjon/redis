<?php

namespace Redis\Interfaces;

interface RedisInterface extends
				ClusterMethodsInterface,
				ConnectionMethodsInterface,
				HashMethodsInterface,
				HyperLogLogMethodsInterface,
				KeyMethodsInterface,
				ListMethodsInterface,
				PubSubMethodsInterface,
				ScriptingMethodsInterface,
				ServerMethodsInterface,
				SetMethodsInterface,
				SortedSetMethodsInterface,
				StringMethodsInterface,
				TransactionMethodsInterface {

	const EXPIRE_EX        = "EX";
	const EXPIRE_PX        = "PX";
	const SET_NX           = "NX";
	const SET_XX           = "XX";
	const ZAGG_MIN         = "MIN";
	const ZAGG_MAX         = "MAX";
	const ZMIN             = "-";
	const ZMAX             = "+";
	const KILL_TYPE_NORMAL = "normal";
	const KILL_TYPE_SLAVE  = "slave";
	const KILL_TYPE_PUBSUB = "pubsub";

	public function pipe();
}
