<?php 

require_once("connection.php");
require_once("vote1.php");
//voting-app/?id=2 bu sekilde url den gelindigi zaman id yi alacagiz
//Burda gelen id topic id sidir ondan dolayi, gelen id oncelikle mutlaka veritabaninda bu data var mi diye checke edilmeli ve o data eger veritabaninda var ise ona gore islem yapilmali yok ise de ona gore mesaj vs ile kullanici dogru bilgilendirilmeli ve yonlendirilmelidir
if($_GET["id"]){
	$id = intval($_GET["id"]);
	
	try {
		$sql = "SELECT * FROM TOPICS WHERE id=:id";
	$query = $db->prepare($sql);
	$query->bindParam(":id",$id,PDO::PARAM_INT);
	$query->execute();
	$topic = $query->fetch(PDO::FETCH_ASSOC);
		//Vote - oylama yapilmis ise buraya girecek
		if(isset($_GET["vote"])){
			$voteNum = intval($_GET["vote"]);//intval ile almak cok onemlidir id leri
			//peki ne yapacagiz biz bunu veritabanina ekleyecegiz yani kullanicinin verdigi oyu veritabanina ekleyecegiz ki daha sonra hangi oylama seceneklerinin ne kadar secilmis olduguu bilelim

			//ONCE BU KULLANICI OYLAMA YAPMIS MI ONA BAKACAGIZ..VERITABANINDAN ONU KONTROL EDECEGIZ
			$vote->checkUserVoted($id,$voteNum);
			var_dump($vote->checkUserVoted($id,$voteNum));
			$vote->process($id,$voteNum);	
				//BIR KEZ OY KULLANILINCA DA YONLENDIRELIM 
				Header("Location:index.php?id=".$id);
			
			
		}

	// if(count($topic)>0)
		if($query->rowCount() > 0){

			echo $topic["name"] . "<br>" . $topic["text"];
			echo "<br>";
			echo "<br>";
			foreach ($vote_list as $key => $value) {
				//ANA SAYFADA DA OY SECENEKLERININ OY SAYILARINI GORMEK ISTIYORUZ
				$numberOfVote = $vote->showVotesNumber($topic["id"],$key);//$key burda vote_id yi verir bize
				echo "<h3>(".$numberOfVote.")</h3>";
				echo "<a style='padding:4px; color:#fff; margin-left:7px; background-color:black; display:inline-block; text-decoration:none;' href='index.php?id=".$id ."&vote=".$key."'>". $value ."</a>";
			}
	}else{
		echo "This id is not registered your database";
	}
	} catch (PDOException $e) {
	  echo $e->getMessage();
	}
	
}

//Simdi once islemin mantigini anlayalim... Burda olacak olan nedir... burda olacak olan sudur kullanici oncelikle topiclerden sectigi herhangi bir tanesini yani veritabaninda var olan bir topic sececek ve onlardan sectigi herhangi bir tanesini oylayacak...yani bizim verdgimiz kriterler uzerinden oylayacak .. Daha once de soyledigmz gibi bu oylama seceneklerini biz bir dizi de tutariz, cunku bunlar belirli stringlerdir... ve biz bumlari dizi icinde tutup ordan getirerek kullaniriz bu tarz veriler genellikle bu sekilde yapilir 
//Sonra da burda oylanan tiklanan a href i icerisine id yi vermem gerekiyor 

//Ilk olarak bu sayfaya gelirken hemen asagidaki url ile gelir id de hangi id li topic secilirse o topic oyalanacak
//http://localhost/test/php-mert-udemy/php-practise-applications/voting-app/?id=2
//Secilen topic ile ilgili oylama da kullanici foreach ile dondurdgumuz oylama kriterllerinden hangisine tiklarsa o tiklananin index ini url de gosteririz ve yine ayni sayfaya gelmesi icinde tabi ki ilk once topic id yi veririz....secilen kriter ile ilgili de index ini veririz...cunku array icerisinden aliyoruz...
http://localhost/test/php-mert-udemy/php-practise-applications/voting-app/?id=2&vote=3
//Yani hangi oylama secenegine tiklandgini yine ayni sayfa da Get methodu ile gonderiyourz...Yani o zaman biz ayni sayfa icinde hangi oylama secenegine tiklandigini GET ile vote var mi onu kontrol ederiz eger vote var ise demekki bu sayfad a kullanici oy kullanmis diyebiliriz.. 
//Burda olayin espirisini hemen anlayip jeton dusmesi gerek...javascript teki dinamik addEventlistener mantiginin aynisi bu..Yani foreach icinde veriyi dondur sonra o veriyi a html-link etiketi icine al ....dolayisi ile her bir a etiketi icine o zaman biz dizi icindeki oylama versini yazdirabiliriz... o zaman da a nin href in e her bir oylama secnegne ait uniq bir deger vermek istersek o degtlerin index lerini veririrz ki hangisine tiklandigini bilebilmemiz icin

?>