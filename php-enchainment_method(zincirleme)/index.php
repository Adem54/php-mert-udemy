<?php 
declare(strict_types=1);
//Zincirleme methodlar 

class Student {
	public ?string $name="";
	public ?string $surname="";
	public ?int $Id=0;
	public  ?int $number=0;

	public function setName(string $name):Student{
		 $this->name = $name;
		 return $this;	
	}

	public function setSurname(string $surname):Student{
		$this->surname = $surname;
		return $this;	
  }

  public function setId(int $id):Student{
	$this->Id = $id;
	return $this;	
}

public function setNo(int $number):Student{
	$this->number = $number;
	return $this;	
}

public function get(){
	echo $this->name." - ".$this->surname." - ".$this->Id." - ".$this->number;
}

}

//Simdi biz get islemi ile sira ile name,surname,id ve number degerlerini almis olduk ancak biz bu islemi zincirleme yapabilriz

$student = new Student();
$student->setName("Zehra");
$student->setSurname("Erbas");
$student->setId(2);
$student->setNo(321);
$student->get();
echo "<br>********************************<br>";
//Yukarda 5 satirda yaptigmiz islemi enchainment ile burda 1 kere de yapabiliyoruz.... 
$student->setName("Adem")->setSurname("Erbas")->setId(5)->setNo(123)->get();



?>