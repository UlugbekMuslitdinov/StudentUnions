<?php 
	// turn on sessions
	@session_start();
	require_once('includes/field_validation.inc.php');
	require_once('dining.inc');
	$page_options['page'] = 'Dining';
	$page_options['header_image'] = "/template/images/banners/13_Union_Holiday-Meal_web_banner.jpg";
	
	dining_start($page_options);
?>

<?php
 	//restore session variables.
 	
 	// 1st form
 	$firstName = strip_tags($_SESSION['firstName']);
	$lastName = strip_tags($_SESSION['lastName']);
	$fullName = strip_tags($_SESSION['fullName']);
	$area = strip_tags($_SESSION['area']);
	$prefix = strip_tags($_SESSION['prefix']);
	$phone = strip_tags($_SESSION['phone']);
	$phoneNumber = strip_tags($_SESSION['phoneNumber']);
	$email = strip_tags($_SESSION['email']);
			
 	// 2nd form
	$package = strip_tags($_SESSION['package']);
	$mainCourse = strip_tags($_SESSION['mainCourse']);
	$roastedTurkeyBoneInALaCarte = strip_tags($_SESSION['roastedTurkeyBoneInALaCarte']);
	$roastedTurkeyBonelessALaCarte = strip_tags($_SESSION['roastedTurkeyBonelessALaCarte']);	
	$honeyGlazedHamALaCarte = strip_tags($_SESSION['honeyGlazedHamALaCarte']);
	$potatoes = strip_tags($_SESSION['potatoes']);
	$mashedPotatoesWGravyALaCarte = strip_tags($_SESSION['mashedPotatoesWGravyALaCarte']);
	$candiedSweetPotatoesALaCarte = strip_tags($_SESSION['candiedSweetPotatoesALaCarte']);
	$mashedYamsWCranberriesALaCarte = strip_tags($_SESSION['mashedYamsWCranberriesALaCarte']);
	$stuffing = strip_tags($_SESSION['stuffing']);
	$appleCeleryStuffingALaCarte = strip_tags($_SESSION['appleCeleryStuffingALaCarte']);
	$sausageSageStuffingALaCarte = strip_tags($_SESSION['sausageSageStuffingALaCarte']);
	$cornbreadStuffingALaCarte = strip_tags($_SESSION['cornbreadStuffingALaCarte']);
	$vegetables = strip_tags($_SESSION['vegetables']);
	$greenBeanCasseroleALaCarte = strip_tags($_SESSION['greenBeanCasseroleALaCarte']);
	$greenBeansWRedPeppersALaCarte = strip_tags($_SESSION['greenBeansWRedPeppersALaCarte']);
	$butteredCornALaCarte = strip_tags($_SESSION['butteredCornALaCarte']);
	$glazedCarrotsALaCarte = strip_tags($_SESSION['glazedCarrotsALaCarte']);
	$vegetableMedleyALaCarte = strip_tags($_SESSION['vegetableMedleyALaCarte']);
	$relishes = strip_tags($_SESSION['relishes']);
	$cranberryRelishALaCarte = strip_tags($_SESSION['cranberryRelishALaCarte']);
	$orangeCranberrySauceWWalnutsALaCarte = strip_tags($_SESSION['orangeCranberrySauceWWalnutsALaCarte']);
	$breads = strip_tags($_SESSION['breads']);		
	$dinnerRollsALaCarte = strip_tags($_SESSION['dinnerRollsALaCarte']);
	$cornMuffinsALaCarte = strip_tags($_SESSION['cornMuffinsALaCarte']);
	$salads = strip_tags($_SESSION['salads']);
	$houseSaladALaCarte = strip_tags($_SESSION['houseSaladALaCarte']);
	$waldorfSaladALaCarte = strip_tags($_SESSION['waldorfSaladALaCarte']);
	$anasBroccoliSaladALaCarte = strip_tags($_SESSION['anasBroccoliSaladALaCarte']);
	$ambrosiaSaladALaCarte = strip_tags($_SESSION['ambrosiaSaladALaCarte']);
	$desserts = strip_tags($_SESSION['desserts']);
	$pumpkinPieALaCarte = strip_tags($_SESSION['pumpkinPieALaCarte']);
	$pumpkinLoafALaCarte = strip_tags($_SESSION['pumpkinLoafALaCarte']);
	$pecanPieALaCarte = strip_tags($_SESSION['pecanPieALaCarte']);
	$applePieALaCarte = strip_tags($_SESSION['applePieALaCarte']);
	$almondRingALaCarte = strip_tags($_SESSION['almondRingALaCarte']);
	$comment = strip_tags($_SESSION['comment']);
	$xcomment = strip_tags($_SESSION['xcomment']);
	
	$total_amount = strip_tags($_SESSION['total_amount']);
	$total_amount = number_format((float)$total_amount, 2, '.', '');
	
	$package1_amount =	strip_tags($_SESSION['package1_amount']);
	
	$package2_amount = 	strip_tags($_SESSION['package2_amount']); 
	
	$package3_amount = 	strip_tags($_SESSION['package3_amount']); 
	
	$mainCourse_amount = strip_tags($_SESSION['mainCourse_amount']);
	
	$potatoes_amount = strip_tags($_SESSION['potatoes_amount']);
	
	$stuffing_amount = strip_tags($_SESSION['stuffing_amount']);
	
	$vegetables_amount = strip_tags($_SESSION['vegetables_amount']);
	
	$relishes_amount =	strip_tags($_SESSION['relishes_amount']);
	
	$breads_amount = strip_tags($_SESSION['breads_amount']);
	
	$salads_amount = strip_tags($_SESSION['salads_amount']);
	
	$desserts_amount =	strip_tags($_SESSION['desserts_amount']);	
	
	// 3rd form
	$pickupTime = strip_tags($_SESSION['pickupTime']);	
	
	$heading = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd' >";
	$heading .= "<html><head></head><body style='font-family: Helvetica,Arial,sans-serif;'>";
	
	$footing = "</body></html>";
	
	$confirmation = "";
	
	// confirmation display and email
	
	$confirmation .= "<table style='width: 100%; max-width: 581px; margin-top: 0; margin-left: .25em;' cellpadding='0' cellspacing='1' border='0' >";
	
	$confirmation .= "<tr style='background-color: #7D7D7D;' class='hdr-img' >";
	$confirmation .= "<td><img src='http://union.arizona.edu/template/images/logos/13_Union_Holiday-Meal_UAlogo.png'  alt='Holiday Meals Email Banner' /></td>";
	$confirmation .= "</tr>";
	
	$confirmation .= "<tr class='hdr-img' >";
	$confirmation .= "<td><img src='http://union.arizona.edu/template/images/banners/13_Union_Holiday-Meal_email_banner.jpg' style='width: 100%;' alt='Holiday Meals Email Banner' /></td>";
	$confirmation .= "</tr>";
	
	$confirmation .= "<tr class='hdr-img' >";
	$confirmation .= "<td>&nbsp;</td>";
	$confirmation .= "</tr>";
	
	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	$confirmation .= "<h1>Order Summary</h1><br />";
	$confirmation .= "<p><b>Name: &nbsp;</b> $fullName</p>";
	$confirmation .= "<p><b>Phone: </b> $phoneNumber</p>";
	$confirmation .= "<p><b>Email: &nbsp;</b> <a href='mailto:$email' >$email</a></p>";
	$confirmation .= "</td>";
	$confirmation .= "</tr>";
	
	$confirmation .= "<tr>";
	$confirmation .= "<td>";
	
	$confirmation .= "<table style='width: 100%; max-width: 581px;' cellpadding='15' cellspacing='15' border='0' >";
	
	$confirmation .= "<tr>";
	$confirmation .= "<td><h2>Menu Item</h2></td><td><h2>Selection</h2></td><td><h2>Price</h2></td>";
	$confirmation .= "</tr>";
	
	// package
	$confirmation .= "<tr>";
	$confirmation .= "<td>Package: </td>";
	$confirmation .= "<td>$package</td>";
	if ($package == 1) {
		$confirmation .= "<td>Serves 6-8 people<br />  $$package1_amount + tax</td>";
	} else if ($package == 2) {
		$confirmation .= "<td>Serves 12-15 people<br /> $$package2_amount + tax</td>";
	} else if ($package == 3) {
		$confirmation .= "<td>Serves 15-20 people<br />  $$package3_amount + tax </td>";
	} else if ($package == 4) {
		$confirmation .= "<td>A la carte only<br /> Charge for each item + tax</td>";
	} else {
		$confirmation .= "<td>$0</td>";
	}
	$confirmation .= "</tr>";
	
	// main course
	if($mainCourse) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>Main Course</td>";
		if ($mainCourse == "roastedTurkeyBoneIn") {
			$confirmation .= "<td>Roasted Turkey Bone-In</td>";
		} else if ($mainCourse == "roastedTurkeyBoneless") {
			$confirmation .= "<td>Roasted Turkey Boneless</td>";
		} else if ($mainCourse == "honeyGlazedHam") {
			$confirmation .= "<td>Honey Glazed Ham</td>";
		} else {
			$confirmation .= "<td>No Selection</td>";
		}
		$confirmation .= "<td>&nbsp;</td>"; 
		$confirmation .= "</tr>";
	}
	
	if($roastedTurkeyBoneInALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Roasted Turkey Bone-In</td><td>$$mainCourse_amount</td>";
		$confirmation .= "</tr>";
	}
	if($roastedTurkeyBonelessALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Roasted Turkey Boneless</td><td>$$mainCourse_amount</td>";
		$confirmation .= "</tr>";
	}
	if($honeyGlazedHamALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Honey Glazed Ham</td><td>$$mainCourse_amount</td>";
		$confirmation .= "</tr>";
	}
	
	// potatoes
	if($potatoes) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>Potatoes</td>";
		if ($potatoes == "mashedPotatoesWGravy") {
			$confirmation .= "<td>Mashed Potatoes with Gravy</td>";
		} else if ($potatoes == "candiedSweetPotatoes") {
			$confirmation .= "<td>Candied Sweet Potatoes</td>";
		} else if ($potatoes == "mashedYamsWCranberries") {
			$confirmation .= "<td>Mashed Yams with Cranberries</td>";
		} else {
			$confirmation .= "<td>No Selection</td>";
		}
		$confirmation .= "<td>&nbsp;</td>"; 
		$confirmation .= "</tr>";
	}
	
	if($mashedPotatoesWGravyALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Mashed Potatoes with Gravy</td><td>$$potatoes_amount</td>";
		$confirmation .= "</tr>";
	}
	if($candiedSweetPotatoesALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Candied Sweet Potatoes</td><td>$$potatoes_amount</td>";
		$confirmation .= "</tr>";
	}
	if($mashedYamsWCranberriesALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Mashed Yams with Cranberries</td><td>$$potatoes_amount</td>";
		$confirmation .= "</tr>";
	}
	
	// stuffing
	if($stuffing) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>Stuffing</td>";
		if ($stuffing == "appleCeleryStuffing") {
			$confirmation .= "<td>Apple Celery Stuffing</td>";
		} else if ($stuffing == "sausageSageStuffing") {
			$confirmation .= "<td>Sausage Sage Stuffing</td>";
		} else if ($stuffing == "cornbreadStuffing") {
			$confirmation .= "<td>Cornbread Stuffing</td>";
		} else {
			$confirmation .= "<td>No Selection</td>";
		}
		$confirmation .= "<td>&nbsp;</td>"; 
		$confirmation .= "</tr>";
	}
	
	if($appleCeleryStuffingALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Apple Celery Stuffing</td><td>$$stuffing_amount </td>";
		$confirmation .= "</tr>";
	}
	if($sausageSageStuffingALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Sausage Sage Stuffing</td><td>$$stuffing_amount</td>";
		$confirmation .= "</tr>";
	}
	if($cornbreadStuffingALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Cornbread Stuffing</td><td>$$stuffing_amount</td>";
		$confirmation .= "</tr>";
	}
	
	// vegetables
	if($vegetables) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>Vegetables</td>";
		if ($vegetables == "greenBeanCasserole") {
			$confirmation .= "<td>Green Bean Casserole</td>";
		} else if ($vegetables == "greenBeansWRedPeppers") {
			$confirmation .= "<td>Green Beans with Red Peppers</td>";
		} else if ($vegetables == "butteredCorn") {
			$confirmation .= "<td>Buttered Corn</td>";
		} else if ($vegetables == "glazedCarrots") {
			$confirmation .= "<td>Glazed Carrots</td>";
		} else if ($vegetables == "vegetableMedley") {
			$confirmation .= "<td>Vegetable Medley</td>";
		} else {
			$confirmation .= "<td>No Selection</td>";
		}
		$confirmation .= "<td>&nbsp;</td>"; 
		$confirmation .= "</tr>";
	}
	
	if($greenBeanCasseroleALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Green Bean Casserole</td><td>$$vegetables_amount</td>";
		$confirmation .= "</tr>";
	}
	if($greenBeansWRedPeppersALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Green Beans with Red Peppers</td><td>$$vegetables_amount</td>";
		$confirmation .= "</tr>";
	}
	if($butteredCornALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Buttered Corn</td><td>$$vegetables_amount</td>";
		$confirmation .= "</tr>";
	}
	if($glazedCarrotsALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Glazed Carrots</td><td>$$vegetables_amount</td>";
		$confirmation .= "</tr>";
	}
	if($vegetableMedleyALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Vegetable Medley</td><td>$$vegetables_amount</td>";
		$confirmation .= "</tr>";
	}
	
	// relishes
	if($relishes) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>Relishes</td>";
		if ($relishes == "cranberryRelish") {
			$confirmation .= "<td>Cranberry Relish</td>";
		} else if ($relishes == "orangeCranberrySauceWWalnuts") {
			$confirmation .= "<td>Orange Cranberry Sauce with Walnuts</td>";
		} else {
			$confirmation .= "<td>No Selection</td>";
		}
		$confirmation .= "<td>&nbsp;</td>"; 
		$confirmation .= "</tr>";
	}
	
	if($cranberryRelishALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Cranberry Relish</td><td>$$relishes_amount</td>";
		$confirmation .= "</tr>";
	}
	if($orangeCranberrySauceWWalnutsALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Orange Cranberry Sauce with Walnuts</td><td>$$relishes_amount</td>";
		$confirmation .= "</tr>";
	}
	
	// breads
	if($breads) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>Breads</td>";
		if ($breads == "dinnerRolls") {
			$confirmation .= "<td>Dinner Rolls</td>";
		} else if ($breads == "cornMuffins") {
			$confirmation .= "<td>Corn Muffins</td>";
		} else {
			$confirmation .= "<td>No Selection</td>";
		}
		$confirmation .= "<td>&nbsp;</td>"; 
		$confirmation .= "</tr>";
	}
	
	if($dinnerRollsALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Dinner Rolls</td><td>$$breads_amount</td>";
		$confirmation .= "</tr>";
	}
	if($cornMuffinsALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Corn Muffins</td><td>$$breads_amount</td>";
		$confirmation .= "</tr>";
	}
	
	// salads
	if($salads) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>Salads</td>";
		if ($salads == "houseSalad") {
			$confirmation .= "<td>House Salad</td>";
		} else if ($salads == "waldorfSalad") {
			$confirmation .= "<td>Waldorf Salad</td>";
		} else if ($salads == "anasBroccoliSalad") {
			$confirmation .= "<td>Ana's Broccoli Salad</td>";
		} else if ($salads == "ambrosiaSalad") {
			$confirmation .= "<td>Ambrosia Salad</td>";
		} else {
			$confirmation .= "<td>No Selection</td>";
		}
		$confirmation .= "<td>&nbsp;</td>"; 
		$confirmation .= "</tr>";
	}
	
	if($houseSaladALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>House Salad</td><td>$$salads_amount</td>";
		$confirmation .= "</tr>";
	}
	if($waldorfSaladALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Waldorf Salad</td><td>$$salads_amount</td>";
		$confirmation .= "</tr>";
	}
	if($anasBroccoliSaladALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Ana's Broccoli Salad</td><td>$$salads_amount</td>";
		$confirmation .= "</tr>";
	}
	if($ambrosiaSaladALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Ambrosia Salad</td><td>$$salads_amount</td>";
		$confirmation .= "</tr>";
	}
	
	// desserts
	if($desserts) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>Desserts</td>";
		if ($desserts == "pumpkinPie") {
			$confirmation .= "<td>Pumpkin Pie</td>";
		} else if ($desserts == "pumpkinLoaf") {
			$confirmation .= "<td>Pumpkin Loaf</td>";
		} else if ($desserts == "pecanPie") {
			$confirmation .= "<td>Pecan Pie</td>";
		} else if ($desserts == "applePie") {
			$confirmation .= "<td>Apple Pie</td>";
		} else if ($desserts == "almondRing") {
			$confirmation .= "<td>Almond Ring</td>";
		} else {
			$confirmation .= "<td>No Selection</td>";
		}
		$confirmation .= "<td>&nbsp;</td>"; 
		$confirmation .= "</tr>";
	}
	
	if($pumpkinPieALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Pumpkin Pie</td><td>$$desserts_amount</td>";
		$confirmation .= "</tr>";
	}
	if($pumpkinLoafALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Pumpkin Loaf</td><td>$$desserts_amount</td>";
		$confirmation .= "</tr>";
	}
	if($pecanPieALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Pecan Pie</td><td>$$desserts_amount</td>";
		$confirmation .= "</tr>";
	}
	if($applePieALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Apple Pie</td><td>$$desserts_amount/ 100</td>";
		$confirmation .= "</tr>";
	}
	if($almondRingALaCarte) {
		$confirmation .= "<tr>";
		$confirmation .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;A La Carte</td><td>Almond Ring</td><td>$$desserts_amount</td>";
		$confirmation .= "</tr>";
	}
	 
	// total amount
	$confirmation .= "<tr>";
	$confirmation .= "<td><b>Total Amount: </b></td>";
	$confirmation .= "<td><b>(Not Including Tax)</b></td>";
	$confirmation .= "<td><b>$$total_amount</b></td>"; 
	$confirmation .= "</tr>";
	
	$confirmation .= "</table>";
	
	$confirmation .= "</td>";
	$confirmation .= "</tr>";
 	
 	if($comment) {
 		
		$confirmation .= "<tr>";
		$confirmation .= "<td>";
 		$confirmation .= "<p><b>Comments: &nbsp;</b><br /><br /> $comment</p>";
		$confirmation .= "</td>";
		$confirmation .= "</tr>";
 	}
 	
 	$confirmation .= "<tr>";
	$confirmation .= "<td>";
 	$confirmation .= "<p><b>Pick up your order on Monday, December 23, 2013, at The Arizona Room, in the SUMC, between: &nbsp;</b>";
 	if ($pickupTime == '1') {
 		$confirmation .= "9am - 10am</p>";
 	} else if ($pickupTime == '2') {
 		$confirmation .= "10am - 12pm</p>";
	} else if ($pickupTime == '3') {
 		$confirmation .= "12pm - 2pm</p>";
 	} else if ($pickupTime == '4') {
 		$confirmation .= "2pm - 4pm</p>";
	} else if ($pickupTime == '5') {
 		$confirmation .= "4pm - 6pm</p>";
 	} else {
 		$confirmation .= "4pm - 6pm</p>";
 	}
	$confirmation .= "</td>";
	$confirmation .= "</tr>";
		
 	$confirmation .= "<tr>";
	$confirmation .= "<td>";
 	$confirmation .= "<p><b>If you have any questions, contact <a href='mailto:bedillon@email.arizona.edu' >Brandi Dillon</a></b></p>";
	$confirmation .= "</td>";
	$confirmation .= "</tr>";
 	
  	$confirmation .= "</table>";
	
