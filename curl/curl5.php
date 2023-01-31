<?php 
//CURL ILE GET METHODU ILE FORM GONDERME... 
$get = "id=15&name=20";


$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,"http://localhost/test/php-mert-udemy/curl/curl6.php?".$get);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
$data = curl_exec($curl);
curl_close($curl);
echo $data;
//Biz burda kendi php sayfamiza get ile veriyi curl ile gonderdik ve de gonderdigmz veri yi de yine bu sitenin kaynak kodlarina erisgimtz icin goruntuledik echo ile
?>
