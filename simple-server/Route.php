<?php
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

		// Getting and checking a class and controller
		include "controllers/". $params[0] .".php";
		if(!class_exists($params[0], false))
			exit("Class $params[0] not found");

		$controller = new $params[0];

		// Getting and checking a method
		if(!method_exists($controller, $params[1]))
			exit("Method $params[1] not found");

		$method = (string)$params[1];

		// Method call
		return $controller->$method();
	}

	public static function search() {
		return self::$routes[self::$type][self::$route];
	}
}
?>