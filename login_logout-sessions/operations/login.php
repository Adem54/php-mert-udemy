<?php 
require_once("../config/dbConnection.php");
require_once("../template/header.php");
?>

<?php 



//Burda bir kontrol yapariz once... 
//Eger COOKIE icerisinde login key i kayitli ise onu bize goster diyecegiz burda... 
//Daha onceden cookie ye kaydedilmis iise bunu alabiliriz
//Simdi cookie icinden string formatinda olan datayi biz php de array formatinda almak icin json_decode ve de 2.parametreye de true kullanirsak array formmatinda alabiliyoruz
if(isset($_COOKIE["login"]))
{
	
	echo "COOKIE";
	$getLoginCookie = json_decode($_COOKIE["login"],1);
	//Eger var ise datamiz onu session a atiyoruz email ve passwordu... yani kullanici giris yaptigi ilk once cookies de var  mi daha onceden o sorgulanir sonra da session icerisine atilir
	SessionManager::createSession($getLoginCookie);
	helper::navigate(SITE_URL);

	//Buranin mantigini tam olarak anlayacak olursak burasi login sayfasinin en basi ve ilk once cookies in icerisinde login keywordu var mi diye kontrol edilior ve eger login keywordu var ise bu demektir ku bu kullanici daha once beni hatirlaya tiklayarak giris y apmis ve sonucunda bilgileri cookies e kaydedilmis o zaman sayfanin basinda biz ilk olarak cookies e bakiyoruz ve eger cookies da login data si var ise  o zaman diyoruz ki even simdi seni hatirladim ve artik diger prosedurlere hic gerek yok ben hizli bir sekilde seni ana sayfaya yonlendiriyorum....ISTE REMEMBER ME MANTIGI
	//Bu sayede session oturum suresi bitmis olsa bile, bizim server tarafinda kullanici icin cookies de tanimladigmiz sure boyunca artik kullanici beni hatirla dedeigi zaman otomatik olarak girebilecek
	//Tabi ayni sekilde logout sayfasina gelindiginde de cookies lerin silinmesi gerekir...
}


