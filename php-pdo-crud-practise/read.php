<?php 
//BU ISLEM PHP NIN EN ONEMLI NOKTASIDIR..YANI BUNU YAPMAZSAN O KADAR UGRASIP EMEK ETTIGIN PROJEN COP OLUR...YANI KONTROLLER...KONTROLLERI YAPMADIGIN ZAMAN GUVENDE OLAMAZSIN...KULLANICI BUTONA TIKLAYARAK DEGIL DE GITTI ADRES CUBUGUNDAN SACMA SAPAN BIR ID GIRIP GELIRSE BUNUNLA NASIL BAS EDECEGIZ ISTE BU SEKIKILDE MADEM SEN BENDE OLMAYAN BIR ID ILE GELIYORSUN O ZAMAN ANA SAYFAYA GIT DIYECEGTIZ...NE ZAMAN KI BENDE OLAN BIR ID ILE GELIRSEN O ZAMAN DATLAARIN DETAYINI GORURUSUN DEMIS OLURUZ....YOKSA OBUR TURLU...SISTEM PATLAR...
if(!isset($_GET['id']) || empty($_GET['id']) ){
	header("Location:index.php");
	 exit;
}
$id = $_GET['id'];

$sql = 'SELECT * FROM tutorials WHERE tutorial_id = :id && tutorial_active = 1';
$query = $db->prepare($sql);
$query->execute([
	':id'=>$id
]);
$tutorial = $query->fetch(PDO::FETCH_ASSOC);

//Eger $tutorial icinde data yok ise o zaman da sayfayai ana sayfaya yonlendirecegiz...
if(!$tutorial){
	header("Location:index.php");
	 exit;
}

/*
ASAGIDAKI KRITERLERIN HEPSINI KOTROL EDEREK HEPSI ILE ILGILI ONLEMLERIMIZI ALMALIYIZ KI ZATEN BIZ BUNUN ICIN UYGULAMA YAZIYORUZ HERSEY YOLUNDA GIDERSE ZATEN BIZE YAPACAK IS KALMIYOR O ZAMAN
BIRDE BIZ KULLANICI ORNEGIN ADRES CUBUGUNDAN SACMA SAPAN BIR DEGER GIRDI ID YERINE, BIZ BU ALTERNATIFLERIN HEPSINI HESAP ETMEK BIZIM ASLI ISIMIZDIR...BUNU UNUTMAYALIM....
1-Id hic gonderilmedi ise
2-Id bos gonderildi ise
3-Id bizde var olan id ler arasinda bulunmuyor ise.. 
*/

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
	
	<h3>Read-tutorial detail page</h3>

	<ul>
		<?php if(!$tutorial):  ?>
		<h3>Thre is no data</h3>
		<?php else:  ?>
				<li><?php echo $tutorial['tutorial_title'];?> </li>		
				<li><?php echo $tutorial['tutorial_content'];?> </li>		
				<li><?php echo $tutorial['tutorial_date'];?> </li>		
		<?php endif;?>	
		
	</ul>
</body>
</html>