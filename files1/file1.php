<?php 

//scandir ve glob methodlarini cok fazla kullanacagiz.. dosyalari mizi dizi icerisinde listelemek icin

//1.scandir
$my_files = scandir(".");
print_r($my_files);//[".","..","file1.php","test1","test2"];
//Oncelikle sunu belirtelim...dosya dizin islemlerinde biz bazen bir klasoru altinda ne kadar ic ice klasor ve dosya var ise hepsini sonuna kadar almak isteyebiliriz. Iste boyle durumlarda bizim recursive fonksiyonlardan yararlanarak harika bestpractise islmler yapabilecegiz...

//Php kontrol dilidir bir kere bunu her zaman aklimizda tutalim ve yeni olarak arayacagimz hersey in kontrolu yapilarak gidiliyor cunku php de problem eger aradgimiz seyi bulamazsa hemen hatayi ekrana basip uygulamayi patlaliyor...Ondan dolayi cok ciddi kontrol yapmaya alismamiz lazm...ve herseyin kontrolunu yapan bir method var

//Simdi biz klsor ve dosyslari birbirinden ayrit etmemiz gerkeecek yani kimi zaman sadece klasorleri almamzi gerekecek kimiz zaman da sadece dosyalari almamiz gerekecek..Boyle durumlarda...is_dir, is_file kontrolu ile bunlari birbirinden ayiracagiz...
//Peki dizi icerisine gelecek olan elementleri nasil boyle bir kontrol den gecirecegiz..
//1.ya direck foreach veya for dongusu ile dondururuz ve her dongude if kontrolunden geciririz
//2. ya da iceriinden callback fonksiyonu olan array_filter ile yapariz bu isi

$my_files2 = scandir("../require_inclue");//Bu bir su an icinde bulundugmuz klasorun bir ust klasorune cikar ve o ust klasor altinda bulunan klasorlerden yani icinde bulundugmuz klasor ile ayni duzeyde sibling olarak bulunan klasorlerden ismini yazddgimiz require_include klasorunde bulunan dosyalari ggettirir
$my_files3 = scandir("../");//paretn klasor veya dizin icinde bulunan dosya ve klasorleri getirir
print_r($my_files3);

$my_files4 = scandir("./");//Su anda uzerinde bulundugu dizin veya klasoru getirir
print_r($my_files4);

$my_files5 = scandir(".");//Su anda uzerinde bulundugu dizin veya klasoru getirir
print_r($my_files5);

print_r($my_files2);
//Bu sekilde sadece dosya veya sadece dizin leri yani klasoruleri al diyebiliyruz

print_r(array_values(array_filter(scandir("."),function($value){
	 //if(is_dir($value))return $value;
	 if(is_file($value))return $value;
})));


$my_files6 = scandir("./test1");//Su anda uzerinde bulundugu dizin veya klasoru getirir
print_r($my_files6);

//SIMDI GELELIM GLOBUN NASIL CALISTIGINA KI BIZ GENELLIKLE SCAN_DIR YERINE GLOB U KULLANACAGIZ CUNKU DAHA PRATIKTIR 
$my_files7 =  glob("*");//* ile tum dosyalari getir diyourz
//globa dizi icinde getirdgi dosya ve klasorlerde . ve .. degerlerini getirmiyor ve bunlari da tekrar dizi den kaldirma yukunden bizi kurtarmis olyor...scan_dir kullanmaya gore bu daha kolaydir
print_r($my_files7);//[]

//GLOB ILE SADECE KLASORLERI ALABILMEK ICIN ASAGIDAKI YOLLARI IZELEYEBILIRIZ..BUNLARI COK FAZLA KULLANACGZ...
$my_files8 =  glob("*/");//Bu su demektir * herseyi getir ama klasorlerden olan herseyi getir..Yani biz */ demek sadece klasorleri getir demektir
print_r($my_files8);
//
$my_files9=glob("*",GLOB_ONLYDIR);//SADECE KLASORLERI ALIR
print_r($my_files9);

//GLOB ILE HEM DOSYA HEM KLASORLERI LISTELEMEK ICIN
$my_files10 =  glob("*/.");//Bu da hem dosya hem de klasorleri getirir
print_r($my_files10);

//GLOB ILE SADECE SPESIFIK BIR DOSYAYI LISTELEMK ISTERSEK
$my_php_files = glob("*.php");
print_r($my_php_files);

//GLOB ILE SPESIFIK BIRDEN FAZLA DOSYALARI LISTELEMEK ISTERSEK
$my_diff_type_files = glob("*.{php,txt,html}",GLOB_BRACE);
print_r($my_diff_type_files);//Bu sekilde de hem php hem de txt dosyalarini alabiliyoruz.. 

//Bu da glob ile su anda uzerinde bulundugmuz klasorlerden test1 klasoru altinda bulunan dizin(klasor) ve dosyalari listeler
$res2 = glob("test1/*");
print_r($res2);
$res3 = glob("test1/*/");//test1 klasoru altindaki sadece dizin ya da klasorleri listeler


