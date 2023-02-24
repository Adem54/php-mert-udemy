<?php 
/*
SQL komutu içinde parametrelere (? veya :isimli_parametre) execute, bindParam veya bindValue metodu ile veriler güvenli bir biçimde yerleştirilebilir.

bindParam
Metot prepare metodu içindeki özel parametrelere (? veya :isimli_parametre) verileri güvenli biçimde yerleştirir.

Metodun ilk parametresi ön hazırlık sorguya göre değer alır, ikinci parametresi dışarıdan alınacak değerin değişkenini belirtir, üçüncü parametre ise verinin tipini belirtmek için kullanılır.

Metodun üçüncü parametresine girilen;

PDO::PARAM_INT – sayısal veri,

PDO::PARAM_STR – metinsel veri,

PDO::PARAM_LOB – binary veri,

PDO::PARAM_INPUT_OUTPUT – saklı yordam girdi/çıktı verisi,

PDO::PARAM_NULL – NULL veri tipi olduğunu belirtir.

*/

try {

	$baglanti = new PDO("mysql:host=localhost;dbname=kisi", "root", "");
	$baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sorgu = $baglanti->prepare("INSERT INTO kisiler(kisi_adi, kisi_soyadi, kisi_eposta) VALUES(?, ?, ?)");
	$sorgu->bindParam(1, $adi, PDO::PARAM_STR);
	$sorgu->bindParam(2, $soyadi, PDO::PARAM_STR);
	$sorgu->bindParam(3, $eposta, PDO::PARAM_STR);

	$adi = "Yusuf Sefa";
	$soyadi = "SEZER";
	$eposta = "yusufsezer@mail.com";
	$sorgu->execute();

	echo "<p>Eklenen kayıt sayısı: " . $sorgu->rowCount() . "</p>";

	echo "<p>Eklenen kayıt ID: " . $baglanti->lastInsertId() . "</p>";

} catch (PDOException $e) {
	die($e->getMessage());
}

$baglanti = null;

?>


<!-- bindValue
Metot bindParam ile aynı işleve sahiptir. Ancak bindParam metodunda çok kullanılmayan dördüncü ve beşinci parametreler yoktur.

Metot bindParam metodunda olmayan doğrudan değer atama yapmaya imkan verir. -->

<?php

//? ? ? placholder kullanildigi durumlarda bindValue asagidaki gibi kullanilir

try {

    $baglanti = new PDO("mysql:host=localhost;dbname=kisi", "root", "");
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sorgu = $baglanti->prepare("INSERT INTO kisiler(kisi_adi, kisi_soyadi, kisi_eposta) VALUES(?, ?, ?)");
    $sorgu->bindValue(1, 'Yusuf Sefa', PDO::PARAM_STR);
    $sorgu->bindValue(2, 'SEZER', PDO::PARAM_STR);
    $sorgu->bindValue(3, 'yusufsezer@mail.com', PDO::PARAM_STR);

    $sorgu->execute();

    echo "<p>Eklenen kayıt sayısı: " . $sorgu->rowCount() . "</p>";

    echo "<p>Eklenen kayıt ID: " . $baglanti->lastInsertId() . "</p>";

} catch (PDOException $e) {
    die($e->getMessage());
}

$baglanti = null;

?>
Benzer şekilde özel karakter (?) yerine isimli parametrede (:isimli_parametre) kullanılabilir.

<?php

$sorgu = $baglanti->prepare("INSERT INTO kisiler(kisi_adi, kisi_soyadi, kisi_eposta) VALUES(:benim_adim, :benim_soyadim, :benim_epostam)");

$sorgu->bindValue(':benim_adim', 'Yusuf Sefa', PDO::PARAM_STR);
$sorgu->bindValue(':benim_soyadim', 'SEZER', PDO::PARAM_STR);
$sorgu->bindValue(':benim_epostam', 'yusufsezer@mail.com', PDO::PARAM_STR);

?>
<!-- //BindParam sorgu içinde tanımladığımızı değişkenleri referans olarak o kısmı dinamik hale getirmektedir. Yani üst tarafta sorguyu yazdıktan sonra alt kısımda değişkeni değiştirmek ve sorguyu execute etmek, değişkeni referans aldığı için en son halini referans alacaktır. -->

<?php

$stmt = $dbh->prepare("INSERT INTO tablo_adi (isim, yas) VALUES (?, ?)");
$stmt->bindParam(1, $isim);
$stmt->bindParam(2, $yas);

#EXECUTE ÇALIŞTIĞI ANDA AHMET 19 EKLENECEKTİR 
$isim = 'Ahmet';
$yas = 19;
$stmt->execute();

