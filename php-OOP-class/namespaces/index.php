<?php 

require_once("namespace.php");
require_once("namespace2.php");

//Ayni isimde 2 tane class imiz var su anda..

$first_class1 = new namespace\first\first_class();
$first_class2 = new namespace\second\first_class();

$first_class1->hello();
$first_class2->hello();
echo "<br>******************* <br>";
$first_class1::hello();//static oldugu icin bu sekilde cagirabiliriz 
$first_class2::hello();
?>