<?php 

//Array olusturma-1
$cities = array("Skien","Porsgrunn","Larvik");

//Array olusturma-2
$person =[
	"id"=>1,
	"name"=>"Adem",
	"surname"=>"Erbas"
];

echo $person["name"];//Adem
$person["name"] = "Zehra";
echo $person["name"];//Zehra

$person[] = 34;//Bu diziye elmen ekleme demektir bu sekilde yapinca elementi diziinin basina ekledi(0.INDEXE EKLEDI)
$person[] = true;//1.INDEXE EKLEDI.. 
//print_r($person);

//AMA BU SEKILDE EKLERSEK 0. INDEX TEN BASLAYARAK EKLIYOR
$my_arr =[];
$my_arr[] = "Skien";//0.INDEX
$my_arr[] = "Marit";//1.INDEX
$my_arr[] = "Jogging";//2.INDEX
//print_r($my_arr);

//KESINLIKLE BIR ARRAY ICINDE ISLEM YAPMAYA CALISTIGIMZ ZAMAN EGER HERHANGI BIR KEY KULLANCAKSAK ONCE SORGULAMASINI YAPALIM....BU COK ONEMLIDIR

//PEKI OLMAYAN BIR INDEX VEYA OLMAYAN BIR KEY E ERISMEYE CALISIRSAK NE OLUR?
//echo $my_arr[3];//arning: Undefined array key  hatasi aliriz

 //echo $my_arr["city"];//Undefined array key  hatasi aliriz

 //BIRDE PHP DE ARRAYLER BIRZ JAVASCRIPTTEKI PROTOTYPING MANTIGNA BENZTIYORUM...BU DA YINE PHP NIN EKSTRA DEGISIK OZELLIKLERINDEN BIRISIDIR
 //IHTIYACIMIZ OLAN KEY I ANLIK OLARAK TANIMLAYIP HEMEN KULLLANABILIYORUZ DAHA ONCEDEN TANIMLAMA ZORUNLULUGUMZ YOK
 $person2 =[
	"id"=>1,
	"name"=>"Adem",
	"surname"=>"Erbas"
];


$person2["city"] = "Skien";
//print_r($person2);//Direk yeni bir key ve value sini atama yaptik bu sekilde....Ama olmayan bir key i ekrana BASTIRMAK ISTERSK HATA ALIYORUZ UNUTMAYALIM
//ASAGIDAKI GIBI KONTROLLERIMIZI DE YAPABILIRIZ...

//if($person2["is_married"]):
if(isset($person2["is_married"])):
	echo "\$person2 array has a is_married key";
else:
	echo "\$person2 array does not have a is_married key";//"$person2 array does not have a is_married key"
endif;

//

class myClass {
	private $var;
	private $var1;
	public $x,$y,$z ;

	public function __construct()
	{
		$this->var = "private variable";
		$this->var1 = true;
		$this->x=100;
		$this->y=100;
		$this->z=100;
		
	}

	public function iterate(){
		foreach ($this as $key => $value) {
			echo "$key => $value";
		}
	}
}
echo "MYCLASS<br>";

$obj = new myClass();
$obj->iterate();

//DIZIDEN ELEMAN SILME DIZI OLUP OOLMADIGININ KONTROLU VE DIZI ELEMAN SAYISINI BULMA

$person3 =[
	"id"=>1,
	"name"=>"Adem",
	"surname"=>"Erbas"
];
echo "<br>";
echo count($person3);//3
echo "<br>";
//AMA SURAYI AYIRT EDELIM...STRING LERIN KARAKTER SAYISIIN STRLEN METHODU ILE BULURUZ...
//NORMALDE JAVASCRIPTTE AYNI METHOD ILE HEM DIZI HEM DE STIRNG  KARAKTER SAYISI BULUNUR AMA PHP DE BU OYLE DEGIL
$name = "Adem";
echo strlen($name);//4

//BIR DEGISKENIN DIZI OLUP OLMADIGININ KONTROLU
//BU COK ISMIZE YARAYACAK..

echo "<br>";

if(is_array($person3)):
	echo "\$person3 is an array variable";
else:
	echo "\$person3 is not an array variable";
endif;

//DIZIDEN ELEMAN SILME...
unset($person3["name"]);
//print_r($person3);//name key inin oldugu element silinmis oluyor

$countries = ["Norway","Denmark","Germany"];
unset($countries[1]);//1.indexteki element silinmis oluyor
//print_r($countries);

//RANGE - BELLI ARALAIKLARDAKI TAM SAYILARDAN OLUSAN DIZI OLUSTURMA
$new_arr = range(0,10);//0 dan baslayarak 10 da dahil oolmak uzere 11 elemnli sayilardan olusan bir dizi olusturuyor
//print_r($new_arr);

//DIZI DEGERLERNI DEGISKENE ATAMA - LIST FONKSIYONU-  DESTRUCTRING--VARIABLE IN ARRAY IN PHP
$countries = [14,"Norway","is_married"=>true,"Denmark","Germany"];
$countries = [14,"Norway","Netherland","Denmark","Germany"];
//BU DA COK ENTERASN BIR OZELLIK JAVASCRIPTTE 
list($variable1,$variable2,$variable3,$variable4,$variable5) =  $countries;
echo "<br>";
echo $variable5;//Germany