#BU ŞEKİLDE İKİNCİ KAYITTA DA MEHMET 20 ŞEKLİNDE KAYIT EKLENECEKTİR.
$isim = 'Mehmet';
$yas = 20;
$stmt->execute();

?>


<?php
//Örnek Where Koşulu Dinamik
#VALUE ÖNCE 1 OLARAK AYARLANDI FAKAT SONRA 2 OLARAK DEĞİŞTİRİLDİ. REFERANS ALDIĞI İÇİN 2 OLARAK WHERE SORGUSU YAPACAKTIR
$value = '1';
$s = $dbh->prepare('SELECT isim FROM tablo_adi WHERE alan = :alan');
$s->bindValue(':alan', $value); 
$value = '2';
$s->execute();
//Dekişken referans alınır fakar execute den hemen önce yapılan değişiklikler refernas alınacaktır.

?> 



<?php 

$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$username = "Adem54";
$password = "1234";
$stmt->execute();

//Bu kod bloğunda, bir SQL sorgusu oluşturulur ve $pdo->prepare() ile bir ifade hazırlanır. Daha sonra, bindParam() ile sorgu içerisindeki :username ve :password değişkenleri, dışardan gelen $username ve $password değişkenlerine bağlanır. Sorgu çalıştırıldığında bu değişkenler sorgu içerisinde kullanılacaktır. Bu örnekte, sorgu sonucunda kullanıcı adı ve şifre değerlerine eşleşen kullanıcı kayıtları döndürülecektir.
?>

<?php

# Yer tutucu olmadan - SQL enjeksiyon kapısı açık!

$oku = $db->prepare("INSERT INTO okul (ad, ders, not) 
values ($ad, $ders, $not)");
 
# adsız yer tutucuları

$oku = $db->prepare("INSERT INTO okul (ad, ders, not) 
values (?, ?, ?)");
 
# Her bir yer tutucuya değişkenler atayın, index 1-3
//Dikkat edelim bindParam da degeri direk atamihyoruz deger  degiskene atanip degisken kullaniliyro

$oku->bindParam(1, $ad);
$oku->bindParam(2, $ders);
$oku->bindParam(3, $not);
 
# Bir satır ekle

$ad = "Ali";
$ders = "matematik";
$not = 80;
$oku->execute();
 
#  farklı değerler içeren başka bir satır ekle

$ad = "Mehmet";
$ders = "Fizik";
$not = 100;
$oku->execute();
?>

<?php 


#  adlandırılmış yer tutucuları

$oku = $db->prepare("INSERT INTO okul (ad, ders, not) 
value (:ad, :ders, :not)");

# İlk argüman adlandırılmış yer tutucu ismidir.
# Yer tutucular her zaman bir kolon ile başlar.

$oku->bindParam(':ad', $ad);
$oku->bindParam(':ders', $ders);
$oku->bindParam(':not', $not);

$ad = "Ali";
$ders = "matematik";
$not = 80;
$oku->execute();

?>


<?php 
# eklediğimiz veriler
$data = ['ad'=>'Ali','email'=>'aaaa@mail.com','sehir'=>'Ankara'];  

$oku = $db->prepare("INSERT INTO test (ad,email,sehir) 
values (:ad, :email, :sehir)"); 

$oku->execute($data);



?>

<?php
//Birer isimle (:isim) ifade edilen değiştirgeli prepare örnek

$oku = $db->prepare("INSERT INTO test (ad, soyad, email) 
VALUES (:ad, :soyad, :email)");

$oku->bindParam(':ad', $ad);

$oku->bindParam(':soyad', $soyad);

$oku->bindParam(':email', $email);

$ad = "Ali";
$soyad = "Kara";
$email = "alikara@gmail.com";
$oku->execute();

?>


<?php

//soru imi (?) ile ifade edilen değiştirgeli prepare örnek

$oku = $db->prepare("INSERT INTO test (ad, soyad, email) VALUES (?, ?, ?)");

$oku->bindParam(1, $ad);

$oku->bindParam(2, $soyad);

$oku->bindParam(3, $email);

$ad = "Ali";
$soyad = "Kara";
$email = "alikara@gmail.com";

$oku->execute();

?>

<?php 

$oku = $db->prepare("INSERT INTO test (ad, soyad, email) VALUES (?, ?, ?)");

$oku->execute([$ad,$soyad,$email]);
?>

<?php
//UPDATE
$data = [
    'id' => $id,
    'ad' => $ad,
    'soyad' => $soyad,
    ];
$sql = "UPDATE test SET ad=:ad, soyad=:soyad WHERE id=:id";

$db->prepare($sql)->execute($data);
?>