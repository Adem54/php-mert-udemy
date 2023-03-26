<?php 

//pdf olusturmak icin kullanilan bir sinif  var bu da FPDF dir
//http://www.fpdf.org/
//Download bolumunden zip dosyasini indiririz
//Indirilen fpdf klasoru icersinden makefont,font klasorleri ile fpdf.css ve fpdf.php dosyalarini index.php dosyamizin bulundugu ana dizine atiyoruz

require_once("fpdf.php");//fpdf paketinden aldgimz fpdf.php dosyasini cagiriyoruz

//Ve de fpdf dosyasindaki methodlardan vs faydalanabilmek icin FPDF class ini da extends ederiz
class PDF extends FPDF{
	
	//pdf sayfamizin bir header tarafi olsun 
	function header(){
		//resim ekleyebilirz 
	//	$this->Image("image1.jpg",10,)//(file,x,y,width,height,type,link) seklinde degerler ile birimage ekleyebiliriz
		//x,y degerleri image i pdf sayfasinda konumlandiracagimiz yerdir
		//Yazacagimz yazilarin renklerini de degistirebiliriz
	//	$this->SetTextColor(255,255,255);
	//Olusturulan icerikler pdf sayfasinin neresinden baslayacagini belirtmek icin margin verebiliyoruz 
	$this->Cell(70);//SAtir 70px icerden baslasin yani indentation. bu sekilde bu  yazacagmiz texti ortalamasini sagliyoruz
	//Satira yazabiliyoruz 
	$this->Write(2,"Hello World");
	//2 height degeridir
	//Asagiya bir satir inmesini saglayabiiriz 
	$this->Ln(10);//10px bir satir asagiya insin

	$this->Write(2,"Good morning PHP");
	}

	//Bizim content kismini alabilmemiz icin disarda invoke etmemiz gerekiyor ve oncesinde de AddPage methodunuda cagirmamiz gerekiyor
	function content($names = []){
		$this->Ln(20);
		$this->Write(2,"This is the content of pdf file");
		foreach ($names as $name) {
			$this->Ln(7);
			$this->Write(2,$name);
		}
	}

	function footer(){
		//Burasi da sayfanin alt kisminda calisacak 
		//Bununla alakali bir ayar var bu ayar onemli 
		//setY(-20) dedgimiz zaman bunu fpdf class imiz sayfanin en altindan yukari dogru 20px cikis oldugunu anliyor
		$this->setY(-20);
		$this->Cell(70);//70px icerden basla diyoruz yani total width in 70px icerisine gir oyle basla diyoruz
		$this->Write(5,"New hello world");
	}
}

$pdf = new PDF();
$pdf->AliasNbPages();//Sayfanin numaralarini gosteriyor optinal dir ister tanimlariz istersek de tanimlamayiz
//font ayari da yapabilriz
$pdf->setFont("Arial","",15);//Fontfamily ve font-size i verebiliyoruz
//Artik cikti alabiliriz
//Bizim content kismini alabilmemiz icin disarda invoke etmemiz gerekiyor ve oncesinde de AddPage methodunuda cagirmamiz gerekiyor yani once bir sayfa olusturup onun iceriisnde cagiriyoruz content methodunu
$pdf->AddPage();
$pdf->content(["Adem","Zeynep","Zehra"]);
$pdf->Output();
//fpdf icerisinde header ve footer bolumleri sabit olarak tanimlandigi icin content te yaptgimz islemleri header ve footer da yapmadan da pdf imize bu bolumleri yazdirabildik
//Contentimizin icerisine biz veritabanimzdan gelen data yi da yazdirabiliriz veya elimizde var olan bir dizi icerigini de yazdirabiliriz
?>