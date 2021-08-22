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
		$result = DB::query($query);
		if($result) return response(200, $result->fetch_assoc());
		else return response(400, "Ошибка получения данных: ". DB::$connect->error);
	}

	public function get_all() {
		$result = DB::query("SELECT * FROM `category`");
		$data = array();
		while($row = $result->fetch_assoc())
			array_push($data, $row);
		return response(200, $data);
	}

	public function update() {
		$category_id = Request::input("category_id");
		$category = Request::input("category");
		$query = sprintf("UPDATE `category` SET `category`='%s' WHERE `category_id`='%s'", $category, $category_id);
		if(DB::query($query)) return response(200, "Данные успешно обновлены");
		else return response(400, "Ошибка обновления данных: ". DB::$connect->error);
	}

	public function delete() {
		$category_id = Request::input("category_id");
		$query = sprintf("DELETE FROM `category` WHERE `category_id`='%s'", $category_id);
		if(DB::query($query)) return response(200, "Категория успешно удалена");
		else return response(400, "Ошибка удаления данных: ". DB::$connect->error);
	}
}
?>