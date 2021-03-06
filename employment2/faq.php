<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Employment Opportunities';
  $page_options['nav']['Employment']['Apply Now!']['link'] = '/employment/application/start.php';
  $page_options['nav']['Employment']['Available Positions']['link'] = '/employment/available.php';
  $page_options['nav']['Employment']['Student HR Department']['link'] = '/about/student_hr';
  $page_options['nav']['Employment']['Arizona Applied Leadership Program (AALP)']['link'] = '/about/aalp/';
  $page_options['nav']['Employment']['FAQs']['link'] = '/employment/faq.php';
  $page_options['header_image'] = '/template/images/banners/student_employment.png';
  page_start($page_options);
?>
<style>
	#content a {
		color: #AA3333;
	}
</style>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/template/expand.css" />
<script  type="text/javascript" src="/template/expand.js"></script>

<script type="text/javascript">
	$(function() {
		// --- Using the default options:
		$("h2.expand").toggler();
		// --- Other options:
		//$("h2.expand").toggler({method: "toggle", speed: 0});
		//$("h2.expand").toggler({method: "toggle"});
		//$("h2.expand").toggler({speed: "fast"});
		//$("h2.expand").toggler({method: "fadeToggle"});
		//$("h2.expand").toggler({method: "slideFadeToggle"});
		$("#content").expandAll({
			trigger : "h2.expand",
			ref : "div.demo",
			localLinks : "p.top a"
		});
	}); 
</script>

<h1 style="width: 700px;" >Student Employee Application and Hiring FAQs</h1>

<a name="top"></a>

<p style="margin-top: 15px;"><b>Click on the questions to display the answers.</b></p>

