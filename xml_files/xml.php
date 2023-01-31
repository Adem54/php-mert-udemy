<?php 

//xml den gelen verinin parcalanip ekrana bastirilmasi

$xml_str = 
"<users>
<user>
	<name>Adem</name>
	<surname>Erbas</surname>
	<age>35</age>
</user>
<user>
	<name>Zehra</name>
	<surname>Erbas</surname>
	<age>9</age>
</user>
<user>
	<name>Zeynep</name>
	<surname>Erbas</surname>
	<age>35</age>
</user>

</users>";

$xml2 = simplexml_load_string($xml_str);
var_dump($xml2);

$xml = new SimpleXMLElement($xml_str);

var_dump($xml);//obje icinde array icerisinde objeler olarak bize verdi bu veriyi

echo $xml->user[0]->name;
echo $xml->user[0]->surname;
echo $xml->user[0]->age;
echo "<br>";
echo $xml->user[1]->name;
echo $xml->user[1]->surname;
echo $xml->user[1]->age;
echo "<br>";
echo $xml->user[2]->name;
echo $xml->user[2]->surname;
echo $xml->user[2]->age;

//Eger bir xml dosyasindan xml verilerini php de almak istersek
$my_xml = simplexml_load_file("text.xml");
var_dump($my_xml);//Burda da yine obje icinde array icinde objelereden olusan php datasi geliyor

echo $my_xml->user[0]->name;
echo $my_xml->user[0]->surname;
echo $my_xml->user[0]->age;
echo "<br>";
echo $my_xml ->user[1]->name;
echo $my_xml ->user[1]->surname;
echo $my_xml->user[1]->age;
echo "<br>";
echo $my_xml->user[2]->name;
echo $my_xml->user[2]->surname;
echo $my_xml->user[2]->age;


echo "<br> xml den php ye cevirdgmiz datayi foreach ile alma <br>";
//xml dokumanimizdaki tum 
//Biz foreach ile $xml data mizi dondurebiliirz 

foreach ($xml->xpath("//user") as $user) {
	# code...
	echo "<br>";
	echo $user->name;
}

?>