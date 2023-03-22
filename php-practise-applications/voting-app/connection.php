<?php 
declare(strict_types=1);

class DB extends PDO {
	private string $host;
	private string $dbname;
	private string $user;
	private string $password;
	public PDO $db;
	
	public function __construct(string $host,string $dbname, string $user, string $password){
		$this->host = $host;
		$this->dbname = $dbname;
		$this->user = $user;
		$this->password = $password;
		try {
			$dbSTR = "mysql:host=".$host.";dbname=".$dbname;
			parent::__construct($dbSTR,$user,$password);
		//	echo "Succesfful connection";
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}
} 

$db = new DB("localhost","testdb","root","");


?>