<div id="content" >
	
	<h2 class="expand" >How many hours will I need to work?</h2>
	<div class="collapse">
		<p>
		The hours you work per week depends on you. When you apply you are asked to fill in the times you would like to work. Managers use 
		this to schedule shifts. The Unions always take your class schedule into consideration and realize you are a student first.
		</p>
		<p>
		If you are applying to a specific job from our available jobs list, make sure you read it carefully as some managers request a 
		preferred number of hours. As a student you can work anywhere from about 4 hours up to 30 hours a week (20 for international students).
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>
	
	<h2 class="expand" >How much will I get paid?</h2>
	<div class="collapse">
		<p>
		This depends primarily on where you work. Most of our jobs start at $7.65 an hour, or minimum wage. Some of our more qualified 
		positions start at a higher pay. If you are applying for an internship please check with the listed supervisor to discuss 
		compensation. As a student you can ear both merit raises and raises based on high evaluation scores. The current pay ranges for 
		students based on area are:
		</p>
		<ul style="list-style-type: none; line-height: 1.5em;">
			<li>Dining Services: $7.65 - $11 per hour</li>
			<li>Center for Student Involvement and Leadership: $7.65 - $9.25 per hour</li>
			<li>Marketing/Admin: $7.65 - $11 per hour</li>
			<li>Operations: $ 7.65 - $11 per hour</li>
		</ul>
		<p>
		Internships- may be paid or unpaid. Please refer to the description or contact the supervisor for further questions
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>
	
	<h2 class="expand" >What if I have work study/financial aid?</h2>
	<div class="collapse">
		<p>
		If you have completed your FAFSA and received your financial award letter stating you have qualified for work study, you are considered 
		"work study eligible". This means you can apply for both off campus and on campus jobs that accept work study. The Arizona Student Unions 
		welcomes any work study eligible student to apply, as all jobs at the Union accept Federal Work Study. If you do not have work study 
		you can still apply, but be aware that a few positions, such as in the Center for Student Involvement and Leadership, require work study. 
		You can check if you are work study on Student Link. During the first week of August forms will become available to you on student link 
		to give to your employer.
		</p>
		<p>
		To find out more information about work study please visit the Financial Aid Office or go to their website 
		<a href="https://financialaid.arizona.edu/Workstudy/">here</a>
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >I don't want to work with food; can I still get a job at the Union?</h2>
	<div class="collapse">
		<p>
		The Arizona Student Unions employs anywhere from 800- 1000 students during Fall and Spring semester. There are four main areas where you 
		can work: Dining Services, Operations, Retail/Admin, and the Center for Student Involvement and Leadership. We have jobs ranging from dining 
		services attendants to desk jobs and internships. Although 75% of our student jobs fall under Dining Services, there are a number of other 
		opportunities in the Union.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What can I apply for?</h2>
	<div class="collapse">
		<p>
		You are able to able for jobs through our <a href="/employment/application/start.php">online application</a> page. The Union's ???Get a JOB??? 
		online application has several options when applying. You are able to apply to any and all available jobs. Your application will be sent out 
		to all managers. You may also apply for specific Union departments. The Unions has four main areas: Dining Services, Operations, Retail/Admin, 
		and the Center for Student Involvement and Leadership. There are different benefits to working in each area. You may also apply for specific 
		jobs or units. The Unions has 42 units that hire students. The amount of units and specific jobs varies during the year. There are also various 
		internships offered throughout the year. The Union has several options for employment and jobs for every interest.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What if I've never had a job before?</h2>
	<div class="collapse">
		<p>
		The Student Unions welcomes every type of student to apply. If you have no previous work experience the Union is a good place to start. We offer 
		a convenient on campus location and flexible scheduling. It's a great resume builder too!
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Is it a good idea for freshman to work?</h2>
	<div class="collapse">
		<p>
		Working for the Unions is a great way to get involved and get to know your campus and peers. Studies prove that students who are involved on campus 
		do better in school, and the Union is the perfect place to get involved! Working is a great chance to gain valuable skills, meet wonderful people, 
		and make a little money too.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Where can I find available jobs?</h2>
	<div class="collapse">
		<p>
		To check current job openings please visit out <a href="available.php">Available Jobs</a>  page to read job descriptions and qualifications of all 
		the units currently hiring. This is updated regularly, so if you don't see something you like now, check back again in a few days or weeks.
		</p>
		<p>
		You can also search for Student Unions jobs on the Wildcat Joblink, a job posting site for the University of Arizona. This can be found on the career 
		services website <a href="http://www.career.arizona.edu">www.career.arizona.edu</a>. You can search Student Union jobs by looking searching "Student 
		Union Services" under the job function search field. It is also a good idea to apply to more than one place. Check out all on campus jobs.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What if I don't have a Net ID?</h2>
	<div class="collapse">
		<p>
		If you are a U of A student use your Net ID to create and log into our application. If you are a Pima student or a high school student you will need 
		to use a valid email and create a password. Remember this password! You may need it to log back into your application at a later date.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Can I apply if I don't know my schedule?</h2>
	<div class="collapse">
		<p>
		We recommend waiting to apply until you know the hours and times you would like to work. It is hard to fill out the scheduling tool on our application 
		if you don't know your class schedule. The Union's application allows you to mark the hours that you want to work, so it's best to be prepared.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What if my schedule has changed since I applied?</h2>
	<div class="collapse">
		<p>
		If you have already applied and your schedule changes at any time, you can log back into your account and <a href="/employment/application/start.php">edit 
		your existing application</a>.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >How do I log into my status page?</h2>
	<div class="collapse">
		<p>
		To log back in click APPLY NOW and enter your Net ID or email and password that you originally used to apply. This will take you to your application's 
		status page. Click EDIT to go back in and change information. Don't forget to hit SAVE AND CONTINUE when you are done with your edits! Be aware that 
		you do not need to re-submit your entire application, just save the page(s) you changed.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Once I apply, when will I be contacted?</h2>
	<div class="collapse">
		<p>
		The Unions have around 40 units that hire students, and even more if you include our internship sites. Depending on where you applied to, the time 
		it takes for you to be contacted may vary. Please be patient as our managers are very busy. If you are extremely interested in a certain position, 
		feel free to contact the manager at that unit and give them your name and contact information. This could increase your chances of gaining employment 
		in that specific area.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What if I have not been contacted yet?</h2>
	<div class="collapse">
		<p>
		If you have not been contacted within 4 weeks of applying you will receive an email message detailing further instructions and information. Please 
		check you email regularly for updates. Check to make sure you entered a complete schedule on your application. You may not be contacted if you only 
		marked a few hours or half hours. We have found that some students only check a few boxes, and this limits their chances. While there are no minimum 
		hours you need to work, keep in mind the length of a proper shift is. Most shifts at our locations are about 4 hours long. Also make sure you applied 
		to the areas, units, and departments you are really interested in. If you apply to a unit that is not hiring be advised you may not be contacted at all.
		</p>
		<p>
		Finally, applying to the Arizona Student Unions does not guarantee employment. If you are not hired we suggest you visit 
		<a href="http://www.career.arizona.edu/">Career Services</a> or <a href="https://www.career.arizona.edu/Auth/WebAuthLogin.aspx?ReturnUrl=/Restricted/JobLink/">Wildcat 
		Joblink</a> for other on campus opportunities.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Do you have summer employment?</h2>
	<div class="collapse">
		<p>
		Due to summer closures, the Arizona Student Unions does not actively seek students for summer employment. You can however apply for the fall semester 
		over summer and apply for the spring semester during the fall. When you apply make sure you check the right semester in the application.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >When can I start work?</h2>
	<div class="collapse">
		<p>
		If you are an incoming freshman please be aware you can only start work 2 weeks prior to the first day of school.
		</p>
		<p>
		Your start date is determined by your hiring supervisor. You will need to fill out a hiring packet once offered a position. After this is processed, then 
		you may begin work.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What if I am an international student?</h2>
	<div class="collapse">
		<p>
		If you have questions regarding international student employment please visit the International Student Programs and Services Office or their website 
		at <a href="http://internationalstudents.arizona.edu/home">http://internationalstudents.arizona.edu/home</a>
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Are there opportunities for advancement?</h2>
	<div class="collapse">
		<p>
		There are several ways to advance in the Student Union. You can become a student lead in your area, which provides you more responsibility. 
		These positions are filled by experience and high evaluation scores. We also have a Professional Internship Program (PIP) which trains students 
		to become managers within in their area. To learn more about this opportunity visit the PIP informational page <a href="/about/student_hr/pip.php">here</a>. 
		As a student you may also move around to different areas, which is a unique feature to the Arizona Student Unions.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >Who can I talk to if I have questions about the application process or Hiring?</h2>
	<div class="collapse">
		<p>
		Student Human Resources is a student run group that seeks to better employment for student employees at the
		Unions at http://www.union.arizona.edu/about/student_hr/. You may contact SHR with any question you have by
		email <a href="mailto:unionshr@email.arizona.edu">unionshr@email.arizona.edu</a> or phone (520) 626-9205
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

	<h2 class="expand" >What documents do I need to bring if I am hired?</h2>
	<div class="collapse">
		<p>
		A list of acceptable documentation can be found <a href="accept-docs.pdf">here</a>.
		</p>
		<p class="top">
			<a href="#top" style="color: #C00;">&#9650; TOP</a>
		</p>
		<br class="clear" />
		<hr />
		<br />
	</div>

</div>
<br /><br />

<?php page_finish() ?>
