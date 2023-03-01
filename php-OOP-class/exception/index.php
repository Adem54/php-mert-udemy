<?php 
declare(strict_types=1);

function Divide(int $num1,int $num2){
	if($num2 == 0){ throw new Exception("Sayi 0 olamaz");}
	return $num1 / $num2;
}
//Burda bizim throw new Exception dememiz bize neyi sagliyor sadece bize kendi mize ozel mesaj yazabilmemizi sagliyor ve de by Divide mehtodunu eger try-catch icinde kullanirsak da o zaman da catch icerisinde hata yazdirdigmz zaman kendimize ozel yazdgimz hata mesajini ekrana basabiliriz ve ya kullaniciyi dogru yonlendirme acisindan bu cok onemldiir..... 

try {
	Divide(15,0);
} catch (Exception $e) {
echo	$e->getMessage();
}

echo "<br>";
echo "continue";

echo "<br>";

$number = 10;

function checkNumber(){
	global $number;
	if($number > 5){//sayi 5 ten buyuk oldugu durumda sistemimizin calismayacagini varsayarak kullaniciya da dogru hata mesaji vermekk icin throw new Exception ile mesajimizi yaziyoruz... 
		throw new Exception("Sayi 5 ten buyuk olamaz");
	}
}


try {
	checkNumber();
} catch (Exception $e) {
	echo $e->getMessage();//Sayi 5 ten buyuk olamaz
}
?>