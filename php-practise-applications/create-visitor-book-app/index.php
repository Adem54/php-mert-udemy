<?php
echo "<h5>Visitor book</h5>";
//Oncelikle veritabanimizda yeni bir tablo olusturalim...
//Sunu kafamiza koyalim, bizim nasil yapiliyor diye dusunudugmuz hersey veritabanina kaydedilip ordan gelen data kaydedilerek efektife islemler yapilabiliyor bunu bir anlayalim.. 
//notebook isminde bir tablo olusturalim testdb veritabaninda
/*
 CREATE TABLE NOTEBOOK (
id int(11) not null primary key auto_increment,
name varchar(100),
surname varchar(100),
email varchar(100),
message text,
date TIMESTAMP NOT NULL DEFAULT current_timestamp	
 ) ENGINE=INNODB auto_increment=1 DEFAULT CHARSET=utf8mb4 ;
 
 desc notebook;
  
*/
require_once("connection.php");
$connection = new dbConnection("localhost", "testdb", "root", "");

$alert_message = [
	"error" => "",
	"success" => ""
];

if (isset($_POST["act"])) {

	//strip_tags or htmlspecialchars
	$name = htmlspecialchars(trim($_POST["name"]));
	$surname = htmlspecialchars(trim($_POST["surname"]));
	$email = htmlspecialchars(trim($_POST["email"]));
	$message = htmlspecialchars(trim($_POST["message"]));

	$result = !empty($name) && !empty($surname) && !empty($email) && !empty($message);

	if ($result) {

		$sql = "INSERT INTO NOTEBOOK (name,surname,email,message) VALUES(?,?,?,?)";
		$query = $connection->db->prepare($sql);
		$query->execute([$name, $surname, $email, $message]);

		if ($query->rowCount() > 0) {
			$alert_message["success"] = "Data added succesfully";
		} else {
			$alert_message["success"] = "Data is not added";
		}
	} else {
		$alert_message["error"] = "Please fill in the all fields";
	}
} else {
}


?>

<h2>Visitor Notebook</h2>
<?php
//Veritabanindan notebook tablosundan gelecek olan degerleri listeleyecek

$sql2 = "SELECT * FROM NOTEBOOK";
$query2 = $connection->db->query($sql2);
$notes = $query2->fetchAll(PDO::FETCH_ASSOC);
if (count($notes) > 0) { ?>

	<ul>
		<?php foreach ($notes as $note) {  ?>
			<li><?php echo $note["name"] . " - " . $surname . " - " . $note["email"]; ?> </li>
		<?php 	} ?>
	</ul>
<?php } else {
	echo "You don't have any note";
} ?>

<h3> <?php echo isset($alert_message["error"]) ? $alert_message["error"] : "" ?> </h3>
<h3> <?php echo isset($alert_message["success"]) ? $alert_message["success"] : "" ?> </h3>
<form action="" method="POST">
	<div class="form">
		<span style="display:block; margin-bottom:">Name:</span>
		<input type="text" required name="name" value="<?php echo isset($_POST["name"]) ?  $_POST["name"] : ""; ?>">
	</div>
	<br>
	<div class="form">
		<span style="display:block; margin-bottom:">Surname:</span>
		<input type="text" required name="surname" value="<?php echo isset($_POST["surname"]) ?  $_POST["surname"] : ""; ?>">
	</div>
	<br>
	<div class="form">
		<span style="display:block; margin-bottom:">Email:</span>
		<input type="text" required name="email" value="<?php echo isset($_POST["email"]) ?  $_POST["email"] : ""; ?>">
	</div>
	<br>
	<div class="form">
		<span style="display:block; margin-bottom:">Message:</span>
		<textarea name="message" required id="message" cols="30" rows="10"><?php echo isset($_POST["message"]) ?  $_POST["message"] : ""; ?></textarea>
	</div>
	<br>
	<div class="form">
		<input type="hidden" name="act" value="submit" />
		<button>Submit</button>
	</div>

</form>

<!--
1-Hem front-end hem backend validation mutlaka yapmaliyiz ve isabetli mesaj vermeliyz
2-Mutlaka htmlspecialchars veya strip_tags ile ve trims ile guvenlik icin kullanmaliyiz
3-Yazdiracagimz array- veritabanindan gelen data eger 0 a esit ise y ani basarili gelmis ama data yok ise onu da handle etmemiz gerekir yani kullaniciya uygun bir mesaj  vermeliyiz

 -->