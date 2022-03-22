<?php
/*
 * Corporate Sponsors
 * Created September, 2009
 */
ini_set('display_errors', 1);

// Force WWW for webauth
if (!strstr($_SERVER['HTTP_HOST'], 'styx') && !strstr($_SERVER['HTTP_HOST'], 'sunion') && !strstr($_SERVER['HTTP_HOST'], 'www.'))
{
	header('Location: http://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	exit;
}

define('ACCESS', true);
include('../include.php');

// Authenticate
start_webauth($admin);

require('global.inc');
$page_options['title'] = 'Clubs & Organizations';
page_start($title);

echo '<style type="text/css">
th {background-color: #ccc; color: black;}
.order {color: white;}
.clickable {cursor: pointer;}
</style>
<div align="right"><a href="?p">Main</a> | <a href="?p=config">Config</a> | <a href="?p=archive">Archive</a></div>';

switch ($page)
{
	case 'config':
		if (!isset($_GET['y']))
		{
			echo '<h1>General Configuration</h1>';

			if (isset($_POST['edit_config']))
			{
				$result = $db->query("SELECT * FROM csil_club_config");
				while ($row = mysql_fetch_assoc($result))
				{
					$config_name = $row['config_name'];
					$config_value = $row['config_value'];

					$default_config[$config_name] = (isset($_POST['edit_settings'])) ? clean_string($config_value) : $config_value;

					$new[$config_name] = (isset($_POST[$config_name])) ? $_POST[$config_name] : $default_config[$config_name];

					$db->query("UPDATE csil_club_config SET config_value = '" . clean_string($new[$config_name]) . "' WHERE config_name = '$config_name'");
				}

				echo '<h3>Changes saved for General Configuration!</h3>';
			}
		
			// General config
			$config = get_config();
			echo '<form method="post">
			<table width="100%" cellpadding="5" cellspacing="1" border="0">
			<tr>
				<td style="background-color: #ccc; color: black;">Description character maximum</td>
				<td><input type="text" name="description_max" value="' . $config['description_max'] . '"></td>
			</tr>
			<tr>
				<td style="background-color: #ccc; color: black;">Description character minimum</td>
				<td><input type="text" name="description_min" value="' . $config['description_min'] . '"></td>
			</tr>
			<tr>
				<td style="background-color: #ccc; color: black;">Allowed sample filetypes</td>
				<td><input type="text" name="allowed_types" value="' . $config['allowed_types'] . '"></td>
			</tr>
			<tr>
				<td style="background-color: #ccc; color: black;">Notice email, comma-delimited</td>
				<td><input type="text" name="email" value="' . $config['email'] . '" size="30"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="edit_config" value="Save Changes"></td>
			</tr>
			</table>
			</form><hr />';
		}
		
		echo '<h1>Funding Configuration for FY ' . $year . '</h1>';
		
		if (isset($_POST['budget']))
		{
			$money = intval($_POST['money']);
			$pizza = intval($_POST['pizza']);
			$eegees = intval($_POST['eegees']);
			$soda = intval($_POST['soda']);
			$db->query("UPDATE csil_club_budget SET money = $money, pizza = $pizza, eegees = $eegees, soda = $soda WHERE year = $year");
			echo '<h3>Changes saved for FY ' . $year . '!</h3>';
		}
		
		// Budget config for selected year
		$budget = get_budget($year);
		echo '<form method="post">
		<table width="100%" cellpadding="5" cellspacing="1" border="0">
		<tr>
			<td style="background-color: #ccc; color: black;">Money</td>
			<td><input type="text" name="money" value="' . $budget['money'] . '"></td>
		</tr>
		<tr>
			<td style="background-color: #ccc; color: black;">Pizza</td>
			<td><input type="text" name="pizza" value="' . $budget['pizza'] . '"></td>
		</tr>
		<tr>
			<td style="background-color: #ccc; color: black;">Eegees</td>
			<td><input type="text" name="eegees" value="' . $budget['eegees'] . '"></td>
		</tr>
		<tr>
			<td style="background-color: #ccc; color: black;">Soda</td>
			<td><input type="text" name="soda" value="' . $budget['soda'] . '"></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="budget" value="Save Changes"></td>
		</tr>
		</table>
		</form>';
	break;
	
	case 'update':
		$result = $db->query("SELECT * FROM csil_club_funding WHERE id = $id");
		$app_info = mysql_fetch_assoc($result);
		
		if (!$app_info)
		{
			echo '<h1>Invalid ID!</h1>';
		}
		else
		{
			// Application
			$date = $app_info['date'];
			$organization = $app_info['organization'];
			$name = $app_info['name'];
			$phone = $app_info['phone'];
			$email = $app_info['email'];
			$event_name = $app_info['event_name'];
			$event_date_start = date('F j, Y', $app_info['event_date_start']);
			$event_date_end = (!empty($app_info['event_date_end'])) ? date('F j, Y', $app_info['event_date_end']) : '';
			$event_location = $app_info['event_location'];
			$request_amount = $app_info['request_amount'];
			$request_pizzas = $app_info['request_pizzas'];
			$request_eegees = $app_info['request_eegees'];
			$request_beverages = $app_info['request_beverages'];
			
			$criteria = unserialize($app_info['criteria']);
			$outcome = @implode(', ', unserialize($app_info['outcome']));
			
			$description = $app_info['description'];
			
			$budget_expense = unserialize($app_info['budget_expense']);
			$budget_item = unserialize($app_info['budget_item']);
			$budget_cost = unserialize($app_info['budget_cost']);
			$budget_funded = unserialize($app_info['budget_funded']);
			$budget_donated =unserialize( $app_info['budget_donated']);
			$budget_requested = unserialize($app_info['budget_requested']);
			$budget_income = $app_info['budget_income'];
			
			$sample = $app_info['sample'];
			
			// Administrative
			$request_approved = $app_info['request_approved'];
			$request_pizzas_approved = $app_info['request_pizzas_approved'];
			$request_beverages_approved = $app_info['request_beverages_approved'];
			$budget_approved = unserialize($app_info['budget_approved']);
			$approved = $app_info['approved'];
			$comments = $app_info['comments'];
			
			$updated = $app_info['updated'];
			$updated_name = $app_info['updated_name'];
			$email_sent = $app_info['email_sent'];
			
			echo '<h1 align="center">Request for Funding Application for ' . $organization . '</h1>';
			
			if (isset($_POST['save']))
			{
				// Application
				$organization = trim($_POST['organization']);
				$name = trim($_POST['name']);
				$phone = trim($_POST['phone']);
				$email = trim($_POST['email']);
				$event_name = trim($_POST['event_name']);
				$event_date_start = $_POST['event_date_start'];
				$event_date_end = $_POST['event_date_end'];
				$event_location = trim($_POST['event_location']);
				$request_amount = intval($_POST['request_amount']);
				$request_pizzas = intval($_POST['request_pizzas']);
				$request_eegees = intval($_POST['request_eegees']);
				$request_beverages = intval($_POST['request_beverages']);

				$criteria = $_POST['criteria'];
				$outcome = trim($_POST['outcomes']);
	
				$description = trim($_POST['description']);
	
				$budget_expense = array_map('trim', budget_first($_POST['budget_expense']));
				$budget_item = array_map('trim', budget_first($_POST['budget_item']));
				$budget_cost = array_map('intval', budget_first($_POST['budget_cost']));
				$budget_funded = array_map('trim', budget_first($_POST['budget_funded']));
				$budget_donated = array_map('trim', budget_first($_POST['budget_donated']));
				$budget_requested = array_map('trim', budget_first($_POST['budget_requested']));
	
				$budget_income = intval($_POST['budget_income']);
				
				// Administrative
				$request_approved = intval($_POST['request_approved']);
				$request_pizzas_approved = intval($_POST['request_pizzas_approved']);
				$request_eegees_approved = intval($_POST['request_eegees_approved']);
				$request_beverages_approved = intval($_POST['request_beverages_approved']);
				$budget_approved = array_map('intval', budget_first($_POST['budget_approved']));
				$approved = intval($_POST['approved']);
				$comments = trim($_POST['comments']);
				
				$updated = time();
				$updated_name = $_SESSION['webauth']['netID'];

				$event_date_end_update = (!empty($event_date_end)) ? strtotime($event_date_end) : 0;
				$sql = "UPDATE csil_club_funding SET organization = '" . clean_string($organization) . "', name = '" . clean_string($name) . "', phone = '" . clean_string($phone) . "', email = '" . clean_string($email) . "', event_name = '" . clean_string($event_name) . "', event_date_start = " . strtotime($event_date_start) . ", event_date_end = $event_date_end_update, event_location = '" . clean_string($event_location) . "', request_amount = $request_amount, request_pizzas = $request_pizzas, request_eegees = $request_eegees, request_beverages = $request_beverages, criteria ='" . clean_string(serialize($criteria)) . "', outcome = '" . clean_string(serialize(split('(,[[:space:]]?)', $outcome))) . "', description = '" . clean_string($description) . "', budget_expense = '" . clean_string(serialize($budget_expense)) . "', budget_item = '" . clean_string(serialize($budget_item)) . "', budget_cost = '" . serialize($budget_cost) . "', budget_funded = '" . clean_string(serialize($budget_funded)) . "', budget_donated = '" . clean_string(serialize($budget_donated)) . "', budget_requested = '" . clean_string(serialize($budget_requested)) . "', budget_income = $budget_income, request_approved = $request_approved, request_pizzas_approved = $request_pizzas_approved, request_eegees_approved = $request_eegees_approved, request_beverages_approved = $request_beverages_approved, budget_approved = '" . clean_string(serialize($budget_approved)) . "', approved = $approved, comments = '" . clean_string($comments) . "', updated = $updated, updated_name = '$updated_name' WHERE id = $id";
				
				$db->query($sql) or die(mysql_error());
		
				echo '<h3 align="center">Form Successfully Updated!</h3>';
			}
			
			if (isset($_POST['send']))
			{
				$email_sent = time();
				$msgbudget = '';
				for ($i = 0; $i < count($budget_item); $i++)
				{
					if (!empty($budget_item[$i]) && $budget_requested[$i] == 'Yes')
					{
						$msgbudget .= $budget_item[$i] . ': Requested $' . $budget_cost[$i] . ' Approved for $' . $budget_approved[$i] . "\n";
					}
				}
				
				$vars = array(
					'STATUS' => $approvals[$approved],
					'DATE' => date('F jS, Y', $date),
					'NAME' => $name,
					'ORGANIZATION' => $organization,
					'PHONE' => $phone,
					'EMAIL' => $email,
					'EVENT_NAME' => $event_name,
					'EVENT_DATE_START' => $event_date_start,
					'EVENT_DATE_END' => $event_date_end,
					'EVENT_LOCATION' => $event_location,
					'REQUEST_AMOUNT' => $request_amount,
					'REQUEST_PIZZAS' => $request_pizzas,
					'REQUEST_EEGEES' => $request_eegees,
					'REQUEST_BEVERAGES' => $request_beverages,
					'APPROVED_AMOUNT' => $request_approved,
					'APPROVED_PIZZAS' => $request_pizzas_approved,
					'APPROVED_EEGEES' => $request_eegees_approved,
					'APPROVED_BEVERAGES' => $request_beverages_approved,
					'BUDGET' => $msgbudget,
					'COMMENTS' => $comments
				);
				$emails = explode(',', $config['email']);
				$message = parse_vars($vars, file_get_contents('../emails/email_status.txt'));
				if (mail($email, 'CSIL: Club Funding Request ' . $approvals[$approved], $message, 'From: ' . trim($emails[0]) . "\r\nBcc: " . trim($emails[0])))
				{
					$db->query("UPDATE csil_club_funding SET email_sent = $email_sent WHERE id = $id");
					echo '<h3 align="center">Email Successfully Sent!</h3>';
				}
				else
				{
					echo '<h3 align="center">Email Error! Please try again!</h3>';					
				}
			}
			
			// Approved/Not Approved
			echo '<h1 align="center">' . status_color($approved) . '</h1>';
			
			// Last updated
			echo ((!empty($updated)) ?  '<h5 align="center">Last Updated ' . date('F jS, Y', $updated) . ' by ' . $updated_name . '</h5>' : '');
			echo ((!empty($email_sent)) ?  '<h5 align="center">Last Emailed ' . date('F jS, Y', $email_sent) . '</h5>' : '');

?>
<script type="text/javascript" src="../include.js"></script>
<script language="javascript">
window.onload = function() {
  textCounter(<?php echo $config['description_max']; ?>);
  addElement();
  calcEstimate();
  //calcTotal();
  prepCompare('request');
  prepCompare();
};
</script>
<style type="text/css">
.error {color: #FF0000; font-weight: bold;}
.ok {color: #0C0; font-weight: bold;}
#budget span {display: block; float: left; font-weight: bold;}
#budget div {clear: both;}
#list_prep {display: none;}

select {height: 22px;}
</style>

<form name="post" method="post">
<h2>Section 1: General Information</h2>
<p>Student Club/Organization/Association (no abbreviations): <input type="text" name="organization" value="<?php echo stripslashes($organization); ?>"></p>
<p>Name of Officer submitting request: <input type="text" name="name" size="40" value="<?php echo stripslashes($name); ?>" /></p>
<p>Phone: <input type="text" name="phone" value="<?php echo stripslashes($phone); ?>" /></p>
<p>E-mail: <input type="text" name="email" value="<?php echo stripslashes($email); ?>" /></p>
<p>Event Name: <input type="text" name="event_name" value="<?php echo stripslashes($event_name); ?>" />
Event Location: <input type="text" name="event_location" value="<?php echo stripslashes($event_location); ?>" /></p>
<p>Start Date: <input type="text" name="event_date_start" size="15" value="<?php echo $event_date_start; ?>" />
End Date: <input type="text" name="event_date_end" size="15" value="<?php echo $event_date_end; ?>" /></p>

<hr />
<h2>Section 2: Evaluation Criteria</h2>
<p>The committee will evaluate proposals on presentation (completeness, and neatness); and will only consider funding proposals where funds can be allocated in <strong><u>advance</u> of the program</strong>. (*See deadlines below) The CSIL Corporate Partners Committee will review requests for funding which meet 4 of the 5 criteria listed below in order to receive partial or full awards as funds are available.</p>

<div style="padding: 10px;border: 1px solid black;">
<?php
for ($i = 0; $i < count($criterias); $i++)
{
	$checked = (@in_array($i, $criteria)) ? ' checked="checked"' : '';
	echo '<input type="checkbox" name="criteria[]" value="' . $i . '"' . $checked . ' /><strong>' . $criterias[$i]['name'] . '</strong>
	<p>' . str_replace('{OUTCOMES}', $outcome, $criterias[$i]['description']) . '</p>' . "\n";
}
?>
</div>

<hr />
<h2>Section 3: Program Description</h2>
<p>Briefly describe your program and how each of the above criteria is met. Please do not exceed <?php echo $character_limit; ?> characters. Remember your event must meet four of the five criteria above.</p>
<textarea rows="15" cols="90" name="description" onKeyDown="textCounter(<?php echo $config['description_max']; ?>)" onKeyUp="textCounter(<?php echo $config['description_max']; ?>)"><?php echo stripslashes($description); ?></textarea>
<br />You have <input readonly type="text" name="remLen" size="5" maxlength="5" value="<?php echo $config['description_max']; ?>"> characters left for your message.

<hr />
<h2>Section 4: Event Budget</h2>
<p>Request: 
  Financial $
  <input type="text" name="request_amount" value="<?php echo $request_amount; ?>" onkeyup="prepCompare('request')" size="7" />
# Pizzas: 
<input type="text" name="request_pizzas" value="<?php echo $request_pizzas; ?>" size="5" />
# Eegees Tubs: 
<input type="text" name="request_eegees" value="<?php echo $request_eegees; ?>" size="5" />
# Cases of Beverage: 
<input type="text" name="request_beverages" value="<?php echo $request_beverages; ?>" size="5" /> (24 cans per case)</p>
<p>Submit the <strong><u>total event budget</u></strong>, using the included template. Provide estimated expenses and all income (including: co-sponsors, matching funds, your organization&rsquo;s contributions, etc.)</p>
<p class="error">Do not enter requested pizzas, Eegees tubs or beverages in the itemized budget</p>
<ul>
  <li>Expense Catagory: AV/Media, Room Rentals, Food, Supplies, Marketing, Entertainment/Speaker, Miscellaneous</li>
  <li>Itemization: List of the items to be purchased</li>
  <li>Funded by: List the organization paying for this item</li>
  <li>Donated by: This item will have no cost and is being donated by what organization?</li>
  <li>Is this what you are requesting be funded by CSIL and Corporate Partners? Yes/No</li>
</ul>
<table width="100%" cellpadding="5" cellspacing="0" border="1" id="budget_list">
<tr>
  <th>Expense Catagory</th>
  <th width="15%">Itemization</th>
  <th width="15%">Estimate Cost</th>
  <th width="15%">Funded By</th>
  <th width="15%">Donated By</th>
  <th width="10%">CSIL Request?</th>
  <th width="15%">Item Approved For</th>
  <th width="5%">Delete</th>
</tr>
<tr id="list_prep">
  <td><input type="text" name="budget_expense[]" size="15" /></td>
  <td><input type="text" name="budget_item[]" size="15" /></td>
  <td>$ <input type="text" name="budget_cost[]" size="5" onkeyup="calcEstimate();prepCompare();" /></td>
  <td><input type="text" name="budget_funded[]" size="10" /></td>
  <td><input type="text" name="budget_donated[]" size="10" /></td>
  <td><select name="budget_requested[]" onchange="prepCompare()" /><option>Yes</option><option>No</option></select></td>
  <td>$ <input type="text" name="budget_approved[]" size="5" /></td>
  <td><input type="button" value="-" onclick="removeElement(this)" /></td>
</tr>
<?php
for ($i = 0; $i < count($budget_item); $i++)
{
	$requested_yes = ($budget_requested[$i] == 'Yes') ? ' selected="selected"' : '';
	$requested_no = ($budget_requested[$i] == 'No') ? ' selected="selected"' : '';
	if (!empty($budget_item[$i]))
	{
		echo '<tr>
  <td><input type="text" name="budget_expense[]" size="15" value="' . stripslashes($budget_expense[$i]) . '" /></td>
  <td><input type="text" name="budget_item[]" size="15" value="' . stripslashes($budget_item[$i]) . '" /></td>
  <td>$ <input type="text" name="budget_cost[]" size="5" value="' . $budget_cost[$i] . '" onkeyup="calcEstimate();prepCompare();" /></td>
  <td><input type="text" name="budget_funded[]" size="10" value="' . stripslashes($budget_funded[$i]) . '" /></td>
  <td><input type="text" name="budget_donated[]" size="10" value="' . stripslashes($budget_donated[$i]) . '" /></td>
  <td><select name="budget_requested[]" onchange="prepCompare()" /><option' . $requested_yes . '>Yes</option><option' . $requested_no . '>No</option></select></td>
  <td>$ <input type="text" name="budget_approved[]" size="5" value="' . $budget_approved[$i] . '" /></td>
  <td><input type="button" value="-" onclick="removeElement(this)" /></td>
</tr>
';
	}
}
?>
<tr>
  <td colspan="2" align="right" style="background-color: #ccc; color: white;"><em>Total estimated expenses</em></td>
  <td colspan="6" style="background-color: #ccc; color: white;">$ <input type="text" name="total_estimate" size="10" disabled="disabled" /></td>
</tr>
<tr>
  <td colspan="2" align="right"><p><strong>Total projected income (ticket sales, raffels,
    <br />co-sponsors, club funds, etc)</strong></p></td>
  <td colspan="6">$ <input type="text" name="budget_income" size="10" value="<?php echo intval($budget_income); ?>" onkeyup="prepCompare()" /> + Request <span id="add_request" class="bold"></span> = Total <span id="total_estimate" class="bold"></span><div id="total"></div></td>
</tr>
<tr>
  <td colspan="2" align="right"><strong>Request Comparison</strong></td>
  <td colspan="5">Request <span id="compare_request" class="bold"></span> to Itemized CSIL Requests <span id="compare_itemized" class="bold"></span><div id="compare"></div></td>
</tr>
</table>

<a href="javascript:;" onclick="addElement()">Add Item</a>
<hr />
<h2>Section 5: Event Flyer/Brochure</h2>
<p>Submit a sample brochure/flyer, etc with the Corporate Partners logo on it along with the statement <em>&quot;this program was sponsored in part by the Corporate Partner's Grant, the Center for Student Involvement &amp; Leadership and the Arizona Student Unions&quot;</em></p>

<?php
$file = '/uploads/corpspons/documents/' . $sample;
$ext = ext($sample);
list($width) = @getimagesize($file);
echo (($ext == 'jpg' || $ext == 'jpeg') ? '<p><img src="' . $file . '"' . ($width > 500 ? ' width="500"' : '') . ' /></p>' : '');
?>
<a href="<?php echo '/uploads/corpspons/documents/' . $sample; ?>">Click to view <?php echo $sample; ?></a><br />
Allowed file types: <?php echo $config['allowed_types']; ?>

<hr />
<h2>Application Status</h2>
Status <select name="approved" /><option value="-1">-select-</option>
<?php
for ($i = 0; $i < count($approvals); $i++)
{
	$selected = ($approved == $i) ? ' selected="selected"' : '';
	echo "<option value=\"$i\"$selected>{$approvals[$i]}</option>\n";
}
?>
</select>
Amount Rewarded $ <input type="text" name="request_approved" value="<?php echo $request_approved; ?>" size="7" />
Pizzas Rewarded <input type="text" name="request_pizzas_approved" value="<?php echo $request_pizzas_approved; ?>" size="7" />
Eegees Tubs Rewarded <input type="text" name="request_eegees_approved" value="<?php echo $request_eegees_approved; ?>" size="7" />
Beverages Rewarded <input type="text" name="request_beverages_approved" value="<?php echo $request_beverages_approved; ?>" size="7" />
<br />Comments
<br /><textarea name="comments" rows="3" cols="90"><?php echo $comments; ?></textarea>
<hr />
<p>
	<input type="submit" name="save" value="Save Application" />
	<input type="button" value="Cancel" onclick="history.back()" />
	<input type="button" value="Print" onclick="printable(<?php echo $id; ?>)" />
	<input type="button" value="Send Email" onclick="confirmation()" />
</p>
</form>
<?php
		}
	break;
	
	case 'archive':
		echo '<h1>Club Funding Archive</h1>';
		
		// Get all years
		$years = array();
		$result = $db->query("SELECT date FROM csil_club_funding");
		while ($row = mysql_fetch_assoc($result))
		{
			$years[] = push_fiscal($row['date']);
		}
		
		// Display unique years
		if (is_array($years))
		{
			$years = array_unique($years);
			echo '<ul>';
			foreach ($years as $y)
			{
				echo "\n<li><a href=\"?p&y=$y\">$y</a> | <a href=\"?p=config&y=$y\">config</a></li>";
			}
			echo "\n</ul>";
		}
		else
		{
			echo 'No years to display!';
		}
	break;
	
	default:
		$display = '<h1>Club Listing Requests</h1>';
		
		// Sorting
		foreach ($orders as $o)
		{
			$cname = $o . '_click';
			$oname = $o . '_order';
			$$oname = ($order == $o) ? ' order' : '';
			$$cname = "window.location='?y=$year&o=$o&s=" . (($order == $o) ? (($sort == 'desc') ? 'asc' : 'desc') : 'desc') . "'";
		}
		
		$display .= '<table width="100%" cellpadding="5" cellspacing="1" border="0">
		<tr>
			<th class="clickable' . $date_order . '" onclick="' . $date_click . '">Date</th>
			<th width="25%" class="clickable' . $organization_order . '" onclick="' . $organization_click . '">Organization</th>
			<th width="20%" class="clickable' . $name_order . '" onclick="' . $name_click . '">Officer Name</th>
			<th width="10%" class="clickable' . $request_amount_order . '" onclick="' . $request_amount_click . '">Requested</th>
			<th width="10%" class="clickable' . $request_approved_order . '" onclick="' . $request_approved_click . '">Awarded</th>
			<th width="10%" class="clickable' . $approved_order . '" onclick="' . $approved_click . '">Status</th>
			<th width="10%">Action</th>
		</tr>';
		
		// Running totals
		$awarded_amount = 0;
		$awarded_pizzas = 0;
		$awarded_eegees = 0;
		$awarded_beverages = 0;
		
		// Start/End time (Fiscal year)
		$start_time = mktime(0, 0, 0, 7, 1, $year - 1);
		$end_time = mktime(0, 0, 0, 6, 31, $year);
		$result = $db->query("SELECT * FROM csil_club_funding WHERE date > $start_time AND date < $end_time ORDER BY $order $sort");
		while ($row = mysql_fetch_assoc($result))
		{
			$id = $row['id'];
			$display .= '<tr>
				<td>' . date('M j, Y', $row['date']) . '</td>
				<td>' . $row['organization'] . '</td>
				<td>' . $row['name'] . '</td>
				<td align="right">$' . $row['request_amount'] . '</td>
				<td align="right">$' . $row['request_approved'] . '</td>
				<td align="center">' . status_color($row['approved']) . '</td>
				<td align="center"><a href="?p=update&id=' . $id . '">View</a> <a href="javascript:;" onclick="printable(' . $id . ')">Print</a></td>
			</tr>';
			
			// Add to running totals
			$awarded_amount += ($row['approved'] > 0) ? $row['request_approved'] : 0;
			$awarded_pizzas += ($row['approved'] > 0) ? $row['request_pizzas_approved'] : 0;
			$awarded_eegees += ($row['approved'] > 0) ? $row['request_eegees_approved'] : 0;
			$awarded_beverages += ($row['approved'] > 0) ? $row['request_beverages_approved'] : 0;
		}
		
		// No records
		if (mysql_affected_rows() == 0)
		{
			$display .= '<tr><td colspan="6" align="center"><strong>No data for this year!</strong></td></tr>';
		}
		$display .= '</table>';
		
		// Budget totals
		$budget = get_budget($year);
		echo '<script type="text/javascript" src="../include.js"></script>
		<h1>Club Funding for FY ' . $year . '</h1>
		<table width="50%" cellpadding="5" cellspacing="1" border="0">
		<tr>
			<th style="background-color: #ccc; color: black;">Catagory</th>
			<th style="background-color: #ccc; color: black;">Allotted</th>
			<th style="background-color: #ccc; color: black;">Awarded</th>
			<th style="background-color: #ccc; color: black;">Remaining</th>
		</tr>
		<tr>
			<td align="center" style="background-color: #ccc; color: black;">Money</td>
			<td>$' . $budget['money'] . '</td><td>$' . $awarded_amount . '</td><td>$' . ($budget['money'] - $awarded_amount) . '</td>
		</tr>
		<tr>
			<td align="center" style="background-color: #ccc; color: black;">Pizza</td>
			<td>' . $budget['pizza'] . '</td><td>' . $awarded_pizzas . '</td><td>' . ($budget['pizza'] - $awarded_pizzas) . '</td>
		</tr>
		<tr>
			<td align="center" style="background-color: #ccc; color: black;">Eegees Tubs</td>
			<td>' . $budget['eegees'] . '</td><td>' . $awarded_eegees . '</td><td>' . ($budget['eegees'] - $awarded_eegees) . '</td>
		</tr>
		<tr>
			<td align="center" style="background-color: #ccc; color: black;">Soda</td>
			<td>' . $budget['soda'] . '</td><td>' . $awarded_beverages . '</td><td>' . ($budget['soda'] - $awarded_beverages) . '</td>
		</tr>
		</table>' . "\n<hr />\n<br />" . $display;
	break;
}

page_finish();
?>