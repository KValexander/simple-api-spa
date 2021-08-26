<?php
use App\Request\Request;
use App\Database\DB;

class ProductController {

	public function add() {
		$query = sprintf("INSERT INTO `product`(`supplier_id`, `name`, `material`, `category_id`, `cost`, `number`) VALUE ('%s', '%s', '%s', '%s', '%s', '%s')",
			Request::input("supplier_id"),
			Request::input("name"),
			Request::input("material"),
			Request::input("category_id"),
			Request::input("cost"),
			Request::input("number"),
		);
		if(DB::query($query)) return response(200, "Товар успешно добавлен");
		else return response(400, "Ошибка добавления данных: ". DB::$connect->error);
	}

	public function get() {
		$query = sprintf("SELECT * FROM `product` WHERE `product_id`='%s'", Request::input("product_id"));
		$product = DB::query($query)->fetch_assoc();
		if($product === null) return response(404, "Такого товара нет");
		$query = sprintf("SELECT * FROM `supplier` WHERE `supplier_id`='%s'", $product["supplier_id"]);
		$product["supplier"] = DB::query($query)->fetch_assoc();
		$query = sprintf("SELECT * FROM `category` WHERE `category_id`='%s'", $product["category_id"]);
		$product["category"] = DB::query($query)->fetch_assoc()["category"];
		return response(200, $product);
	}

	public function get_all() {
		$result = DB::query("SELECT * FROM `product`");
		$data = array();
		while($row = $result->fetch_assoc()) {
			$query = sprintf("SELECT * FROM `supplier` WHERE `supplier_id`='%s'", $row["supplier_id"]);
			$row["supplier"] = DB::query($query)->fetch_assoc();
			$query = sprintf("SELECT * FROM `category` WHERE `category_id`='%s'", $row["category_id"]);
			$row["category"] = DB::query($query)->fetch_assoc()["category"];
			array_push($data, $row);
		}
		return response(200, $data);
	}

	public function update() {
		$query = sprintf("UPDATE `product` SET `supplier_id`='%s', `name`='%s', `material`='%s', `category_id`='%s', `cost`='%s', `number`='%s' WHERE `product_id`='%s'",
			Request::input("supplier_id"),
			Request::input("name"),
			Request::input("material"),
			Request::input("category_id"),
			Request::input("cost"),
			Request::input("number"),
			Request::input("product_id")
		);
		if(DB::query($query)) return response(200, "Товар успешно обновлен");
		else return response(400, "Ошибка обновления данных: ". DB::$connect->error);
	}

	public function delete() {
		$query = sprintf("DELETE FROM `product` WHERE `product_id`='%s'", Request::input("product_id"));
		if(DB::query($query)) return response(200, "Товар успешно удален");
		else return response(400, "Ошибка удаления данных: ". DB::$connect->error);
	}

}
?>