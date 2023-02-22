<?php 
ob_start();
require_once('connect.php');
require_once 'header.php';


//homepage de yaptigimz arama isleminde search button submit edildiginde bu sayfaya gelir ve bizim burda gelen data yi filtreden gecrimemiz gerekir ne icin guvenlik icin...bu cok onemlidir

$_GET = array_map(function($get){
	return htmlspecialchars(trim($get));
},$_GET);


//PHP ROUTE ISLEMI...
//PHP de yaptgimiz bu sayfa yonlendirme mantigi, ayni reactta ki route yontemi mantigindadir...
//Yani kullanici hangi sayfaya tiklar ise o sayfayi kullaniciya gosteriririz....DIKKAT EDELIM...MANTIKLAR O KADAR COK BENZIYOR KI...
//ASLINDA AYNI ISLEMLERI FARKLI  YONTEMLER ILE YAPIYORUZ..AMA AYNI SEYLERI YAPYORUZ ASLINDA...

if(!isset($_GET['page'])){
	$_GET['page'] = 'index';
}


switch ($_GET['page']) {
	case 'insert':
	require_once('insert.php');	
		break;
	case 'update':
		require_once('update.php');
		break;
	case 'read':
		require_once('read.php');
		break;
	case 'delete':
		require_once('delete.php');
		break;
	case 'categories':
		require_once('categories.php');
		break;
	case 'add_category':
		require_once('add_category.php');
		break;	
	case 'category':
		require_once('category.php');
		break;		
	default:
		# code...
	require_once('homepage.php');
	break;
}

?>