<?php 


try {
	$db = new PDO("mysql:host=localhost;dbname=testdb;", "root","");
	echo "Successfull connection";
} catch (PDOException $ex) {
	echo $ex->getMessage();
}

if($_GET){
//	$id = $_GET["id"];
	$title = $_GET["name"];
	$title =strip_tags($title);//Kullanicinin kullanacagiz <script>alert('Hello');</script> gibi bir tag durumunda
	echo strip_tags($title); //alert(Hello);


}else {
	//	$id = 40;
	$title = "";
}

//$id = intval($id); 
//intval   1sadfasdfasd 1 olarak gelir, sayi ile basliyorsa sadece baslayan kismi alir gerisini almaz
//Ama direk string text girilir ise o zaman 0 gelir yani bu sekilde kullanicinin girecegi stringe karsi sql sorgu stringimizi korumus oluyoruz




//$sql = "SELECT * FROM TUTORIALS WHERE tutorial_id = ?";
$sql = "SELECT * FROM TUTORIALS WHERE tutorial_title = ?";
$query = $db->prepare($sql);
$query->execute([$title]);



$tutorial = $query->fetch(PDO::FETCH_ASSOC);
var_dump($tutorial);

/*
1-INTVAL KULLANARAK INT E CEVIRILMEYEN STRING IFADELERI QUERY ICERISINDE KULLANMAYIZ
GET REQUEST KULLANICILARA ACIK BIR SEKILDE URL DE GOZUKUYOR VE BU SUISTIMAL EDILEBILIR BIR DURUMDUR.. 
ONCELIKLE GELECEK DEGERIN SADECE INT OLARAK GELEN DEGERLERI ALMAK ISTIYORUZ... O ZAMAN DA GELEN DEGERI INTVAL ILE INTEGER A CEVIR ONDAN SONRA GET SQL QUERY YE DAHIL ET DERSEK KULLANICININ GELIP DE BAMBASKA STRING LER GIREREK SQL SORGUMUZA MUDAHELE ETMESINI BIR ANLAMDA ONLEMIS OLURUZ.. 
EN TEHLIKELISI KULLANICININ TIRNAK LAR ICEERISINDE URL E BIR TAKIM SQL KODLARI YAZMASIDIR... ONDAN DOLAYI BIZ ID BEKLIYORSAK O ZAMAN GELEN DEGERI INTEGER A CEVIR DIYOURZ BURDA DA KULLANICI SADECE INTEGER A CEVIRILEBILIR STRING GIRDIIGINDE YANI ' 43' GIBI GIRDGINDE BUNU INTVAL ILE CEVIRIP SORGU ICERISINDE KULLANRIZ YOKSA KULLNMAYIZ...

2-//Baska bir problem de su ki kullanici gidip de GET_REQUEST E URL DE TEK TIRNAK GIREREK BIR DEGER GIRERSE ORNEGIN 
http://localhost/test/php-mert-udemy/php-security/secur_get_request.php?name=Adem' 
bu sekile tek tirnak ile bitirirse sonunu...  o zaman 
 "SELECT * FROM TUTORIALS WHERE tutorial_name = 'Adem'' ";
 aynen bu sekilde oldugu gibi... bir tirnak gelmis olacak ve bu bizim sql sorgumuzu bozacak ve direk uygulamamizi kiracaktir ve uygulamayi durduracaktir...ISTE BU BUYUK PROBLEM...BUNA KARSI YANI KULLANICIDAN GELEBILECEK HERHANGI BIR TEK TIRNAK VEYA TIRNAKLARA KARSI ONLEM ALMALIYIZ..
 Mesela kullanici gidip de get sorgusu icine <script>alert('Hello');</script> diye birsey yazarsa bu kodu html taglarindan arindirmak temizlemek icin 
 strip_tags() methodunu kullaniriz
*/

?>