$message = ["error" => ""];
if(isset($_POST["act"])){//isset ile olmak zorunda..yoksa patlar
	
	$email = strip_tags($_POST["email"]) ?? "";
//	$email = htmlspecialchars($_POST["email"]) ?? "";
//	$password = strip_tags($_POST["password"]) ?? "";
	$password = htmlspecialchars($_POST["password"]) ?? "";
	$remember_me = @intval($_POST["remember_me"]) ?? "";
	
//COK ONEMLI BIR UYAARI...LOGIN-ISLEMINDE ZATEN KULLANICI ADI NI VERITABANINDA KONTROL EDECEGMIZ ICIN KULLANICININ GIRDIGI EMAIL ADRESINI EMAIL FILTRESINDEN GECRIMEIYORUZ CUNKU GIRILEN DEGER ZATEN VERITABANINDAN YOK ISE ORDAN DONMUS OLACAK ZATEN
//if(!filter_var($email,FILTER_VALIDATE_EMAIL)) bunu yapmiyoruz burda ama bunu register da mutlaka yapariz
	
	if(empty($email) || empty($password)){ 
		$message = ["error" => "Please fill all the fields"];
	}else{// !empty($email) &&  !empty($password)  ya da boyle bir condition ile eger ikisi de bos degilse diyebilriz
		//NORMAL PROSEDUR DE USERNAME VEYA EMAIL SADECE SORGULANIR VE EGER O VAR ISE VERI TABANINDA, SONRA ORDAN SIFRE CEKILIR VE SIFRE AYRICA CASE-SENSITIVE OLARAK SORGULANIR CUNKU SQL- DE CASE-INSENSITIVE OLDUGU ICIN KULLANICININ GIRDIGI BUYUK HARF VEYA KUCUK HARF FARKETMIYOR VE BU SIFRELERDE COK OJNEMLIDIR DOLAYISI ILE SIFRELERI SQL SORGUSUNDA TEST-ETMEK VEYA CHECK ETMEK KESINLIKLE HIC DE SAGLIKLI DEGILDIR ONDAN DOLAYI BIZ GENELLIKLE ILK ONCE USERNAME VEYA EMAIL I VERITABANINDA KONTROL EDERIZ EGER VAR ISE ONDAN SONRA ICERDEKI PASSWORDA ERISIIP ONUN YA PASSWORD_VERIFY ILE YA  DA MD5 ILE SIFRELENMIS ISE DE, TEKRAR MD5 SIFRESINDEN SADELESTIRIP SIFRENINN CIPLAK HALLERINI STRCASE ILE KARSILASTIRIP SIFRE DOGRU ONU KONTROL EDERIZ... 
		try {
		
			$password = md5($password);
		$sql = "SELECT * from testdb.user where email =:email && password =:password ";
		$my_db = $connection->db->prepare($sql);
		$my_db->bindParam(":email",$email,PDO::PARAM_STR);
		//PDO::PARAM_STR
		$my_db->bindParam(":password", $password,PDO::PARAM_STR);
		$my_db->execute();
		$user = $my_db->fetch(PDO::FETCH_ASSOC);
		//$my_db->rowCount() ile de sorgu yapabiliriz sorgu sonucu 0 degil ise veya 0 dan buyuk ise bu demektir ki data var
		if(!$user){
			$message = ["error" => "This user name is not exist in our system!"];
		}else{
			//Kullanici var ise buraya girer ve o zaman da ne yapiyoruz kullanici login oldugu anda session olustur ve session a bilgiler i atarak kullanicinin loggin oldugunu bu sekilde bilecegiz... 
			//Remember me islemini artik burda yapabilecegiz... 
			
			
			if($remember_me === 1)
			{
				echo "remember_me............";
				
				$cookieArray = array("email"=>$email, "password"=>$password);
				//ayni localstorage mantiginnda, string e cevrilerek kaydedilir
				$cookieArray = json_encode($cookieArray);
		
				//setcookie("login",$cookieArray,time()+ 60*60*2);//icinde bulundgumuz dosya ile ayni klasor altinda olan diger dosyalar bu sekilde cookie yi tanimlayinca erisebilirler ancak, farkli klasorler icerisinde bulunan php dosyalari bu cookie ye erisemez ve biz o sayfalardan bu cookiye yi alamayabiliriz ondan dolayi...farkli klasorleerdeki sayfalardan eger cookiye erismeye calisak isek index.php gibi, o zaman setcookie de 4.parametre ile dir duzeyini belirtmeliyiz...
				setcookie("login",$cookieArray,time()+ 60*60*2,"/");
				
				//Artik farkli klasor altinda olan index.php den cookimize erisebiliyoruz setcookie de 4.parametreyi tanimladiktan sonra
			}
			SessionManager::createSession(["email"=>$email, "password"=>$password]);
		   //Ana sayfaya yonlendir... 
			helper::navigate(SITE_URL);

		}
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}
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
	<div class="form">
		<span>Password:</span>
		<input type="password" id="pass" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : "";  ?>">
	</div>

	<br>

	<div class="form">
		<span style="display:inline-block;">Remember Me!</span>
		<input type="checkbox" id="remember_me" name="remember_me" value="1"    style="width:4%; cursor:pointer; ">
	</div>
	<br>
	<div class="form">
		<input type="hidden" name="act" value="register">
		<button onclick="OnSubmit(event);" style="cursor:pointer;" type="submit">Login</button>
	</div>

</form>

<script>
	//HARIKA BESTPRACTISE... ONCE HTML HIDDEN YAPIP SONRA ONLOAD ICINDE HTML LI DISPLAY BLOCK YAPARIZ ISTE O ARADA GELEN DATA YI ALIRIZ VE ONDAN SONRA HTML I EKRANA BASMIS OLURUZ VE BUR SEKILDE REACT TA USEEFFECT ILE YAPTIGMIZ ISLEMI RESMEN, ONLOAD KULLANARAK VANILYA JAVASCRIPTTE YAPMIS OLURUZ....  
	//ISTE BIZ BU MANTIGI UYGULAMALIYIZ....BESTPRACTISE... NORMAL BIR HTML TAG IININ ICINDE FOR-LOOP ILE DONDURECEK KADAR DATA OLURSA SAYFAY YUKLENIRKEN GELMESINI BEKLDGIMIZ O ZAMAN DA INNERHTML UZERINDEN ONLOAD ICINDE HTML I GUNCELLER ONDAN SONRA HTML I EKRANA BASTIRMIS OLURUZ.... 
	function Onload(event)
	{
		// console.log("Form onloading.....");
		// document.querySelector("#form").style.display="block";
		// document.querySelector("#email").value = localStorage.getItem("email");
		// let password = localStorage.getItem("password");
	
	//	document.querySelector("#pass").value = localStorage.getItem("password");
	}
//	
function OnSubmit(event){

	console.log("event");
	if(document.getElementById("remember_me").checked){
		localStorage.setItem("email",document.querySelector("#email").value);
		localStorage.setItem("pass",document.querySelector("#pass").value);
	}else{
		localStorage.removeItem("email");
		localStorage.removeItem("pass");
	}
	
}
</script>
</body>