// has the form been submitted?
if (isset($_POST['submit'])) {
	
	// initialize the response variable
	$response = "";
	$confirmation = $heading.$confirmation.$footing;
	require_once('takehome_1_val.inc.php');
	require_once('takehome_2_val.inc.php');
	
	$result = 0;
	
	if ((!$response) && (!$xcomment))
	{
		$subject = "Order Summary";
		$header="from: $fullName <$email>";
		$emailTo = "bedillon@email.arizona.edu,$email";
		// $emailTo = "bphinney@email.arizona.edu,$email";
		if(substr(php_uname("s"),0,1)=="W"){//running on windows
		 	ini_set(SMTP,"smtpgate.email.arizona.edu");
		}
		
		ini_set(sendmail_from, $email); 
  		$email_headers = "Content-type: text/html; charset=iso-8859-1\r\nFrom: ".$email;
		$result=mail( $emailTo, "Holiday Meals: ".$subject, $confirmation, $email_headers );
		 
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
					location.href="/dining/takehome_thankyou.php";
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
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/dining/takehome_3.php';" >
		<input type="submit" name="submit" value="submit order">
		<span class="left300 reg12">4 of 4</span>
		<br /><br />
		
	</form>
	
	
</div>	
	
 
<?php 
	dining_finish();
?>