//Burda dizi iicndeki eleman sayisi kadar degiskeni illa ki list icine koymamiz sart degil....
list($val1,$val2) = $countries;//0 VE 
echo $val1;//seklinde de 1.elemnte erisebilirz
//Ama sonuncu elemnte erismek icinde
list(, , , ,$my_val) = $countries;

echo "<br>";
echo "\$myval: ".$my_val;//Germmany
//list fonksiyonu sadece key olarak number kullanildigi zaman yani, spesifik key-value seklinde tanimlanan arraylerde kullanilmaz
$person5 =[
	"id"=> 1,
	"firstname"=> "Adem",
	"lastname"=> "Erbas"
];
//list($val1,$val2,$val3) =  $person5;
// echo "<br>";
// echo $val2;

//list fonksiyonunu ic ice de kullanabiliyoruz
list($a, list($b,$c)) = array("Apple",array("Dog","Rose"));
echo  "<br> \$a: ".$a;//Apple
echo  "<br> \$b: ".$b;//Dog
echo  "<br> \$c: ".$c;//Rose


//ARRAY_KEY_EXIST-BIR DIZI ICINDEKI KEY KONTROLUNU  YAPAR...
//PHP SUREKLI OLARAK DEGERLERIN VARLIK KONTROLUNU, TYPE KONTROLUNU VS GIBI KONTROLLLERI ILE ONPLANDA OLAN BIR DILDIR..
$person6 =[
	"id"=> 1,
	"firstname"=> "Adem",
	"lastname"=> "Erbas"
];

if(array_key_exists("firstname",$person6)):
	echo "you have name key in your \$person6 array";
else:
	echo "you don't have name key in your \$person6 array";
endif;

//BIR DIZI ICINDEKI KEY LERI DIZI OLARAK DONDUREN FONKSIYON-
print_r(array_keys($person6));//["id","firstname","lastname"] seklinde gelecektir

print_r(array_values($person6));//["1","Adem","Erbas"];


//ARRAY_POP DIZI SONUNDAKI BIR ELEMENTI SILMEYE YARAR
//UNSET- ISE SPESIFIK BIR KEYE AIT VALUE YI SILEMEYE YARAR
//Biz unset ile de diziden element silebiliyorduk ama dikkkat edelim farka, unset ile biz key ini girdigmiz elementi siliyordukk yani spesifik bir key var ise o keyi girerek ya da spesifik bir key yok ise index degerini girerek silme islemini gerceklestirebilyorduk biz..hatirlayalim...

//Ama anahtar degeri bilmiyor ve dizinin sonunda ki elementi silmek istersek o zaman, array_pop u kullanabiliriz. 

$person7 =[
	"id"=> 1,
	"firstname"=> "Adem",
	"lastname"=> "Erbas",
	"age"=>34,
	"is_married"=>true
];

array_pop($person7);//Son elementi siliyor
print_r($person7);
unset($person7["firstname"]);//spesifik olarak verdgimiz key e ait value yi siliyor yani hem key ini hem value sini sliyor
print_r($person7);

$my_cities = array("Skien","Kristiansand","Arendal");
unset($my_cities[1]);//1.indexteki Kristiansandi silecektir
print_r($my_cities);


//ARRAY_RAND- RASTGELE OLARAK ARRAY ICINDEN ISTEDGIMIZ SAYIDA(PARAMETREYE VERDIGMIZ SAYI ADEDINDE)
// DIZININ KEY LERINI RANDOM DIZI OLARAK DONDURUR
//BU ARRAY_RAND BAZI YERLERDE COK EFFEKTIF ISLEMLER YAPABILMEMIZI SAGLAYACAKTIR.. 

$student =["id"=>1, "name"=>"Zehra","surname"=>"Erbas","age"=>9,"color"=>"pink"];

print_r(array_rand($student,2));

//array_count_values-ARRAY ICINDEKI DEGERLERDEN KAC KEZ KULLANILMIS ISE O SAYILARI DIZI ICINDE VERIR..
//ARRAY VALUE LERINI KEY OLARAK KULLANIR KEY LERE VALUE OLARAK DA TEKRAR ETME SAYILARINI KULLANIR

$arr2 = ["a","b",12,true,57,"a","b","b",12];
print_r(array_count_values($arr2)); 
/*
[
	"12"=>"2", 12 degerinden 2 tane var
	"57" =>"1", 57 degerinden 1 tane var
	"a"=>"2", a degerinden 2 tane var
	"b"=>"3" b degerinden 3 tane var
]
*/

//ARRAY_SHIFT-DIZININ BASINDAN BIR DEGERI SILER VE O SILDIGI DEGERI DONDURUR
$arr3 = ["Mehmet","Adem","Zehra","Ivar"];
$res5 = array_shift($arr3);
echo "<br>";
echo $res5;//Sildigi degeri donduruyor-Mehmet
echo "<br>";

print_r($arr3);//["Adem","Zehra","Ivar"]


//DIZININ BASINA ELEMAN EKLEMEK

