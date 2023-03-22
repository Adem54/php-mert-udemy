<?php 

//php ile multiple language choice nasil yapariz 
//Bu nu 2 sekilde yapariz 
//1-veritabanina kaydederiz ve ordan cekeriz bunu cok onermioruz
//2-Daha mantikli bir yontem yapabiliriz..session ve array kullanarak
//Ama her turlu uygulama nasil gerdceklestigini hayal etmeye calisirken sunu bilelim biz hicbir zaman ortada birsey yok birseyler uretmiyoruz...Her zaman icin bizim kullanabilecgimiz datalar olacaktir ve biz o datalari kullanarak  uygulamamiza  yeni ozellikler kaydederiz... Dolayisi ile soz konusu data kullanma olunca da akla 2-3 secenek gelmelidir
//1-ya datayi database e kaydeder ordan cekeriz... bu yapilan birsey cokca yani sadece surrekli dinamik olan datalar degil sirf orda dursun ihtiyacimz olunca ordan cekelim mantigi ile de veritabaninda tutulabiliyor ama tabi bu genellikle daha buyuk datalar icin yapiliyor
//2-Ya direk dosyaya kaydedip dosyadan okuyarak alinabiliyor uygulama ayaga kalkarken ilk olarak veritabani giris bilgileri gibi bu tarz bilgiler genelllikle dosyadan okunarak yapilir cok daha hizli yapildigi ve bu dosyalari n y olunu environment variable a kaydediop dosya okurken de env.variable daki dossyalarai ceken fonksiyon uzerinden yaptigmiiz icin herhangi bir kaza, veya dosya yolu yanlisligi olma ihtimalini de ortadan kaldirmis oluyoruz bu sekilde....(dosya yolu tabik ki environment variable path e kaydedilirki bu dosyalara cok kolay erissin pc ilk acilikren....)
//3-Manuel olarak ram de tutabiiliriz.... Yani herhangi bir php dosyamiz icinde bir array olusturup onun icerisine elle olusturup ordan cekerek kullanabiliriz... 

class lang {
	const LANG_DEFAULT = "en";
	public static $lang="";
	public static $dir = "lang";
	public static function get($x = null)//Burda cevrilecek anahtar kelime ne ise buraya o gelecek
	{
		//Simdi biz sunu biliyoruz secilen dil SESSION icerisine atildi.. o zaman biz sitemizde hangi dil olarak gosterecegmizi SESSION DAN ogrenebiliriz
		//Burda da bir kontrol yapalim... cunku tarayici ayari ile oynaip session icinden data ile oynayabilirler
		$lang_value = strip_tags($_SESSION["lang"]);//Bu secilen dil en-no hangisi ise onu verecektir
		$lang_choices = ["en","no"];
		if(in_array($lang_value,$lang_choices)){//eger sessionda bulunan lang key inin value si bizde var olan dillerden biri ise
			self::$lang = $lang_value;
		}else{
			//Eger bizde gecerli olan dillerden baska birsey gelirse default olarak en yapacagiz
			self::$lang = self::LANG_DEFAULT;
		}
		//dikkat edelim... require_once i bu sekilde de kullanabiliriz 
		//BURASI BESTPRACTISE...KULLANICI HANGI DILI SECER ISE O DILE AIT DOSYAYI GETIRIYOURZ...NASIL  YAPIYORUZ BUNU.. BUNU DIL DOSYA ISIMLERIMIZ ILE BIZIM DIL ICIN TUTUGMUZ ARRAY ICINDE AYNI VALUE LERI  KULLANARAK BURDAN KULLANICI DIL SECTIGINDE GELEN DEGER UZERINDEN DOSYA YI DA DINAMIK REQUIRE EDILMESINI SAGLAMIS OLUYORUZ...HARIKA BESTPRACTISE...BUNA BENZER MANTIKLARI COK FAZLA KULLANACAGIZ
		//BURASI GERCEKTEN HARIKA BESTPRACTISE VE SURDURULEBILIR BIR ISLEM..EGER BIZIM 30 TANE DILMIZ OLSA ID TEK SATIR DA KULLANICI HANGISINI SECERSE ONU BU MANTIIKLA GETIREBILIRDIK YANI BUN IF-ELSE BAS EDECEGIMZ BIRSEY DEGIL BU ONDAN DOLAYI ASAGIDAKI BESTPRATIGI COOOK IYI ANLAMAK VE IHTIYAC DURUMUDNA KULLANMAKK GEREK
		require_once("".self::$dir."/".self::$lang.".php");
		return $lang[$x];//$lang require_once da secilen dil sayfasina ait $lang gelecek...
		//return olarak da hangi dile tiklandi ise o dildeki parametreye girilen kelimenin karsiligi yani cevirisi gelecektir.. 
	}
}

// echo basename(__FILE__);//lang-app.php
// echo "<br><br>";
// echo basename(__DIR__);//multiple-lang-with-session

?>