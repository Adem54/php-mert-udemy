<?php 
declare(strict_types=1);

class dbConnection extends PDO {
	private string $host;
	private string $username;
	private string $password;
	private string $database;
	public $db;

	public function __construct(?string $host, ?string $database,?string $username, ?string $password){
			$this->host = $host;
			$this->database =$database;
			$this->username = $username;
			$this->password = $password;
			try {
			//	$this->db = parent::__construct("mysql:host".$this->host.";dbname=".$this->database, $this->username,$this->password);
				// $this->db = parent::__construct("mysql:host".$this->host.";dbname=".$this->database, $this->username,$this->password);
				$this->db = new PDO("mysql:host=localhost;dbname=testdb","root","");
				echo "Connection successfull";
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
	}
	public function getDB(){
		return $this->db;
	}
}

?>