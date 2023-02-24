<?php 

//Bir işlemde toplu işlem yürütme

//Bir kerede birden fazla veritabani operasyonu yapma durumunda program kodlari icerisine PDO->beginTransaction() ve PDO->commit() methodlarini dahil ederek toplu islemler tamamlanana kadar baska kimse nin goremeyecegini php cekirdegini yazan kadro tarafindan size garanti etmektedir. Birseyler terse giderse yakalam blogu sayesinde $pdo->rollBack(); o ana kadar yapilan tum veritabani islemleri geri alinacaktir ve bir hata mesaji yazdirir


$conn = new PDO( "sqlsrv:server=(local); Database = Test", "", "");

  $conn->beginTransaction(); 

try{

$ekle = $conn->exec("insert into Table1(col1, col2) values('a', 'b') ");  
$ekle = $conn->exec("insert into Table1(col1, col2) values('a', 'c') ");  
$ekle = $conn->exec("delete from Table1 where col1 = 'a' and col2 = 'b'"); 
 
 $conn->commit();

}catch(Exception $e){
    
    echo $e->getMessage();

    //İşlemi geri al.

    $pdo->rollBack();
}

/*
İşlem Şartlarının Açıklaması.
Begin transaction: İşlem başlatıldı ve MySQL'in varsayılan otomatik devreye alma özelliği devre dışı bırakıldı. Örnek: INSERT sorgusu çalıştırırsanız, veriler hemen eklenmez.
Commit: Bir işlem yaptığınızda, temel olarak MySQL'e her şeyin yolunda gittiğini ve sorgularınızın sonuçlarının son haline getirildiğini söylüyorsunuz.MYSQL ARTIK KAYDEDEBILIRSIN DEVREYE GIREBILIRSIN DIYOURZ...ISLEMLERIMIZ YOLUNDA GITTI DIYE
Rollback: PDO::beginTransaction() ile başlatılan toplu hareketi geri alır. Bir toplu hareket etkin değilken bu yöntemin çağrılması bir hataya sebep olur.

*/

?>


