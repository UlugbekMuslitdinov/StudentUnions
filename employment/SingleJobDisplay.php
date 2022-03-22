<?php

	$current_job = $_SESSION['UnionJobListings'][$job_index];
	
	print '<h1 style="font-size:25px;">' . $current_job['Job_JobTitle'] . '</h1>';
	
	print '<h2>' . $current_job['Employer_Division'] . '</h2>';
	
	print '<h2>Supervisor:  ' . $current_job['Job_Contact'] . '</h2>';
	
	print '<h2 style="padding-top:8px;">Description:</h2>';
	print '<p>' . str_replace('•'.chr(9), '&nbsp;'.'&nbsp;&nbsp;&nbsp;'.'•'.chr(9), str_replace(chr(10), '<br>',  $current_job['Job_Description'])). '</p>';
	
	if($current_job['Job_Qualifications'] != ""){
		print '<h2>Qualifications:</h2>';
		
		print '<p>' .str_replace('•'.chr(9), '&nbsp;'.'&nbsp;&nbsp;&nbsp;'.'•'.chr(9), str_replace(chr(10), '<br>', $current_job['Job_Qualifications'])) . '</p>';
	}
	
	print '<a style="font-size:14px;" href="application/start.php">Apply for this Job Here!</a>';
	
	print '<p><a href="available.php">Back to All Open Jobs</a></p>';

?>