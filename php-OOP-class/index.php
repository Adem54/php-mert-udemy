<?php 
declare(strict_types=1);
//class lar cok onemlidir .. 
//Daha anlasilir bir yapi olusturmak acisindan cok harika kullanimlar ortaya cikarabiliriz.. 

//public- erisime acik
//protected- kendi sinifi ve o sinifi inherit eden yani subclass lar tarafindan kullanilabilirken diger siniflar tarafaindan kullanilamazlar
//private sadece kendi icinde kullanilabilir 



class Person {
	public ?string $firstname = "Zehra";
	private ?string $name;
	private ?string $surname;
	private ?int $age;

	public function __construct()
	{
		
	}

//Encapsulation yapiyoruz ve direk dogrudan bizim burdaki degiskenlerimizi degistirme firsati vermiyoruz ve istedgimiz herhangi bir sinirlandirma getirebiliriz artik disardaki kullanicilar icin, setName icerisinde yazacagimz kosula uymak zorundalar artik...	
public function setName($str):void{
	//Encapsulation 
	$this->name = $str;
}

public function getName():string {
	return $this->name;
}

}

$person  =  new Person();
$person->setName("Adem");
echo $person->getName();//Adem 
echo "<br>";
//echo $person->name;//Erisemeyiz private tanimli oldugu icin


class Employee extends Person {

	private ?float $salary;

	public function __construct()
	{
		
	}

	public function getInfo(){
		echo $this->firstname." ". $this->getName();
	}

}

$employee =  new Employee();


?>