
<br><br>
<a href="index.php?page=add_category"><button>Add New Category</button></a>
<?php 
//categories.* tum categorileri getir demektir.. 
//select categories.*, count(tutorials.tutorial_id) from categories left join tutorials on categories.categori_id = tutorials.category_id 
 //GROUP BY categories.categori_id;
//Bu sekilde her bir kategori bilgisi ve karsisinda kac tane tutorial a sahip bunu alabiliyoruz.... 
//Artik kategorilerimizn yanina kac tane ders bu kategoriye sahip onu yazdirabiliyoruzl..

//PEKI KATEGORILERIMIZ ICERISINDE HER BIR KATEGORIMIZE AIT, TUTORIAL LARI NASIL ALIRIZ...ISTE BURASI COOK ONEMLI...
//TUTORIALS ICINDE KATEGORILERIMIZI category_id ile "1,3,4" seklinde string olarak tutuyoruz o zaman da join isleminde category tablosunda categori_id int- den tutorials icindeki categoyry_id "1,3,4" icerisinde deger var mi onu check edecegiz artik cunku 
//ON CATEGORIES.categori_id=TUTORIALS.category_id  esitledigmiz her iki deger de integer iken bu islemde hic bir sorun yok ancak artik
// CATEGORIES.categori_id integer iken 
//TUTORIALS.category_id "1,3,5" gibi bir string olarak tutuluyor 
//O ZAMAN biz CATEGORIES.categori_id int degeri TUTORIALS.category_id "1,3,4" icinde olan categorileri bul diyecegiz ve sayilarini al diyecegiz
try {
	$sql = "SELECT CATEGORIES.*, COUNT(TUTORIALS.tutorial_id) as countOfTutorial FROM CATEGORIES left join TUTORIALS ON  FIND_IN_SET(CATEGORIES.categori_id , TUTORIALS.category_id )
	GROUP BY CATEGORIES.categori_id  ORDER BY CATEGORIES.categori_id DESC";
	$categories = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	

} catch (PDOException $e) {
	echo $e->getMessage();
}
//SIMDI KARGEGORILERIMIZ BIZIM TUTORIALS ICERISINDE VARCHAR- YANI STRING SEKLINDE ARALARINDA VIRGUL OLACAK SEKILDE BIRDEN FAZLA ID OLARAK TUTUYORUZ ANCAK  BIR SORUNUMUZ VAR...KATEGORILERI KAC TANE TUTORIALS ICINDE KULLANILDIKLARINA GORE NUMARALARINI VEREREK LISTELIYORUZ...

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
	<h3>Categories</h3>

	<?php  	if($categories): ?>
		
		<?php foreach ($categories as $category) :?>
			<li>
				<a style="text-decoration:none; color:black;" href="index.php?page=category&id=<?php echo $category['categori_id'];?>"> 
					<?php echo $category['category_name']." - (".$category['countOfTutorial'].")";?>
				</a>
			</li>
		
		<?php endforeach;?>

	<?php else:?>
		<h3>There is no category to show!</h3>
	<?php endif; ?>
</body>
</html>

<!--
Categories listesini yazdirdgimz sayfada her bir kategoriye ait kac tutorial bulunyor onun ile birlikte yazdirdik(Group by ile)
Ayrica birde kategori listesindeki bir kategori ye tiklandigi zaman o kategoriye ait..tutorials lari gostermek istiyruz..yani kategori detayini da gostermek istiyoruz

 -->