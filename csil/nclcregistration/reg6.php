<?php	
	session_start();
	
	$_SESSION['photoRel'] = $_POST['photoRel'];
	
	if ($_SESSION['photoRel'] != "Yes") {
		
		$error = 'true';
		
		include_once('reg5.php');
		
		} else {
		
	
	include_once("common/page_start.php");

?>

<div class="content_block">

<h1>NCLC 2009 Online Registration</h1>

<b>Payment Type:</b> <br />
<br />
<form name="payment" action="payment.php" method="post">
	<select name="payment">
    <option>Credit Card</option>
    <!--<option>Check</option>-->
    <option>Interdepartmental Billing Form (U of A Only)</option>
 	</select>
	<br /><br />
	<input type="Submit" value="Save &amp; Continue">

</form>
    
</div>

<?
	include_once("common/page_end.php");
	
	}
?>