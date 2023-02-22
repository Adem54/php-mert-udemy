<?php 
require_once("config.php");

//1-SELECT DATA-WITHOUT PREPARE
// $sql = "SELECT * FROM tutorials";
// $tutorials = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// print_r($tutorials);
//fetch ile tek bir data getirmek icin kullaniriz
//fetchAll ile birden fazla data getirmek icin kullaniriz. 
//fetchAll(PDO::FETCH_ASSOC); ILE BIZ, DATALARI SQL TABLODAN(VERITABANI) KEY-VALUE SEKLINDE GELMESI ICIN YAPARIZ
//VERITABANI TABLOSUNDA DATAMIZ BIRKAC FARKLI SEKILDE GELEBILIR CUNKU NUMARAYA GORE DE TUTULUYOR ONDAN DOLAYI BIZIM DATAYI NASIL ISTEDGIMZI BELIRTMEMIZ GEREKIR

//SELECT DATA WITH PREPARE
$sql = "SELECT * FROM tutorials";
$query = $db->prepare($sql);
$query->execute();
$tutorials = $query->fetchAll(PDO::FETCH_ASSOC); 
// print_r($tutorials);

//query direk sonucu veriyor...ama prepare ile yaparken execute methodu bir kez hicbir return yapmadan invoke edilir ondan sonra execute u invoke ettimiz degisken $stmt veya $query olarak kullanabiliyoruz bunlardan hangisi ise onun ile datayi artik alabiliyoruz....

//3-INSERT WITH PREPARE PLACEHOLDER
/*
INSERT query with named placeholders
$sql="INSERT INTO TUTORIALS (tutorial_title,tutorial_content,tutorial_active) VALUES(:tutorial_title, :tutorial_content,:tutorial_active)";
	$query = $db->prepare($sql);
	$newData = [
		":tutorial_title"=>"Visual basic",
		":tutorial_content"=>"Primitive types",
		":tutorial_active"=>1,
	];
	$newData = [
		"tutorial_title"=>"Visual basic",
		"tutorial_content"=>"Primitive types",
		"tutorial_active"=>1,
	];

	Biz data olarak yukardaki her iki tanimlama biciminde de alabilyoruz datalari eger ki, placeholder ile yani karsilarinda alias li data lar ile tanimlanmis ise yani her bir kolon karsisinda  :tutorial_title gibi alias placeholder lar tanimlanmis ise...  

	echo "New data added";
	$query->execute($newData);


	BU DA DIREK ? ILE PREPARE YONTEMI... INSERT query with positional placeholders
	$sql="INSERT INTO TUTORIALS (tutorial_title,tutorial_content,tutorial_active) VALUES(?, ?,?)";
	$query = $db->prepare($sql);
	$newData = [
	"Go",
	"String functions",
	 1
	];
	echo "New data added";
	$query->execute($newData);

	POSITIONAL PLACEHOLDERS ILE INSERT ISLEMI ILE NAMEDPLACEHOLDERS ILE DATA EKLEME ISLEMINDE DIKKAT EDERSEK EXECUTE ICERISINE DATA GONDERIRKEN POSITIONAL PLACEHOLDERS DA(? ILE OLAN) SPESIFIK KEY KULLANMADAN DATAYI GONDERIRKEN, NAMEDPLACEHOLDERS DA ISE SPESIFIC KEY LERI ILE BIRLIKTE KULLANIYORUZ... 


	INSERT ISLEMINI SET KEYWORDU KULLANARAK  YAPMA YONTEMI DIR BUDA 

	$sql="INSERT INTO TUTORIALS SET tutorial_title = :tutorial_title, tutorial_content = :tutorial_content, tutorial_active = :tutorial_active";
	$query = $db->prepare($sql);
	$newData = [
		":tutorial_title"=>"Visual basic2",
		":tutorial_content"=>"Primitive types2",
		":tutorial_active"=>1,
	];
	echo "New data added";
	$query->execute($newData);
*/

//UPDATE
// try {
// 	$sql = "UPDATE TUTORIALS SET tutorial_title = :tutorial_title, tutorial_content = :tutorial_content, tutorial_active = :tutorial_active WHERE tutorial_id = :tutorial_id";
// $query = $db->prepare($sql);
// $newData = [
// 	":tutorial_title"=>"Visual basic-changed",
// 	":tutorial_content"=>"Primitive changed",
// 	":tutorial_active"=>1,
// 	":tutorial_id"=>18
// ];
// $query->execute($newData);

// var_dump($query->rowCount());//BU SEKIILDE BIZ DATA MIZIN UPDATE OLUP OLMADIGINI CHECK EDEBILIYORUZ
// } catch (PDOException $e) {
// 	echo $e->getMessage();
// }

// INSERT ISLEMINDE DATAMIZIN EKLENIP EKLENMEDIGINI NASIL ANLARIZ..... QUERY->ROWCOUNT() BIZE INTEGER OLARAK YAPILAN SQL QUERY SORUGUSNDAN VERITABANINDA ETKILENEN ROW-SATIR SAYSININ VERIR...
// try {
// 	$sql="INSERT INTO TUTORIALS (tutorial_title,tutorial_content,tutorial_active) VALUES(:tutorial_title, :tutorial_content,:tutorial_active)";
// 	$query = $db->prepare($sql);
// 	$newData = [
// 		":tutorial_title"=>"CPlus",
// 		":tutorial_content"=>"Value types",
// 		":tutorial_active"=>1,
// 	];

// 	$query->execute($newData);
// 	//BU SEKILDE DE DATA MIZ EKLENMIS MI EKLENMEMIS MI BUNU ANLAYABILIRIZ....
// 	if($query->rowCount() > 0){
// 		echo "new data added and ".$query->rowCount()." row affected"; 
// 		//new data added and 1 row affected
// 	}
// } catch (PDOException $e) {
// 		echo $e->getMessage();
// }

/*
	INSERT ISLEMI YAPARKEN...HEM SET KULLANMAK HEM DE DATANIN EKLENME DURUMUNU KONTROL ETME

try {
	$sql = 'INSERT INTO tutorials SET 
tutorial_title = ?,
tutorial_content=?,
tutorial_active=?,
teacher_id = ?
 ';
$query = $db->prepare($sql);
$res = $query->execute(["GO","Math Functions",1,3]);

//Eger data hatasiz bir sekilde eklenirse $res true olarak doner
//Ayrica
if($query->rowCount()){
	echo "You added your data successfully";
}

if($res){//Date eklenirse $res true olarak gelecektir
	echo "You added your data successfully";
}

} catch (PDOException $e) {
	echo $e->getMessage();
print_r($query->errorInfo());
	/*
	{
	0: "42S22",
	1: "1054",
	2: "Unknown column 'tutorial_activee' in 'field list'"
	},
	
}
*/
 



//DELETE ISLEMINI  YAPALIM SIMDIDE
//VE DE DELETE ISLEMININ BASARILI OLUP OLMADIGNIN KONTROL EDELIM AYNI ZAMANDA
/*
try {
	$sql = "DELETE FROM TUTORIALS WHERE tutorial_id = ?";
$query = $db->prepare($sql);
$query->execute([18]);
if($query->rowCount() > 0)echo "<br>data deleted and ".$query->rowCount(). " row affected";
//data deleted and 1 row affected
} catch (PDOException $th) {
	echo $e->getMessage();
}
*/

