<?php  
	include_once("class.php");
	lib::verify_admin();
	include("top.inc");
	if($_POST){
		lib::borrow();
	}
?>
<span style="float:right"><a href=".?lib=logout">Logout</a></span>
<b>Borrow Page</b><br/>
<span style="color:#ff0000"><?php echo $_GET['msg']=!isset($_GET['msg'])?"":$_GET['msg'] ; ?></span><br /><br />
Fill out the simple form below to book an order for a valid user of the Library.<br /><br />
<form id="borrow" name="borrow" method="post" action="">
  <p>Username
    <input type="text" name="usern" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Surname<select name="sname">
	<?php
		lib::db();
		$que=mysql_query("SELECT * FROM users") or die(mysql_error());
		while($r=mysql_fetch_array($que)){
			echo"<option value='".$r['SURNAME']."'>".$r['SURNAME']."</option>";
		}
	?>
    </select>
</p>
  <p>Book
    <select name="book">
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
    <input type="submit" name="submit" value="Borrow" />
  </p>
</form>
<?php
	include("foot.inc");
?>