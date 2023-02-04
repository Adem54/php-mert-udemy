<?php 
require_once("config.php");

//1-SELECT DATA-WITHOUT PREPARE
// $sql = "SELECT * FROM tutorials";
// $tutorials = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// print_r($tutorials);
//fetch ile tek bir data getirmek icin kullaniriz
//fetchAll ile birden fazla data getirmek icin kullaniriz. 
//fetchAll(PDO::FETCH_ASSOC); ILE BIZ, DATALARI SQL TABLODAN(VERITABANI) KEY-VALUE SEKLINDE GELMESI ICIN YAPARIZ
//VERITABANI TABLOSUNDA DATAMIZ BIRKAC FARKLI SEKILDE GELEBILIR CUNKU NUMARAYA GORE DE TUTULUYOR ONDAN DOLAYI BIZIM DATAYI NASIL ISTEDGIMZI BELIRTMEMIZ GEREKIR

//SELECT DATA WITH PREPARE
$sql = "SELECT * FROM tutorials";
$query = $db->prepare($sql);
$query->execute();
$tutorials = $query->fetchAll(PDO::FETCH_ASSOC); 
// print_r($tutorials);

//query direk sonucu veriyor...ama prepare ile yaparken execute methodu bir kez hicbir return yapmadan invoke edilir ondan sonra execute u invoke ettimiz degisken $stmt veya $query olarak kullanabiliyoruz bunlardan hangisi ise onun ile datayi artik alabiliyoruz....

//3-INSERT WITH PREPARE PLACEHOLDER
/*
INSERT query with named placeholders
$sql="INSERT INTO TUTORIALS (tutorial_title,tutorial_content,tutorial_active) VALUES(:tutorial_title, :tutorial_content,:tutorial_active)";
	$query = $db->prepare($sql);
	$newData = [
		":tutorial_title"=>"Visual basic",
		":tutorial_content"=>"Primitive types",
		":tutorial_active"=>1,
	];
	$newData = [
		"tutorial_title"=>"Visual basic",
		"tutorial_content"=>"Primitive types",
		"tutorial_active"=>1,
	];

	Biz data olarak yukardaki her iki tanimlama biciminde de alabilyoruz datalari eger ki, placeholder ile yani karsilarinda alias li data lar ile tanimlanmis ise yani her bir kolon karsisinda  :tutorial_title gibi alias placeholder lar tanimlanmis ise...  

	echo "New data added";
	$query->execute($newData);


	BU DA DIREK ? ILE PREPARE YONTEMI... INSERT query with positional placeholders
	$sql="INSERT INTO TUTORIALS (tutorial_title,tutorial_content,tutorial_active) VALUES(?, ?,?)";
	$query = $db->prepare($sql);
	$newData = [
	"Go",
	"String functions",
	 1
	];
	echo "New data added";
	$query->execute($newData);

	POSITIONAL PLACEHOLDERS ILE INSERT ISLEMI ILE NAMEDPLACEHOLDERS ILE DATA EKLEME ISLEMINDE DIKKAT EDERSEK EXECUTE ICERISINE DATA GONDERIRKEN POSITIONAL PLACEHOLDERS DA(? ILE OLAN) SPESIFIK KEY KULLANMADAN DATAYI GONDERIRKEN, NAMEDPLACEHOLDERS DA ISE SPESIFIC KEY LERI ILE BIRLIKTE KULLANIYORUZ... 


	INSERT ISLEMINI SET KEYWORDU KULLANARAK  YAPMA YONTEMI DIR BUDA 

	$sql="INSERT INTO TUTORIALS SET tutorial_title = :tutorial_title, tutorial_content = :tutorial_content, tutorial_active = :tutorial_active";
	$query = $db->prepare($sql);
	$newData = [
		":tutorial_title"=>"Visual basic2",
		":tutorial_content"=>"Primitive types2",
		":tutorial_active"=>1,
	];
	echo "New data added";
	$query->execute($newData);
*/

//UPDATE
// try {
// 	$sql = "UPDATE TUTORIALS SET tutorial_title = :tutorial_title, tutorial_content = :tutorial_content, tutorial_active = :tutorial_active WHERE tutorial_id = :tutorial_id";
// $query = $db->prepare($sql);
// $newData = [
// 	":tutorial_title"=>"Visual basic-changed",
// 	":tutorial_content"=>"Primitive changed",
// 	":tutorial_active"=>1,
// 	":tutorial_id"=>18
// ];
// $query->execute($newData);

