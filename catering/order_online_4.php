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
	$affiliation = strip_tags($_SESSION['affiliation']);
	$other = strip_tags($_SESSION['other']);
	$email = strip_tags($_SESSION['email']);
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


 	// 2nd form
	$eventType = strip_tags($_SESSION['eventType']);
	$eventTitle = strip_tags($_SESSION['eventTitle']);
	$numAttend = strip_tags($_SESSION['numAttend']);
	$prevEvent = strip_tags($_SESSION['prevEvent']);
	$prevEventDate = strip_tags($_SESSION['prevEventDate']);
	$prevEventDesc = strip_tags($_SESSION['prevEventDesc']);
	$fromDate = strip_tags($_SESSION['fromDate']);
	$toDate = strip_tags($_SESSION['toDate']);
	$altFromDate = strip_tags($_SESSION['altFromDate']);
	$altToDate = strip_tags($_SESSION['altToDate']);
	$startTime = strip_tags($_SESSION['startTime']);
	$endTime = strip_tags($_SESSION['endTime']);
	$eventDesc = strip_tags($_SESSION['eventDesc']);
	$account = strip_tags($_SESSION['account']);

	// 3rd form
	$agave = strip_tags($_SESSION['agave']);
	$ballroom = strip_tags($_SESSION['ballroom']);
	$catalina = strip_tags($_SESSION['catalina']);
	$cholla = strip_tags($_SESSION['cholla']);
	$copper = strip_tags($_SESSION['copper']);
	$madera = strip_tags($_SESSION['madera']);
	$mesa = strip_tags($_SESSION['mesa']);
	$mesquite = strip_tags($_SESSION['mesquite']);
	$ocotillo = strip_tags($_SESSION['ocotillo']);
	$picacho = strip_tags($_SESSION['picacho']);
	$pima = strip_tags($_SESSION['pima']);
	$presidio = strip_tags($_SESSION['presidio']);
	$rincon = strip_tags($_SESSION['rincon']);
	$sabino = strip_tags($_SESSION['sabino']);
	$sanPedro = strip_tags($_SESSION['sanPedro']);
	$santaCruz = strip_tags($_SESSION['santaCruz']);
	$santaRita = strip_tags($_SESSION['santaRita']);
	$tubac = strip_tags($_SESSION['tubac']);
	$tucson = strip_tags($_SESSION['tucson']);
	$unionKiva = strip_tags($_SESSION['unionKiva']);
	$ventana = strip_tags($_SESSION['ventana']);
	$venueOther = strip_tags($_SESSION['venueOther']);
	$venueDontKnow = strip_tags($_SESSION['venueDontKnow']);
	$otherVenueDesc = strip_tags($_SESSION['otherVenueDesc']);
	$banquet = strip_tags($_SESSION['banquet']);
	$reception = strip_tags($_SESSION['reception']);
	$theater = strip_tags($_SESSION['theater']);
	$classroom = strip_tags($_SESSION['classroom']);
	$hollowSquare = strip_tags($_SESSION['hollowSquare']);
	$uShape = strip_tags($_SESSION['uShape']);
	$setupOther = strip_tags($_SESSION['setupOther']);
	$setupDontKnow = strip_tags($_SESSION['setupDontKnow']);
	$otherSetupDesc = strip_tags($_SESSION['otherSetupDesc']);
	$breakout = strip_tags($_SESSION['breakout']);
	$breakoutNumber = strip_tags($_SESSION['breakoutNumber']);





	$heading = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' >";
	$heading .= "<html><head></head><body style='font-family: Helvetica,Arial,sans-serif;'>";

	$footing = "</body></html>";

	$confirmation = "";

	// confirmation display and email

	$confirmation .= "<table style='width: 100%; max-width: 640px; margin-top: 0; margin-left: .25em;' cellpadding='0' cellspacing='1' border='0' >";

	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<h1>Catering Summary</h1><br />";
	$confirmation .= "<br /><h2>Contact Information</h2>";
	$confirmation .= "<p><b>Name: &nbsp;</b> $fullName</p>";

	if ($affiliation == "univDept") {
		$confirmation .= "<p><b>Affiliation: &nbsp;</b> University Department</p>";
	} else if ($affiliation == "thirdParty") {
		$confirmation .= "<p><b>Affiliation: &nbsp;</b> Third Party Planner</p>";
	} else if ($affiliation == "assn") {
		$confirmation .= "<p><b>Affiliation: &nbsp;</b> Association</p>";
	} else if ($affiliation == "corp") {
		$confirmation .= "<p><b>Affiliation: &nbsp;</b> Corporation</p>";
	} else {
		$confirmation .= "<p><b>Affiliation: &nbsp;</b> Other</p>";
	}
	if ($other) {
		$confirmation .= "<p><b>Other: &nbsp;</b> $other</p>";
	}
	$confirmation .= "<p><b>Organization Name: &nbsp;</b> $orgName</p>";
	$confirmation .= "<p><b>Organization Address: &nbsp;</b> $orgAddress</p>";
	$confirmation .= "<p><b>Organization City: &nbsp;</b> $orgCity</p>";
	$confirmation .= "<p><b>Organization State/Province: &nbsp;</b> $orgState</p>";
	$confirmation .= "<p><b>Organization Zipcode/Postal Code: &nbsp;</b> $orgZipcode</p>";
	$confirmation .= "<p><b>Organization Country: &nbsp;</b> $orgCountry</p>";
	$confirmation .= "<p><b>Organization Phone: </b> $orgPhoneNumber</p>";
	$confirmation .= "<p><b>Email: &nbsp;</b> <a href='mailto:$email' >$email</a> </p>";
	$confirmation .= "</td>";
	$confirmation .= "</tr>";

	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<br /><h2>Event Information</h2>";
	$confirmation .= "<p><b>Event Type: </b> $eventType</p>";
	$confirmation .= "<p><b>Event Title: </b> $eventTitle</p>";
	$confirmation .= "<p><b>Number Attending: </b> $numAttend</p>";
	if ($prevEvent == "Yes") {
		if ($prevEventDate) {
			$confirmation .= "<p><b>Previous Event: </b> $prevEventDate</p>";
		}
		if ($prevEventDesc) {
			$confirmation .= "<p><b>Previous Description: </b> $prevEventDesc</p>";
		}
	}
	$confirmation .= "<p><b>From Date: </b> $fromDate</p>";
	$confirmation .= "<p><b>To Date: </b> $toDate</p>";
	$confirmation .= "<p><b>Alternate From Date: </b> $altFromDate</p>";
	$confirmation .= "<p><b>Alternate To Date: </b> $altToDate</p>";
	$confirmation .= "<p><b>Start Time: </b> $startTime</p>";
	$confirmation .= "<p><b>End Time: </b> $endTime</p>";
	$confirmation .= "<p><b>Event Description: </b> $eventDesc</p>";
	$confirmation .= "<p><b>Account Number: </b> $account </p><br />";
	$confirmation .= "</td>";
	$confirmation .= "</tr>";

	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<br /><h2>Preferred Venue</h2>";
	if ($agave) {
		$confirmation .= "<p>Agave</p>";
	}
	if ($ballroom) {
		$confirmation .= "<p>Grand Ballroom</p>";
	}
	if ($catalina) {
		$confirmation .= "<p>Catalina</p>";
	}
	if ($cholla) {
		$confirmation .= "<p>Cholla</p>";
	}
	if ($copper) {
		$confirmation .= "<p>Copper</p>";
	}
	if ($madera) {
		$confirmation .= "<p>Madera</p>";
	}
	if ($mesa) {
		$confirmation .= "<p>Mesa</p>";
	}
	if ($mesquite) {
		$confirmation .= "<p>Mesquite</p>";
	}
	if ($ocotillo) {
		$confirmation .= "<p>Ocotillo</p>";
	}
	if ($picacho) {
		$confirmation .= "<p>Picacho</p>";
	}
	if ($pima) {
		$confirmation .= "<p>Pima</p>";
	}
	if ($presidio) {
		$confirmation .= "<p>Presidio</p>";
	}
	if ($rincon) {
		$confirmation .= "<p>Rincon</p>";
	}
	if ($sabino) {
		$confirmation .= "<p>Sabino</p>";
	}
	if ($sanPedro) {
		$confirmation .= "<p>San Pedro</p>";
	}
	if ($santaCruz) {
		$confirmation .= "<p>Santa Cruz</p>";
	}
	if ($santaRita) {
		$confirmation .= "<p>Santa Rita</p>";
	}
	if ($tubac) {
		$confirmation .= "<p>Tubac</p>";
	}
	if ($tucson) {
		$confirmation .= "<p>Tucson</p>";
	}
	if ($unionKiva) {
		$confirmation .= "<p>Union Kiva</p>";
	}
	if ($ventana) {
		$confirmation .= "<p>Ventana</p>";
	}
	if ($venueOther) {
		$confirmation .= "<p><b>Other Venue: </b> $otherVenueDesc</p>";
	}
	if ($venueDontKnow) {
		$confirmation .= "<p>Don't know</p>";
	}
	$confirmation .= "</td>";
	$confirmation .= "</tr>";

	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<br /><h2>Preferred Room Setup</h2>";
	if ($banquet) {
		$confirmation .= "<p>Banquet</p>";
	}
	if ($reception) {
		$confirmation .= "<p>reception</p>";
	}
	if ($theater) {
		$confirmation .= "<p>Theater</p>";
	}
	if ($classroom) {
		$confirmation .= "<p>Classroom</p>";
	}
	if ($hollowSquare) {
		$confirmation .= "<p>Hollow Square</p>";
	}
	if ($uShape) {
		$confirmation .= "<p>uShape</p>";
	}
	if ($setupDontKnow) {
		$confirmation .= "<p>Don't know</p>";
	}

	if ($setupOther) {
		$confirmation .= "<p><b>Other Setup: </b> $otherSetupDesc</p>";
	}
	$confirmation .= "</td>";
	$confirmation .= "</tr>";

	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<br /><h2>Breakout Room</h2>";
	$confirmation .= "<p><b>Will you use breakout rooms?: </b> $breakout</p>";
	if ($breakoutNumber) {
		$confirmation .= "<p><b>Number of breakout rooms needed: </b> $breakoutNumber</p>";
	}

	$confirmation .= "</td>";
	$confirmation .= "</tr>";

  	$confirmation .= "</table>";

