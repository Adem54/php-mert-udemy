<?php 

$name = "Adem";
$surname =  "Erbas";

//PHP DE STRING BIRLESTIRME OPERATORU . OPERATORUDUR...
echo $name. " ".$surname;

$num1 = 15;
$num2 = 3;

echo "<br>";
echo $num1 / $num2;

//Degiskenin veri tipini ogrenme...
//Php yukardan asagiya dogru calisir
//Php de degiskenlerin icinde depolanan veri tipi degiskendir yani dinamik bir veri tutma durumu vardir php de ayni javascriptteki gibi
echo "<br>";
echo gettype("hello");
echo "<br>";
echo gettype(23);
echo "<br>";

echo gettype(true);

//Degiskenin veritpini degistirme... 
//TUR DONUSUMLERI 

echo "<br>";

echo gettype(strval(123));//stringee cevirdikkk

echo "<br>";

$my_number = "25";
echo gettype($my_number);
echo "<br>";
echo gettype(intval($my_number));//integer a cevirdikkk..

echo "<br>";

$new_number = 12;
settype($new_number,"string");
echo gettype($new_number);//string e cevirdi bu sekilde.. 
echo "<br>";
$my_new_num = "12";
settype($my_new_num,"integer");
echo gettype($my_new_num);//integer

echo "TIP DONUSUM <br>";

$num3 = 7.5;//double turunde gelir
echo gettype($num3); 
echo "<br>";
echo gettype(intval($num3));//double dan int e ceviriyor
echo "<br>";
echo gettype((int)$num3);//double dan int e ceviriyor
//Casting islemi gibi de yapabiiyoruz bu sekilde...
echo "<br>";
$num4 = 25;
echo gettype((string)$num4);//integer dan stringe cevirdik casting ile burda da 

echo gettype((double)$num4);//Bu sekilde de double a cevirmis olduk... casting.. 
echo "<br>";

echo gettype(doubleval($num4));//Bu sekilde de yine integerdan double a cevrilebiliyor... 

echo "<br>";

echo gettype((bool)"Adem");//boolean degere donusturmus olduk
$value = "Adem";

//PHP DE BOOLEAN DEGERLER 0-1 OLARAK GELIR 0-FALSE DUR AMA EKRANA HICBIRSEY BASMAZ FALSE DURUMUNDA AMA TRUE DURUMUNDA EKRANDA 1 DEGERINI GORURUZ
echo (bool)$value;//1 sonucunu verecektir.

//False degeri php de 0 olur ve ekrana basmak istersek goremiyourz ama illa gormek istersek onu var_dump ile hem degisken degerini hem de type ini gorebiliriz

echo "<br>";
$is_married = false;
var_dump($is_married);

//BU ARADA SUNA DIKKAT ETTIK MI..STRING BIR DEGERI BOOLEAN OLARAK 1 E DONUSUYOR 
echo (bool)0;//false-ekranda hicbirsey goremeyiz 0 donecektir false php de
echo (bool)1;//true-1
echo (bool)15;//true-1
echo "<br>";

//TRUE-FALSE UN STRINGE DONUSTURULMESI
echo "TRUE-FALSE UN STRINGE DONUSTURULMESI <br>";
echo (string)true;//1 olarak donecektir sonuc...



//TUR DONUSUMLERINDE KONTROLLERIN YAPILMASI 
echo "TUR DONUSUMLERINDE KONTROLLERIN YAPILMASI <br>";
//type in string olup olmadignin kontrolu
$my_value = "Adem";
//$my_value = 12;

echo is_string($my_value);//1 
if(is_string($my_value)){
	echo $my_value. " is a string value";
}else{
	echo $my_value. " is not a string value";
}

//PHP DE TIP KONTROLLERINI YAPABILMEMIZ ICIN INBUILD FONKSIYONLARI KULLANABILIRIZ

//is_string
//is_bool
//is_int
//is_null
//is_array
//is_object
//is_float
//is_double
//is_numeric

echo "<br>";
$test1 = 23;
if(is_bool($test1)):
	echo $test1. "is a bool value";
else:
	echo $test1. "is not a bool value";
endif;

echo "<br>";

$my_new_value = 24.1;

if(is_double($my_new_value)){
	echo $my_new_value." is a double value";
}else {
	echo $my_new_value." is not a double value";
}

echo "<br>";
if(is_float($my_new_value)){
	echo $my_new_value." is a float value";
}else {
	echo $my_new_value." is not a float value";
}

//is_numeric bir degiskenin numara olup olmadingini kontrol etmek icin kullaniriz
//yani int, veya double,float bunlari hepsi numerictir....

//OBJE KONTROLUNUN YAPILMASI
class adem {

}

$a = new adem();//object type

if(is_object($a)){
	echo "<br> This is an object type";
}else {
	echo "This is not an object type";
}

//empty-bir degsikenin bos olup olmadigin i kontrol edebiliriz 
$my_num = 0;//0 integer icin empty de true geliyor
if(empty($my_num)){
	echo "This is an empty int";
}else {
	echo "This is not an empty int";
}
//string de empty demek ise 
$my_str = "";//true gelecektir empty methodu icinde... 
if(empty($my_str)):
	echo $my_str."my_str is an empty string";
endif;

//isset ile bir degiskenin tanimli olup olmadginin kontrol ederiz...
//ENCOK KARSIMIZA CIKACAK VE DIKKAT ETMEMIZ GEREKEN NOKTALARDAN BIRISIDIR..DEGER ATANMAMIS BIR DEGSIKENI EKRANA BASMAYA CALISIRSAK VEYA KULLANMAYA CALISIRSAK HATA ALIRIZ VE UYGULAMAMIZ PATLAR ONDAN DOLAYI ISSET KONTROLU COK FAZLA KULLANILIR PHP DE.... 
$new_value;
//var_dump($new_value);

if(isset($new_value)){
	echo "There is a value";	
}else{
	echo "There is not any value";
}

?>