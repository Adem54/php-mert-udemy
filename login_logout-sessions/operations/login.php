<?php 
require_once("../config/dbConnection.php");
require_once("../template/header.php");
$message = ["error" => ""];
if(isset($_POST["act"])){//isset ile olmak zorunda..yoksa patlar
	$email = strip_tags($_POST["email"]) ?? "";
//	$email = htmlspecialchars($_POST["email"]) ?? "";
	$password = strip_tags($_POST["password"]) ?? "";
//	$password = htmlspecialchars($_POST["password"]) ?? "";

//COK ONEMLI BIR UYAARI...LOGIN-ISLEMINDE ZATEN KULLANICI ADI NI VERITABANINDA KONTROL EDECEGMIZ ICIN KULLANICININ GIRDIGI EMAIL ADRESINI EMAIL FILTRESINDEN GECRIMEIYORUZ CUNKU GIRILEN DEGER ZATEN VERITABANINDAN YOK ISE ORDAN DONMUS OLACAK ZATEN
//if(!filter_var($email,FILTER_VALIDATE_EMAIL)) bunu yapmiyoruz burda ama bunu register da mutlaka yapariz
	

	if(empty($email) || empty($password)){ 
		$message = ["error" => "Please fill all the fields"];
	}else{// !empty($email) &&  !empty($password)  ya da boyle bir condition ile eger ikisi de bos degilse diyebilriz
		//NORMAL PROSEDUR DE USERNAME VEYA EMAIL SADECE SORGULANIR VE EGER O VAR ISE VERI TABANINDA, SONRA ORDAN SIFRE CEKILIR VE SIFRE AYRICA CASE-SENSITIVE OLARAK SORGULANIR CUNKU SQL- DE CASE-INSENSITIVE OLDUGU ICIN KULLANICININ GIRDIGI BUYUK HARF VEYA KUCUK HARF FARKETMIYOR VE BU SIFRELERDE COK OJNEMLIDIR DOLAYISI ILE SIFRELERI SQL SORGUSUNDA TEST-ETMEK VEYA CHECK ETMEK KESINLIKLE HIC DE SAGLIKLI DEGILDIR ONDAN DOLAYI BIZ GENELLIKLE ILK ONCE USERNAME VEYA EMAIL I VERITABANINDA KONTROL EDERIZ EGER VAR ISE ONDAN SONRA ICERDEKI PASSWORDA ERISIIP ONUN YA PASSWORD_vERIFY ILE YA  DA MD5 ILE SIFRELENMIS ISE DE, TEKRAR MD5 SIFRESINDEN SADELESTIRIP SIFRENINN CIPLAK HALLERINI STRCASE ILE KARSILASTIRIP SIFRE DOGRU ONU KONTROL EDERIZ... 
		try {
			$password = md5($password);
		$sql = "SELECT * from testdb.user where email =:email && password =:password ";
		$my_db = $connection->db->prepare($sql);
		$my_db->bindParam(":email",$email,PDO::PARAM_STR);
		//PDO::PARAM_STR
		$my_db->bindParam(":password", $password,PDO::PARAM_STR);
		$my_db->execute();
		$user = $my_db->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
		//$my_db->rowCount() ile de sorgu yapabiliriz sorgu sonucu 0 degil ise veya 0 dan buyuk ise bu demektir ki data var
		if(!$user){
			$message = ["error" => "This user name is not exist in our system!"];
		}else{
			//Kullanici var ise buraya girer ve o zaman da ne yapiyoruz kullanici login oldugu anda session olustur ve session a bilgiler i atarak kullanicinin loggin oldugunu bu sekilde bilecegiz... 
			SessionManager::createSession(["email"=>$email, "password"=>$password]);
		   //Ana sayfaya yonlendir... 
			helper::navigate("../index.php");
		}
		
	}
}

?>

<h3> <?php echo $message["error"]; ?> </h3>
<h2>Login</h2>

<form action="" method="POST">

	<div class="form">
		<span>Email:</span>
		<input type="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "";  ?>">
	</div>
	<br>
	<div class="form">
		<span>Password:</span>
		<input type="password" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : "";  ?>">
	</div>

	<br>
	<div class="form">
		<input type="hidden" name="act" value="register">
		<button style="cursor:pointer;" type="submit">Login</button>
	</div>

</form>