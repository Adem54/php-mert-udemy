<?php 
//require("session.php");
//DIKKKAT 
//Notice: session_start(): Ignoring session_start() because a session is already active in C
//Eger biz session i baslatttimgiz ve icerisine datalar kaydettgimz session.php sayfasini session2.php sayfasindan hem require edip hem de session2.php sayfasinda tekrar session_start yaparsak hata aliriz cunku bizim bir sayfayi require etmtiz demek aslinda ayni o iki sayfayi ayni icinde alt alta eklemek gibi dusunebiliriz dolayisi ile, zaten baslatilmis bir sesssion i biz ayni safyada tekrar baslatma hatasi aliriz eger hem require dan session.php yi cagirip hem de bir kez daha session2.php de sesson_start ile session baslatir issek....BU AYRIMI IYI  BILEMLIYIZ....

session_start();

echo $_SESSION["name"];
?>