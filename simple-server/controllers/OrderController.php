<?php
class OrderController {
	public function add() {
		$query = sprintf("SELECT * FROM `product` WHERE `product_id`='%s'", Request::input("product_id"));
		$product = DB::query($query)->fetch_assoc();
		if($product === null) return response(400, "Такого товара нет");
		$cost = $product["cost"] * Request::input("count");
		$query = sprintf("INSERT INTO `order`(`product_id`, `client_id`, `count`, `cost`) VALUE ('%s', '%s', '%s', '%s')",
			Request::input("product_id"),
			Request::input("client_id"),
			Request::input("count"),
			$cost
		);
		if(DB::query($query)) return response(200, "Заказ успешно добавлен");
		else return response(400, "Ошибка добавления данных: ". DB::$connect->error);
	}

	public function get() {
		$query = sprintf("SELECT * FROM `order` WHERE `order_id`='%s'", Request::input("order_id"));
		$order = DB::query($query)->fetch_assoc();
		if($order === null) return response(404, "Такого заказа нет");

		$query = sprintf("SELECT * FROM `product` WHERE `product_id`='%s'", $order["product_id"]);
		$order["product"] = DB::query($query)->fetch_assoc();
		$query = sprintf("SELECT * FROM `supplier` WHERE `supplier_id`='%s'", $order["product"]["supplier_id"]);
		$order["product"]["supplier"] = DB::query($query)->fetch_assoc();
		$query = sprintf("SELECT * FROM `category` WHERE `category_id`='%s'", $order["product"]["category_id"]);
		$order["product"]["category"] = DB::query($query)->fetch_assoc()["category"];

		$query = sprintf("SELECT * FROM `client` WHERE `client_id`='%s'", $order["client_id"]);
		$order["client"] = DB::query($query)->fetch_assoc();

		return response(200, $order);
	}

	public function get_all() {
		$result = DB::query("SELECT * FROM `order`");
		$data = array();
		while($row = $result->fetch_assoc()) {
			$query = sprintf("SELECT * FROM `product` WHERE `product_id`='%s'", $row["product_id"]);
			$row["product"] = DB::query($query)->fetch_assoc();
			$query = sprintf("SELECT * FROM `supplier` WHERE `supplier_id`='%s'", $row["product"]["supplier_id"]);
			$row["product"]["supplier"] = DB::query($query)->fetch_assoc();
			$query = sprintf("SELECT * FROM `category` WHERE `category_id`='%s'", $row["product"]["category_id"]);
			$row["product"]["category"] = DB::query($query)->fetch_assoc()["category"];

			$query = sprintf("SELECT * FROM `client` WHERE `client_id`='%s'", $row["client_id"]);
			$row["client"] = DB::query($query)->fetch_assoc();
			array_push($data, $row);
		}
		return response(200, $data);
	}

	public function update() {
		$query = sprintf("UPDATE `order` SET `product_id`='%s', `client_id`='%s', `count`='%s', `cost`='%s' WHERE `order_id`='%s'",
			Request::input("product_id"),
			Request::input("client_id"),
			Request::input("count"),
			Request::input("cost"),
			Request::input("order_id"),
		);
		if(DB::query($query)) return response(200, "Заказ успешно обновлен");
		else return response(400, "Ошибка обновления данных: ". DB::$connect->error);
	}

	public function delete() {
		$query = sprintf("DELETE FROM `order` WHERE `order_id`='%s'", Request::input("order_id"));
		if(DB::query($query)) return response(200, "Заказ успешно удален");
		else return response(400, "Ошибка удаления данных: ". DB::$connect->error);
	}
}
?>