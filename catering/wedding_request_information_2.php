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

<link rel="StyleSheet" href="/template/catering.css" type="text/css" media="screen" /> 
<script type="text/javascript" src="/template/wedding_request_information_2.js" ></script>

<?php  
		
	// has the form been submitted?
	if (isset($_POST['submit']))
	{
		// remove any html tags from the input
		
		// event information
		$eventDate = strip_tags($_POST['eventDate']);
		$altDate = strip_tags($_POST['altDate']);
		$ceremonyTime = strip_tags($_POST['ceremonyTime']);
		$receptionTime = strip_tags($_POST['receptionTime']);
		$ceremonyLocation = strip_tags($_POST['ceremonyLocation']);
		$numAttend = strip_tags($_POST['numAttend']);
		$eventType = strip_tags($_POST['eventType']);
		$budget = strip_tags($_POST['budget']);
		$expectations = strip_tags($_POST['expectations']);
			
		// initialize the response variable
		$response = "";
			
		require_once('wedding_request_information_2_validate.inc.php');
		
		if(!$response)
		{
			// register session variables
			$_SESSION['eventDate'] = $eventDate;
			$_SESSION['altDate'] = $altDate;
			$_SESSION['ceremonyTime'] = $ceremonyTime;
			$_SESSION['receptionTime'] = $receptionTime;
			$_SESSION['ceremonyLocation'] = $ceremonyLocation;
			$_SESSION['numAttend'] = $numAttend;
			$_SESSION['eventType'] = $eventType;
			$_SESSION['budget'] = $budget;
			$_SESSION['expectations'] = $expectations;
			
			if (isset($_POST['eventType']))
			{
				unset($_POST['eventType']);
			}
		}
	}
	else
	{
		// if we are going backward through the screens, we restore the variables
		
		// event information
		if (!isset($_POST['eventDate']))
		{
			if (isset($_SESSION['eventDate']))
			{
				$eventDate = strip_tags($_SESSION['eventDate']);
				$_POST['eventDate'] = strip_tags($_SESSION['eventDate']);
			}
		}
		if (!isset($_POST['altDate']))
		{
			if (isset($_SESSION['altDate']))
			{
				$altDate = strip_tags($_SESSION['altDate']);
				$_POST['altDate'] = strip_tags($_SESSION['altDate']);
			}
		}
		if (!isset($_POST['ceremonyTime']))
		{
			if (isset($_SESSION['ceremonyTime']))
			{
				$ceremonyTime = strip_tags($_SESSION['ceremonyTime']);
				$_POST['ceremonyTime'] = strip_tags($_SESSION['ceremonyTime']);
			}
		}
		if (!isset($_POST['receptionTime']))
		{
			if (isset($_SESSION['receptionTime']))
			{
				$receptionTime = strip_tags($_SESSION['receptionTime']);
				$_POST['receptionTime'] = strip_tags($_SESSION['receptionTime']);
			}
		}
		if (!isset($_POST['ceremonyLocation']))
		{
			if (isset($_SESSION['ceremonyLocation']))
			{
				$ceremonyLocation = strip_tags($_SESSION['ceremonyLocation']);
				$_POST['ceremonyLocation'] = strip_tags($_SESSION['ceremonyLocation']);
			}
		}
		if (!isset($_POST['numAttend']))
		{
			if (isset($_SESSION['numAttend']))
			{
				$numAttend = strip_tags($_SESSION['numAttend']);
				$_POST['numAttend'] = strip_tags($_SESSION['numAttend']);
			}
		}
		if (!isset($_POST['eventType']))
		{
			if (isset($_SESSION['eventType']))
			{
				$eventType = strip_tags($_SESSION['eventType']);
				$_POST['eventType'] = strip_tags($_SESSION['eventType']);
			}
		}
		if (!isset($_POST['budget']))
		{
			if (isset($_SESSION['budget']))
			{
				$budget = strip_tags($_SESSION['budget']);
				$_POST['budget'] = strip_tags($_SESSION['budget']);
			}
		}
		if (!isset($_POST['expectations']))
		{
			if (isset($_SESSION['expectations']))
			{
				$expectations = strip_tags($_SESSION['expectations']);
				$_POST['expectations'] = strip_tags($_SESSION['expectations']);
			}
		}
		
	}
	
