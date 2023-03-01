<?php 

class Base {
	public function sayHello(){
		echo "Hello";
	}
}

trait SayWorld{
	public function sayHello(){
		parent::sayHello();//Burda bir bestpractise var.. Ayni mehtod icerisinde baseclass taki method invoke edilmis ve ekstra da kendi ekleyecegi  islemi de eklemis... 
		echo "World";
	}
}

class MyHelloWorld extends Base {
	use SayWorld;
}

$o =  new MyHelloWorld();
$o->sayHello();




?>