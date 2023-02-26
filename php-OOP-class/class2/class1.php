<?php 
declare(strict_types=1);


class Class1 {
	public ?string $name = "Adem";
	public ?string $surname = "Erbas";
	protected ?string $job = "Developer";


	public function __construct()
	{
		echo "Class1 constructor is working";
	}

	public function getFullname(){
		return $this->name." - ".$this->surname;
	}
}


?>