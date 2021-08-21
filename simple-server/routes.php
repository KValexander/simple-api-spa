<?php
	Route::get("/api/start", "StartController@start");

	Route::post("/api/category/add", "StartController@category_add");
	Route::get("/api/category/get", "StartController@category_get");
	Route::get("/api/category/delete", "StartController@category_delete");
?>