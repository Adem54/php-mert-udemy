<?php 
//REFERER(HANGI REFERANS ILE GELIYOR) - USERAGENT(KULLANICININ HANGI TARAYICI ILE BAGLANTI YAPTIGINI BULABILIRIZ) KULLANMAK
//Biz bir siteye baglanmak isterken, eger karsidaki site siteye uzaktan baglananlar ile ilgili onlemler aldiginda biz de bu ozellikleri kulaniriz

$curl =  curl_init();

curl_setopt($curl,CURLOPT_URL,"http://localhost/test/php-mert-udemy/curl/curl3.php");
curl_setopt($curl,CURLOPT_USERAGENT,"Mozilla/5.0");//Bu sekilde tarayici isimleri eklersek baglandgimz siteye sanki bu tarayici uzerinden baglanmisiz gibi gozukecektir yani biz baglandigmiz tarayiciyi farkli bir tarayici da gosterebiliyoruz baglanmaya calistgmiz site bizim baglanti yapmamizi engellememesi icin.Hatta eger istersek burda tarayici bilgisini rastgele, random olarak da alarak her baglandigdinda tarayici degistirmis oluruz
curl_setopt($curl,CURLOPT_REFERER,"https://www.google.com/");//
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
$data =  curl_exec($curl);
curl_close($curl);

echo $data;//bIZ curl3.php yi  yazdirsin dedik...ve de orda baglandimiz adresin te $_SERVER ile o siteye istek gonderen 
//kullanicilar ile ilgili bilgiler gelior ve orda 
//HTTP_REFERER: "https://www.google.com/", bu sekilde geliyor cunku biz baglndgmiz site den bizim oraya google.com adresinden geldigmiz gozukmesini istedgmiz icin referer ayari yaptik ve bu sekilde gozuktu bu sayede


?>