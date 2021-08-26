<?php
namespace App\Route;

class Route {
	private static $routes = array();
	private static $type;
	private static $route;

	public static function get($route, $param) {
		self::$routes["GET"][$route] = $param;
	}

	public static function post($route, $param) {
		self::$routes["POST"][$route] = $param;
	}

	public static function check($type, $route) {
		if (array_key_exists($route, self::$routes[$type])) {
			self::$type = $type;
			self::$route = $route;
			return true;
		}
		else return false;
	}

	public static function call() {
		// Getting route value
		$route = self::$routes[self::$type][self::$route];
		// Retrieving parameters
		$params = explode("@", $route);
		// Controller call
		return controller($params);
	}

	public static function search() {
		return self::$routes[self::$type][self::$route];
	}
}
?>