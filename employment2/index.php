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
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
			<h1>Student Employment</h1>
			<br />
			<h2>Working at the UA Student Unions</h2>
<p>
The Arizona Student Unions is one of the largest student employers on the UA campus. Every semester the Arizona Student Unions employs about 800 students. Become part of our diverse team and receive hands-on experience, working in a fun and safe environment. We strive to coach, teach, and mentor all our exceptional students.
</p>
<p>
Studies prove that students who are involved on campus do better in school, so get involved today! We have several different areas where you can work, including: Dining Services, Operations, Retail /Administration, and the Center for Student Involvement & Leadership.
</p>
<p>
Learn more about campus and meet some great people working for the UA. You can walk right from your class to work and feel safe being right in the middle of our beautiful campus.
</p>
<br />            
            <h2>How to apply for Fall <?php echo date('Y'); ?>	!</h2>
			
			   <ul>
		          <li>Apply here and complete an <a href="./application/start.php">Online Application</a>.</li>
				  <li><a href="./application/start.php">Edit Your Existing Application</a></li>
				  <li>Check out our <a href="available.php">Available Positions</a> that may interest you</li>
				  <li>Check out our <a href="faq.php">FAQ Section</a> for more information.</li>
				  <li>Call <a href="/about/student_hr/">Student Human Resources</a> at (520) 626-9205 with any questions</li>
                  <li>Note: If you are an incoming freshman, you can only begin working 2 weeks before the start of school.</li>
			      
				  
			    </ul>
            
            

<br />   
<h2>Juggling Work and School</h2>
<p>At the Arizona Student Unions, we know that students&rsquo; first priority is to learn. And we understand the stress of midterms and final exams. So we not only teach student employees new skills - like leadership and time management - we are also very flexible when it comes to working around your class and exam schedule.</p>
<br />
<h2>Check out our Benefits!</h2>
<ul>
<li>50% off meals</li>
<li>Flexible hours</li>
<li>Convenience (we're on campus!)</li>
<li>Opportunity for advancement</li>
<li>A way to meet new friends</li>
<li>Work with other students</li>
<li>Competitive wages!</li>
</ul>
<br />
<h2>Example Student Positions at the Unions:</h2>
<ul>
	<li>Dining Services Attendant</li>
	<li>Event Services Assistant</li>
	<li>Dining Services Cashier</li>
	<li>Student Office Assistant</li>
	<li>Student Coordinator</li>
	<li>Student Accounting</li>
	<li>Gallery Assistant</li>
	<li>Notes Specialist</li>
	<li>And many more!</li>
</ul>
<br />
<h2>Good to Know:</h2>
<ul>
<li>Bring acceptable documentation as defined <a href="accept-docs.pdf">here</a>.</li>
<li>Are you registered for classes? For &ldquo;student employment,&rdquo; you must be registered as a UA student.</li>
<li>Know your schedule. Decide when you really have time to work, and stick to it.</li>
<li>If you see three papers and a test coming in a few weeks, let your supervisor know as soon as you know, so that you can arrange something in advance, instead of waiting until the last minute!</li>
</ul>

	<br />
			  
			<h2>Other Job Listings</h2>
			<p>Check out <a href="http://www.career.arizona.edu">Wildcat Job Link</a> for job listings at the rest of the University and around Tucson.<br>
				<br>
			</p>
	  </td>
  </tr>
</table>

<img src="images/GETaJob_ill.gif" alt="Get a Job background image" />

<?php page_finish() ?>