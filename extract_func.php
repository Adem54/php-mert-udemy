<?php 

//extract ile biz dizi mizin key lerini degisken olarak disarda direk kullanabiliyoruz.. 

$arr = [
	"name"=>"Adem",
	"surname"=>"Erbas",
	"email"=>"adem5434e@gmail.com"
];


extract($arr);
	echo "Adı:..$name Soyad:..$surname Email:..$email<br>";

//Adı:..Adem Soyad:..Erbas Email:..adem5434e@gmail.com



?>