<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/career_services.inc');
/*

//if UnionJobListings are older then 30 min, grab them from JobLink again.
if($GLOBALS['UnionJobListings_timestamp'] < (time() - (1800))) { //1800 seconds is 30 min.

	print $GLOBALS['UnionJobListings_timestamp'];
	print "<br><br><br>";

	$GLOBALS['UnionJobListings_timestamp'] = time();
*/
unset($_SESSION['UnionJobListings']);
if(!isset($_SESSION['UnionJobListings']))
	{
		$UnionJobListings = new career_services(945,1);

		//Register them to the session
		$_SESSION['UnionJobListings'] = $UnionJobListings->jobs;
		$_SESSION['UnionJobListings_count'] = count($UnionJobListings->jobs);

	}

?>
