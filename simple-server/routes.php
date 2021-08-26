<?php
	use App\Route\Route;

	Route::get("/api/start", "StartController@start");

	// Category
	Route::post("/api/category/add", "CategoryController@add");
	Route::get("/api/category/get", "CategoryController@get");
	Route::get("/api/category/get_all", "CategoryController@get_all");
	Route::post("/api/category/update", "CategoryController@update");
	Route::get("/api/category/delete", "CategoryController@delete");
	
	// Supplier
	Route::post("/api/supplier/add", "SupplierController@add");
	Route::get("/api/supplier/get", "SupplierController@get");
	Route::get("/api/supplier/get_all", "SupplierController@get_all");
	Route::post("/api/supplier/update", "SupplierController@update");
	Route::get("/api/supplier/delete", "SupplierController@delete");

	// Product
	Route::post("/api/product/add", "ProductController@add");
	Route::get("/api/product/get", "ProductController@get");
	Route::get("/api/product/get_all", "ProductController@get_all");
	Route::post("/api/product/update", "ProductController@update");
	Route::get("/api/product/delete", "ProductController@delete");

	// Client
	Route::post("/api/client/add", "ClientController@add");
	Route::get("/api/client/get", "ClientController@get");
	Route::get("/api/client/get_all", "ClientController@get_all");
	Route::post("/api/client/update", "ClientController@update");
	Route::get("/api/client/delete", "ClientController@delete");

	// Order
	Route::post("/api/order/add", "OrderController@add");
	Route::get("/api/order/get", "OrderController@get");
	Route::get("/api/order/get_all", "OrderController@get_all");
	Route::post("/api/order/update", "OrderController@update");
	Route::get("/api/order/delete", "OrderController@delete");

?>