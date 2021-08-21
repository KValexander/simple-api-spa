<?php
class Route {
	private static $routes = array();

	public static function get($route, $param) {
		self::$routes["GET"][$route] = $param;
	}

	public static function post($route, $param) {
		self::$routes["POST"][$route] = $param;
	}

	public static function check($type, $route) {
		if (array_key_exists($route, self::$routes[$type])) return true;
		else return false;
	}

	public static function search($type, $route) {
		return self::$routes[$type][$route];
	}
}
?>