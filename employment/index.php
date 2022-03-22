<!DOCTYPE html><head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	// require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	require_once($_SERVER['DOCUMENT_ROOT'].'/employment/template/employment.include.php');
	$page_options['title'] = 'Employment Opportunities';
	$page_options['head'] = '';
	$page_options['page'] = 'Student Job Application';
  	// $page_options['header_image'] = '/template/images/banners/student_employment.png';
	// $page_options['header_image'] = '/template/images/banners/employment_unions_banner.jpg';
	employment_start($page_options);
session_start();
?>

<style>
*, *::after, *::before {
	box-sizing: border-box;
}
.modal {
	
}
.modal-dialog {
	top: 250px;
	width: 1250px;
	min-width: 1000px;
	max-height:200px;
	height:309px;
	min-width:50vw;
	max-width:100vw;
}
.modal-header {
	padding: 10px 15px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	border-style: solid;
	/*border-bottom: 1px solid black;*/
}
.modal-body {
	position: flex;

	align-self:stretch;	
}
.modal-content {
	position:flex;
	align-items:flex-start;
}
.modal-img {
	position: relative;
	width: 309px;
	height:400px;
	align-self:stretch;

}
input[type="submit"] {
    background: url(./images/submit.png) no-repeat;
    /* position: relative;
    top: ;
    left: ; */
    width: 105px;
    height: 27px;
    border : none;
    color : transparent;
    font-size : 0;
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    background-size: cover;
}
.btn-secondary, .button-submit {
    position:relative;
    left: 20px;
    top: 10px;
    width: 105px;
    height: 28px;
    margin: 10 auto;
    padding: 0;
    display: table-cell;
    vertical-align: middle;
    font-size: 20px;
    font-weight: bold;
}
label {
	font-family: Garamond, Georgia, Helvetica, Arial;
	font-size: 24px;
	font-weight:bold;
}
.p-header {
    color:#ac051f; 
    font-weight:bold; 
    font-size:36px; 
    font-family: Garamond, MiloWeb, Verdana, sans-serif;
    text-align: center;
}
input[type="radio"] {
	margin: 10px;
}
</style>
<script>
/* old-fashioned way of displaying a popup that gets blocked by popup blockers. See modal below */
function popup(mylink, windowname) {
	if (!window.focus)return true;
	var href;
	if (typeof(mylink)=='string') href=mylink;
	else href=mylink.href;
	window.open(href, windowname, 'width=800,height=400, top=350, left=450'); //top and left change position of open window on screen
	//var Window = window.open(href, windowname, 'width=800,height=400, top=350, left=450');
	//return Window !== null && typeof Window !== 'undefined';
	//Window.focus();
	return false;
}
function openForm() {
	document.getElementById("hearAboutUs").style.display = "block";
}
function closeForm() {
	document.getElementById("hearAboutUs").style.display = "none";
}
function showOtherText() {
	const x = document.getElementById("Other_text");
	const radios = document.querySelectorAll('input[name="heard_from"]');
	let selectedVal;
	for (const radiobutton of radios) {
		if (radiobutton.checked) {
			selectedVal = radiobutton.value;
			break;
		}
	}
	if (x.style.display == "block" && selectedVal !== "Other") {
		x.style.display = "none";
		document.getElementById("Other_text").required = false;
	} else if (x.style.display == "none" && selectedVal == "Other") {
		x.style.display = "inline";
		document.getElementById("Other_text").required = true;
	}
}
function submitForm() {
	document.getElementById("responseForm").submit();
}
$("#prospects_form").submit(function(e) {
    e.preventDefault(); // <==stop page refresh==>
});
var form = document.getElementById("responseForm");
function handleForm(event) { event.preventDefault(); } 
form.addEventListener('submit', handleForm);
</script>
<html lang="en">
<!-- <body onClick="popup('./popup.php', 'test'); this.onclick=null;"> -->
<?php 
if ((isset($_GET['redirect'])) && ($_GET['redirect'] = "yes")) {
	// Don't disply the popup survey.  This is the second time loading.
?> 
<body> 
<?php } else { // Disply the popup survey. ?>
<body onload="$('#responseModal').modal('show');">
<?php } ?>

