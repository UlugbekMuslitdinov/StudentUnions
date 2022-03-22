<?php
// override session timeout to give them one full hour
ini_set("session.gc_maxlifetime", 3600);

// turn on sessions
@session_start();

require_once('includes/field_validation.inc.php');
require_once ('dining.inc');
$page_options['page'] = 'Dining';
$page_options['header_image'] = "/template/images/banners/13_Union_Holiday-Meal_web_banner.jpg";


dining_start($page_options);
?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/template/expand.css" />
<script  type="text/javascript" src="/template/expand.js"></script>
<script type="text/javascript" src="/template/takehome_1.js" ></script>

<?php

// has the form been submitted?
if (isset($_POST['submit'])) {
	// remove any html tags from the input

	// applicant information
	$firstName = strip_tags($_POST['firstName']);
	$lastName = strip_tags($_POST['lastName']);
	$area = strip_tags($_POST['area']);
	$prefix = strip_tags($_POST['prefix']);
	$phone = strip_tags($_POST['phone']);
	$email = strip_tags($_POST['email']);

	// initialize the response variable
	$response = "";

	require_once('takehome_1_val.inc.php');

	if (!$response) {
		// register session variables
		$_SESSION['firstName'] = $firstName;
		$_SESSION['lastName'] = $lastName;
		$_SESSION['fullName'] = $fullName;
		$_SESSION['area'] = $area;
		$_SESSION['prefix'] = $prefix;
		$_SESSION['phone'] = $phone;
		$_SESSION['phoneNumber'] = $phoneNumber;
		$_SESSION['email'] = $email;
	}

} else {

	// if we are going backward through the screens, we restore the variables

	// applicant information
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

	if (!isset($_POST['area'])) {
		if (isset($_SESSION['area'])) {
			$area = strip_tags($_SESSION['area']);
			$_POST['area'] = strip_tags($_SESSION['area']);
		}
	}
	if (!isset($_POST['prefix'])) {
		if (isset($_SESSION['prefix'])) {
			$prefix = strip_tags($_SESSION['prefix']);
			$_POST['prefix'] = strip_tags($_SESSION['prefix']);
		}
	}
	if (!isset($_POST['phone'])) {
		if (isset($_SESSION['phone'])) {
			$phone = strip_tags($_SESSION['phone']);
			$_POST['phone'] = strip_tags($_SESSION['phone']);
		}
	}
	if (!isset($_POST['phoneNumber'])) {
		if (isset($_SESSION['phoneNumber'])) {
			$phoneNumber = strip_tags($_SESSION['phoneNumber']);
			$_POST['phoneNumber'] = strip_tags($_SESSION['phoneNumber']);
		}
	}
	if (!isset($_POST['email'])) {
		if (isset($_SESSION['email'])) {
			$email = strip_tags($_SESSION['email']);
			$_POST['email'] = strip_tags($_SESSION['email']);
		}
	}
}
?>
<?php
$current = time();
 
// echo "Current Time: ";
// echo date('l jS \of F Y h:i:s A');

// Start = right after midnight on December 12th
$start_date = mktime(0, 0, 0, 12, 12, date("Y"));
// End = 5pm on December 20th
$end_date = mktime(17, 0, 0, 12, 20, date("Y"));

// echo "Start Date: ".$start_date."<br />";
// echo "Current Date: ".$current."<br />";
// echo "End Date: ".$end_date."<br />";

// the registration is visible between 11/20 and 11/26
// then it reverts to the unavailable message.
if ($current < $start_date || $current > $end_date):
?>

	<h1>Online Orders</h1>
	
    <p>
    		<!-- Orders for Holiday Meals are currently unavailable. -->
		We are so sorry. Holiday orders for Christmas are currently unavailable. The cutoff was, December 20, <?php echo date('Y'); ?> at 5pm MST. 
	</p> 
	
	<p>
		<!-- Watch for information about the Christmas Holiday Meals. -->
		We wish you all a very Merry Christmas and a Happy New Year! 
	</p>

