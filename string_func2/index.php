<?php 

//explode-stringi belli kriterlere gore diziiye cevirmeyi saglar-javascriptteki split methodu ile ayndir
$str = "Hello world. It's a beautiful day.";
//print_r(explode(" ",$str));//bosluklar a gore seperte ederek dizi ousturur
$res = explode(" ",$str);
//print_r($res);['Hello','world!','It's','a','beautiful','day.']
//implode - array i stringe cevirirken kullaniriz

$arr = array('Hello','World!','Beautiful','Day!');
echo implode(" ",$arr);//Hello World! Beautiful Day!

//strrev-string bir metni ters cevirmeyi  yapar
$str2 = "adem";
echo strrev($str2);//meda

//nl2br methodu karakter dizisindeki \n satir sonu karakterini html deki br ile degistiriyor
$value = "ademerbas.com'a  \n hepiniz hosgeldiniz";
echo nl2br($value);//\n boslugunun yerine bir alt satira atan br yi getirir

echo "<br>";
//parse_str- bir karakter dizsindeki degiskenleri bulur-bu suanda calismiyor neden bilmiyorum
// parse_str("name=Peter&age=43");
// echo $name."<br>";
// echo $age;

//md5 sifrleme fonksiyonu-kullanici  sifrelerini veri tabanindan md5 sifreleme ile sifreleeyp de o sekile veritabanina kaydedilir
$pass = "1234"; 
echo md5($pass);//81dc9bdb52d04dc20036dbd8313ed055
echo "<br>";

//sha1 sifrleme algoritmasi yapar
$pass2 =  "adem";
echo sha1($pass2);//dc79af74dc21ddb99fa2390f767453056a253b8a
?>	