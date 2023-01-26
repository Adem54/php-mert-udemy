<?php 

define("name","Adem");

echo name;//Ekrana sabit degerimizi basarken basina herhangi bir $ isareti koymuyoruz

//Sabit degiskenin varliginin kontrolu
//PHP DE ENCOK DIKKAT ETMEMIZ GEREKEN NOKTALARDAN BIRISI...DEGISKEN ISIMLERI NI TIRNAK ICINDE YAZABILIYORUZ BIRCOK KERE
//YANI TIRNAK ICINDE YAZDIGMZ ZAMAN TANIYOR O DEGISKENI
//BU DIGER DILLERE GORE COK FARKLI BIR KULLANIM NORMALDE TIRNAK ICINDE STRING DEGERLER KULLANILIR DIGER DILLERDE

//SABIT DEGISKEN VARLIGININ KONTROLU... 
if(defined("name")){
	echo "You have ".name. " const value";
}

const URL = "http://localhost/test/php-mert-udemy/const-define/";

echo URL;

echo "<br>";

$num1 = 12;
$num2 ="12";

if($num1 == $num2){
	echo "$num1 is equal $num2";
}else{
	echo "$num1 is not equal $num2";
}
//== kullanirsak equal olarak donecektir c unku sadece deger kontolu yapar, tip kontrolu yapmaz.../ === kullanirsak  ise not equal diye donecektir cunku hem tip, hem deger kontrolu yapar 

echo "<br>";
$num3 = 15;
$num4 = 15;
if($num3 === $num4):
	echo "$num3 is equal $num4";
else:
	echo "$num3 is not equal $num4";
endif;

//HATA BASTIRMA OPERATORU
//Bu gelebilecek hatayi gizler ama bunu kullanmak cok da mantikli olmayabilir hatayi bastirmak yerine cozmemiz gerekecektir

$a=10;
$b=0;
$res = @($a/$b);
echo $res;
?>