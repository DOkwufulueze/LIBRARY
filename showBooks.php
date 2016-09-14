<?php
	include_once("class.php");
	$field=!isset($_GET['field'])?"":$_GET['field'];
	$sbf=!isset($_GET['sbf'])?"":$_GET['sbf'];
	lib::showBooks($field,$sbf);
?>