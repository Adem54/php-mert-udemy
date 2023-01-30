<?php
	//Form dan data gonderilince sira ile
	//1-form submit edilmis mi bu kontrol edilir
	//2-form dan gonderilen degerler alinir ama nasil alinir validation dan gecirilerek alinir cunku burda hep sundan suphelenmeliyiz
	//gelen data space e basilip basilip gonderilmis olabilir, ya da kullanici slash e basmis ve ya html yazdi ise bu da guvenlik icin cok tehlikeli birsey  iste bu tarz olagan disi beklenemyen durumlara onlem alinmasi amaci ile bir validation dan gecirilerek bu tarz durumlardan temizleriz gelen datayi
	//3-Gelen data validatioan da gecirilince simi de gelen data nin bos olma ihtimali var cunku biz validation ile trim kullanarak gonderilen datalarin 
	//saginda solundaki bosluklari kaldirdik ve data artik tamamen bos kalmis olabilir

 //Datalar gelmis ise o zaman back-end validation yapilir
 function validate($data){

	$data = trim($data);

	$data = stripslashes($data);

	$data = htmlspecialchars($data,ENT_QUOTES);

	return $data;

}

	if(isset($_POST["submit"])){
			$name = validate($_POST["name"]);
			$surname = validate($_POST["surname"]);
			if(empty($name)){
				//Burda kullaniciya bir validation mesaji vermemiz gerekir...bu onemlidir ki ku llanicyi yonlendirmeliyiz
				//Eger farkli sayfalarda ise bizim form elemntimiz ve formdan datalari gonderigimiz sayfa farkli sayfalrda ise o zaman
				//biz kullanicya verilecek validation mesaji get-methodu ile sayfa yonlendirme ile yapararak sonra exit le orda bitiririz sayfayi, eger ayni sayfada isek o zaman da if-else de ki else kisminda ike echo ile bir degiskene validatioan hata mesajini atama yapariz ve sonra da o hata mesajini form icinde hangi field bos girilmis ise onun altinda o mesaji basariz...
				header("Location: index.php?error=User Name is required");
			}
			else{//Burda artik veritabanindaki data ile gonderilen data yi karsilastirip kullanici datasi uyuyor sa veritabanindaki dataya o zaman kullanici datalari session icine kaydedilir ve kullanici yonlendirmesi yapilir

			}
	}

?>


<body>
	<form action="" method="POST" >
		<label for="name">Name:</label>
		<input type="text" name="name"> <br><br>
		<label for="surname">Surname:</label>
		<input type="text" name="surname"> <br><br>

		<input type="hidden" name="submit" value="action">
		<input type="submit" value="Submit">
	</form>
</body>