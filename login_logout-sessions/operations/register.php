<?php 


require_once("../config/dbConnection.php");
require_once("../template/header.php");

//$oku->bindParam(':ad', $ad);

function check_user_exist(?string $email){
	global $connection;
	$sql = "SELECT * FROM testdb.user where email=:email";
	$my_db = $connection->db->prepare($sql);
	$my_db->bindParam(':email',$email,PDO::PARAM_STR);
	$my_db->execute();
	$user = $my_db->fetch(PDO::FETCH_ASSOC);
	return $user;
	//kiONTROL ICIN $my_db->rowCount() == 0 ise o zaman veritabaninda  hicbir degisiklik olmadi.. 
}

//function insert_user($name,$surname,$email,$pass,$gender){
	function insert_user($data){
	global $connection;
	$sql = "INSERT INTO testdb.user (name,surname,email,password,gender) VALUES(?,?,?,?,?)";
	$my_db = $connection->db->prepare($sql);
	
	// $my_db->bindParam(1,$name,PDO::PARAM_STR);
	// $my_db->bindParam(2,$surname,PDO::PARAM_STR);
	// $my_db->bindParam(3,$email,PDO::PARAM_STR);
	// $my_db->bindParam(4,$pass,PDO::PARAM_STR);
	// $my_db->bindParam(5,$gender,PDO::PARAM_INT);
	
//$hash=password_hash($password,PASSWORD_DEFAULT);
//	$data["pass"] = 	password_hash($data["pass"],PASSWORD_DEFAULT);
	$data["pass"] = 	md5($data["pass"]);
	$data = array_values($data);
	
	$my_db->execute($data);
	return $connection->db->lastInsertId();
	
}

$message=["error"=>"","success"=>""];
if(isset($_POST["act"])){

	//Tum alanlarimzi oncelikle guvenlik filtersingen geciririz ki bize karsi yonelebilecek tehlikelerden sistemimizi kormus oluruz..
	function form_filter($post){
		return is_array($post) ? array_map("form_filter",$post):htmlspecialchars(trim($post));
		//htmlspecialchars yerine striptags da kullanabiliriz
	}
	$_POST = array_map('form_filter',$_POST);

	$name = $_POST["name"] ?? null;
	$surname = $_POST["surname"] ?? null;
	$email = $_POST["email"] ?? null;
	$pass = $_POST["password"] ?? null;
	$gender = isset($_POST["gender"]) ?  intval($_POST["gender"]) : 0;//Burda integer turunden bir deger bekliyoruz ve intval ile alacagiz 

	if($name && $surname & $email & $pass){
			if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
				$message = [
					"error"=>"Email format is wrong! "
				];
			}else {//Buraya giriyorsa arrik email formatta dogru yazilmis demektir
				//Burda da gelen email daha oncden kayit olmus mu ona bakariz 
				$user =check_user_exist($email);
				
				if($user){
					$message = ["error"=>"This email is already registerd in DB"];
				
				}else {
					$data =["name"=> $name,"surname"=>$surname,"email"=>$email,"pass"=>$pass,"gender"=>$gender];
					$lastInsID = insert_user($data);
					if($lastInsID){
						$message = ["success"=>"Your data is added successfully"];
						//Burda artik data eklenmistir ve yapacagmiz 2 islem var data eklendiginde 1.si kayit olan kullanici bilgileirni session a kaydetmek 2. si de kullaniciyi artik register oldugu icin yonlendirmemiz gereken sayfaya yonelndirmektir
						//$password = password_hash($pass,PASSWORD_DEFAULT);
						$password = md5($pass);
						$registered_user = ["email"=>$email, "password"=>$password];
						sessionManager::createSession($registered_user);//Bu method session icerisine data kaydetme islevini yerine getiriyor
						//header("Location:../index.php");
					
						helper::navigate("../index.php");
						//Kullanici kayit olduktan sonra kullaniciyi dikkat edelimmm nereye gonderiyor index.php ye gonderiyor yani index.php ye burda kullanici giderken sesson bilgilierni kaydetmis olarak gidiyor.....PEKI madem session bilgilerini kendimiz kaydediyoruz zaten hemn oncesinde neden peki biz index.php sayfasinda 
					}else{
						$message = ["error"=>"Your data is not added successfully"];
					}
				}
			}
	}else {
		$message = [
			"error"=>"Please fill all the fields "
		];
	}
		
}

/*
1-herseyden once front-end de bir validation yapariz input iceriisnde de yapariz veya custom message donduren front-end validation da yapariz
2-Kullanici tarafindan mudahele edilebilen bir durumu oldugu icin front-end in kullanici isterse front-end validation i delebilir
Ondan dolayi back-end validation i yapmak cook cook onemlidir...
Bos birakilan herhangi bir alan icin mutlaka geri donusum mesaji verilmeli
email format kontrolu spesifk olarak back-endde de yapilmali
3-Hata mesajimizi olustururken bir dizi uzerinden bunu yapariz yani javascritppte obje mantiginda kullandmigz php dizi ile message icinde error key i kullanarak bir dinamik error message sistemi olustururuz
4-Tum kontrolllerden gecti ise kullanici, ilk once bu kullanici email i daha once sisteme kayti olmus mu onu kontrol edelim.. 
*/
 
?>
<h3>Register</h3>

<h2><?php echo isset($message["error"]) ? $message["error"] :"" ; ?> </h2>
<h2><?php echo isset($message["success"]) ? $message["success"] :"" ; ?> </h2>
<form action="" method="POST">
	<div class="form">
		<span>Name:</span>
		<input type="text" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "";  ?>">
	</div>
	<br>
	<div class="form">
		<span>Surname:</span>
		<input type="text" name="surname" value="<?php echo isset($_POST["surname"]) ? $_POST["surname"] : "";  ?>">
	</div>
	<br>
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
		<span>Gender:</span>
		<select name="gender" >
			<option disabled selected value="">--Choose gender--</option>
			<option <?php echo isset($_POST["gender"]) && $_POST["gender"] == "0" ? "selected" :"" ?> value="0">Man</option>
			<option <?php echo isset($_POST["gender"]) && $_POST["gender"] == "1" ? "selected" :"" ?> value="1">Woman</option>
		</select>
	</div>
	<br>
	<div class="form">
		<input type="hidden" name="act" value="register">
		<button style="cursor:pointer;" type="submit">Register</button>
	</div>

</form>