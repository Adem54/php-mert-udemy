<?php
session_start();

/*
Mail  Gonderme islemi asamalarina gecelim simdide
1.adim -PHPMailer kutuphanesini send_emai.php sinifimizdat tanimlayacagiz
-ilk once require ile vendor/autoload.php yi yukleriz
-sonra bir kac tane namespace tanimlamasini use keywordu ile tanimlayacagiz daha dogrusu import edecegiz
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
Bu 3 satir islemden sonra artik biz, PHPMailer ve Exception class larin i istedgimiz gibi sayfamizda kullanabiliriz
PHPMailer, Exception PHPMailer kutuphanesinden gelen birer class tir ve biz onlari namespacelerin altindan use ile import ettik
2.adim 
-Mail gonderme islemi send_email.php dosyamizda olacak
Biz simdi mail gonderme islemini nerde yapacagiz kullanici formundan gelen datalari cek edip dogru bir sekilde alabildi isek o zaman
mail gonderme islemin yapiyoruz o zaman asagida if blogiunun true olarak girecegi kisimda yapariz
*/

require_once("./vendor/autoload.php");

//use ile bir kutuphanedeki namespace leri import ederken tersslash yapiyoruz dikkat edelimm
//require_once icinde yaptgimz slashin tersini yapiyoruz burda
//PHPMailer\PHPMailer\PHPMailer namespace i ve PHPMailer altindaki Exception namespaceini kullanacagiz
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//Eger herhangi bir post islemi varsa diyoruz, sayfaya gelen herhangi bir post islemini sorguluyyoruz
//Kodumuz if bloguna girerse demekki index.html deki inputlar bu sayfaya gonderilmis demektir
//Gelen data ici bos ya da dolu olabilir onun biz sadece buraya gonderildgini biliriz ama zaten biz html tarafindaki
//required attributumzle kulllanicinin bos data gondermesini onlemis oluyoruz
//Ama peki bizim sadece htmlde required yapmamiz yeterli olur mu hayir , cunku html sayfasi kullancilarin
//lokaline indigi icin, kullanici gidip inspect yapip kendisi attributu arka taraftan kaldirabilir ve biz yine de 
//bos data gondermeyi basarabilir..Dolayisi ile biz, hicbir zaman front-end de yapilan validation a guvenmememmiz gerekir
//Her zaman icin back-end de de cok guvenilir bir validation ile kullanicinin bos data gondermesini engellememiz gerekiyor
/*
print_r($_POST); $_POST bize kullanici nin inputta girdigi datalari veriyor
{
to_email: "ae@netsense.no",
sender: "adaad",
subject: "adda",
message: "adsfad"
}
*/
// print_r($_POST);
//once bir session baslatmamiz gerekir session i kullanabilmek icin


