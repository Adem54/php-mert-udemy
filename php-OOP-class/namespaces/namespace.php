<?php 

//Ayni isimde birden fazla class kullanamioruz normalde ama namespace leri kullanarak birden fazla ayni isimde class lar i kullanabilme imkanini elde ediyoruz

namespace first;

class first_class {
	static function hello(){
		echo "hello first namespace <br>";
	}
}



?>