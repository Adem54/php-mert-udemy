<?php 
session_start();

if(isset($_GET["lang"])){
	$lang = strip_tags($_GET["lang"]);
	//echo $lang;
	//Artik burda kullanici hangi dile tiklarsa biz tiklanan dilin hangisi oldugunu artik alabiliyoruz
	//Burda yine her zaman ki gibi biz en, no dilleri dizi icine kendimiz manuel olarak atiyoruz ku biz bunlarin bizim elimizde olan seceneklerden birisi olup olmadignini  kontrol ederek garanti altina alalim...CUNKU adam url-adres cubuguna mudahele edebilir sonucta
	$arr = ["en","no"];
	if(in_array($lang,$arr)){//Eger get ile gonderilen deger bizim elimzde olan dil seceneklerinden biri ise yap diyoruz... normalde zaten kullaniciya bizim sundugmuz tiklama seceneklerinde kullanici norweigan ya da english tiklayabiliyuor ikisinden birini gonderebilir tiklama ile ama olurda gidip eli ile url-adres cubugunda baska birsaeyler girip de gonderirse bunu kontrol etmemiz gerekir herzaman icin
	 
		//Eger gonderilen dil bizde var ise bunu session a deger olarak atayalim... 
		$_SESSION["lang"] = $lang;
	}else{
		echo "We don't have this language";
		//Ama olurda kullanicidan gelen dil bizde yok ise biz default olarak english olarak langugeyi verelim ki illa bir dil olmasi gerekiyor...default dilimz english olsun
		$lang = "en";
		$_SESSION["lang"]=$lang;
	}
}

require_once("lang.php");

echo '<a href="?lang=en">English</a>'.'<br>' .
 '<a href="?lang=no">Norweigan</a>';

//Inglizceye basinca en gonderiyor norweigan a basinca no gonderiyor
//Ingilizceye basilinca sitemizin dili ingilizce, norweigana basinca sitemizin dili norweigan a cevrilecek

/*
ARTIK BURDA get parametresine biz asagidaki key leri verdgimz zaman karsilik olarak English e basarsak ingilizce, norweigan a basarsak norweigan karsiligini veriyor
	$lang["home"]="Home page";
	$lang["login"]="Sign in";
	$lang["register"]="Sign up";
	$lang["about"]="About";
	$lang["logout"]="Sign out";

*/
echo lang::get("login");//static bir methodun bu sekilde kullanilabileegini bilemiz gerek

?>