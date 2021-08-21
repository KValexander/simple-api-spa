<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Simple SPA</title>

	<script>
		window.onload = function() {
			let xhr = new XMLHttpRequest;
			xhr.open("GET", "api/start", false);
			xhr.send();
			document.querySelector("#app").innerHTML = xhr.responseText;
		}
	</script>
</head>
<body>
	<div id="app"></div>
</body>
</html>