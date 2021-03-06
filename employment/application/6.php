<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/studentapp.inc');
session_start();
if (!is_object($_SESSION['employment_app'])) {
	header("Location: /employment/application/index.php");
	exit();
}
if ($_POST['stage']) {
	$_SESSION['employment_app'] -> validate();
	$_SESSION['employment_app'] -> save();
}

// send out an email before we try to activate the application
require_once ("phplib/mimemail/htmlMimeMail5.php");
$mail1 = new htmlMimeMail5();

//Set the From and Reply-To headers
$mail1->setFrom('Arizona Student Union<no-reply@email.arizona.edu>');
$mail1->setReturnPath('no-reply@email.arizona.edu');

// check to see if the application is already activated
if ($_SESSION['employment_app']->application->application_values['active'] == 1) {

	// if it's 1, it's an edit to an existing application

	//Set the subject
	$mail1 -> setSubject('Thank you for updating your job application at the Arizona Student Unions!');

	$body = '<p><h2>Thank you for updating your job application at the Arizona Student Unions!</h2></p>
	<p>
		Your application will be forwarded to our hiring managers according to your<br>
		preferences, and they will contact you soon with more information and<br>
		instructions.
	</p>
	<p>
		If you are hired, you must bring acceptable documentation as defined <a href="http://union.arizona.edu/employment/accept-docs.pdf">here</a> in<br>
		order to complete the hiring process.
	</p>
	<p>
		If you have any questions about your application, or working at the Student<br>
		Union, please send us an email at unionshr@email.arizona.edu, or give us a call<br>
		at 520-626-9205. Thank you again!
	</p>
	<p>
		Note:  You must also be a registered UA or<br>
		high school student in order to work as a student employee.
	</p>';

} else {

	// if it's not 1, it's a new application

	//Set the subject
	$mail1 -> setSubject('Thank you for applying for a student job at the Arizona Student Unions!');

	$body = '<p><h2>Thank you for applying for a student job at the Arizona Student Unions!</h2></p>
		<p>
		Your application will be forwarded to our hiring managers according to your<br>
		preferences, and they will contact you soon with more information and<br>
		instructions.
		</p><p>
		If you are hired, you must bring acceptable documentation as defined <a href="http://union.arizona.edu/employment/accept-docs.pdf">here</a> in<br>
		order to complete the hiring process.
		</p><p>
		If you have any questions about your application, or working at the Student<br>
		Union, please send us an email at unionshr@email.arizona.edu, or give us a call<br>
		at 520-626-9205. Thank you again!
		</p><p>
		Note:  You must also be a registered UA or<br>
		high school student in order to work as a student employee.</p>';
}

$mail1 -> setHTML($body);

$result = $mail1 -> send(array($_SESSION['employment_app']->application->application_values['email']));

// activate the application
$_SESSION['employment_app'] -> finish();
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Arizona Student Union employee application:';
$page_options['nav']['Employment']['Apply Now!']['link'] = '/employment/application/start.php';
$page_options['nav']['Employment']['Available Positions']['link'] = '/employment/available.php';
$page_options['nav']['Employment']['Student HR Department']['link'] = '/about/student_hr';
$page_options['nav']['Employment']['Arizona Applied Leadership Program (AALP)']['link'] = '/about/aalp/';
$page_options['nav']['Employment']['FAQs']['link'] = '/employment/faq.php';
$page_options['header_image'] = 'images/student_employment.png';
page_start($page_options);
?>
<style type="text/css">
	p{
		font-size:13px;
		margin-top: 15px;
		margin-bottom: 0px;
		line-height:15px;
	}
</style>
<div style="margin-left:30px;">

    <div style="margin-top:20px;">
    <img src="images/thankyou.gif" />
    </div>
    <div style="width:900px;">
    	<div style="float:left; width:400px;">
        	<div style="background-color:#dae8d4; background-repeat:no-repeat; width:370px; _width:400px; height:234px; _height:254px; padding:15px;">

                <p>
                	Thank you for applying to the Arizona Student Unions!
                </p>

        		<p>
                	In order to check your application status and make changes to your information, simply log back into the application with your NetID and password. From the <a style="color:#387D31; font-size:13px;" href="./start.php">status page</a>, you may withdraw your application, upload files, view your status, and update your schedule and contact information.
                </p>

        		<p>
                	Please remember to bring acceptable documentation as defined <a href="../accept-docs.pdf">here</a> to all interviews; this is a requirement for hiring.
                </p>
            </div>

        </div>

     <div style="float:left; width:400px; margin-left:30px; position:relative; top:-40px;">
     	<img src="images/thankyou_page_cloud.gif" />
     </div>
    </div>
    </div>


</div>
<?php page_finish(); ?>
