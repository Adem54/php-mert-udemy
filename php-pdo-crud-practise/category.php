<?php
//Categories listesini yazdirdgimz sayfada her bir kategoriye ait kac tutorial bulunyor onun ile birlikte yazdirdik(Group by ile)
// Ayrica birde kategori listesindeki bir kategori ye tiklandigi zaman o kategoriye ait..tutorials lari gostermek istiyruz..yani kategori detayini da gostermek istiyoruz

//select categories.*, tutorials.* from (categories left join tutorials on categories.categori_id = tutorials.category_id) where categories.categori_id = 3;
if(isset($_GET['id']) && empty($_GET['id'])){
	header("Location:index.php?page=categories");
	exit;
}
echo "<br>".$_GET['id'];

$id = $_GET['id'] ?? null;
if($id){
	try{
	$sql ='select categories.*, tutorials.* from (categories left join tutorials on categories.categori_id = tutorials.category_id) where categories.categori_id = ?;';
	$query = $db->prepare($sql);
	$query->execute([$id]);
	$categoryDetails = $query->fetchAll(PDO::FETCH_ASSOC);
	if(count($categoryDetails) == 0){
		header("Location:index.php?page=categories");
		exit;
	}

	}catch(PDOException $e){
		echo $e->getMessage();
	}
}

 

?>

<ul> 
	<?php foreach($categoryDetails as $category): ?>
		<li><?php echo $category['category_name']. " / ".$category["tutorial_title"]." / ".$category['tutorial_content']; ?></li>
	<?php endforeach; ?>

</ul>
