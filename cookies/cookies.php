<?php 

//COOKIES
//Tarayiciya saklamak icin key-value seklinde datayi tarayiciya belirttgimz sure araliginda depolamaya yarar

//Cookie olusturma-setcookie
setcookie("name","Adem");
setcookie("surname","Erbas");

//cookie icerisine belirli bir surelik cookie datasi girmek
//sure girerken saniye cinsinden girmeiz gerekir

//1 gunluk cookie datasi nasil girerirz
setcookie("name","Zehra",time()+(60*60*24));//1 gun sonra otomatik men tarayicidan silinecektir
//Olusturdgmuz cookie dev tools da applications menusunden gorebilriz

//OLUSTURDGUMUZ COOKIE I NASIL SILEBILIRIZ-COOKIE SET EDIP SU ANKI TARIHTEN GECMIS BIR TARIH VERIRSEK O ZAMAN
//COOKIEMIZ SILINECEKTIR
// setcookie("name","Zehra",time()- (60*60*24));
// setcookie("surname","Erbas",time()- (60*60*24));

//PEKI COOKIE YA NASIL ERISIYORUZ 
print_r($_COOKIE["name"]);
print_r($_COOKIE);

//COOKIE LERIN VARLIGININ KONTROLU
if(isset($_COOKIE["name"])){
	echo "YOu have a name cookie";
}else{
	echo "you don't have a name cookie";
}

?>