<script src="jquery.js"></script>
<table border="0" cellspacing="0" cellpadding="0">
<!-- modal -->
<div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true" style="max-width:100%; max-height:100%;">
	<div class="modal-dialog" role="document">
		<div class="modal-content" >
			 <!--<div class="modal-header">
				<h1 class="h1-header">HOW DID YOU HEAR ABOUT US?</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> 
			</div> -->
			<!-- <img id="modal" class="modal-img" src="./images/cook_reduced.jpg" alt="cooks" style="max-width:30vw; max-height:40vw;"> -->
			<div id="form-div">
			<form id="responseForm" method="POST">
			<div class="modal-body">
				<p class="p-header" style="max-width:100vw;">HOW DID YOU HEAR ABOUT US?</p>
				<br/>
				<input type="radio" id="Direct Mail" name="heard_from" value="Direct Mail" onChange="showOtherText()" required>
				<label style="color:rgb(0,112,192); font-size:22;" for="Direct Mail">Direct Mail</label><br />
				<input type="radio" id="Social Media" name="heard_from" value="Social Media" onChange="showOtherText()">
				<label style="color:rgb(0,112,192); font-size:22;" for="Social Media">Social Media</label><br />
				<input type="radio" id="tabling event/job fair" name="heard_from" value="Tabling Event/Job Fair" onChange="showOtherText()">
				<label style="color:rgb(0,112,192); font-size:22;" for="tabling event/job fair">Tabling Event/Job Fair</label><br />
				<input type="radio" id="Recruitment Site" name="heard_from" value="Recruitment Site" onChange="showOtherText()">
				<label style="color:rgb(0,112,192); font-size:22;" for="Recruitment Site">Recruitment Site</label><br />
				<input type="radio" id="YouTube Ad" name="heard_from" value="YouTube Ad" onChange="showOtherText()" required>
				<label style="color:rgb(0,112,192); font-size:22;" for="YouTube Ad">YouTube Ad</label><br />
				<input type="radio" id="Other" name="heard_from" value="Other" onChange="showOtherText()">
				<label style="color:rgb(0,112,192); font-size:22;" for="Other" class="other_label">Other:&nbsp;</label><input type="text" class="Other" id="Other_text" name="Other_text" style="display:none" /><br />
				<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
				<input type="submit" onCLick="submitForm();" name="submit" value="Submit" class="button-submit">
			</div>		
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<input type="submit" onClick="submitForm()" name="submit" value="Submit" class="button-submit">
				<button type="button" onClick="submitForm();"> submit </button> 
			</div> -->
			</form>
			</div>
		</div>
	</div>