?>


	
<div id="center-col" >
	
	<?php 
	// if the submit button was clicked.
	if (isset($_POST['submit']))
	{
		// if there were no errors go to the next page.
		if(!$response)
	    { ?>
	    	
			<script type="text/javascript" >
					location.href="/catering/wedding_request_information_3.php";
			</script>

		<?php } else {
			// if there were errors, display them.
			echo "<h4 class='error-msg sub-nav-left-col'  >There were errors in processing the organization information.</h4><br />";
	
			echo "<p class='error-msg' > $response </p><br /><br />";
			
		}
	}?>
	
	<h2>Event Information:</h2> 
	
	<p class="top-minus50" >
		Thank you for considering Arizona Catering for your event. Please complete this online form and one of our 
		Catering Sales Managers will contact you with a proposal.
	</p>
	
	<p class="bottom1em">
		<span class="req" >*</span></label> Items marked with an asterisk are required.
	</p>
	 
	 
	
	<!-- the $_SERVER['PHP_SELF'] in the action field always posts back to the same form. -->
	<form class="top-minus10" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
		<p>
			<label>Event Date: <span class="req" >*</span><br /> (MM/DD/YYYY format)</label><br />
			<input class="datepicker right10" size="12" name="eventDate" id="eventDate" type='text' title="Event Date" value="<?php echo (isset($_POST['eventDate'])) ?  (($result) ? "" : $_POST['eventDate']) : ""; ?>" />		
		</p>		
		<p id="label1" class="top10 error-msg display-none" >Event Date cannot be less than today's Date.</p>
		<p id="label2" class="top10 error-msg display-none" >Event Date cannot be more than a year in the future.</p>
		
		<p>
			<label>Alternate Date: <span class="req" >*</span><br /> (MM/DD/YYYY format)</label><br />
			<input class="datepicker right10" size="12" name="altDate" id="altDate" type='text' title="Alternate Date" value="<?php echo (isset($_POST['altDate'])) ?  (($result) ? "" : $_POST['altDate']) : ""; ?>" />		
		</p>		
		<p id="label3" class="top10 error-msg display-none" >Alternate Date cannot be less than today's Date.</p>
		<p id="label4" class="top10 error-msg display-none" >Alternate Date cannot be more than a year in the future.</p>
		
		
		<p>
			<label>Ceremony Time: <span class="req" >*</span></label><br />
			<input name="ceremonyTime" type="text" id="ceremonyTime" title="From Time" maxlength="12" size="12" value="<?php echo (isset($_POST['ceremonyTime'])) ?  (($result) ? "" : $_POST['ceremonyTime']) : ""; ?>" >
		</p>
		
		<p>
			<label>Ceremony Location: <span class="req" >*</span></label><br />
			<input type="radio" name="ceremonyLocation" value="onCampus" <?php if(isset($_POST['ceremonyLocation'])) { if($_POST['ceremonyLocation'] == "onCampus") { echo "checked=\"checked\""; }} ?> > On Campus 
			<input class="left5" type="radio" name="ceremonyLocation" value="offCampus"  <?php if(isset($_POST['ceremonyLocation'])) { if($_POST['ceremonyLocation'] == "offCampus") { echo "checked=\"checked\""; }} ?> > Off Campus  
		</p>
		
		<p>
			<label>Reception Time: <span class="req" >* </span></label><br />
			<input name="receptionTime" type="text" id="receptionTime" title="To Time" maxlength="12" size="12"  value="<?php echo (isset($_POST['receptionTime'])) ?  (($result) ? "" : $_POST['receptionTime']) : ""; ?>" >
		</p>
		 
		<p>
			<label>Number of Guests: <span class="req" >*</span></label><br />
			<input name="numAttend" type="text" id="numAttend"  maxlength="5" size="5" value="<?php echo (isset($_POST['numAttend'])) ?  (($result) ? "" : $_POST['numAttend']) : ""; ?>" >
		</p>
		
		<p>Type of Reception:<br />
     	<select name="eventType" id="eventType" size="1" >
     		<option value="" >Not Selected</option>
			<option value="buffet" <?php if ($_POST['eventType'] == 'buffet') { echo 'selected="selected"'; } ?> >Buffet</option>
			<option value="stations" <?php if ($_POST['eventType'] == 'stations') { echo 'selected="selected"'; } ?> >Stations</option>
			<option value="reception" <?php if ($_POST['eventType'] == 'reception') { echo 'selected="selected"'; } ?> >Reception</option>
			<option value="platedDinner" <?php if ($_POST['eventType'] == 'platedDinner') { echo 'selected="selected"'; } ?> >Plated Dinner</option>
			<option value="other" <?php if ($_POST['eventType'] == 'other') { echo 'selected="selected"'; } ?> >Other</option>
		</select>
		</p>
		
		<p>
			<label>Food/Beverage Budget: <span class="req" >*</span></label><br />
			<input name="budget" type="text" id="budget" maxlength="25" size="25" value="<?php echo (isset($_POST['budget'])) ?  (($result) ? "" : $_POST['budget']) : ""; ?>" >
		</p>
		
		<!-- this textarea initially shows 50 columns and 2 rows, but it will grow if the user keeps typing. -->		
		<p>
		<label>Expectations: <span class="req" >*</span></label><br />
		<textarea name="expectations" cols="45" rows="2" id="expectations" maxlength="500" ><?php echo (isset($_POST['expectations'])) ? (($result) ? "" : $_POST['expectations']) : ""; ?></textarea>
		</p>	
		<br />
		
		
		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/catering/wedding_request_information_1.php';" >
		<input type="submit" name="submit" value="save and continue">
		<span class="left225 reg12">  2 of 3</span>
		<br /><br />
		
	</form>
	<br /><br /><br /><br />
</div>


<?php
require_once('catering_right_col.inc.php');
?>
</div>
		 
<div style="clear:both;">
	<br /><br />
</div>

<?php page_finish(); ?>