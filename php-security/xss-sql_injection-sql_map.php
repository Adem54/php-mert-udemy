<?php 

//XSS- cross site scripting
//adress satirinda javascript kodlarinin calisitrilmasidir

$search = $_GET["query"];
//Kullancinin gelip url adres cubuguna <script>alert('Hello');</script>
//Boye bir kod yazarak bizim icin tehlike olusturaiblir
//Bu tarz tehlikeli durumlara onlem almak icin
//1-htmlspecialchars
//2-striptags
//3-intval

?>