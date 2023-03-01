<?php 
//3.1.1 S - Single Responsibility Principle

//Wrong
class Person extends Model
{
    public $name;
    public $birthDate;
    protected $preferences;

    public function getPreferences() {}

    public function save() {}
}

	//Right
	class Person extends Model
	{
		public $name;
		public $birthDate;
		protected $preferences;

		public function getPreferences() {}
	}

	class DataStore
	{
		public function save(Model $model) {}
	}

	//This is better. The Person model is back to only doing one thing, and the save behavior has been moved to a persistence object instead. Note also that I only type hinted on Model, not Person. We'll come back to that when we get to the L and D parts of SOLID.


	abstract class Shape 
{
    abstract public function getHeight();

	 abstract public function setHeight($height);

    abstract public function getLength();

	 abstract public function setLength($length);
}

//This is going to represent our basic four-sided shape. Nothing fancy here.

class Square extends Shape
{
    protected $size;

    public function getHeight() {
        return $this->size;
    }

    public function setHeight($height) {
        $this->size = $height;
    }

    public function getLength() {
        return $this->size;
    }

    public function setLength($length) {
        $this->size = $length;
    }
}

class Rectangle extends Shape
{
    protected $height;
    protected $length;

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getLength() {
        return $this->length;
    }

    public function setLength($length) {
        $this->length = $length;
    }
}

//No more than one level of indentation per method

 function transformToCsv($data)
{
    $csvLines = array();
    $csvLines[] = implode(',', array_keys($data[0]));
    foreach ($data as $row) {
        if (!$row) {
            continue;
        }
        $csvLines[] = implode(',', $row);
    }

    return $csvLines;
}

?>