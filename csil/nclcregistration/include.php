<?php
/*
 * CSIL NCLC Registration
 * Created October, 2009
 */
 
if (!defined('ACCESS'))
{
	die('Hacking Attempt');
}

// Output buffer
ob_start();

// Session
session_start();

// Database
include('mysql_link.inc');
mysql_select_db('nclc10', $DBlink) or die(mysql_error());

// Card taker
require_once('cardtaker/cardtaker.inc');

// Authorization list
$admin = array('styx', 'sanorris', 'tam', 'tbpham', 'hroundtr', 'jsosa', 'tmartin1', 'jmasson', 'jfrench', 'nbischof', 'awaegli');

//
// Functions
//

// Authenticate
function start_webauth($auth)
{
	// Start session
	session_start();

	// Authenticate with WebAuth
	require_once('webauth/include.php');

	// Authentication list
	if (!in_array($_SESSION['webauth']['netID'], $auth))
	{
		session_destroy();
		die('You are not authorized to access this page.');
	}
}

// Redirect
function redirect($url)
{
	header('Location: ' . $url);
	exit;
}

// Print errors
function print_errors($errors)
{
	if (!empty($errors))
	{
		echo '<div class="error">' . implode($errors, "</div>\n<div class=\"error\">") . "</div>\n";
	}
}

// Cleans strings for db
function clean_string($string, $pattern = '')
{
	$string = str_replace("\'", "''", htmlspecialchars(trim($string)));
	$string = ($pattern != '') ? preg_replace($pattern, '', $string) : $string;

	return $string;
}

// Paid status with color
function paid_color($paid)
{
	global $options;
	$color = ($paid == 0) ? 'red' : 'green';
	return '<span style="color: ' . $color . '">' . $options[$paid] . '</span>';
}

// Build url query
function build_query($array, $parent = '')
{
	$query = array();
	foreach ($array as $key => $value)
	{
		if (is_array($value))
		{
			$query[] = build_query($value, (!empty($parent) ? "{$parent}[$key]" : $key));
		}
		else
		{
			$query[] = (!empty($parent) ? "{$parent}[$key]" : $key) . "=$value";
		}
	}

	return implode($query, '&');
}

// Page pagination
function pagination($table, $limit, $return, $other = '', $type = '*')
{
	global $count, $lang;

	$page = array();
	$get = '';

	$result = mysql_query("SELECT COUNT(" . clean_string($type) . ") FROM " . clean_string($table) . " " . clean_string($other)) or die(mysql_error());
	$num = mysql_result($result, 0);
	$numpages = ceil($num/$limit);

	parse_str($_SERVER['QUERY_STRING'], $query);

	for ($i = 1; $i <= $numpages; $i++)
	{
		$query['c'] = $i;
		$page[] = ($i == $count) ? $i : '<a href="' . $return . '?' . build_query($query) . '">' . $i . '</a>';
	}

	echo 'Page - ' . implode($page, ', ') . '<br />';
}

// Determine early registration
function early_registration()
{
	global $current_time, $early_registration;
	return ($current_time <= $early_registration);
}

// Determine close registration
function close_registration()
{
	global $current_time, $close_registration, $conference_limit;
	return ($current_time > $close_registration || global_total() > $conference_limit);
}

// Total all registrants
function global_total()
{
	return mysql_result(mysql_query('SELECT COUNT(*) FROM guests WHERE attend = 1'), 0);
}

// Decides if year needs to be pushed up one for FY
function push_fiscal($time)
{
	return ($time > mktime(0, 0, 0, 7, 1, date('y')) && $time < mktime(0, 0, 0, 12, 31, date('y'))) ? date('Y', $time) + 1 : date('Y', $time);
}

