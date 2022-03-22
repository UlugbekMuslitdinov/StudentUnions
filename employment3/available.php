<?php	

session_start();

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Employment Opportunities';
  $page_options['nav']['Employment']['Apply Now!']['link'] = '/employment/application/start.php';
  $page_options['nav']['Employment']['Available Positions']['link'] = '/employment/available.php';
  $page_options['nav']['Employment']['Student HR Department']['link'] = '/about/student_hr';
  $page_options['nav']['Employment']['Arizona Applied Leadership Program (AALP)']['link'] = '/about/aalp/';
  $page_options['nav']['Employment']['FAQs']['link'] = '/employment/faq.php';
  $page_options['header_image'] = '/template/images/banners/student_employment.png';
  page_start($page_options);
    print '<h1>Available Jobs</h1><br />';

// GetUnionJobs.php defines and fills the following session variables:
//		$_SESSION['UnionsJobListings']       - Array of all the open Unions jobs in JobLink
// 		$_SESSION['UnionsJobListings_count'] - number of elements (jobs) in the $UnionJobListings array
include('./GetUnionJobs.php');

if(isset($_GET['job_index'])) {

	$job_index = $_GET['job_index'];
	
	//display only the currently requested job information
	include('./SingleJobDisplay.php');
	
}else {

	//display the job titles and the first part their descriptions.
	include('./AllJobsDisplay.php');
}


?>

<img src="images/Get-a-JOB.gif" alt="Get a Job background image" />

<? page_finish() ?>