<?php
$form3 ='
	<h1>Check Information</h1>
    
    <p>Please enter check information below</p>
    
    <form action="application.php" method="post">
	
		<input type="hidden" name="page3_submitted" value="true">
    	
        <p>Check Number <input type="text" name="checkNum" size="30" maxlength="50" /><br /></p>
        
        <input type="submit" />
    	
    </form>
    
    <p>If you did not mean to pay with check, you can still complete your registration by paying with a credit card <a href="application.php?page=cc3">here</a></p>
</p>
<p>
Equiss/Center for Student Involvement & Leadership <br />
Arizona Student Unions <br />
PO Box 210017 <br />
Tucson, AZ 85721-0017
</p>
';



function register_page3_variables() {

	$_SESSION['checkNum']	= $_POST['checkNum'];
	
}

function verify_page3_info() {
	
	$error_string = "";
	
	if($_POST['checkNum'] == "") {
		$error_string = "Your check number is a required field.<br>";
	}
	
	if(!$_SESSION['admin']) {
		$error_string = "You are not a verified administrator.<br>";
	}
	
	return $error_string;
}
?>
