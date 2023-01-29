<?php 
//print_r($_GET);//url e bakilir ve url de ? den sonra gelen kisim
//?id=1&name="Adem" bu sekilde gonderilince normal ana url den sonra gelen kisim bu sekilde gonderildigi zaman bu 
//Get methodu ile data gonder me denir ve bu datalar
/*
{
id: "1",
name: ""Adem""
},
*/

//$_SERVER
//print_r($_SERVER);//sERVER ILE ILGILI TUM DETAYLI BILGILILERI BURDAN ALABILIYORUZ

//$_REQUEST
print_r($_REQUEST);
//Biz request araciligi ile de bir formadan gonderilen tum datalarimizi alabiliyoruz ayni $_POST ILE VE $_GET ILE
//ALDGIMZ GIBI YANI $_POST ILE YAPILAN ISLEMI BIZ ASLINDA $_REQUEST ILE DE YAPABILIRIZ

/*
print_r($_POST) ile asagidaki gibi alinir
input lar icindeki name ler key olarak value ler de value olarak gelecektir $_POST dizisi icerisine
{
name: "Adem",
surname: "Erbas",
submit: "action"
},

$_FILES ILE DE BIZ FORM UMUZ ARACILIGI ILE FILE TYPE INDAKI DOSYA VERILERINI ALMAMIZI SAGLIYOR

$_SESSION-LOGIN ISLEMLERINDE KAYIT OLAN KULLANICININ BILGILERINI DEPOLARKEN TUTARKEN KULLANIRIZ....
VEYA ALISVERIS-ETICARET SITESINDE SEPET OLUSTURURKEN DE BUNU DA SESSION ILE TUTABILRIIZ...

$_ENV=>PHP YORUMLACISININ CALISTIGI GLOBAL ISIM ALANIDIR
$_GLOBAL DE SCRIPT ICIN TANIMLANAN DEGISKENLERI GOSTERIR

$_COOKIE 
Girdiğimiz sitelerin tarayıcıya bıraktığı izlere cookie yani çerez denir. Kullanımı oldukça yaygındır. En basitinden bir alışveriş sitesine girdiğiniz zaman sepete bir ürün eklersiniz. Alışverişi bitirmeden o siteden çıksanız bile bir kaç gün sonra siteye girdiğinizde hala sepetinizde ürün olduğunu görürsünüz. Bu tür olayları gerçekleştirmek için Cookie yapısını kullanırız. Cookie'lerin bir ömrü vardır. Bitince otomatik olarak kendilerini imha ederler.
Bunla alakalı bir başka basit bir örnek ise formlara girilen kullanıcı bilgilerini kaydederek bir dahaki girişlerde otomatik doldurulmuş olarak karşımıza getirebiliriz.


*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="" method="GET" >
		<label for="name">Name:</label>
		<input type="text" id="name" name="name"> <br><br>
		<label for="surname">Surname:</label>
		<input type="text" id="surname" name="surname"> <br><br>
		<input type="hidden" name="submit" value="action" >
		<button type="submit">Submit</button>
	</form>
</body>
</html>