// Prepare summary email
function prep_email()
{
	global $genders, $classes, $meals, $shirts, $sandwiches, $schools, $options, $organizations;
	
	$display = 'Primary Contact Information
---------------------------
First Name: ' . $_SESSION['contact']['firstname'] . '
Last Name: ' . $_SESSION['contact']['lastname'] . '
School: ' . $schools[$_SESSION['contact']['school']] . '
School Other: ' . $_SESSION['contact']['schooletc'] . '
Organizaiton: ' . $organizations[$_SESSION['contact']['organization']] . '
Email address: ' . $_SESSION['contact']['email'] . '
Daytime Phone: ' . $_SESSION['contact']['phone'] . '
Address Line 1: ' . $_SESSION['contact']['address1'] . '
Address Line 2: ' . $_SESSION['contact']['address2'] . '
City: ' . $_SESSION['contact']['city'] . '
State: ' . $_SESSION['contact']['state'] . '
ZIP: ' . $_SESSION['contact']['zip'];

	// Attendees
	for ($i = 1; $i <= $_SESSION['attendees']; $i++)
	{
		$display .= "\n\n" . 'Attendee ' . $i . ' Information
---------------------------
First Name: ' . $_SESSION['guest'][$i]['firstname'] . '
Last Name: ' . $_SESSION['guest'][$i]['lastname'] . '
Age: ' . $_SESSION['guest'][$i]['age'] . '
Gender: ' . $genders[$_SESSION['guest'][$i]['gender']] . '
Attendee Type: ' . $classes[$_SESSION['guest'][$i]['class']] . '
Meal Type: ' . $meals[$_SESSION['guest'][$i]['meal']] . '
Meal Type Specifics: ' . $_SESSION['guest'][$i]['mealetc'] . "\n";
		if (early_registration())
		{
			$display .= 'T-Shirt Size: ' . $shirts[$_SESSION['guest'][$i]['shirt']] . "\n";
		}
		$display .= 'Sandwich Type: ' . $sandwiches[$_SESSION['guest'][$i]['sandwich']] . '
School: ' . $schools[$_SESSION['guest'][$i]['school']] . '
School Other: ' . $_SESSION['guest'][$i]['schooletc'] . '
International: ' . $options[$_SESSION['guest'][$i]['international']] . '
Country (If International): ' . $_SESSION['guest'][$i]['country'] . '
Organization: ' . $organizations[$_SESSION['guest'][$i]['organization']] . '
Email address: ' . $_SESSION['guest'][$i]['email'] . '
Daytime Phone: ' . $_SESSION['guest'][$i]['phone'] . '
Address Line 1: ' . $_SESSION['guest'][$i]['address1'] . '
Address Line 2: ' . $_SESSION['guest'][$i]['address2'] . '
City: ' . $_SESSION['guest'][$i]['city'] . '
State: ' . $_SESSION['guest'][$i]['state'] . '
ZIP: ' . $_SESSION['guest'][$i]['zip'];
	}
	
	return $display;
}

//
// Implode_assoc by Sean P. O. MacCath-Moran
// http://emanaton.com/code/php/implode_assoc
function implode_assoc($array, $overrideOptions = array())
{	
	// These default options set the defaults but are over-written by matching values from $overrideOptions
	$options = array(
		'inner_glue'=>'=',
		'outer_glue'=>'&',
		'prepend'=>'',
		'append'=>'',
		'skip_empty'=>false,
		'prepend_inner_glue'=>false,
		'append_inner_glue'=>false,
		'prepend_outer_glue'=>false,
		'append_outer_glue'=>false,
		'urlencode'=>false,
		'part'=>'both' //'both', 'key', or 'value'
	);
	 
	// Use values from $overrideOptions that match keys in $options and then extract those values into
	// the current workspace.
	foreach ($overrideOptions as $key=>$val) { if (isset($options[$key])) {$options[$key] = $val;} }
	extract($options);
	 
	// $output holds the imploded results of the key-value pairs
	$output = array();
	 
	// Create a collection of the inner key-value pairs and glue them as indicated by the $options
	foreach($array as $key=>$item)
    {
		// If not skipping empty values OR if the item evaluates to true.
		// i.e. If $skip_empty is true then check to see if the array item's value evaluates to true.
		if (!$skip_empty || $item)
        {
			$output[] =
				($prepend_inner_glue ? $inner_glue : '').
				($part != 'value' ? $key : ''). // i.e. show the $key if $part is 'both' or 'key'
				($part == 'both' ? $inner_glue : '').
				// i.e. show the $item if $part is 'both' or 'value' and optionally urlencode $item
				($part != 'key' ? ($urlencode ? urlencode($item) : $item) : '').
				($append_inner_glue ? $inner_glue : '')
			;
		}
	}
	 
	return
		$prepend.
		($prepend_outer_glue ? $outer_glue : '').
		implode($outer_glue, $output).
		($append_outer_glue ? $outer_glue : '').
		$append
	;
}


