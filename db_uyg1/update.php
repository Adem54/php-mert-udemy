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
			//  var_dump($tutorial);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}
}



function form_filter($post){	
	if(is_array($post)){
		return array_map("form_filter",$post);
	}else{
		return htmlspecialchars(trim($post));	
	}					
}		

$error = [];
if(isset($_POST["submit"])): 
	$_POST = array_map("form_filter",$_POST);
	
	$res1 = true;
	foreach ($_POST as $key=>$value) {
		$res2 =  true;
		if(empty($value)){
			$error[$key]=$key." musn't be empty";
			$res2 =  false;
		}
		if($res2 === false)$res1 = false;
	}

	if($res1){
	$title = $_POST["title"] ?? null;
	$content = $_POST["content"] ?? null;
	$active = $_POST["active"] == "active" ? 1 : 0;

	


/*
	$sql = "INSERT INTO users (name, surname, sex) VALUES (?,?,?)";
	$stmt= $pdo->prepare($sql);
	$stmt->execute([$name, $surname, $sex]);
*/
//Eger ? notasyonu nu kullanirsak o zaman dizi icine key tanimlamadan direk datalari dogru siralama ile yerlestirmemiz gerekir
//Ama yok placeholder kullandi isek tutorial_title:tutorial_title gibi..o zaman key leri kullanmamiz gerekir..
	try {
	$id = $_GET["id"];
	$sql = "UPDATE TUTORIALS SET tutorial_title=?,tutorial_content=?,tutorial_active=? WHERE TUTORIAL_ID =?";
	$stmt = $db->prepare($sql)->execute(
	[
		$title,
		$content,
		$active,
		$id
	]
	);
	echo "Succesfully updated ";	
	header("Refresh:2,url=index.php");	
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	}
endif;
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
	<h2>update_tutorial</h2>
	<a style="text-decoration: none;"  href="index.php?page=homepage">&nbsp;&nbsp;<button>HOMEPAGE</button></a>
	<br><br>

	<form action="" method="POST">
		<span style="display:block;"><?php  echo isset($error["title"]) ? $error["title"] : "";?></span>
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" value="<?=  $tutorial["tutorial_title"]; ?>" ><br><br>
		<span style="display:block;"><?php  echo isset($error["content"]) ? $error["content"] : "";?></span>
		<label for="content">Content:</label>
		<input type="text" name="content" id="content" value="<?=  $tutorial["tutorial_content"]; ?>"><br><br>
		<span style="display:block;"><?php echo isset($error["active"]) ? $error["active"] : "";?></span>
		<input type="radio" name="active"  id="active" <?php echo ($tutorial["tutorial_active"] == 1  ? "checked" : "");    ?>  value="active"><label for="active">Active</label>
		<input type="radio" name="active" id="passive" <?php echo ($tutorial["tutorial_active"] == 0 ? "checked" : "");    ?>   value="passive"  ><label for="passive">Passive</label>
		<br><br>
		<input type="hidden"  name="submit" value="action">
		<button type="submit">Submit</button>	
	</form>
</body>
</html>