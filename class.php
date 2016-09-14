<?php
	session_start();
	class lib{
		public static function db(){
			mysql_connect("localhost", "root", "") or die(mysql_error());
			mysql_select_db("lib") or die("Could not connect to the database");
		}
		
		public static function getFields(){
			lib::db();
			$get = mysql_query('SELECT DISTINCT FIELD FROM fields');
			$num=mysql_num_rows($get);
			if($num>0){
				echo "<option value='' selected>Select Field</option>";
				while($var = mysql_fetch_assoc($get))
				{
					$field=$var['FIELD'];
					echo "<option value='$field'>$field</option>";
				}
			}
			else{
				echo "<option value=''>:::No Field yet</option>";
			}
		}

		public static function getSubfields(){
			lib::db();
			$get = mysql_query('SELECT DISTINCT SUBFIELD FROM fields');
			$num=mysql_num_rows($get);
			if($num>0){
				echo "<option value='' selected>Select Sub-field</option>";
				while($var = mysql_fetch_assoc($get))
				{
					$sbf=$var['SUBFIELD'];
					echo "<option value='$sbf'>$sbf</option>";
				}
			}
			else{
				echo "<option value=''>:::No Sub-field yet</option>";
			}
		}

		public static function getSubfieldsFromField($field){
			lib::db();
			$get = mysql_query("SELECT DISTINCT SUBFIELD FROM fields WHERE FIELD='$field'");
			$num=mysql_num_rows($get);
			if($num>0){
				echo "<option value='' selected>Select Sub-field</option>";
				while($var = mysql_fetch_assoc($get))
				{
					$sbf=$var['SUBFIELD'];
					echo "<option value='$sbf'>$sbf</option>";
				}
			}
			else{
				echo "<option value=''>:::No Sub-field yet</option>";
			}
		}
		
		public static function login(){
			lib::db();
			$uname = mysql_real_escape_string(trim($_POST['uname']));
			$pword = mysql_real_escape_string(trim($_POST['pword']));
			$que = mysql_query("SELECT * FROM admin WHERE USERNAME='$uname' AND PASSWORD=md5('$pword')") or die(mysql_error());
			$num = mysql_num_rows($que);
			if($num==0){
				$que = mysql_query("SELECT * FROM users WHERE USERNAME='$uname' AND MATRIC_NUMBER='$pword'") or die(mysql_error());
				$num = mysql_num_rows($que);
				if($num==0){
					echo"<script>document.location.href='.?lib=login&msg=Invalid Username or Password'</script>";
				}
				else{
					$_SESSION['uname'] = $uname ;
					echo"<script>document.location.href='.?lib=read'</script>";
				}
			}
			else{
				$_SESSION['admin'] = $uname ;
				$_SESSION['status'] = "Valid";
				echo"<script>document.location.href='.?lib=admin'</script>";
			}
		}
		
		public static function register(){
			lib::db();
			$unam = mysql_real_escape_string(trim($_POST['unam']));
			$sname = mysql_real_escape_string(trim($_POST['sname']));
			$fname = mysql_real_escape_string(trim($_POST['fname']));
			$title = mysql_real_escape_string(trim($_POST['title']));
			$matric = mysql_real_escape_string(trim($_POST['matric']));
			$fac = mysql_real_escape_string(trim($_POST['fac']));
			$dept = mysql_real_escape_string(trim($_POST['dept']));
			$pic_name = $_FILES['pic']['name'];
			$pic_type = $_FILES['pic']['type'];
			$pic_size = $_FILES['pic']['size'];
			$sex = mysql_real_escape_string(trim($_POST['sex']));
			$email = mysql_real_escape_string(trim($_POST['email']));
			$phone = mysql_real_escape_string(trim($_POST['phone']));
			$address = mysql_real_escape_string(trim($_POST['address']));
			$nation = mysql_real_escape_string(trim($_POST['nation']));
			
			if($unam==""||$sname==""||$fname==""||$email==""||$address==""||$nation==""){
			//if(($unam=="")||($sname=="")||($fname=="")||($pic_name=="")||($email=="")||($address=="")||($nation=="")){
				echo"<script>document.location.href='.?lib=register&msg=All fields with Asterisks (*) are Compulsory&unam=$unam&sname=$sname&fname=$fname&title=$title&matric=$matric&fac=$fac&dept=$dept&pics=$pic_name&sex=$sex&email=$email&phone=$phone&address=$address&nation=$nation'</script>";
			}
			else{
				if(!(@eregi('^[0-9_\.\$a-z]+'.'@'.'([0-9a-z]+\.)+'.'([0-9a-z]){2,4}$',$email))){
						echo"<script>document.location.href='.?lib=register&msg=Invalid Email Address Format&unam=$unam&sname=$sname&fname=$fname&title=$title&matric=$matric&fac=$fac&dept=$dept&sex=$sex&email=$email&phone=$phone&address=$address&nation=$nation'</script>";
				}
				else{
					$query1 = mysql_query("SELECT * FROM users WHERE USERNAME='$uname'") or die(mysql_error());
					$num1 = mysql_num_rows($query1);
					if($num1 != 0){
						echo"<script>document.location.href='.?lib=register&msg=This User had already been registered&unam=$unam&sname=$sname&fname=$fname&title=$title&matric=$matric&fac=$fac&dept=$dept&sex=$sex&email=$email&phone=$phone&address=$address&nation=$nation'</script>";
					}
					else{
						mysql_query("INSERT INTO users(USERNAME,SURNAME, FIRST_NAME, TITLE, MATRIC_NUMBER, FACULTY, DEPARTMENT, SEX, EMAIL, PHONE_NUMBER, ADDRESS, NATIONALITY) VALUES('$unam','$sname','$fname','$title','$matric','$fac','$dept','$sex','$email','$phone','$address','$nation')") or die(mysql_error());
						echo"<script>document.location.href='.?lib=register&msg=User Registered'</script>";
					}
				}
			}
		}
		
		public static function upload(){
			lib::db();
			$uploads="C:/wamp/www/LIBRARY/books/";
			$file_name = $_FILES['file']['name'];
			$file_type = $_FILES['file']['type'];
			$file_size = $_FILES['file']['size'];
			$file_loc=$_FILES['file']['tmp_name'];
			$title = mysql_real_escape_string(trim($_POST['title']));
			$author = mysql_real_escape_string(trim($_POST['author']));
			$edit = mysql_real_escape_string(trim($_POST['edit']));
			$field = mysql_real_escape_string(trim($_POST['field']));
			$sbf = mysql_real_escape_string(trim($_POST['sbf']));
			$date=date("Y-m-d");
			//$valid_formats=array("docx","doc","pdf","txt","xls","xlsx","ppt");
			$valid_formats=array("pdf");
			$qq = mysql_query("SELECT * FROM books WHERE TITLE='$title' AND EDITION='$edit' AND AUTHOR='$author'") or die(mysql_error());
			if(mysql_num_rows($qq)==0){
				echo"<script>document.location.href='.?lib=upload&msg=Book Details does not exist in database.'</script>";
			}
			else{
				if($file_name==""||$title==""||$author==""||$edit==""||$field==""||$sbf==""){
					echo"<script>document.location.href='.?lib=upload&msg=All Fields are Compulsory'</script>";
				}
				else{
					list($txt, $ext) = explode(".", $file_name);
					if(in_array($ext,$valid_formats)){
						if($file_size>4000000){
							echo "<script>document.location.href='.?lib=upload&msg=:::File should not be greater than 200KB!'</script>";
						}
						else{
							$file_name=$date.time().".".$ext;
							if(move_uploaded_file($file_loc,$uploads.$file_name)){
								$qq = mysql_query("SELECT * FROM uploads WHERE BOOK_TITLE='$title' AND EDITION='$edit' AND AUTHOR='$author' AND FIELD='$field' AND SUBFIELD='$sbf'") or die(mysql_error());
								if(mysql_num_rows($qq)==0){
									if(mysql_query("INSERT INTO uploads(BOOK, BOOK_TITLE, AUTHOR, EDITION, FIELD, SUBFIELD, USAGE_COUNT, DATE) VALUES('$file_name','$title','$author','$edit','$field','$sbf','0','$date')")){
										echo"<script>document.location.href='.?lib=upload&msg=:::File Uploaded'</script>";
									}
									else{
										unlink($uploads.$file_name);
										echo"<script>document.location.href='.?lib=upload&msg=:::Unsuccessful Upload.'</script>";
									}
								}
								else{
									unlink($uploads.$file_name);
									echo"<script>document.location.href='.?lib=upload&msg=File already exists'</script>";
								}
							}
						}
					}
					else{
						echo "<script>document.location.href='.?lib=upload&msg=:::Invalid File Format!'</script>";
					}
				}
			}
		}
		
		public static function add_book(){
			lib::db();
			$title = mysql_real_escape_string(trim($_POST['title']));
			$author = mysql_real_escape_string(trim($_POST['author']));
			$isbn = mysql_real_escape_string(trim($_POST['isbn']));
			$call = mysql_real_escape_string(trim($_POST['call']));
			$qty = mysql_real_escape_string(trim($_POST['qty']));
			$edit = mysql_real_escape_string(trim($_POST['edit']));
			$pub = mysql_real_escape_string(trim($_POST['pub']));
			$year = mysql_real_escape_string(trim($_POST['year'])); $month = mysql_real_escape_string(trim($_POST['month'])); $day = mysql_real_escape_string(trim($_POST['day']));
			$date=$year."-".$month."-".$day ;
			if($title==""||$author==""||$isbn==""||$call==""||$qty==""||$edit==""||$pub==""||$date==""){
				echo"<script>document.location.href='.?lib=admin&msg=All Fields are Compulsory&title=$title&author=$author&isbn=$isbn&call=$call&qty=$qty&edit=$edit&pub=$pub&date=$date'</script>";
			}
			else{
				$qq = mysql_query("SELECT * FROM books WHERE TITLE='$title' AND EDITION='$edit' AND AUTHOR='$author'") or die(mysql_error());
				if(mysql_num_rows($qq)==0){
					$query = mysql_query("INSERT INTO books(TITLE, AUTHOR, ISBN, CALL_NUMBER, QUANTITY, EDITION, PUBLISHER, DATE_RECEIVED) VALUES('$title','$author','$isbn','$call','$qty','$edit','$pub','$date')") or die(mysql_error());
					echo"<script>document.location.href='.?lib=admin&msg=Data Added'</script>";
				}
				else{
					echo"<script>document.location.href='.?lib=admin&msg=Book already exists'</script>";
				}
			}
		}
		
		public static function show_books(){
			lib::db();
			$que = mysql_query("SELECT * FROM books") or die(mysql_error());
			$num=mysql_num_rows($que);
			echo"<table border='1' cellpadding='5' cellspacing='0'>
			<tr>
			<th>BOOK TITLE</th><th>AUTHOR</th><th>ISBN</th><th>CALL NUMBER</th><th>QUANTITY</th><th>EDITION</th><th>PUBLISHER</th><th>DATE RECEIVED</th>
			</tr>" ;
			while($rows=mysql_fetch_array($que)){
				echo"<tr><td>".$rows['TITLE']."</td><td>".$rows['AUTHOR']."</td><td>".$rows['ISBN']."</td><td>".$rows['CALL_NUMBER']."</td><td>".$rows['QUANTITY']."</td><td>".$rows['EDITION']."</td><td>".$rows['PUBLISHER']."</td><td>".$rows['DATE_RECEIVED']."</td></tr>";
			}
			echo"</table>";
		}
		
		public static function borrow(){
			lib::db();
			$usern=mysql_real_escape_string(trim($_POST['usern']));
			$sname = mysql_real_escape_string(trim($_POST['sname']));
			$edit=mysql_real_escape_string(trim($_POST['edit']));
			$book=mysql_real_escape_string(trim($_POST['book']));
			$author=mysql_real_escape_string(trim($_POST['author']));
			$date = date("Y-m-d");
			$q=mysql_query("SELECT * FROM users WHERE USERNAME='$usern' AND SURNAME='$sname'") or die(mysql_error());
			if(mysql_num_rows($q) != 0){
				$qu = mysql_query("SELECT * FROM books WHERE TITLE='$book' AND EDITION='$edit' AND AUTHOR='$author' AND QUANTITY > 0") or die(mysql_error());
				if(mysql_num_rows($qu)!=0){
					$row=mysql_fetch_array($qu);
					$old_qty=$row['QUANTITY'] ;
					$qu = mysql_query("SELECT * FROM borrow WHERE USERNAME='$usern' AND BOOK='$book' AND STATUS='Borrowed' AND AUTHOR='$author'") or die(mysql_error());
					if(mysql_num_rows($qu)==0){
						mysql_query("INSERT INTO borrow(USERNAME, BOOK, AUTHOR, EDITION, DATE_ORDERED, DAY, STATUS) VALUES('$usern','$book','$author','$edit','$date','0','Borrowed')") or die(mysql_error());
						$new_qty = $old_qty - 1 ;
						mysql_query("UPDATE books set QUANTITY='$new_qty' WHERE TITLE='$book' AND EDITION='$edit' AND AUTHOR='$author'") or die(mysql_error());
						echo"<script>document.location.href='.?lib=borrower&msg=The Borrow has been effected.'</script>";
					}
					else{
						echo"<script>document.location.href='.?lib=borrower&msg=$usern already borrowed $book.'</script>";
					}
				}
				else{
					echo"<script>document.location.href='.?lib=borrower&msg=The data for the selected book of your choice does not match that in our database.'</script>";
				}
			}
			else{
				echo"<script>document.location.href='.?lib=borrower&msg=Invalid Username'</script>";
			}
		}
		
		public static function returned(){
			lib::db();
			$usern=mysql_real_escape_string(trim($_POST['usern']));
			$sname = mysql_real_escape_string(trim($_POST['sname']));
			$edit=mysql_real_escape_string(trim($_POST['edit']));
			$book=mysql_real_escape_string(trim($_POST['book']));
			$author=mysql_real_escape_string(trim($_POST['author']));
			$date = date("Y-m-d");
			$q=mysql_query("SELECT * FROM users WHERE USERNAME='$usern' AND SURNAME='$sname'") or die(mysql_error());
			if(mysql_num_rows($q) != 0){
				$quu = mysql_query("SELECT * FROM books WHERE TITLE='$book' AND EDITION='$edit' AND AUTHOR='$author' ") or die(mysql_error());
				$qu = mysql_query("SELECT * FROM borrow WHERE USERNAME='$usern' AND BOOK='$book' AND EDITION='$edit' AND AUTHOR='$author' AND STATUS='Borrowed'") or die(mysql_error());
				if(mysql_num_rows($qu)!=0){
					mysql_query("UPDATE borrow set DATE_RETURNED='$date', STATUS='Returned' WHERE USERNAME='$usern' AND BOOK='$book' AND EDITION='$edit' AND AUTHOR='$author'") or die(mysql_error());
					$row=mysql_fetch_array($quu);
					$old_qty=$row['QUANTITY'] ;
					$new_qty = $old_qty + 1 ;
					mysql_query("UPDATE books set QUANTITY='$new_qty' WHERE TITLE='$book' AND EDITION='$edit' AND AUTHOR='$author'") or die(mysql_error());
					echo"<script>document.location.href='.?lib=return&msg=The Return has been effected.'</script>";
				}
				else{
					echo"<script>document.location.href='.?lib=return&msg=This book had not been borrowed.'</script>";
				}
			}
			else{
				echo"<script>document.location.href='.?lib=return&msg=Invalid Username'</script>";
			}
		}
		
		public static function borrowers(){
			lib::db();
			$q2=mysql_query("SELECT * FROM borrow ") or die(mysql_error());
			if(mysql_num_rows($q2)>0){
				echo"<br/><table border='1' cellpadding='5' cellspacing='0'><tr><th>USERNAME</th><th>NAME</th><th>BOOK</th><th>STATUS</th><th>DATE ORDERED</th><th>DAY</th><th>DATE RETURNED</th></tr>";
				while($rr2 = mysql_fetch_array($q2)){
					$user = $rr2['USERNAME'] ;
					$book=$rr2['BOOK'] ;
					$status=$rr2['STATUS'] ;
					$date = $rr2['DATE_ORDERED'];
					$day = $rr2['DAY'];
					$dater=$rr2['DATE_RETURNED'] ;
					$q=mysql_query("SELECT * FROM users WHERE USERNAME='$user'") or die(mysql_error());
					$r = mysql_fetch_array($q);
					$name=$r['SURNAME']." ".$r['FIRST_NAME'] ;
					echo"<tr><td>".$user."</td><td>".$name."</td><td>".$book."</td><td>".$status."</td><td>".$date."</td><td>".$day."</td><td>".$dater."</td></tr>";
				}
				echo"</table>";
			}
			else{
				echo"No Borrow/Return Transaction has occured yet.";
			}
		}
		
		public static function defaulter(){
			lib::db();
			$q2=mysql_query("SELECT * FROM borrow WHERE STATUS='Borrowed' AND DAY > 7") or die(mysql_error());
			if(mysql_num_rows($q2)>0){
				echo"<br/><table border='1' cellpadding='5' cellspacing='0'><tr><th>NAME</th><th>USERNAME</th><th>BOOK BORROWED</th><th>DATE ORDERED</th></tr>";
				while($rr2 = mysql_fetch_array($q2)){
					$user = $rr2['USERNAME'] ;
					$book=$rr2['BOOK'] ;
					$date = $rr2['DATE_ORDERED'];
					$q=mysql_query("SELECT * FROM users WHERE USERNAME='$user'") or die(mysql_error());
					$r = mysql_fetch_array($q);
					$name=$r['SURNAME']." ".$r['FIRST_NAME'] ;
					echo"<tr><td>".$name."</td><td>".$user."</td><td>".$book."</td><td>".$date."</td></tr>";
				}
				echo"</table>";
			}
			else{
				echo"<br/><br/>There are no defaulters.";
			}
		}
		
		public static function showBooks($field,$sbf){
			lib::db();
			$q=mysql_query("SELECT * FROM uploads WHERE FIELD='$field' AND SUBFIELD='$sbf'")or die(mysql_error());
			$n=mysql_num_rows($q);
			if($n>0){
				$i=1;
				echo "<div style='width:100%;margin-right:10px;clear:none;float:left;'>";
				while($rr=mysql_fetch_array($q)){
					/*if($i%5==0){
						echo "</div><div style='width:210px;margin-right:10px;clear:none;float:left;'>";
					}*/
					$book=$rr['BOOK_TITLE'];
					$bookName=$rr['BOOK'];
					$id=$rr['ID'];
					echo "<div style='width:100%; height:30px;float:left;clear:both;cursor:pointer;background:#eeeeee;' onclick=\"showFile('$id','$bookName','book')\" onmouseover=\"this.style.background='#dedede'\" onmouseout=\"this.style.background='#eeeeee'\">$book</div>";
					$i++;
				}
				echo "</div>";
			}
			else{
				echo ":::No book in the selected category yet.";
			}
		}
		
		public static function verify_admin(){
			if((!isset($_SESSION['status'])||$_SESSION['status']!="Valid")){
				echo"<script>document.location.href='.?lib=login&msg=:::Invalid Access'</script>";
			}
		}
		
		public static function verify_user(){
			if((!isset($_SESSION['status'])||$_SESSION['status']!="Valid")&&(!isset($_SESSION['uname'])||$_SESSION['uname']=="")){
				echo"<script>document.location.href='.?lib=login&msg=:::Invalid Access'</script>";
			}
		}
		
		public static function logout(){
			$user = !isset($_SESSION['admin'])?$_SESSION['uname']:$_SESSION['admin'] ;
			session_destroy();
			echo"<script>document.location.href='.?lib=login&msg=$user Logged Out'</script>";
		}
		
	}
?>