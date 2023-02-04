<?php 

$sql =  "SELECT * FROM TUTORIALS ORDER BY TUTORIAL_DATE";
$stmt = $db->query($sql);

//Bu cok klasik bir  yontemdir..Eger data bir bir islemden gecirilecek ise o zaman tercih edilir
//fetch aslinda eger bir sonraki var ise her calistginda next() i tetikleyerek bir sonraki datayi getiriyor...while dongusu icinde bir sonraki data bitene kadar bir sonraki datayi getirecektir....
/*
Satırların tek tek işlenmesi gerekiyorsa bu yöntem önerilebilir. Örneğin, bu tür bir işlem yapılması gereken tek işlemse veya verilerin kullanımdan önce bir şekilde önceden işlenmesi gerekiyorsa.
*/
// while ($row = $stmt->fetch()){
// 	echo "<br/>".$row["tutorial_title"];
// }


$data = $stmt->fetchAll();

// foreach ($data as  $row) {
// 	# code...
// 	echo "<br/>".$row["tutorial_content"]."<br>";
// }

//id var ise ve int e donusturulebilir ise yani direk text string y azilmasin string olacak ise de "2" bu sekilde string olsun ki biz int e donsuturebilecegimzi bilelim...tabi burda boolean degerlerinin de 1 ve 0 diye int e donusebildigini unutmayalim....
//if(isset($_GET["id"]) && is_int(intval($_GET["id"]) )){
	
	$confirm = false;
	if(isset($_GET["id"])){
			$id = $_GET["id"];
			if($id){
				
				try {
					$sql="DELETE FROM TUTORIALS WHERE tutorial_id = :tutorial_id";
					$stmt = $db->prepare($sql)->execute(["tutorial_id"=>$id]); 
					header("Refresh:1,url=index.php");
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		a{
			text-decoration: none;
		}
	</style>
</head>
<body>
	<h2>Homepage</h2>

	<a style="text-decoration: none;" href="index.php?page=insert">&nbsp;&nbsp;<button>INSERT</button></a>
	<br>
	<br>
	<?php 
	foreach ($data as $value): ?>

		&nbsp;&nbsp;
		<a style="text-decoration: none;"  href="index.php?page=tutorial_detail&id=<?php echo $value["tutorial_id"] ?> "> <?php echo $value["tutorial_title"] ?> 
		&nbsp;&nbsp;<button>Read</button>
		</a>&nbsp;&nbsp; 
		<a href="index.php?page=update&id=<?php echo $value["tutorial_id"] ?>"><button>Update</button></a>&nbsp;&nbsp; 
		<a onclick="return confirm('Are you sure you want to delete?');" href="index.php?id=<?php echo $value["tutorial_id"] ?> "><button type="button" >Delete</button></a> </br></br> 

		<?php 	endforeach; 	?>
	
<hr>

</body>
</html>