//FETCH SINGLE DATA AND PROCESS DATA BEFORE USE....WITH WHILE LOOP...
//Single row data cekerken biz direk kendimiz sorgumuz icinde limit 1 dersek zaten gelen data yi 1 yapmis oluruz
/*
try {
	$sql = "SELECT * FROM TUTORIALS ORDER BY tutorial_id DESC LIMIT 1";
$query = $db->prepare($sql);
$query->execute();
$res = $query->fetch(PDO::FETCH_ASSOC);//FETCH_ASSOC KULLANMAZSAK SQL TABLOSU ICERISINDE TUTULAN TUM FARKLI VARYASYONLAR SEKLIDNE DATA GELECEK VE BU BIZIM ZAMANIMIZI ALIR BUNUNLA UGRASMAK YERINE ADAMLAR BIZIM IHTIYACIMIZA GORE DATALARI PARAMETREYE YAZACAGIMZ CONSTANT DEGERLER  UZERINDEN BIZE SUNUYORLAR ONDAN DOLAYI DA BIZ EGER KEY-VALUE SEKLINDE ALMAK ISTERSEK DATAYI O ZAMAN PDO::FETCH_ASSOC DERIZ.

print_r($res);
} catch (PDOException $e) {
	echo $e->getMessage();
}
*/


// $sql = "SELECT * FROM tutorials ";
// $query = $db->prepare($sql);
// $query->execute();

// while($row = $query->fetch()){//Burda her fetch tetiklendiginde en son hangi data da kaldi ise o data dan itibaren bir sonraki next() data yi tetikler ancak eger next data var ise tetikler ve bunu bizim her hangi bir kontrol yapmamiza gerek kalmadan kendisi yapiyor...Ondan dolayi da biz
// 	echo $row["tutorial_title"]."<br>";
// }

//TABLODAKI VERILERIN TOPLAM SAYISINI ALALIM SIMDIDE-COUNT OF DATA NUMBER ON OUR TUTORIALS TABLE
$sql = "SELECT COUNT(*) AS count_data FROM TUTORIALS";
$query = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$count_data = $query[0]["count_data"];
echo $count_data;//9 

$sql2 = "INSERT INTO TUTORIALS (TUTORIAL_TITLE,TUTORIAL_CONTENT,TUTORIAL_ACTIVE,TEACHER_ID) VALUES (:TUTORIAL_TITLE, :TUTORIAL_CONTENT,:TUTORIAL_ACTIVE,:TEACHER_ID)";
$query = $db->prepare($sql2);
$data = [
	":TUTORIAL_TITLE"=>"JAVASCRIPT",
	":TUTORIAL_CONTENT"=>"VARIABLES",
	":TUTORIAL_ACTIVE"=>"1",
	":TEACHER_ID"=>2
];
$query->execute($data);
var_dump($query->rowCount());

//mysql> SELECT * FROM TUTORIALS ORDER BY TUTORIAL_DATE;-TARIHI EN ESKIDEN  YENIYE DOGRU GETIRIR
//mysql> SELECT * FROM TUTORIALS ORDER BY TUTORIAL_DATE DESC; TARIHI EN GUNCELDEN GUNCEL OLMAYAN DOGRU GETIRIR

//BUU COK ONEMLI BIR BESTPRACTISE DIR...ORDER BY DIGER WHERE ILE YAZILAN KOSULLARDAN SONRA GELIRKEN, LIMIT DE HER ZAMAN ORDER BY DAN SONRA GELMEDLIDIR...
//VE ELMIZDE COK UZUN DATA OLDUGUNDA TABI KI NE YAPIYORUZ...LIMIT ILE KAC DATA GELMESINI ISTIYORSAK O KADAR DATA GELMESINI SAGLIYORUZ

//LIMIT ILE BIZ HANGI DATA LAR ARASINDA DATA LARIN GELMEISNI ISIYORSAK ONLARI GETIRIRIZ VE BU OZELLIKLE PAGINATION ISLEMLERINDE COK FAZLA KULLANACAGMIZ BIR SQL KOMUTU OLACAKTIR...

//Biz gelecek olan data nin upper ya da lower gelmesini daha sql query den ayarlayabiliriz...
// SELECT upper(tutorial_title) from tutorials where tutorial_id = 23;
// select * lower(tutorial_title) from tutorials where tutorial_id = 22;

// The SQL SELECT DISTINCT Statement
// The SELECT DISTINCT statement is used to return only distinct (different) values.
// Inside a table, a column often contains many duplicate values; and sometimes you only want to list the different (distinct) values
// SELECT DISTINCT column1, column2, ...FROM table_name;
//SELECT Example Without DISTINCT
//The following SQL statement selects all (including the duplicates) values from the "Country" column in the "Customers" table:
//SELECT Country FROM Customers;
//Now, let us use the SELECT DISTINCT statement and see the result.
//SELECT DISTINCT Country FROM Customers;
//The following SQL statement lists the number of different (distinct) customer countries:

//BU KULLANIM MANTIKLARI HARIKA KULLANIMLARDIR....DIKKAT EDELIM...BESTPRACTISEEEEE.DIKKAT EDELIM...	
//SELECT COUNT(DISTINCT Country) FROM Customers;	
//SELECT Count(*) AS Distinct Countries FROM (SELECT DISTINCT Country FROM Customers);

//PATIENTS TABLOSUNDA ALERGIES DIYE BIR ALAN VAR VE TEXT TIPINDE VE ALERGISI OLMAYANLAR NULL OLANLAR ISE TEXT ILE YAZILMIS VE BIZ DEN ALERJISI OLMAYAN HASTA LISTESINI ISTIYOR YONETIM ORNEGIN...ISTE ASAGIDAKI GIBI ALABILIRIZ ONU....

//is key wordunu cok kullaniliyor...cok efektif kullanilabilyor--BU COOK ONEMLI..HERSEY I WHERE = NULL DIYE YAPMAYA CALISMAYALIM BU YANLIS BIR SORGU OLYOR BU TARZ SORGULARDA....
//SELECT first_name, last_name FROM patients where allergies IS NULL;

//Show first name of patients that start with the letter 'C'
//BAS HARFI C ILE BASLAYAN HASTALARI GETIRR....
//SELECT first_name FROM patients where first_name LIKE "C%";

//Show first name and last name of patients that weight within the range of 100 to 120 (inclusive)
//SELECT first_name,last_name FROM patients WHERE weight between 100 AND 120;
//SELECT * FROM Products WHERE Price BETWEEN 10 AND 20;
//AYNI MANTIK ILE BIZE ORNEGIN DENDI KI 100-120 DEGERLERI ARASINDA OLMAYAN DATALARI GETIRMEMIZ ISTEDILER O ZAMAN DA
//NOT BETWEEN I KULLANARAK ALABILIRIZ BU DATAYI
//To display the products outside the range of the previous example, use NOT BETWEEN:
//SELECT * FROM Products WHERE Price NOT BETWEEN 10 AND 20;

