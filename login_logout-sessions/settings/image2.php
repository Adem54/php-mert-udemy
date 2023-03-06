<?php 



//Once burda kullanici girisi kontrol edilecek her zaman ki gibi
require_once("../config/dbConnection.php");
require_once("../template/header.php");
require_once("../config/class.upload.php");


//Ilk once kullanici girisini sorgulariz eger girisi yok ise kullanicinin o zaman register sayfasina yonlendiririz kullaniciyi
if(!$session_manager->checkSessionDataExistInDb()){

	helper::navigate("../operations/login.php");
	die();
}

$user_info = $session_manager->userInfo();

$messages = ["error"=>"","success"=>""];

// var_dump($_FILES);
//1.si input type i file olan ve de name olarak da file verdigmiz icin $_FILES["file"] file olarak gelecektir... 

//First-1- check if user submit form
if($_FILES){
//2- check if user choose a file
	$image = $_FILES["image"];
	
	if($image["name"] !== ""){ 
		$foo = new Upload($image); 
	
		if($foo->uploaded) {
			echo "UPLOAD:";
			$messages["success"] = "You choosed your file";
		}else{
			$messages["error"] = "Please choose your file";
		}

		if(is_uploaded_file($image["tmp_name"])){
			echo "You uploaded your file....";
		}
	}

   // save uploaded i

	// if($_FILES["file"]["error"] === 4){//if user does not choose any file, then error comes 4 , if not error comes 0
	// 	$messages["error"] = "Please choose your file";
	// }else{//Ok form submitted and user choosed the any file if we are here
	// 	//3-Dosya gecici alana gelmis mi yani yuklenmis mi, kullanici secmistir ama dosya farkli sebeplerden gecici alana gelmemis olabilir
	// 	//Burasi gecici bolge, server ile client arasi bir bolge burasi..Burda biz daha dosyayi server a yuklememis iken eger dosya turu veya size ile ilgili validation yapacaksak iste burda yapalim ki uygun olmayan dosyayi gereksiz yere server a gondermemis oluruz... 
	// 	if(is_uploaded_file($_FILES["file"]["tmp_name"])){

	// 		//Bizim kabul ettigmiz dosya turlerini type larini mime type larin i yaziyoruz burda ki bunlar arasinda mi degil mi diye kontrol edebilelim
	// 			$valid_file_extentions=[
	// 				"image/jpeg",
	// 				"image/png",
	// 				"image/gif"
	// 		];
	// 		//4-check file type- validation
	// 		if(in_array($_FILES["file"]["type"],$valid_file_extentions)){
	// 			$valid_file_size=(1024*1024*3);//Maksimum 3 mg lik bir dosya yukleyebilsin kullanici..byte cinsinden 3 gb
	// 			//5-check file size-validation
	// 			if($_FILES["file"]["size"] <= $valid_file_size) {
	// 					$filename = $_FILES["file"]["name"];
	// 					$filePathInfo = pathinfo($filename);
	// 					$file_ext = $filePathInfo["extension"];
	// 					$name = $filePathInfo["filename"];
	// 					//Biz uniq-name uretme islemini 2 farkli sekilde yaptik asagida..... 
	// 					$new_file_name = md5($name)."_".$name.".".$file_ext;
	// 					$new_file_name2 = uniqid("",true)."_".$name.".".$file_ext;
	// 					//echo $new_file_name2;
						
	// 					//Artik dosya ismimizde olusturdugumuza gore dosyayi server a yukleyebiliriz ve dosya ismini de veritabanina kaydedebliriz
	// 				$upload = null;	
	// 					if(is_dir("images")){
						
	// 						if(file_exists("images/".$new_file_name)){
	// 							$messages["error"] = "Your file is already exist..";
								
	// 						}else{
	// 							$upload = move_uploaded_file($_FILES["file"]["tmp_name"],"./images/".$new_file_name);
	// 						}
	// 					}else{
	// 						mkdir("images");
	// 						$upload = move_uploaded_file($_FILES["file"]["tmp_name"],"./images/".$new_file_name);
	// 					}
						
	// 					if($upload){
	// 						$messages["success"] = "You uploaded your file successfully";
	// 						$sql = "UPDATE TESTDB.USER SET image=:image where id=:id";
	// 						$query = $connection->db->prepare($sql);
	// 						$query->execute([
	// 							":image"=>$new_file_name2,
	// 							":id"=>$user_info["id"]
	// 						]);
	// 						if($query->rowCount()){
	// 							$messages["success"] = "You save your files name in database successfully";
	// 						}else{
	// 							$messages["error"] = "You don't save your files name in database successfully";
	// 						}
	// 					}
					
	// 			}else{

	// 				$messages["error"] = "You can not upload file that is bigger then 3gb";
	// 			}
	// 		}else{
	// 			$messages["error"] = "Your file type is not valid";
	// 		}
	// 	}
	// }

}

?>
<h3> <?php echo isset($messages["error"]) ? $messages["error"] : "" ?> </h3>
<h3> <?php echo isset($messages["success"]) ? $messages["success"] : "" ?> </h3>
<form action="" method="post" enctype="multipart/form-data" >

<div class="form">
	<span>Choose image</span>
	<input type="file" name="image">
</div>
<div class="class">
	<input type="hidden" name="act" value="submit">
	<button type="submit">Upload-image</button>
</div>

</form>