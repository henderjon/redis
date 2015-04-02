<?php

namespace Redis\Interfaces;

interface ConnectionMethodsInterface {

	function auth($password);
	// function echo($message) {
	function ping();
	function quit();
	function select($index);

}