<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="" rel="stylesheet" />
	<title></title>
</head>
<body>
	<!--Eger form islemi icinde file islemi var sa mutlaka, enctype ="multipart/form-data" vermemiz gerekir -->
	<form action="result.php" method="POST" enctype="multipart/form-data">
		<input type="file" name="file" />
		<hr>
		<button type="submit">Upload</button>
	</form>
</body>
</html>