<?php
	session_start();
	
	include "Database.php";
	include "Request.php";
	include "Route.php";
	
	include "response.php";
	include "routes.php";

	DB::connect();

	header("Access-Control-Allow-Origin: *");
	header("Content-Type:application/json;charset=UTF-8");

	// Checking for Route Availability
	if (Route::check($_SERVER["REQUEST_METHOD"], $_SERVER["REDIRECT_URL"])) {
		// Getting route value
		$route = Route::search($_SERVER["REQUEST_METHOD"], $_SERVER["REDIRECT_URL"]);

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

		return $controller->$method();
	} else return response(404, "Route not found");
?>