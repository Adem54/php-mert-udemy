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
//$_POST["act"] BOYLE BIR KONTROL COK BUYUK YANLISTIR CUNKU...KULLANICI EGER BASKA BIR SAYFADAN ANCHOR ILE NAVIGE OLUR YA DA DIREK URL DEN SAYFAYA INERSE O ZAMAN SUBMIT EDILMEDIGI ICIN BURASI HATA VERECEK...
//if($_POST["act"]){
if(isset($_POST["act"])){
	$name = strip_tags($_POST["name"]);
	$surname =strip_tags($_POST["surname"]);
	//$gender = $_POST["gender"];

	//$gender = @$_POST["gender"];
	//Biz tabi select options da chooose gender diye bir select daha kullandigmiz icin kulanici eger select-option da hicbirseye dokunmadan submit yaparsa o zaman name gender hic gonderilmemis oluyor... ve biz yine hata aliyoruz ondan dolayi burda da karsimiza cozum olarak asagidaki gibi bir cozum yapmamiz gerekiyor bu cok onemlidir kullanici diyelim ki tum inputlari doldurdu ama select-option da hicbirseye dokunmadi ve submit yapti o zaman, boyle durumlar normal inputlardan farklidiri onun icin dikkatli olmaliyiz.... kesinlikle ayrica isset ile handle etmemiz gerekecektir...   
	$gender = isset($_POST["gender"]) ? intval($_POST["gender"]) : "" ;
	// $gender = intval($_POST["gender"]) ;
	//echo $gender; 
	//intval de gelebilecek herhangi sayiya donusebilen string i kaldirarak aliyor.. ondan dolayi da guvenlidir

	//$gender icin eger kullanici default select kullanmamiz olsa idi, ordan ya 0 ya da 1 gelecegi icin ki default olarak da muhtemelen orda 0-man value si verildigi icin her turlu ya 0 ya da 1 gelecegi seklinde senaryo da asagida bos olup olmadigini kontrol etme gibi bir islem yapmayacaktik...
	if(!empty($name) && !empty($surname) && $gender !== ""  ){
		//Simdi sunu bilelim kullanici su anda buraya geliuyorsa yani profil-formu goruyorsa zaten login dir su an yani bilgileri var zaten database de cunku bu sayfaynin en basinda kontrol den geciyor eger kullanici giris li ise izin ver yoksa register a gonder diyoruz zaten ondan dolayi simdi burda yapilacak is, yeni gelen bilgiler dogrultusunda bu kullanciya ait profil bilgileri update edilecek
	try {
		$sql = "UPDATE TESTDB.USER SET name=:name, surname=:surname, gender=:gender where id=:id";
		$query = $connection->db->prepare($sql);
		$query->execute(
			[
				":name"=>$name,
				":surname"=>$surname,
				":gender"=>$gender,
				":id"=>$user_info["id"]
			]
		);
		if($query->rowCount()){
			$messages["success"] = "You update your profile data successfully";
			helper::navigate("?");
		}else{
			$messages["success"] = "You don't update your data";
		}
	} catch (PDOException $ex) {
		echo $ex->getMessage();
	}

	}else{
		$messages["error"] = "Please fill the all fields";
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
	
	$name = $user_info["name"];
	$surname = $user_info["surname"];
	$gender =  $user_info["gender"];

	?>
<h2>Edit Profile Info</h2>
<a class="link" href="index.php">Back to settings</a>
<h3> <?= isset($messages["error"]) ? $messages["error"] : "" ?></h3>
<h3><?php echo $messages["success"]; ?></h3>
	<form action="" method="POST">
		<div class="form">
			<span>Name:</span>
			<input name="name" type="name" value="<?=  $name ; ?>">
		</div>
		<div class="form">
			<span>Surname:</span>
			<input name="surname" type="surname" value="<?= $surname ; ?>">
		</div>
		<div class="form">
		<span>Gender:</span>
		<select name="gender" >
			<option disabled selected value="12">--Choose gender--</option>
			<option <?php echo $gender == 0 ? "selected" : "" ?> value="0">Man</option>
			<option <?php echo $gender == 1 ? "selected" : "" ?> value="1">Woman</option>
		</select>
	</div>
	<div class="form">
		<input type="hidden" name="act" value="submit">
		<button type="submit">Submit</button>
	</div>

	</form>

</body>
</html>


