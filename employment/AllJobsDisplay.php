<?php
//******* Warning **********
//This file requires that $_SESSION['UnionJobListings'] is set by GetUnionJobs.php

if ($_SESSION['UnionJobListings_count'] > 0)
{
	//display the job titles and the first 300 characters of thier descriptions.
	foreach($_SESSION['UnionJobListings'] as $id=>$value)
	{
		echo '<a href="available.php?job_index=' . $id . '" style="text-decoration:none;"><h2>' . $value['Job_JobTitle'] . "</h2></a>";
		$string = $value['Job_Description'];
		$length = 300;

		if (strlen($string) > $length) {
		echo "<p>";

		if($length<strlen($string)){
	        while ($string{$length} != " ") {
	            $length--;
	        }
	        echo substr($string, 0, $length);
	    }else{
			echo $string;
		}
		echo "...</p>";
		}else{
		echo "<p>" . $string . "</p>";
		}
	}
}else{
	echo "<h2>We're sorry, there are currently no open jobs in the database.</h2>";
}

?>
