<?php 
//String functions
$text = "Some text";
//1-strlen-bir ifadenin karakter sayisini verir
echo strlen($text);//9

echo "<br>";
//2-strstr bir text icinde parametreye verdimgiiz deger ile birlikte o textin devamini getirir
echo strstr($text," ");//text bosluktan ititbaren alip text yazisini getirir
echo "<br>";
$text2 = "Today is very well weather condition";
echo strstr($text2,"very");//very well weather condition
echo "<br>";

//3-strpos uzun bir text icinde aradgimiz karakterin kacinci karakterde oldugunu verir
echo strpos($text2,"y"); //4.karakterde buluyor

//ucwords- her kelimenin bas harfini buyutmek icin kullanilir
echo "<br>";

//4-ucwords--her bir kelimenin bas harfini buyuk yapar
echo ucwords("adem erbas");//Adem Erbas
echo "<br>";
//5-ucfirst-Sadece ilk kelimenin bas harfini buyuk  yapar
echo ucfirst("adem erbas skien");//Adem Erbas
echo "<br>";

//6-strtolower
echo strtolower("ADEM ERBAS");//Buyuk harfi kucuge cevirir

echo "<br>";

//6-strtoupper
echo strtoupper("adem erbas");//kucuk harfleri buyyuge cevirir

//7.trim-sag ve solundaki bosluklari kaldirir
echo "<br>";
$text3 = "   HELLO WORLD   ";
echo strlen($text3);//17
echo "<br>";
echo trim($text3);//bosluklari kaldirir
echo "<br>";

echo strlen($text3);//9
echo "<br> **********";

//8-ltrim soldaki bosluklari kaldirir
$text4 = "   HELLO WORLD ";
echo strlen(ltrim($text4));//14 karakter sade ce soldaki bosluklari kaldirdi
echo "<br>";

//9-ltrim sagdaki bosluklari kaldirir
$text5 = "   HELLO WORLDD      ";
echo strlen(rtrim($text5));//14 karakter sade ce SAGDAKI bosluklari kaldirdi
echo "<br>";

//10. trim ile biz kaldirmak istedigmz sag ve soldaki ozel karakterler var ise onlari da kaldirabiliriz
//trim ile en basta ve en sonda kullanilmis olan ozel karakteri de yok edebilyrouz
$str1 = "@    adem    @";
echo trim($str1,"@");//adem
echo "<br>";

//11.substr string ifadeyi bolmemizi sagliyor
$str2 =  "Adem erbas skien";
echo substr($str2,5);//5.indexten itibaren geri kalan tum texti getirir
echo "<br>";

$str3 =  "Adem erbas skien";
echo substr($str2,5,5);//5.indexten itibaren 5 karakter gettirir
echo "<br>";

//12.str_replace - string bir ve birden fazla kelime yi degistirebiliyoruz
$str4 =  "Adem erbas skien";
echo str_replace("Adem","Sercan",$str4);//Sercan erbas skien diye degisiyor
echo "<br>";
$person = [
	"name"=>"Zehra",
	"surname"=>"Erbas",
	"age"=>9
];

$str5 =  "Adem erbas skien";


echo str_replace(
	["Adem", "erbas","skien"],
	["Sercan", "kavas","stavenger"],
	$str5
);//Sercan kavas stavenger diye degsitirir

//13- str_repeat
echo "<br>";
echo str_repeat("adem ",10);//10 kez adem yazar yanyana

//str_repeat i kullanarak bazen harika bestpractise ler yapabiliriz
for ($i=1; $i <=10 ; $i++) { 
	//i sirasi ile artmaya devam ediyor ama biz i nin degerini 5 i gectikten sonra onu 10 dan cikararark
	//5 den geriye dogru saymasini sagalmis oluyoru aslinda...
	($repeatCount=$i<=5 ? $i : (10-$i));
	echo str_repeat("*",$repeatCount)."</br>";
}

//14-sprintf
$new_text =sprintf("%s går på %s skolen trin %d","Zehra","Kjørbekhøyda",4);
echo $new_text;//Zehra går på Kjørbekhøyda skolen trin 4

//15-strcmp($a,$b) // $a ile $b degiskenin karsilastirir string olarak ve eger esit ise 0 doner degil ise -1 gelir key-sensitive dir
//the strcmp() function is case sensitive
echo "<br>";
//16.strcasecmp($a,$b) ama bu method keysesitive degildir ondan dolayi da-The "strcasecmp()" function is a case insensitive string comparison function.
$name = "Adem";
$name2 = "adem";
if(strcmp($name,$name2) === 0):
	echo $name." is equal ".$name2;
else:
	echo $name." is not equal ".$name2;

endif;
//strcmp "adem" ile "Adem" i ayni kabul etmezken
//strcasecmp "adem" ile "Adem"  i esit kabul eder
echo "<br>";

//17-printf
//Dikkat edelim dinamik bir sekilde yazdik asagida
printf("%s %d tane %s var","Afrikada", 5, "maymun");//Afrikada 5 tane maymun var
//%s-Afrikada, %d-5, %s-maymun
//Orneginin dil sistemi yaziyoruz ingilizce veya farkli dillerde yazmamiz gerekyor
//Demekki biz bunu farkli dillerde yazmamiz gerektiginde kullanabilyoruz

