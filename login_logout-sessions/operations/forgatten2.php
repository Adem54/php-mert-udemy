<?php 
require_once("../config/dbConnection.php");
require_once("../template/header.php");
?>

<?php 


$message = ["error" => ""];
if(isset($_POST["act"])){//isset ile olmak zorunda..yoksa patlar
	$email = strip_tags($_POST["email"]) ?? "";
	$password = strip_tags($_POST["password"]) ?? "";
	$password_again = strip_tags($_POST["password_again"]) ?? "";
	$disposable = strip_tags($_POST["disposable"]) ?? "";
	if(!empty($email) && !empty($password) && !empty($password_again) && !empty($disposable)){
		//Tum alanlar dolu olarak girildikten sonra da burda password ile password_again esit mi onu kontrol ederiz
		if($password == $password_again){
			//Eger password ile password again de birbirine uyuyor ise burda gelen kod un gercekten bu email a ait oup olmadgini kontrol ederiz ... 
			$sql = "SELECT * FROM TESTDB.USER WHERE email = ? && forgatten = ?";
			$check_email = $connection->db->prepare($sql);
			$check_email->execute([$email,$disposable]); 
			if($check_email->rowCount() > 0){
				//Artik burda kod dogru hersey dogru artk burda kullanicinin verdigi yeni sifreyi update edebiliriz ve de tek kullanimlik kodu burda da silecegiz
				$sql = "UPDATE TESTDB.USER SET password=:password, forgatten=:forgatten where email=:email ";
				$query = $connection->db->prepare($sql);
				$query->execute([
					":password"=>md5($password),
					":forgatten"=>"",
					":email"=>$email
				]);
				if($query->rowCount() > 0){
					$message["success"] = "You updated your password successfully";
				}else{
					$message["error"] = "Your password-update process is failed";
				}
			}else{
				$message["error"] = "Your disposable code is not true";
			}
		}else{
			$message["error"] = "Your passwords don't match eachother";
		}

	}else{
		$message["error"] = "Please fill in the email field";
	}

	//Girilen email i kontrol etme islemini yaptiktan sonra user tablomuza 1 tane forgatten kolonu ekleyecegiz... 
	//forgatten text column ekliyoruz user tablosuna 
	//Yapacagimiz islem, eger email sistemimizde kayitli ve kullanici sifremi unuttuma tiklarsa o zaman yapmamiz gereken forgatten alanina bir kod koymak

}

//Kullanici sifremi unuttum dediginde kullanicidan forgatten.php de email ini girmesi istenir ve email i girip submit yapar ve biz veritabaninda bir code olustururuz kullaniciya vermek uzere ve bu code u biz kullanicya mail atariz ardindan ise, kullanicyi forgatten2.php  sayfasina yonlendiririz email ine gonderilen kod ile email ini tekrar girerek sifre yenileme islemini burda yaptirabilmek icin

?>
<body onload="Onload(event);">
<h3> <?php echo isset($message["error"]) ? $message["error"] : ""; ?> </h3>
<h3> <?php echo isset($message["success"]) ? $message["success"] : ""; ?> </h3>
<h2>Login</h2>

<form   action="" method="POST" id="form">

	<div class="form">
		<span>Email:</span>
	<input  type="email" id="email" name="email" value=""> 
		
	</div>
	<br>
	<div class="form">
		<span>Disposable code:</span>
		<input type="text" id="pass" name="disposable" value="">
	</div>

	<br>
	<div class="form">
		<span>Password:</span>
		<input type="password" id="pass" name="password" value="">
	</div>

	<br>
	<div class="form">
		<span>Password again:</span>
		<input type="password" id="pass_again" name="password_again" value="">
	</div>
	
	<br>
	<div class="form">
		<input type="hidden" name="act" value="register">
		<button onclick="OnSubmit(event);" style="cursor:pointer;" type="submit">Login</button>
	</div>

</form>

</body>