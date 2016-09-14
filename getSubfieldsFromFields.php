<?php
	include_once("class.php");
	$field=!isset($_GET['field'])?"":$_GET['field'];
	lib::getSubfieldsFromField($field);
?>