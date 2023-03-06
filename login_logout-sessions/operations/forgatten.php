<?php 
require_once("../config/dbConnection.php");
require_once("../template/header.php");
?>

<?php 


$message = ["error" => ""];
if(isset($_POST["act"])){//isset ile olmak zorunda..yoksa patlar
	$email = strip_tags($_POST["email"]) ?? "";
	if(!empty($email)){
 	//eger email i bos girmedi ise bu email sistemimize kayitli  mi kontrol yapacagiz.. 
	 $sql = "SELECT * from testdb.user where email =:email";
	 $my_db = $connection->db->prepare($sql);
	 $my_db->bindParam(":email",$email,PDO::PARAM_STR);
	 //PDO::PARAM_STR
	 $my_db->execute();
	 if($my_db->rowCount() > 0){
		//Eger email sistemimizde kayitli ise biz kullaniciya passwordu unutup sifremi unuttum sisteminde bir kod gondeririz
		//yok boyle bir email yok ise o zaman biz kullaniciya boyle bir email yoktur seklinde bir uyari mesaji gondeririz
		echo "This email is registered the system";
		//Yapacagimiz islem, eger email sistemimizde kayitli ve kullanici sifremi unuttuma tiklarsa o zaman yapmamiz gereken forgatten alanina bir kod koymak
		$code = rand(1,9000)."_".rand(1,9000);
		$sql = "UPDATE TESTDB.USER SET forgatten=:forgatten where email=:email";
		$query = $connection->db->prepare($sql);
		$query->bindParam(":forgatten",$code, PDO::PARAM_STR);
		$query->bindParam(":email",$email, PDO::PARAM_STR);
		$query->execute();
		if($query->rowCount()>0){
			echo "You created forgatten code...";
			//Burda artik database e kaydedilen forgatten code unu biz kullaniciya email olarak gonderecegiz
			//Bu phpmailer ile gonderiliyor 
			$message = "I came here because of you forgat your password \n
			This is your first-used code: ".$code;
		try {
			mail($email,"forgatten my password",$message);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
			echo "A code is sent your mail";
		}else{
			echo "You don't created forgatten code";
		}

	 }else{
		echo "This email is not registered the system";
	 }
	}else{
		$message["error"] = "Please fill in the email field";
	}

	//Girilen email i kontrol etme islemini yaptiktan sonra user tablomuza 1 tane forgatten kolonu ekleyecegiz... 
	//forgatten text column ekliyoruz user tablosuna 
	//Yapacagimiz islem, eger email sistemimizde kayitli ve kullanici sifremi unuttuma tiklarsa o zaman yapmamiz gereken forgatten alanina bir kod koymak

}

?>
<body onload="Onload(event);">
<h3> <?php echo $message["error"]; ?> </h3>
<h2>Login</h2>

<form   action="" method="POST" id="form">

	<div class="form">
		<span>Email:</span>
<input  type="email" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "";  ?>"> 
		
	</div>
	<br>
	
	<br>
	<div class="form">
		<input type="hidden" name="act" value="register">
		<button onclick="OnSubmit(event);" style="cursor:pointer;" type="submit">Login</button>
	</div>

</form>

</body>