<?php

// function to generate hired email
function hiredEmail($email) {

	require_once ("phplib/mimemail/htmlMimeMail5.php");
	$mail1 = new htmlMimeMail5();

	//Set the From and Reply-To headers
	$mail1 -> setFrom('Department of Campus Recreation<no-reply@email.arizona.edu>');
	$mail1 -> setReturnPath('no-reply@email.arizona.edu');

	//Set the subject
	$mail1 -> setSubject('Congratulations! We are pleased to confirm you have been selected to work for the University of Arizona Department of Campus Recreation.');

	$body = '<p><h2>Congratulations! We are pleased to confirm you have been selected to work for the University of Arizona Department of Campus Recreation.</h2></p>
		
		<p>
		Please contact Campus Recreation Human Resources @ (520) 621-6895 to schedule a new-hire appointment. New-hire appointments 
		are available on Mondays and Fridays at 8:00am and 2:00pm; special accommodations can be made for extenuating circumstances.
		</p>
		
		<p>
		Please note your employment with Campus Recreation is contingent on verification of academic enrollment, US Citizenship or 
		Right to Work status, and valid CPR/AED and other applicable certifications.
		</p>
		
		<p>
		Please complete the UA forms and USCIS I9 documentation which can be obtained from the URL links below. Please bring the 
		completed forms, CPR/AED and other required certification as well the identification necessary to fulfill the I9 requirements 
		to your new-hire appointment.
		</p>
		
		<ul style="list-style-type:none; margin-left: 20px;" >
			<li><a href="http://www.hr.arizona.edu/files/Person_Information_Form_07_19_11.pdf">Personal Information Form</a></li>
			<li><a href="http://www.uscis.gov/files/form/i-9.pdf">Employment Eligibility Verification</a></li>
			<li><a href="http://www.hr.arizona.edu/files/Oath_12_2009.pdf">State of Arizona Loyalty Oath</a></li>
			<li><a href="http://www.hr.arizona.edu/files/selfid082010.pdf">Race/Ethnicity and Sex</a></li>
			<li><a href="http://www.hr.arizona.edu/files/vselfid.pdf">Veteran Status</a></li>
		</ul>
		
		<p>
		Thank you, <br />
        Campus Recreation <br />
        Human Resources
		</p>';

	$mail1 -> setHTML($body);

	$result = $mail1 -> send(array($email));
}
?>