if(isset($_POST)){

if($_POST["to_email"] && $_POST["sender"] && $_POST["subject"] && $_POST["message"]) ://name i to_email olan form elemanindan buraya birssey gelmis mi onu bu sekilde kontrol edebiliriz
//Bu sekidle kullanici gelip required i silerse biz burdan tepki vererek ona bir onlem aliyoruz
//Eger tum alanlar dolu ise o zaman mesaji gondermeye izin verecegiz
   // echo $_POST["to_email"];
//    echo "Tebrikler tum alanlari doldurdun";

//DAHA MAILER ISLEMINE BASLAMADAN DOSYA UPLOAD ISLEMINI YAPARIZ UPLOAD ISLEMI GERCEKLESIR ISE MAIL GONDERME BASLASIN DIYECEGIZ
//Dosya gondermeyi dosya uzerinden dosya sec gibi birsey yapacaksak ilk once server a upload etmemiz gerekir
//Bir dosya yuklendigi zaman ve submit edildigi zaman  $_FILES[] icerisinde bize indis olarak gelecektir
//input type i file olan dosyadaki name e verdgimz degeru $_FILES["attachment"] icerisine yazarak alacagiz
$file=$_FILES["attachment"];
//print_r($file);
/*file dizi olarak gelecektir { name: "test.jpg",full_path: "test.jpg",type: "image/jpeg",tmp_name: "C:\xampp\tmp\phpFEBB.tmp",error: "0",size: "44304"
} */
//Biz dosyamizin upload islemini gerceklestirmemiz gerekiyor..dosyamizi su anda aldik ama upload etmedik
//move_uploaded_file() method u ile a yapariz bunu, ilk parametre dosyanin bulundugu path olacak, gondercegimzin bizim lokalimizdeki pathi
//Ama gidip pc deki  yerini bulup ordaki pathi kopyalarsak hatali olur slash ler saga yatik olacak sekilde  yazmamiz gerekir
//2.parametre olarak da dosya ismi $file["name"] indisi dosya ismini veriyordu bize onu da ordan aliyoruz ve move_uploaded bize boolean bir deger donuyor, eger true ise islem basarili degil ise o zamn da false gelir ondan dolayi if condition ile kontrol edelim
//Bir dosya islemi yaparken o dosya uzerinde yazma izninin olup olmadigini dosya uzerinde saga tiklaarak properties den gorebilriiz ve degistirebilirz yoksa islemimiz basarisz olacaktir
//Bu arda move_uploaded_file 2 tane parametre aliyorsmus hata aldik 

$is_uploaded=move_uploaded_file($file["tmp_name"],$file["name"]);
if($is_uploaded){


//Mailer islemini yapacagiz
//PHPMailer i kullanabiliyoruz cunku namespace i yukarda tanimlamis olduk, ve parametre olarak true oluyor
$mail=new PHPMailer(true);
//Simdi biz ne islemi yapiyoruz mail gonderme islemi o zaman biz bir server ile iletisim kuracagiz o zaman biz try-catch bloklari icinde yapmaliyiz. Biz ne zaman bir server ile iletisim kuruyorsak o zaman mutlaka try-catch bloklarini kullanmaliyiz
try {
//Mail gonderme islemini burda yapiyoruz
//1-Server ayarlari-Gmail kullanacagiz test etmek icin
//Gmail-security ayarlarindan 3.parti uygulamalar tarafinidan mail gonderme ozelligini aktif hale getirmemiz gerekiyor
//Yoksa mail gonderme yapamayiz
$mail->SMTPDebug=2;//SMTPDebug ozelligini 2 ile baslatiyoruz, butun adimlari 2 ile gorecegiz cunku, 1 yaparsak herhangi bir sonuc goremeyiz
//Gonderecegimz mail SMTP mi ona bakariz
$mail->isSMTP();//Gonderecegimiz mail smtp oldugunu beliritiriz bu sekilde yaparsak onun smtp true demis oluruz
//smtp protokollerine gore mail islemleri gerceklestiriri smtp sagliyor bu islemleri dolayisi ile o protokol oldugunu belirtmemiz gerekyor
$mail->CharSet = "utf-8";// set charset to utf8
//Simdi de server ayarlarimizi
//Hangi hosta gidecegin belirtiriz ve SSL kullanarak guvenlikli bir gonderim gerceklestirirz aksi halde spam gereksizler kutusna dusecektir
$mail->Host="ssl://smtp.gamil.com";
//Bu bilgileir internette gmail icin host bilgileri dersek bulabiliriz
$mail->SMTPAuth=true;//SMTP dogrulamasi olsun mu, evet olsun diyoruz, ki SMTP de dogrulamayi aktif hale getirmemiz gerekiyor
$mail->Username="testadem5434e@gmail.com";//kullanici adi bize ait mail adreisimizdir
$mail->Password="wcparouqtzbuwtpj";//Buraya mail adresimzin sifresi gelmesi gerekior
//Burda sunu bir arastiralim...sifre direk yaziliyor mu buraya nasil yapiliyor
$mail->SMTPSecure="tls";//Bu da tls olarak gidecek guvenlikli bir mail olarak
//Biz burda tls i kullandigmiz icin portumuz 465 olacak
//Mail gonderiminde Smtp de kendi icerisinde bircok islem yapiyor
///Eger hatalari gormek istemez veya sadece errorlari gorelim warningleri gormeyelim dersek o zaman en yukarda
//error_reportingi yazabiliriz...Birde biz bilincli olarak yukarda SMTPDebug=2 yaptik ki debug yapsin ve hatalari gorelim diye ama istrsek bunu 0 yaparak kapatabiliriz
//error_reporting(E_ERROR);
//error_reporting(E_WARNING);
//$mail->Port=465;
$mail->Port=465;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

//2-Alicilar-receipents-Alici ayarlari
//mail setFrom("hangi email adresinden gidecek","Gonderenin adindan gelen deger gelecek buraya");
$mail->setFrom("testadem5434e@gmail.com",$_POST['sender']);
//addAddress() bu mail nereye gidecek demek,hangi adrese gidecek yani hangi email adresine gidecek demek
//Gonderilecek adress te bize formdan geliyor ve biz formdan da onu aliriz 2.paramtre olarak da alici adresi isters yazar ister bos birakabiliriz 
//$mail->addAddress($_POST["to_email"],"");
$mail->addAddress("ademtest5434e@gmail.com","Contact-Form");

//$mail->addAddress("ademtest5434e@gmail.com","");
//ademtest5434e@gmail.com
//$mail->addBCC("","");//Gonderdigmiz email in bir kopyasinin baska biri tarafindan alinmaini istiyoruz ve bundan alicinin haberdar olmasini istemiyorsak o zaman kullaniriz
//$mail->addCC("","");//gonderdigmiz emailin bir kopyasinin baska birisi tarafindan alinmasini istiyorsak ve bundan alicinin da haberdar olmasini isteegimz durumlarda kullaniriz 
//addAttachement gmail gonderirken dosya gondermek icin $mail-phpmailer in addAttachement methodunu kullaniriz(icerisine dosya yolunu girmemiz gerekiyor)

$mail->addAttachment("files/test.jpg");//pef-dosyanin bulundug yol.file-direction
//Dosya secmeyi de bu arada dinamik  yapacagiz yani formdan alacagiz
//Bootstrap te bir tane daha input alacagiz
//Bir dosya transferi yapilacaksa form elementinin attributunde encription-type i formdata olarak vermemiz gerekir
//<form action="send_email.php" method="post" enctype="multipart/form-data">
//3-Gonderi ayarlar-Gonderme ayarlari
//mailimizin yapisini belirleriz duz bir metin mi yoksa tablo veya resim mi gonderecegiz
//Gonderecegimiz maili html formatinda gondermemiz gerekir gelismis bir mail gonderebilmek icin
$mail->isHTML(true);//html formatinda gonder i aktif hale getiriyoruz true yapiyoruz
//subject kismi formumuzdan gelecek
$mail->Subject=$_POST["subject"];
//Mailimizin body si o da bizim formumuz icerisindeki textarea mizdan gelecek
$mail->Body=$_POST["message"];


//TUM AYARLARI GERCEKLESTIRDIKTEN SONRA GONDERME ISLEMINI YAPACAGIZ...
if($mail->send()){
    //Eger mail gonderme islemi gerceklesirse burasi calisacak
    //Islem basarili olsa da olmasa da kullaniciya her turlu mesaj verebilmek icin form sayfasina yonlendirecegiz kullanici bilgilendirmek icin
    $alert=array(
        "message"=>"Mail is sent successfully",
        "type"=>"success",
    );

}else{
    $alert=array(
        "message"=>"An error occured about mailsending",
        "type"=>"danger",
    );
}

} catch (Exception $e) {
    //PHPMailer in kendi icinden gelen Exception sinifini kullaniyoruz neden cunku biz hicbir sey kullanmazsak olabilecek her turlu genel hata da bu catch bloguna dusecektir ondan dolayi biz bu islemi biraz daha spesifiklestirerek Exception type inda Exception class inda ki hatalari tut catch de diyoruz ve Exception type i veya class i icinde bulunan getMessage methodunu kullanarak o hatayi bana getir demis oluyoruz..bu sekilde de hatayi gorebiliriz
    
    //echo $e->getMessage();
    

   $alert=array(
    "message"=>$e->getMessage(),
    "type"=>"danger",
);
}
}else {
    $alert=array(
        "message"=>"An error occured when the file upload",
        "type"=>"danger",
    );
}

else :
    //Yoksa bootstrap in alertini kullanarak da kullaniciya mesaj larimizi donebiliriz..
    //Biz hata durumunda, yani input larin bos birakilmasi durmunda burdaki veriyi tekrar index.html e gonderemeyz
    //Bundan dolayi bu data hatali datayi gonderme islemi icin session lari kullaniriz
    //Eger burda hata var ise o zaman biz tekrar index.html(burasi php ye cevrilecek) sayfasin hata mesajlarimizi burdan gonderecegiz
    //neden type a danger dedik cunku eger basarili olur ise, green, error durumunda red,yani danger i bootstrap alertin icinde dinamkk bir sekilde
    //kullanacagiz ondan dolayi danger dedik
    $alert=array(
        "message"=>"Please fill in all fields",
        "type"=>"danger",
    );
  
endif;

//Bu sekilde sayfamizda 1 tane location kullandik ve array set etmis olduk
$_SESSION["alert"]=$alert;//Session da bir tane deger set ettik ve bunun adina alert dedik
//SESSION ile datayi gonderdik ama nerye gondereceksek oraya yonlendirme yapmamiz gerekiyor ki nereye gonderecegimizi anlasin php
//print_r($_SESSION["alert"]);
// exit();//veya die()  ile alttaki satirlari calismasini engelleyebiliriz
header("location:index.php");
}
/*
Bizim send_email den gonderdgimiz session i index.html de kullanabilmemiz iicn index.html i php sayfasina ceviririz
index.php yapariz burdan gonderdigmiz session i orda alabilmek icin index.php de de sesion_start ile session baslatmamiz gerekir

DEGUB YAPARKEN NE YAPIYORUZ
echo "message";
exit();
or
die()
*/

/*
Biz mail gonderme islemini yapabilmemiz icin composer kutuphanesini kulllanacagiz
composer i yuklersek bize cok hizli bir sekilde istedgimiz kutuphaneyi phpmailer kutuphanesin kullanacagiz biz mail gonderme sistemi icin
*/

/*
Email ile dosya gonderme islemini de halletmek icin assets in bulundgu direction a bir tane uploads isminde klasor aliriz
ardindan doraya 1 tane png koyariz
Ek dosya gondermek icin yine $mail den gelen $mail-> attachment diye bir ayar var oraya

*/

?>
