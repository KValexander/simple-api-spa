<?php
class ClientController {
	public function add() {
		$query = sprintf("INSERT INTO `client`(`surname`, `name`, `patronymic`, `email`, `phone`) VALUE ('%s', '%s', '%s', '%s', '%s')",
			Request::input("surname"),
			Request::input("name"),
			Request::input("patronymic"),
			Request::input("email"),
			Request::input("phone"),
		);
		if(DB::query($query)) return response(200, "Клиент успешно добавлен");
		else return response(400, "Ошибка добавления данных: ". DB::$connect->error);
	}

	public function get() {
		$query = sprintf("SELECT * FROM `client` WHERE `client_id`='%s'", Request::input("client_id"));
		$data = DB::query($query)->fetch_assoc();
		if($data === null) return response(404, "Такого клиента нет");
		return response(200, $data);
	}
	
	public function get_all() {
		$result = DB::query("SELECT * FROM `client`");
		$data = array();
		while($row = $result->fetch_assoc())
			array_push($data, $row);
		return response(200, $data);
	}

	public function update() {
		$query = sprintf("UPDATE `client` SET `surname`='%s', `name`='%d', `patronymic`='%s', `email`='%s', `phone`='%s' WHERE `client_id`='%s'",
			Request::input("surname"),
			Request::input("name"),
			Request::input("patronymic"),
			Request::input("email"),
			Request::input("phone"),
			Request::input("client_id"),
		);
		if(DB::query($query)) return response(200, "Клиент успешно обновлен");
		else return response(400, "Ошибка обновления данных: ". DB::$connect->error);
	}

	public function delete() {
		$query = sprintf("DELETE FROM `client` WHERE `client_id`='%s'", Request::input("client_id"));
		if(DB::query($query)) return response(200, "Клиент успешно удален");
		else return response(400, "Ошибка удаления данных: ". DB::$connect->error);
	}
}
?>