// var_dump($query->rowCount());//BU SEKIILDE BIZ DATA MIZIN UPDATE OLUP OLMADIGINI CHECK EDEBILIYORUZ
// } catch (PDOException $e) {
// 	echo $e->getMessage();
// }

// INSERT ISLEMINDE DATAMIZIN EKLENIP EKLENMEDIGINI NASIL ANLARIZ..... QUERY->ROWCOUNT() BIZE INTEGER OLARAK YAPILAN SQL QUERY SORUGUSNDAN VERITABANINDA ETKILENEN ROW-SATIR SAYSININ VERIR...
// try {
// 	$sql="INSERT INTO TUTORIALS (tutorial_title,tutorial_content,tutorial_active) VALUES(:tutorial_title, :tutorial_content,:tutorial_active)";
// 	$query = $db->prepare($sql);
// 	$newData = [
// 		":tutorial_title"=>"CPlus",
// 		":tutorial_content"=>"Value types",
// 		":tutorial_active"=>1,
// 	];

// 	$query->execute($newData);
// 	//BU SEKILDE DE DATA MIZ EKLENMIS MI EKLENMEMIS MI BUNU ANLAYABILIRIZ....
// 	if($query->rowCount() > 0){
// 		echo "new data added and ".$query->rowCount()." row affected"; 
// 		//new data added and 1 row affected
// 	}
// } catch (PDOException $e) {
// 		echo $e->getMessage();
// }


//DELETE ISLEMINI  YAPALIM SIMDIDE
//VE DE DELETE ISLEMININ BASARILI OLUP OLMADIGNIN KONTROL EDELIM AYNI ZAMANDA
/*
try {
	$sql = "DELETE FROM TUTORIALS WHERE tutorial_id = ?";
$query = $db->prepare($sql);
$query->execute([18]);
if($query->rowCount() > 0)echo "<br>data deleted and ".$query->rowCount(). " row affected";
//data deleted and 1 row affected
} catch (PDOException $th) {
	echo $e->getMessage();
}
*/

//FETCH SINGLE DATA AND PROCESS DATA BEFORE USE....WITH WHILE LOOP...
//Single row data cekerken biz direk kendimiz sorgumuz icinde limit 1 dersek zaten gelen data yi 1 yapmis oluruz
/*
try {
	$sql = "SELECT * FROM TUTORIALS ORDER BY tutorial_id DESC LIMIT 1";
$query = $db->prepare($sql);
$query->execute();
$res = $query->fetch(PDO::FETCH_ASSOC);//FETCH_ASSOC KULLANMAZSAK SQL TABLOSU ICERISINDE TUTULAN TUM FARKLI VARYASYONLAR SEKLIDNE DATA GELECEK VE BU BIZIM ZAMANIMIZI ALIR BUNUNLA UGRASMAK YERINE ADAMLAR BIZIM IHTIYACIMIZA GORE DATALARI PARAMETREYE YAZACAGIMZ CONSTANT DEGERLER  UZERINDEN BIZE SUNUYORLAR ONDAN DOLAYI DA BIZ EGER KEY-VALUE SEKLINDE ALMAK ISTERSEK DATAYI O ZAMAN PDO::FETCH_ASSOC DERIZ.

print_r($res);
} catch (PDOException $e) {
	echo $e->getMessage();
}
*/


// $sql = "SELECT * FROM tutorials ";
// $query = $db->prepare($sql);
// $query->execute();

// while($row = $query->fetch()){//Burda her fetch tetiklendiginde en son hangi data da kaldi ise o data dan itibaren bir sonraki next() data yi tetikler ancak eger next data var ise tetikler ve bunu bizim her hangi bir kontrol yapmamiza gerek kalmadan kendisi yapiyor...Ondan dolayi da biz
// 	echo $row["tutorial_title"]."<br>";
// }

//TABLODAKI VERILERIN TOPLAM SAYISINI ALALIM SIMDIDE-COUNT OF DATA NUMBER ON OUR TUTORIALS TABLE
$sql = "SELECT COUNT(*) AS count_data FROM TUTORIALS";
$query = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$count_data = $query[0]["count_data"];
echo $count_data;//9 


//




?>