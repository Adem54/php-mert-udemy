<?php 

//Once burda kullanici girisi kontrol edilecek her zaman ki gibi
require_once("../config/dbConnection.php");
require_once("../template/header.php");


//Ilk once kullanici girisini sorgulariz eger girisi yok ise kullanicinin o zaman register sayfasina yonlendiririz kullaniciyi
if(!$session_manager->checkSessionDataExistInDb()){

	helper::navigate("../operations/login.php");
	die();

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
<h2>Settings</h2>
	<a class="link" href="profile.php">Edit Profile Info</a> 
	<a class="link" href="password.php">Change Password</a> 
	<a class="link" href="image.php">Change Profile Image</a> 
	<a class="link" href="<?php echo SITE_URL; ?>">Back to admin-panel</a>
</body>
</html>
<?php 

//<a class="link" href="/settings/profile.php">Edit Profile Info</a> => http://localhost/settings/profile.php
//<a class="link" href="settings/profile.php">Edit Profile Info</a>  => http://localhost/test/php-mert-udemy/login_logout-sessions/settings/settings/profile.php
//<a class="link" href="/profile.php">Edit Profile Info</a>  => http://localhost/profile.php
//http://localhost/test/php-mert-udemy/login_logout-sessions/settings/profile.php =>	<a class="link" href="profile.php">Edit Profile Info</a> 
?>