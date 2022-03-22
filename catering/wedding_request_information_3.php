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
	$address = strip_tags($_SESSION['address']);			
	$country = strip_tags($_SESSION['country']);			
	$city = strip_tags($_SESSION['city']);			
	$zip1 = strip_tags($_SESSION['zip1']);			
	$zip2 = strip_tags($_SESSION['zip2']);		
	$state = strip_tags($_SESSION['state']);		
	$zipcode = strip_tags($_SESSION['zipcode']);
	$area = strip_tags($_SESSION['area']);
	$prefix = strip_tags($_SESSION['prefix']);			
	$phone = strip_tags($_SESSION['phone']);
	$phoneNumber = strip_tags($_SESSION['phoneNumber']);	
	$brideName = strip_tags($_SESSION['brideName']);		
	$groomName = strip_tags($_SESSION['groomName']);		
	
			
 	// 2nd form
	$eventDate = strip_tags($_SESSION['eventDate']);
	$altDate = strip_tags($_SESSION['altDate']);
	$ceremonyTime = strip_tags($_SESSION['ceremonyTime']);
	$receptionTime = strip_tags($_SESSION['receptionTime']);
	$numAttend = strip_tags($_SESSION['numAttend']);
	$eventType = strip_tags($_SESSION['eventType']);		
	$ceremonyLocation = strip_tags($_SESSION['ceremonyLocation']);			
	$budget = strip_tags($_SESSION['budget']);			
	$expectations = strip_tags($_SESSION['expectations']);			
	 
	 
	$heading = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' >";
	$heading .= "<html><head></head><body style='font-family: Helvetica,Arial,sans-serif;'>";
	
	$footing = "</body></html>";
	
	$confirmation = "";
	
	// confirmation display and email
	
	$confirmation .= "<table style='width: 100%; max-width: 640px; margin-top: 0; margin-left: .25em;' cellpadding='0' cellspacing='1' border='0' >";
	
	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<h1>Wedding Request Information Summary</h1><br />";
	$confirmation .= "<br /><h2>Contact Information</h2>";
	$confirmation .= "<p><b>Name: &nbsp;</b> $fullName</p>";
	$confirmation .= "<p><b>Address: &nbsp;</b> $address</p>";
	$confirmation .= "<p><b>City: &nbsp;</b> $city</p>";
	$confirmation .= "<p><b>State/Province: &nbsp;</b> $state</p>";
	$confirmation .= "<p><b>Zipcode/Postal Code: &nbsp;</b> $zipcode</p>";
	$confirmation .= "<p><b>Country: &nbsp;</b> $country</p>";
	$confirmation .= "<p><b>Phone: </b> $phoneNumber</p>";
	$confirmation .= "<p><b>Email: </b><a href='mailto:$email' >$email</a></p><br />";
	$confirmation .= "<p><b>Bride's Name: </b> $brideName</p>";
	$confirmation .= "<p><b>Groom's Name: </b> $groomName</p>";
	$confirmation .= "</td>";
	$confirmation .= "</tr>";
	
	
	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<br /><h2>Event Information</h2>";
	$confirmation .= "<p><b>Event Date: </b> $eventDate</p>";
	$confirmation .= "<p><b>Alternate Date: </b> $altDate</p>";
	$confirmation .= "<p><b>Ceremony Time: </b> $ceremonyTime</p>";
	$confirmation .= "<p><b>Ceremony Location: </b> $ceremonyLocation</p>";
	$confirmation .= "<p><b>Reception Time: </b> $receptionTime</p>";
	$confirmation .= "<p><b>Number of Guests: </b> $numAttend</p>";
	$confirmation .= "<p><b>Event Type: </b> $eventType</p>";
	$confirmation .= "<p><b>Food/Beverage Budget: </b> $budget</p>";
	$confirmation .= "<p><b>Expectations: </b> $expectations</p>";
	$confirmation .= "</td>";
	$confirmation .= "</tr>";
	
  	$confirmation .= "</table>";
	
// has the form been submitted?
if (isset($_POST['submit'])) {
	
	// initialize the response variable
	$response = "";
	$confirmation = $heading.$confirmation.$footing;
	require_once('wedding_request_information_1_validate.inc.php');
	require_once('wedding_request_information_1_validate.inc.php');
	
	$result = 0;
	
	if ((!$response) && (!$xcomment))
	{
		$subject = "Summary";
		$header="from: $fullName <$email>";
		
		$emailTo = "cunninghaml@email.arizona.edu,$email";
		if(substr(php_uname("s"),0,1)=="W"){//running on windows
		 	ini_set(SMTP,"smtpgate.email.arizona.edu");
		}
		
		ini_set(sendmail_from, $email); 
  		$email_headers = "Content-type: text/html; charset=iso-8859-1\r\nFrom: ".$email;
		$result=mail( $emailTo, "Wedding Request Information: ".$subject, $confirmation, $email_headers );
		 
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
					location.href="/catering/wedding_request_information_thankyou.php";
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
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/catering/wedding_request_information_2.php';" >
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