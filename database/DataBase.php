<?php

namespace database;

use Exception;
use PDO;
use PDOException;

class DataBase {

	/**
	 * Atribute with PDO object conected. PS.: Need to call method connect, otherwise it will be empty.
	 * @var PDO
	 */
	private static $connection;
	private static $engine = ENGINE;
	private static $dbName = DBNAME;
	private static $host = HOST;
	private static $login = LOGIN;
	private static $password = PASSWORD;

    public function __construct($dbName = DBNAME, $host = HOST, $engine = ENGINE, $login = LOGIN, $password = PASSWORD)
    {
        try{
            self::$connection = new PDO($engine.":dbname=".$dbName.";host=".$host.";", $login, $password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
        catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

    }


	/**
	 * Method to connect to DB. Get default parameters from config if not given.
	 * @param string $engine
	 * @param string $dbName
	 * @param string $host
	 * @param string $login
	 * @param string $password
	 * @throws Exception
	 * @return PDO
	 */
    static function connect() {
        try {

            self::$connection = new PDO(self::$engine.":dbname=".self::$dbName.";host=".self::$host.";", self::$login, self::$password);

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return self::$connection;
        }
        catch(PDOException $e) {
            throw new Exception($e->getMessage());
        }
        catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

	/**
	 * @param string $engine
	 */
	public static function setEngine($engine) {
		DataBase::$engine = $engine;
	}

	/**
	 * @param string $dbName
	 */
	public static function setDbName($dbName) {
		DataBase::$dbName = $dbName;
	}

	/**
	 * @param string $host
	 */
	public static function setHost($host) {
		DataBase::$host = $host;
	}

	/**
	 * @param string $login
	 */
	public static function setLogin($login) {
		DataBase::$login = $login;
	}

	/**
	 * @param string $password
	 */
	public static function setPassword($password) {
		DataBase::$password = $password;
	}
}