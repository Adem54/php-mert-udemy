<?php 

//mkdir ile klasor olusturuyoruz
//touch ile biz yeni file olusturuyoruz..
//fopen ile de ismini verdgimiz dosya yoksa yeni bir dosya olusturacaktir
//Uzerinde islem yapmak istedgimz dosyaya verilecek olan yetkiler verilmemis ise bu yetklileri vermemiz gerekir
//Bu yetkileri hem php den verebiliriz hem de manuel olarak gidip o dosya uzerinde saga tiklayarak o yetkileri verebilirz
//Klasor silme icin de 

	//mkdir("test1");
	//dosya olustururken de eger boyle bir klasor var ise hata verir ondan dolayi once bu klasorun varligini sorulayip ardindan da
	touch("test1.txt");

	$file = fopen("test1.txt","a+");
	fwrite($file, "Hello world \n");
	fclose($file);

	$file2 =  fopen("test1.txt","r");
	//rmdir("test1");	Eger test1 isminde bir klasor bulamaz ise patlar hata verir ondan dolayi boyle islemler yaparkenn once is_dir ile boyle bir klasor var mi onu kontrol edip var ise sil demek gerekir

	if(file_exists("test1.txt")){
		while(!feof($file2)){//Dosyanin son satirina gelmedi ise o zaman devam ettir while dongusunu demektir.. 
				echo fgets($file2). " <br>";//Dosyayi satir satir okuyoruz
		}
	}else {

	}

	echo "OPENDIR, READDIR, CLOSEDIR METHODLARI...... <br>";
	//VERILEN YOL ALTINA BULUNAN KLASOR VE DOSYALARI LISTELER AYNI SCANDIR MANTIGINDA LISTELER

	//opendir,readdir,closedir fonksiyonlari
	//Bu fonksiyonlar genel olarak stream yontemi ile calisir
//opendir fonksiyonu
// Fonksiyon bir klasoru/dizini acar ve akim olarak bellege yukler
//readdir fonksiyonu ise opendir ile bellege stream olarak yuklenen klasor-dizin icerisinde bulunan dosyalari okur
//closedir fonksiyon opendir ile bellege stream olarak  yuklenen klasor-dizin i siler veya kapatir

$dosyalar = opendir(".");
//satir satir iceirgi okyacagi icin dosyayi okudugu muddetce devam etsin diyoruz eger okumazsa kalmazsa o zaman null okur ve burasi da biter o zaman
//Bitince de o zaman boolean false doner ondan dolayi, false donene kadar da string donecektir...bu conditini biz boolean degil ise donguyu devam ettir diye de yapabilrizi gettype kullanarak
while($dosya = readdir($dosyalar)){
	if ($dosya =='.' || $dosya == '..' || $dosya == 'istenmeyendosya.txt') continue;
	//[".","..","istemeyendosya.txt"]
	//Ustte if ile || kullanilarak yapilan islem i bu sekilde daha bestpractise ile  yazailiriz..
	if(!in_array($dosya,[".","..","istemeyendosya.txt"])) continue;
   echo $dosya . "<br />";
}

closedir($dosyalar);

//Bu yöntemde de scandir fonksiyonunda olduğu gibi koşul eklenmesi gerekebilir.
//Cunku scandir ile . ve .. da geliyor du dizi icerisine





?>