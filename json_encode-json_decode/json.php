<?php 
//siteler paylasmak istedikleri verileri json olarak paylasir veya biz de veritabanindan gelen veriyi
// json a cevirerek front-ende gondeririz genellikle

//json_encode php den json olusturmak icin kullaniriz
//json_decode json i php ye cevirmek icin kullaniriz

$data = [
	[
		"id"=>1,
		"name"=>"Adem",
	"surname"=>"Erbas",
	"age"=>35
	],
	[
		"id"=>2,
		"name"=>"Zehra",
	"surname"=>"Erbas",
	"age"=>9
	],
];

$json_data = json_encode($data);

echo $json_data;
/*
[
  {
    "id": 1,
    "name": "Adem",
    "surname": "Erbas",
    "age": 35
  },
  {
    "id": 2,
    "name": "Zehra",
    "surname": "Erbas",
    "age": 9
  }
]
*/
//Biz php ile api hazirlarken data mizi json olarak gonderecegiz...bunu cok ca kullanacagiz.. 
//Yani php den json a cevirip datayi json olarak front-ende gonderecegiz ve orda bu datayi json dan
//parse ile array icinde objeler halinde alacagiz..

//Biz json a cevirdgimz data mizi bir .json dosyamizin icerisine yazabiliriz... ve sonra da kullanaagmiz zaman da o dosyadan
//data yi json olarak alip ordan kullaniriz... 
file_put_contents("test.json",$json_data);

$my_data = file_get_contents("test.json");//json dosyamizdan dat mizi alip sonra da php ye ceviriyoruz
echo $my_data;//bu json formtinda su an... ve bunu tekrar php formatina cevirelim...
$data_php = json_decode($my_data);
//print_r($data_php);
var_dump($data_php);//$data_php artik ARRAY TIPINDE BIR DATA ICINDE 2 TANE OBJEDEN OLUSAN BIR DATA OLARAK GELIYOR... BURAY DIKKAT...
//OBJE DEMEK PHP DE CLASS DEMEKTIR YANI BIZ ARRAY ICINDEN 0,1 INDEX-KEY LER ILE OBJELERE ERISTIKTEN SONRA OBJE ICINDEKI DATALARA ISE OBJE NOTASYONU ILE NASIL ERISIYORSAK O SEKILDE ERISIRIZ...
//BU ARTIK BIR OBJEDIR COKK DIKKAT EDELIM...
echo "<br>";
echo $data_php[0]->id."<br>";
echo $data_php[0]->name."<br>";
echo $data_php[0]->surname."<br>";
echo $data_php[0]->age."<br>";

echo "<br>";
echo $data_php[1]->id."<br>";
echo $data_php[1]->name."<br>";
echo $data_php[1]->surname."<br>";
echo $data_php[1]->age."<br>";

//BURDA SUNA DIKKAT EDELIM BIZ DIREK $data_php = json_decode($my_data); BU SEKILDE ALDIK VE BIZE ARRAY ICINDE OBJE LER OLARAK VERDI PHP ICINDE
//AMA BIZ EGER ARRAY ICINDE ARRAY OLARAK ALALIM ISTERSEK PHP DE O ZAMAN DA SOYLE YAPARIZ
$my_php_data = json_decode($my_data,true);
var_dump($my_php_data);//artik bu data php de array icerisinde array lerden olusuyor

echo "<br>";
echo $my_php_data[0]["id"]."<br>";
echo $my_php_data[0]["name"]."<br>";
echo $my_php_data[0]["surname"]."<br>";
echo $my_php_data[0]["age"]."<br>";

echo "<br>";
echo $my_php_data[1]["id"]."<br>";
echo $my_php_data[1]["name"]."<br>";
echo $my_php_data[1]["surname"]."<br>";
echo $my_php_data[1]["age"]."<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	

</body>
</html>