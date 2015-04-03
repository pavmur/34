<?php

abstract class Singleton
{
	/**
	* @var array
	*/
	private static $instances = array();

	protected function __construct() {}

	/**
	* @return Object
	*/
	final public static function getInstance()
	{
		$className = get_called_class();
		
		if (!isset(self::$instances[$className])) {
			self::$instances[$className] = new $className();
		}

		return self::$instances[$className];
	}
}