//BETWEEN-IN BIRLIKTE KULLANIMI
//1-10 SAYILARI ARASINDAN 1,2,3 SAYILARI HARICINDEKILERI GETIR DENIRSE
//SELECT * FROM Products WHERE Price BETWEEN 10 AND 20 AND CategoryID NOT IN (1,2,3);

//BETWEEN Text Values Example
//The following SQL statement selects all products with a ProductName between Carnarvon Tigers and Mozzarella di Giovanni:
//SELECT * FROM Products WHERE ProductName BETWEEN 'Carnarvon Tigers' AND 'Mozzarella di Giovanni' ORDER BY ProductName;

//NOT BETWEEN Text Values Example
//The following SQL statement selects all products with a ProductName not between Carnarvon Tigers and Mozzarella di Giovanni:
//SELECT * FROM Products WHERE ProductName NOT BETWEEN 'Carnarvon Tigers' AND 'Mozzarella di Giovanni' ORDER BY ProductName;

//BETWEEN Dates Example
//The following SQL statement selects all orders with an OrderDate between '01-July-1996' and '31-July-1996':
//SELECT * FROM Orders WHERE OrderDate BETWEEN #07/01/1996# AND #07/31/1996#;
//SELECT * FROM Orders WHERE OrderDate BETWEEN '1996-07-01' AND '1996-07-31';

//IS KEYWORDU NULL ALANLARINI BULURKEN COK KULLANILIYOR
//NULL-VALUES OLAN DATALARI YANI, TABLO OLUSTURULURKEN KOLONLARDAN NOT NULL VERILMEYENLER DATA EKLENIRKEN BOS BIRAKILABILIYOR VE BIZ SPESIFK OLARAK DATALARIN NULL OLUP OLMADIDINI DA SQL DE KONTROL EDEBILIYORUZ
//SELECT column_names FROM table_name WHERE column_name IS NULL;
//SELECT column_names FROM table_name WHERE column_name IS NOT NULL;
//Tip: Always use IS NULL to look for NULL values.
//The IS NOT NULL operator is used to test for non-empty values (NOT NULL values).

//ALERGI ALANI NULL OLAN TUM ALANLARIN YERINE "NKA" ILE UPDATE EDELIM
//UPDATE patients set allergies="NKA" WHERE allergies IS NULL;


//CONCAT METHODU ILE ISTEDIGMZ KOLONLARI BIRLESTIREBILMEK
//SELECT FIRSTNAME AND LASTNAME AND concatinated two columns under one column in sql
//IKI KOLONU 1 KOLON ALTINDA BIRLESTIRIP FULLNAME OLARAK SUNMAK..BUNA COK IHTIYACIMIZ OLABILIR...AD SOYADI BIRLIKTE ALMAK ISTEYEBILIRIZ...
//COOK DIKKAT EDELIM...BU COK ONEMLIDIR...
//SELECT CONCAT(first_name, ' ',last_name) AS first_name FROM PATIENTS;

//ISTEDGIMZ HERHANGI BIR KOLONDA MIN-MAX DEGERLERI BULMAK
//SELECT MIN(column_name) FROM table_name WHERE condition;

//The COUNT() function returns the number of rows that matches a specified criterion.
//The AVG() function returns the average value of a numeric column. (ORTALMA FIYATI BULMAMIZ GEREKBILR)
//The SUM() function returns the total sum of a numeric column. 

//LIKE OPERATORU ILE BIZ...WHERE CLOUSE ILE KULLANARAK KOLONLARDA SPESIFIK PATTERN LER ARAYABILIYORUZ....COOK ONEMLIDIR..
//There are two wildcards often used in conjunction with the LIKE operator:
// The percent sign (%) represents zero, one, or multiple characters
//The underscore sign (_) represents one, single character
//SELECT column1, column2, ...FROM table_name WHERE columnN LIKE pattern;
//Tip: You can also combine any number of conditions using AND or OR operators.
//WHERE CustomerName LIKE 'a%'	Finds any values that start with "a"
//WHERE CustomerName LIKE '%a'  	Finds any values that end with "a"
//WHERE CustomerName LIKE '%or%'  Finds any values that have "or" in any position
//WHERE CustomerName LIKE '_r%' 	Finds any values that have "r" in the second position
//WHERE CustomerName LIKE 'a_%'  Finds any values that start with "a" and are at least 2 characters in length'
//WHERE CustomerName LIKE 'a__%' Finds any values that start with "a" and are at least 3 characters in length
//WHERE ContactName LIKE 'a%o' 	Finds any values that start with "a" and ends with "o"

//The following SQL statement selects all customers with a CustomerName that does NOT start with "a":
//SELECT * FROM Customers WHERE CustomerName NOT LIKE 'a%';

//SQL Wildcard Characters
//A wildcard character is used to substitute one or more characters in a string.
//Wildcard characters are used with the LIKE operator. The LIKE operator is used in a WHERE clause to search for a specified pattern in a column.

//Wildcard Characters in MS Access
//*	Represents zero or more characters	bl* finds bl, black, blue, and blob
//?	Represents a single character	h?t finds hot, hat, and hit
//[]	Represents any single character within the brackets	h[oa]t finds hot and hat, but not hit
//!	Represents any character not in the brackets	h[!oa]t finds hit, but not hot and hat
//-	Represents any single character within the specified range 	c[a-b]t finds cat and cbt
//#	Represents any single numeric character  2#5 finds 205, 215, 225, 235, 245, 255, 265, 275, 285, and 295

//Wildcard Characters in SQL Server

//%	Represents zero or more characters	bl% finds bl, black, blue, and blob
//_	Represents a single character	h_t finds hot, hat, and hit
//[]	Represents any single character within the brackets	h[oa]t finds hot and hat, but not hit
//^	Represents any character not in the brackets	h[^oa]t finds hit, but not hot and hat
//-	Represents any single character within the specified range	c[a-b]t finds cat and cbt

//The following SQL statement selects all customers with a City starting with "ber":
//SELECT * FROM Customers WHERE City LIKE 'ber%';

//The following SQL statement selects all customers with a City containing the pattern "es": 
//SELECT * FROM Customers WHERE City LIKE '%es%';

//The following SQL statement selects all customers with a City starting with any character, followed by "ondon":
//SELECT * FROM Customers WHERE City LIKE '_ondon'

//The following SQL statement selects all customers with a City starting with "L", followed by any character, followed by "n", followed by any character, followed by "on":
//SELECT * FROM Customers WHERE City LIKE 'L_n_on';

//The following SQL statement selects all customers with a City starting with "b", "s", or "p":
//SELECT * FROM Customers WHERE City LIKE '[bsp]%';

//The following SQL statement selects all customers with a City starting with "a", "b", or "c":
//SELECT * FROM Customers WHERE City LIKE '[a-c]%'

//Using the [!charlist] Wildcard
//The two following SQL statements select all customers with a City NOT starting with "b", "s", or "p":

//SELECT * FROM Customers WHERE City LIKE '[!bsp]%';