</div>
	<tr>	
		<td valign="top">
			<br/><br/>
			<!-- Full-Time Employment -->
			<!-- <button onclick="openFT()" id="button" type="button"><img src="images/ft_employment_banner.jpg" width="650" height="65"></button> -->
			<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responseModal">
				Launch Modal
			</button> -->
			<a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&cfdd%5b0%5d%5bid%5d=227&cfdd%5b0%5d%5boptions%5d%5b0%5d=308&cfdd%5b0%5d%5boptions%5d%5b1%5d=307&cfdd%5b0%5d%5boptions%5d%5b2%5d=291&sq=union" target="_blank" >
				<img src="images/SU_Landing Page_HIRING_21.png" alt="Join Our Team!" width="650" height="250" style="max-width:85vw; max-height:33vw;">
			</a>
			<br /><br/>
			<input onclick="openFT()" id="button" type="image" src="images/ft_employment_banner.jpg" width="650" height="65" style="max-width:85vw; max-height:10vw;" />
			<div id="ftEmp" style="display:none">
			<br/><br/>
			<h2 style="color:#ac051f; font-weight:bold;">COME WORK WITH US!</h2>
			<p>Join our team at the Arizona Student Unions, considered the kitchen and living room of the University of Arizona, where everyone can eat, play, relax, and get involved! Here you will find more than 30 restaurants, the Arizona Catering & Events Co., Rooftop Greenhouse, Esports Arena and more. We provide a "home away from home" to balance the diverse educational, recreational, cultural and social needs of today's student. <br /><br />
			We want to help unlock your career potential! Beyond just a job, we offer opportunities for growth with an employer that strives to get you where you want.</p>
			<br/><br/>
			<p style="font-size:17;"><em>Career positions currently open (click to apply):</em></p>
			<div style="display:table; margin:0">
			<ul style="columns:2;">	
				<li style="font-size:17px; color:rgb(0,112,192); font-weight:bold;"><a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&cfdd%5b0%5d%5bid%5d=227&cfdd%5b0%5d%5boptions%5d%5b0%5d=291&sq=cook" target="_blank" style="color:rgb(0,112,192);">COOKS</a></li>	
				<li style="font-size:17px; color:rgb(0,112,192); font-weight:bold;"><a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&sq=bake" target="_blank" style="color:rgb(0,112,192);;">BAKERS</a></li>
				<li style="font-size:17px; color:rgb(0,112,192); font-weight:bold;"><a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&sq=culinary%20and%20food" target="_blank" style="color:rgb(0,112,192);">SERVERS</a></li>
				<li style="font-size:17px; color:rgb(0,112,192); font-weight:bold;"><a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&sq=dishwasher" target="_blank" style="color:rgb(0,112,192);">DISHWASHERS</a></li>
				<li style="font-size:17px; color:rgb(0,112,192); font-weight:bold;"><a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&sq=materials%20handler%20I" target="_blank" style="color:rgb(0,112,192);">MATERIALS HANDLERS</a></li>
				<li style="font-size:17px; color:rgb(0,112,192); font-weight:bold;"><a href="https://arizona.csod.com/ux/ats/careersite/4/home/requisition/5952?c=arizona" target="_blank" style="color:rgb(0,112,192);">CUSTODIANS</a></li>
				<li style="font-size:17px; color:rgb(0,112,192); font-weight:bold;"><a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&cfdd%5b0%5d%5bid%5d=156&cfdd%5b0%5d%5boptions%5d%5b0%5d=114&cfdd%5b1%5d%5bid%5d=227&cfdd%5b1%5d%5boptions%5d%5b0%5d=291&sq=conference%20and%20events&city=tucson" target="_blank" style="color:rgb(0,112,192);">CONFERENCE & EVENT PLANNERS</a></li>

			</ul>
			</div>
			<br/>
			<h2 style="color:#ac051f; font-weight:bold;">WE’VE GOT YOU COVERED</h2>
			<p style="font-size:17;"><em>The University provides outstanding benefits including:  </em></p><br/>
			<ul>
			<li style="font-size:17px;">Qualified Tuition Reduction for employees and qualifying family members</li>
			<li style="font-size:17px;">Health, Dental, and Vision insurance plans</li>
			<li style="font-size:17px;">Generous Paid Vacation, Sick Leave, and Holidays</li>
			<li style="font-size:17px;">Life Insurance and Disability Programs</li>
			<li style="font-size:17px;">State and Optional Retirement Plans</li>
			<li style="font-size:17px;">Access to UA Recreation and Cultural Activities </li>
			<li style="font-size:17px;">Discounts on local transit services, including SunTran and the SunLink Streetcar</li>	
			</ul>
			<br/>
			<p style="font-size:17;"><em>In addition, the University offers:  </em></p>
			<ul>
			<li style="font-size:17px;">Wellness programming</li>
			<li style="font-size:17px;">Employee assistance programs and Career Advising</li>
			<li style="font-size:17px;">Childcare reimbursement </li>
			<li style="font-size:17px;">Adult and eldercare support </li>
			<li style="font-size:17px;">Health screenings </li>
			</ul>
			<br/><br/>
			<h2 style="color:#ac051f; font-weight:bold;">HOW TO APPLY</h2>
			<p style="font-size:17;">To view all open UArizona Student Union job opportunities, <a href="https://arizona.csod.com/ux/ats/careersite/4/home?c=arizona&cfdd%5b0%5d%5bid%5d=227&cfdd%5b0%5d%5boptions%5d%5b0%5d=308&cfdd%5b0%5d%5boptions%5d%5b1%5d=307&cfdd%5b0%5d%5boptions%5d%5b2%5d=291&sq=union" target="_blank" style="color:rgb(0,112,192);;">CLICK HERE.</a>
			<br/><br/>
			For more information on how to submit your application using the University of Arizona’s online applicant portal click the button below:</p><br/>
			<a href="https://union.arizona.edu/about/template/resources/TalentApplicantGuide.pdf" target="_blank"><img src="images/Talent Applicant Guide_Button.png" alt="Talent Applicant Guide" width="63%" height="62%" style="margin-left:8rem"></a>
			</div>
			<br/><br/><br/><br/><br/><br/>
		
			<!-- Student Employment -->
			<!--<button onclick="openStudent()" id="button" type="button"><img src="images/student_employment_banner.jpg" width="650" height="65" ></button> -->
			<a href="https://arizona.joinhandshake.com" target="_blank"><img src="images/join_our_team_Student.png" alt="Join Our Team!" width="650" height="250" style="max-width:85vw; max-height:33vw;"></a>			
			<br/><br/>
			<input onclick="openStudent()" id="button" type="image" src="images/student_employment_banner.jpg" width="650" height="65" style="max-width:85vw; max-height:10vw;"/>
			<div id="studentEmp" style="display:none">
			<br/><br/>
			<h2 style="color:#ac051f; font-weight:bold;">Join the Arizona Student Unions’ Winning Team</h2>
			<p>Over 1,000 students work for the Arizona Student Unions each semester, making us the largest student employer on campus. Be part of our diverse winning team and receive hands-on experience, while working in a fun and safe environment. We strive to coach, teach, and mentor all of our students.<br /><br />
				Studies prove that students with campus jobs tend to perform better in school, so get involved today! We have several different areas for students to work in, including: Culinary Services, Catering, Operations, Retail, Human Resources, Marketing, Administration, and Event Services.</p>
			<br /><br/>
			<h2 style="color:#ac051f; font-weight:bold;">How to apply for a job!</h2>
			<p style="font-size:18px; font-weight:500;">
				To apply, please visit <a href="https://arizona.joinhandshake.com" target="_blank"><b>Handshake</b></a> and search for 'AZ Student Unions'
			</p><br/>
			<p>
				If you have any questions please feel free to email us at <a href="mailto:su-unionshr@email.arizona.edu">su-unionshr@email.arizona.edu</a> or call us at 520-626-9205!
			</p>
			<!-- <ul>
					<li>Apply here and complete an <a href="./application/start.php">Online Application</a>.</li>
					<li><a href="./application/start.php">Edit Your Existing Application</a></li>
					<li>Check out our <a href="available.php">Available Positions</a> that may interest you</li>
					<li>Check out our <a href="faq.php">FAQ Section</a> for more information.</li>
					<li>Call Student Human Resources at (520) 626-9205 with any questions</li>
					<li><strong>NOTE: If you are an incoming freshman, you can only begin working 1 week before the start of the semester.</strong></li>
			</ul> -->
			<br /><br/>
			<h2 style="color:#ac051f; font-weight:bold;">We Understand Juggling Work and School</h2>
			<p>At the Arizona Student Unions, we know that students' first priority is to learn. We understand the stress of midterms and final exams. So we not only teach student employees leadership and time management, we are also very flexible when it comes to working around your class and exam schedule.</p>
			<br /><br/>
			<h2 style="color:#ac051f; font-weight:bold;">We Accept Work Study</h2>
			<p>
				Federal Work Study is accepted at the Arizona Student Unions. The Federal Work Study Program provides opportunity to full-time students seeking part-time positions. Students must complete the FAFSA and demonstrate financial need for the respective year to receive Federal Work Study. 
				<!-- See if you qualify at: <a href="http://www.fafsa.ed.gov">www.fafsa.ed.gov</a>. -->
				For more information on Federal Work study, go to <a href="https://financialaid.arizona.edu/" target="_blank">The Office of Scholarships and Financial Aid</a>. 
			</p>
			<br /><br/>
			<h2 style="color:#ac051f; font-weight:bold;">Check out our Benefits!</h2>
			<ul>
				<li style="font-size:17px">50% off meals</li>
				<li style="font-size:17px">Work Study accepted</li>
				<li style="font-size:17px">Flexible hours</li>
				<li style="font-size:17px">Competitive wages</li>
				<li style="font-size:17px">Meet new friends</li>
				<li style="font-size:17px">Work with other students</li>
				<li style="font-size:17px">Convenience (we’re on campus)</li>
				<li style="font-size:17px">Opportunity for advancement</li>
			</ul>
			<br /><br/>
			<h2 style="color:#ac051f; font-weight:bold;">Example Student Positions at the Unions:</h2>
			<ul>
					<li style="font-size:17px">Student Dining Services Attendant</li>
					<li style="font-size:17px">Student Event Services Assistant</li>
					<li style="font-size:17px">Student Dining Services Cashier</li>
					<li style="font-size:17px">Student Office Assistant</li>
					<li style="font-size:17px">Student Coordinator</li>
					<li style="font-size:17px">Student Accounting</li>
					<!-- <li style="font-size:17px">Gallery Assistant</li> -->
					<!-- <li style="font-size:17px">Notes Specialist</li> -->
					<li style="font-size:17px">And many more!</li>
			</ul>
			<br /><br/>
			<h2 style="color:#ac051f; font-weight:bold;">Good to Know:</h2>
			<ul>
				<li style="font-size:17px">Bring acceptable documentation as defined <a href="accept-docs.pdf">here</a>.</li>
				<li style="font-size:17px">Are you registered for classes? For &ldquo;student employment,&rdquo; you must be registered as a UA student with at least 6 units.</li>
				<li style="font-size:17px">Know your schedule. Decide when you really have time to work, and stick to it.</li>
				<li style="font-size:17px">If you see three papers and a test coming in a few weeks, let your supervisor know as soon as you know, so that you can arrange something in advance, instead of waiting until the last minute!</li>
			</ul>
			<br />
			<!-- <h2>Other Job Listings</h2>
			<p>Check out Handshake for job listings at the UA, Tucson, and the US: 
			<a href="http://arizona.joinhandshake.com" target="_blank">http://arizona.joinhandshake.com</a>.<br>
				<br>
			</p> -->
			</div>
	  </td>
  </tr>