//
// General initialization
//
$errors = array();
$sorts = array('asc', 'desc');
$orders = array('time', 'lastname', 'school', 'meal', 'attend', 'cost', 'paid');

// Initialize
$page = (isset($_GET['p'])) ? $_GET['p'] : $_POST['p'];
$page = (preg_match("/^[a-z0-9_-]+$/i", $page)) ? $page : '';
$id = (isset($_POST['id'])) ? intval($_POST['id']) : intval($_GET['id']);
$year = (isset($_GET['y'])) ? intval($_GET['y']) : push_fiscal(time());
$count = (empty($_GET['c'])) ? 1 : intval($_GET['c']);
$sort = (isset($_POST['s'])) ? (@in_array($_POST['s'], $sorts) ? $_POST['s'] : 'desc') : (@in_array($_GET['s'], $sorts) ? $_GET['s'] : 'desc');
$order = (isset($_POST['o'])) ? (@in_array($_POST['o'], $orders) ? $_POST['o'] : 'time') : (@in_array($_GET['o'], $orders) ? $_GET['o'] : 'time');

// Settings -remember dates are not inclusive, so if you want the last day for early reg to be 1/19 you need to set the date to 1/20 so it shuts off at midnight on the 1/20
$current_time = time(); //mktime(4, 0, 0, 6, 23, 2010);
$early_registration = mktime(3, 0, 0, 1, 20, 2011);
//$close_registration = mktime(3, 0, 0, 2, 6, 2010);
$close_registration = mktime(3, 0, 0, 2, 2, 2011);
$conference_limit = 600;