//SQL IN OPERATOR
//The IN operator allows you to specify multiple values in a WHERE clause.
//The IN operator is a shorthand for multiple OR conditions.
//SELECT column_name(s) FROM table_name WHERE column_name IN (value1, value2, ...);
//BURAYI OZELLIKLE ONEMESEMELIYIZ..........
//SELECT column_name(s) FROM table_name WHERE column_name IN (SELECT STATEMENT);BUU COK FARKLI VE ONEMLI BIR KULLANIM.....COK ONEMLI.....

//The following SQL statement selects all customers that are located in "Germany", "France" or "UK":
//SELECT * FROM Customers WHERE Country IN ('Germany', 'France', 'UK');
//The following SQL statement selects all customers that are NOT located in "Germany", "France" or "UK":
//SELECT * FROM Customers WHERE Country IN ('Germany', 'France', 'UK');

//SUPPLIERS TABLOSUNDAKI AYNI COUNTRY LERI GETIRMEK ISTERSEK...
//The following SQL statement selects all customers that are from the same countries as the suppliers:
//SELECT * FROM Customers WHERE Country IN (SELECT Country FROM Suppliers);

//ALIAS KULLANIMI
//Alias for Columns Examples
//The following SQL statement creates two aliases, one for the CustomerID column and one for the CustomerName column:
//SELECT CustomerID AS ID, CustomerName AS Customer FROM Customers;
//The following SQL statement creates two aliases, one for the CustomerName column and one for the ContactName column. Note: It requires double quotation marks or square brackets if the alias name contains spaces:
//SELECT CustomerName AS Customer, ContactName AS [Contact Person] FROM Customers;

//The following SQL statement creates an alias named "Address" that combine four columns (Address, PostalCode, City and Country):
//SELECT CustomerName, Address + ', ' + PostalCode + ' ' + City + ', ' + Country AS Address FROM Customers;

//SELECT CustomerName, CONCAT(Address,', ',PostalCode,', ',City,', ',Country) AS Address FROM Customers;

//Alias for Tables Example
//The following SQL statement selects all the orders from the customer with CustomerID=4 (Around the Horn). We use the "Customers" and "Orders" tables, and give them the table aliases of "c" and "o" respectively (Here we use aliases to make the SQL shorter):

//SELECT o.OrderID, o.OrderDate, c.CustomerName FROM Customers AS c, Orders AS o WHERE c.CustomerName='Around the Horn' AND c.CustomerID=o.CustomerID;

//The following SQL statement is the same as above, but without aliases:

//SELECT Orders.OrderID, Orders.OrderDate, Customers.CustomerName FROM Customers, Orders WHERE Customers.CustomerName='Around the Horn' AND Customers.CustomerID=Orders.CustomerID;

//Aliases can be useful when:

// There are more than one table involved in a query
// Functions are used in the query
// Column names are big or not very readable
// Two or more columns are combined together

//INNER JOINS-RIGHT JOIN-LEFT JOIN FULL JOIN

// Different Types of SQL JOINs
// Here are the different types of the JOINs in SQL:

// (INNER) JOIN: Returns records that have matching values in both tables
// LEFT (OUTER) JOIN: Returns all records from the left table, and the matched records from the right table
// RIGHT (OUTER) JOIN: Returns all records from the right table, and the matched records from the left table
// FULL (OUTER) JOIN: Returns all records when there is a match in either left or right table

//SQL INNER JOIN Keyword
// INNER JOIN SADECE IKI TABLODA DA ESLESENLERI BIRARAYA GETIRIR ESLESMEYEN DATA VARSA ONU GETIRMEZ...
//The INNER JOIN keyword selects records that have matching values in both tables.
//SELECT Orders.OrderID, Customers.CustomerName FROM Orders INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID;
// The INNER JOIN keyword selects all rows from both tables as long as there is a match between the columns. If there are records in the "Orders" table that do not have matches in "Customers", these orders will not be shown!

//3 TABLOYU BIRLIKTE BIRLESTIREBILIRYORUZ....BESTPRACTISE...
// SELECT Orders.OrderID, Customers.CustomerName, Shippers.ShipperName
// FROM ((Orders
// INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID)
// INNER JOIN Shippers ON Orders.ShipperID = Shippers.ShipperID);
//BU SEKILDE, ORDERID,CUSTOMERNAME VE SHIPPERNAME I BIR TABLO ICINDE GOREBILMIS OLUYORUZ..
//ORDERS  TABLOSUNUN COLUMNS LARI OrderID	CustomerID	EmployeeID	OrderDate	ShipperID
//CUSTOMERS TABLOSU COLUMNS CustomerID	CustomerName	ContactName	Address	City	PostalCode	Country
//SHIPPERS TABLOSU COLUMNS LARI ShipperID	ShipperName	Phone
//BIZ INNER JOIN ILE ORDER TABLOSUNDAKI FOREIGN KEY LERI ONLARIN PRIMARY KEY OLDUKLARI TABLOLAR LA CAKISTIRARARK, ID LERINE KARSILIK GELEN NAME LERINI ORDERID - CUSTOMERNAME- SHIPPERNAME KOLONLARININ OLDUGU BIR SAYFADA GETIREBILYORUZ....


// -ONEMLI!!GERCEK HAYATTAN ORNEKLER
// --YONETIM BIZE DEDI KI HIC SATIS YAPAMADIGIMIZ URUNLER NELERDIR
// --CUNKU O URUNLERI KAMPANYA YAPIP , O URUNLERI INSANLARI ALMAYA TESVIK EDIP URUNLERI ELDEN CIKARMAK ICIN
// --INNER JOIN IKI TABLODA DA ESLESEN BIR VERI VARSA BIRLESTIRIR BURDA ISIMIZI GORMEZ...
//--LEFT JOIN!!!!!!!!!!!!!
//-- LEFT JOIN-SOLDA OLUP DA SAGDA OLMAYANLARI DA  GETIR 
//PRODUCTS TA VAR AMA ORDERDETAILS DE YOK YANI URUNLER DE URUN OLARAK VAR AMA ORDERDETAILS TABLOSUNDA YOK YANI
//--URUN ELDE VAR AMA SIPARS YOK SIPARIS VEREN YOK YANI HIC SATIS YAPAMADIGIMIZ URUNLER I BU SEKILDE GETIRIRIZ...

// --select * from Products p left join [Order Details] od on p.ProductID=od.ProductID
// --Urunlerin hepsi de geldi bu su anlama geliyor Products ta olup da OrderDetails de olmayan yok demektir
// --Hem inner join olanlari hem de sol da olmayanlari getiriyor bu sekilde

//--LEFT JOIN -HEM CAKISANLAR HEM DE MUSTERI DE OLUP AMA SIPARISTE OLMAYANLAR YANI SIPARISI OLMAYAN MUSTERILER
//--select * from Customers c left join Orders o on c.CustomerID=o.CustomerID where o.CustomerID
//BIZ BU TABLOYU WHERE ILE FILTRELER VE NULL LARI GETIRIRIZ
//select * from Customers c left join Orders o on c.CustomerID=o.CustomerID where o.CustomerID is null


