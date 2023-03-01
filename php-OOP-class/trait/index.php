<?php 

//trait ler class larin genisletilmesine yarayan yapilardir
//Bunlari biz class lar gibi olusturuyoruz ama traitler tam bir sinif degildir


class CarMotor {}

class CarDesign {}

//class Car extends Car,CarDesign { } Bu sekilde kullanamayiz.



//Normalde biz bir class uzerinden diger class lari inherit etmek istedgimz zaman 1 tane class anak inherit edebliryourz, birden fazla class i inherit edemiyoruz..
//Ama eger bizim bir class icinde birden fazla class i kullanacak isek, birden fazla class i bir class ta inherit edemedigmiz den de dolayi o zaman kullanmak istedimgiz class lari trait yapariz ve use ile birden fazla class i inherit etmek istedigmiz class in iicnde kullanabilrizi


trait CarMotor2 {
	public function PowerOfMotor(){
		return "120 hp";
	}
};
trait CarDesign2{
	public function typeOfSeat(){
		return "Skinn seat";
	}

	public static function carColor(){
		return "Red";
	}

};

//Class olusturulurken kullanilan isimlerin aynisini trait olustururken kullanamayiz farkli isim kullanmamiz gerekir
class MyCar {

	use CarMotor2,CarDesign2;

	public function __construct()
	{
		echo	$this->PowerOfMotor();
		echo	$this->typeOfSeat();
		echo self::carColor();
	}
}


$my_car = new MyCar();
//Birden fazla ozelligi class imiz icerisinde bu sekilde acabiliriz... 

?>