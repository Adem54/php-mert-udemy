<?php 

$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL=>"https://dev.mysql.com/doc/refman/8.0/en/creating-spatial-indexes.html",
	CURLOPT_RETURNTRANSFER=>true,
	CURLOPT_REFERER => "https://wikipedia.no",
	CURLOPT_HEADER=>true, //URL OLARAK VERILEN SITENIN URL HEADER BILGILERINI VERRIR
	//TIMEOUT-ZAMANASIMI-CURL FONKSIYONUMUZ BELLI BIR  SURE ICINDE TAMAMLANMAZ ISE YANI BAGLANMAYA CALISTIGI SITEDEN CEVAP GELMEZ VE BAGLANMAZ ISE O ZAMAN OTURUMU KAPATMASINI SAGLAR
	CURLOPT_TIMEOUT=>"5"//SANIYE CINSINDEN VERILIR..

	
]);
//proxy ayari ise baglandgimiz sitede ip adresimizin gizlenmesini veya farkli gorunmesini sagliyor.Bir siteye farkli proxy bilgileri ile baglanabliyoruz
//CURLOPT_PROXY, "177.103.139.64" //burda gecerli bir proxy adresi ve proxy portu girmek gerekiyor..
//CURLOPT_PROXYPORT,"3128" AYARLARINI GIRERIZ


$data = curl_exec($curl);
curl_close($curl);

echo $data;
?>