/*
--ONEMLI!!! GERCEK HAYAT SENARYOSU
--BIZE MUSTERI OLARAK KAYDOLMUS AMA BIZDEN URUN ALMAMIS LISTESINI BANA GETIR BEN ONLARA KAMPANYA UYGULAYACAGIM
-- BIZDEN URUN ALMAMIS MUSTERILERI URUN ALMAYA TESVIK ETMEK ICIN ONLARA OZEL KAMPANYA UYGULAYACAGIM VE ONLARI
--AKTIF MUSTERI HALINE GETIRMEK ISTIYORUM
--BAZEN E-TICARET SITESINE KAYIT OLURSANIZ DER KI SANA OZEL ILK SIPARISINDE 20% INDIRIM
--SANA OZEL OLAN SENI BULURKEN BU SORGUYU CALISTIRARAK BULUYOR
--ARKA PLANDA KAMPANYA YONETIM SAYFALARI OLUR E-TICARET SITELERINDE, BIZIM GOREMEDIGIMIZ KAMPANYAYI GIRER BU BILGI
-- YI SECER BASAR DUGMEYE BU MUSTERILERE GONDERIR KAMPANYA BILGISINI 
--solda olmayip sagda olanlari gormek icin sagda olmayanlar null olarak gelir ve null lar is ile gosterilir
--IS NULL-OLARAK GOSTERILIR
--BIR VER BIRYERDE YOKSA O NULL DUR VE YAZARKEN =NULL OLMAZ IS NULL OLUR!!!
--JOIN DE KOSULLARI BIZ IKI TABLODA DA BULUNAN PRIMARY KEYE UYGULARIZ AKSI TAKDIRDE DIGER VERILER 
--DE BAZEN NULL OLABILIR O ZAMAN ZATEN ESLESTIREMEYIZ...
*/
//SQL LEFT JOIN Keyword
//The LEFT JOIN keyword returns all records from the left table (table1), and the matching records from the right table (table2). The result is 0 records from the right side, if there is no match.

//SQL LEFT JOIN Example
// The following SQL statement will select all customers, and any orders they might have:
//SELECT Customers.CustomerName, Orders.OrderID FROM Customers LEFT JOIN Orders ON Customers.CustomerID = Orders.CustomerID ORDER BY Customers.CustomerName;
//Note: The LEFT JOIN keyword returns all records from the left table (Customers), even if there are no matches in the right table (Orders).
//NORMALDE INNER JOIN ILE HER IKI TABLO DA DA CAKISANLARI GETIRIYORDU BURDA ISE SOLDAKI TABLONUN TAMAMINI GETIRIYOR..SAGDAKI TABLODA ISE SADECE CAKISAN DATALARI GETIRECEK...PEKI CAKISMAYANLARIN KARSISINA NE GETIRIYOR MADEM KI SOL DAKI TABLONUN HEPSINI GETIRIYORSA, SOL DAKI TABLODAKI KOLONA KARSILIK DEGERI OLMAYAN SAGDAKI TABLODAN GELEN ALAN A NULLL GELECEKTIR KARSILIGI OLMAYAN YERLER ICIN

//SQL RIGHT JOIN Keyword
/*
--RIGHT JOIN----!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
--SAGDAKI TABLODA OLUP SOLDAKI TABLODA OLMAYANLARI DA GETIR.....
--DOLAYISI ILE BIZ SAGDA OLUP SOLDA OLMAYANLAR DIYE QUERY YAPARKEN LEFT JOIN DE YAZDIGIMIZ TABLOLARIN YERINI
--DEGISTIREREK AYNI VERILERE RIGTH JOIN ILE DE ULASABILIRIZ

--select * from Customers c right join Orders o on c.CustomerID=o.CustomerID
-- bu customers tablosu ile orders tablosu icindeki ortak customerid leri getirir bize ve ayrica sagda olup da
-- solda olmayanlari da getirir ama sagda olup da solda olmayan diye birsey olmayacagi icin ekstra cok da birsey
--getirmeyecektir aslinda

--select * from Customers c right join Orders o on c.CustomerID=o.CustomerID where c.CustomerID is null
--Bu sorgu hicbirsey getirmez cunku siparist e olup musteri de olmayan diye birsey yoktur siparis varsa musteride
--vardir cunku
--select * from Orders o right join Customers c on o.CustomerID=c.CustomerID where o.CustomerID is null
--BURDA LEFT JOIN ILE YAPTIGIMIZIN AYNISINI RIGHT JOIN ILE SORGUDAKI TABLO YERLERINI DEGISTIREREK ELDE ETTIK
--NORMALDE RIGHT JOIN DE LEFT JOIN DE KULLANILABILIR AMA ANA TABLO ONCE YAZILDIGI ICIN GENELLIKLE ONDAN DOLAYI
--DAHA COK LEFT JOIN TERCIH EDILIR!!!!!!
*/

/*
-- IKIDEN FAZLA TABLOYU JOIN ETMEK ICIN NE YAPARSIN!!!!!
select * from Products p inner join [Order Details] od on p.ProductID=od.ProductID 
inner join Orders o on od.OrderID=o.OrderID

--	ikiden fazla tablo yu birlestirmek istersek de ilk 2 tablonun sorgusu bitince inner join tekrar bir tablo daha
--ekleriz..

*/


