<?php
class StartController {
	public function start() {
		echo "<h1>Server is running</h1>";
	}

	public function category_add() {
		$category = $_REQUEST["category"];
		$result = DB::query("INSERT INTO `category`(`category`) VALUE ('".$category."')");
		if($result) return response(200, "Категория успешно добавлена");
		else return response(400, "Ошибка добавления данных: ". DB::$connect->errno);
	}

	public function category_get() {
		$result = DB::query("SELECT * FROM `category`");
		$data = array();
		while($row = $result->fetch_assoc())
			array_push($data, $row);
		return response(200, $data);
	}

	public function category_delete() {
		$category_id = $_REQUEST["category_id"];
		$result = DB::query("DELETE FROM `category` WHERE `category_id`='".$category_id."'");
		if($result) return response(200, "Категория успешно удалена");
		else return response(400, "Ошибка удаления данных: ". DB::$connect->errno);
	}
}
?>