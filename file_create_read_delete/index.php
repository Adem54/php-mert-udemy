<?php 
//Create File
//touch methodu ile yeni bir dosya olusturabilirz php de
touch("test.txt",time() - 84000 );

//fopen();Dosya acmak icin kullaniriz
//fclose();Dosya kapatmak icin kullaniriz
//fwrite(); dosya iciine yazmak icin kullaniriz
//fread(); dosya okumak icin kullaniriz
//fgets(); satir satir dosyayi okur
//feof(); Dosyanin sonuna gelinip gelinmedigini dondurur
//filesize($dosya) dosyanin karakter sayisini bulabilirz
//unlink() ile biz bir dosyayi silebiliriz 


/*fopen in 2.paramtresi kipler
r-okumak icin ac
r+-okumak ve yazmak icin ac(dosya yok ise olusturmaz)
w-yazmak icin ac(dosya yok ise olusturulur varsa ustune yazar)
w+-okumak ve yazmak icin ac
a-yazmak icin acip dosyanin sonuna ekliyor-append
a+-okuak ve yazmak icin ac
*/
//Eger dosya icerisinde hicbirsey yok ise o zaman okumak icin acamayiz dosyayi

//$my_file=fopen("test.txt","w");//Bundan once icerik yazilmis ise onu siler yerine bu yazdimigzi yazar

//Dosya islemlerinde her zaman icin bir siralam takip etmemiz gerekir bu islem veritabani ve ona benzer islemlerin hepsinde
//nerdeyse ayni mantikta calisir

//ELIMIZDEKKI DOSYANIN ICINE HELLO WORLD YAZDIK VE OKUMAYA CALISALIM
//Biz herseyden once dosyayi acmamiz gerekir..yani bir baglanti kurmak gibi
//Dosya yi acmadan okuyamayiz..VE dosyayi acarken de hangi islemi yapmak icin actigimzi belirtmeliyz mutlaka bunu unutmayalim
//En son isimiz bitince de dosya tekrar kapatlir ayni veritabaninda veri tabani baglantisinin koparildigi gibi
$file = fopen("test.txt","r");
$res = fread($file,15);//15 karakter oku diyoruz.Bize okudugu texti dondurur return olarak 
echo $res;
fclose($file);

//Eger fopen yaninda dosya izini olarak "w" verir isek o zaman, dosyada bulunan icerigi siler sonra bizim verdigmiz icerigi dosyaya yazar
$my_file =  fopen("test.txt","w");
$text = "My name is Adem";
fwrite($my_file,$text);
fclose($my_file);
//Islemleri yaparken suna dikkat edelim.Once dosya actik ve dosya yi hangi islem i yapmak icn acti isek ardindan 
//o islemleri yapalim yoksa hata aliriz...

//fopen islemi bizim verdgimz dosya ismini arar eger bulamazsa kendisi o isimdeki dosyayi olusturur yani touch methodunun yaptigi isi de aslinda yapmis oluyor
//Biz simddi istiyoruz ki test1.txt te de var olan icerigimiz silinmeden yeni girilecek icerik eski icerigin sonuna eklensin.. 
$my_test_file = fopen("test1.txt","a+");
$content="\nThis is my new content".rand(0,1000). "\n";
fwrite($my_test_file,$content);//Bu sekilde icerigimzin mevcut datamizin sonuna eklendigini gorebiliriz

fclose($my_test_file);
//Burda suna da dikkat etmeliyiz..Biz dosyamizi hangi islem icin acti isek o islemi yapariz ardindan fclose ile dosya
//mizi kapatiriz ondan sonra yapacagimz baska islemler icin tekrar dosya acar ve o islemleri yapariz

echo "<br>****************<br>";
//Biz bir dosyada bulunan karakter sayisinin filesize methodu ile bulabiliriz
$myFile = fopen("test1.txt","a");
$file_size =  filesize("test1.txt");
echo $file_size;//72
echo "<br>";
$read_res = fread($myFile,$file_size);//Bu sekilde demis oluyoruz ki sen git ne kadar icerik var ise hepsini oku demis olyoruz
echo $read_res;
echo "<br>****************<br>";
fclose($myFile);
//Simdi de fgets ile okuyalim
//fgets satir satir okuyor

//Her bir yazdimgiz kod icin yeni bir satir okuyor
$my_new_file = fopen("test1.txt","a+");
echo fgets($my_new_file)."</br>";
echo fgets($my_new_file)."</br>";
echo fgets($my_new_file)."</br>";
echo fgets($my_new_file)."</br>";
echo fgets($my_new_file)."</br>";
echo fgets($my_new_file)."</br>";

//Peki biz bir dosya okurken boyle mi yapacagiz satir satir 1000 satir varsa 1000 satir kod mu yazacagiz
//Tabi ki hayir...while dongusunu kullanmaya harika bir ornek ..var burda...
//Bu islemi yaparken de bize bir veri daha lazim while dongusu ile okyacagiz ama bizim stop kriterimiz ne olacak tabi ki 
//son satiri ne zaman okudugumuzu bilmemiz gerekiyor bunun icin 
//iste bu islemi de yapacagimz bir methodumuz var 
//feof() methodu ile biz dosyamizin son satirina gelip gelmedgimizi kontrol edebiliyoruz....

