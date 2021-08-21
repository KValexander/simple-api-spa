let xhr = new XMLHttpRequest;

window.onload = function() {
	xhr.open("GET", "api/start", false);
	xhr.send();
	$("#head").html(xhr.responseText).append(`<nav>
		<a onclick="out_page('category.html')">Категории</a> |
		<a onclick="out_page('clear')">Очистить</a>
		</nav>`);
}

function out_page(page) {
	if(page == 'clear') return $("#app").html("");
	xhr.open("GET", `simple-client/${page}`, false);
	xhr.send();
	if(xhr.responseText.includes("<!DOCTYPE html>")) return;
	$("#app").html(xhr.responseText);
}