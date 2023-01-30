<?php 
echo "Date and hours";
//Tarih ve zaman diliminin belirtmemiz gerekiyor ancak sunucumuz hangi saat dilimine gore ccalisiyorsa ona gore site de gelecektir
//Bundan dolayi bizim zaman dilimimizi hangi zaman dilimine gore istiyorsak onu belirtmemiz gerekiyor

//Get Your Time Zone
//timezone larini internetten bulabilriz
date_default_timezone_set("Europe/Oslo");

//d iki haneli numara olarak  gun-day verir
//m iki haneli numara olarak  month verir
//Y 4 haneli year verir
//H 2 haneli 24 saat formatinda saati verir
//i 2 haneli minute-dakikayi verir
//s 2 haneli second-saniyeyi verir
//l haftanin gununu adini ingilizce olarak veriyor
//F ayin ingilizce adini verir

echo "<br>".date("d");//30
echo "<br>".date("m");//01
echo "<br>".date("Y");//2023
echo "<br>".date("H");//08 
echo "<br>".date("i");//56
echo "<br>".date("s");//16
echo "<br>".date("l");//Monday
echo "<br>".date("F");//Januar
echo "<br>".date("Y-m-d");//2023-01-30
echo "<br>".date("Y/m/d");//2023/01/30
echo "<br>".date("Y.m.d");//2023.01.30

//Get a time with date
// H - 24-hour format of an hour (00 to 23)
// h - 12-hour format of an hour with leading zeros (01 to 12)
// i - Minutes with leading zeros (00 to 59)
// s - Seconds with leading zeros (00 to 59)
// a - Lowercase Ante meridiem and Post meridiem (am or pm)

//TIME MKTIME
//Time fonksiyonu 1 ocak 1970 00.00.00 tarihihnden gunumuze kadar gecen saniyeyi belirtir
//Timestampt yani saniyeyi verir
echo "<br>".time();//1675065654
//TIMESTAMP OLARAK SANIYE OLARAK ELIMIZDE BULUNAN BIR TIME DEGERINNI HANGI Y-m-d a denk geldigni bulabliirz
echo "<br>".date("Y/m/d","1375057836");//2013/07/29
//DATE FONKSIYONUNU KULLANARAK GECMIS VE GELECEK TARIHI BULMAK
//BU TARZ ISLEMLERI TIMESTAMP-SANIYE CINSINDEN DEGER UZERINDEN CIKARIP TOPLAMA ISLEMI YAPARIZ

//1 SAAT ONCESINI BULMAK
echo "<br>".date("H:i:sa",time()-60*60);//1 saat 60*60(60 saniye * 60 dakika) 08:07:38am
//1 SAAT SONRASINI BULMAK
echo "<br>".date("H:i:sa",time()+60*60);//1 saat sonrasi 10:07:38am
//PHP DE ZAMAN OLUSTURMA-  MKTIME FONKSIYONU
$create_time = mktime(12,20,40,10,21,1999);//hour-minute-second-month-day-year sirasi ile parametreye girilir
echo "<br>".$create_time;//940501240 timestamp cinsinden karsiligini verir ve biz onun normal istedgimz formatte tarihe donusturebiliirz
echo "<br>".date("Y-m-d",$create_time);//1999-10-21
echo "<br>".date("h:i:sa",$create_time);//12:20:40pm

//STRTOTIME FONKSIYONU ILE ILERI GERI ISLEMLERI
//The PHP mktime() function returns the Unix timestamp for a date. The Unix timestamp contains the number of seconds between the Unix Epoch (January 1 1970 00:00:00 GMT) and the time specified.
//mktime(hour, minute, second, month, day, year)

$date = strtotime("10:30pm April 15 2014");//time,now
echo "<br>".$date;//1397593800
echo "<br>".date("Y-m-d",$date);//2014-04-15

//mktime ile biz gecmisteki  tarihleri de alabilyoruz
$d1=strtotime("tomorrow");
echo "<br>".date("Y-m-d h:i:sa", $d1) . "<br>";//2023-01-31 12:00:00am

$d2=strtotime("next Saturday");
echo date("Y-m-d h:i:sa", $d2) . "<br>";//2023-02-04 12:00:00am

$d3=strtotime("+1 day",time());
echo date("Y-m-d h:i:sa", $d3) . "<br>";//2023-01-31 09:21:45am

$d4=strtotime("-1 day",time());
echo date("Y-m-d h:i:sa", $d4) . "<br>";//2023-01-29 09:22:25am

$d5=strtotime("-1 week",time());
echo date("Y-m-d h:i:sa", $d5) . "<br>";//2023-01-23 09:22:58am

$d6=strtotime("+1 week",time());
echo date("Y-m-d h:i:sa", $d6) . "<br>";//2023-02-06 09:23:20am

//week,month,day,hour,minute,second keywordlerini kullanarak ileri ver geri tarih, ve time lari alabiliriz
//next,previous gibi keywordleri kullanarak tarih islemlerini yapabiliriz

$d7=strtotime("previous Saturday");
echo date("Y-m-d h:i:sa", $d7) . "<br>";//2023-01-28 12:00:00am

//SETLOCALE FUNC
//Setlocal fonksiyonu-kullanaagimz tarih dilini belirtebiliriz bununla
//BURDA ARTIK BIZ GUN,AY ISIMLERI NORVECCE GELECEK...
echo setlocale(LC_ALL,"NO");
echo "<br>";
//echo setlocale(LC_ALL,NULL);
//The setlocale() function sets locale information.
//Locale information is language, monetary, time and other information specific for a geographical area.
//Note: The setlocale() function changes the locale only for the current script.
//Tip: The locale information can be set to system default with setlocale(LC_ALL,NULL)
//Tip: To get numeric formatting information, see the localeconv() function.
//setlocale(constant,location)

//Available constants:

// LC_ALL - All of the below
// LC_COLLATE -  Sort order
// LC_CTYPE - Character classification and conversion (e.g. all characters should be lower or upper-case)
// LC_MESSAGES - System message formatting
// LC_MONETARY - Monetary/currency formatting
// LC_NUMERIC - Numeric formatting
// LC_TIME - Date and time formatting

//%e gunu sifir dolgusuuz verir
//%m iki haneli ayi verir
//%Y 4 haneli yili verir
//%H 24 saat formatinda saati verir
//% M dakikayi verir
//%S 2 haneli saniyeyi verir
//%A haftanin gunun adini verir %a ile de gun adinin kisaltilimis halini verir
//%B ayin adini verir
echo "<br>".strftime("%A");//mandag
echo "<br>".strftime("%B");//januar
?>