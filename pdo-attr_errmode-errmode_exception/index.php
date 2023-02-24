<?php 
//Veritabanina gonderecegimz SQL sorgularda hata olusursa bu bir PDOException istisnasina sebep olur
//Baglanti olusturulduktan hemen sonra, PDO uc hata modundan herhangi birine aktarilabilir



//1- $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );  
//1.SILENT MOD VARSAYILAN MODDUR AMA ASAGIDAKI IKI MOD ,DRY PROGRAMLAMA ICIN DAHA UYGUNDUR
//2- $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); 
//BU MOD STANDART UYARIYI CAGIRIR..WARNING..VE KOMUT DOSYASINI DURDURMAZ YURUTULMEYE DEVAM ETMESINI SAGLAR..
//3- $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//COGU DURUMDA BU MOD  TERCIH EDILIR. HATALARI USTALIKLA ELE ALMAMIZA VE HASSAS BILGILERI GIZLEMEMIZE IZIN VEREN BIR ISTISNA FIRLATIR.


try {  

  // veritabanına bağlantı

 $db = new PDO('mysql:host=localhost;dbname=deneme;charset=utf8mb4',
 
'root', '');
//SQL hataları yakalamak için aşağıdaki kodları ekleyin

$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
   
  # SELECT! Yerine DELECT yazdık!
 
$db->prepare('DELECT ad FROM test')->execute();  
}  
catch(PDOException $e) { 
 
 echo "mesaj...: ".$e->getMessage(); //hata çıktısı 

}

?>

<?php
//BIR BAGLANTININ KAPATILISI
$db = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
// Veritabanına bağlanıyoruz.

// İşimiz bittiğine göre bağlantıyı kapatabiliriz.
$db = null;
?>


<?php
//KALICI BAGLANTILAR

$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass, array(
    PDO::ATTR_PERSISTENT => true
));
?>

<!-- Kalıcı bağlantı kullanmak için PDO kurucusuna aktarılan sürücü seçenekleri dizisinde PDO::ATTR_PERSISTENT sabitine TRUE atamalısınız. Nesneyi oluşturduktan Nesne başlatıldıktan sonra bu özellik PDO :: setAttribute() ile ayarlanırsa, sürücü kalıcı bir bağlantı kullanmayacaktır. 
Sorgu Yürütme Türleri
-->

<!-- Veritabanına Veri Ekleme() INSERT -->

<?php

try {
  $dsn = "mysql:host=localhost;dbname=test;charset=utf8mb4";
  $user = "root";
  $passwd = "";

  $db = new PDO($dsn, $user, $passwd);
  //SQL gibi hatalarıda almak için aşağıdaki kod yazılır.
  $db-> setAttribute (PDO :: ATTR_ERRMODE, PDO :: ERRMODE_WARNING);

  $ekle = $db->exec("INSERT INTO test ( adi, soyadi)
  VALUES ( '$ad', '$soyad')");

          
  } catch ( PDOException $e ){
     echo "Bir Hata Oluştu: ".$e->getMessage();
 }

?>