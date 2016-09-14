<?php  
	include_once("class.php");
	lib::verify_admin();
	include("top.inc");
?>
<span style="float:right"><a href=".?lib=logout">Logout</a></span>
<b>Below is a list of available books in stock.</b><br />
<p><?php lib::show_books();  ?></p>
<?php
	include("foot.inc");
?>