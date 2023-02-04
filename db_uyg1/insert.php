<?php 


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
	//Bos mu degil mi onu kontrol ederiz
	// if(empty($_POST["title"])){
	// 	$error["title"] = "title musn't be empty";
	// }
	// if(empty($_POST["content"])){
	// 	$error["content"] = "content musn't be empty";
	// }
	// if(empty($_POST["active"])){
	// 	$error["active"] = "active radio button musn't be empty";
	// }
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
/*

 $stmt=$conn->prepare("INSERT INTO isimler (isim, soyisim, email) VALUES (:isim, :soyisim, :email)");
 $resultInsert=$stmt->execute([
     ":isim" => $isim,
     ":soyisim" => $soyisim,
     ":email" => $eposta,
 ]); //eğer başarılı bir insert işlemi olduysa sonuç true döner.
*/
/*
$queryInsertUrl= "INSERT INTO `oc_url_alias` SET `query` = :pid, `keyword` = :keyw";
*/
	try {
		$sql = "INSERT INTO tutorials (tutorial_title,tutorial_content,tutorial_active) VALUES (:tutorial_title,:tutorial_content,:tutorial_active)";
	$stmt = $db->prepare($sql)->execute(
	[
		"tutorial_title"=>$title,
		"tutorial_content"=>$content,
		"tutorial_active"=>$active
	]
	);
	echo "Succesfully added new data";	
	header("Refresh:2,url=index.php");	
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	}
endif;
			
// header("Refresh:2,url=".site_url());	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		a{
			text-decoration: none;
		}
	</style>
</head>
<body>
	<h2>INSERT TUTORIAL</h2>
	<a style="text-decoration: none;"  href="index.php?page=homepage">&nbsp;&nbsp;<button>HOMEPAGE</button></a>
	<br><br>
	<form action="" method="POST">
		<span style="display:block;"><?php  echo isset($error["title"]) ? $error["title"] : "";?></span>
		<label for="title">Title:</label>
		<input type="text" name="title" id="title" ><br><br>
		<span style="display:block;"><?php  echo isset($error["content"]) ? $error["content"] : "";?></span>
		<label for="content">Content:</label>
		<input type="text" name="content" id="content" ><br><br>
		<span style="display:block;"><?php echo isset($error["active"]) ? $error["active"] : "";?></span>
		<input type="radio" name="active" id="active" checked  value="active"><label for="active">Active</label>
		<input type="radio" name="active" id="passive" value="passive" ><label for="passive">Passive</label>
		<br><br>
		<input type="hidden"  name="submit" value="action">
		<button type="submit">Submit</button>	
	</form>
</body>
</html>