/*
	YENI BIR SENARYO DIKKAT EDELIM...GROUP BY KULLANIMI
 --Elimizde yeni bir senaryomuz var yonetim dedi ki hangi kategori de elimizde kac farkli urunumuz var diye sordu
  --Tum kagerileri ayri ayri kacar tane urunumuz var onu gormek istiyoruz..
  --Kategorilerin id lerini ve yanlarinda kacar tane urun var her kategoriden onu istiyoruz
  --ONEMLI!!!!!BUNA DIKKAT ET..

   -- select * from Products group by CategoryId =>Bu herhangi bir veri getirmeyecektir cunku group by kullandi
  --gimiz zaman bu datami categoryId ye gore grupla demektir dolayisi ile burda * olmamalidir.
  --Group by ile calisirken select ettiginiz kolon sadece ve sadece group by dan sonra yazdiginiz alan olabilir 
  --ve kumulatif datalar olabilir count(*) gibi dolayisi ile biz categoryId ye gore gruplayalim simdi

  --select CategoryId from Products group by CategoryId
*/
/*
		GROUP BY - COUNT
  --Datamizi tamamen ve tamamen group by ifadesinde belirtilen e gore verdik
  --Bu demektir ki categorilerin icine bak ve tum kategorileri tekrar etmeyecek sekilde bana listele demektir
  --Group by yaptigin zaman aslinda her bir grup icin arka planda tablo olusturuluyor mus gibi dusunebilirsin
  --Burasi kategoryId leri benzersiz bir sekilde getir demektir ama buraya biz eger count(*) eklersek  o zaman
  --da demis oluyorz ki tum satirlar icinde categor ylere gore kacar adet varsa her katagoriden  onun sayisini getir
  --demektir

    --select count(*) Adet from Products 
  --Burda grouop by olmadigi icin bir kere donuyor arkada ve hesaplama yapiyor
  --Ama asagidaki group by ile yapilan sorguda ise group bu old icin her bir kategori icin bir count calisir arkada
  --21
  --select CategoryId,count(*) from Products group by CategoryId
  --1 numarali kategoriden 12 adet, 2 numarali kategori den 12 adet seklinde her kategoriden kacar 
  --satir varmis onu buluruz
 --Burda yazilan count her kategori icin ayri ayri hesaplaniyor yani her bir grup elemani icin ayrica count hesap
 --laniyor
 --IKI KOLONA BIRDEN GROUP BY DA YAPABILIRZ
  --select CategoryId,SupplierId, count(*) from Products group by CategoryId,SupplierId
*/
/*
 --COK ONEMLI GERCEK HAYATTAN ORNEKLER
 --Bunlar Karar Destek Sistemlerinde yani KDS sistemlerinde yogun olarak kullanilmaktadir
 --Yonetim sunu ister senden hangi kategorilerde az urunumuz varsa oralari besleyelim cunku oralarda eksik kalmisiz demektir
 --Bana urun sayisi 10 dan az olan kategorileri listele diyebilir
--Bu tarz taleplerde biz where kosulunu kumulatif dataya yazariz yani ustuste toplanmis ve gruplanmis dataya
--Bu yuzden group by larda kumulatif dataya yazilan kosul having olarak yazilir
--HAVING-- KUMULATIF DATAYA YAZILIR....
--URUN CESIDI 10 TANE DEN AZ OLAN URUN KATEGORILERININ SAYISI GETIRMEMIZ ISTENIRSE ASAGIDAKI SORGUYU YAZARIZ...

--select CategoryId, count(*) from Products group by CategoryId having count(*)<10
--count() parantez icine ne alirsa onun sayisini alir, avg() bu da ortalamasini getirir, sum() toplami getirir
--HICBIRZAMAN UNUTMA HAVING KUMULATIF DATALARA YANI COUNT(*) GIBI DATALARA UYGULANIR
--PEKI ONCE WHERE ILE BIR SART VERELIM YANI WHERE ILE BIR FILTRELEME YAPALIM....
--HER ZAMAN ONCE WHERE CALISIR UNUTMAYALIMMMM


--select CategoryId, count(*) from Products where UnitPrice>20 group by CategoryId having count(*)<10
--UnitPrice i 20 den buyuk olan urunleri kategoriye gore grupla onlardan da sayisi 10 tanenin altinda olanlari getir
--Once veriyi filtreler where ile daha sonra group by ile categoriye gore gruplar sonra da sayisi 10 dan az olani
--getirirr
--Biz UnitPrice>20 deyince sayilar azaldi ve kategori sayisi 10 dan kucuk olan kategori adetleri artmis oldu
*/

//SQL FULL OUTER JOIN Keyword
//The FULL OUTER JOIN keyword returns all records when there is a match in left (table1) or right (table2) table records.
//Tip: FULL OUTER JOIN and FULL JOIN are the same.

//SELECT column_name(s) FROM table1 FULL OUTER JOIN table2 ON table1.column_name = table2.column_name WHERE condition;
//Note: FULL OUTER JOIN can potentially return very large result-sets!
//SELECT * FROM [Customers] as c full join [Orders] as o ON c.CustomerID = o.CustomerID;
//Burda bazi Customers tablosu kolonlari null gelirken, Orders tablosundan da bazi columnlar null gelecektir

//SELF JOIN...TABLONUN KENDI ICINDEKI KOLONLARI ARASINDA BIRLESTIRME YAPARKEN 'WHERE ILE FILTERELME YAPIYORUZ..
//AYN SEHIRDEN OLAN ISIMLERI YANYANA GETIRIYOR... HEM SAGDA HEM DE SOL DA AYNI SEHIIRDEN OLAN CUSTOMER_NAME LERI GETIRIYOR...AYNI TABLO DA
//SELECT A.CustomerName AS CustomerName1, B.CustomerName AS CustomerName2, A.City FROM Customers A, Customers B WHERE A.CustomerID <> B.CustomerID AND A.City = B.City  ORDER BY A.City;

//The SQL UNION Operator
//The UNION operator is used to combine the result-set of two or more SELECT statements.
//Every SELECT statement within UNION must have the same number of columns
//The columns must also have similar data types
//The columns in every SELECT statement must also be in the same order

//UNION Syntax
//SELECT column_name(s) FROM table1 UNION SELECT column_name(s) FROM table2;

//UNION ALL Syntax
//The UNION operator selects only distinct values by default. To allow duplicate values, use UNION ALL:

//SELECT column_name(s) FROM table1 UNION ALL SELECT column_name(s) FROM table2;
//SELECT City FROM Customers UNION SELECT City FROM Suppliers ORDER BY City;
/*
SELECT City, Country FROM Customers
WHERE Country='Germany'
UNION ALL
SELECT City, Country FROM Suppliers
WHERE Country='Germany'
ORDER BY City;
*/
//SELECT 'Customer' AS Type, ContactName, City, Country
// FROM Customers
// UNION
// SELECT 'Supplier', ContactName, City, Country
// FROM Suppliers

//Note: If some customers or suppliers have the same city, each city will only be listed once, because UNION selects only distinct values. Use UNION ALL to also select duplicate values

//GROUP BY-
//The GROUP BY statement groups rows that have the same values into summary rows, like "find the number of customers in each country".
//The GROUP BY statement is often used with aggregate functions (COUNT(), MAX(), MIN(), SUM(), AVG()) to group the result-set by one or more columns.

//AYNI ULKEDEN KACAR TANE KAYIT VAR...VE HANGI ULKLELERE AIT..
//SELECT CustomerID, COUNT(CustomerID),Country from Customers GROUP BY Country;

//SIRALAMAYI BUYUKTEN KUCUGE GETIMEK ISTERSEK DE 
//SELECT CustomerID, COUNT(CustomerID),Country from Customers GROUP BY Country ORDER BY COUNT(CustomerID) DESC ;

//GROUP BY With JOIN Example
//The following SQL statement lists the number of orders sent by each shipper:
//Her bir supplier in kac ar tane siparisi var bunu bu sekilde bulabiliriz... 
//SELECT OrderID,COUNT(Orders.ShipperID),Shippers.ShipperName from Orders inner join Shippers on Orders.ShipperID = Shippers.ShipperID GROUP BY ShipperName;

//The SQL HAVING Clause-GROUP BY I KULLANDIGMIZ AGGREAGATE FUNCTIONS LARINA KOSULU WHERE ILE VEREMIYORUZ ONDAN DOLAYI HAVING KULLANIRIZ BOYLE DURUMLARDA
//The HAVING clause was added to SQL because the WHERE keyword cannot be used with aggregate functions.
/*
SELECT column_name(s)
FROM table_name
WHERE condition
GROUP BY column_name(s)
HAVING condition
ORDER BY column_name(s);
*/
//The following SQL statement lists the number of customers in each country. Only include countries with more than 5 customers:
//SELECT CustomerName,COUNT(Country) FROM [Customers] GROUP BY Country HAVING COUNT(Country) > 5 ORDER BY CustomerName DESC ;
//GROUP BY DA GENELLIKLE HEP ID UZERINDEN BIZ COUNTU YAPMAYA CALISALIM...YANI COUNT OLARAK ID YI SAYARIZ...AMA GROUP BY OLAN HANGI TEKRARLARI OLAN KOLONU SAYACAKSAK ONU SAYARIZ...
//SELECT CustomerName,COUNT(CustomerID) FROM [Customers] GROUP BY Country HAVING COUNT(Country) > 5 ORDER BY CustomerName DESC ;

