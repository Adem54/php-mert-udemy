<?php 
//Burda daha once gormedgimi bir durum gerceklesiyor 
//sessionManager zaten dbConnection icerisinde require_once olarak dahil edilmis bir php dosyasidir. Ancak simdi bizim sessionManager icinde dbConnection a ihtiyacimiz olacak cunku session icindeki data veritabanindan sorgulanmasi gerekiyor...Yani two-way-binding cift tarafli bir bagimlilk soz konusu burda ondan dolayi da biz burda dbConnection i require etmek yerine...inherit edecegiz...cok onemli dikkat le inceleyelim...


class SessionManager extends DbConnection{
	/*
		1-Session olusturma
		2-Session silme
		3-Kullanici giris kontrol(login olmayan veya register olmayan kullanici register veya logn sayfasina yonlendirilecek)
		4-Kullanici bilgileri

		Session icerisinde biz array tutacagiz yani obje mantiginda array tutariz  yani aslinda javascriptteki obje ama spesifik key isimleri kullanacagimz icin array diyoruz php de 
		session i biz ne zaman olusturacagiz kullanici eger database imize kayit oldu ise o zaman sesssion olusturup oraya kulalnic bilgilerini gireriz..tutariz ne zaman a kadar kullanici cikis yapana kadar.
		Session in calismasi icin baslatilmasi gerekir ve bu da her yerde kullanilan, baglanti dosyasmizda baslatiriz session imizi ki o dosyayi kullanan tum php dosyalarindan session datlarmiza erisebilmek icin
	*/
// $host="localhost";
// $dbname = "testdb";
// $admin="root";
// $password="";
	public function __construct(?string $host,?string $dbname, ?string $admin, ?string $password)
	{
		parent::__construct($host,$dbname,$admin,$password);
	}

	static function createSession($array){
		if(count($array) != 0 ){
			foreach ($array as $key => $value) {
				$_SESSION[$key] = $value;
			}
		}
	}

	static function removeSession(){
		session_destroy();
	}

	//DbConnection i biz inerhit ettimz icin artik burda $this->db diyerek db baglantisina erisebiliyoruz
	//Burda yapilan islem hem email hem de password kontrolu yapilyor ama dikkat edelim siferlenmis halinde sorgulama yapiliyor
	//Eger ki veritabaninda hem email hem de password session icinde var olan data ile ayni degil ise o zamn false donduryor.
	//Burda index.php icinde kontrol ettgimzde biz veri tabanina kaydedilmis olan user credentials leri sorgulaniyor ve session a kaydedilmis ve de veritabaninda var ise o zaman true geliyor yok session da bulunan email,password eger yok ise o zaman da false geliyor
	public function checkSessionDataExistInDb(){
		//email ve password session icerisinde var ise
			
			if(isset($_SESSION["email"]) && isset($_SESSION["password"])){
			//	$email = strip_tags($_SESSION["email"]);
				$email = htmlspecialchars($_SESSION["email"]);//veritabani query sogrusuna sokacagimz icin her zaman guvenlik tedbirini elden birakmamaliyiz
			 $password = strip_tags($_SESSION["password"]);
			//$hash=password_hash($password,PASSWORD_DEFAULT);
				$password = htmlspecialchars($_SESSION["password"]);
			
				//ONCE EMAIL CHECK EDERIZ sonra da passwordu password_verify inbuild methodu ile sorgulariz..  
				$sql = "SELECT * FROM testdb.user where email=:email && password=:password";
				$query = $this->db->prepare($sql);
				$query->bindParam(":email",$email,PDO::PARAM_STR);
				$query->bindParam(":password",$password,PDO::PARAM_STR);
				$query->execute();
				$user = $query->fetch(PDO::FETCH_ASSOC);
				
				//$query->rowCount()
				// if($user){
					if($query->rowCount() > 0){
					 return true;
					 //Buraya girerse yani true gelirse o zaman demekki bu data, veritabaninda kayitli imis
				}else{
					//false gelirse demekki bu data ilk defa gelmis ve veritabaninda bulunmayan bir data imis diyebilirz
					return false;
				}
				
			}else {//o zaman kullanici giris yapmamis session icinde kullanicinin email ve password bilgiileri yok cunku
				return false;
			}
	}


	//Kullanicinin sessiondaki bilgileri database deki bilgileri ile uyusuyor mu onu kontrol ediyor bizim checkSessionDataExistInDB methodu ve  bu da cok effektif bir yontem ayni class icinde biir islemi yaparken ihtiyac duydugumzu bir fonksiyonu yine o class icinde olusturup onu kullanmamiz gerekiyor bunu cokca uygulayacagiz... 
	//ARTIK email ve password degerleri session im icerisinde demektir eger checkSEssionDataExistInDB true gelirse ve biz de o zaman session dan emial ve password degerlerini veritabanindann sorgulayip alabiliriz.... bunu surekli sorgulama sebebi biz session da email ve passwor degerlerimizi edit edebiliyoruz ve oyle durumlarda veritabaninda kaydettimigz email-password degeri her zaman match olmayabilir... 

	public function userInfo(){
		
		if($this->checkSessionDataExistInDb()){
			$email = $_SESSION["email"];
			$password = $_SESSION["password"];
			$sql = "SELECT * FROM testdb.user where email =:email && password =:password ";
			$query = $this->db->prepare($sql);
			$query->bindParam(":email",$email,PDO::PARAM_STR);
			$query->bindParam(":password",$password,PDO::PARAM_STR);
			$query->execute();
			$user = $query->fetch(PDO::FETCH_ASSOC);
			return $user;


		}else{
			return false;
		}
	}

}

?>
