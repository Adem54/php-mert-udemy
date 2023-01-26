<?php 

echo "Adem \n Erbas";//Ekrana basarken herhangi bir degisiklik goremeyiz ama bunu sayfa kaynaginin goruntuleyince gorebiliriz
//GEnellikle form islemlerinde ki textarea da kullaniliyor

//\n bir alt satira gecilmesini sagliyor
//\t klavyedeki tab gorevi goruyor
echo "<br>Adem \t Erbas";//kaynak kodunu acinca bosluk birakildigini gorebiliriz

echo "<br>";

echo "Adem said that \"Hello world!\"";
//Cift tirnak icinde cift tirnak olarak php de okunmasi icin \ \ icerisine yazmamiz gerekiyor ki php onu quote olarak tanisin yoksa
//onu icerisine string  yazilan ifade olarak taniyacaktir

//Peki biz normal $ ifadesini ekrana bastirmak istersek ne yapariz

$value = "Adem";

echo "\$value";//$value bu sekilde yazdirmis oluyoruz
echo "<br>";
echo "\\$value";// \Adem

printf("My name is %s",$value);//My name is Adem

?>