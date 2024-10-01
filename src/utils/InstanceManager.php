<?php

namespace MyApp\utils;

class InstanceManager {

    private static $instance = null;

	public static function getInstance($c)
	{
		return self::$instance = new $c;
	}

}