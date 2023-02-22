<?php 



try {
	if(isset($_GET['id']) && !empty($_GET['id'])){
		$id = $_GET['id'];
		$sql_del = 'DELETE FROM	tutorials where tutorial_id=:id';
		$query = $db->prepare($sql_del);
		$query->execute([
			'id'=>$id
		]);
		if($query->rowCount()){
			echo "Data is deleted";
			header("Location:index.php");
		}
	}
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>