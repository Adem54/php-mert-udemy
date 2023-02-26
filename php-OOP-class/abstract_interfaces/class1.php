<?php 

//Abstract class - interfaces
//Somut islemler icermezler
//Somut islemleri kendilerinden tureyen siniflar  yapar

abstract class Money {
	 public ?int $Id;//properties can not be decleared abstract
	abstract public function salary($value);//sadece imza kullnilir, yani suslu parantez kismi kullanilmaz
	public function calculate($value){
		return $this->salary($value)*2;	
	}
	//non-abstract method must contain body... yani eger methoda abstract keywordu kullanmiyor isek o zaman body yani suslu parantezler ile kullanmamiz gerekir
}

//Money abstract class i ni inherit eden class lar Money icerisindeki abstract methodlari kullanmak zorundadir
//Abstract class icinde abstract olmayan yani body ise birlikte tanimlanan mehtodlar ise bu abstract class i inherit eden class lar tarafindan kullanilmak zorunda degildirler
class Person extends Money {

	public ?int $Id = 1;

	public function salary($value){
		return $value;
	}

}

//Neden abstract classlar i kullaniriz
//DAha kararli ve daha duzenli bir yapi olusturmak icin kullaniriz biz abstract class lari


$person = new Person();
echo $person->calculate(1000);

//Interface biraz daha katidir..abstrac a gore

interface personal {
//Interface lerde property veya field tanimlanamiyor
	public function age();

	public function getInfo();//interface lerde bodys is olan bir method tanimlayamayiz... abstract class lardan onemli bir farki
}

//Class Student2 cannot extend interface personal
//interface ler extends olarak degil implement olarak class lar tarfainda implement edilir
class Student2 implements personal {
	public function age(){

	}
	public function getInfo(){

	}
}

//interface ler icerisinde olusturulan method imzalari o interface i implement eden class lar tarafindan kullanilmak zorunadirlar
?>