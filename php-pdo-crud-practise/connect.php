<?php 

try {
	$db = new PDO('mysql:host=localhost;dbname=testdb','root','');
	// echo "Connected";
} catch (PDOException $e) {
	echo $e->getMessage();
}





?>