<?php 

// override session timeout to give them one full hour
ini_set("session.gc_maxlifetime", 3600);

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
<script type="text/javascript" src="/template/contact_us.js" ></script>


<?php  
	
	
	// has the form been submitted?
	if (isset($_POST['submit']))
	{
		// remove any html tags from the input
		$firstName = strip_tags($_POST['firstName']);
		$lastName = strip_tags($_POST['lastName']);
		$email = strip_tags($_POST['email']);
		$affiliation = strip_tags($_POST['affiliation']);
		$other = strip_tags($_POST['other']);
		
		// organization information
		$orgName = strip_tags($_POST['orgName']);
		$orgAddress = strip_tags($_POST['orgAddress']);
		$orgCity = strip_tags($_POST['orgCity']);
		$orgCountry = strip_tags($_POST['country']);
		$orgState = strip_tags($_POST['state']);
		$orgProvince = strip_tags($_POST['orgProvince']);
		$orgZip1 = strip_tags($_POST['orgZip1']);
		$orgZip2 = strip_tags($_POST['orgZip2']);
		$orgPostalCode = strip_tags($_POST['orgPostalCode']);
		$orgArea = strip_tags($_POST['orgArea']);
		$orgPrefix = strip_tags($_POST['orgPrefix']);
		$orgPhone = strip_tags($_POST['orgPhone']);
		
		
		// initialize the response variable
		$response = "";
		
		require_once('order_online_1_validate.inc.php');
		
		if(!$response)
		{
			// register session variables
			$_SESSION['firstName'] = $firstName;
			$_SESSION['lastName'] = $lastName;
			$_SESSION['fullName'] = $fullName;
			$_SESSION['affiliation'] = $affiliation;
			$_SESSION['other'] = $other;
			$_SESSION['email'] = $email;
			$_SESSION['orgName'] = $orgName;
			$_SESSION['orgAddress'] = $orgAddress;
			$_SESSION['orgCountry'] = $orgCountry;
			$_SESSION['orgCity'] = $orgCity;
			$_SESSION['orgZip1'] = $orgZip1;
			$_SESSION['orgZip2'] = $orgZip2;
			
			if ($orgCountry == "United States")
			{
				$_SESSION['orgState'] = $orgState;
				$_SESSION['orgZipcode'] = $orgZipcode;
			}
			else 
			{
				$_SESSION['orgState'] = $orgProvince;
				$_SESSION['orgZipcode'] = $orgPostalCode;
			}
			
			$_SESSION['orgArea'] = $orgArea;
			$_SESSION['orgPrefix'] = $orgPrefix;
			$_SESSION['orgPhone'] = $orgPhone;
			$_SESSION['orgPhoneNumber'] = $orgPhoneNumber;
			
			if (isset($_POST['state']))
			{
				unset($_POST['state']);
			}
			if (isset($_POST['country']))
			{
				unset($_POST['country']);
			}
		}
		
	}
	else
	{
		// if we are going backward through the screens, we restore the variables
		
		// organization information
		if (!isset($_POST['orgName']))
		{
			if (isset($_SESSION['orgName']))
			{
				$orgName = strip_tags($_SESSION['orgName']);
				$_POST['orgName'] = strip_tags($_SESSION['orgName']);
			}
		}
		if (!isset($_POST['orgAddress']))
		{
			if (isset($_SESSION['orgAddress']))
			{
				$orgAddress = strip_tags($_SESSION['orgAddress']);
				$_POST['orgAddress'] = strip_tags($_SESSION['orgAddress']);
			}
		}
		if (!isset($_POST['orgCity']))
		{
			if (isset($_SESSION['orgCity']))
			{
				$orgCity = strip_tags($_SESSION['orgCity']);
				$_POST['orgCity'] = strip_tags($_SESSION['orgCity']);
			}
		}
		if (!isset($_POST['orgCountry']))
		{
			if (isset($_SESSION['orgCountry']))
			{
				$orgCountry = strip_tags($_SESSION['orgCountry']);
				$_POST['country'] = strip_tags($_SESSION['orgCountry']);
			}
		}
		if (!isset($_POST['orgState']))
		{
			if (isset($_SESSION['orgState']))
			{
				$orgState = strip_tags($_SESSION['orgState']);
				$_POST['state'] = strip_tags($_SESSION['orgState']);
				$orgProvince = strip_tags($_SESSION['orgState']);
				$_POST['orgProvince'] = strip_tags($_SESSION['orgState']);
			}
		}
		if (!isset($_POST['orgZip1']))
		{
			if (isset($_SESSION['orgZip1']))
			{
				$orgZip1 = strip_tags($_SESSION['orgZip1']);
				$_POST['orgZip1'] = strip_tags($_SESSION['orgZip1']);
			}
		}
		if (!isset($_POST['orgZip2']))
		{
			if (isset($_SESSION['orgZip2']))
			{
				$orgZip2 = strip_tags($_SESSION['orgZip2']);
				$_POST['orgZip2'] = strip_tags($_SESSION['orgZip2']);
			}
		}
		if (!isset($_POST['orgZipcode']))
		{
			if (isset($_SESSION['orgZipcode']))
			{
				$orgZipcode = strip_tags($_SESSION['orgZipcode']);
				$_POST['orgZipcode'] = strip_tags($_SESSION['orgZipcode']);
				$orgPostalCode = strip_tags($_SESSION['orgZipcode']);
				$_POST['orgPostalCode'] = strip_tags($_SESSION['orgZipcode']);
			}
		}
		if (!isset($_POST['orgArea']))
		{
			if (isset($_SESSION['orgArea']))
			{
				$orgArea = strip_tags($_SESSION['orgArea']);
				$_POST['orgArea'] = strip_tags($_SESSION['orgArea']);
			}
		}
		if (!isset($_POST['orgPrefix']))
		{
			if (isset($_SESSION['orgPrefix']))
			{
				$orgPrefix = strip_tags($_SESSION['orgPrefix']);
				$_POST['orgPrefix'] = strip_tags($_SESSION['orgPrefix']);
			}
		}
		if (!isset($_POST['orgPhone']))
		{
			if (isset($_SESSION['orgPhone']))
			{
				$orgPhone = strip_tags($_SESSION['orgPhone']);
				$_POST['orgPhone'] = strip_tags($_SESSION['orgPhone']);
			}
		}
		
		if (!isset($_POST['orgPhoneNumber']))
		{
			if (isset($_SESSION['orgPhoneNumber']))
			{
				$orgPhoneNumber = strip_tags($_SESSION['orgPhoneNumber']);
				$_POST['orgPhoneNumber'] = strip_tags($_SESSION['orgPhoneNumber']);
			}
		}
		
		if (!isset($_POST['firstName'])) {
			if (isset($_SESSION['firstName'])) {
				$firstName = strip_tags($_SESSION['firstName']);
				$_POST['firstName'] = strip_tags($_SESSION['firstName']);
			}
		}
		
		if (!isset($_POST['lastName'])) {
			if (isset($_SESSION['lastName'])) {
				$lastName = strip_tags($_SESSION['lastName']);
				$_POST['lastName'] = strip_tags($_SESSION['lastName']);
			}
		}
		
		if (!isset($_POST['fullName'])) {
			if (isset($_SESSION['fullName'])) {
				$fullName = strip_tags($_SESSION['fullName']);
				$_POST['fullName'] = strip_tags($_SESSION['fullName']);
			}
		}
		
		if (!isset($_POST['email'])) {
			if (isset($_SESSION['email'])) {
				$email = strip_tags($_SESSION['email']);
				$_POST['email'] = strip_tags($_SESSION['email']);
			}
		}
		
		if (!isset($_POST['affiliation'])) {
			if (isset($_SESSION['affiliation'])) {
				$affiliation = strip_tags($_SESSION['affiliation']);
				$_POST['affiliation'] = strip_tags($_SESSION['affiliation']);
			}
		}
		
		if (!isset($_POST['other'])) {
			if (isset($_SESSION['other'])) {
				$other = strip_tags($_SESSION['other']);
				$_POST['other'] = strip_tags($_SESSION['other']);
			}
		}
	}
	