echo "#################";
$res2 = feof($my_new_file);
var_dump($res2);//false
echo "#################";

if($res2){
	echo "Dosya sonuna gelindi";
}else {
	echo "Dosya sonuna gelinmedi";
}
echo "&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&";

//BU SEKILDE BIR DOSYAYI SON SATIRINA KADAR OKUYABILIRIZ...BESTPRATISE VE BUNU COK FAZLA KULLANAAGIZ...
while(true){

	if(!feof($my_new_file)){
		echo fgets($my_new_file)."</br>";
	}else{
		break;
	}
}
fclose($my_new_file);//Dosya islemimiz sona erince, dosya mizi da kapatmamiz gerekiyor

//DOSYA ICERGIMIZI DIZI ICERISINDE ALMAK - file()
//SIMDI DE DOSYA ICERIGIMIZI BIR DIZI ICERISINE HER BIR SATIRI DIZININ BIR ELEMANI OLARAK NASIL ALABILIYORUZ ONA BAKALIM
$content_values = file("test1.txt");

//print_r($content_values);

//ICERIGIN TAMAMINI STRING OLARAK ALMAK-  file_get_contents()
$my_content = file_get_contents("test1.txt");
echo "<br>".$my_content;
//file_get_contents methodunu kullanarak bir web sitesinin kaynak kodunuda alabiliyoruz
$_content=file_get_contents("https://www.erbilen.net/");
//echo $_content;

//file_put_contents ile icerigie yeni icerik eklemek, ama override edecek sekilde yazar bu method ile
file_put_contents("test1.txt","this is new content");

//ama eger ki override degil de sonuna eklemesini istersek file_put_contents ile o zaman da
file_put_contents("test1.txt","\n Hello Adem \n",FILE_APPEND);

$my_content = file_get_contents("test1.txt");
echo "<br>".$my_content;

//PEKI BIR DOSYA VE DIZININ VAR OLUP OLMADIGININ NASIL KONTROL EDERIZ?
//BU COK ONEMLIDIR ORNEGIN EGER BIR DOSYANIN VAR OLUP OLMADIGINDAN EMIN OLMADAN 
//SILMEYE CALISIRSAK, HATA ALIRIZ..BUNDAN DOLAYI BIZIM DOSYANIN VARLIGININ DA COK FAZLA KONTROL
//ETMEMIZ GEREKECEK...
//TABI KI file_exist veya is_file, klasor un varligini da is_dir ile kontrol ediyordukk..
//BIR DE DOSYA SILME ISLEMIN UNLINK METHODU ILE YAPARIZ
echo "<br>";
$check_is_file_exist = file_exists("test2.txt");
if($check_is_file_exist){
	echo "Boyle bir dosya var oldugu icin bu dosyayi silecegiz:";
	unlink("test2.txt");
	
}else{
	echo "Boyle bir dosya olmadigi icin dosya yi silemeyiz";
}

//BU KULLANIM PHP DE BIZIM ICIN COK ONEMLI BIR MANTIK VE ANLAYIS OLMALIDIR...CUNKU BIZ HATALARI YONETMEMIZ GEREKIYOR
//BUNUN ICINDE ISSET,EXIST,FILE_EXIST GIBI VARIABLE,FUNCTION,FILE VARLIGINI SORGULAYAN METHODLARI COK SIK KULLANACAGIZ...

//CHMOD AYARLARINNIN YAPILMASI-DOSYA IZINLERININ AYARLANMASI
/*
chmod()
1-Numara 0 ile baslar
2-2.numara dosya sahibi izinlerini temsil eder
3-3-numara kullanici gruplari izinleri
4-4.numara geri kalan herkesin
Ve burda numaralarin 7 ye kadar olmasinin da bir sebebi var
1=execute(islem) izni sagliyor
2-yazma izni
4-okuma izni
*Bu ucunun toplami 7
Eger 2.numara da 7 var ise 2.numara dosya sahibi izinleri idi, dosya sahibine 
tum izinler verilmis demekir eger 2.numara 7 ise
3.numara da 7 var ise kullanici gruplarina tum izinler verilmis demektir(7 olunca uzerinde islem yapabiliyor, yazabiliyor ve okyabiliyor demek)
7 ise demekki 1(execute-islem izni)+2(yazma izni)+4(okuma izni) =7(tum izinler ok demek)
5 olsa idi o zaman 1 ve 4 izni alinmis demektir o da 1-execute(islem izni) ve 4-okuma izni var demektir

Ornegin biz dosya sahibine tum izinleri vermek istiyoruz ama onun disindakilere sadece dosyayi okuma izni vermek istiyoruz
*/
//chmod("test.txt",0764);
//Dosya sahibine tum izinleri(1+2+4) verdik onun disindaki kullanici gruplarina  okuma ve yazma izni(2+4) verdik ve onun disindaki herkes e de
//sadece okuma izni vermis olduk(4)
//Sayfamizi calistirdiktan sonra dosyamiza gidip saga tiklayip egenskaper-properties den izinleri inceleyebilirz
chmod("test.txt",0740);
//Guvenlik aciklari olusmamasi icin dosya islemlerinde chmod ile izinleri ayarlammiz gerekir
//Bu sadece php de fonksiyon ile yapilacak diye bir kural yok direk dosya uzerinden veya ftp dosya ayarlarindan da bu islemleri yapabiliyoruz
?>