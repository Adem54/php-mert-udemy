<?php 
declare(strict_types=1);

require_once("class1.php");


class Class2 extends Class1 {

	public function __construct()
	{
		echo "Class2 constructor is working <br>";
	}
	public function getInfo(){
		return $this->getFullname();
	}

	public function getAllInfo(){
		return array(
			"name"=>$this->name,
			"surname"=>$this->surname,
			"job"=>$this->job
		);
	}

	public function getJob(){
		return $this->job;
		//job protected ama Class1 subclass yani Class2 onun base class i oldugu icin yani onu inherit ettigi icin protected a kendi icinden erisebiliyor dikkat edelim
	}
}


$class2 = new Class2();

echo $class2->getInfo();

echo "<br>";
echo $class2->getJob();//Developer

//print_r($class2->getAllInfo());
/*
	{
		name: "Adem",
		surname: "Erbas",
		job: "Developer"
	}
*/

//__constructor kurucu siniftir... 
//class new lendigi anda bir kez ilk olarak bunlar calisacaktir....bunu  unutmayalim.... 
//Ozellikle bizim react ta yaptgimz islem veya normal javascriptte sayfa load edilirken almak istedigmz datalar vs ne var sa onlari sayfa yuklenirken nasil aliyorsak..ilk olarak onload icinde bu calsss larda da constructor icerisinde olaczktir..cunkiu constructor class new lendigi anda yani memory de yeri olusturulur olusturulmaz kurucu calisir ilk olarak....bunu unutmayalim....

//COOK ONEMLI BIR DURUM VAR BURDA....CLASS ICERISINDE TANIMLADIMGZ FIELD LARA MUTLAKA VARSAYILAN DEGER ATAMASI YAPMALIYZ YOKSA FATTAL ERROR ALIYORUZ VE OZLLEIKLE DE DEGER ATANMAYAN FIELD LAR CAGRILDIGI ZAMAN HATA ALIYORUZ
class Person  {
//	private ?string $firstname; HATALI KULLANIM
	private ?string $firstname=""; //DOGRU KULLANIM
	private ?string $lastname = "";//DOGRU KULLANIM
	private ?int $age = null;//DOGRU KULLANIM...
	public static ?string $city="Skien";
	public static ?string $car="Toyota";
	protected ?string $country="Norway";

	const ADRESS = "STREET34";

	public function __construct(?string $firstname, ?string $lastname, ?int $age)
	{
		$this->firstname = $firstname;		
		$this->lastname = $lastname;		
		$this->age = $age;		
	}

	public function getInformation(){
		echo $this->firstname." - ".$this->lastname." - ".$this->age;
	}

	function __destruct()
	{
		//Veritabani kapatmak icin kullanilir genellikle
		//$db=null;
	}

	public static function showAdress(){
		return self::ADRESS;	
	}

	//Static yaptgimiz field ve fonksiyonlara hem self ile hem de this ile class icerisinde erisebiliyoruz
	public static function getMyCity(){
	//	return $this->;
	   return self::$city;
	}

}


class Student extends Person {

	public function __construct()
	{
		echo parent::ADRESS;
	}

	public static function getAddress(){
		echo parent::showAdress();
	}

	public function getCityInfo(){
		echo parent::$city;
	}
	public function getCarInfo(){
		echo parent::$city;
	}
	public function getCountryInfo(){
		//contry alani parent yani base class icerisinde tanimlanmistir..biz ise subclass icindeyiz su an
		//echo parent::$country; country alani static olmadigi icin bu sekilde cagiramiyoruz
		echo $this->country;
	}
}

$person1 =  new Person("Adem","Erbas",35);
$person1->getInformation();

$student1 =  new Student();
$student1->getInformation();
echo "<br>";
echo "**'***************";
//static function i hem o class tan olusturudgumuz instance uzerinden hem de direk class ismi uzerinden cagirabiliyoruz
$student1->getAddress();
Student::getAddress();
echo "<br>";

//Constantlari bu sekilde de gosterim yapabiliyoruz
echo $person1->showAdress();
echo "**'***************";
echo "<br>";
echo Person::showAdress();
echo "**'***************";
echo "<br>";
echo Person::ADRESS;
echo "------------------------";
echo "<br>";
//Static fonksiyonmlari hem direk class ismi ile hem de
echo Person::getMyCity();
echo $person1->getMyCity();
echo "------------------------";
echo "<br>";
//Ama disarda static veya constant FIELD LARI biz sadece class ismi ile cagirabiliyoruz... ama o class tan olusturudgmuz isntance uzerinden cagiramiyoruz...
//public static ?string $car="Toyota"; TABI PUBLIC OLMASI SARTI ILE
echo Person::$car;
//echo $person1->car; hata verir.. 
echo Person::ADRESS;//constant ADRESS
//echo $person1->ADRESS;

