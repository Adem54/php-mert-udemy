<?php

try {
	$db = new PDO("mysql:host=localhost;dbname=testdb;","root","");
	echo "Connection successfull";
} catch (PDOException $ex) {
	echo $ex->getMessage();
}

//Simdi biz switch-case kullanarak api uzerinde crud opearasyonlari yapabilme imkani saglayacagiz... 

$mode =$_GET["mode"] ?? "";

switch ($mode) {
	case 'insert':
		# code...
		insert_user($db);
		break;
	case 'delete':
		delete_user($db);
		break;
	case 'edit':
		edit_user($db);
		break;
	case 'list':
		get_users($db);
		break;
	//detail	
	case 'listByOne':
		get_user($db);
		break;	
	default:
	
		break;
}

/*
API LERDE GENELLIKLE KESINLIKLE OLACAK ENDPOINTLER SUNLARDIR... TABI DAHA DETAYLI VE EKSTRALARI DA OLACAKTIR AMA OLMAZSA OLMAZLAR BUNLARDIR
1-INSERT-CREATE-ADD-POST
2-EDIT-UPDATE-MODIFY-WRITE
3-DELETE-REMOVE
4-SHOW-LIST-READ-GET(BU HEM FILTRELEYEREK COKLU DATA LISTELEME VE DIREK HERHANGI BIR PRODUCTI LISTELEME SEKLINDE BIRCOK DEGISIK VERSIYONDA YAPILACAKTIR)
5-PRODUCTDETAIL(BURDA TEK BIR KAYITA AIT DETAY LISTESI KULLANICIYA SUNULACAKTIR.. )

API HAZIRLARKEN OZELLIKLE DIKKAT ETMEMIZ GEREKENLER 
1-POST ILE KULLANICI TARAFINDAN REQUEST DE GONDERILECEK DATALARI ALINMASI
2-MUTLAKA KULLANICIYA RESPONSE UN HEM DATA, HEM BOOLEAN HEM MESSAGE ICERECEK SEKILDE VE HATA VAR ISE DE O HATA NIN NEDEN KAYNAKLANDIGININ KULLANICIYI DOGRU VE ISABETLI BIR SEKILDE BILGILENDIRECEK SEKILDE BIR RESPONSE SISTEMI KURMALIYIZ YANI HEM SUCCESS HEM DE ERROR DURUMUNDA COK ISABETLI VE DOGRU RESPONSE RETURN LARI HAZIRLANMALIDIR
3-VERI JSON-STRING FORMATINDA ALINMALI VE YINE JSON FORMATINDA GONDERILMELIDIR
4-YENI DATA EKLEMELERDE EKLENECEK DATA DAHA ONCEDEN VERITABANINDA BULUNUP BULUNMADIGINI KONTROL EDERIZ VE BAZI DURUMLARDA VERITABANINDA EGER EKLENECEK KAYIT VAR ISE EKLENMEZKEN BAZI DURUMLARDA YINE DE EKLEYEBILIRIZ... BU IHTIYACIMZA GORE DEGISECEKTIR...AMA USER LOGIN-LOGOUT-SIGNUP ISLEMLERINDE TABI KI DAHA ONCE VERITABANINA EKLENEN BIR KULLANICI EMAIL UZERINDEN KONTROL EDILIR KI EMAIL UNIQ TIR.. DAHA ONCE KULLANICI VAR ISE YENIDEN EKLEMEMIS OLURUZ.. 
5-	INSERT-UPDATE-DELETE GIBI ISLEMLERDE VEYA DIGER TUM ISLEMLERDE ISLEMIN YAPILDIGI YANI EXECUTE VEYA QUERY NIN YAPILDIGI DEGISKEN UZERINDEN BIZ KAC TABLODAKI KAC TANE ROW UN BU QUERY DEN ETKILENDIGINI ALABILIYOURZ... BU DA BIZIM INSERT-UPDATE-DELETE ISLEMLERIMIZIN BASARILI OLUP OLMADIGININ KONTROL EDEBILMEMIZI SAGLIYOR
6-FRONT-END VEYA CLIENT(TARAYICI) TARAFINDAN GONDERILEN ISTEGIN GECECEGI ASAMALAR INCE INCE UYGULANARAK BELKI 4-5 FARKLI ASAMADA HERHANGI PROBLEM OLMA DURUMLARININ HEPSINE YONELIK RESPOSE LARIMIZ HAZIRLANMALIDIR KI APIMIZ KULLANICIYA COK ISABETLI VE DOGRU BIR YONLENDIRME YAPABILSIN
7-DATA SILME ISLEMLERINDE DE GONDERILEN ID  YE AIT DATA DATABASE DE OLUP OLMADIGINI KONTROL EDERIZ KI BELKI BIZIM DATABASE ISLEMLERIMIZDE HICBIR PROBLEM YOKTUR PROBLEM O ID YE AIT DATA VERITABANINDA BULUNMUYOR OLABILIR BOYLE DURUMDA DA EN AZINDAN HATA NIN NEDEN KAYNAKLANDIGINI ANLAMIS OLURUZ... YA DA OD ID NIN VERITABANINDA OLMADIGINI BLIRIZ
8-UPDATE ISLEMI YAPARKEN DE YINE GONDERILEN ID YE AIT USER DATABASE DE ONCEDEN VAR MI ONU CHECK ETMEKTE FAYDA VAR...YANI DAHA ONCEDEN DATABASE DE BULUNMAYAN BIR RECORD U BIZ UPDATE EDEMEYIZ SONUCTA... 

*/

