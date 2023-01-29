<?php 
//functions default parameter kullanim

function sumNumbers($num1 = 10, $num2 =5){
	return $num1+ $num2;
}

//echo sumNumbers();//15
echo "<br>";

echo sumNumbers(20,30);//50

echo "<br>";
//php de fonksiyonlari degiskenlere atayabiliyruz..
$my_function = "sumNumbers";
echo "<br>";

echo $my_function(40,60);

//DEGISKEN SAYIDA PARAMETRE ALAN FONKSIYONLAR..
//func_num_args() gelen parametres saysini belirtir
//func_get_arg() bu da gelen parametreyi alir
//parametreye girilen degerler 0,1,2 .deger olarak alinir
//Bunlar on tanimli fonksiyonlardir ve ayni javascriptteki arguments fonksiyonu gibidir
echo "<br>  ***************************";

function myFunc(){
	echo func_num_args()."<br>";//Gelen parametre sayisini veriyor..
	echo func_get_arg(0)."<br>";//Gelen 1. parametre degerini verir
	echo func_get_arg(1)."<br>";//Gelen 2. parametre degerini verir
	//func_get_args ile de girilen tum parametreler dizi icinde gelir bize
//	print_r(func_get_args());//[] girilecek paramtreleri dizi icerisidne alabiliyoruz

}

myFunc(25,45);

echo "<br>-----------------------------------------------------------";

function myFunc2(){
//	print_r(func_get_args());//[23,56,78,90]
};
//Bu harika bir bestpractise dir ve surdurulebilir sistem kurmak icin birebirdir resmen...
//VE bu ayni C# daki params ve javascritpteki spread operatorlerinin yaptigi is gibi biz kullanicinn girdigi tum parametreleri alabiliyhoruz  yani istedigi kadar parametre girsin

myFunc2(23,56,78,90);

//FONKSIYONDA STATIC DEGISKEN KULLANMAK
//Fonskiyon icinde static degisken kullnmak-Bu sekilde biz bu fonksiyonun kac kez cagrildigini takip edebiliriz
//Bu da ayni javscriptteki closure ye benziyor
//static ile belirtilen deger her fonksiyon calistiginda bir onceki calisan fonksiyondna degeri devraliyor dinamik bir sekilde...

echo "<br>";
function my_new_func(){
	static $count = 0;
	$count++;
	echo $count."<br>";
};

my_new_func();//1
my_new_func();//2
my_new_func();//3
my_new_func();//4
my_new_func();//5
//Bu sekilde bu fonksiyonun kac kez kullanildigini kontrol edebiliriz

//Birde disarda tanimlanana bir degiskeni fonksiyon icnde kullanabilmek icin...global olarak tanimlariz
$my_value =12;
function my_func3(){
	global $my_value;
	echo $my_value;
}

my_func3();

//Fonksiyonun tanimli olup olmadgini kontrol edebiliyoruz ki bu cok onemlidir...php dilinde bu kontroller cok onemldir
if(function_exists("my_func3"))://Yine dikkat edelimm....string olarak fonksiyon ismini girmemiz gerekiyor...
	echo "You have my_func3";
else:
	echo "You don't have my_func3";
endif;

//Tanimli fonksiyonlari bir dizi olarak alabiliriz

function sum($a,$b){
	return $a+ $b;
};

function multiple($a,$b){
	return $a * $b;
};

//Tumn fonksiyonlari alabiliyoruz, daha onceden inbuild olarak gelen ayrica bir de sadece kendi yazdiklarimiz i da user i alarak alabilyoruz
$my_defined_functions = get_defined_functions()["user"];
print_r($my_defined_functions);
?>