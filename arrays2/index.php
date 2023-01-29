<?php 

$categories=[
	'websites'=>[
		 'e-commercielle'=>[
			  "finn",
			  "N11",
			  
		 ],
		 'education'=>[
					"udemy",
					"academy"
		 ]
	],
	
];	

echo $categories["websites"]["education"][0];//udemy

//SABIT DEGISKENLERDE DIZI KULLANIMI
define("name","Adem");//Sabit degiskenler i bu sekilde tanimlariz ve tirnak olmadan kullanriiz
$test=name;
echo $test;

define('member', [
    'name'=> "Adem",
    "surname"=>" Erbas",
    'age'=> 34,
    "developer"//index veya key olarak 0 dan baslar bir onceki ndeki key veya index yerinde bulunan deger
    //age string oldugundan dolayi
]);

echo "..........................";

//print_r(member);
/*
{
0: "developer",
name: "Adem",
surname: " Erbas",
age: "34"
},
*/

$name = "adem";
function getElement(){
	//global $name;//global yapmazsak Warning: Undefined variable $name hatasi aliriz
	static $name = "Adem";
	return $name;
};

echo getElement();
echo "<br>--------------------------<br>";

//CALLBACK ILE KULLANILAN ARRAY FUNCTIONS
$my_arr = [
	["id"=>1, "name"=>"Adem","surname"=>"Erbas","age"=>34,"is_married"=>true],
	["id"=>2, "name"=>"Sercan","surname"=>"Kavas","age"=>36,"is_married"=>false],
	["id"=>3, "name"=>"Ivar","surname"=>"Gundersen","age"=>60,"is_married"=>true],
	["id"=>4, "name"=>"Genzai","surname"=>"Genzai","age"=>42,"is_married"=>true],
	["id"=>5, "name"=>"Daniel","surname"=>"Johansen","age"=>27,"is_married"=>false]
];
$res = array_filter($my_arr,function($value){
		echo($value["name"])." <br> ";
		if($value["age"] > 34)return $value;
});

//print_r(array_values($res));//filtrelenen elemntleri getirir ama suna dikkat edelim..filtrelenen elmentleri index olark filtreleme yapilmadan onceki indexlerine gore getirecektir...
 
//print_r($my_arr);

//ARRAY_MAP KULLANIMI
//JAVASCRIPTTEKI MAP KULLANIMINA BENZIIYOR..
//ARRAY_MAP ARRAY ICINDEKI ELEMENTLERIN UPDATE EDILMESI ICIN KULLANILIR VE KESINLIKLE HER BIR ELEMANIN RETURN EDILMESI GEREKIR YOKSA ZATEN KENDISI BIZIM RETURN ETMEDIGMIZ ELEMENTLERIN YERINE DEFAULT OLARAK BOS STRING RETURN EDECEKTIR...
//AYRICA GARIP BIR DURUM FONKSIYON ISMININ STRING ICINDE YAZILMASI GEREKIYOR ARRAY_MAP METHODU PARAMETRESINE VERILECEK OLAN FONKSIYON...

function map_usage($value){
	if($value["name"] === "Sercan"){
		$value["is_married"] = true;
		return $value;
	}else{
		return $value;
	}
}

$res2 = array_map("map_usage",$my_arr);

//print_r($res2);


//array_values ile array_filter den gecirdgimiz arrayimizdeki index siralamasini, tekrar siraya koymak
//in_array ile de bir degerin array icerisinde var olup olmadigini kontrol etmek
$cities = ["Skien","Porssgrunn","Larvik","Sandefjord"];
if(in_array("Skien",$cities)){
	echo "Skien is in your array";
}else{
	echo "Skien is not in your array";
}


$arr4 = ["name"=>"Adem","surname"=>"Erbas"];
$arr5 = ["age"=>34,"is_married"=>true];
$res3 = array_merge($arr4,$arr5);
//print_r($res3); 
/*
{
name: "Adem",
surname: "Erbas",
age: "34",
is_married: "1"
}
*/

$arr6 = ["name"=>"Adem","surname"=>"Erbas","age"=>34,"is_married"=>true];
//print_r(array_reverse($arr6));
//Fonksiyonu tersten yazar...
/*
{
is_married: "1",
age: "34",
surname: "Erbas",
name: "Adem"
}
*/

//DIZI ICINDEKI ELEMENTLERE ERISMEK ICIN KULLANILAN METHODLAR

//CURRENT(): DIZIMIZIN ILK ELEMANINI VERIR
//END(): DIZININ SON ELEMANINI VERIR-END() I DIREK ECHO ILE EKRANA YAZDIRMAK HATA VEREBILYOR ONDAN DOLAYI DEGISKENE AKTARIP
//YAZDIRMAK DAHA MANTIKLIDIR
//NEXT- DIZININ BIR SONRAKI ELEMANINI BULUR
//PREV-DIZININ BIR ONCEKI ELEMANINI VERECEKTIR

