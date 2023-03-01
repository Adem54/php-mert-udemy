<?php 
declare(strict_types=1);
class helper {

	//Burasi helper oldugu icin static olarak tanimliyoruz ve bu ssayede bu methodu class i new lemeen kullanarak bu maliyetten kurtuluyoruz ve performans olarak da kulllanim oalrak da daha kolay kulanabiliyoruz
	
	static function navigate(?string $url, ?int $time=0){
			if($time != 0){//Bir mesaj gosterip bir kac saniye sonra  yonlendireceksek de burayi kullaniriz
				header("Refresh:".$time."; url=".$url.";");
			}else{//Dogrudan yonlendirme yapacaksak
				header("Location:".$url);
			}
	}
}

?>