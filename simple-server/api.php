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
	if (Route::check($_SERVER["REQUEST_METHOD"], $_SERVER["REDIRECT_URL"])) Route::call();
	else return response(404, "Route not found");
?>