//
function insert_user($db){
//	global $db;//Disardaki degisken fonksiyhon icinde veya diger scope larda kullanilabilmesi icin global yapilmalidir
	
	//Buraya girdiginde form gonderilmis olacak o kesin ama ihtimal kullanici bos birakip gondermistir hatta front-end validation i delip de gondermistir diye dusunebiliriz 
	$name = htmlspecialchars(trim($_POST["name"]));
//	$name = strip_tags(trim($_POST["name"])); html taglarindan arindiradabilirz

	$surname = htmlspecialchars(trim($_POST["surname"]));
	$email = htmlspecialchars(trim($_POST["email"]));
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		die("The Email is not valid format");
	}

	$pass = htmlspecialchars(trim($_POST["password"]));

	if(!empty($name) && !empty($surname) && !empty($email) && !empty($pass) ){
		
		
		//SIMDI DIREK GELEN VERIYI EKLEME ISLEMI YAPMAMAMLIYHIZ...ILK ONCE BU KAYITIN DAHA ONCE VERITABAININA EKLENIP EKLENMEDIGINI KONTROL ETMELIYHIZ EGER DAHA ONCE EKLENMIS ISE GELEN VERIYI TEKRAR EKLEMEMELIYIZ
		$user = $db->query("SELECT * FROM user where email ='".$email."'");
		//INSERT-UPDATE-DELETE GIBI ISLEMLERDE VEYA DIGER TUM ISLEMLERDE ISLEMIN YAPILDIGI YANI EXECUTE VEYA QUERY NIN YAPILDIGI DEGISKEN UZERINDEN BIZ KAC TABLODAKI KAC TANE ROW UN BU QUERY DEN ETKILENDIGINI ALABILIYOURZ... BU DA BIZIM INSERT-UPDATE-DELETE ISLEMLERIMIZIN BASARILI OLUP OLMADIGININ KONTROL EDEBILMEMIZI SAGLIYOR
		//BURDA ISE DIKKKAT EDELIMMMM...INSERT ISLEMI YAPARKEN EGER USER EKLIYORSAK GIDIP ONCE USER SORGULANMALI VE EGER BOYLE BIR KUULLANICI MEVCUT ISE O ZAMAN AYNI KULLANICI BIR DAHA EKLENMEMLELIDIR... 
		if($user->rowCount() == 0){
		try {
			$insert_sql = "INSERT INTO USER (name,surname,email,password) VALUES(:name,:surname,:email,:password)";
			$query = $db->prepare($insert_sql);
			$query->execute([
				":name"=>$name,
				":surname"=>$surname,
				":email"=>$email,
				":password"=>$pass
			]);
			if($query->rowCount()) echo '{"status":"YES","msg":"You are registered succesfully","result":true}';
		} catch (PDOException $ex) {
			$msg = $ex->getMessage();
			if($query->rowCount() == 0) echo '{"status":"NO","msg":" '. $msg .'","result":false}';
		}
			
		}else{
			echo '{"status":"NO","msg":"This user is exist on the database","result":false}';
		}

	}else{
		echo '{"status":"NO","msg":"Please fill the all fields","result":false}';
	}
}


function check_user($db,$id){
	$sql_select = "SELECT * FROM USER WHERE id = :id";
	$stmt = $db->prepare($sql_select);
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	return $user;
}

function delete_user($db){

	if($_POST["act"]){
		$id = intval($_POST["id"]) ;
		if($id && !empty($id)){
			try {
				$user = check_user($db,$id);
				if($user){
					$sql = "DELETE FROM user where id = ?";
					$query = $db->prepare($sql);
					$query->bindParam(1,$id,PDO::PARAM_INT);
					$query->execute();
					if($query->rowCount()) {
						echo '{"status":"YES","msg":"user is deleted succesfully","result":true}';
					}
				}else{
					echo '{"status":"NO","msg":"user is not exist in DB","result":false}';
				}


				
			} catch (PDOException $ex) {
				$msg = $ex->getMessage();
				if($query->rowCount() == 0) echo '{"status":"NO","msg":" '. $msg .'","result":false}';
			}
		}else{
			echo '{"status":"NO","msg":"Your id is not valid","result":false}';
		}	
	}
}