?>
<script type="text/javascript" src="/template/order_online_1.js" ></script>

	
<div id="center-col" >
	
	<?php 
	// if the submit button was clicked.
	if (isset($_POST['submit']))
	{
		// if there were no errors go to the next page.
		if(!$response)
	    { ?>
	    	
			<script type="text/javascript" >
					location.href="/catering/order_online_2.php";
			</script>

		<?php } else {
			// if there were errors, display them.
			echo "<h4 class='error-msg sub-nav-left-col'  >There were errors in processing the organization information.</h4><br />";
	
			echo "<p class='error-msg' > $response </p><br /><br />";
			
		}
	}?>
	
	<h2>Contact Information:</h2> 
	
	<p class="top-minus50" >
		Thank you for considering Arizona Catering for your event. Please complete this online form and one of our 
		Event Coordinators will contact you with a proposal.
	</p>
	
	<p class="bottom1em">
		<span class="req" >*</span></label> Items marked with an asterisk are required.
	</p>
	 
	 
	
	<!-- the $_SERVER['PHP_SELF'] in the action field always posts back to the same form. -->
	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
		<p>
			<label>First Name: <span class="req" >*</span></label>
			<br />
			<input name="firstName" type="text" id="firstName" size="50" maxlength="50" value="<?php echo (isset($_POST['firstName'])) ?  (($result) ? "" : $_POST['firstName']) : ""; ?>" >
		</p>

		<p>
			<label>Last Name: <span class="req" >*</span></label>
			<br />
			<input name="lastName" type="text" id="lastName" size="50" maxlength="50" value="<?php echo (isset($_POST['lastName'])) ?  (($result) ? "" : $_POST['lastName']) : ""; ?>" >
		</p>
		
		<p>
		<label>Department or Organization/Company: <span class="req" >*</span></label><br />
		<input name="orgName" type="text" id="orgName" size="50" maxlength="50" value="<?php echo (isset($_POST['orgName'])) ?  (($result) ? "" : $_POST['orgName']) : ""; ?>" >
		</p>
		
		<p>Department or Organization Type:<br />
     	<select name="affiliation" id="affiliation" size="1" >
     		<option value="" >Not Selected</option>
			<option value="univDept" <?php if ($_POST['affiliation'] == 'univDept') { echo 'selected="selected"'; } ?> >University Department</option>
			<option value="thirdParty" <?php if ($_POST['affiliation'] == 'thirdParty') { echo 'selected="selected"'; } ?> >Third Party Planner</option>
			<option value="assn" <?php if ($_POST['affiliation'] == 'assn') { echo 'selected="selected"'; } ?> >Association</option>
			<option value="corp" <?php if ($_POST['affiliation'] == 'corp') { echo 'selected="selected"'; } ?> >Corporation</option>
			<option value="other" <?php if ($_POST['affiliation'] == 'other') { echo 'selected="selected"'; } ?> >Other</option>
		</select>
		</p>
		
		<p id ="otherPara">
		<label>If "Other," Please Specify: <span class="req" >*</span></label><br />	
		<input name="other" type="text" id="other" size="50" maxlength="50" value="<?php echo (isset($_POST['other'])) ?  (($result) ? "" : $_POST['other']) : ""; ?>" >
		</p>
		
		<p>
		<label>Address: <span class="req" >*</span></label><br />	
		<input name="orgAddress" type="text" id="orgAddress" size="50" maxlength="50" value="<?php echo (isset($_POST['orgAddress'])) ?  (($result) ? "" : $_POST['orgAddress']) : ""; ?>" >
		</p>
		
		<table class="infotbl" >
			<tr>
				<td class="w215" >
					<label>City: <span class="req" >*</span></label>
				</td>
			</tr>
			<tr>
				<td class="w205" >
					<input  name="orgCity" type="text" id="orgCity" size="27" maxlength="30" value="<?php echo (isset($_POST['orgCity'])) ?  (($result) ? "" : $_POST['orgCity']) : ""; ?>" >
				</td>
			</tr>
		</table>
		 
		
		<table class="infotbl"  >
			<tr>
				<td>
					<label>Country: <span class="req" >*</span></label>	
				</td>
				<td style="padding-left: 1em;">
					<label>State/Province: <span class="req" >*</span></label>
				</td>
			</tr>
			<tr>
				<td class="country_select"  >
					<?php
						require_once('countries.inc.php');
					?>
				</td>
				<td style="padding-left: 1em;">
					<?php
						require_once('us_states.inc.php');
					?>
					<input name="orgProvince" type="text" id="orgProvince" maxlength="20" size="20" style="display: none;" value="<?php echo (isset($_POST['orgProvince'])) ?  (($result) ? "" : $_POST['orgProvince']) : ""; ?>" >
				</td>
			</tr>
		</table>
		 
		
		<table class="infotbl" style="" >
			<tr>
			<td class="w215" >
				<label>Zipcode/Postal Code: <span class="req" >*</span></label>
			</td>
			<td style="padding-left: 1em;">
				<label>Phone: <span class="req" >*</span></label>
			</td>
			</tr>
			<tr >
				<td class="w215" >
					<div id="orgZip" >
						<input name="orgZip1" type="text" id="orgZip1"  maxlength="5" size="5" onkeyup="moveOnMax(this,'orgZip1')" value="<?php echo (isset($_POST['orgZip1'])) ?  (($result) ? "" : $_POST['orgZip1']) : ""; ?>" >
					 	- 
						<input name="orgZip2" type="text" id="orgZip2"   maxlength="4" size="4" onkeyup="moveOnMax(this,'orgArea')" value="<?php echo (isset($_POST['orgZip2'])) ?  (($result) ? "" : $_POST['orgZip2']) : ""; ?>" >
					</div>
					<input name="orgPostalCode" type="text" id="orgPostalCode" maxlength="10" size="10" style="display: none;" value="<?php echo (isset($_POST['orgPostalCode'])) ?  (($result) ? "" : $_POST['orgPostalCode']) : ""; ?>" >
				</td>
				<td style="padding-left: 1em;">
					<input name="orgArea" type="text" id="orgArea" onkeyup="moveOnMax(this,'orgPrefix')"  maxlength="3" size="3" value="<?php echo (isset($_POST['orgArea'])) ?  (($result) ? "" : $_POST['orgArea']) : ""; ?>" >
					 - 
					<input name="orgPrefix" type="text" id="orgPrefix"  maxlength="3" size="3" onkeyup="moveOnMax(this,'orgPhone')" value="<?php echo (isset($_POST['orgPrefix'])) ?  (($result) ? "" : $_POST['orgPrefix']) : ""; ?>" >
					 - 
					<input name="orgPhone" type="text" id="orgPhone"  maxlength="4" size="4" onkeyup="moveOnMax(this,'email')" value="<?php echo (isset($_POST['orgPhone'])) ?  (($result) ? "" : $_POST['orgPhone']) : ""; ?>" >
				</td>
			</tr>
		</table>
		
		<p>
		<label>Email: <span class="req" >*</span></label><br />
		<input name="email" type="text" id="email" size="50" maxlength="50" value="<?php echo (isset($_POST['email'])) ?  (($result) ? "" : $_POST['email']) : ""; ?>" >
		</p>
		
		
			
		<br />
		
		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="submit" name="submit" value="save and continue">
		<span class="left300 reg12">  1 of 4</span>
		<br /><br />
		
	</form>
	
</div>


<?php
require_once('catering_right_col.inc.php');
?>
</div>
		 
<div style="clear:both;">
	<br /><br />
</div>

<?php page_finish(); ?>