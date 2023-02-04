<?php 
//db connection



try {
	$db = new PDO("mysql:host=localhost;dbname=testdb","root","");
	// echo "Successfull connection";
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>