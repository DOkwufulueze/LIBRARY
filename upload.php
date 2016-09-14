<?php  
	include_once("class.php");
	lib::verify_admin();
	include("top.inc");
	if($_POST){
		lib::upload();
	}
?>
<span style="float:right"><a href=".?lib=logout">Logout</a></span>
<b>Upload Page</b><br/>
<span style="color:#ff0000"><?php echo $_GET['msg']=!isset($_GET['msg'])?"":$_GET['msg'] ; ?></span><br /><br />
Fill out the simple form below to upload a book.<br /><br />
<form method="post" action="" enctype="multipart/form-data">
  <p>Book
    <input type="file" name="file" id="file" title="Choose file" /><br />
</p>
  <p>Book Title
    <select name="title">
	<?php
		lib::db();
		$que=mysql_query("SELECT * FROM books") or die(mysql_error());
		while($r=mysql_fetch_array($que)){
			echo"<option value='".$r['TITLE']."'>".$r['TITLE']."</option>";
		}
	?>
    </select>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Author
	<select name="author">
	<?php
		lib::db();
		$que2=mysql_query("SELECT * FROM books") or die(mysql_error());
		while($r2=mysql_fetch_array($que2)){
			echo"<option value='".$r2['AUTHOR']."'>".$r2['AUTHOR']."</option>";
		}
	?>
    </select>
</p>
<p>
	Edition
	<select name="edit">
	<?php
		lib::db();
		$que3=mysql_query("SELECT * FROM books") or die(mysql_error());
		while($r3=mysql_fetch_array($que3)){
			echo"<option value='".$r3['EDITION']."'>".$r3['EDITION']."</option>";
		}
	?>
    </select>
</p>
<p>
	Field &nbsp;&nbsp;&nbsp;<select name="field" id='field' onchange="popSubfields(this.options[this.selectedIndex].value,'sbf')"><?php lib::getFields(); ?></select><br /><br />
	Sub-Field &nbsp;&nbsp;&nbsp;<select name="sbf" id='sbf'><?php lib::getSubfields(); ?></select><br />
</p>
  <p>
    <input type="submit" name="submit" value="Upload Book" />
  </p>
</form>
<?php
	include("foot.inc");
?>