<?php 

//string formatinda olup olmadigini kontrol edebiliriz 
$str = '<h1>Hello</h1>';

$newStr = filter_var($str,FILTER_SANITIZE_STRING);
//degisken icindeki html degerlerini kaldiriyor ve stringe ceviriyor

echo $newStr;
echo "<br>".$str;

echo "<br>";

$text = "ADAFS6ADFASDFAS7";

//string icinde bulunan int degerlerini toplayip yanyana almamizi sagliyor
$test1 = filter_var($text,FILTER_SANITIZE_NUMBER_INT);
echo $test1;//67 
echo "<br>";


//FILTER_VALIDATE_INT - BIR DEGERIN INT OLUP OOLMADIGIN filter_var ile kontrol etmek
$number = 12;
if(filter_var($number,FILTER_VALIDATE_INT)){
	echo $number." is an integer";
}else{
	echo $number." is not an integer";
}

//FILTER_VAR ARACILIGI ILE IP ADRESLERINI DE CHECK EDEBILIRZ YANI FORMAT OLARAK DOGRU MU DEGIL MI ONU KONTROL EDEBILRIZ.. 
$ip = "127.0.0.1";
//degiskenini ip adresine uuygun formatta oldugunu dogrualmaya yariyor
if(filter_var($ip,FILTER_VALIDATE_IP)){
	echo " This ip is right";
}else {
	echo "This ip is wrong";
}

echo "<br>";
//email adresleri icin dogrulama da y apabilriz ..EMAIL KONTROLUNU INBUILD FONKSIYON ILE YAPABILIYORUZ
$email ="adem5434e@gmail.com";
if(filter_var($email,FILTER_VALIDATE_EMAIL)){
	echo " Email format is right";
}else{
	echo " Email format is wrong";
}

//HTTP URL IN DOGRU FORMATTA OLDUGU DA SORGULANABILIYOR
$url = "http://ademerbas.com";
if(filter_var($url,FILTER_VALIDATE_URL)){
	echo "url format is right";
}else{
	echo "url format is not right";

}
?>