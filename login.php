<?php
	include("class.php");
	lib::db();
	$dat = date("d") ;
	$q=mysql_query("SELECT * FROM today") or die(mysql_error());
	$rr = mysql_fetch_array($q);
	if($dat != $rr['DAY']){ 
		mysql_query("UPDATE today set DAY='$dat'") or die(mysql_error());
		$q2=mysql_query("SELECT * FROM borrow") or die(mysql_error());
		while($rr2 = mysql_fetch_array($q2)){
			$sn = $rr2['SN'] ;
			$old_upd=$rr2['DAY'] ;
			$new_upd = $old_upd + 1 ;
			mysql_query("UPDATE borrow set DAY='$new_upd' WHERE SN='$sn'") or die(mysql_error());
		}
	}
	include("top.inc") ;
	if($_POST){
		lib::login();
	}
	echo "<b><span style=\"color:rgb(255,000,000)\">".$_GET['msg']=!isset($_GET['msg'])?"":$_GET['msg']."</span></b>" ;
?>
<p><b>Welcome to our Library Management System today 
  <?php= date("d F Y");  ?></b>
  </p><br />
<p>If you are an Administrator, enter your Login details below to use the System.</p>
<form id="login" name="login" method="post" action="">
  <p>Username
    &nbsp;&nbsp;
    <input type="text" name="uname" />
</p>
  <p>Password/Matric No.
    &nbsp;&nbsp;
	<input type="password" name="pword" />
</p>
  <p>
    <input type="submit" name="submit" value="Login" />&nbsp;&nbsp;&nbsp;&nbsp;
    <!-- input type="button" name="clear" value="Clear" onclick="clear"/ -->
  </p>
</form>
<p> <br />
</p>
<?php
	include("foot.inc") ;
?>