</table>
<!-- three scripts for bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<!-- <img src="images/GETaJob_ill.gif" alt="Get a Job!" text="Get a Job!" /> -->
<script>
//these two functions open and close the FT and student sections of page
function openStudent() {
	x = document.getElementById("studentEmp");
	if (x.style.display==="none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}
function openFT() {
x = document.getElementById("ftEmp");
	if (x.style.display==="none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}

</script>

<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['submit'])) {
	//start email//
	//header('Content-Type: text/html');
	// $to = "baas-mkt@arizona.edu";   	//receiver
	$to = "su-web@email.arizona.edu";   	//receiver
	$from = "baas-mkt@email.arizona.edu"; 	//sender
	// To send HTML mail, the Content-type header must be set
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". "baas-mkt@email.arizona.edu" . "\r\n";
	// $headers .= "CC: baas-mkt@email.arizona.edu\r\n"; 
	// $headers .= "BCC: riccypartida@arizona.edu\r\n"; 
	$headers .= "BCC: su-web@email.arizona.edu\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$subject = "Student Unions Employment - How Did You Hear About Us? Response";
	//$subject2 = "subject2";  		//can set extra subjects if sending emails to different people/organizations
	$msg = "<html><body><h2 style='color:#ac051f; font-weight:bold;'>     Hello,<br/><br/>A response has been received from \"<u>How Did You Hear About Us?</u>\" pop-up form of the Student Union Employment Opportunities site.</h2>\n";
	$msg .= "<h4> The response is:</h4>    <h3>" . $_POST['heard_from'] . "</h3>";
	//check if the response of 'heard_from' is 'Other', and add user entered text to $msg
	if ($_POST['Other_text']) {
		$msg .= "<h4>user typed entry:</h4> <h3>" . $_POST['Other_text'] . "</h3>";
	}
	$msg .= "</body></html>";
	//store the popup information into the database//
	$db = new db_mysqli('su');
	$query = "INSERT INTO employment SET " . 
		"response = '" . $_POST['heard_from'] .
		"', other = '" . $_POST['Other_text'] . 
		"'";
	$db->query($query);
	//send email//
	$email = mail($to,$subject,$msg,$headers);
	if ($email) {
		print_r('<script type="text/javascript">alert("Email sent! Thank you for your response!\n");window.location.href="index.php?redirect=yes";</script>');
	} else {
		print_r('<script type="text/javascript">alert("There was a problem sending your response. Please close the window and refresh the employment page to try again.");window.close();</script>');
	} 
}
?>

<?php employment_finish() ?>
