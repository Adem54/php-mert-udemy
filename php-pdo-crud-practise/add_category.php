<?php 

if(isset($_POST['submit'])){
	$name =$_POST['name'] ?? null;
	if(!$name){
		echo "You must fill name field";
	}else{
		try {
		$sql = 'INSERT INTO CATEGORIES SET category_name = :name';
		$query = $db->prepare($sql);
		$query->execute([
			':name'=>$name
		]);
		echo "You added your category successfully";
		header("Location:index.php?page=categories");
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h2>Add new category</h2>
	<form action="" method="POST">
		<label for="name">Category Name:</label><br><br>
		<input type="text" name="name" >
		<br>
		<br>
		<input type="hidden" name="submit" value="action">
		<button type="submit">Submit</button>
	</form>
</body>
</html>