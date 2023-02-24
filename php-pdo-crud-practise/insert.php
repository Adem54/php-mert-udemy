<?php 

//1.Once form gondreilmis mi onu kontrol et hidden type li input uzerinden
//2.Ardindan da her bir alan icin eger var ise gelen degeri al yok ise null atamasi yap ki if sorgularinda supriz yasamadan false olarak alablelim
if(isset($_POST["submit"])){
	$title = $_POST['title'] ?? null;
	$content = $_POST['content'] ?? null;
	$active = $_POST['active'] ?? 0;
	
	

	//Single option durumunda
	//Eger multiple degil de single option sectirecek isek o zaman select attributunde name='category' yapariz indexer, yani koseli parantez koynmadan onune ve de zaten secilen option id si string olarak gelecegi icin oyle bir durumda normal diger inputlardas ypatimgiz gibi yapariz
	//$category_id = $_POST['category'] ?? null;
	//MULTIPLE OPTIONS
	//BURDA FARKLI BIR DURUM ILE KARSI KARSIYAYIZ...DIZI OLARAK ID LER GELIYOR VE BIZ BUNLARI VERITABANINA DIZI OLARAK KAYDEDEMEYIZ, PEKI NASIL KAYDEDECEGIZ....EGER DIZI OLARAK GELMIS ISE O ZAMAN BIZ ONU STRINGE CEVIRIP ARALARINA VIRGUL KOYARAK KAYDEDECEGIZ.... 
	
	$categori_IDs = isset($_POST['category']) && is_array($_POST['category']) ? implode(',',$_POST['category']) : null;
	//$categori_IDs = $_POST['category'] ??  null;	
	


	if(!$title){
		echo "You must be fill title field";
	}elseif(!$content){
		echo "You must be fill content field";
	 }
	 //elseif(!$active){//$active eger yok ise 0 ver diyoruz ondan dolayi if-else de kullanmayacagiz onu cunku o zaman bizim eklemeize izin vermez ama biz gonderilmemis ise 0 ata diyecegiz..ve baska birseye gerek yok sadece isset ile varligini sorgulamamiz yeterlidir
	// 	echo "You must be fill content field";

	// }
	else{
		//Buraya girdi ise o zaman alanlar doldurulmus demekti ve insert islemi yapabilriz burda...
		try {
			$sql = 'INSERT INTO tutorials (tutorial_title,tutorial_content,tutorial_active,category_id) VALUES(:tutorial_title,:tutorial_content,:tutorial_active, :category_id)';
		$query = $db->prepare($sql);
		$res = $query->execute([
			':tutorial_title'=>$title,
			':tutorial_content'=>$content,
			':tutorial_active'=>$active,
			':category_id'=>$categori_IDs
		
		]);

		$last_insert_id = $db->lastInsertId();

		if($res){
		//	header("Location:index.php");
			header("Location:index.php?page=read&id=".$last_insert_id);
		}
		} catch (PDOException $e) {
			echo $e->getMessage();
			print_r($query->erorInfo()[2]);
		}
	}
}

//BIZ NEDEN ORNEGIN FORM ICINDEKI INPUT ALANLARININ VALUE LERINE FORM ICINE GIRILEN VE SUBMIT EDILEN DATALAR VAR ISE VALUE LERE NEDEN O DATAYI $_POST uzerinden alip value de basiyoruz..CUNKU...kullanici ornegin alanlardan 1 ini giriyor digerlerini girmeyip submit yapiyor ve girmedigi alanlar ile ilgili uyari mesaji alir ancak, eger biz girdigi alanin value sine girdigi deger i basmaz isek o zaman submite tiklaip sayfay yenilendigi icin girdigi deger ucar ve bu da cok kotu bir bestpractise olur...KULLANICININ GIRDIGI DEGERIN UCMASINI ISTEMIYHORUZ.....


try {	
	$sql_categories = "SELECT * FROM categories ORDER BY category_name ASC";
	$categories = $db->query($sql_categories)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	 echo $e->getMessage();
}



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

	<form action="" method="POST">
		<label for="title">Title:</label><br>
		<input type="text" id="title" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] :''  ?>" > <br><br>
		<label for="content">Content:</label><br>
		<textarea name="content" id="content" cols="30" rows="10"><?php echo isset($_POST['content']) ? $_POST['content'] :''  ?></textarea> 
		<br><br>
		Categories: <br>
		<select name="category[]" id="category" style="width: 100px;" multiple >
		<!-- 	<option value="">--  choose category --</option>bunu verdik form eger kategori secilmmeden gonderilirse o zaman bu bos value li category gider ve deger bos string olur ve bu sekilde kategory girilmedgini de anlamis oluruz... -->
			<?php foreach($categories as $category): ?>
				<option value="<?php echo $category['categori_id'];?>"> <?php echo $category['category_name'];?></option>
			<?php endforeach;?>
		</select>
		<br><br>
	
		<select name="active" id="active"  >
			<option value="1">Active</option>
			<option value="0">UActive</option>
		</select>
		<br><br>
		<input type="hidden" name="submit" value="action">
		<button type="submit">Submit</button>
	</form>
</body>
</html>

<!--
		<select name="category[]" id="category" style="width: 100px;" multiple >
			<option value="">--  choose category --</option> 
			<?php foreach($categories as $category): ?>
				<option value="<?php echo $category['categori_id'];?>"> <?php echo $category['category_name'];?></option>
			<?php endforeach;?>
		</select>


			$categori_IDs = isset($_POST['category']) && is_array($_POST['category']) ? implode(',',$_POST['category']) : null;
-->