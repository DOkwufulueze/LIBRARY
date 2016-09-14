<?php  
	include_once("class.php");
	lib::verify_admin();
	include("top.inc");
?>

<span style="float:right"><a href=".?lib=logout">Logout</a></span>
<b>Defaulters Page</b><br/>
Below is a list of defaulters who have held on to books for a period of time beyond the due date.<br />
<?php lib::defaulter(); ?>

<?php
	include("foot.inc");
?>