<?php
if ($_POST['conditionsAgreement'] == true) {
	$sel1 = "checked";
}

$shuttle = ($_SESSION['shuttle'] == 'yes1') ? ' + $' . SHUTTLE1 . ' for shuttle service' : (($_SESSION['shuttle'] == 'yes2') ? ' + $' . SHUTTLE2 . ' for shuttle service' : '');

$form3 ='
<form action="application.php" name="page2" method="post">

	<input type="hidden" name="page3_submitted" value="true">

	<h1>Payment</h1>
    
    <ul>
        <li>$' . COST . $shuttle . '</li>
        <li>There are no group rates.</li>
        <li>Refunds can be made for cancellations requested in writing by April 22, 2011, but will have an administrative fee of $50 assessed to the refund.
        <li>No refunds can be made after April 22, 2011.</li>
    </ul>
    
    <p style="padding-right:30px;">
    	In addition to the Equiss Retreat Application, all participants are asked to agree to the following: I hereby give the Equiss Retreat the absolute right and permission to copyright, publish or use photographs of me in which I may be included in whole or in part or composite or distorted in character or form, in conjunction with my own or fictitious name, or reproductions thereof in color or otherwise, made through any media that Equiss chooses or hires someone to create and/or reproduce, for art, advertising, use on the Equiss website, in publications, trade or any other lawful purpose whatsoever. I hereby waive my right to inspect, and/or approve the finished product of the advertising copy that may be used in connection therewith, or the use to which it may be applied. I am 18 years of age or older and I am competent to contract in my own name. I have read this release before submitting below and I fully understand the contents, meaning and impact of this release. By submitting this application I understand that I have agreed to the above statements.
    </p>  
    
    <p>
    	Printed Name: <input type="text" name="printedName" size="30" maxlength="50" value="' . $_POST['printedName'] . '"/><br />
        Date (MM/DD/YYYY): <input type="text" name="sigDate" size="11" maxlength="10" value="' . $_POST['sigDate'] . '"/><br /><br />
        <input type="checkbox" value="I agree" name="conditionsAgreement" ' . $sel1 . '/> I agree to the above mentioned conditions.
    </p>  	
    
     <input type="submit" value="Submit" />
    
</form>';

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
	
	return $error_string;
}
?>