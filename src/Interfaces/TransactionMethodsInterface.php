<?php

namespace Redis\Interfaces;

interface TransactionMethodsInterface {

	function discard();
	function exec();
	function multi();
	function unwatch();
	function watch(array $keys);

}