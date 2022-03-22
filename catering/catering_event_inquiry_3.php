<?php

// turn on sessions
@session_start();

require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = 'Arizona Catering Company';
require_once('deliverance.inc.php');
require_once('includes/field_validation.inc.php');
page_start($page_options);
require_once('contact_us.inc.php');
?>
<?php
require_once('catering_slider.inc.php');
?>
<div id="catering_page" >
<?php
require_once('catering_left_col.inc.php');
?>

<?php
 	//restore session variables.

 	// 1st form
 	$firstName = strip_tags($_SESSION['firstName']);
	$lastName = strip_tags($_SESSION['lastName']);
	$fullName = strip_tags($_SESSION['fullName']);
	$email = strip_tags($_SESSION['email']);
	$account = strip_tags($_SESSION['account']);
	$orgName = strip_tags($_SESSION['orgName']);
	$orgAddress = strip_tags($_SESSION['orgAddress']);
	$orgCountry = strip_tags($_SESSION['orgCountry']);
	$orgCity = strip_tags($_SESSION['orgCity']);
	$orgZip1 = strip_tags($_SESSION['orgZip1']);
	$orgZip2 = strip_tags($_SESSION['orgZip2']);
	$orgState = strip_tags($_SESSION['orgState']);
	$orgZipcode = strip_tags($_SESSION['orgZipcode']);
	$orgArea = strip_tags($_SESSION['orgArea']);
	$orgPrefix = strip_tags($_SESSION['orgPrefix']);
	$orgPhone = strip_tags($_SESSION['orgPhone']);
	$orgPhoneNumber = strip_tags($_SESSION['orgPhoneNumber']);
	$orgFaxArea = strip_tags($_SESSION['orgFaxArea']);
	$orgFaxPrefix = strip_tags($_SESSION['orgFaxPrefix']);
	$orgFaxPhone = strip_tags($_SESSION['orgFaxPhone']);
	$orgFaxNumber = strip_tags($_SESSION['orgFaxNumber']);
	$prevEvent = strip_tags($_SESSION['prevEvent']);
	$prevEventDate = strip_tags($_SESSION['prevEventDate']);
	$prevEventDesc = strip_tags($_SESSION['prevEventDesc']);
	$hearAbout = strip_tags($_SESSION['hearAbout']);

 	// 2nd form
	$eventDate = strip_tags($_SESSION['eventDate']);
	$startTime = strip_tags($_SESSION['startTime']);
	$endTime = strip_tags($_SESSION['endTime']);
	$numAttend = strip_tags($_SESSION['numAttend']);
	$eventType = strip_tags($_SESSION['eventType']);
	$foodService = strip_tags($_SESSION['foodService']);
	$setup = strip_tags($_SESSION['setup']);
	$comments = strip_tags($_SESSION['comments']);


	$heading = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' >";
	$heading .= "<html><head></head><body style='font-family: Helvetica,Arial,sans-serif;'>";

	$footing = "</body></html>";

	$confirmation = "";

	// confirmation display and email

	$confirmation .= "<table style='width: 100%; max-width: 640px; margin-top: 0; margin-left: .25em;' cellpadding='0' cellspacing='1' border='0' >";

	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<h1>Catering/Event Inquiry Summary</h1><br />";
	$confirmation .= "<br /><h2>Contact Information</h2>";
	$confirmation .= "<p><b>Name: &nbsp;</b> $fullName</p>";
	$confirmation .= "<p><b>Organization Name: &nbsp;</b> $orgName</p>";
	$confirmation .= "<p><b>Organization Address: &nbsp;</b> $orgAddress</p>";
	$confirmation .= "<p><b>Organization City: &nbsp;</b> $orgCity</p>";
	$confirmation .= "<p><b>Organization State/Province: &nbsp;</b> $orgState</p>";
	$confirmation .= "<p><b>Organization Zipcode/Postal Code: &nbsp;</b> $orgZipcode</p>";
	$confirmation .= "<p><b>Organization Country: &nbsp;</b> $orgCountry</p>";
	$confirmation .= "<p><b>Organization Phone: </b> $orgPhoneNumber</p>";
	$confirmation .= "<p><b>Organization Fax: </b> $orgFaxNumber</p>";
	$confirmation .= "<p><b>Email: </b><a href='mailto:$email' >$email</a></p>";
	$confirmation .= "<p><b>Account Number: </b> $account </p><br />";
	if ($prevEvent == "Yes") {
		if ($prevEventDate) {
			$confirmation .= "<p><b>Previous Event: </b> $prevEventDate</p>";
		}
		if ($prevEventDesc) {
			$confirmation .= "<p><b>Previous Description: </b> $prevEventDesc</p>";
		}
	}
	$confirmation .= "<p><b>How did you hear about us?: </b> $hearAbout</p>";
	$confirmation .= "</td>";
	$confirmation .= "</tr>";


	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<br /><h2>Event Information</h2>";
	$confirmation .= "<p><b>Event Date: </b> $eventDate</p>";
	$confirmation .= "<p><b>Start Time: </b> $startTime</p>";
	$confirmation .= "<p><b>End Time: </b> $endTime</p>";
	$confirmation .= "<p><b>Number of Guests: </b> $numAttend</p>";
	$confirmation .= "<p><b>Event Type: </b> $eventType</p>";
	$confirmation .= "<p><b>Food/Beverage Service: </b> $foodService</p>";
	$confirmation .= "<p><b>Room Setup: </b> $setup</p>";

	$confirmation .= "<p><b>Comments: </b> $comments</p>";
	$confirmation .= "</td>";
	$confirmation .= "</tr>";

  	$confirmation .= "</table>";

