<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Arizona Student Union employee application:';
  $page_options['nav']['Employment']['Apply Now!']['link'] = '/employment/application/start.php';
  $page_options['nav']['Employment']['Available Positions']['link'] = '/employment/available.php';
  $page_options['nav']['Employment']['Student HR Department']['link'] = '/about/student_hr';
  $page_options['nav']['Employment']['Arizona Applied Leadership Program (AALP)']['link'] = '/about/aalp/';
  $page_options['nav']['Employment']['FAQs']['link'] = '/employment/faq.php';
  page_start($page_options);
?>
<h1>Thank you for your interest in the Arizona Student Unions. At this time, we have no open positions and are no longer actively hiring for the Fall '09 semester.

If you have any questions about positions with the Union, please contact our Student Human Resource Coordinator, Jessica Stoelting, at <a href="mailto:unionshr@email.arizona.edu">unionshr@email.arizona.edu</a>.</h1>



<?php page_finish() ?>
