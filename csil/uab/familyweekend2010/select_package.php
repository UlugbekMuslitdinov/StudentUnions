<?php
require_once 'template/fw.inc';

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
	//var_dump($_POST);
	
	//check that all ua students have first and last name filled out
	for($x=0; $x<$_POST['num_students']; $x++){
		if(empty($_POST['student_first'][$x])){
			$error_message .= 'Please fill out the first name for UA student '.($x+1).'.<br />'; 	
		}
		if(empty($_POST['student_last'][$x])){
			$error_message .= 'Please fill out the last name for UA student '.($x+1).'.<br />'; 	
		}
	}
	
	//do the same for guests
	for($x=0; $x<$_POST['num_guests']; $x++){
		if(empty($_POST['guest_first'][$x])){
			$error_message .= 'Please fill out the first name for Guest '.($x+1).'.<br />'; 	
		}
		if(empty($_POST['guest_last'][$x])){
			$error_message .= 'Please fill out the last name for Guest '.($x+1).'.<br />'; 	
		}
	}
	
	$_SESSION['fw'] = array_merge($_SESSION['fw'], $_POST);		//save post variables to session
	
	
	//check to see if any errors were found by seeing if the error message string is empty
	if(!empty($error_message)){
		$_SESSION['errors']['1'] = $error_message; 	//set the error message
		header("Location:reg.php");					//take user back to reg page to fix errors
		exit();										//stop execution of this page
	}
	else{
		unset($_SESSION['errors']['1']);			//no errors were found make sure this is reflected in the session
	}
}


////////////////////////////// END ERROR CHECKING ///////////////////////////////////////////////////

$_SESSION['fw']['stage'] = max($_SESSION['fw']['stage'], 1);

if(empty($_SERVER['HTTPS'])){
	header('Location:https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	exit();
}


fw_start('Registration', 0);
?>
<form action="fri.php" method="post">
	<h1>Select A Package</h1>
	<div style="float:left;">
		<h2><input type="radio" name="package_type" value="Basic Package" <?=$_SESSION['fw']['package_type'] == 'Basic Package'?'checked':''?>/> Basic Package - $20</h2>
		Includes registration to the following events:
		<ul>
			<li>Family Weekend Kick Off Fair</li>
			<li>Campus Tours</li>
			<li>Read Like a Faculty Member</li>
			<li>Rainbow Families/ Gallery Reception</li>
			<li>Bear Down Friday</li>
			<li>Stargazing at Steward</li>
			<li>Zona Zoo Tailgate</li>
			<li>Double Feature- Gallagher (both days)</li>
			<li>Games Night</li>
			<li>Comedy Corner</li>
			<li>Motivational Speaker</li>
		</ul>
		 
		<p style="padding-left:0px;">
			For more information about these events click <span onClick="window.open('package_info.php','Basic Package','width=550,height=482')" style="color:blue; text-decoration:underline; cursor:pointer;">here</span>.
		</p>
		
		<br />
		<br />
		<br />
		<br />
		<br />
		
		
	</div>
	<div style="float:left; margin-left:30px;">
		<h2><input type="radio" name="package_type" value="Premium Package" <?=$_SESSION['fw']['package_type'] == 'Basic Package'?'':'checked'?>/> Premium Package - $30</h2>
		Includes registration to the following events:
		<ul>
			<li>Family Weekend Kick Off Fair</li>
			<li>Campus Tours</li>
			<li>Read Like a Faculty Member</li>
			<li>Rainbow Families/ Gallery Reception</li>
			<li>Bear Down Friday</li>
			<li>Stargazing at Steward</li>
			<li>Zona Zoo Tailgate</li>
			<li>Double Feature- Gallagher (both days)</li>
			<li>Games Night</li>
			<li>Comedy Corner</li>
			<li>Motivational Speaker</li>
			<li>Family Weekend BBQ</li>
		</ul>
		
		And Reduced Prices on:
		<ul>
			<li>2010 Family Weekend T-Shirt - $8 (Regular Price $10)</li>
			<li>Send off Brunch - $15/Adult, $8/Student (Regular price $20/Adult, $10/Student)</li>
		</ul>
		 
		<p style="padding-left:0px;">
			For more information about these events click <span onClick="window.open('package_info.php?premium','Premium Package','width=550,height=482')" style="color:blue; text-decoration:underline; cursor:pointer;">here</span>.
		</p>
		
		
	</div>
	<div style="clear:both;">
		<input type="submit" name="action" value="Save &amp; Continue" style="float:right;" />
		<input type="submit" name="action" value="Cancel" />
	</div>
</form>
<?php 
fw_finish();
?>