<?php 
	// turn on sessions
	@session_start();
	require_once('includes/field_validation.inc.php');
	require_once('dining.inc');
	$page_options['page'] = 'Dining';
	$page_options['header_image'] = "/template/images/banners/13_Union_Holiday-Meal_web_banner.jpg";
	
	dining_start($page_options);
?>

<script type="text/javascript" src="/template/takehome_2.js"></script>

<?php
     

	
// has the form been submitted?
if (isset($_POST['submit'])) {
	// remove any html tags from the input

	// order information
	$pickupTime = strip_tags($_POST['pickupTime']);
	
	
	require_once('takehome_3_val.inc.php');
	
	if (!$response) {
		// register session variables
		$_SESSION['pickupTime'] = $pickupTime;
		
		
	}

} else {

	// if we are going backward through the screens, we restore the variables
 
	if (!isset($_POST['pickupTime'])) {
		if (isset($_SESSION['pickupTime'])) {
			$pickupTime = strip_tags($_SESSION['pickupTime']);
			$_POST['pickupTime'] = strip_tags($_SESSION['pickupTime']);
		}
	}
	
	
}
?>	


	<h1>Online Order Form</h1>
	
	<p>
		<strong>Orders must be picked up at The Arizona Room located in the SUMC,<br /> from 9am-6pm on Monday, December 23, 2013.</strong>
	</p>
	
	
	<?php 
	// if the submit button was clicked.
	if (isset($_POST['submit']))
	{
		// if there were no errors go to the next page.
		if(!$response)
	    { ?>
	    	
			<script type="text/javascript" >
					location.href="/dining/takehome_4.php";
			</script>

		<?php } else {
			// if there were errors, display them.
			echo "<h4 class='error-msg sub-nav-left-col'  >There were errors in processing the order information.</h4>";
	
			echo "<p class='error-msg' > $response </p>";
		}
	}?>
	
	<!-- the $_SERVER['PHP_SELF'] in the action field always posts back to the same form. -->
	<form name="form1" id="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
	<p>
		<b><strong>Select a Time</strong> to pick up your order: </b><span class="req" >*</span>  
		<ul style="list-style-type: none; margin-left: .5em; margin-top: -.5em; margin-bottom: 1em; line-height: 1.5em;">
			<li><input type="radio" name="pickupTime" value="1"  <?php if(isset($_POST['pickupTime'])) { if($_POST['pickupTime'] == "1") { echo "checked=\"checked\""; }} ?> > Pickup between  9am - 10am</li>
			<li><input type="radio" name="pickupTime" value="2"  <?php if(isset($_POST['pickupTime'])) { if($_POST['pickupTime'] == "2") { echo "checked=\"checked\""; }} ?> > Pickup between 10am - 12pm</li>
			<li><input type="radio" name="pickupTime" value="3"  <?php if(isset($_POST['pickupTime'])) { if($_POST['pickupTime'] == "3") { echo "checked=\"checked\""; }} ?> > Pickup between 12pm - 2pm</li>
			<li><input type="radio" name="pickupTime" value="4"  <?php if(isset($_POST['pickupTime'])) { if($_POST['pickupTime'] == "4") { echo "checked=\"checked\""; }} ?> > Pickup between  2pm - 4pm</li>
			<li><input type="radio" name="pickupTime" value="5"  <?php if(isset($_POST['pickupTime'])) { if($_POST['pickupTime'] == "5") { echo "checked=\"checked\""; }} ?> > Pickup between  4pm - 6pm</li>
		</ul>
	</p>
	 
	<br />
		
		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/dining/takehome_2.php';" >
		<input type="submit" name="submit" value="save and continue">
		<span class="left300 reg12">3 of 4</span>
		<br /><br />
		
	</form>
	
	
</div>	
	
 
<?php 
	dining_finish();
?>