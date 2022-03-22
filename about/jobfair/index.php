<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/about/jobfair/template/jobfair.main.php');
$page_options['title'] = 'Job Fair';
$page_options['header_image'] = '/template/images/banners/jobfair.jpg';
jobfair_start($page_options);
?>
<style type="text/css">
	body.togo_order {
		background: #F4E7D7 !important;
	}
	.page_background {
		background: #FFFFFF;
		margin-top:-20px;
		padding:10px;
	}
	.page_title {
		font-size: 30px;
		font-weight: 600;			
		color: blue;
		margin-bottom:20px;
	}
	.paragraph_title {
		font-size: 24px;
		font-weight: 600;			
		color: black;
		margin-bottom:20px;
	}
	.page_content {
		line-height: 30px;
	}
	.text_description {
		font-size:20px;
	}
	.subheader{
		width: 100%;
		height: 16px;
		background: #CC9D66;
		overflow: hidden;
	}
</style>
<div class="col pl-4">
  <h1 class="mt-4">Job Fair</h1>
  <div class="col-12 page_content">
	<span class="paragraph_title">Looking for a new employment opportunity? Join our team!</span><br />
	<p class="text_description">
	Known as the kitchen and living room of the University of Arizona, the Student Unions is a place where everyone can eat, play, relax, and get involved! We strive to provide a "home away from home" for students, and we'd love to have you on our team!<br /><br />
        
    With the job market recovering, additional covid unemployment benefits coming to an end, and state incentives for attaining employment now available, the University is seeking qualified candidates to join our team for the upcoming academic year. As on-campus enrollment returns to pre-pandemic levels, we are planning to re-open 100% of our operations, so now is an ideal time to apply.
	</p><br />
	
	<span class="paragraph_title">Upcoming Job Fairs</span><br />
	<p class="text_description">
	Join us for one of the following Job Fairs to explore employment opportunities and meet with Student Unions Department Representatives for over 50 front- and back-of-the-house positions in over 30 on-campus restaurants and more!<br /><br />
        
    Refreshments will be provided and parking in the Second Street Garage will be validated for all attendees. These events are open to the public, and attendees are encouraged to dress professionally and bring lots of resumes!
	</p><br />

	<span class="paragraph_title">Job Fairs for University Staff (Full-Time Positions)</span><br />
	<p class="text_description">
	<em>@SUMC North Ballroom</em><br />
	<br />
	Tuesday, August 3rd<br />
	7:00AM-10:00AM<br />
	<br />
	Saturday, August 7th<br />
	7:00AM-10:00AM<br />
	</p><br />

	
  <span class="paragraph_title">Job Fairs for Student Staff</span><br />
	<p class="text_description">
	<em>@Arizona Room</em><br />
	<br />
	Monday, August 9th<br />
	10:00AM-1:00PM<br />
	<br />
	Monday, August 16th<br />
	10:00AM-1:00PM<br />
	<br />
	Wednesday, August 18th<br />
	12:00PM-5:00PM<br />
	<br />

        
  You must be registered for at least 6 units as a student to be eligible for student employment. Students should bring <a href="/about/template/resources/IdentificationDocuments.pdf" target="_blank"><u>appropriate identification documents</u></a> to complete hiring paperwork during the Job Fair.
	</p><br />
	
      
	<span class="paragraph_title">Ready to Apply?</span><br />
	<p class="text_description">
	For University Staff positions, visit <a href="https://talent.arizona.edu">https://talent.arizona.edu</a> to apply. Click <a href="/about/template/resources/TalentApplicantGuide.pdf" target="_blank"><u>HERE</u></a> for more information on how to submit your application using the University of Arizona’s online applicant portal.<br /><br />

    To apply for Student positions, visit <a href="https://career.arizona.edu/jobs/handshake">https://career.arizona.edu/jobs/handshake</a> and search for 'AZ Student Unions'.
	</p><br /><br />
	
	
</div>
</div>

<?php jobfair_finish(); ?>

