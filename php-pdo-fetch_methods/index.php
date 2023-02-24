<?php 

//Veri Alma Yöntemleri

/*

PDO :: FETCH_ASSOC: Anahtar olarak sütun adlarıyla bir dizi döndürür
PDO :: FETCH_BOTH (varsayılan): Hem sütun adları hem de sıra numaraları biçiminde indisleri olan bir dizi döndürür
PDO::FETCH_BOUND: Sütun değerlerini PDOStatement::bindColumn() ile ilişkilendirilmiş PHP değişkenlerine atar ve TRUE döndürür.
PDO :: FETCH_CLASS: Sütun sınıflarını belirtilen sınıfın uygun özelliklerine atar. Bazı sütun için özellik yoksa, oluşturulacak
PDO :: FETCH_INTO: Belirtilen sınıfın mevcut bir örneğini günceller.
PDO::FETCH_LAZY: PDO::FETCH_BOTH ve PDO::FETCH_OBJ sabitlerinin birleşimidir.
PDO::FETCH_NUM: Sütun numaralarına göre indislenmiş bir dizi döner. İlk sütunun indisi 0'dır.
PDO::FETCH_OBJ: Özellik isimlerinin sınıf isimlerine denk düştüğü bir anonim nesne örneği döndürür.

 $oku->fetch(PDO::FETCH_ASSOC); 

 pratikte FETCH_ASSOC,FETCH_CLASS,FETCH_OBJ BIZIM IHTIYACLARIMIZI KARSILAYACAKTIR


 FETCH_CLASS
 Bu getirme methodu datayi dogrudan bizim sectimgz bir class a getirmemizi saglayacaktir
 FETCH_CLASS kullanirken nesnenizin ozellikleri kurucuyu cagirmadan once ayarlanir. BU cok onemlidir
 Ilgili sutunun adlari yok ise sizin icin boyle bir ozellik olusturulur
 Bu veritabaninndan cikarildiktan sonra verilerin donusturulmesi gerektiginde, nesne olusturulduktan hemen sonra otomatik olarak gerceklestirilebilecegi anlamina gelir
*/
?>
<?php
	class User
	{
	public $ad;
	public $soyad;
	public $email;

	public function showInfo()
	{
		echo "<br>".$this->ad."<br>".$this->soyad."<br>".$this->email."<br>";
	}

	}
	$oku = $db->query("SELECT * FROM test");  

	$result = $oku->FETCHALL(PDO::FETCH_CLASS, "User");

	foreach($result as $user)
	{
		$user->showInfo();
	}

	//Oluşturulan sınıftaki özelliklerin adları, veritabanındaki alanların adları ile aynı olmalıdır.
?>