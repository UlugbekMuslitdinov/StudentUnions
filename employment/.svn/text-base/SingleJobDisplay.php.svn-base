<?php

	$current_job = $_SESSION['UnionJobListings'][$job_index];
	
	print '<h1 style="font-size:25px;">' . $current_job['title'] . '</h1>';
	
	print '<h2>' . $current_job['dept_unit'] . '</h2>';
	
	print '<h2>Supervisor:  ' . $current_job['supervisor'] . '</h2>';
	
	print '<h2 style="padding-top:8px;">Description:</h2>';
	print '<p>' . str_replace('•'.chr(9), '&nbsp;'.'&nbsp;&nbsp;&nbsp;'.'•'.chr(9), str_replace(chr(10), '<br>',  $current_job['description'])). '</p>';
	
	if($current_job['qualifications'] != ""){
		print '<h2>Qualifications:</h2>';
		
		print '<p>' .str_replace('•'.chr(9), '&nbsp;'.'&nbsp;&nbsp;&nbsp;'.'•'.chr(9), str_replace(chr(10), '<br>', $current_job['qualifications'])) . '</p>';
	}
	
	print '<a style="font-size:14px;" href="application/start.php?title='. $current_job['title'] . '&dept='.$current_job['dept_unit'].'">Apply for this Job Here!</a>';
	
	print '<p><a href="available.php">Back to All Open Jobs</a></p>';

?>