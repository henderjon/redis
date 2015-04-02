<?php

namespace Redis\Interfaces;

interface HyperLogLogMethodsInterface {

	function pfadd($key, array $elements);
	function pfcount(array $keys);
	function pfmerge($dest, array $sources);

}