<?php else: ?>
	
	<h1>Online Order Form</h1>

	<p>
		Just leave the cooking to us.
	</p>

	<p>
		Maybe you don't have the time to crack open a cookbook or sport that stylin' apron. No worries. We'll cook up a fresh 
		holiday meal you'll love. And all you have to do is heat, serve and enjoy time together with your family.
	</p>
	
	<p>
		Choose from our juicy roasted turkey or hams - plus all the fixings. You'll find all your holiday favorites for your family to enjoy.
	</p>
	
	<p>
		Three packages available serving up to 20 guests. A la carte options also available.
	</p>
	
	<p>
		<strong>All a la carte items will serve approximately 6-8 people.</strong>
	</p>
	
	<p>
		Prices starting at only $55 + tax.
	</p>
	
	
	
	<ul style="line-height: 1.25em;">
		<li>Package 1: Serves 6-8 - $55 + tax</li>
		<li>Package 2: Serves 12-15 - $85 + tax</li>
		<li>Package 3: Serves 15-20 - $115 + tax</li>
		<li>A la carte only: (All a la carte items will serve approximately 6-8 people)<br /> Charge for each item + tax</li>
	</ul>
	
	<div id="content" style="max-width: 500px; margin-top: 1em;">
		<h2 class="expand" style="max-width: 500px;" >
			Click here to see what's on the menu for this holiday!
		</h2>
		 
		<div class="collapse">
			<h5 style="margin-top: 1em;">Main Course:</h5>
			<ul>
				<li>Roasted Turkey Bone-In (16-20lbs)</li>
				<li>Honey Glazed Ham</li>
			</ul>
		
			<h5 style="margin-top: 1em;">Potatoes:</h5>
			<ul>
				<li>Mashed Potatoes W/Gravy</li>
				<li>Candied Sweet Potatoes</li>
				<li>Mashed Yams W/Cranberries</li>
			</ul>
			
			<h5 style="margin-top: 1em;">Stuffing:</h5>
			<ul>
				<li>Apple Celery Stuffing</li>
				<li>Sausage Sage Stuffing</li>
				<li>Cornbread Stuffing</li>
			</ul>
		 
		 	<h5 style="margin-top: 1em;">Vegetables:</h5>
			<ul>
				<li>Green Bean Casserole</li>
				<li>Green Beans W/Red Peppers</li>
				<li>Buttered Corn</li>
				<li>Glazed Carrots</li>
				<li>Vegetable Medley</li>
			</ul>
			
		 	<h5 style="margin-top: 1em;">Relishes:</h5>
			<ul>
				<li>Cranberry Relish</li>
				<li>Orange Cranberry Sauce W/Walnuts</li>
			</ul>
			
			<h5 style="margin-top: 1em;">Breads:</h5>
			<ul>
				<li>Dinner Rolls</li>
				<li>Corn Muffins</li>
			</ul>
			
			<h5 style="margin-top: 1em;">Salads:</h5>
			<ul>
				<li>House Salad</li>
				<li>Waldorf Salad</li>
				<li>Ana’s Broccoli Salad</li>
				<li>Ambrosia Salad</li>
			</ul>
			
		 	<h5 style="margin-top: 1em;"> Desserts:</h5>
			<ul>
				<li>Pumpkin Pie</li>
				<li>Pumpkin Loaf</li>
				<li>Pecan Pie</li>
				<li>Apple Pie</li>
				<li>Almond Ring</li>
			</ul>
			
		 
		 
		<br class="clear" />
		<hr style="max-width: 500px;" />
		<br />
	</div>
	</div>
	
	<p>
		<strong>Orders must be placed prior to Friday, December 20, 2013 at 5pm MST.</strong>
	</p>
	
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
					location.href="/dining/takehome_2.php";
			</script>

		<?php } else {
			// if there were errors, display them.
			echo "<h4 class='error-msg sub-nav-left-col'  >There were errors in processing the order information.</h4>";
	
			echo "<p class='error-msg' > $response </p><br />";
		}
	}?>

	<!-- the $_SERVER['PHP_SELF'] in the action field always posts back to the same form. -->
	<form name="form1" id="frm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

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
			<label>Phone: <span class="req" >*</span></label>
			<br />
			<input name="area" type="text" id="area" onkeyup="moveOnMax(this,'prefix')"  maxlength="3" size="3" value="<?php echo (isset($_POST['area'])) ?  (($result) ? "" : $_POST['area']) : ""; ?>" >
			-
			<input name="prefix" type="text" id="prefix"  maxlength="3" size="3" onkeyup="moveOnMax(this,'phone')" value="<?php echo (isset($_POST['prefix'])) ?  (($result) ? "" : $_POST['prefix']) : ""; ?>" >
			-
			<input name="phone" type="text" id="phone"  maxlength="4" size="4" onkeyup="moveOnMax(this,'email')" value="<?php echo (isset($_POST['phone'])) ?  (($result) ? "" : $_POST['phone']) : ""; ?>" >
		</p>
		
		<p>
		<label>Email: <span class="req" >*</span></label><br />
		<input name="email" type="text" id="email" size="50" maxlength="50" value="<?php echo (isset($_POST['email'])) ?  (($result) ? "" : $_POST['email']) : ""; ?>" >
		</p>
		<br />

		<!-- the input with type submit, automatically posts the form to the server. -->
		<input type="submit" name="submit" value="save and continue">
		<span class="left300 reg12">1 of 4</span>
		<br />
		<br />

	</form>
	</div>
</div>

<?php endif; ?>

<?php
dining_finish();
?>