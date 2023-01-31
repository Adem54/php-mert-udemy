<?php 

$curl = curl_init();//Once curl baslatiriz
//Sonra curl de yapacagmiz islemleri curl_setopt parametresinde belirtiriz
curl_setopt($curl, CURLOPT_URL,"https://dev.mysql.com/doc/refman/8.0/en/creating-spatial-indexes.html");
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);//RETURN EDILEBILSIN DIYORUZ YOKSA GELEN DATAYI DEGISKENE AKTARAMAYIZ
//Ardindan da curl_exec methodunu kullanarak execute yani verilen ayarlari uygulariz
$data = curl_exec($curl);
//Ve son olarak curl islemini kapatiriz
curl_close($curl);
echo $data;





?>