//BESTPRACTISE...HATA COK ALININAN BIR DURUM..BUNA DIKKAT EDELIM...EGER INNER JOIN YAPARKEN IKI TABLODA DA AYNI ISIM KULLANILMIS ISE O ZAMAN O KOLON ISIMLERINI DIREK KULLANAMAYIZ ONUN YERINE TABLO ISMI (NOKTA). KOLON ISMI  DIYE KULLANIRSAK SQL ANLAYACAKTIR....

//--The following SQL statement lists the employees that have registered more than 10 orders:
//SELECT  OrderID,Orders.EmployeeID,COUNT(OrderID) FROM Orders inner join Employees ON Orders.EmployeeID = Employees.EmployeeID GROUP BY(Orders.EmployeeID) HAVING COUNT(OrderID) > 10 ORDER BY COUNT(OrderID) DESC

//SELECT Employees.LastName, COUNT(Orders.OrderID) AS NumberOfOrders FROM (Orders INNER JOIN Employees ON Orders.EmployeeID = Employees.EmployeeID)
//GROUP BY LastName HAVING COUNT(Orders.OrderID) > 10;

/*
The following SQL statement lists if the employees "Davolio" or "Fuller" have registered more than 25 orders:

SELECT Employees.LastName, COUNT(Orders.OrderID) AS NumberOfOrders
FROM Orders
INNER JOIN Employees ON Orders.EmployeeID = Employees.EmployeeID
WHERE LastName = 'Davolio' OR LastName = 'Fuller'
GROUP BY LastName
HAVING COUNT(Orders.OrderID) > 25;

*/



/*
*********************************************** ONEMLI....
FROM(), IN()..DIKKAT EDELIMM...ILLA EZBER YAPMAYALIM....SQL DEN FILTRELEME YAPARAK SELECT ILE VEYA INNER JOIN DONUSUNDE GELEN TABLOYU DA VEREBILYROUZ...BURDA....COOOK ONEMLI..BU KULLANIMA COK IHTIYACIMZ OLACAK.....  

BESTPRACTISE DIKKKAT EDELIMMM....BIZ FROM DAN SONRA BIR TABLO GELMESI GEREKIYOR BURDA IKI TABLO NUN JOIN EDILMIS HALINI DE YAZABILIRIZ VEYA SELECT ILE YINE BASKA BIR TABLO DAN FILTRELME YAPTIMGIZ TABLO YU DA GETIRIP KULLANABLIRIZ.... SQL DE YAPTIMGIZ HER TURLU FILTRELME SELECT ISLEMI INER JOIN LERDEN GELEN DATALAR DA BIRERE TABLODUR ESASEN.....
SELECT Employees.LastName, COUNT(Orders.OrderID) AS NumberOfOrders FROM (Orders INNER JOIN Employees ON Orders.EmployeeID = Employees.EmployeeID)
GROUP BY LastName HAVING COUNT(Orders.OrderID) > 10;

SELECT Count(*) AS Distinct Countries FROM (SELECT DISTINCT Country FROM Customers);

The following SQL statement selects all customers that are from the same countries as the suppliers:
SELECT * FROM Customers WHERE Country IN (SELECT Country FROM Suppliers);

SELECT column_name(s) FROM table_name WHERE EXISTS (SELECT column_name FROM table_name WHERE condition);

SELECT column_name(s) FROM table_name WHERE column_name operator ANY (SELECT column_name FROM table_name WHERE condition);
(Note: The operator must be a standard comparison operator (=, <>, !=, >, >=, <, or <=).)

Select ProductName from Products where ProductID = ANY (SELECT ProductID FROM OrderDetails where Quantity > 99);
************************************************ ONEMLI...

The SQL EXISTS Operator
The EXISTS operator is used to test for the existence of any record in a subquery.
The EXISTS operator returns TRUE if the subquery returns one or more records.
SELECT column_name(s) FROM table_name WHERE EXISTS (SELECT column_name FROM table_name WHERE condition);

The following SQL statement returns TRUE and lists the suppliers with a product price less than 20:
SELECT SupplierName FROM Suppliers
WHERE EXISTS (SELECT ProductName FROM Products WHERE Products.SupplierID = Suppliers.supplierID AND Price < 20);

--The following SQL statement returns TRUE and lists the suppliers with a product price equal to 22:
SELECT SupplierName from Suppliers WHERE EXISTS(SELECT Price from Products WHERE Products.SupplierID = Suppliers.SupplierID AND Products.Price = 22)

SQL ANY and ALL Operators
The ANY and ALL operators allow you to perform a comparison between a single column value and a range of other values.

The ANY operator:

returns a boolean value as a result
returns TRUE if ANY of the subquery values meet the condition

Note: The operator must be a standard comparison operator (=, <>, !=, >, >=, <, or <=).

The SQL ALL Operator

The ALL operator:

returns a boolean value as a result
returns TRUE if ALL of the subquery values meet the condition
is used with SELECT, WHERE and HAVING statements
ALL means that the condition will be true only if the operation is true for all values in the range. 

ALL Syntax With SELECT
SELECT ALL column_name(s) FROM table_name WHERE condition;
ALL Syntax With WHERE or HAVING SELECT column_name(s) FROM table_name WHERE column_name operator ALL (SELECT column_name FROM table_name WHERE  condition);
Note: The operator must be a standard comparison operator (=, <>, !=, >, >=, <, or <=).

The following SQL statement lists the ProductName if it finds ANY records in the OrderDetails table has Quantity equal to 10 (this will return TRUE because the Quantity column has some values of 10):

	SELECT ProductName FROM Products WHERE ProductID = ANY (SELECT ProductID FROM OrderDetails WHERE Quantity = 10);
	BURDA RESMEN SU YAPILIYOR..QUANTITY SI 10 OLAN ProductID kolonu ile listeyi getir...ama boyle bir liste var ise listeyi getir....Products listesinden ProductID ler in her birisini tek tek bizim getirdimgiz Quantity si 10 dan buyuk olan liste ile karsilastirip Quantity si 10 olan larin ProductName ini getir demis olyuruz...

	*********************BUNU BILMEK COOOOK ONEMLI.*********************************
	SIMDI BURDA SUNU BIR ANLAYALIM...BIZ INNER JOIN HARICINDE DE WHERE EXISTS,ANY,ALL  ...GIBI FARKLI SQL SYNTAX LARI ILE   IKI FARKLI TABLO ARASINDA ILISKI KURUP KARSILASTIRMALAR YAPIP FARKLI VARYASYONLARDA DATALARI

	The following SQL statement lists the ProductName if it finds ANY records in the OrderDetails table has Quantity larger than 99 (this will return TRUE because the Quantity column has some values larger than 99):
	Select ProductName from Products where ProductID = ANY (SELECT ProductID FROM OrderDetails where Quantity > 99);

	The following SQL statement lists the ProductName if it finds ANY records in the OrderDetails table has Quantity larger than 1000 (this will return FALSE because the Quantity column has no values larger than 1000):
		SELECT ProductName
FROM Products
WHERE ProductID = ANY
  (SELECT ProductID
  FROM OrderDetails
  WHERE Quantity > 1000); sonucu 0 gelir yani false oldugu icin bos gelir

  Bununla da tum Products isimlerini getirir..... 
  SELECT ALL ProductName FROM Products WHERE TRUE;

 SQL SELECT INTO Statement
  The SELECT INTO statement copies data from one table into a new table.

  SQL SELECT INTO Examples
  The following SQL statement creates a backup copy of Customers:
  SELECT * INTO CustomersBackup2017 FROM Customers;

  The following SQL statement uses the IN clause to copy the table into a new table in another database:
  SELECT * INTO CustomersBackup2017 IN 'Backup.mdb' FROM Customers;

  The following SQL statement copies only a few columns into a new table:
SELECT CustomerName, ContactName INTO CustomersBackup2017 FROM Customers;

The following SQL statement copies only the German customers into a new table:
SELECT * INTO CustomersGermany FROM Customers WHERE Country = 'Germany';

The following SQL statement copies data from more than one table into a new table:

SELECT Customers.CustomerName, Orders.OrderID
INTO CustomersOrderBackup2017
FROM Customers
LEFT JOIN Orders ON Customers.CustomerID = Orders.CustomerID;


Tip: SELECT INTO can also be used to create a new, empty table using the schema of another. Just add a WHERE clause that causes the query to return no data:
SELECT * INTO newtable
FROM oldtable
WHERE 1 = 0;

The SQL INSERT INTO SELECT Statement

The INSERT INTO SELECT statement copies data from one table and inserts it into another table.

The INSERT INTO SELECT statement requires that the data types in source and target tables match

INSERT INTO SELECT Syntax
Copy all columns from one table to another table:

INSERT INTO table2
SELECT * FROM table1
WHERE condition;

Copy only some columns from one table into another table:
INSERT INTO table2 (column1, column2, column3, ...)
SELECT column1, column2, column3, ...
FROM table1
WHERE condition;

The following SQL statement copies "Suppliers" into "Customers" (the columns that are not filled with data, will contain NULL):

INSERT INTO Customers (CustomerName, City, Country)
SELECT SupplierName, City, Country FROM Suppliers;

The following SQL statement copies "Suppliers" into "Customers" (fill all columns):

INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)
SELECT SupplierName, ContactName, Address, City, PostalCode, Country FROM Suppliers;


The following SQL statement copies only the German suppliers into "Customers":
INSERT INTO Customers (CustomerName, City, Country)
SELECT SupplierName, City, Country FROM Suppliers
WHERE Country='Germany';


The SQL CASE Expression

The CASE expression goes through conditions and returns a value when the first condition is met (like an if-then-else statement). So, once a condition is true, it will stop reading and return the result. If no conditions are true, it returns the value in the ELSE clause.

If there is no ELSE part and no conditions are true, it returns NULL.

CASE
    WHEN condition1 THEN result1
    WHEN condition2 THEN result2
    WHEN conditionN THEN resultN
    ELSE result
END;

The following SQL goes through conditions and returns a value when the first condition is met:

SELECT OrderID, Quantity,
CASE WHEN Quantity > 30 THEN 'The quantity is greater than 30'
WHEN Quantity = 30 THEN 'The quantity is 30'
ELSE 'The quantity is under 30'
END AS QuantityText
FROM OrderDetails;

The following SQL will order the customers by City. However, if City is NULL, then order by Country:

	SELECT CustomerName, City, Country
FROM Customers
ORDER BY
(CASE
    WHEN City IS NULL THEN Country
    ELSE City
END);


SQL IFNULL(), ISNULL(), COALESCE(), and NVL() Functions


*/



