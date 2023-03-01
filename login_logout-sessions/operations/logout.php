<?php 
//SESSION IN BURDA DA GECERLI OLMASI ICIN SESSION I BASLATGGIMZ SAYFA OLAN dbConnection sayfasini dahil ederiz
require_once("../config/dbConnection.php");

//if(!$session_manager->checkSessionDataExistInDb()) boyle bir kontrole burda gerek var cunku kullanici index.php sayfasindan logout butonauna basip gelirse tamam o zaman zaten bu kontrol yapilmis olarak gelecek ama  ya kullanici adres cubugundan duserse sayfaya o zaman o kontrole girmeyecek ondan dolayi bizim bunu dusunerek bu kontrollu ne olur ne olmaz diyerekten yapmamiz gerekkir

//Kullanici bilgileir uyusmyorsa yani buraya gelmis ise

if(!$session_manager->checkSessionDataExistInDb())$session_manager->removeSession();
helper::navigate("login.php");


?>