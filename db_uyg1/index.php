<?php 

require_once "config.php";

$_GET["page"] = $_GET["page"] ?? "homepage";

switch ($_GET["page"]) {
	case 'insert':
		require_once("insert.php");
		break;
	case 'update':
		require_once("update.php");
		break;
	case 'tutorial_detail':
		require_once("tutorial_detail.php");
		break;
	default:
		require_once("homepage.php");
		break;
}


?>