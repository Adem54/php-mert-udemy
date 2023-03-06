<?php 
declare(strict_types=1);

session_start();
// $host="localhost";
// $dbname = "testdb";
// $admin="root";
// $password="";

// try {
// 	$db = new PDO("mysql:host=".$host.";dbname:'.$dbname.",$admin,$password);
// 	echo "Successfull connection";
// } catch (PDOException $ex) {
// 	echo $ex->getMessage();
// }

class DbConnection 
{
	public ?string $host="";
	public ?string $dbname="";
	public ?string $admin="";
	public ?string $password="";
	public ?PDO $db;

	public function __construct(?string $host,?string $dbname, ?string $admin, ?string $password)
	{
		$this->host = $host;
		$this->$dbname = $dbname;
		$this->admin = $admin;
		$this->password = $password;
		try {
		//	$this->db = new PDO("mysql:host=".$this->host.";dbname:'.$this->dbname.",$this->admin,$this->password);
			$this->db = new PDO("mysql:host=".$this->host.";dbname:'.$this->dbname.",$this->admin,$this->password);
		//	 echo "Successfull connection";
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}
}

//define sabiti ile biz direk site url mizi her seferinde tanimlamak  yerine bu sekilde kullanmamiz cok daha mantikli ve bestpractise kullanimdir
define("SITE_URL","../index.php");
define("SITE_NAME","USER SYSTEM VERSION-1");
require_once("sessionManager.php");//Bu dbConnection sayfasini zaten her sayfaya require ettigmiz icin, bizmi sessionManager i bu sayfaya  require etmemiz, dbConnection i require eden sayfalarin hepsine require etmek anlamina geliyor zaten
require_once("helper.php");
$connection = new DbConnection("localhost","testdb","root","");
//$data = $connection->db->query("SELECT * FROM TESTDB.USER")->fetchAll(PDO::FETCH_ASSOC);
$session_manager = new SessionManager("localhost","testdb","root","");

?>