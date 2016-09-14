<?php  
	include("class.php");
	lib::verify_admin();
	include("top.inc");
	if($_POST)
	{
		lib::register();
	}
?>
<div id="mid">
<span style="float:right"><a href=".?lib=logout">Logout</a></span>
<span style = "text-align:center ;font-size:140% ; font-weight :bold">Library Registration Form </span><br/><br/><br/>
<span style="color:#FF0000"><?php echo"<b>". $_GET['msg']=!isset($_GET['msg'])?"":$_GET['msg']."</b>" ; ?></span>
<form method="post" action="">
	<ol>
		<li>
			<span style="color:#ff0000">*</span>Username &nbsp;&nbsp;<input type = "text" name = "unam" id = "unam" value="<?php echo $_GET['unam']=!isset($_GET['unam'])?"":$_GET['unam'] ; ?>"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span style="color:#ff0000">*</span>Surname &nbsp;&nbsp;<input type = "text" name = "sname" id = "sname" value="<?php echo $_GET['sname']=!isset($_GET['sname'])?"":$_GET['sname'] ; ?>"/>
		</li><br/><br/>
		<li>
			<span style="color:#ff0000">*</span>First name &nbsp;&nbsp;<input type = "text" name = "fname" id = "fname" value="<?php echo $_GET['fname']=!isset($_GET['fname'])?"":$_GET['fname'] ; ?>"/>
		</li><br/><br/>
		<li>
			Title &nbsp;&nbsp;&nbsp;<select name = "title" id = "title">
										<option value="<?php echo $_GET['title']=!isset($_GET['title'])?"":$_GET['title'] ; ?>">Title</option>
										<option value = "mr">Mr</option>
										<option value = "mrs">Mrs</option>
										<option value = "miss">Miss</option>
									</select>
		</li><br/><br/>
		<li>
			Matric Number &nbsp;&nbsp;<input type = "text" name = "matric" id = "matric" value="<?php echo $_GET['matric']=!isset($_GET['matric'])?"":$_GET['matric'] ; ?>"/>
		</li><br/><br/>
		<li>
			Faculty &nbsp;&nbsp;<input type = "text" name = "fac" id = "fac" value="<?php echo $_GET['fac']=!isset($_GET['fac'])?"":$_GET['fac'] ; ?>"/> &nbsp;&nbsp;&nbsp;Department &nbsp;&nbsp;<input type = "text" name = "dept" id = "dept" value="<?php echo $_GET['dept']=!isset($_GET['dept'])?"":$_GET['dept'] ; ?>"/>
		</li><br/><br/>
		<li>
			Sex &nbsp;&nbsp;&nbsp;<select name = "sex" id = "sex">
										<option value="<?php echo $_GET['sex']=!isset($_GET['sex'])?"":$_GET['sex'] ; ?>">Sex</option>
										<option value = "male">Male</option>
										<option value = "female">Female</option>
								  </select>
		</li><br/><br/>
		<li>
			<span style="color:#ff0000">*</span>Email &nbsp;&nbsp;<input type = "text" name = "email" id = "email" size= "50" value="<?php echo $_GET['email']=!isset($_GET['email'])?"":$_GET['email'] ; ?>"/> &nbsp;&nbsp;&nbsp;Phone Number &nbsp;&nbsp;<input type = "text" name = "phone" id = "phone" value="<?php echo $_GET['phone']=!isset($_GET['phone'])?"":$_GET['phone'] ; ?>" />
		</li><br/><br/>
		<li>
			<span style="color:#ff0000">*</span>Address &nbsp;&nbsp;<input type = "text" name = "address" id = "address" value="<?php echo $_GET['address']=!isset($_GET['address'])?"":$_GET['address'] ; ?>"/> 
		</li><br/><br/>
	
		<li>
			<span style="color:#ff0000">*</span>Nationality &nbsp;&nbsp;<input type = "text" name = "nation" id = "nation" value="<?php echo $_GET['nation']=!isset($_GET['nation'])?"":$_GET['nation'] ; ?>"/>
		</li>  <br/><br/>
		<input type = "submit" name = "submit" id = "submit" value = "Register" />
	</ol>
</form>
</div>

<?php
	include("foot.inc");
?>