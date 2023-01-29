<?php

//print_r($_FILES);//[ ["name"=>"map.geojson","full_path"=>"map.geojson","type"=>"application/octet-stream","C:\xampp\tmp\php56CE.tmp","error"=>"0","size"=>"3734" ] ];
// print_r($_FILES["file"]);
// print_r($_FILES["file"]["name"]);
/*
[ ["name"=>"map.geojson","full_path"=>"map.geojson","type"=>"application/octet-stream","C:\xampp\tmp\php56CE.tmp","error"=>"0","size"=>"3734" ] ];

{
file: {
name: "map.geojson",
full_path: "map.geojson",
type: "application/octet-stream",
tmp_name: "C:\xampp\tmp\php56CE.tmp",
error: "0",
size: "3734"
}
},


$_FILES icerisine data dizi olarak gelecektir ki $_FILES in kendisi de o gelen dizi datasini bir dizi icine alacagi icin dizi icinde dizi olarak aliriz biz datamizi yukarda oldugu gibi
Ve simdi burda hic ezber  yapmadan ogrenecemiz ve yapacagimiz adimlari bir mantik uzerine kurgulayalim... 
Yani biz upload islemi yaptigimizda bize hangi datalar geliyor ise biz o gelen datalari kullanarak upload islemini adim adim yoneterek kullanicya dosya yukleme isleminde bir validation uygulayabiliriz...ve de feedback donerek kullaniciyi dogru yonlendirebiliriz....


Kullanici eger herhangi bir dosya yuklemeden submit ederse o zaman da $_FILES icerisine asagidaki gibi bos bir liste gelecektir

{
	file: {
	name: "",
	full_path: "",
	type: "",
	tmp_name: "",
	error: "4",
	size: "0"
	}
},

1.ADIM
Oncelikle sunu bir farketmemiz gerekiyor kullanici herhangi bir dosya yukleyerek gonderdiginde 
error="0" gelirken kullanici herhangi bir dosya gondermeden submit ederse o zaman error="4" olarak gelecektir..  
O zaman biz kullanici bize herhangi bir dosya yukleyerek mi gondermis yok sa dosya yuklemeden mi gondermis bunu error key i uzerinden
kontrol edebiliriz....

*/
/*
if($_FILES["file"]["error"] === 4){
	echo "Please choose any file";
}else{
	print_r($_FILES);
}
*/

if($_FILES["file"]["error"] === 4){
	echo "Please choose any file";
}else{
	//print_r($_FILES);
	if(is_uploaded_file($_FILES["file"]["tmp_name"])){
		//print_r($_FILES);
		$valid_file_extentions=[
			"image/jpeg",
			"image/png",
			"image/gif"
	  ];
	  $my_file_extention=$FILES["file"]["type"];
	  if(in_array( $my_file_extention,$valid_file_extentions)){
		$valid_file_size=(1024*1024*3);//Maksimum 3 mg lik bir dosya yukleyebilsin kullanici..byte cinsinden 3 gb 
		if($valid_file_size<= $_FILES["file"]["size"]){
			$upload=move_uploaded_file($_FILES["file"]["temp_name"],"upload/");
		}
	  }

	}else{
		echo "Please choose any file";
	}
}



?>