<?php
//******* Warning **********
//This file requires that $_SESSION['UnionJobListings'] is set by GetUnionJobs.php

if ($_SESSION['UnionJobListings_count'] > 0) 
{
	//display the job titles and the first 300 characters of thier descriptions.
	foreach($_SESSION['UnionJobListings'] as $id=>$value) 
	{
		print '<a href="available.php?job_index=' . $id . '" style="text-decoration:none;"><h2 >' . $value['title'] . "</h2></a>";
		$string = $value['description'];
		$length = 300;
		
		if (strlen($string) > $length) {
		print "<p>";

		if($length<strlen($string)){
	        while ($string{$length} != " ") {
	            $length--;
	        }
	        print substr($string, 0, $length);
	    }else{
			print $string;
		}
		print "...</p>";
		}else{
		print "<p>" . $string . "</p>";
		}
	}
}else{
	print "<h2>We're sorry, there are currently no open jobs in the database.</h2>";
}

?>
