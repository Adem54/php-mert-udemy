<?php 

try {
$db = new PDO("mysql:host=localhost;dbname=testdb;","root","");

} catch (PDOException $e) {
	echo $e->getMessage();
}
?>