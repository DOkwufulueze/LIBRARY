<?php  
	include_once("class.php");
	lib::verify_user();
	include("top.inc");
	if($_POST){
		lib::upload();
	}
?>
<span style="float:right"><a href=".?lib=logout">Logout</a></span>
<b>Read Page</b><br/>
<span style="color:#ff0000"><?php echo $_GET['msg']=!isset($_GET['msg'])?"":$_GET['msg'] ; ?></span><br /><br />
<form method="post" action="" enctype="multipart/form-data">
<p>
	Field &nbsp;&nbsp;&nbsp;<select name="field" id='field' onchange="popSubfields(this.options[this.selectedIndex].value,'sbf')"><?php lib::getFields(); ?></select><br /><br />
	Sub-Field &nbsp;&nbsp;&nbsp;<select name="sbf" id='sbf' onchange="showBooks('books')"><?php lib::getSubfields(); ?></select><br />
</p>
<div id="books" style="width:20%;height:500px;overflow:auto;clear:none;float:left;display:none;border:1px solid #dedede;padding:1%;margin-right:2%;">
	&nbsp;
</div>
<div id="book"  style="width:70%;height:500px;overflow:auto;clear:none;float:left;display:none;border:1px solid #dedede;padding:1%;">
	&nbsp;
</div>
</form>
<?php
	include("foot.inc");
?>