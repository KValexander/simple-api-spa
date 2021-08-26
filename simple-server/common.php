<?php
	function controller($params) {
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

	function response($status, $data=NULL) {
		header("HTTP/1.1 ".$status);
		$response["status"] = $status;
		$response["data"] = $data;
		$json_response = json_encode($response);
		echo $json_response;
	}
?>