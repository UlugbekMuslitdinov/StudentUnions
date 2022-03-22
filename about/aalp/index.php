<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
	$page_options['title'] = 'Employment Opportunities';
	$page_options['header_image'] = '/template/images/banners/about.png';
	$page_options['styles'] = '#center-col{width:780px;}';
	$nav['Available Positions']['link'] = '/employment/available.php';
	$nav['Student HR Department']['link'] = '/about/student_hr';
	$nav['Arizona Applied Leadership Program (AALP)']['link'] = '/about/aalp/';
	$nav['FAQs']['link'] = '/employment/faq.php';
	$page_options['page'] = 'Leadership Program (AALP)';
	about_start($page_options);
?>

<style>
	h2{
		margin-top: 15px !important;
		margin-bottom: -5px !important;
	}
</style>

<div class="col">
    <div class="col-12 mt-4">
		<h1 style="font-size: 26px">Arizona Applied Leadership Program (AALP)</h1>
		<p>The Arizona Applied Leadership Program is your first step to becoming a Lead in a unit within the Arizona Student Unions. The program seeks to provide a space for Student Leads to hone their craft and create a cohort of student leaders across the Arizona Student Unions who are trained on the best practices for impactful leadership. Student must be enrolled in the class to be promoted to a Student Lead position.</p>
		<br />
		<p>For more information on the Arizona Applied Leadership Program, please contact:</p>
		<p>
		AZ Student Unions</br>
		Human Resources</br>
		<a href="mailto:harrisoj@email.arizona.edu">harrisoj@email.arizona.edu</a></br>
		</p>
	</div>
</div>

<?php about_finish() ?>
