<?php 
declare(strict_types=1);
//class lar cok onemlidir .. 
//Daha anlasilir bir yapi olusturmak acisindan cok harika kullanimlar ortaya cikarabiliriz.. 

//public- erisime acik
//protected- kendi sinifi ve o sinifi inherit eden yani subclass lar tarafindan kullanilabilirken diger siniflar tarafaindan kullanilamazlar
//private sadece kendi icinde kullanilabilir 



class Person {
	public ?string $firstname = "Zehra";
	protected ?string $city ="Skien";

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

public function getCity():string {
	return $this->city;
}

}

$person  =  new Person();
$person->setName("Adem");
echo $person->getName();//Adem 
echo "<br>";
//echo $person->name;//Erisemeyiz private tanimli oldugu icin


class Employee extends Person {

	private ?float $salary;
	protected ?string $job = "Developer";

	//Dikkat edelim extends edilen Person icindeki public ve protected degerlere Employee nin constructor i icerisinde direk erisim saglayabiliyoruz.. 

	public function __construct()
	{
		echo "Employee constructor "."<br>";
		echo $this->city;
		echo "<br>";
	}

	public function getInfo(){
		echo $this->firstname;
	}

	//public ve protected da erisebiliyoruz ama Person icerisinde private ile belirlenen alanlara Person i miras alan class larda erisemiyor... 
	//protected olan bir degere burasi subclass oldugundan dolayi erisebiliyoruz... 
	public function getMyCity(){
		echo $this->city;
	}

}

$employee =  new Employee();
$employee->getInfo();

echo "<br>";
//Zehra
$employee->getMyCity();//bURDA HATA ALIYORUZ..BUNU CHECK ET




?>

<?php 


echo "<br>";
echo "*****************************************";
echo "<br>";

class Person2 {

	public ?string $name = "Ahmet";
	protected ?string $surname = "Kartal";

	public function getMessage():string{
		return "Hello world";
	}

	protected function getMessage2():string{
		return "Hello world2";
	}
}

class Student extends Person2 {

	public function getName(){
		return $this->name;
	}

	public function getSurname(){
		return $this->surname;
	}
}


$student1 = new Student();
echo $student1->getName();
echo "<br>";

echo $student1->getSurname();
echo "<br>";
//Direk disardan dogrudan erismeye calisirsak erisemiyourz protected a dikkat edelim....Yani protectede disardan dogrudan erismeeyiz ancak ve ancak, subclass icinden erisebilirz...Ama biz sunu biliyoruz... bir class i inherit eden diger class lar disardan o inherit ettikleri class icindeki public olan fieldlara subclass tan instance olusturup direk base class a ait puclic fieldlara erisebilir ama bu durum inherit ettigi base classs inda bulunan private ve protected alanlar icin boyle degildir.. Protected alanlara ise kendi class i icerisinden $this ile erisebilirz...ancak ama direk disarda newlenip de referans tutucuya atandiktan sonra ordan direk protected olan degere erisemiyorz...o classs i inherit etmis ise bile
echo $student1->name;
//echo $student1->surname;//protected surname in Person2 class--get error
echo "<br>";

echo $student1->getMessage();//Hello world
echo "<br>";

echo $student1->getMessage2();
//Disardan base-class ina ait public fieldlara erisebilirken protected olan alanlara disardan direk erisemez ama kendi class inin icerisinde direk eriserek onu, kendi icinde bir public methoda atar ve o method uzerinden de artik disardan base-class ina ait protected alana erismis olacaktir... 




?>