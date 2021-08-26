<?php
namespace App\Request;

class Request {
	// Returns all data
	public static function all() {
		if($_SERVER["CONTENT_TYPE"] ==  'application/json') {
			$data = file_get_contents('php://input');
			$array = json_decode($data, true);
		} else $array = array_merge($_REQUEST, $_FILES);
		return $array;
	}
	// Returns data by key
	public static function input($key) {
		if($_SERVER["CONTENT_TYPE"] ==  'application/json') {
			$data = file_get_contents('php://input');
			$array = json_decode($data, true);
		} else $array = array_merge($_REQUEST, $_FILES);
		return $array[$key];
	}
}
?>