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
<script type="text/javascript" src="/template/order_online_2.js" ></script>

<?php  
		
	// has the form been submitted?
	if (isset($_POST['submit']))
	{
		// remove any html tags from the input
		
		// event information
		$eventType = strip_tags($_POST['eventType']);
		$eventTitle = strip_tags($_POST['eventTitle']);
		$numAttend = strip_tags($_POST['numAttend']);
		$prevEvent = strip_tags($_POST['prevEvent']);
		$prevEventDate = strip_tags($_POST['prevEventDate']);
		$prevEventDesc = strip_tags($_POST['prevEventDesc']);	
		$fromDate = strip_tags($_POST['fromDate']);
		$toDate = strip_tags($_POST['toDate']);
		$altFromDate = strip_tags($_POST['fromDate']);
		$altToDate = strip_tags($_POST['toDate']);
		$startTime = strip_tags($_POST['startTime']);
		$endTime = strip_tags($_POST['endTime']);
		$eventDesc = strip_tags($_POST['eventDesc']);
		$account = strip_tags($_POST['account']);
			
		// initialize the response variable
		$response = "";
			
		require_once('order_online_2_validate.inc.php');
		
		if(!$response)
		{
			// register session variables
			$_SESSION['eventType'] = $eventType;
			$_SESSION['eventTitle'] = $eventTitle;
			$_SESSION['numAttend'] = $numAttend;
			$_SESSION['prevEvent'] = $prevEvent;
			$_SESSION['prevEventDate'] = $prevEventDate;
			$_SESSION['prevEventDesc'] = $prevEventDesc;
			$_SESSION['fromDate'] = $fromDate;
			$_SESSION['toDate'] = $toDate;
			$_SESSION['altFromDate'] = $altFromDate;
			$_SESSION['altToDate'] = $altToDate;
			$_SESSION['startTime'] = $startTime;
			$_SESSION['endTime'] = $endTime;
			$_SESSION['eventDesc'] = $eventDesc;
			$_SESSION['account'] = $account;
			
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
		if (!isset($_POST['eventType']))
		{
			if (isset($_SESSION['eventType']))
			{
				$eventType = strip_tags($_SESSION['eventType']);
				$_POST['eventType'] = strip_tags($_SESSION['eventType']);
			}
		}
		if (!isset($_POST['eventTitle']))
		{
			if (isset($_SESSION['eventTitle']))
			{
				$eventTitle = strip_tags($_SESSION['eventTitle']);
				$_POST['eventTitle'] = strip_tags($_SESSION['eventTitle']);
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
	    if (!isset($_POST['prevEvent']))
		{
			if (isset($_SESSION['prevEvent']))
			{
				$prevEvent = strip_tags($_SESSION['prevEvent']);
				$_POST['prevEvent'] = strip_tags($_SESSION['prevEvent']);
			}
		}
		if (!isset($_POST['prevEventDate']))
		{
			if (isset($_SESSION['prevEventDate']))
			{
				$prevEventDate = strip_tags($_SESSION['prevEventDate']);
				$_POST['prevEventDate'] = strip_tags($_SESSION['prevEventDate']);
			}
		}
		if (!isset($_POST['prevEventDesc']))
		{
			if (isset($_SESSION['prevEventDesc']))
			{
				$prevEventDesc = strip_tags($_SESSION['prevEventDesc']);
				$_POST['prevEventDesc'] = strip_tags($_SESSION['prevEventDesc']);
			}
		}
		if (!isset($_POST['fromDate']))
		{
			if (isset($_SESSION['fromDate']))
			{
				$fromDate = strip_tags($_SESSION['fromDate']);
				$_POST['fromDate'] = strip_tags($_SESSION['fromDate']);
			}
		}
		if (!isset($_POST['toDate']))
		{
			if (isset($_SESSION['toDate']))
			{
				$toDate = strip_tags($_SESSION['toDate']);
				$_POST['toDate'] = strip_tags($_SESSION['toDate']);
			}
		}
		if (!isset($_POST['altFromDate']))
		{
			if (isset($_SESSION['altFromDate']))
			{
				$altFromDate = strip_tags($_SESSION['altFromDate']);
				$_POST['altFromDate'] = strip_tags($_SESSION['altFromDate']);
			}
		}
		if (!isset($_POST['altToDate']))
		{
			if (isset($_SESSION['altToDate']))
			{
				$altToDate = strip_tags($_SESSION['altToDate']);
				$_POST['altToDate'] = strip_tags($_SESSION['altToDate']);
			}
		}
		if (!isset($_POST['startTime']))
		{
			if (isset($_SESSION['startTime']))
			{
				$startTime = strip_tags($_SESSION['startTime']);
				$_POST['startTime'] = strip_tags($_SESSION['startTime']);
			}
		}
		if (!isset($_POST['endTime']))
		{
			if (isset($_SESSION['endTime']))
			{
				$endTime = strip_tags($_SESSION['endTime']);
				$_POST['endTime'] = strip_tags($_SESSION['endTime']);
			}
		}
		if (!isset($_POST['eventDesc']))
		{
			if (isset($_SESSION['eventDesc']))
			{
				$eventDesc = strip_tags($_SESSION['eventDesc']);
				$_POST['eventDesc'] = strip_tags($_SESSION['eventDesc']);
			}
		}
		if (!isset($_POST['account'])) {
			if (isset($_SESSION['account'])) {
				$account = strip_tags($_SESSION['account']);
				$_POST['account'] = strip_tags($_SESSION['account']);
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
					location.href="/catering/order_online_3.php";
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
		
		
		<p>Event Type:<br />
     	<select name="eventType" id="eventType" size="1" >
     		<option value="" >Not Selected</option>
			<option value="seminar" <?php if ($_POST['eventType'] == 'seminar') { echo 'selected="selected"'; } ?> >Seminar</option>
			<option value="banquet" <?php if ($_POST['eventType'] == 'banquet') { echo 'selected="selected"'; } ?> >Banquet</option>
			<option value="conference" <?php if ($_POST['eventType'] == 'conference') { echo 'selected="selected"'; } ?> >Conference</option>
			<option value="wedding" <?php if ($_POST['eventType'] == 'wedding') { echo 'selected="selected"'; } ?> >Wedding</option>
			<option value="tradeShow" <?php if ($_POST['eventType'] == 'tradeShow') { echo 'selected="selected"'; } ?> >Trade Show</option>
			<option value="reception" <?php if ($_POST['eventType'] == 'reception') { echo 'selected="selected"'; } ?> >Reception</option>
			<option value="socialEvent" <?php if ($_POST['eventType'] == 'socialEvent') { echo 'selected="selected"'; } ?> >Social Event (Birthday, Bar/Bat Mitzvah, etc.)</option>
			<option value="other" <?php if ($_POST['eventType'] == 'other') { echo 'selected="selected"'; } ?> >Other</option>
		</select>
		</p>
		
		<p>
		<label>Event Name: <span class="req" >*</span></label><br />
		<input name="eventTitle" type="text" id="eventTitle" size="50" maxlength="50" value="<?php echo (isset($_POST['eventTitle'])) ?  (($result) ? "" : $_POST['eventTitle']) : ""; ?>" >
		</p>
		
		<p>
			<label>Number of Attendees: <span class="req" >*</span></label><br />
			<input name="numAttend" type="text" id="numAttend"  maxlength="5" size="5" value="<?php echo (isset($_POST['numAttend'])) ?  (($result) ? "" : $_POST['numAttend']) : ""; ?>" >
		</p>
		
		<!--
		<p>
			<label>Have you held an event with us before?: <span class="req" >*</span></label><br />
			<input type="radio" name="prevEvent" value="Yes" <?php if(isset($_POST['prevEvent'])) { if($_POST['prevEvent'] == "Yes") { echo "checked=\"checked\""; }} ?> > Yes 
			<input class="left5" type="radio" name="prevEvent" value="No"  <?php if(isset($_POST['prevEvent'])) { if($_POST['prevEvent'] == "No") { echo "checked=\"checked\""; }} ?> > No  
		</p>
		
		<div id="prevEventInfo" >
			<p>
				<label>Approximately when did this event occur: <span class="req" >*</span><br /> (MM/DD/YYYY format)</label><br />
				<input class="datepicker right10" size="12" name="prevEventDate" id="prevEventDate" type='text' title="Previous Event Date" value="<?php echo (isset($_POST['prevEventDate'])) ?  (($result) ? "" : $_POST['prevEventDate']) : ""; ?>" />
			</p>
			
			<!-- this textarea initially shows 50 columns and 2 rows, but it will grow if the user keeps typing. >		
			<p>
				<label>Please describe the vent you previously held with us: <span class="req" >*</span></label><br />
				<textarea name="prevEventDesc" cols="45" rows="2" id="prevEventDesc" maxlength="500" ><?php echo (isset($_POST['prevEventDesc'])) ? (($result) ? "" : $_POST['prevEventDesc']) : ""; ?></textarea>
			</p>	
		</div>
		-->
		
		<p>
			<label>Preferred Date(s) (from-to): <span class="req" >*</span><br /> (MM/DD/YYYY format)</label><br />
			<input class="datepicker right10" size="12" name="fromDate" id="fromDate" type='text' title="From Date" value="<?php echo (isset($_POST['fromDate'])) ?  (($result) ? "" : $_POST['fromDate']) : ""; ?>" />
     		- 
     		<input  size="12" name="toDate" id="toDate" class="datepicker" type='text' title="To Date" value="<?php echo (isset($_POST['toDate'])) ?  (($result) ? "" : $_POST['toDate']) : ""; ?>" />
			
		</p>
		<p id="label0" class="top10 error-msg display-none" >End Date cannot be less than Begin Date.</p>
		<p id="label1" class="top10 error-msg display-none" >Dates cannot be less than today's Date.</p>
		<p id="label2" class="top10 error-msg display-none" >Dates cannot be more than a year in the future.</p>
		
		<p>
			<label>Alternate Date(s) (from-to): <span class="req" >*</span><br /> (MM/DD/YYYY format)</label><br />
			<input class="datepicker right10" size="12" name="altFromDate" id="altFromDate" type='text' title="Alternate From Date" value="<?php echo (isset($_POST['altFromDate'])) ?  (($result) ? "" : $_POST['altFromDate']) : ""; ?>" />
     		- 
     		<input  size="12" name="altToDate" id="altToDate" class="datepicker" type='text' title="Alternate To Date" value="<?php echo (isset($_POST['altToDate'])) ?  (($result) ? "" : $_POST['altToDate']) : ""; ?>" />
			
		</p>
		<p id="label3" class="top10 error-msg display-none" >End Date cannot be less than Begin Date.</p>
		<p id="label4" class="top10 error-msg display-none" >Dates cannot be less than today's Date.</p>
		<p id="label5" class="top10 error-msg display-none" >Dates cannot be more than a year in the future.</p>
		
		<table class="infotbl" style="width: 450px;" >
			</tr>
				<td  class="top20" style="width: 450px;" ><label>Start Time: <span class="req" >* </span> <span class="left30" > End Time:</span><span class="req" >*</span></label></label></td>
			</tr>
			<tr>
				<td class="w215">
					<input name="startTime" type="text" id="startTime" title="From Time" maxlength="12" size="12" value="<?php echo (isset($_POST['startTime'])) ?  (($result) ? "" : $_POST['startTime']) : ""; ?>" >
					-
					<input name="endTime" type="text" id="endTime" title="To Time" maxlength="12" size="12" value="<?php echo (isset($_POST['endTime'])) ?  (($result) ? "" : $_POST['endTime']) : ""; ?>" >
				</td>
			</tr>
		</table>
		
		<p>
		<label>Account Number: <span class="req" >*</span></label><br />
		<input name="account" type="text" id="email" size="50" maxlength="50" value="<?php echo (isset($_POST['account'])) ?  (($result) ? "" : $_POST['account']) : ""; ?>" >
		</p>
		
		<!-- this textarea initially shows 50 columns and 2 rows, but it will grow if the user keeps typing. -->		
		<p>
		<label>Additional Information: <span class="req" >*</span></label><br />
		<textarea name="eventDesc" cols="45" rows="2" id="eventDesc" maxlength="500" ><?php echo (isset($_POST['eventDesc'])) ? (($result) ? "" : $_POST['eventDesc']) : ""; ?></textarea>
		</p>	
		<br />
		
		
		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/catering/order_online_1.php';" >
		<input type="submit" name="submit" value="save and continue">
		<span class="left225 reg12">  2 of 4</span>
		<br /><br />
		
	</form>
	<br /><br />
</div>


<?php
require_once('catering_right_col.inc.php');
?>
</div>
		 
<div style="clear:both;">
	<br /><br />
</div>

<?php page_finish(); ?>