<?php 



//id gelmis ve integer a donsuturulebilir bir data ise yani string bir data gonderilmesin
if(isset($_GET["id"]) && intval($_GET["id"])){
	$id = $_GET["id"];

	if($id){
		try {
			$sql =  "SELECT * FROM TUTORIALS WHERE TUTORIAL_ID =?";
			$stmt = $db->prepare($sql);
			$stmt->execute([$id]);
			$tutorial = $stmt->fetch();
			// var_dump($tutorial);
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
	<h2>Tutorial Detail</h2>
	<a style="text-decoration: none;"  href="index.php?page=homepage">&nbsp;&nbsp;<button>HOMEPAGE</button></a>
	<br><br>
	<div style="margin-left: 1rem;">
		<label>Tutorial title:</label>
		<span style="font-weight: bold; font-size:2rem; "><?php echo $tutorial["tutorial_title"];?></span>
	</div>
	<div style="margin-left: 1rem;">
		<label>Tutorial content:</label>
		<span style="font-weight: bold; font-size:2rem; "><?php echo $tutorial["tutorial_content"];?></span>
	</div>
</body>
</html>