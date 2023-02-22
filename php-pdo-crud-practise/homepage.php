
<!-- //Biz bu sayfada arama islemi yapmak istiyoruz.....
//Butona tiklayinca search box a girilen degerin veritabaninda tutorial_title ve tutorial_content te aranmasini ve bulunanlarin sadece sayfamizda bulunmasini istiyoruz..... 
//Biz butona tiklayinca data larimizi server a gonderecek isek ve bu datalar da private-ozel datalar degil ise o zaman biz bunlari get request ile gonderebiliriz demektir...  -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>
<br><br>
<form action="" method="GET">
	<input type="text" class="datepicker" name="start_date" placeholder="start-date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : '';  ?>">
	<input type="text" class="datepicker" name="end_date" placeholder="end-date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : '';  ?>">
	<br><br>
	<input name="search" placholder="Search tutorials" type="text" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '';  ?>" >
	<input type="submit" value="Search">
	<input type="hidden" name="act">
</form>
<!--
	BESTPRACTSISE...COOOOOOK ONEMLI
  Bestpractise...Cok dikkat etmeliyiz....PHP DE VERITABANINDA BIZ DATETIME DA KI DATE FORMATIMIZ NASIL ISE JAVASCRIPTTE DE O HALE GETIRIP GET methodu ile form uzerinden datamizi gonderiyrouz ki tekrar bir de php de date-formatlama isi ile ugrasmamak icin....Ama islem yapabilmemiz icin veritabaninda date formati nasil ise...biz de o formata cevirdikten sonra date lerimiz sql sorgularimiz icerisinde kullaniriz....


 -->


<?php 



/*
		'tutorial_id' => int 41
      'tutorial_title' => string 'Variables' (length=9)
      'tutorial_content' => string 'Decleration of variables' (length=24)
      'category_name' => string 'CSharp' (length=6)
*/
try {

	$search = "";
	if(isset($_GET['act'])){//bos degil ise dersek o zaman eger herhangi bir string yok ise
		
		//Bu sekilde yaptiktan sonra da $search bos tring dee olabilir...
		//Eger bos string degil ise kullaniriz bos ise de zaten arama yapamaaz...datayi hic filtrelemeden getirecektir...
		$search = $_GET['search'];
		$start_date = $_GET["start_date"];
		$end_date = $_GET["end_date"];
		echo $start_date . " <br>  " . $end_date;
	}
//Simdi biz veritabanimizda filtreleme islemi yapacagiz dolayisi ile filtreleme isleminde where icinde aralara and koyarak tum filtrelemer yapilir ve biz bu islemi dinamik ve yeni filtreleme ler ile buyutulmeye hazir bir sekilde yapacagiz ki yeni filtreleme islemleri geldiginde buna karsilik verebilelim... 

//DIKKAT EDELIM...SQL SORGUSU ZATEN STRING DIR VE ICERISINDE AYRI BIR STRING KULLANILMASI GEREKIYOR...LIKE...ILE SPESIFIK KELIME VE IFADELER ARANDIGI ZAMAN...BU TARZ SQL SORGUSUNU BIR DEGISKENE ATADIGIMIZ ZAMANLARDA COK DIKKAT ETMLELIYIZ CUNKU EGER SQL SORGUSUNU BITISIK VS YAZARSAK HATA ALIRIZ ZATEN... 
//$where[] = ' tutorials.tutorial_date BETWEEN  "'.$start_date. '"  AND "'.$end_date. '" ';

//GUVENLIK ICIN..INDEX.PHP DE CUNKU BU GET ISLEMI HOMEPAGE DE YAPILIYIOR HOMEPAGE DE INDEX.PHP DEN YONLENDIRILIYOR...
//ASAGIDAKI ISLEMLER ILE BIZ KULLANICIDAN GELME IHTIMALI OLAN BIR SIZMA GIRISMI SQL INJECTION YANI KULLANICININ STRING ICINDE SQL KODUMUZA MUDAHELE ETME GIRISIMINI ONLEMIS OLURUZ GELEBILECEK HTML KARAKTERLERINI ARTIK STRING OLARAK ALGILA DEMIS OLACAGIZ.. 
/*
	$_GET = array_map(function($get){
		return htmlspecialchars(trim($get));
	},$_GET);
*/

//BIRDEN FAZLA FILTRELEME KRITERI OLDUGUNDA VE KULLANICININ HANGI FILTRELEMELER I SECECEGININ DEGISME IHTIMALININ OLDUGU DURUMLAR ICIN DINAMIK, SURDURULEBLIR, YENI KRITERLERI EKLEMEYE HER ZAMAN UYGYN BIR YAKLASIM ICIN HARIKA BIR BESTPRACTISE DIR BU YAPACAGIMIZ ISLEM...BU MANTIGI COK IYI OGRENIP UYGULAMALIYIZ....LEVEL I BIR ADIM YUKARI ATLAYABILIRIZ... 
//EGER ARAMA VAR ISE YANI KULLANICI BURAYA DEGER GIRIP DE O DEGERI GONDER MIS ISE O ZAMAN O FILTRELEME SQL SORGUSU STRING KISMINI $where dizi icerisine at diyecegiz
$where = [];

	$sql = 'SELECT tutorials.tutorial_id,tutorials.tutorial_title,tutorials.tutorial_content,tutorials.tutorial_active, categories.category_name FROM tutorials inner join categories on tutorials.category_id=categories.categori_id ';
	if(isset($_GET['search']) && !empty($_GET['search'])) $where[] = ' (tutorials.tutorial_title LIKE "%'.$search.'%" || tutorials.tutorial_content LIKE "%'.$search.'%" )';

	if(isset($start_date) && !empty($start_date) && isset($end_date) && !empty($end_date) ) $where[] = ' tutorials.tutorial_date BETWEEN  "'.$start_date. ' 00.00.00"  AND "'.$end_date. ' 23.59.59" ';
	//filtreleme kriterlerini $where dizisiz icerisine kullanicinin gondermesi durumunda ekliyruz ve $where i eklerken de once bir $where dizisi icinde deger varmi onu kontrol ederiz...Eger var ise o zaman sql sorgusuna bunu dahil et diyecegiz...
	
	if(count($where) > 0) $sql .= " WHERE ". implode(" && ", $where);


	$sql .= ' ORDER BY tutorials.tutorial_id DESC';

	echo $sql;
	$tutorials = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
	echo $e->getMessage();
}

