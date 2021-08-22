<?php
class SupplierController {

	public function add() {
		$query = sprintf("INSERT INTO `supplier`(`name`, `inn`, `ceo`, `contact_phone`) VALUE ('%s', '%s', '%s', '%s')",
			Request::input("name"),
			Request::input("inn"),
			Request::input("ceo"),
			Request::input("contact_phone")
		);
		if(DB::query($query)) return response(200, "Поставщик успешно добавлен");
		else return response(400, "Ошибка добавления данных: ". DB::$connect->error);
	}

	public function get() {
		$supplier_id = Request::input("supplier_id");
		$query = sprintf("SELECT * FROM `supplier` WHERE `supplier_id`='%s'", $supplier_id);
		$result = DB::query($query);
		if($result) return response(200, $result->fetch_assoc());
		else return response(400, "Ошибка получения данных: ". DB::$connect->error);
	}

	public function get_all() {
		$result = DB::query("SELECT * FROM `supplier`");
		$data = array();
		while($row = $result->fetch_assoc())
			array_push($data, $row);
		return response(200, $data);
	}

	public function update() {
		$query = sprintf("UPDATE `category` SET `name`='%s', `inn`='%d', `ceo`='%s', `contact_phone`='%s' WHERE `supplier_id`='%s'",
			Request::input("name"),
			Request::input("inn"),
			Request::input("ceo"),
			Request::input("contact_phone"),
			Request::input("supplier_id")
		);
		if(DB::query($query)) return response(200, "Данные успешно обновлены");
		else return response(400, "Ошибка обновления данных: ". DB::$connect->error);
	}

	public function delete() {
		$supplier_id = Request::input("supplier_id");
		$query = sprintf("DELETE FROM `supplier` WHERE `supplier_id`='%s'", $supplier_id);
		if(DB::query($query)) return response(200, "Поставщик успешно удален");
		else return response(400, "Ошибка удаления данных: ". DB::$connect->error);
	}

}
?>