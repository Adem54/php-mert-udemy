
<br><br>
<?php 


if($_POST["act"]){
	$id = $_POST["id"];
	echo $id;
}


?>


<form action="" method="POST">
	<input type="text" name="id" placeholder="UserId">
	<input type="hidden" name="act" value="submit" >
	<button>Show</button>
</form>