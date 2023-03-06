<?php 

//Once burda kullanici girisi kontrol edilecek her zaman ki gibi
require_once("../config/dbConnection.php");
require_once("../template/header.php");


//Ilk once kullanici girisini sorgulariz eger girisi yok ise kullanicinin o zaman register sayfasina yonlendiririz kullaniciyi
if(!$session_manager->checkSessionDataExistInDb()){

	helper::navigate("../operations/login.php");
	die();
}

$user_info = $session_manager->userInfo();

$messages = ["error"=>"","success"=>""];

if(isset($_POST["act"])){
	$password = strip_tags($_POST["password"]);
	$new_password = strip_tags($_POST["new-password"]);
	$new_password_again = strip_tags($_POST["new-password-again"]);

	if(!empty($password) && !empty($new_password) && !empty($new_password_again)){
		//yeni sifre ile yeni sifre tekrari esit mi degil mi ona bakacagiz.. 
		//Birde eski sifre ile de yeni sifresnin ayni olmamasi gerekiyor buna da onlem almak gerek

		if($new_password === $new_password_again){
			//burda bir de kullanicinin girdigi sifre nin yani eski sifrenin dogru mu olduguna bakalim...ya adam mevcut sifresini yanlis giriyorsa
		//Biz yeni sifre ile yeni sifre tekrarini kontrol etmeden once kullanici eski sifresini dogru girmis mi onu kontrol de edebilirdik ancak biz o islemi burda yeni sifre ve yeni sifre tekrarindan sonra yapmayi tercih ettik...ama oncesinde de yapabilirdik.... 
			if($user_info["password"] == md5($password)){
				//Burda artik sifremizi degistirebiliyoruz... 
				$sql = "UPDATE TESTDB.USER SET password=:password where id=:id";
				$query = $connection->db->prepare($sql);
				$query->execute([
					":password"=>md5($new_password),
					":id"=>$user_info["id"]
				]);
				if($query->rowCount()){
					$messages["success"] = "Your password is changed succesfully";
					//Bursasi cok onemli password bizim sesssion imizda bulunan bir data idi ve bizim login oldugmuzu gosteren data idi, ondan dolayi biz passwordu veritabaninda degistirdigmz anda direk bunu session a bildirmemiz gerekir yani session i da anindan guncelleememiz gerekir ki sistem bizi ilk sayfa degisimi ve ya  yenilemesinde disari atmasin... 
					$session_manager->createSession(["email"=>$user_info["email"],"password"=>md5($new_password)]);
					//	helper::navigate("?");
				}else {
					$messages["error"] = "Your password changing is failed";
				}
			}else{
				$messages["error"] = "The existing password is wrong!";
			}

		}else{
			$messages["error"] = "New passwords don't match";
		}
	}else{
		$messages["error"] = "Please fill in the all fields";
	}
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="../public/css/style.css"> -->
	<title>Document</title>
</head>
<body>
	<?php 
	
	$password = md5($user_info["password"]);


	?>
<h2>Change Password</h2>
<a class="link" href="index.php">Back to settings</a>
<h3> <?= isset($messages["error"]) ? $messages["error"] : "" ?></h3>
<h3><?php echo isset($messages["success"]) ? $messages["success"] : ""; ?></h3>
	<form action="" method="POST">

	<div class="form">
		<span>Password:</span>
		<!-- Burda sunu iyi bilelim passworde eski passwordu kullanicinin onune getirilmez...aciktan gosterilerek getirilmez, kendisinin eski passwordunu bilmesi beklenir burda.... Eger kullanici eski passwordu hatali girerse o zaman ona hata mesji verilir passwordunu hatali girdin diye -->
		<input name="password" type="password" value="">
	</div>
	<div class="form">
		<span>New Password:</span>
		<input name="new-password" type="password" value="">
	</div>
	<div class="form">
		<span>New password again:</span>
		<input name="new-password-again" type="password" value="">
	</div>
	
	<div class="form">
		<input type="hidden" name="act" value="submit">
		<button type="submit">Submit</button>
	</div>

	</form>

</body>
</html>
