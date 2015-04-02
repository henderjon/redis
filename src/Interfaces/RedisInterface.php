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

}
