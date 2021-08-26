<?php
namespace App\Database;

class DB {
	// Data for connecting to the base
	private static $dbhost = "localhost";
	private static $dbuser = "root";
	private static $dbpass = "root";
	private static $dbname = "simple-spa";
	public static $connect;

	// Connection to base
	public static function connect() {
		self::$connect = null;
		self::$connect = new \mysqli(self::$dbhost, self::$dbuser, self::$dbpass, self::$dbname);
		self::$connect->set_charset("utf8");
		if(self::$connect->connect_errno)
			die("Connection error: ". self::$connect->connect_errno);
	}

	// Executing sql query
	public static function query($sql) {
		$result = self::$connect->query($sql);
		return $result;
	}
}
?>