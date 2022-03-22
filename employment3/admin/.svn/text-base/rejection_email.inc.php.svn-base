<?php

// function to generate rejection email
function rejectionEmail($email, $job_titles) {
	$job_titles = str_replace("#", " ", $job_titles);
	$job_titles = str_replace("|", ", ", $job_titles);

	require_once ("phplib/mimemail/htmlMimeMail5.php");
	$mail1 = new htmlMimeMail5();

	//Set the From and Reply-To headers
	$mail1 -> setFrom('Department of Campus Recreation<no-reply@email.arizona.edu>');
	$mail1 -> setReturnPath('no-reply@email.arizona.edu');

	//Set the subject
	$mail1 -> setSubject('Thank you for applying for a student job at the Campus Recreation Center!');

	$body = '<p><h2>Thank you for applying for a student job at the Campus Recreation Center!</h2></p>
		<p>
		Recent Applicant to the Campus Recreation Center,
		</p>
		<p>
		Thank you for applying to work for the position(s): ';

	$body .= $job_titles;

	$body .= 'at the Campus Recreation Center.  We have come to the conclusion that another candidate\'s 
		qualifications are more suitable for our requirements. We sincerely regret that we cannot offer you 
		employment with our organization at this time.
		</p>
		
		<p>
		We encourage you to resubmit your application to the various other open positions at the Campus Recreation Center. The 
		full list of openings can be found at the <a href="http://campusrec.arizona.edu/jobs" >Employment page</a> 
		listed under Available Positions. At  any time you may log back into your application with your NetID and password. This 
		will take you to your status page where you can edit your application, deactivate it, or reactivate it in our system. 
		When editing your application you may change your personal information,  schedule, or job position preferences. This 
		may increase your chances of being hired.
		</p>
		
		<p>
		We wish you all the luck with your job search and thank you again for your interest in our organization.  
		</p>
		
		<p>
		Please do not hesitate to contact us at <a href="mailto:CREC-Employment@email.arizona.edu" >CREC-Employment@email.arizona.edu</a>, 
		should you have any questions about your application. 
		</p>
		
		<p>
		For technical assistance or problems with the online application, please call 520-626-9205 or email <a href="mailto:unionshr@email.arizona.edu">unionshr@email.arizona.edu</a>.
		</p>
		
		<p>
		Thank you, <br />
        Campus Recreation <br />
        Human Resources
		</p>';

	$mail1 -> setHTML($body);

	$result = $mail1 -> send(array($email));
}
?>