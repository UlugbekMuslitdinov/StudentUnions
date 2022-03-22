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

<?php  
	
	
	// has the form been submitted?
	if (isset($_POST['submit']))
	{
		// remove any html tags from the input
		$firstName = strip_tags($_POST['firstName']);
		$lastName = strip_tags($_POST['lastName']);
		$email = strip_tags($_POST['email']);
		$address = strip_tags($_POST['address']);
		$city = strip_tags($_POST['city']);
		$country = strip_tags($_POST['country']);
		$state = strip_tags($_POST['state']);
		$province = strip_tags($_POST['province']);
		$zip1 = strip_tags($_POST['zip1']);
		$zip2 = strip_tags($_POST['zip2']);
		$postalCode = strip_tags($_POST['postalCode']);
		$area = strip_tags($_POST['area']);
		$prefix = strip_tags($_POST['prefix']);
		$phone = strip_tags($_POST['phone']);
		$brideName = strip_tags($_POST['brideName']);
		$groomName = strip_tags($_POST['groomName']);
		
		
		// initialize the response variable
		$response = "";
		
		require_once('wedding_request_information_1_validate.inc.php');
		
		if(!$response)
		{
			// register session variables
			$_SESSION['firstName'] = $firstName;
			$_SESSION['lastName'] = $lastName;
			$_SESSION['fullName'] = $fullName;
			$_SESSION['email'] = $email;
			$_SESSION['address'] = $address;
			$_SESSION['country'] = $country;
			$_SESSION['city'] = $city;
			$_SESSION['zip1'] = $zip1;
			$_SESSION['zip2'] = $zip2;
			
			if ($country == "United States")
			{
				$_SESSION['state'] = $state;
				$_SESSION['zipcode'] = $zipcode;
			}
			else 
			{
				$_SESSION['state'] = $province;
				$_SESSION['zipcode'] = $postalCode;
			}
			
			$_SESSION['area'] = $area;
			$_SESSION['prefix'] = $prefix;
			$_SESSION['phone'] = $phone;
			$_SESSION['phoneNumber'] = $phoneNumber;
			
			$_SESSION['brideName'] = $brideName;
			$_SESSION['groomName'] = $groomName;
			
			
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
		if (!isset($_POST['address']))
		{
			if (isset($_SESSION['address']))
			{
				$address = strip_tags($_SESSION['address']);
				$_POST['address'] = strip_tags($_SESSION['address']);
			}
		}
		if (!isset($_POST['city']))
		{
			if (isset($_SESSION['city']))
			{
				$city = strip_tags($_SESSION['city']);
				$_POST['city'] = strip_tags($_SESSION['city']);
			}
		}
		if (!isset($_POST['country']))
		{
			if (isset($_SESSION['country']))
			{
				$country = strip_tags($_SESSION['country']);
				$_POST['country'] = strip_tags($_SESSION['country']);
			}
		}
		if (!isset($_POST['state']))
		{
			if (isset($_SESSION['state']))
			{
				$state = strip_tags($_SESSION['state']);
				$_POST['state'] = strip_tags($_SESSION['state']);
				$province = strip_tags($_SESSION['state']);
				$_POST['province'] = strip_tags($_SESSION['state']);
			}
		}
		if (!isset($_POST['zip1']))
		{
			if (isset($_SESSION['zip1']))
			{
				$zip1 = strip_tags($_SESSION['zip1']);
				$_POST['zip1'] = strip_tags($_SESSION['zip1']);
			}
		}
		if (!isset($_POST['zip2']))
		{
			if (isset($_SESSION['zip2']))
			{
				$zip2 = strip_tags($_SESSION['zip2']);
				$_POST['zip2'] = strip_tags($_SESSION['zip2']);
			}
		}
		if (!isset($_POST['zipcode']))
		{
			if (isset($_SESSION['zipcode']))
			{
				$zipcode = strip_tags($_SESSION['zipcode']);
				$_POST['zipcode'] = strip_tags($_SESSION['zipcode']);
				$postalCode = strip_tags($_SESSION['zipcode']);
				$_POST['postalCode'] = strip_tags($_SESSION['zipcode']);
			}
		}
		if (!isset($_POST['area']))
		{
			if (isset($_SESSION['area']))
			{
				$area = strip_tags($_SESSION['area']);
				$_POST['area'] = strip_tags($_SESSION['area']);
			}
		}
		if (!isset($_POST['prefix']))
		{
			if (isset($_SESSION['prefix']))
			{
				$prefix = strip_tags($_SESSION['prefix']);
				$_POST['prefix'] = strip_tags($_SESSION['prefix']);
			}
		}
		if (!isset($_POST['phone']))
		{
			if (isset($_SESSION['phone']))
			{
				$phone = strip_tags($_SESSION['phone']);
				$_POST['phone'] = strip_tags($_SESSION['phone']);
			}
		}
		
		if (!isset($_POST['phoneNumber']))
		{
			if (isset($_SESSION['phoneNumber']))
			{
				$phoneNumber = strip_tags($_SESSION['phoneNumber']);
				$_POST['phoneNumber'] = strip_tags($_SESSION['phoneNumber']);
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
		if (!isset($_POST['brideName'])) {
			if (isset($_SESSION['brideName'])) {
				$brideName = strip_tags($_SESSION['brideName']);
				$_POST['brideName'] = strip_tags($_SESSION['brideName']);
			}
		}
		if (!isset($_POST['groomName'])) {
			if (isset($_SESSION['groomName'])) {
				$groomName = strip_tags($_SESSION['groomName']);
				$_POST['groomName'] = strip_tags($_SESSION['groomName']);
			}
		} 
	}
	
?>
<script type="text/javascript" src="/template/wedding_request_information_1.js" ></script>

	
<div id="center-col" >
	
	<?php 
	// if the submit button was clicked.
	if (isset($_POST['submit']))
	{
		// if there were no errors go to the next page.
		if(!$response)
	    { ?>
	    	
			<script type="text/javascript" >
					location.href="/catering/wedding_request_information_2.php";
			</script>

		<?php } else {
			// if there were errors, display them.
			echo "<h4 class='error-msg sub-nav-left-col'  >There were errors in processing the contact information.</h4><br />";
	
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
		<label>Address: <span class="req" >*</span></label><br />	
		<input name="address" type="text" id="address" size="50" maxlength="50" value="<?php echo (isset($_POST['address'])) ?  (($result) ? "" : $_POST['address']) : ""; ?>" >
		</p>
		
		<table class="infotbl" >
			<tr>
				<td class="w215" >
					<label>City: <span class="req" >*</span></label>
				</td>
			</tr>
			<tr>
				<td class="w205" >
					<input  name="city" type="text" id="city" size="27" maxlength="30" value="<?php echo (isset($_POST['city'])) ?  (($result) ? "" : $_POST['city']) : ""; ?>" >
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
					<input name="province" type="text" id="province" maxlength="20" size="20" style="display: none;" value="<?php echo (isset($_POST['province'])) ?  (($result) ? "" : $_POST['province']) : ""; ?>" >
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
					<div id="zip" >
						<input name="zip1" type="text" id="zip1"  maxlength="5" size="5" onkeyup="moveOnMax(this,'zip1')" value="<?php echo (isset($_POST['zip1'])) ?  (($result) ? "" : $_POST['zip1']) : ""; ?>" >
					 	- 
						<input name="zip2" type="text" id="zip2"   maxlength="4" size="4" onkeyup="moveOnMax(this,'area')" value="<?php echo (isset($_POST['zip2'])) ?  (($result) ? "" : $_POST['zip2']) : ""; ?>" >
					</div>
					<input name="postalCode" type="text" id="postalCode" maxlength="10" size="10" style="display: none;" value="<?php echo (isset($_POST['postalCode'])) ?  (($result) ? "" : $_POST['postalCode']) : ""; ?>" >
				</td>
				<td style="padding-left: 1em;">
					<input name="area" type="text" id="area" onkeyup="moveOnMax(this,'prefix')"  maxlength="3" size="3" value="<?php echo (isset($_POST['area'])) ?  (($result) ? "" : $_POST['area']) : ""; ?>" >
					 - 
					<input name="prefix" type="text" id="prefix"  maxlength="3" size="3" onkeyup="moveOnMax(this,'phone')" value="<?php echo (isset($_POST['prefix'])) ?  (($result) ? "" : $_POST['prefix']) : ""; ?>" >
					 - 
					<input name="phone" type="text" id="phone"  maxlength="4" size="4" onkeyup="moveOnMax(this,'email')" value="<?php echo (isset($_POST['phone'])) ?  (($result) ? "" : $_POST['phone']) : ""; ?>" >
				</td>
			</tr>
		</table>
		
		<p>
		<label>Email: <span class="req" >*</span></label><br />
		<input name="email" type="text" id="email" size="50" maxlength="50" value="<?php echo (isset($_POST['email'])) ?  (($result) ? "" : $_POST['email']) : ""; ?>" >
		</p>
		
		<p>
			<label>Bride's Name: <span class="req" >*</span></label>
			<br />
			<input name="brideName" type="text" id="brideName" size="50" maxlength="50" value="<?php echo (isset($_POST['brideName'])) ?  (($result) ? "" : $_POST['brideName']) : ""; ?>" >
		</p>
		
		<p>
			<label>Groom's Name: <span class="req" >*</span></label>
			<br />
			<input name="groomName" type="text" id="groomName" size="50" maxlength="50" value="<?php echo (isset($_POST['groomName'])) ?  (($result) ? "" : $_POST['groomName']) : ""; ?>" >
		</p>
		
			
		<br />
		
		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="submit" name="submit" value="save and continue">
		<span class="left300 reg12">  1 of 3</span>
		<br /><br /><br /><br /><br /><br />
		
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