//DOSYA ISLEMLERINDE SIKCA YAPACAGIMIZ KONTROLLERDIR..
//is_dir
//is_file
//file_exist

/*
RECURSIVE FONKSIYONLAR BIZE OZELLIKLE SUBMENUSU OLAN MENU ISLEMLERINDE VE ALT DOSYA VE DIZINLERI OLAN KLASORLERIMIZE ERISMEK ISTDGIMZDE HARIKA BIR BESTPRACTISE DIR...
BESTPRACTISE...BU YONTEM COOK ISMIZE YARAYACAK...COOOK ONEMLIDIR
Simdi burda bir suru dosya alt alta olma durumu olacak ayni ic ice dizilerin olmasi gibi
Ve biz nerde bu sekilde bir yukardan asagi veya asagidan yukari hiyerarsi gorursek yani birbirne benzer islerin ic ice gittigi ama nerde ne zaman sonlanacagnii bilemdgimiz durumlar ile karsilastigimizda, yapacagimiz islem recrusive fonksiyonlardir...Bunu hicbir zaman unutmayalim....
*/

function list_of_my_files($my_dir_name){
	echo "<ul>";
		$my_files_and_folders=glob($my_dir_name);
		foreach ($my_files_and_folders as  $value) {
		 
			  echo "<li>".$value;
			  //Oncelikle dizinde ne var sa tek tek yaziyoruz ve her birisin yazdiktan sonra bir de cek ediyoruz senin altinda da dosya veya klasor var mi yani sende dizin misin yani sende klasor musun yani is_dir() diyerek cek ederiz..
			  if(is_dir($value)){//Eger bizim ana dizinimzdedki dosyalardan klasor olan var ise yani dizin olan yani bir altta dosya veya yine klasor olma ihtimali olan bir klsor var ise orda dur ve onun da icine gir diyecegiz        
			 list_of_my_files($my_dir_name. "/*");
		 }
		 echo "</li>";
		} 


	echo "</ul>";
}

list_of_my_files("*");


//IN_ARRAY METHODUNUN KULLANILMASINA HARIKA BIR ONREK..BESTPRACTISE...
function list_files($name_dir){//$name_dir-dizin adi demektir
	$files= scandir($name_dir);//$files bir dizi olarak gelecektir
	//Scan dir ile gelen dosyalar arasinda   ., .. da geliyor onlari almak istemiyrouz ama
	//Bestpractise bir dizi icerisinde istemedigimz elementler yok ise demk istersek biraz bakis acimizi degistirerek olaya yaklasacagiz..Yani olaya sadecee elimizdeki datalar uzerinden yaklasmaktan vaz gecelim o zaten klasik ve kolay olani biraz daha kreativ dusunelim..yani orngin biz . ve .. istemiyoruz degil mi o zaman ne yapacagiz bbu . ve .. yi biz bir dizi icine atalim sonra da foreachc icerisinde $files dizimiizi dondururken her bir elementi [.,..] bu arrayiinn icnide var mi diye sorgulayalim....eger var ise diyelim....bak bu bakis acisinin ssevdim yani bir dizi icindeki elementler icinde 2 tanesini istisna tutacaksak ki bu say i daha cok da olabilrdi...bu harika bir cozum  mantigidir...bu cozumu uygulayabirliriz her zaman...coook iyi harika bir cozumdur
	echo  "<ul>"; 
			  foreach ($files as $key => $value) {
					if(!in_array($value,['.','..'])){//Eger $file dizimiz icindeki elemntlerimiz tek tek, bizim [".",".."] bu dizimzin icerisinde yok ise diyoruz...yani kimsie gelip  de bize hazir dizileri verip de is cozmemizi beklemez her zaman, biz gerektiginde uretken olarak cozumler bulacagiz.....ve biraz normalin disina cikmamiz gerekiyor....HARIKA BESTPRACTISE......
						 //EGer $file icindeki elemanlar '.' ve '..' degil ise diyoruz...
						 echo "<li>".$value;
						 //Eger bu bir dizin ise yani klasor ise, (ayni dizi gibi yani, eger bu bir dizin ise klasor ise o zaman onun icine bakmak gerekiyor....)O ZAMAN DOSYA LISTELE YI TEKRAR DA CAGIR VE PARAMETRELERINI DE DIZIN VEYA KLASOR OLAN IN DIZIN ISMINI VERELIM
							 if(is_dir($name_dir. "/" . $value) ){//Burda  $name_dir . yani icinde bulundugumuz dizin veriliyor
							  // ./bir alt taki dosya ya da klasor ismi veriliyor onun klasor olup olmadini da iste dizini mi degil mi is_dir ile anlyoruz eger klasor icine girmis isek diyoruz....is_dir sayesinde yani altinda dosya veya klasor ler olabilecek bir klasor mu degil mi onu cek ediyor is_dir bunu unutmayalim
									list_files($name_dir. "/" . $value);
							 } 
						 echo "</li>";
						 //
					}
				  

	} 
	echo " </ul>";
}
?>