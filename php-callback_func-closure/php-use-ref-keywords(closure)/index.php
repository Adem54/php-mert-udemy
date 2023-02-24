<?php 



function increment(&$i)  
{  
    $i++;  
}  
$i = 10;  
increment($i);  
echo $i;  

echo "<br>";
echo "<SENARYO-1 >";


//BURAYA DIKKAT EDELIM SIMDI..... 
//SENARYO-1 

$person = [
	"name"=>"Adem",
	"surname"=>"Erbas"

];

function change_array($person){
	$person["name"] = "Zehra";
}

change_array($person);

echo $person["name"];//Adem

//SENARYO-2
echo "<br>";
echo "<SENARYO-2 >";



$person2 = [
	"name"=>"Adem",
	"surname"=>"Erbas"

];

// & bunu $person basinda kullanigmiz icin fonksiyon invoke edilirken parametreye verilen deger in referansi ile verilecegi icin bundna sonra icerde yapilan tum degisiklikler disardan parametreye invoke ederken verilen deger artik fonskiyon icinde ki tum degisikliklerden etkilenecektir... 
function change_array2(&$person){
	$person["name"] = "Zehra";
}

change_array2($person2);

echo $person2["name"];//Zehra
?>



<?php 
echo "<br>";
echo "SENARYO-3 ";

//Burda ananom fonks icinde 2. paraemtreyi kullanabilmek icin use keywordu kullaniriz php de anonim fonks icerisidne 2. parametre bu sekilde bir syntax ile kullaniliyor.... 

$numbers = [12, 18, 5, 11, 10, 95, 3];
$factors = [2, 3, 5];
foreach($factors as $factor) {
    $multiples = array_filter($numbers, function($n) use ($factor) {
        return $n%$factor == 0;
    });
    echo "Multiples of $factor\n";
    print_r($multiples);
}


//BURDA COK ACIK ANLATILMIS...
//https://www.webcebir.com/265-php-anonim-fonksiyonlarda-closure-kapaklar-dersi.html
?>

