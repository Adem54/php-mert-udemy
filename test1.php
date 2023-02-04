<?php 

echo "TESSTTTTTT";
$str = "5,3";
$res =  explode(",",$str);

if(in_array(5,$res)){
	echo "Yes 5 is in array";
}else {
	echo "NOOOOOOOOOOOO";
}


$layerList = [
	[
		"id"=>1,
		"name"=>"layer-1"
	],
	[
		"id"=>2,
		"name"=>"layer-2"
	],
	[
		"id"=>3,
		"name"=>"layer-3"
	],
	[
		"id"=>4,
		"name"=>"layer-4"
	]
	];

	$myIds = [];

function getIds($value){
	return $value["id"];
};

$my_res = array_map("getIds",$layerList);

echo "<br>***************************************************<br>";

$layerList2 = [
	[
		"id"=>1,
		"name"=>"layer-1"
	],
	[
		"id"=>2,
		"name"=>"layer-2"
	],
	[
		"id"=>3,
		"name"=>"layer-3"
	],
	[
		"id"=>4,
		"name"=>"layer-4"
	]
	];

$layersID = [2,4];
//Amacimiz bu id lere ait isimleri almak
$names= [];
foreach ($layerList2 as $key => $value) {
	$id = $value["id"];
	if(in_array($id,$layersID)){
		$names[]= $value["name"];
	}
}

echo (implode(",",$names));
echo "<br>***************************************************<br>";

echo array_key_last($layerList2);

?>