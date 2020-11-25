<?php

use Exercise\Config;

namespace Exercise;

final class DbConnection
{
    private static $instance = null;
    public $connection;
    
	/**
	 * gets the instance via lazy initialization (created on first usage)
	 *
	 * @return Exercise
	 */
	public static function getInstance()
	{
		if (!is_object(self::$instance)) 
			self::$instance = new DbConnection();

		return self::$instance;
    }


    
	/**
	 * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
	 *
	 * @return void
	 */
    private function __construct() 
    {
        $configArray = Config::getConfig();
		$dbValues = $configArray['db'];

        $host = $dbValues['host'];
        $user = $dbValues['user'];
        $password = $dbValues['password'];
        $dbname = $dbValues['dbname'];

		$this->connection = new \PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    }
    
	/**
	 * prevent the instance from being cloned (which would create a second instance of it)
	 *
	 * @return void
	 */
	private function __clone() {}
    
	/**
	 * prevent from being unserialized (which would create a second instance of it)
	 *
	 * @return void
	 */
	private function __wakeup() {}
    
}