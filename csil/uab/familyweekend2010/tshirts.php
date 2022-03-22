<?php
require_once 'template/fw.inc';
require_once 'events.inc';

//chech that session hasn't died
if($_SESSION['fw']['active_session'] != 1){
	$_SESSION['errors']['1'] = "We're sorry you session has timed out.";
	header("Location:reg.php");
}


//check if canceling registration
if($_POST['action']=='Cancel'){
	unset($_SESSION['fw']);			//unset saved variables
	header('Location:index.php');	//go back to lanfing page
}

////////////////////////////// ERROR CHECKING ///////////////////////////////////////////////////

//check if submitting previous page
else if(isset($_POST['action'])){
	$error_message = '';
	
	$_SESSION['fw']['sun_events'] = array();
	
	for($x=0; $x<sizeof($sun_events); $x++){
		if($_POST['event_selected'][$x]){
			$_SESSION['fw']['sun_events'][$x] = intval($_POST['event_attendance'][$x]);
		}
	}
	
	if($_POST['event_selected'][0]){
		$_SESSION['fw']['sun_events'][0] = array('student'=>intval($_POST['brunch_students']), 'guest'=>intval($_POST['brunch_guests']));
	}
	
if($_POST['editing']==1){
		header("Location:confirm.php");
		exit();
	}
	
	//var_dump($_SESSION['fw']['fri_events']);
		
	/*
	//check to see if any errors were found by seeing if the error message string is empty
	if(!empty($error_message)){
		$_SESSION['errors']['2'] = $error_message; 	//set the error message
		header("Location:select_package.php");					//take user back to reg page to fix errors
		exit();										//stop execution of this page
	}
	else{
		unset($_SESSION['errors']['2']);			//no errors were found make sure this is reflected in the session
	}
	*/
}


////////////////////////////// END ERROR CHECKING ///////////////////////////////////////////////////

$_SESSION['fw']['stage'] = max($_SESSION['fw']['stage'], 5);


if(empty($_SERVER['HTTPS'])){
	header('Location:https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	exit();
}


fw_start('T-Shirts', 0);
?>
<form action="confirm.php" method="post">
<h1>Family Weekend 2010 T-Shirts!</h1>
Purchase the Family Weekend T-Shirt, only $<?=$tshirt_cost?>/each, simply by selecting
your sizes below. This year's shirts are 100% organic fine jersey
cotton, American Apparel, with green stitching on the shoulders and the
hem. Or just click Save &amp; Continue.<br />
<br />
<div style="height: 350px; width: 700px">
<div style="float: left"><br>
<br>
<br>
<div style="padding-left: 20px; width: 70px; float: left">Kids (6):</div>
<div style="width: 100px; float: left" align="left">
<select	name="xsmall">
<?php 
	for($x=0; $x<11; $x++)
		print '<option value="'.$x.'" '.($_SESSION['fw']['xsmall']==$x?'selected':'').'>'.$x.'</option>';
?>
</select></div>
<br>
<br>
<div style="padding-left: 20px; width: 70px; float: left">Small:</div>
<div style="width: 100px; float: left" align="left"><select name="small">
	<?php 
	for($x=0; $x<11; $x++)
		print '<option value="'.$x.'" '.($_SESSION['fw']['small']==$x?'selected':'').'>'.$x.'</option>';
?>
</select></div>
<br>
<br>
<div style="padding-left: 20px; width: 70px; float: left">Medium:</div>
<div style="width: 100px; float: left" align="left"><select
	name="medium">
	<?php 
	for($x=0; $x<11; $x++)
		print '<option value="'.$x.'" '.($_SESSION['fw']['medium']==$x?'selected':'').'>'.$x.'</option>';
?>
</select></div>
<br>
<br>
<div style="padding-left: 20px; width: 70px; float: left">Large:</div>
<div style="width: 100px; float: left" align="left"><select name="large">
	<?php 
	for($x=0; $x<11; $x++)
		print '<option value="'.$x.'" '.($_SESSION['fw']['large']==$x?'selected':'').'>'.$x.'</option>';
?>
</select></div>
<br>
<br>
<div style="padding-left: 20px; width: 70px; float: left">X Large:</div>
<div style="width: 100px; float: left" align="left"><select
	name="xlarge">
	<?php 
	for($x=0; $x<11; $x++)
		print '<option value="'.$x.'" '.($_SESSION['fw']['xlarge']==$x?'selected':'').'>'.$x.'</option>';
?>
</select></div>
<br>
<br>
<div style="padding-left: 20px; width: 70px; float: left">2X Large:</div>
<div style="width: 100px; float: left" align="left"><select
	name="x2large">
	<?php 
	for($x=0; $x<11; $x++)
		print '<option value="'.$x.'" '.($_SESSION['fw']['x2large']==$x?'selected':'').'>'.$x.'</option>';
?>
</select></div>
<br>
<br>
<div style="padding-left: 20px; width: 70px; float: left"></div>
<br>
<div style="color: #f00; padding-left: 20px;"><input name="sizing"
	type="button" value="Size Details"
	onClick="window.open('pop_shirt.html','ShirtWindow','width=640,height=482')" /></div>
</div>
<div style="float: right"><img src="template/images/FW10_SaleShirts.jpg" width="500"></div>
<br>
<br>
</div>
<div style="clear:both">
	<input type="submit" name="action" value="Save &amp; Continue" style="float:right;" /><input type="button" value="Back" onclick="location='sun.php'" />
</div> 
</form>
<?php 
fw_finish();
?>