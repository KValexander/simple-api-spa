<?php
class CategoryController {

	public function add() {
		$category = Request::input("category");
		$query = sprintf("INSERT INTO `category`(`category`) VALUE ('%s')", $category);
		if(DB::query($query)) return response(200, "Категория успешно добавлена");
		else return response(400, "Ошибка добавления данных: ". DB::$connect->error);
	}

	public function get() {
		$category_id = Request::input("category_id");
		$query = sprintf("SELECT * FROM `category` WHERE `category_id`='%s'", $category_id);
		$data = DB::query($query)->fetch_assoc();
		if($data === null) return response(404, "Такой категории нет");
		else return response(200, $data);
	}

	public function get_all() {
		$result = DB::query("SELECT * FROM `category`");
		$data = array();
		while($row = $result->fetch_assoc())
			array_push($data, $row);
		return response(200, $data);
	}

	public function update() {
		$query = sprintf("UPDATE `category` SET `category`='%s' WHERE `category_id`='%s'",
			Request::input("category_id"),
			Request::input("category")
		);
		if(DB::query($query)) return response(200, "Категория успешно обновлена");
		else return response(400, "Ошибка обновления данных: ". DB::$connect->error);
	}

	public function delete() {
		$query = sprintf("DELETE FROM `category` WHERE `category_id`='%s'", Request::input("category_id"));
		if(DB::query($query)) return response(200, "Категория успешно удалена");
		else return response(400, "Ошибка удаления данных: ". DB::$connect->error);
	}
}
?>