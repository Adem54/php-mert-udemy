<?php

require_once("config/dbConnection.php");

echo "<h1>Welcome to homepage!</h1>";

// print_r($_SESSION);
//var_dump($session_manager->checkSessionDataExistInDb());

//Eger bizim session a kaydettimg data ile veritabanindaki data uyusmuyorsa o zaman tekrar register sayfasina gonder burda suna dikkat edeleim.Biz veritabanina datayi kaydettikten ve session a kaydettikten sonra match yaparak uysup uysumadigini kontrol ediyorz bunu biz session da bazen edit yapabilyoruz ve kullanici hala oturum da acik kalabilyor biz kullanici session bilgilerini editledgmiz halde oyle durumlarda veritabanindaki ile session daki uyusup uyusmadigini kontrol etmemiz gerekiyor ve kontrol ediyoruz eger uyusuyorsa da o zaman yine bize kullaniciilarin tum bilgileirni veren methodu cagirarak kullaniciilarin tum bilgilerini aliyoruz ki burda kullanicyi karsilarken kullanalim, yok bilgiler uyusmuyorsa demekki kullaniciinin oturumu bitmis o zaman kullaniciyi tekrar  register sayfasina gonderelim.... 
if(!$session_manager->checkSessionDataExistInDb()){

	helper::navigate("operations/register.php");
		die();
}else {
//	var_dump($session_manager->userInfo());
$user_info =$session_manager->userInfo();
}

//Kullanici register sayfasinda gelen kullanici credentials veritabanina kaydedilmeden once daha once veritabaninda var mi bakiliyor sonra eger daha onceden yok ise data hem veritabanina kaydedilir hem de data sesssion icerisine kaydediliyor..Ve sonra da checkSessionDataExistInDB methodu ile kontrol yapiyoruz database de var mi diye...ve biz aslinda burda true gelmesini bekliyoruz cunku veritabanina da session a da kaydediyoruz ya zaten....

//Kullanici bu sayfaya geldigine gore demekki kullanici ya register dan kayit oldu, register veya signup ile ya da normal login oldu da girdi de bu sayfaya geldi yani kullanicinin session da user bilgilileri kaydedildi ise demekki kullaniici kayit olmus veya database de kaydi var onu biliriz
//Ancak biz kullanicinin oturum suresi bitttiginde veya logout olduktan sonra bu sayfaya girememsi bu sayfaydan dogrudan, register kayit sayfasina veya login sayfasina  yonlendirilmesini istiyoruz...Bunlari yine sessionManager da ayarlayp kullanacagiz

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
	<h3>Welcome <?php echo $user_info["name"]; ?></h3>
	<hr>
	<br>
	<button><a href="operations/logout.php">Logout</a></button>
</body>
</html>