echo "------------------------";
echo "<br>";

$student1->getCityInfo();
echo "<br>";
$student1->getCarInfo();

echo "<br>";
$student1->getCountryInfo();

echo "<br>";




//constructor icerisinde genellikle neler yapilir
//1-Veritabani baglanti islemi yapilabilir
//2-Eger bir e-ticaret uygulamasi yapiyor ve gecici surelgine sepetteki urunleri tutacak bir array olusturack isek mesela bir tane sepet class i olsturp constructor icerisine bos bir array ile baslatirirz ve o array icerisinde eklenen uruleri tutabiliriz.. 

//desctructor in da su ozelligini bilelim... ki php de bu cok onemlidiri... bazi methodlar vardir arkada onlar calisir her zaman varsayilan olarak. Biz tanimlar ve icerisinde baska degerler kullanirsak yine calisir ama

//SELF-PARENT-FINAL
//self ile sinif icerisindeki static ozellikteki methodlar ve constant degterlere erisebilmeizi sagliyor
//Ayni sekilde static fonks ve constantlara disardan da direk class ismi ile de erisebilyoruz... 
//static function i hem o class tan olusturudgumuz instance uzerinden hem de direk class ismi uzerinden cagirabiliyoruz
//Ama disarda static veya constant ve FIELD LARI biz sadece class ismi ile cagirabiliyoruz... ama o class tan olusturudgmuz isntance uzerinden cagiramiyoruz...
//public static ?string $car="Toyota"; TABI PUBLIC OLMASI SARTI ILE
//echo Person::$car;
//echo $person1->car; hata verir.. 
//echo Person::ADRESS;//constant ADRESS
//echo $person1->ADRESS; //hata verir bu sekilde cagiramayiz

//Static yaptgimiz field ve fonksiyonlara hem self ile hem de this ile class icerisinde erisebiliyoruz
//private static ?string $firstname=""; 
//public function getMyName(){
//	return $this->firstname;
// return self::$firstname; }

//PARENT-subclass icinde base-class a yani inherit ettigi class a ait static ve constant ogeleri cagirmak icin ikullaniriz
//parent ile de subclass icinde base class a ait static olan public ve protected field ve functions lari cagirabiliyoruz
//parent ile static olmayan normal tanimlanmis bir alani cagiramiyoruz
//public function getCountryInfo(){
	//contry alani parent yani base class icerisinde tanimlanmistir..biz ise subclass icindeyiz su an
	//echo parent::$country; country alani static olmadigi icin bu sekilde cagiramiyoruz
	//echo $this->country; } bu sekilde cagirabiliriz

	//FINAL KULLANIMI
	//Base class ta final ile tanimlanmis bir method subclass ta yenide tanimlanamz..
	//Normalde base class ta tanimlanan bir methodun aynisini biz subclass ta da tanimlayabiliriz ve icerigini tammen degistirebilyoruz yani override edebiliyoruz ancak final ile eger baseclass tan bir methodu biz final ile tanimlarsak artik o method o base class i inherit eden hicbir subclass ta yeniden tanimlanamaz
	//Ayrica 

	// Final(C#da sealed) ifadesi, bir class'ın erişim türünü belirlemektedir. Eğer bir class final deyimiyle birlikte tanımlanırsa, bu class miras alınarak başka bir class oluşturulamaz. Yani final kavramı bir class'ın extends edilmesinin önüne geçer. 

	//Fatal error: Class Futbolcu may not inherit from final class (Sporcu) 
	//Final ifadesi gercek hayatt kullanimlarinda cok effektif bir sekilde kullanilabiliyor...bazi class larimiz bize ozel olabilir ve kesinlikle disardan baska bir class ile kullanilmamasi gerekebilir iste final ile bu islemi halleecegiz

	//Programlama dilleri üzerinde genelde ihtiyaçtan doğan OOP mimarisi ile birlikte hayatımıza girimiş olan final komutumuzun amacı bizim oluşturduğumuz class veya methodumuzun sadece tek seferlik kullanım olarak sunulmasına olanak sağlar. Normalde biz extends ediyorduk class ları veya hem ana class içerisinde hem de child class içerisinde methodlarımızı rahat rahat kullanırken final komutunu baş kısmına yazdığımız zaman programımız bize "Hooop kardeşim bu final tanımlı. Bunu birden fazla kez kullanamazsın bir kere kullan :)" şeklinde bir uyarı verdirtiyor. Bütün olay aslında bu dostlar.

?>