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
<script type="text/javascript" src="/template/catering_event_inquiry_2.js" ></script>

<?php 
		
	// has the form been submitted?
	if (isset($_POST['submit']))
	{
		// remove any html tags from the input
		
		// event information
		$eventDate = strip_tags($_POST['eventDate']);
		$startTime = strip_tags($_POST['startTime']);
		$endTime = strip_tags($_POST['endTime']);
		$numAttend = strip_tags($_POST['numAttend']);
		$eventType = strip_tags($_POST['eventType']);
		$foodService = strip_tags($_POST['foodService']);
		$setup = strip_tags($_POST['setup']);
		$comments = strip_tags($_POST['comments']);
			
		// initialize the response variable
		$response = "";
			
		require_once('catering_event_inquiry_2_validate.inc.php');
		
		if(!$response)
		{
			// register session variables
			$_SESSION['eventDate'] = $eventDate;
			$_SESSION['startTime'] = $startTime;
			$_SESSION['endTime'] = $endTime;
			$_SESSION['numAttend'] = $numAttend;
			$_SESSION['eventType'] = $eventType;
			$_SESSION['foodService'] = $foodService;
			$_SESSION['setup'] = $setup;
			$_SESSION['comments'] = $comments;
			
			if (isset($_POST['eventType']))
			{
				unset($_POST['eventType']);
			}
			if (isset($_POST['foodService']))
			{
				unset($_POST['foodService']);
			}
			if (isset($_POST['setup']))
			{
				unset($_POST['setup']);
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
		if (!isset($_POST['foodService']))
		{
			if (isset($_SESSION['foodService']))
			{
				$foodService = strip_tags($_SESSION['foodService']);
				$_POST['foodService'] = strip_tags($_SESSION['foodService']);
			}
		}
		if (!isset($_POST['setup']))
		{
			if (isset($_SESSION['setup']))
			{
				$setup = strip_tags($_SESSION['setup']);
				$_POST['setup'] = strip_tags($_SESSION['setup']);
			}
		}
		if (!isset($_POST['comments']))
		{
			if (isset($_SESSION['comments']))
			{
				$comments = strip_tags($_SESSION['comments']);
				$_POST['comments'] = strip_tags($_SESSION['comments']);
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
					location.href="/catering/catering_event_inquiry_3.php";
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
			<input class="datepicker right10" size="12" name="eventDate" id="eventDate" type='text' title="From Date" value="<?php echo (isset($_POST['eventDate'])) ?  (($result) ? "" : $_POST['eventDate']) : ""; ?>" />		
		</p>		
		<p id="label1" class="top10 error-msg display-none" >Date cannot be less than today's Date.</p>
		<p id="label2" class="top10 error-msg display-none" >Date cannot be more than a year in the future.</p>
		
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
			<label>Number of Guests: <span class="req" >*</span></label><br />
			<input name="numAttend" type="text" id="numAttend"  maxlength="5" size="5" value="<?php echo (isset($_POST['numAttend'])) ?  (($result) ? "" : $_POST['numAttend']) : ""; ?>" >
		</p>
		
		<p>Event Type:<br />
     	<select name="eventType" id="eventType" size="1" >
     		<option value="" >Not Selected</option>
			<option value="meeting" <?php if ($_POST['eventType'] == 'meeting') { echo 'selected="selected"'; } ?> >Meeting</option>
			<option value="banquet" <?php if ($_POST['eventType'] == 'banquet') { echo 'selected="selected"'; } ?> >Banquet</option>
			<option value="reception" <?php if ($_POST['eventType'] == 'reception') { echo 'selected="selected"'; } ?> >Reception</option>
			<option value="class" <?php if ($_POST['eventType'] == 'class') { echo 'selected="selected"'; } ?> >Class/Lecture</option>
			<option value="concert" <?php if ($_POST['eventType'] == 'concert') { echo 'selected="selected"'; } ?> >Concert</option>
			<option value="other" <?php if ($_POST['eventType'] == 'other') { echo 'selected="selected"'; } ?> >Other</option>
		</select>
		</p>
		
		<p>Food/Beverage Service:<br />
     	<select name="foodService" id="foodService" size="1" >
     		<option value="" >Not Selected</option>
			<option value="break" <?php if ($_POST['foodService'] == 'break') { echo 'selected="selected"'; } ?> >AM/PM Break</option>
			<option value="breakfast" <?php if ($_POST['foodService'] == 'breakfast') { echo 'selected="selected"'; } ?> >Breakfast</option>
			<option value="lunch" <?php if ($_POST['foodService'] == 'lunch') { echo 'selected="selected"'; } ?> >Lunch</option>
			<option value="dinner" <?php if ($_POST['foodService'] == 'dinner') { echo 'selected="selected"'; } ?> >Dinner</option>
			<option value="reception" <?php if ($_POST['foodService'] == 'reception') { echo 'selected="selected"'; } ?> >Reception</option>
			<option value="beverage" <?php if ($_POST['foodService'] == 'beverage') { echo 'selected="selected"'; } ?> >Beverage Service Only</option>
			<option value="none" <?php if ($_POST['foodService'] == 'none') { echo 'selected="selected"'; } ?> >No Food/Beverage Service Needed</option>
			<option value="other" <?php if ($_POST['foodService'] == 'other') { echo 'selected="selected"'; } ?> >Other</option>
		</select>
		</p>
		
		<p>Room Setup:<br />
     	<select name="setup" id="setup" size="1" >
     		<option value="" >Not Selected</option>
			<option value="classroom" <?php if ($_POST['setup'] == 'classroom') { echo 'selected="selected"'; } ?> >Classroom</option>
			<option value="theater" <?php if ($_POST['setup'] == 'theater') { echo 'selected="selected"'; } ?> >Theater</option>
			<option value="hollowsquare" <?php if ($_POST['setup'] == 'hollowsquare') { echo 'selected="selected"'; } ?> >Hollow Square</option>
			<option value="ushape" <?php if ($_POST['setup'] == 'ushape') { echo 'selected="selected"'; } ?> >UShape</option>
			<option value="rounds" <?php if ($_POST['setup'] == 'rounds') { echo 'selected="selected"'; } ?> >Rounds</option>
			<option value="conference" <?php if ($_POST['setup'] == 'conference') { echo 'selected="selected"'; } ?> >Conference</option>
			<option value="reception" <?php if ($_POST['setup'] == 'reception') { echo 'selected="selected"'; } ?> >Reception</option>
			<option value="other" <?php if ($_POST['setup'] == 'other') { echo 'selected="selected"'; } ?> >Other</option>
		</select>
		</p>
		
		<!-- this textarea initially shows 50 columns and 2 rows, but it will grow if the user keeps typing. -->		
		<p>
		<label>Comments: <span class="req" >*</span></label><br />
		<textarea name="comments" cols="45" rows="2" id="comments" maxlength="500" ><?php echo (isset($_POST['comments'])) ? (($result) ? "" : $_POST['comments']) : ""; ?></textarea>
		</p>	
		<br />
		
		
		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="button" id="previous" name="previous" value="previous" onclick="location.href='/catering/catering_event_inquiry_1.php';" >
		<input type="submit" name="submit" value="save and continue">
		<span class="left225 reg12">  2 of 3</span>
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