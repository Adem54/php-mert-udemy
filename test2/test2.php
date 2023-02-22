<?php

echo  "TEst2 <br>";

//rmdir("test1");
// mkdir("test1/small");

// $test = "";

// $test2="save";

// $res = $test ?? "None";

// $test2 = !empty($test) ? $test : $test2;

// echo $test2;

// $db = new PDO("mysql:host=localhost;dbname=testdb","root","");

// $sql = "SELECT * FROM TUTORIALS";
// $tutorials = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// //print_r($tutorials); DELETE MULTIPLE ROWS WITH IN OPERATOR-1- WITH  ?? PREPARED
// $ids=array(42,45);
// $result = array_fill(0,count($ids),"?");
// $result = implode(",",$result);

// echo $result;
// echo "<br>";

// //Burdaki string icinde php degisken kullanmaya bakabiliriz... 
// $sql = "DELETE FROM TUTORIALS where tutorial_id  IN (".$result.")";
// echo $sql;

// $query = $db->prepare($sql);
// $query->execute($ids);
// echo $query->rowCount()."  deleted";
// echo $result;

/*
 DELETE MULTIPLE ROWS WITH IN OPERATOR-2- WITH  NAMED PLACEHOLDER
using in operator in order to delete multiple rows... with named placeholder
$values = array(":val1"=>"value1", ":val2"=>"value2", ":val2"=>"value3");
$statement = 'SELECT * FROM <table> WHERE `column` in(:'.implode(', :',array_keys($values)).')';

using ??
$values = array("value1", "value2", "value3");
$statement = 'SELECT * FROM <table> WHERE `column` in('.trim(str_repeat(', ?', count($values)), ', ').')';

*/
//DELETE MULTIPLE ROWS WITH IN OPERATOR-3- WITH  FOREACH
// $sql_delete = "DELETE FROM TUTORIALS WHERE tutorial_id = :id";
// $query = $db->prepare($sql_delete);

// foreach ($ids as $value) {
// 	$query->execute([":id"=>$value]);
// 	if($query->rowCount()){
// 		echo "<br>Deleted successfuullly<br>";
// 	}
// }

echo "TEST2";
rmdir("test1/small");

?>