//vprintf
//printf de degerlrimiz i parametre olarak gonderiyoruz, vprintf de de 1 tane parametre gonderip onu dizi olarak gonderiyoruz
//Tarih islemlerimizde de kullanabiliriz
$date="2022-7-6";
//Formatlama islemi de yapabiliyoruz
//Niye %d diyoruz cunku tam sayi oldugu icin %d diyoruz
//Biz ay ve gun u 2 haneli yazmak istiyoruz mesela
//%02d yani 0 dan 2 tane olsun diyoruz
echo "<br>";

vprintf("%d-%02d-%02d", explode("-",$date));//2022-07-06
$date2="2022-7-16";
echo "<br>";

vprintf("%d-%02d-%02d", explode("-",$date2));//2022-07-16
//BU SEKILDE DIKKKAT EDELIM BIZ DINAMIK BIR SEKILDE FORMATLAMIS OLUYORUZ VE 
//ARTIK ORNEGIN GUN TEK HANELI GELIRSE SOL TARAFINA 0 KOYARKEN CIFT HANELI GELIRSE
//ZATEN HICBIR SEY KOYMAMIS OLACAK VE BIZE TAM ISTEDGIMIZ GIBI BIR DINAMIKLIK SAGALMIS OLACAK...
echo "</br>";
printf("Pi %f tur",3.14);//Pi 3.140000 tur
//f, yani ondalik sayi oldugu icin sonunda kusurat icin sonunda 5 tane 0 getiriyor
//Biz sonundaki 0 larin gelmesini istemiyoruz orngin
echo "</br>";
printf("Pi %.2f tur",3.14);//Pi 3.14 tur
//%.2f diyerek virgulden sonra 2 haneli yaz demis oluyoruz ve yine harika bir formatlama yapmis oluyoruz

echo "</br>";
//Saklamak icin sprintf ya da vsprintf kullaniriz..echo ile yazdirmak yerine return ediyor bunlarda
//sprintf-vsprintf bunlar ekrana direk yazdirmaz return eder
// dolaysi ile vsprintf ve sprintf ile  baska bir degskene aktarip  onda tutabilriz degeri, 
$date4="2022-7-6";
echo vsprintf("%d-%02d-%02d", explode("-",$date4));
//echo($res);
echo "</br>";
$date5="2022-7-6";

echo vsprintf("%d-%02d-%02d", explode("-",$date5));

/*
 printf:
formatlanmış string çıktısı verir.
Çalıştırıldığında string çıktısının uzunluğunu döndürür.
$number = 5;
$str = "London";
$x = printf("There are %u million people in %s. <br>",$number,$str);
echo $x;
Çıktı: There are 5 million people in London.
Cıktı: 42

sprintf:
formatlanmış string değerini döndürür.
$number = 5;
$str = "London";
$x = sprintf("There are %u million people in %s. <br>",$number,$str);
echo $x;
Çıktı: There are 5 million people in London.

Eğer argumanlar(parametreler) birden fazla yerde kullanılacaksa \$ ifadesi kullanılır.

$number = 5;
$str = "London";
$x = sprintf("There are %1\$u million people in %s. <br> Second usage place: %1\$u",$number,$str);
echo $x;
Çıktı: There are 5 million people in 5.
	     Second usage place: 5

         vprintf:
formatlı string değerini ekrana bastırır.
printf gibi davranır yalnız parametre olarak değişkenler yerine dizi alır.
Formatlanmış stringin uzunluğunu geri döndürür.

$number = 5;
$str = "London";
$x = vprintf("There are %u million people in %s. <br>", [$number,$str]);
echo $x;
Çıktı: There are 5 million people in London.
Çıktı: 42

vsprintf:
formatlanmış string değerini döndürür.
sprintf gibi davranır yalnız parametre olarak değişkenler yerine dizi alır.
$number = 5;
$str = "London";
$x = vsprintf("There are %u million people in %s. <br>", [$number,$str]);
echo $x;
Çıktı: There are 5 million people in London.

vfprintf:
formatlanmış bir stringi bir dosyaya yazar.

$number = 5;
$str = "London";
$file = fopen("test.txt","w");
vfprintf("There are %u million people in %s. <br>", [$number,$str]);

test.txt dosyasına There are 5 million people in London. ifadesini yazar

FORMAT DEĞERLERİ İÇİN KULLANABİLECEĞİNİZ DEĞERLER
%% – Yüzde işareti döndürür
%b – İkili sayı
%c – ASCII değerine göre karakter
%d – İşaretli ondalık sayı (negatif, pozitif veya sıfır)
%e – Küçük harf olarak bilimsel gösterim (e.g. 1.2e+2
%E – Büyük harf olarak bilimsel gösterim (e.g. 1.2E+2)
%u – İşaretsiz ondalık sayı (sıfıra eşit veya daha büyük)
%f – Ondalıklı sayı (yerel ayarlara duyarlı)
%F – Ondalıklı sayı (yerel ayarlara duyarlı değil)
%g – %e ve %f ‘nin daha kısası
%G – of %E ve %f ‘ nin daha kısası
%o – Octal sayı%s – String
%x – Hexadecimal sayı (Küçük Harfler ile)
%X – Hexadecimal sayı (Büyük Harfler ile)
*/
?>