<?php 
$form3 ='
	<h1>Scholarship Verification</h1>
	
	<p><strong>Cost is $' . COST_SCHOLARSHIP . '</strong></p>
    
    <p>If you have been approved for a scholarship, you should have been provided with a verification code.  Please enter that code below.</p>
    
    <form action="application.php" method="post">
	
		<input type="hidden" name="page3_submitted" value="true">
    	
        <p>Scholorship Verification Code: <input type="text" name="sch_var_code" size="30" maxlength="50" /><br /></p>
        
        <p style="padding-right:30px;">
    	In addition to the Equiss Retreat Application, all participants are asked to agree to the following: I hereby give the Equiss Retreat the absolute right and permission to copyright, publish or use photographs of me in which I may be included in whole or in part or composite or distorted in character or form, in conjunction with my own or fictitious name, or reproductions thereof in color or otherwise, made through any media that Equiss chooses or hires someone to create and/or reproduce, for art, advertising, use on the Equiss website, in publications, trade or any other lawful purpose whatsoever. I hereby waive my right to inspect, and/or approve the finished product of the advertising copy that may be used in connection therewith, or the use to which it may be applied. I am 18 years of age or older and I am competent to contract in my own name. I have read this release before submitting below and I fully understand the contents, meaning and impact of this release. By submitting this application I understand that I have agreed to the above statements.
    </p>  
    
    <p>
    	Printed Name: <input type="text" name="printedName" size="30" maxlength="50" /><br />
        Date (MM/DD/YYYY): <input type="text" name="sigDate" size="11" maxlength="10" /><br /><br />
        <input type="checkbox" value="I agree" name="conditionsAgreement" /> I agree to the above mentioned conditions.
    </p>  	
        
        <input type="submit" />
    	
    </form>
    
    <p>If you have not been approved for a scholarship, you can still complete your registration by paying with a credit card <a href="application.php?page=cc3">here</a><br />
    OR you can complete a scholorship application <a href="scholarship_app.php">here</a></p>
</p>
<p>
Equiss/Center for Student Involvement & Leadership <br />
Arizona Student Unions <br />
PO Box 210017 <br />
Tucson, AZ 85721-0017
</p>
';



function register_page3_variables() {

	$_SESSION['printedName']	= $_POST['printedName'];
	$_SESSION['sigDate'] 	= $_POST['sigDate'];
	$_SESSION['conditionsAgreement'] 	= $_POST['conditionsAgreement'];
	
}

function verify_page3_info() {
	
	$error_string = "";
	
	if($_POST['printedName'] == "") {
		$error_string = "Your name is a required field.<br>";
	}
	
	if($_POST['sigDate']  == "") {
		$error_string .= "The date is a required field.<br>";
	}
	
	if(!isset($_POST['conditionsAgreement'])) {
		$error_string .= "You must agree to the conditions to complete your application. <br>";
	}
	
	if(isset($_POST['sch_var_code']) && $_POST['sch_var_code'] != "Equiss$11"){
		$error_string .= "The Verification Code you entered is not valid.  Please try again. <br>";
	}
	
	return $error_string;
}
?>
