<?php 

 
	//FINAL KULLANIMI
	//Base class ta final ile tanimlanmis bir method subclass ta yeniden tanimlanamz..
	//Normalde base class ta tanimlanan bir methodun aynisini biz subclass ta da tanimlayabiliriz ve icerigini tammen degistirebilyoruz yani override edebiliyoruz ancak final ile eger baseclass tan bir methodu biz final ile tanimlarsak artik o method o base class i inherit eden hicbir subclass ta yeniden tanimlanamaz
	//Ayrica 

	// Final(C#da sealed) ifadesi, bir class'ın erişim türünü belirlemektedir. Eğer bir class final deyimiyle birlikte tanımlanırsa, bu class miras alınarak başka bir class oluşturulamaz. Yani final kavramı bir class'ın extends edilmesinin önüne geçer. 

	//Fatal error: Class Futbolcu may not inherit from final class (Sporcu) 
	//Final ifadesi gercek hayatt kullanimlarinda cok effektif bir sekilde kullanilabiliyor...bazi class larimiz bize ozel olabilir ve kesinlikle disardan baska bir class ile kullanilmamasi gerekebilir iste final ile bu islemi halleecegiz

	//Programlama dilleri üzerinde genelde ihtiyaçtan doğan OOP mimarisi ile birlikte hayatımıza girimiş olan final komutumuzun amacı bizim oluşturduğumuz class veya methodumuzun sadece tek seferlik kullanım olarak sunulmasına olanak sağlar. Normalde biz extends ediyorduk class ları veya hem ana class içerisinde hem de child class içerisinde methodlarımızı rahat rahat kullanırken final komutunu baş kısmına yazdığımız zaman programımız bize "Hooop kardeşim bu final tanımlı. Bunu birden fazla kez kullanamazsın bir kere kullan :)" şeklinde bir uyarı verdirtiyor. Bütün olay aslında bu dostlar.

	//Methodun override edilmesini bu sekkilde engelleyebiliyoruz .....basina final koydgumuz zaman o method override edilemedigi gibi basina final koydgumz class ise tekrar kullanilamiyor...
	//Final demek bu artik son final kullanim bunu artik kullanamazsin diyoruz
	//FINAL KULLANILAN CLASS LAR INHERIT EDILEMEZLER...BU COK ONEMLI...


	final class Person  {
		public function getName(){
			return "Adem";
		}
	}


?>