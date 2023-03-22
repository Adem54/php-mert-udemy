<?php 
declare(strict_types=1);
/*
CREATE TABLE topics (
id int(11) not null primary key Auto_increment,
name varchar(65),
text text
) ENGINE INNODB DEFAULT CHARACTER SET=utf8mb4 collate utf8mb4_unicode_ci ;
show tables;
*/

//VERITABANIN KODUMUZU CLASS LARIMIZ ICERISINDE KULLANMAK ISTIYORSAK O CLASS I CONNECTION CLASS INI EXTEND ETTIRMEMIZ GEREKIR...

class vote extends DB {
//BESTPRACTISE... EGER DB YI EXTENDS-INHERIT EDECEKSEK VOTE CLASS I ILE O ZAMAN DB CLASS ININ CONSTRUCTOR I PARAMETRE ALIYOR MU ONA BAKARIZ VE EGER PARAMETRE ALIYOR ISE MUTLAKA BU PARAMETRELERI VEREREK BASE-CLASS I IN CONSTRUCTOR I INVOKE EDILMELIDIR, VOTE-SUBCLASS NEW LENDIGI ZAMAN BU COOOOK ONEMLI VE YAPILMASI ZORUNLUDUR... 
	public function __construct()
	{
		parent::__construct("localhost","testdb","root","");
	}
	public array $vote_list = ["enjoy","well","not enjoy","bad","not bad","terrible"];

	//BURDA HANGI IP ADRESINDEN VOTE YAPILMIS BUNU ALABILIRIZ.... KI O IP KULLANCISININ VOTE YAPIP YPAMADGINI KONTROL EDELIM
	public function checkUserVoted(int $topic_id, int $vote_id){
		$ip = $_SERVER["REMOTE_ADDR"];//BU BIZE OYLAMAYAI YAPAN KULLANICI IP ADRESINI VERIR
		$sql = "SELECT * FROM VOTES WHERE ip=:ip AND topic_id=:topic_id";
		$query = $this->prepare($sql);
		$query->bindParam(":ip",$ip,PDO::PARAM_STR);
		$query->bindParam(":topic_id",$topic_id,PDO::PARAM_INT);
		$query->execute();
		$checkIP = $query->fetch(PDO::FETCH_ASSOC);
		return $query->rowCount();
		//Bu ip ye sahip kullanici daha onceden oylama yapmis mi ona bakmaliyz 
	}

	//Ana sayfada bir control u de icerisinde yapaagimz bir process fonksiyonu calistiracagiz o herseyi  yapacak bizim icin
	public function process(int $topic_id, int $vote_id){
		$check = $this->checkUserVoted($topic_id,$vote_id);
		echo "<br> check: <br>";
		var_dump($check);
		$ip = intval($_SERVER["REMOTE_ADDR"]);//Burasi onemli...int olarak almamiz gerekiyor.. 
		if($check == 0){
			//Veri yoktur o zaman veriyi ekle
			$sql = "INSERT INTO VOTES (ip,topic_id,vote_id) VALUES(?,?,?)";
			$query = $this->prepare($sql);
		
			$query->execute(array($ip,$topic_id,$vote_id));
			if($query->rowCount() > 0){

			}

		}else{
			//Veri vardir o zaman , vote_id ayni mi diye onu kontrol edecegiz, cunku once begendim sonra da begenmedime tiklamis olabilirim
			//Yani kullanici oy kullanmis demekki, cunku kullaniciya ait ip ve ok topic id ye ait vote_id var database tablomuzda o zaman oy kullanmis
			$ip = $_SERVER["REMOTE_ADDR"];
			$sql = "SELECT * FROM VOTES WHERE ip=:ip AND topic_id=:topic_id";
			$query = $this->prepare($sql);
			$query->bindParam(":ip",$ip,PDO::PARAM_STR);
			$query->bindParam(":topic_id",$topic_id,PDO::PARAM_INT);
			$query->execute();
			$checkUserVoteId  = $query->fetch(PDO::FETCH_ASSOC);
		//	var_dump($checkUserVoteId);//Kullanici nin kullandigi oyun oldugu datayi dizi olarak aliriz burda
			//Bunu neden yaptik bunu sunun icin yaptik kulllanici daha once oy kullanmis ama yine oy kullanmak icin vote seceneklerinden birine tikladigdinda...once daha once oyladigi datayi aliyoruz ve simdi tikladigi vote_id yi de alip bir logic yapacagiz burda
			//Ve eger kullanici tekrar oy kullaniyor ve baska bir secenegi seciyor ise o sectigi secenekle veritabanindaki vote_id yi degistirerek kullanicinin oyunu guncellemis olyoruz
			if($checkUserVoteId["vote_id"] !== $vote_id){//$vote_id kullanici her tikladiginda, tikladigi secenegin id sini verir bize
					//Eger tekar tikladigi vote id, daha once kullandigi ve votes tablosunda kayitli olan vote_id ye esit degil ise o zaman update yap diyecegiz
					$sql="UPDATE VOTES SET  vote_id=:vote_id where id=:id";
					$update=$this->prepare($sql);
					$update->execute([
						":vote_id"=>$vote_id,
						":id"=>$checkUserVoteId["id"]
					]);
					if($update->rowCount() > 0){
						echo "You updated your data";
					}
			}
			//Simdi biz soyle bir mantik da olsun istiyoruz kullanici ayni oya ust uste basarsa o oyu kaldirsin istiyoruz..yani toggle gibi bir tikayinca kaldirsin eger daha once tabloya kaydedilmis ise veirtabanina kaydedilmemis veritabanindan yok ise de zaten veritabanina kaydedecektir
			else{
				$sql = "DELETE FROM VOTES WHERE id=?";
				$query = $this->prepare($sql);
				$query->execute(array($checkUserVoteId["id"]));
				if($query->rowCount()>0){
					echo "You deleted your vote";
				}
			}
			
		}
	}
//Hani oylama seceneginn kacar kez kullanildigini gormek icin de bu fonkisyonu olsuturuyoruz
	public function showVotesNumber($topic_id,$vote_id){
		$sql = "SELECT * FROM VOTES WHERE topic_id=:topic_id AND vote_id=:vote_id";
		$query = $this->prepare($sql);
		$query->bindParam(":topic_id",$topic_id,PDO::PARAM_INT);
		$query->bindParam(":vote_id",$vote_id,PDO::PARAM_INT);
		$query->execute();
		$votes = $query->fetchAll(PDO::FETCH_ASSOC);
		return $query->rowCount();
	}
}


/*
BESTPRACTISE...KULLANIM SEKLI.... 
Simdi soyle bir akil yurutelim eger onumuze bir data geliyorsa yani kullanicinin onune biz secenekleri nasil sunacagiz...Yani eger kullaniciya  belirli datalar geliyorsa yani ornegin belli kategeriler gibi vaya belli options lar select option icerisinde veya 
checkboxlar ile birlikte belli secenekler bunlar genellikle veritabanindan gelmez bunlar cok yuksek bir ihtimalle.. ayri bir dizi icerisinde tutulur bir class olusturulup o class icinde dizi olusturulup icerisine belli olan degerler verilir ve o degerler direk o class tan cekilerek kullanilir...

*/



$vote = new vote();
$vote_list = $vote->vote_list;

?>