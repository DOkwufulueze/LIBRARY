<?php
$lib=!isset($_GET['lib'])?"login":$_GET['lib'];
switch($lib){
	case "login":
	include("login.php") ;
	break;
	
	case "admin":
	include("admin.php") ;
	break;
	
	case "register":
	include("register.php") ;
	break;
	
	case "record":
	include("record.php") ;
	break;
	
	case "defaulter":
	include("defaulter.php") ;
	break;
	
	case "borrower":
	include("borrower.php") ;
	break;
	
	case "upload":
	include("upload.php") ;
	break;
	
	case "read":
	include("read.php") ;
	break;
	
	case "return":
	include("return.php") ;
	break;
	
	case "borrow_rec":
	include("borrow_rec.php") ;
	break;
	
	case "logout":
	include("class.php");
	lib::logout();
	break;
	
	default:
	include("login.php");
	break;
}
?>