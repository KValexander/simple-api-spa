let xhr = new XMLHttpRequest;

window.onload = function() {
	xhr.open("GET", "api/start", false);
	xhr.send();
	$("#head").html(xhr.responseText).append(`<nav>
		<a onclick="out_page('category.html')">Категории</a> |
		<a onclick="out_page('supplier.html')">Поставщики</a> |
		<a onclick="out_page('product.html')">Товары</a> |
		<a onclick="out_page('client.html')">Клиенты</a> |
		<a onclick="out_page('order.html')">Заказы</a> |
		<a onclick="out_page('clear')">Очистить</a>
		</nav>`);
}

function out_page(page) {
	if(page == 'clear') return $("#app").html("");
	$.ajax({
		url:`simple-client/${page}`,
		success: data => {
			if(data.includes("<!DOCTYPE html>")) return;
			$("#app").html(data);
		}
	});
}

function get(callback, data, url) {
	xhr.open("GET", url, true);
	xhr.send(data);
	xhr.onreadystatechange = function() {
		if (xhr.readyState != 4) return;
		callback(xhr.responseText);
	};
}

function post(callback, data, url) {
	xhr.open("POST", url, true);
	xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	xhr.setRequestHeader('Content-Type', 'application/json');
	xhr.send(data);
	xhr.onreadystatechange = function() {
		if (xhr.readyState != 4) return;
		callback(xhr.responseText);
	};
}