// has the form been submitted?
if (isset($_POST['submit'])) {

	// initialize the response variable
	$response = "";
	$confirmation = $heading.$confirmation.$footing;
	require_once('catering_event_inquiry_1_validate.inc.php');
	require_once('catering_event_inquiry_1_validate.inc.php');

	$result = 0;

	if ((!$response) && (!$xcomment))
	{
		$subject = "Summary";
		$header="from: $fullName <$email>";

		$emailTo = "SUEventplanning@email.arizona.edu,$email";
		if(substr(php_uname("s"),0,1)=="W"){//running on windows
		 	ini_set(SMTP,"smtpgate.email.arizona.edu");
		}

		ini_set(sendmail_from, $email);
  		$email_headers = "Content-type: text/html; charset=iso-8859-1\r\nFrom: ".$email;
		$result=mail( $emailTo, "Catering/Event Inquiry: ".$subject, $confirmation, $email_headers );

	}
	if ($result)
	{
		// unset all the variables in session.
		session_unset();
	}
}
?>
<style>

	.hdr-img {
		display: none;
	}

</style>
<div id="center-col" style="text-align: left !important;" >


	<?php
	// if the submit button was clicked.
	if (isset($_POST['submit']))
	{
		// if there were no errors and the email was sent,
		// display a confirmation messge.
		if($result)
	    { ?>
			<?php session_destroy(); ?>

			<script type="text/javascript" >
					location.href="/catering/catering_event_inquiry_thankyou.php";
			</script>

		<?php } else {
			// if there were errors, display them.
			echo "<h4 class='error-msg sub-nav-left-col'  >There were errors in processing the inquiry information.</h4>";

			echo "<p class='error-msg' > $response </p>";
		}
	}?>

	<!-- the $_SERVER['PHP_SELF'] in the action field always posts back to the same form. -->
	<form name="form1" id="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


	    <?php
	    		echo $confirmation;
	    ?>

	    <p>
			<strong>Our staff will contact you shortly to discuss your inquiry.</strong>
		</p>
		<br />

		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/catering/catering_event_inquiry_2.php';" >
		<input type="submit" name="submit" value="submit inquiry">
		<span class="left300 reg12">3 of 3</span>
		<br /><br />

	</form>
	<br /><br /><br /><br />

</div>


<?php
require_once('catering_right_col.inc.php');
?>
</div>

<div style="clear:both;">
	<br /><br /><br />
</div>

<?php page_finish(); ?>
