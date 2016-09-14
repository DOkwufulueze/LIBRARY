<?php  
	include_once("class.php");
	lib::verify_admin();
	include("top.inc");
?>

<span style="float:right"><a href=".?lib=logout">Logout</a></span>
<b>Defaulters Page</b><br/>
Below is a list of Library Users and their respective transactions.<br />
<?php lib::borrowers(); ?>

<?php
	include("foot.inc");
?>