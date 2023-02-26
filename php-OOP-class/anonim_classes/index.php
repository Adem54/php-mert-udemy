<?php 
declare(strict_types=1);
//Anonim siniflar
//Bir sinif olusturmak yerine sadece bazi belirtttimiz islemleri yapmasini istedigmiz siniflar da kullaniriz genellikle deger dondurme islemlerinde kullanilir
//Bu anladigm kadari ile ozellikle obje dondurmek istedimgiz zaman ve bu obje ornegin inner join yaptik ve bu inner join isleminde biz 2 tablo yu birlestirdik ama bu 2 tablonunda bazi ogelerini dondurecegiz ve obje olarak dondurmek istiyoruz ama bununla ilgili belli bir ojbeimiz yok o zaman bu sekilde anonim obje ile bir return yapabilriz

//Anonim siniflar direk new lenerek kullanilir... yani normal class lar gibi isim verilmeden direk new lenerek kullanilir

new Class {
	public function __construct()
	{
		echo "Hello world <br>";
	}
};


function Math(int $num1,int $num2){

	//Eger bir fonksion icinde kullanirsak anonim class lari o zaman, fonksiyondan gelen parametreeleri eger class icinde kullanacak isek o zaman class a paramtre olarak invoke eder gibi gondermemiz gerekecek bu parametreleri
	//Anonim siniflar tek seferlik kullanmak icin hazirlanirlar
	return new Class($num1,$num2){

		public ?int $value1 = 0;
		public ?int $value2 = 0;
		public function __construct($num1,$num2)
		{
			$this->value1 = $num1;
			$this->value2 = $num2;
		}

		public function Sum():int {
			return $this->value1+$this->value2;
		}

		public function Extract():int {
			return $this->value1 - $this->value2;
		}

		public function Multiple():int {
			return $this->value1 * $this->value2;
		}

		public function Divide():int {
			return $this->value1 / $this->value2;
		}
	};
}

echo Math(10,12)->Sum();//22
echo Math(10,12)->Multiple();//120
//Burda aslindas harika bir olay var nasil..Bu olay ayni C# daki delegeler e benziyor yani icerisinde birden fazla method tutabilen delegelere benziyor ki bu arada......
//YANI biz ornegin bir method kullanmak istiyoruz ama bu method bazi sartlara gore biraz daha detayli kullanilmasi gerekiyor ve biz de o method uzerinden o method icinde olusturacgimzi anonim class icinde tanimlayacagimiz methodlar i kullanark, yeni methodlar kullanabilirz yani method uzerinden baska bir methodu cagirabiliriz...methodu bir anda ayni class gibi kullanabiliyoruz burda.....

?>