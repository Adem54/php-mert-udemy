<?php 

//form methoduu get olan form a datalar girilip tiklandigi zaman 
//http://localhost/test/php-mert-udemy/php-forms/form.php?name=Adem&surname=Erbas bu girilen datalar i url de 
//kullanici gorecegi sekilde gonderilir
//Ve biz bu datalari da $_GET ile alabiliriz.. 
//Get ile biz ayrica bir de header yonlendirmesi veya a link elementi ile de get -request get methodu ile sayfalar arasi
//hem yonlendirme hem de data gonderebiliriz...
//if (empty($uname)) { header("Location: index.php?error=User Name is required");
//<a href="index.php?error=User"/> bu da bir get request data gonderme islemidir	

//YANI BIZ SAYFALAR ARASI  YONLENDIRME VE DATA GONDERME ISLEMINI 
//FORM UZERINDEN POST-GET METHODU ILE
//HEADER,a link, window.location.href() uzerinden GET METHODU ILE SAYFALAR ARASI DATA GONDERME ISLEMI YAPABILIRIZ
//AYRICA SAYFALAR ARASI DATA GONDERME ISLEMINI BIZ SESSION ILE DE YAPIYORUZ BUNU DA UNUTMAYALIM....

if(isset($_GET["submit"])){
		echo "Form is submitted"."<br";
		echo "<br>".$_GET["submit"];
		print_r($_GET);
}else{
	echo "<br> Form does not send";
}

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
	<form action="" method="GET" >
		<label for="name">Name:</label>
		<input type="text" name="name"> <br><br>
		<label for="surname">Surname:</label>
		<input type="text" name="surname"> <br><br>
		<input type="hidden" name="isSubmit" value="true">
		<input type="hidden" name="submit" value="action">
		<input type="submit" value="Submit">
	</form>
</body>
</html>