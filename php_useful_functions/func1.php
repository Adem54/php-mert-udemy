<?php 

//str_replace

$str = "Adem Erbas";

$res =  str_replace("Adem","Zehra",$str);

echo $res;

//rand ile rastgele sayilar uretebiliyourz
echo "<br>";
echo rand();
echo "<br>";

echo rand(1,50);//1-50 arasi rastgele sayilar uretiyourz

//die() fonksiyonu 
$a = 3;
if($a === 5)die();
echo "<br> Welcome to website";
//login islemlerinde kullanici eger login yapmaya calistigi datalar veritabanindaki datalar ile uyusmz ise biz once header ile kullaniciyi terkrar login sayfasina yonlendiririz ve die deriz ve ordan itibaren gostermeyiz kullaniciya

echo "<br> ******************************************** <br>";

$str2 = "Welcome to our website and enjoy yourself";
$res2 = strpos($str2,"joy");//joy ifadesinin ilk basladigi index numarasini verecektir
echo $res2;
echo "<br>";
$res3 = strpos($str2,"zehra");//Bulamaz ise false yani 0 donuyor ama php de false 0 sonucunda ekrana birsey basilmaz
var_dump($res3);

//!= diye false dersek bunu bilgisayar algilayamaz....ancak cunku != demek esit degildir demektir bilgisayar ise bunu anlamaz denk degildir diye sorgularsak anlayabilir bunu da bilelim...onemli...
//Yani sonuc false donuyor ama php de false demek 0 demektir ama bilgisayar bunu false olarak bilir int 0 olarak bilmez ondan dolayi da biz != demek esit degil demektir ki burda sayilari karsilastirmak icin kullanildigi icin bunu bilgisyar algilayaamiyor ama !== demek ise denk degildir demek iste boyle yaparsak bilgisayar algilayabliyor boolean degeri karsilastiriyor

if($res3 !== false)echo "<br>Metin bulundu";
if($res3 === false)echo "<br>Metin bulunamadi";


if($res3){
	echo "<br> Metin bulundu";
}else {
	echo "<br> Metin bulunamadi";
}


//trim fonksiyonu, cok fazla kullnacagiz...gelen data nin saginda ve solundaki bosluklari kaldirmak icin kullniriz

//floor kendine esit ve kendisinden kucuk tam sayiya donusturur
echo floor(12.4);//12

//ceil kendine esit ve kendisinden buyuk tam sayiya donusturur
echo ceil(12.4);//13

//round ise yuvarlama yapar
echo round(12.4);//12
echo round(12.5);//13

//ABS MUTLAK DEGER ALIR
echo "<br>";
echo abs(-4);//4

//in_array-javascriptte include e karsilik gelir
//Bir dizi icinde bir elemanin var olup olmadigini sorgulamaya yarar... 

$arr = ["BMW","mercedes","audi"];
if(in_array("BMW",$arr)){
	echo "BMW bulundu";
}

//Burda biz bazen bize gelen elemntlerden sadece 1 veya 2 tanesi haric digerlerini alalim gibi
//logic ler yapmamz gerekebiliyor boyle durumlarda hemen kendimiz dizi olustururuz sonra da 
//asil ana dizi datamizin foreach ile dondurup her bir elemen icin eger bizim olustrudugmuz dizi icinde yok ise
//al diyerek almak istemedigmiz verilerden bu sekilde filtrelemis oluruz

echo "<br>*************************<br>";

//eval- string icinde php nin algilanmaisni saglar
$text = 'echo "hello world";';

eval($text);
echo "<br>";

//str_word_count
$str2 = "Adem Erbas Skien";
echo str_word_count($str2);//Textimzin kac kelimeden olustugunu veriyor.. 3
echo "<br>";

//basename() bu cok kullanacagmiz bir fonksiyonumuzdur...
//Bize basename i veriyor yani sondaki adresi veriyor...
$url = "http://siteadi.com/oyunlar/bedava/apk.mp4";
$base_name = basename($url);
echo $base_name;//apk.mp4

//pathinfo-bunu da cok kullanacagiz... 
$url2 = "http://siteadi.com/oyunlar/bedava/apk.mp4";
$path = pathinfo($url);
print_r($path);

/*
{
	dirname: "http://siteadi.com/oyunlar/bedava",
	basename: "apk.mp4",
	extension: "mp4",
	filename: "apk"
}
*/

//glob methodu
$files = glob("*");//Tum dosyalari verir
print_r($files);
/*
{
	0: "func1.php",
	1: "test1",
	2: "test2"
}

*/

?>