//Tek data alacaksak id verip o zaman fetchAll degil de fetch dememiz yeterlidir

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
	<h3>Homepage</h3>

	<h4>Tutorial List</h4>
	<ul>
		<?php 
		if($tutorials):
		foreach($tutorials as $tutorial): ?>
			<li style="display:inline-block;">  <?php echo $tutorial['tutorial_title']. " - (". $tutorial['category_name'].")"; ?>  </li>
			<?php if($tutorial['tutorial_active'] === 1) :?> 		<!--Eger active 1 ise data detayini gosterecegiz y oksa gostermeyecegiz -->
			
		<div>
				<a href="<?php echo 'index.php?page=read&id='.$tutorial['tutorial_id']  ?>"> <button>Tutorial Detail(Read)</button></a>
			
			<?php endif;?>
			<a href="<?php echo 'index.php?page=update&id='.$tutorial['tutorial_id']  ?>"><button>Update

			</button></a>
	<a href="<?php echo 'index.php?page=delete&id='.$tutorial['tutorial_id'];  ?>"><button>Delete</button></a>
		</div>
			<br>
		<?php	endforeach; 
		else: 	?>
			<?php if(isset($_GET["search"])) {  # arama yapilmis ama yapilan aramaya uyan data yok ise o zaman farkli bir mesaj verelim...Birde eger gosterilecek hic data yok ise de farkli bir mesaj verilsin   ?>
				<h2>There is no data based on your searched expression to show</h2>
				<?php }else{ ?>
				<h2>There is no tutorial to show</h2>
				<?php } ?>
			
			<?php	endif; ?>			
	</ul>
	
</body>
</html>