array_unshift($arr3,"Knut");
print_r($arr3);//["Knut","Adem","Zehra","Ivar"]
array_unshift($arr3,"Sercan","Onur");
print_r($arr3);//["Sercan","Onur","Knut","Adem","Zehra","Ivar"]

//DIZI DE HERHANGI BIR VALUE YI ARAMA-ARRAY_SEARCH
echo array_search("Adem",$arr3);//"3" DONDURUYOR
//Ilk buldugu value nin key ini gonderir yani ayni javascriptteki indexof gibi aradgimiz bir array elemntinin indexi ni donduruyordu burda ayni mantik aslinda key ini dondurur..Ilk buldugu keyi dondurur
//Eger bulamaz ise false donecektir...
//PHP NIN ENTERESAN OZELLIKLERINDEN BIRI DE BUDUR BIRCOK INBUILD FONKSIYONDA BUNUNLA KARSILACAGIZ YA FONKSIYON YAPMASI GERKEN ISLEMI YAPAR VE BIZE BIR SONUC DONDURUR INT,ARR VEYA HER NE ARIYORSAK EGER O ISLEMI YAPAMAZ ISE FALSE DONDURUYOR...YANI 0 YANI EKRANA HICBIRSEY BASMIYOR...0 OLDUGUNU GOREBILMEK ICIN YANI BOOL-FALSE A KARSILIK GELEN 0 I GORMEK ICIN VAR_DUMP ILE EKRANA BASTIRIRIZ

//ARRAY_SUM FONKSIYONU ILE BIR DIZIDEKI DEGERLERIN TOPLAMINI ALMA
//JAVASCRIPTTE REDUCE ILE YPATIMIZ ISLEM
$numbers = [15,34,12,24];
echo "<br>";
echo array_sum($numbers);//85

//DIZI ICINDEKI DEGERLERIN CARPIMINI HESAPLAR
$numbers = [5,6,7];
echo "<br>";

echo array_product($numbers);

//DIZI ELEMANLARINI RANDOM OLARAK INDEX LERINI KARISTIRMA-
$arr4 = [1,"a","x",12,"y","b"];
shuffle($arr4);

print_r($arr4);//["a",12,"x","y","b","1"]
//her calistiginda random olarak $arr4 dizisinin karistiracaktir.

//array_chunk-DIZI ICINDEKI ELEMANLARI VERDIGMIZ DIZI ELEMAN SAYISI KADAR DIZI ICINDE DIZILERE AYIRIR
$arr5 = [1,"a","x",12,"y","b","c"];
$res6 = array_chunk($arr5,2);
print_r($res6);//Bir dizi icinde 4 tane dizi olusturur ve siradan 2 serli 2 serli elemanlari her bir
// dizi icine atacaktir son kalan eleman 2 tane ise 2 tane atar 1 tane kalmis ise onu tek basina yeni bir diziye atar...

//ARRAY_
//ANAHTARLARIN BULUNDUGU DIZI ILE VALUE LERININ BULUNDUGU DIZILERI BIRLESTIRIYOR
$keys = ["name","surname","age"];
$values = ["Adem","Erbas",34];
print_r(array_combine($keys,$values));
/*
name: "Adem",
surname: "Erbas",
age: "34"
*/


//ARRAY_FILL-DIZIMIZE ELEMAN DOLDURMAK
$arr6 = array();
$arr6 = array_fill(3,4,"Adem");//3.indexten basla 4 tane Adem degerini yazdir demis oluyoruz
print_r($arr6);//["Adem","Adem","Adem","Adem"]

//ARRAY_FILL_KEYS
$arr7 = ["key1"=>"value1","key2"=>"value2", "key3"=>"value3"];
print_r(array_fill_keys($arr7,"adem"));//["value1"=>"adem","value2"=>"adem","value3"=>"adem"]
//value leri key e atayp bizim verdgimz degeri de her bir anahatara deger olarak atiyor

//ARRAY_FLIP- KEY LER ILE VALUE  LERIN YERLERINI DEGISTIRIYOR
$arr = ["name"=>"Adem","surname"=>"Erbas"];
print_r(array_flip($arr));
/*
{
Adem: "name",
Erbas: "surname"
}
*/
//array_push dizinin sonuna eleman ekliyor
$my_arr = ["Adem","Zeynep"];
array_push($my_arr,"Zehra","Mert");
print_r($my_arr);

//array_slice - dizi icinden sectimgiz bir bolumun alinabilmesini sagliyor
$my_new_arr = [12,"adem",true,34,"zehra","color"];
print_r(array_slice($my_new_arr,1,2));//array de 1.indexten baslayip 2 deger alsin diyoruz burda ama 3.index i yani 2 sayisini vermese idik 1.indexten baslar geri kalan tum elementleri alirdi

//array_unique-dizi icerisinden her bir degerden 1 tane alarak getirir tekrarli deeger getirmez
$my_arr2 = ["adem",12,"adem","zehra",12,"zehra","zeynep"];
$res = array_unique($my_arr2);
print_r($res);
/*
{
0: "adem",
1: "12",
3: "zehra",
6: "zeynep"
}
*/


?>