function edit_user($db){
	if($_POST["act"]){

		$id = intval($_POST["id"]) ?? null;
		//$name = htmlspecialchars(trim($_POST["name"]));
		$name = strip_tags(trim($_POST["name"]));// html taglarindan arindiradabilirz
		//$surname = htmlspecialchars(trim($_POST["surname"]));
		$surname = strip_tags(trim($_POST["surname"]));

		if(!empty($name) && !empty($surname) && $id > 0 ){
			
			$user = check_user($db,$id);
			if($user){
				$sql = "UPDATE USER SET name=:name, surname=:surname WHERE id=:id ";
				$query = $db->prepare($sql);
				$query->bindParam(":id",$id,PDO::PARAM_INT);
				$query->bindParam(":name",$name,PDO::PARAM_STR);
				$query->bindParam(":surname",$surname,PDO::PARAM_STR);
			
				$query->execute();
				if($query->rowCount()){
					echo '{"status":"YES","msg":"You updated your name and surname data","result":true}';
				}
				}else{
					echo '{"status":"NO","msg":"Your update opearation is failed","result":false}';
				}
			}else{
				echo '{"status":"NO","msg":"user is not exist in DB","result":false}';
			}		
		}
	}


	function get_users($db){
		try {
			$sql = "SELECT * FROM USER"; 
			$query = $db->query($sql);
			$users = $query->fetchAll(PDO::FETCH_ASSOC);
			//if(count($users) > 0)
			$data = [];
			if(count($users) > 0){
				$data = json_encode($users);
				echo '{"status":"YES","msg":"You updated your name and surname data","result":true, "data":'. $data .'}';
			}else{
				echo '{"status":"YES","msg":"There is no data to show","result":true, "data":'. $data .'}';
			}
		} catch (PDOException $e) {
				echo $e->getMessage();
		}
	}
	
	function get_user($db){
		if($_POST["act"]){

			$id = intval($_POST["id"]) ?? null;
			if($id > 0 || $id !== 0){
				$user = check_user($db,$id);
				$data = [];
				if($user){
					$data = json_encode($user);
					echo '{"status":"YES","msg":"You updated your name and surname data","result":true, "data":'. $data .'}';
				}else{
					echo '{"status":"YES","msg":"There is no data to show","result":true, "data":'. $data .'}';
				}
			}else{
				echo '{"status":"NO","msg":"Your id is wrong","result":true}';
			}
			

		}
	}


?>
<!--
php de olustrudgumuz api endpoint i ni postmen de test ederken ornegin form dan post methodu ile data gonderecegiz ama 
get methodu ile de ornegin url den bir deger gonderecek isek post man da post u seceriz cunku post demek, front-end den data gonderme islemi post dur, ama dogrudan bir datayi veya datlaari filtrelyerek veya filtrelemeyerek o data listesini gondermek, get request tir ondan dolayi biz data gonderecegiz ama php de url uzerindenki get methodu ile post methodunu post man daki post ve get ile karistirmayalim..... ve de post u seciyoruz post mandan sonra
http://localhost/test/php-mert-udemy/php-creating-api/api.php?mode=insert
Ve
form-data kisminda key-value ye name,surnam,email,password degerlerini gireriz ve send yapariz...

BINDPARAM KULLANMAK
bindParam kullanılmasının en büyük avantajı sqlinjection’a karşı ek bir güvenlik sağlamaktır.
bindParam kullanıldığında değişken parametreler sonradan sorguya çağırılır direk sorguya dahil edilip çalıştırılmaz, yani önce denetlenir.
Buda sorgu kırılmaları için önemli bir katman oluşturur.

Yukarıda verdiğim örnekte belirtmemişim fakat bindParam için en doğru kullanım şekli şu şekilde olacaktır,
Yukarıdaki örnekten gidersek YAS parametremiz INT olarak gelmesi gereken bir parametre.
Eğer şu şekilde bu parametreyi çağırısak;

$st->bindParam(‘:yas’, $Veri, PDO::PARAM_INT);
YAS verimiz için sadece Sayısal değerler kabul edilecektir yani herhangi bir string veya özel karakter kabul edilmeyecektir.

bindParam için kullanacağımız diğer değişken tipleri de şu şekildedir,
PDO::PARAM_INT
PDO::PARAM_STR
PDO::PARAM_BOOL
PDO::PARAM_NULL
PDO::PARAM_LOB

bindParam
Metot prepare metodu içindeki özel parametrelere (? veya :isimli_parametre) verileri güvenli biçimde yerleştirir.

Metodun ilk parametresi ön hazırlık sorguya göre değer alır, ikinci parametresi dışarıdan alınacak değerin değişkenini belirtir, üçüncü parametre ise verinin tipini belirtmek için kullanılır.

Metodun üçüncü parametresine girilen;

PDO::PARAM_INT – sayısal veri,

PDO::PARAM_STR – metinsel veri,

PDO::PARAM_LOB – binary veri,

PDO::PARAM_INPUT_OUTPUT – saklı yordam girdi/çıktı verisi,

PDO::PARAM_NULL – NULL veri tipi olduğunu belirtir.
 -->