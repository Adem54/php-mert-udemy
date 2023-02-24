<?php 

if(!isset($_GET['id']) || empty($_GET['id']) ){
	header("Location:index.php");
	 exit;
}
$id = $_GET['id'];

$sql = 'SELECT * FROM tutorials WHERE tutorial_id = :id ';
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

//UPDATE ISLEMINDE....AYNI MANTIK TA VALIDATION YAPMIYORUZ DIKKAT EDELIM....UPDATE ISLEMINDEKI VALIDATION IMIZ BIRAZ DAHA FARKLI..
if(isset($_POST["submit"])){
	$title = $_POST['title'] ?? $tutorial['tutorial_title'];
	$content = $_POST['content'] ?? $tutorial['tutorial_content'];
	$active = $_POST['active'] ?? 0;

	//Kullanicinin form da gonderdigi category nin array gelmesini bekliyoruz ve yine de kontrol ederiz bunu string e ceviririz tablomuzda aki categoryid alani varchar string oldugundan dolayi
	$categori_IDs = isset($_POST['category']) && is_array($_POST['category']) ? implode(',',$_POST['category']) : null;
	//BURAYA BIR DAHA DIKKAT VAR ISE ISLEME SOKUYORUZ YOK ISE NULL VER KI...HATA MESAJI VEREBILELIM...IF ICINDE KULLANARAK...MANTIK OLARAK BU

	if(!$title){
		echo "You must be fill title field";
	}elseif(!$content){
		echo "You must be fill content field";
	 }else if(!$categori_IDs){
		echo "You must choose category options field";
	 }
	 //elseif(!$active){//$active eger yok ise 0 ver diyoruz ondan dolayi if-else de kullanmayacagiz onu cunku o zaman bizim eklemeize izin vermez ama biz gonderilmemis ise 0 ata diyecegiz..ve baska birseye gerek yok sadece isset ile varligini sorgulamamiz yeterlidir
	// 	echo "You must be fill content field";

	// }
	else{
		//Buraya girdi ise o zaman alanlar doldurulmus demekti ve insert islemi yapabilriz burda...
		try {
			$sql = 'UPDATE tutorials SET tutorial_title = :tutorial_title,tutorial_content = :tutorial_content ,
			tutorial_active = :tutorial_active, category_id = :category_id where tutorial_id = :id';
		$query = $db->prepare($sql);
		$res = $query->execute([
			':tutorial_title'=>$title,
			':tutorial_content'=>$content,
			':tutorial_active'=>$active,
			':category_id' =>$categori_IDs,
			':id'=>$id
		]);
		if($res){
			echo "You updated your data successfullly";
		   header("Location:index.php?page=read&id=".$id);
			//header("Refresh:1,url=index.php");	
		}
		} catch (PDOException $e) {
			echo $e->getMessage();
			// print_r($query->erorInfo()[2]);
		}
	}
}


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
	<h3>Update!</h3>

	<form action="" method="POST">
		<label for="title">Title:</label><br>
		<input type="text" id="title" name="title" value="<?php echo isset($_POST['tutorial_title']) ? $_POST['tutorial_title'] : $tutorial['tutorial_title'];   ?>" > <br><br>
		<label for="content">Content:</label><br>
		<textarea name="content" id="content" cols="30" rows="10"><?php echo isset($_POST['tutorial_content']) ? $_POST['tutorial_content'] : $tutorial['tutorial_content'];  ?></textarea> <br><br>
		
		Categories: <br>
		<select name="category[]" id="category" style="width: 100px;" multiple size="5" >
		<!-- 	<option value="">--  choose category --</option>bunu verdik form eger kategori secilmmeden gonderilirse o zaman bu bos value li category gider ve deger bos string olur ve bu sekilde kategory girilmedgini de anlamis oluruz... -->
			<?php foreach($categories as $category): ?>
				<?php echo $category['categori_id']."<br>";?>
				<?php echo $tutorial['category_id']."<br>";?>
				<!-- burasi 1 tane tutorial a ait bir data dir ve tutorial id get methodu ile gelir ve biz de o sekilde get tutorial data sini aliriz ve tutorial data sindan da tutorial a ait category id lerini string olarak aliriz ve categories leri loop la dondururken de her bir dongu de tutorial icindeki category icinde hangi kategoriler var ise selected attributunu ver yok ise bos birak deriz ki var olan category ler selected olarak kullanici karsisina ciksin.... -->
				<option <?php echo in_array(strval($category['categori_id']), explode(",",$tutorial['category_id'])) ? "selected" : ""; ?>   value="<?php echo $category['categori_id'] ;?>"> <?php echo $category['category_name'];?></option>

			<?php endforeach;?>
		</select>
		<br><br>
		<select name="active" id="active">
			<option <?php echo $tutorial['tutorial_active'] == 1 ? 'selected' :''; ?>  value="1">Active</option>
			<option <?php echo $tutorial['tutorial_active'] == 0 ? 'selected' :''; ?>  value="0">UActive</option>
		</select>
		<br><br>
		<input type="hidden" name="submit" value="action">
		<button type="submit">Update</button>

	</form>
</body>
</html>