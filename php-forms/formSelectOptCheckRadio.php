<?php 
//print_r($_POST);
/*
{
	name: "Adem",
	surname: "Erbas",
	cars: {
		0: "toyota"
	},
	interests: {
		0: "php"
	},
	gender: "man",
	description: "This is my description."
},

*/

//NORMALDE BIZ FORMUMUZA GIRILEN DATA LARI FORM ICINDEKI FIELD DA KULLANICI FORMA SUMBIT ETTIKTEN SONRA DA KULLANICYA GOSTERMEK ICIN
//ASAGIDAKI GIBI LOGIC LER YAZARIZ...AMA TABI KI FORM INPUT LARININ ATTRIBUTE LERINDE BU KADAR UZUN ISLEMLER COK CIRKIN DURUYOR ONDAN DOLAYI BU ISLEMLERI PHP ICINDE FONKSIYONLASTIRIP KISA VE ANLAMLI ISIMLENDIRILMIS FONKSIYONLAR OLARAK KULLANIRIIZ


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
	<form action="" method="POST">
		<label for="name">Name:</label>
	<!--	<input type="text" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>" ><br><br> -->
		<input type="text" name="name" value="<?php echo $_POST["name"] ??  "" ?>" ><br><br>
		<label for="surname" >Surname:</label>
		<input type="text" name="surname" value="<?= $_POST["surname"] ?? "" ?>" ><br><br>
		<!-- attribute olan value bizim programlamada kullanacagimz deger iken text olarak etiketler arasina yazdimgz deger de kullancilara gostermek icin girilen degerdir -->
		<select name="cars[]" id="car" >
			<!-- <option  value="">--Choose a car--</option> -->
			
			<option <?php echo isset($_POST["cars"][0]) ? ($_POST["cars"][0] === "fiat") ? "selected" : "" :""  ?> value="fiat">Fiat</option>
			<option <?php echo isset($_POST["cars"][0]) ? ($_POST["cars"][0] === "ford") ? "selected" : "" :""  ?>  value="ford">Ford</option>
			<option <?php echo isset($_POST["cars"][0]) ? ($_POST["cars"][0] === "toyota") ? "selected" : "" :""  ?> value="toyota">Toyota</option>
			<option <?php echo isset($_POST["cars"][0]) ? ($_POST["cars"][0] === "mercedes") ? "selected" : "" :""  ?> value="mercedes">Mercedes</option>
		</select>
<br><br>
		<input type="checkbox" <?php echo isset($_POST["interests"]) ? (in_array("php",$_POST["interests"])) ? "checked" : "" :""  ?>   name="interests[]" value="php">PHP <br>
		<input type="checkbox" <?php echo isset($_POST["interests"]) ? (in_array("csharp",$_POST["interests"])) ? "checked" : "" :""  ?> name="interests[]" value="csharp">CSharp <br>
		<input type="checkbox" <?php echo isset($_POST["interests"]) ? (in_array("java",$_POST["interests"])) ? "checked" : "" :""  ?> name="interests[]" value="java">Java <br>
		<input  type="checkbox" <?php echo isset($_POST["interests"]) ? (in_array("javascript",$_POST["interests"])) ? "checked" : "" :""  ?> name="interests[]" value="javascript">Javascript <br>
<br><br>
<input type="radio" name="gender" <?php echo isset($_POST["gender"]) ? ($_POST["gender"] === "man") ? "checked" : "" :""  ?> value="man" >Man
<input type="radio" name="gender" <?php echo isset($_POST["gender"]) ? ($_POST["gender"] === "woman") ? "checked" : "" :""  ?> value="woman" >Women
<br><br>

<!-- textarea da etikletlerin acilis kapanis etiketleri ayni satir da olmalari imlecin durdugu yeri etkiliyor..onemli...-->
<textarea rows="8" cols="40" placeholder="textarea" name="description" ><?php echo $_POST["description"] ??  "" ?></textarea>
<br><br>

<input type="submit" value="Submit">
	</form>
</body>
</html>