//FIND_IN_SET BIR STRING LISTESI ICERISINDE BIR KELIME ARAMAMIZI SAGLIYOR
//BIZ OZELLIIKLE MANY TO MANY RELATION DA ORNEGIN BIR KATEGORIYE AIT BIRDEN FAZLA PRODUCT VAR VE HER BIR PRODUCT IN DA BIR DEN FAZLA KATEGORIIS OLABILDIGI DURUMLAR SOZ KONUSU OLUYOR VE BIZ KATEGORY TABLOSUNDA HER BIR KATEGORIYE AIT PRODUCT NAME I DE GIRMEK ISTIYORUZ O ZAMAN NASIL Y APIYORUZ PRODUCT NAME LERI ARALARINDA VIRGUL ILE AYIRARAK, YANYANA AARLARINDA VIRGUL OLAN STRINGLER HALINDE ARIYORUZ.... 
//'TV,PC,MOBILE-PHONE' GIBI YAZIYORUZ VE BIZIM BU STRING ICERISINDE ARAMA YAPMMAIZ GEREKIYOR
//SELECT FIND_IN_SET('D','A,B,C,D,E,F') VERITABANI KOLONUMUZDAKI DATA 2. PAREMETRE VE BIZ DE 1.PARAMETRE YI ARIYORUZ MESELA
//TABI BIZ GENELLIKLE ISIMLERDEN ZIYADE ID LERI YANYANA ARLARINDA VIRGUL OLACAK SEKILDE KAYDEDECGEIZ...
// '1,3,4' GIBI ID YAPARIZ CUNKU BU ID LERE KARSILIK GELEN DATA LAR DA ID LER HICBIR ZAMAN DEGISMEZ AMA KULLANICI NAME I DEGISTIREBILIR O YUZDEN ID LER KAYDEDILIR ZATEN
//VE BIZ DE ORNEGIN ID SI 3 OLAN LARI LISTELEMEK ISTIYORUZ VE ELIMIZDE '1,3,4' BU SEKILDE BIR ALAN VAR BUNU NASIL YAPARIZ?
//WHERE ID IN(3) DERSEK SADECE BASLANGICINDE 3 OLANLARI GETIRIR DOGRU BIR SONUC OLMAZ VE BU YAKLASIMLA YAPAMAYIZ
//LIKE ILE DE YAPAMIYORUZ WHERE ID LIKE '%2%' DEYINCE GIDIP 22 OLAN ID YI DE ALIYOR BU SEFER BU DA OLMUYOR
//ISTE BIZIM BU ISLEMI FIND_IN_SET FONKSIYONU ILE YAPABILIYORUZ...COK ONEMLI BESTPRACTISE....
//ID ICERISINDE 2 OLAN LARI ALIRKEN
//SELECT * FROM DIZILER WHERE FIND_IN_SET(2,TURLER);(TURLER KOLON ADIDIR YANI ID LERI STRING ICINDE TUTUUTUMUZ KOLONUN ADI)
//ID ICERISINDE HEM 1 HEM 5 OLANLARI ALIRKEN
//SELECT * FROM DIZILER WHERE FIND_IN_SET(1,TURLER) && FIND_IN_SET(5,TURLER);
?>