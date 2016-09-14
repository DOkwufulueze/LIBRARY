<?php  
	include_once("class.php");
	lib::verify_admin();
	include("top.inc");
	if($_POST){
		lib::add_book();
	}
?>
<span style="color:#FF0000"><b><?php echo $_GET['msg']=!isset($_GET['msg'])?"":$_GET['msg'] ;?></b></span>
<span style="float:right"><a href=".?lib=logout">Logout</a></span>
<p>Welcome, you are logged in as &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php $_SESSION['admin'] ;  ?></b></p>
<p>In this page, you can add books to the Library Database.</p>
<p>To add a book, just fill the form below. </p>
<form id="form1" name="form1" method="post" action="">
  <p>Book Title
    <input type="text" name="title" value="<?php echo $_GET['title']=!isset($_GET['title'])?"":$_GET['title'] ; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
  Book Author
  <input type="text" name="author" value="<?php echo $_GET['author']=!isset($_GET['author'])?"":$_GET['author'] ; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
  ISBN
  <input type="text" name="isbn" value="<?php echo $_GET['isbn']=!isset($_GET['isbn'])?"":$_GET['isbn'] ; ?>" />
  </p>
  <p>Call Number
    <input type="text" name="call" value="<?php echo $_GET['call']=!isset($_GET['call'])?"":$_GET['call'] ; ?>" />
  </p>
  <p>Quantity
    <input type="text" name="qty" value="<?php echo $_GET['qty']=!isset($_GET['qty'])?"":$_GET['qty'] ; ?>" />
  </p>
  <p>Edition
    <input type="text" name="edit" value="<?php echo $_GET['edit']=!isset($_GET['edit'])?"":$_GET['edit'] ; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
  Publisher
  <input type="text" name="pub" value="<?php echo $_GET['pub']=!isset($_GET['pub'])?"":$_GET['pub'] ; ?>" />
  </p>
  <p>Date Received
    								  <select name = "month" id = "month">
         								<option value = "01">January</option>
        							 	<option value = "02">February</option>
         								<option value = "03">March</option>
         								<option value = "04">April</option>
         								<option value = "05">May</option>
         								<option value = "06">June</option>
         								<option value = "07">July</option>
         								<option value = "08">August</option>
         								<option value = "09">September</option>
         								<option value = "10">October</option>
         								<option value = "11">November</option>
         								<option value = "12">December</option>
         							  </select> 
									  <select name = "day" id = "day">
         								<option value = "1">1</option>
        								<option value ="2">2</option>
         								<option value ="3">3</option>
							            <option value ="4">4</option>
         								<option value ="5">5</option>
         								<option value ="6">6</option>
         								<option value ="7">7</option>
         								<option value ="8">8</option>
         								<option value ="9">9</option>
         								<option value ="10">10</option>
         								<option value ="11">11</option>
        							 	<option value ="12">12</option>
        								<option value ="13">13</option>
         								<option value ="14">14</option>
         								<option value ="15">15</option>
         								<option value ="16">16</option>
         								<option value ="17">17</option>
         								<option value ="18">18</option>
         								<option value ="19">19</option>
         								<option value ="20">20</option>
         								<option value ="21">21</option>
         								<option value ="22">22</option>
         								<option value ="23">23</option>
         								<option value ="24">24</option>
         								<option value ="25">25</option>
         								<option value ="26">26</option>
         								<option value ="27">27</option>
         								<option value ="28">28</option>
         								<option value ="29">29</option>
         								<option value ="30">30</option>
         								<option value ="31">31</option>
         					   		  </select>
       
         							  <select name = "year" id = "year">
         								<option value = "2014">2014</option>
         								<option value = "2015">2015</option>
         								<option value = "2016">2016</option>
         								<option value = "2017">2017</option>
         							  </select>	
  </p>
  <input type="submit" name="add" value="Add" />
</form>

<?php
	include("foot.inc");
?>