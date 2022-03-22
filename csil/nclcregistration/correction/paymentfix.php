<?php
	if(!isset($_SERVER['HTTPS']) && (count($_GET) == 0))
    {
        header("location: https://www.union.arizona.edu/csil/nclcregistration/correction/paymentfix.php");
    }

	session_start();
	if (isset($_POST['submit'])) {
	$_SESSION['submit'] = $_POST['submit'];
	}
	
	if (isset($_POST['lastName'])) {
	$_SESSION['lastName'] = $_POST['lastName'];
	}
	
	if (isset($_POST['firstName'])) {
	$_SESSION['firstName'] = $_POST['firstName'];
	}
	
	if (isset($_POST['groupsize'])) {
	$_SESSION['attendee'] = $_POST['groupsize'];
	}
	
/*if(!isset($_SERVER['HTTPS']))
    {
        header("location: https://www.union.arizona.edu/csil/nclcregistration/reg.php");
    }
	*/
    include_once("../common/page_start.php");
	
	print "<div class=\"content_block\">";

	
	if (isset($_SESSION['submit']) || isset($_POST['submit'])) {
		 include_once('payment.php');
		 
		 } else {
		
		?>
	
    <h1>Payment Correction</h1>
    
    <form action="paymentfix.php" method="post">
    	<p>First Name of the primary group registrant<br>
        <input name="firstName" type="text" size="20" maxlength="30"><br><br>
        
        Last Name of the primary group registrant<br>
        <input name="lastName" type="text" size="20" maxlength="30">
        </p>
    
    	<p>How many people did your credit card registration include (aside from yourself)<br />
        <select name="groupsize">
        	<option>0</option>
        	<option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
         </select></p>
         
         <input type="hidden" name="submit" value="true">
         
         <input type="submit">
         </form>
         
         <?
		
		 }
	print "</div>";
		 
	include_once("../common/page_end.php");
		 ?>
		 
        