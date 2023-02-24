<?php 

//include
// include($_GET["page"].".php");
//Burda include icerisinde bu sekilde yazinca.. get - url uzerinden page="text.txt" gibi ne yazarsak hangi sayfayi yazarsak onu calistirabilriyoruz.. bu tehlikeli bir sey bunun onune gecmek icin bu sekilde sonuna .php uzantili olan dosyalari cagirabilmesini saglariz, yok .php boyle bir uzanti girmezsek o zaman her turlu dosyayi cagirabiliyor
//Yoksa kullanici ../../ yazarak hic beklemdgimiz sekilde dosyalarimza erismeye calisabilir
//request_once i kullanmaliyiz include yerine

//file_get_contents ile direk herhangi bir siteye istek yapip icerigini cekiyor

//DIKKAT EDELIMMM..PHP ILE PHP DEN YANI SERVER TARAFINDAN YANI BACKEND TARAFINDAN 
//file_get_contents ile ve curl ile diger server lara ve service lere istek yaparak ordan datalari cekebiliyoruz....

//echo file_get_contents("https://www.php.net/");
echo file_get_contents($_GET["page"]);

//gidip get-requestte page e karsilik olarak
//test/php-mert-udemy/php-security/file_get_contents-include-insecurity.php?page=https://www.php.net/

//BU KONTROL COOOK ONEMLIDIR... 
//file_get_contents hem bir dosya icindeki datalari cekebiliyor hem de uzak serverdan domain adresleri uzerinden o serverlara istek gondererek datalarini uzak pc den cekiyor biz peki lokalda mevcut dosyada ki verileri cekmesin sadece uzaktan datalari ceksin istersek o zaman file_exist ile eger dosya vvar ise get ile page e karsilik gonderilen dosya var ise onu cekme  yok ise onu cek deriz 
if(!file_exists($_GET["page"])){
	echo file_get_contents($_GET["page"]);
}

//FILE YUKLEME ISLEMLERINDE BIZ UZANTILARI BIR DIZI ICERISINE YAZARIZ
$allowedExtentions = ["jpeg","png","jpg"];
//VE GELEN $_FILE DAN dosya ismini alip sonra pathinfo metodu ile extentioni da alip bu array icinde var mi diye sorgulariz ve ardindan da kullanicinin gelip de php dosyasi yuklemesini onlemis oluruz... cunku php dosyasi front-enddeki kullanci tarafindan get- isteginde url e yazilarak eger var ise  yazilan o sayfa server da onun calistirilmasi saglanabiliyor yani bir kullancinin yuklemis oldugu ozel bir pgp dosyasini gelip baska bir kullanici get request ile calistirabilir bunu onlememiz gerekiyor... bunu da iste uzanti kontrolu ile yapariz... ve bu sayede kullanicinin sadece bizim belirledigmz uzantida dosyalar yuklemelerini saglariz.. 

?>