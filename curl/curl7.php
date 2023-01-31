<?php 
//POST ILE VERI GONDERME
//FORM ISLEMI OLAN BIR SITEYE GIRIS YAPABILIRIZ...
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,"http://localhost/test/php-mert-udemy/curl/curl8.php");
curl_setopt($curl,CURLOPT_POST,1);
curl_setopt($curl,CURLOPT_POSTFIELDS,"name=adem&surname=erbas&login=ok");
$data = curl_exec($curl);
curl_close($curl);
echo $data;

/*
{
name: "adem",
surname: "erbas",
login: "ok"
},
*/
?>