$options = array('No', 'Yes');
$genders = array('Male', 'Female', 'Transgender');
$classes = array('Student', 'Advisor');
$meals = array('Regular', 'Vegetarian', 'Vegan');
$sandwiches = array('Turkey and provolone on sourdough', 'Tuna and walnut salad on croissant', 'Chicken salad on croissant', 'Roast beef and havarti on whole wheat', 'Baked ham and Swiss on  marble rye', 'Veggie on 9 grain');
$shirts = array('Small', 'Medium', 'Large', 'XL', 'XXL', 'XXXL');
$organizations = array('Student Government', 'Student Club', 'Fraternity/Sorority', 'Honorary', 'Sports Club', 'Residents Hall', 'Other', 'None');
$paytypes = array(
	'card' => 'Credit Card',
	'idb' => 'Interdepartmental Billing Form (U of A Only)',
	'check' => 'Check'
);
$schools = array(
				'Adrian College',
				'Alabama State University',
				'Arizona State University - Downtown Phoenix',
				'Arizona State University - Polytechnic',
				'Arizona State University - Tempe',
				'Arizona State University - West',
				'Arizona Western College',
				'Arkansas State University',
				'Auburn University',
				'Boston College',
				'Bowling Green State University',
				'Bryant University',
				'Carleton College',
				'Carroll College',
				'Cedarville University',
				'Central Arizona College',
				'Chandler-Gilbert Community College',
				'Chaparral College',
				'Chapman University',
				'City University of New York',
				'Clarion University',
				'Clemson College',
				'Coastal Carolina University',
				'Cochise College',
				'Coconino Community College',
				'Coe College',
				'Colgate University',
				'College of Charleston',
				'Collins College - Tempe',
				'Colorado State University',
				'Columbus State Community College',
				'Community College of Aurora',
				'Cornell University',
				'Creighton University',
				'Dakota State University',
				'Dine College',
				'Dominican University of California',
				'Eastern Arizona College',
				'EHIME University',
				'Embry-Riddle Aeronautical',
				'Estrella Mountain Community College',
				'Everett Community College',
				'Fairfield University',
				'Florida International University',
				'Fort Lewis College',
				'Front Range Community College',
				'Gateway Community College',
				'Georgetown College',
				'Georgetown University',
				'Georgia State University',
				'Glendale Community College',
				'Gonzaga University',
				'Hawaii Community College',
				'Hawaii Pacific University',
				'Idaho State University',
				'Illinois State University',
				'Indiana State University',
				'Indiana University',
				'Ithaca College',
				'ITT Technical Institute',
				'Jamestown College',
				'Johnson Bible College',
				'Kansas State University',
				'Kentucky State University',
				'LOYOLA University - Chicago',
				'Lycoming College',
				'Magellan University',
				'Manmouth University',
				'Maricopa Community College',
				'Marymount University',
				'Mesa Community College',
				'Miami University',
				'Michigan State University',
				'Middle Tennessee University',
				'Mississippi State University',
				'Missouri University of Science & Technology',
				'Mohave Community College',
				'Montana State University',
				'Monticlair State University',
				'Mount Mercy College',
				'New Jersey City University',
				'New Mexico State University - Las Cruces',
				'Newberry College',
				'Nichols College',
				'North Carolina Central University',
				'North Carolina State University',
				'Northern Arizona University',
				'Northern Kentucky University',
				'Northern State University',
				'Northland Pioneer College ',
				'Northwestern Oklahoma State University',
				'Notre Dame University',
				'Ohio State University',
				'Ohio University',
				'Oklahoma State University',
				'Old Dominion University',
				'Oregon State University',
				'Pace University',
				'Palomar Community College',
				'Paradise Valley Community College',
				'Parkland College',
				'Penn State University',
				'Philadelphia University',
				'Phoenix College',
				'Pikes Peak Community College',
				'Pima Community College- Community Campus',
				'Pima Community College- Downtown',
				'Pima Community College- Northwest',
				'Pima Community College-Desert Vista',
				'Pima Community College-East',
				'Pima Community College-West',
				'Plymouth State University',
				'Princeton University',
				'Purdue University',
				'Rio Salado College',
				'Rochester Institute of Technology',
				'Rocky Mountain Community College',
				'Rollins College',
				'Rutgers University',
				'San Diego State University',
				'Savannah State University',
				'Scottsdale Community College',
				'Seton Hall University',
				'Sheridan College',
				'Simpson College',
				'South Dakota State University',
				'South Mountain Community College',
				'Southern New Hampshire University',
				'Southern Utah University',
				'Southwest Minnesota State University',
				'State University of York-Geneseo',
				'Towson University',
				'Tucsculum College',
				'Tulane University',
				'UDEM',
				'UMASS AMHERST',
				'University of Advancing Technology',
				'University of Alabama',
				'University of Alaska - Anchorage',
				'University of Arizona',
				'University of Arkansas',
				'University of Baltimore',
				'University of California - Los Angeles',
				'University of California - San Diego',
				'University of Central Arkansas',
				'University of Central Missouri',
				'University of Colorado',
				'University of Connecticut',
				'University of Dayton',
				'University of Delaware',
				'University of Florida',
				'University of Georgia',
				'University of Hartford',
				'University of Idaho',
				'University of Indiana',
				'University of Kansas',
				'University of Kentucky',
				'University of Maine',
				'University of Maryland',
				'University of Massachusetts',
				'University of Michigan',
				'University of Minnesota',
				'University of Missouri',
				'University of Montana',
				'University of Nevada - Las Vegas',
				'University of New Hampshire',
				'University of New Mexico',
				'University of North Dakota',
				'University of Nova Southern',
				'University of Oklahoma',
				'University of Oregon',
				'University of Pennsylvania',
				'University of Portland',
				'University of Rhode Island',
				'University of San Diego',
				'University of South Carolina',
				'University of South Dakota',
				'University of Southern Maine',
				'University of Southern Mississippi',
				'University of Tennessee',
				'University of Texas - Austin',
				'University of the Pacific',
				'University of Vermont',
				'University of Virginia',
				'University of Washington',
				'University of West Virginia',
				'University of Wisconsin - Madison',
				'University of Wisconsin - Milwaukee',
				'Utah Valley State',
				'Valparaiso University',
				'Virginia Commonwealth University',
				'Virginia State University',
				'Weber State University',
				'Wentworth Institute of Technology',
				'West Virginia State University',
				'Wisconsin Lutheran College',
				'Wright State University',
				'Yale University',
				'Yavapai College',
				'York College of Pennsylvania'
);
?>