// has the form been submitted?
if (isset($_POST['submit'])) {

	// initialize the response variable
	$response = "";
	$confirmation = $heading.$confirmation.$footing;
	require_once('order_online_1_validate.inc.php');
	require_once('order_online_2_validate.inc.php');
	require_once('order_online_3_validate.inc.php');

	$result = 0;

	if ((!$response) && (!$xcomment))
	{
		$subject = "Order Summary";
		$header="from: $fullName <$email>";
		// $emailTo = "samarketingnoise@gmail.com,ehinojos@email.arizona.edu,brendak@email.arizona.edu,mlrobin1@email.arizona.edu,charlenej@email.arizona.edu,sueventplanning@email.arizona.edu";
		$emailTo = "sueventplanning@email.arizona.edu,$email";
		if(substr(php_uname("s"),0,1)=="W"){//running on windows
		 	ini_set(SMTP,"smtpgate.email.arizona.edu");
		}

		ini_set(sendmail_from, $email);
  		$email_headers = "Content-type: text/html; charset=iso-8859-1\r\nFrom: ".$email;
		$result=mail( $emailTo, "Catering Order Online:".$subject, $confirmation, $email_headers );

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
					location.href="/catering/order_online_thankyou.php";
			</script>

		<?php } else {
			// if there were errors, display them.
			echo "<h4 class='error-msg sub-nav-left-col'  >There were errors in processing the order information.</h4>";

			echo "<p class='error-msg' > $response </p>";
		}
	}?>

	<!-- the $_SERVER['PHP_SELF'] in the action field always posts back to the same form. -->
	<form name="form1" id="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


	    <?php
	    		echo $confirmation;
	    ?>

	    <p>
			<strong>Our staff will contact you shortly to confirm your order.</strong>
		</p>
		<br />

		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/catering/order_online_3.php';" >
		<input type="submit" name="submit" value="submit order">
		<span class="left300 reg12">4 of 4</span>
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
