<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Simple SPA</title>
	<style>a {cursor: pointer; color: blue}</style>

	<script>
		let xhr = new XMLHttpRequest;
		window.onload = function() {
			xhr.open("GET", "api/start", false);
			xhr.send();
			document.querySelector("#app").innerHTML = xhr.responseText;
			category_get();
		}

		function category_add() {
			let value = document.querySelector("#category").value;
			let data = `category=${value}`;
			xhr.open("POST", "api/category/add", true);
			xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.send(data);
			xhr.onreadystatechange = function() {
				if (xhr.readyState != 4) return;
				data = JSON.parse(xhr.responseText);
				alert(data.status + " " + data.data);
				category_get();
			};
		}

		function category_get() {
			xhr.open("GET", "api/category/get", true);
			xhr.send();
			xhr.onreadystatechange = function() {
				if (xhr.readyState != 4) return;
				let data = JSON.parse(xhr.responseText);
				let out = ``, cat = "";
				console.log(data);
				data.data.forEach((category, i) => {
					if (category.category == "") cat = "*Категория с пустым названием*";
					else cat = category.category;
					out += `<p>${i}. ${cat}(${category.category_id}) (<a onclick="category_delete(${category.category_id})">Удалить</a>)</p>`;
				});
				document.querySelector("#categories").innerHTML = out;
			}
		}

		function category_delete(id) {
			xhr.open("GET", "api/category/delete?category_id="+id, true);
			xhr.send();
			xhr.onreadystatechange = function() {
				if (xhr.readyState != 4) return;
				let data = JSON.parse(xhr.responseText);
				alert(data.status + " " + data.data);
				category_get();
			}
		}
	</script>
</head>
<body>
	<div id="app"></div><br>
	<div class="form">
		<h2>Добавление категории</h2>
		<p><input type="text" placeholder="Введите название категории" id="category"></p>
		<p><input type="button" value="Добавить" onclick="category_add()"></p>
	</div><br>
	<div class="out">
		<h2>Вывод категорий</h2>
		<div id="categories"></div>
	</div>
</body>
</html>