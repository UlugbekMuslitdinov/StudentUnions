<?php
// Database
include('mysql_link.inc');
mysql_select_db('equiss2011', $DBlink);

// Initialization
define('COST', 175.00);
define('COST_SCHOLARSHIP', 25.00);
define('SHUTTLE1', 10.00);
define('SHUTTLE2', 20.00);
define('DEADLINE', 'May 13th, 2011');
define('END_TIME', mktime(0, 0, 0, 5, 14, 2011));
define('END_COUNT', 50);
define('EMAIL_ADMIN', 'crs@email.arizona.edu, equiss@yahoo.com');

// Count number of registrants
function reg_count()
{
	return mysql_result(mysql_query("SELECT COUNT(*) FROM payment p, registration r WHERE p.status = 'approved' AND r.status = 1 AND p.reg_id = r.id"), 0);
}

// Close registration on reg_count or time
function close_registration()
{
	return (reg_count() > END_COUNT || time() > END_TIME);
}

// General redirect
function redirect($location)
{
	header("Location: $location");
	exit;
}

// Sanitize for queries
function clean_string($array)
{
	if (is_array($array))
	{
		foreach ($array as $key => $value)
		{
			$array[$key] = (is_array($value)) ? clean_string($value) : mysql_real_escape_string(trim($value));
		}
	}
	else
	{
		$array = mysql_real_escape_string(trim($array));
	}
	
	return $array;
}

function pay_type()
{
	$shuttle = ($_SESSION['shuttle'] == 'yes1') ? SHUTTLE1 : (($_SESSION['shuttle'] == 'yes2') ? SHUTTLE2 : 0);
	if ($_SESSION['check'])
	{
		$paymentID = 'check-' . $_SESSION['checkNum'] . ' (' . $_SESSION['webauth']['netID'] . ')';
	}
	elseif ($_SESSION['scholarship'])
	{
		$paymentID = 'scholarship';
	}
	elseif ($_SESSION['idb'])
	{
		$paymentID = 'idb';
	}
	else
	{
		$paymentID = 'cc-' . $_SESSION['paymentID'];
	}
	
	$cost = (isset($_SESSION['scholarship'])) ? COST_SCHOLARSHIP : COST;
	$total = $cost + $shuttle;
	
	return array('paymentID' => $paymentID, 'total' => $total);
}

function get_receipt($pay_type)
{
	$cost = (isset($_SESSION['scholarship'])) ? COST_SCHOLARSHIP : COST;
	$shuttle_display = ($_SESSION['shuttle'] == 'yes1') ? '<tr><td>Airport Only Shuttle</td><td align="right">$' . SHUTTLE1 . '</td></tr>' : ($_SESSION['shuttle'] == 'yes2' ? '<tr><td>Full Shuttle</td><td align="right">$' . SHUTTLE2 . '</td></tr>' : '');
	return "<p>{$_SESSION['firstName']} {$_SESSION['lastName']}
	<br>{$_SESSION['address']}<br>{$_SESSION['city']}, {$_SESSION['state']} {$_SESSION['zip']}</p>
	
	<blockquote>
	<table width=\"60%\">
	<tr><td width=\"50%\">Retreat Registration</td><td align=\"right\">$" . $cost . "</td></tr>$shuttle_display
	<tr><td>&nbsp;</td><td align=\"right\">Total: \${$pay_type['total']}</td></tr>
	</table>
	</blockquote>";
}

function get_info($id)
{
	$display = '';
/*
 * General information
 */
$result = mysql_query("SELECT * FROM registration WHERE id = $id");
if (mysql_num_rows($result) > 0)
{
	$registrant = mysql_fetch_assoc($result);
	$registrant = array_map('htmlentities', $registrant);
	
	$display .= (!$registrant['status'] ? '<del>' : '') .
	"<h1>" . $registrant['firstName'] . ' ' .  $registrant['lastName'] . "</h1>" .
	(!$registrant['status'] ? '</del>' : '') .
	"<table width=\"100%\"><tr>
		<td width=\"50%\">{$registrant['address']}<br>{$registrant['city']} {$registrant['state']} {$registrant['ZIP']}</td>
		<td><strong>Phone:</strong> {$registrant['phoneNumber']}<br><strong>Cell:</strong> {$registrant['cell']}<br><strong>Email:</strong> {$registrant['email']}</td>
	</tr>
	<tr>
		<td><strong>Age:</strong> {$registrant['age']}<br><strong>Gender:</strong> {$registrant['gender']}<br><strong>Economic Status:</strong> {$registrant['economic']}</td>
		<td><strong>DOB:</strong> {$registrant['DOB']}<br><strong>Race:</strong> {$registrant['race']}<br><strong>Sexual Orientation:</strong> {$registrant['orientation']}</td>
	</tr></table>
	
	<p><strong>College:</strong> {$registrant['school']}<br>
	<strong>Major:</strong> {$registrant['major']}<br>
	<strong>Career:</strong> {$registrant['career']}</p>
	
	<p><strong>Need Shuttle:</strong> {$registrant['shuttle']}</p>
	
	<p><strong>Name Printed (Sig):</strong> {$registrant['printedName']}<br>
	<strong>Signature Date:</strong> {$registrant['sigDate']}</p>
	
	<h3>Question Answers</h3>
	<p><strong>Q1 Answer:</strong> " . nl2br($registrant['q_1']) . "</p>
	<p><strong>Q2 Answer:</strong> " . nl2br($registrant['q_2']) . "</p>
	<p><strong>Q3 Answer:</strong> " . nl2br($registrant['q_3']) . "</p>";
}
else
{
	$display .= 'No such Name';
}

/*
 * Identity information
 */
$display .= '<hr><h3>This individual "checked" the following "I identify as" boxes:</h3>';
$result = mysql_query("SELECT identity_text FROM identities WHERE reg_id = $id");
if (@mysql_num_rows($result) > 0)
{
	while ($registrant = mysql_fetch_assoc($result))
	{
		$display .= htmlentities($registrant['identity_text']) . '<br>';
	}
}
else
{
	$display .= 'No boxes were checked.';
}

/*
 * Payment information
 */
$display .= '<hr><h3>Payment Info</h3>';
$result = mysql_query("SELECT * FROM payment WHERE reg_id = $id");
if (@mysql_num_rows($result) > 0)
{
	$registrant = mysql_fetch_assoc($result);
	$registrant = array_map('htmlentities', $registrant);
	
	$display .= "<strong>Name:</strong> {$registrant['firstName']} {$registrant['lastName']}<br>
	<strong>Address:</strong> {$registrant['address']}<br>
	<strong>City:</strong> {$registrant['city']}<br>
	<strong>State:</strong> {$registrant['state']}<br>
	<strong>ZIP:</strong> {$registrant['zip']}<br>
	<strong>Phone:</strong> {$registrant['phoneNumber']}<br>
	<strong>Email:</strong> {$registrant['email']}<br>
	<strong>Payment Info:</strong> {$registrant['paymentID']}<br>
	<strong>Total (USD):</strong> \${$registrant['total']}<br>
	<strong>Status:</strong> {$registrant['status']}<br>
	<strong>Timestamp:</strong> " . date('F j, Y', $registrant['time']);
}
else
{
	$display .= 'No Payment Info';
}

return $display;
}
?>