echo "<br>&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&<br>";
$arr7 = ["name"=>"Adem","surname"=>"Erbas","age"=>34,"is_married"=>true,"fav-color"=>"green","city"=>"Skien"];
$arr8 = ["name"=>"Zehra","surname"=>"Erbas","age"=>9,"is_married"=>false,"fav-color"=>"pink","city"=>"Skien"];
echo current($arr8);//Zehra
echo "<br>";
echo end($arr7);//Skien
echo "<br>";
echo next($arr8);//Erbas
//Burayi iyi anlayalim. Burda once $arr8 bundan once en son hangi elemanini yazidrmis yani current olarak ilk elemani  yaziyordu o zaman next deyince ikinci elemani getirecek...cunku bundan once $arr8 current ile yazdirilmis ama, $arr7 ye next dedigi zaman hicbirsey gelmez cunku, $arr7 bundan once son olarak, end($arr7) yi yazdirmis yani en son elemanin bir sonrasi  y oktur
echo "<br>";
echo prev($arr7);//green-Bir oncekinde $arr7 son elemani calistirmis o zaman prev deyince de onun bir oncekini alacak ama eger $arr7 yi ilk defa prev i almaya calissa idik false gelirdi cunku default olarak current 0.indextir prev deyince -1.indexe bakar ve o index teki elementin bos oldugunu gorebilir
echo "<br>";

$arr9 = ["name"=>"Zehra","surname"=>"Erbas","age"=>9,"is_married"=>false,"fav-color"=>"pink","city"=>"Skien"];
echo next($arr9);//Daha oncesinde ku llanilan herhangi bir $arr9 yok ama current default olarak 0.index tir ve next e bakarken current i 0.index kabul ediyor nextte 1.indexe karsilik geliyor bu durumda
echo "<br>";
echo next($arr9);
echo "<br>";
echo next($arr9);
echo "<br>";

//Peki biz next ile ornegin 3. veya 4. index e kadar geldik ve sonrasinda tekrar next in default olarak basladigi gibi
//baslamasini istersek o zaman da reset methodunu kullaniriz
reset($arr9);//current i tekrar basa aldik bu sekilde....yani 0.indexe aldik tekrardan
echo next($arr6)."</br>";

//EN SON EXTRACT VE SORT METHODLARI KALDI DIZI LERDE BIR TEK.....
echo "***************************************************** <br>";
$my_arr2 = ["name"=>"Zehra","surname"=>"Erbas","age"=>9,"is_married"=>false,"fav_color"=>"pink","city"=>"Skien"];

//EXTRACT METHODU SAYESINDE SPESIFIK KEY I OLAN HER BIR VALUE NIN KEY LERINI DOGRUDAN DEGISKEN OLARAK
// KULLANABILIYORUZ O DEGISKENLER HANGI VALUE YE AIT ISE ONU VERIYOR DEGER OLARAK
//BU OZELLIK GERCEKTEN COK DIKKAT CEKICI BIR OZELLIK....
extract($my_arr2);
echo $name . " <br>";//Zehra
echo $fav_color . " <br>";//pink
echo $city . " <br>";//Skien

//SIRALAMA FONKSIYONLARI...SORT..KUCUKTEN BUYUGE-A DAN Z YE SIRALAMA YAPAR(VALUE LER ARASINDA)
$my_numbers = [13,45,6,7,23,18];
sort($my_numbers);//KUCUKTEN BUYUGE DOGRU SIRALAMA YAPIYOR
//print_r($my_numbers);
$my_cities = ["Skien","Larvik","Arendal","Kristiansand"];
sort($my_cities);//A DAN Z YE SIRALAMA YAPIYOR
//print_r($my_cities);

//RSORT-REVERSE SORT- YANI TERSTEN SIRALAMA (VALUE LER ARASINDA)
$my_numbers2 = [13,45,6,7,23,18];
$my_cities2 = ["Skien","Larvik","Arendal","Kristiansand"];
rsort($my_numbers2);//BUYUKTEN KUCUGE DOGRU SIRALYOR-VALUE DEGERLERINI
//print_r($my_numbers2);
rsort($my_cities2);//BURDA DA Z DEN A YA DOGRU SIRALIYOR
//print_r($my_cities2);

//A SORT - KEY LERE GORE SIRALAMA YAPIYOR..KEYLERE GORE KUCUKTEN BUYUGE VE A DAN Z YE  SIRALAMA YAPYOR
$my_numbers3 = ["13"=>13,"45"=>45,"6"=>6,"7"=>7,"23"=>23,"18"=>18];
$my_cities3 = ["Skien"=>"Skien","Larvik"=>"Larvik","Arendal"=>"Arendal","Kristiansand"=>"Kristiansand"];
asort($my_numbers3);
print_r($my_numbers3);
asort($my_cities3);
print_r($my_cities3);

//ARSORT- KEY LERE GORE BUYUKTEN KUCUGE VE Z DEN A YA SIRALAMA YAPAR
$my_numbers4 = ["13"=>13,"45"=>45,"6"=>6,"7"=>7,"23"=>23,"18"=>18];
arsort($my_numbers4);
print_r($my_numbers4);
$my_cities4 = ["Skien","Larvik","Arendal","Kristiansand"];
arsort($my_cities4);
print_r($my_cities4);
?>