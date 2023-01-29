<?php 
//session i olusturmak icin session_start komutu ile session i baslatmaliyiz
//Eger session.php de olusturdugmuz session degerlerini baska bir sayfada da kullanmak istersem o zaman
//kullanmak istedigmz sayfada eger , session.php sayfasini require etmiyor isek o zaman session.php de
//session icerisine kaydettimgz datalari diger sayfamizda almak iin o sayfa da da session_start yapmamiz gerekir
session_start();
$_SESSION["name"] = "Adem";
$_SESSION["surname"] = "Erbas";
$_SESSION["name"] = "Zehra";



echo $_SESSION["name"]. "<br>";//Adem

if(isset($_SESSION["name"])){
	echo $_SESSION["name"];
}else {
	echo "You don't have any session";
}

unset($_SESSION["surname"]);//session dizisi icinden surname data sini siliyoruz bu sekilde
//Burda suna dikkat edelim...Eger unset($_SESSION["surname"]); bu kodu bir kez calistirdktan sonra
//unset kodunu silsek bile artik bizim surname data miz SESSION array i icerisinden silinecektir bu datayi
//eger session da gormek istiyorsak tekrar eklememiz gerekir

//TUM SESSION DATALARINI KALDIRMAK ISTERSEK...
//session_destroy();

//SESSION ICERISINE DIZI EKLERSEK ASAGIDAKI GIBI SONUC ALIRZ
$_SESSION["my_arr"] = ["email","password","username"];
/*

{
my_arr: {
0: "email",
1: "password",
2: "username"
},
name: "Zehra"
},

*/
//print_r($_SESSION);
/*
SESSION ILE ILGILI COK ONEMLI BIR BILGI... 
sessions lara data lari atadiktan sonra, hatta atadgtimz datalari da guncelledikten sonra veya degisktirdikten sonra
eger session lara data set etme islemlerini kaldirsak bile veya yorum satirina alsak bile, session icindeki datlaarimz 
silinmeyecektir bunu iyi bilelim ki session in calisma mantigini anlamis olalim...
Yani burda onemli olan session icine data set etme methodlarinin bir kez calismasi onlar 1 kez calistiktan sonra artik 
session icerisine datalari kaydetmis olacaklar ve dolayisi ile istersek session icine data set ettigmiz islemleri kaldirabiliriz
boyle bir durumda session icinde datalarimzin var oldugunu kontrol edersek gorebiliriz

BIR SESSION IN VARLIGININ KONTROL ETME!
if(isset($_SESSION["name"])){

SESSION DATALARIMIZDAN BIR TANESINI SILMEK!-UNSET
Ornegin biz sadece surname session datamizi silmek  istersek nasil yapariz
Bunu da yapmak icin unset kullaniriz

PEKI TUM SESSION LARI SILMEK ISTERSEK NE YAPACAGIZ O ZAMAN DA
session_destroy dememiz gerekiyor... 

*/
//Ornegin form ile data gonderildi ve veritabanina data eklendi ve bizde data eklenince data eklendi 
//mesaji basmak istiyoruz ve bunu da session uzerinden yapmak isiyoruz ve bu session data sini da 
//ornegin config.php de gostermk istiyoruz
$_SESSION["show"] = "Data is added successfully";
?>

<a href="session2.php">Go to session2 page</a> <br><br>
<a href="config.php">Go to config page</a> <br><br>
<!--
	Sayfadan sayfaya navige olma hangi y ontemlerle oluyordu-BESTPRACTISE... 
	1-a link etiketi
	2-form uzerinden tiklaninca farkli birsayfay yonlenidirebiliyoruz ki burda kimi zaman aslinda hic input vs ile alakiamiz yoktur ama 
	sirf sayfay yonlendirmesi icinde kullanabiliriz
	3-php header methodu
	4-javascriptteki window.location.href - window.location.replace('...');

	Bu yontemlerin her birisi ile sayfa yonlendirmelerini yonetebiliriz....
 -->