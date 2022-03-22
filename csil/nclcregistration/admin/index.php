<?php
/*
 * NCLC Registration
 * Created October, 2009
 */

// Force WWW for webauth
/*if (!strstr($_SERVER['HTTP_HOST'], 'jsosa') && !strstr($_SERVER['HTTP_HOST'], 'elvis.sunion') && !strstr($_SERVER['HTTP_HOST'], 'www.'))
{
	header('Location: http://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	exit;
}*/

define('ACCESS', true);
include('../include.php');
include('../common/page_start.php');

// Authenticate
start_webauth($admin);

echo '<style type="text/css">
td {font-size: 10px;}
th {font-size: 10px; background-color: #ccc; color: black; text-align: center;}
.order {color: white;}
.clickable {cursor: pointer;}
.medium {font-size: 12px;}
blockquote {margin-top: 0; margin-bottom: 0;}
</style>
<div class="medium" align="right"><a href="?p">Main</a> | <a href="?p=search">Search</a> | <a href="dump.php">Excel</a></div>';
// | <a href="?p=archive">Archive</a>

switch ($page)
{
	case 'view':
		if (isset($_POST['save']))
		{
			$paid = intval($_POST['paid']);
			$updated = time();
			$updated_name = $_SESSION['webauth']['netID'];
			
			// Guest information
			$result = mysql_query("SELECT * FROM guests WHERE id = $id");
			$guest_info = mysql_fetch_assoc($result);
			
			$sql = "UPDATE guests SET paid = $paid, updated = $updated, updated_name = '$updated_name' WHERE code = '{$guest_info['code']}'";
			mysql_query($sql) or die(mysql_error());
			
			echo '<h3 align="center">Guests Successfully Updated!</h3>';
		}
		
		// Guest information
		$result = mysql_query("SELECT * FROM guests WHERE id = $id");
		$guest_info = mysql_fetch_assoc($result);
		
		if (!$guest_info)
		{
			echo '<h1>Invalid ID!</h1>';
		}
		else
		{
			$result = mysql_query("SELECT * FROM guests WHERE code = '{$guest_info['code']}' ORDER BY primary_contact DESC");
			
			while ($guest = mysql_fetch_assoc($result))
			{
				$primary_contact = $guest['primary_contact'];
				
				$updated = $guests_info['updated'];
				$updated_name = $guests_info['updated_name'];
				$email_sent = $guests_info['email_sent'];
				
				// Last updated
				echo ($primary_contact && !empty($updated)) ?  '<h5 align="center">Last Updated ' . date('F jS, Y', $updated) . ' by ' . $updated_name . '</h5>' : '';
				
				$header = (!$primary_contact || ($primary_contact && $guest['attend'] == 1)) ? 'Attendee Information' : 'Primary Contact Information';
				echo '<h4>' . $header . '</h4><hr />',
				($primary_contact ? '<form method="post">' : ''),
				'<table width="70%" cellpadding="5" cellspacing="3" border="0">';
				if ($primary_contact)
				{
					echo '<tr>
					  <td align="right"><strong>Submitted</strong></td>
					  <td>' . date('F j, Y \a\t g:ia', $guest['time']) . '</td>
					</tr>';
				}
				echo '<tr>
				  <td width="25%" align="right"><strong>First Name</strong></td>
				  <td>' . $guest['firstname'] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>Last Name</strong></td>
				  <td>' . $guest['lastname'] . '</td>
				</tr>';
				if (!$primary_contact || ($primary_contact && $guest['attend'] == 1))
				{
					echo '<tr>
					  <td align="right"><strong>Age</strong></td>
					  <td>' . $guest['age'] . '</td>
					</tr>
					<tr>
					  <td align="right"><strong>Gender</strong></td>
					  <td>' . $genders[$guest['gender']] . '</td>
					</tr>
					<tr>
					  <td align="right"><strong>Attendee Type</strong></td>
					  <td>' . $classes[$guest['class']] . '</td>
					</tr>
					<tr>
					  <td align="right"><strong>Meal Type</strong></td>
					  <td>' . $meals[$guest['meal']] . '</td>
					</tr>
					<tr>
					  <td align="right"><strong>Meal Type Specifics</td>
					  <td>' . $guest['mealetc'] . '</td>
					</tr>
					<tr>
					  <td align="right"><strong>T-Shirt Size</strong></td>
					  <td>' . $shirts[$guest['shirt']] . '</td>
					</tr>
					<tr>
					  <td align="right"><strong>Sandwich Type</strong></td>
					  <td>' . $sandwiches[$guest['sandwich']] . '</td>
					</tr>';
				}
				echo '<tr>
				  <td align="right"><strong>School</strong></td>
				  <td>' . $schools[$guest['school']] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>School Other</strong></td>
				  <td>' . $guest['schooletc'] . '</td>
				</tr>';
				if (!$primary_contact || ($primary_contact && $guest['attend'] == 1))
				{
					echo '<tr>
					  <td align="right"><strong>International</strong></td>
					  <td>' . $options[$guest['international']] . '</td>
					</tr>
					<tr>
					  <td align="right"><strong>Country (If International)</strong></td>
					  <td>' . $guest['country'] . '</td>
					</tr>';
				}
				echo '<tr>
				  <td align="right"><strong>Organizaiton</strong></td>
				  <td>' . $organizations[$guest['organization']] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>Email address</strong></td>
				  <td>' . $guest['email'] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>Daytime Phone</strong></td>
				  <td>' . $guest['phone'] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>Address Line 1</strong></td>
				  <td>' . $guest['address1'] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>Address Line 2</strong></td>
				  <td>' . $guest['address2'] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>City</strong></td>
				  <td>' . $guest['city'] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>State</strong></td>
				  <td>' . $guest['state'] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>ZIP</strong></td>
				  <td>' . $guest['zip'] . '</td>
				</tr>
				<tr>
				  <td align="right"><strong>Attend</strong></td>
				  <td>' . $options[$guest['attend']] . '</td>
				</tr>';
				if ($primary_contact)
				{
					echo '<tr>
					  <td class="main" align="right"><strong>Host</strong></td>
					  <td class="main">' . $guest['host'] . '</td>
					</tr>
					<tr>
					  <td class="main" align="right"><strong>Cost</strong></td>
					  <td class="main">$' . $guest['cost'] . '</td>
					</tr>
					<tr>
					  <td class="main" align="right"><strong>Paid</strong></td>
					  <td class="main"><select name="paid">';
					foreach ($options as $key => $value)
					{
						$selected = ($key == $guest['paid']) ? ' selected="selected"' : '';
						echo "<option value=\"$key\"$selected>$value</option>\n";
					}
					echo '</td>
					</tr>
					<tr>
					  <td class="main" align="right"><strong>Pay Type</strong></td>
					  <td class="main">' . $guest['paytype'] . '</td>
					</tr>';
				}
				echo '</table>',
				($primary_contact ? '<input type="submit" name="save" value="Update Information">' : ''),
				'</form>
				<hr />';
			}
		}
	break;
	
	case 'archive':
		echo '<h1>NCLC Archive</h1>';
		
		// Get all years
		$years = array();
		$result = mysql_query("SELECT time FROM guests");
		while ($row = mysql_fetch_assoc($result))
		{
			$years[] = push_fiscal($row['time']);
		}
		
		// Display unique years
		if (is_array($years))
		{
			$years = array_unique($years);
			echo '<ul>';
			foreach ($years as $y)
			{
				echo "\n<li><a href=\"?p&y=$y\">$y</a></li>";
			}
			echo "\n</ul>";
		}
		else
		{
			echo 'No years to display!';
		}
	break;
	
	case 'search':
		echo '<h2>NCLC Search</h2>
		<script type="text/javascript" src="../include.js"></script>';
		
		if (isset($_POST['submit']))
		{
			// Start/End time (Fiscal year)
			$start_time = mktime(0, 0, 0, 7, 1, $year - 1);
			$end_time = mktime(0, 0, 0, 6, 31, $year);
			
			// SQL setup
			$query = str_replace(',', '', clean_string($_POST['query']));
			$sql = "SELECT * FROM guests WHERE MATCH(firstname, lastname, email) AGAINST ('$query')";
			if ($_POST['attend'] != -1) $sql_opt[] = 'attend = ' . intval($_POST['attend']);
			if ($_POST['paid'] != -1) $sql_opt[] = 'paid = ' . intval($_POST['paid']);
			if ($_POST['paytype'] != -1) $sql_opt[] = "paytype = '" . clean_string($_POST['paytype']) . "'";
			$sql .= (!empty($sql_opt)) ? ' OR (' . implode(' AND ', $sql_opt) . ')' : '';
			$sql .= " AND time > $start_time AND time < $end_time ORDER BY time asc, primary_contact desc";
			echo $sql;
		
			// Sorting
			foreach ($orders as $o)
			{
				$cname = $o . '_click';
				$oname = $o . '_order';
				$$oname = ($order == $o) ? ' order' : '';
				$$cname = "window.location='?y=$year&o=$o&s=" . (($order == $o) ? (($sort == 'desc') ? 'asc' : 'desc') : 'desc') . "'";
			}
			
			// Main display
			echo '<table width="100%" cellpadding="5" cellspacing="1" border="0">
			<tr>
				<th class="clickable' . $time_order . '" onclick="' . $time_click . '">Date</th>
				<th width="20%">Name</th>
				<th width="25%">School</th>
				<th width="10%">Meal</th>
				<th width="10%">Attend</th>
				<th width="10%">Cost</th>
				<th width="10%">Paid</th>
				<th width="10%">Action</th>
			</tr>';
		
			$user_count = 0;
			$result = mysql_query($sql) or die(mysql_error());
			while ($row = mysql_fetch_assoc($result))
			{
				$guest_count++;
				$id = $row['id'];
				$firstname = $row['firstname'];
				$email = (!empty($row['email'])) ? $row['email'] : '&nbsp;';
				
				echo '<tr>
					<td>' . date('m/d/y', $row['time']) . '</td>
					<td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
					<td>' . $schools[$row['school']] . '</td>
					<td align="right">' . $meals[$row['meal']] . '</td>
					<td class="small" align="right">' . $options[$row['attend']] . '</td>
					<td class="small" align="right">$' . $row['cost'] . '</td>
					<td class="small" align="center">' . paid_color($row['paid']) . '</td>
					<td align="center"><a href="?p=view&id=' . $row['id'] . '">View</a></td>
				</tr>';
			}
		
			if (empty($guest_count))
			{
				echo '<tr><td colspan="7" align="center">No results found!</td></tr>';
			}
		
			echo "\n</table>\n\n";
		}
		
		if (!isset($_POST['submit']) || !empty($errors))
		{
			echo '<form method="post">
			<table>
			<tr><td>Keywords</td><td><input type="text" name="query" value="' . $keys . '"> (Checks firstname, lastname and email)</td></tr>
			<tr><td>Attend</td><td><select name="attend"><option value="-1">---</option>';
			foreach ($options as $key => $value)
			{
				echo "<option value=\"$key\">$value</option>\n";
			}
			echo '</select></td></tr>
			<tr><td>Paid</td><td><select name="paid"><option value="-1">---</option>';
			foreach ($options as $key => $value)
			{
				echo "<option value=\"$key\">$value</option>\n";
			}
			echo '</select></td></tr>
			<tr><td>Paid Type</td><td><select name="paytype"><option value="-1">---</option>';
			foreach ($paytypes as $key => $value)
			{
				echo "<option value=\"$key\">$value</option>\n";
			}
 			echo '</select></td></tr>
			<tr><td colspan="2"><input type="submit" name="submit" value="Submit"></td></tr>
			</table>
			</form>';
		}
	break;
	
	default:
		echo '<h2>NCLC Registrations</h2>
		<script type="text/javascript" src="../include.js"></script>';
		
		// Series counts
		$gen_count = 0;
		$shirt_count = array();
		$meal_count = array();
		$sandwhich_count = array();
		
		$result = mysql_query("SELECT meal, sandwich, shirt FROM guests WHERE attend = 1 and paid = 1");
		while ($row = mysql_fetch_assoc($result))
		{
			$gen_count++;
			if (NULL!=$sandwiches[$row['shirt']]){
				$shirt_count[] = @$shirts[$row['shirt']];
			}
			$meal_count[] = $meals[$row['meal']];
			if (NULL!=$sandwiches[$row['sandwich']]){
				$sandwich_count[] = $sandwiches[$row['sandwich']];
			}
		}
		$shirt_count = array_count_values($shirt_count);
		$meal_count = array_count_values($meal_count);
		$sandwich_count = array_count_values($sandwich_count);
		$global_total = global_total();
		
		echo '<table width="50%" cellpadding="5" cellspacing="1" border="0">
		<tr>
			<th style="background-color: #ccc; color: black;">Shirts</th>
			<th style="background-color: #ccc; color: black;">Meals</th>
			<th style="background-color: #ccc; color: black;">Sandwiches</th>
		</tr>
		<tr>
			<td>' . implode_assoc($shirt_count, array('outer_glue' => '<br />')) . '</td>
			<td>' . implode_assoc($meal_count, array('outer_glue' => '<br />')) . '</td>
			<td>' . implode_assoc($sandwich_count, array('outer_glue' => '<br />')) . '</td>
		</tr>
		</table>' . "\nTotal Paid & Attending: $gen_count | All Total: $global_total (Limit $conference_limit)<hr />\n<br />";
		
		// Sorting
		foreach ($orders as $o)
		{
			$cname = $o . '_click';
			$oname = $o . '_order';
			$$oname = ($order == $o) ? ' order' : '';
			$$cname = "window.location='?y=$year&o=$o&s=" . (($order == $o) ? (($sort == 'desc') ? 'asc' : 'desc') : 'desc') . "'";
		}
		
		// Main display
		echo '<table width="100%" cellpadding="3" cellspacing="1" border="0">
		<tr>
			<th class="clickable' . $time_order . '" onclick="' . $time_click . '">Date</th>
			<th width="20%" class="clickable' . $lastname_order . '" onclick="' . $lastname_click . '">Name</th>
			<th width="25%" class="clickable' . $school_order . '" onclick="' . $school_click . '">School</th>
			<th width="10%" class="clickable' . $meal_order . '" onclick="' . $meal_click . '">Meal</th>
			<th width="10%" class="clickable' . $attend_order . '" onclick="' . $attend_click . '">Attend</th>
			<th width="10%" class="clickable' . $host_order . '" onclick="' . $host_click . '">Host</th>
			<th width="10%" class="clickable' . $cost_order . '" onclick="' . $cost_click . '">Cost</th>
			<th width="10%" class="clickable' . $paid_order . '" onclick="' . $paid_click . '">Paid</th>
			<th width="10%">Action</th>
		</tr>';
		
		// Limits
		$limit = 15;
		$limval = $count * $limit - $limit;
		
		// Start/End time (Fiscal year)
		$start_time = mktime(0, 0, 0, 7, 1, $year - 1);
		$end_time = mktime(0, 0, 0, 6, 31, $year);
		$result = mysql_query("SELECT * FROM guests WHERE time > $start_time AND time < $end_time ORDER BY time asc, primary_contact desc LIMIT $limval, $limit");
		while ($row = mysql_fetch_assoc($result))
		{
			$style = ($row['primary_contact'] == 1) ? ' class="main"' : '';
			
			echo '<tr>',
				($row['primary_contact'] == 1 ? '<td' . $style . '>' . date('m/d/y', $row['time']) . '</td>' : '<td>&nbsp;</td>'),
				'<td' . $style . '>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
				<td' . $style . '>' . $schools[$row['school']] . '</td>
				<td' . $style . ' align="center">' . $meals[$row['meal']] . '</td>
				<td' . $style . ' align="center">' . $options[$row['attend']] . '</td>',
				($row['primary_contact'] == 1 ? '<td' . $style . ' align="center">' . $row['host'] . '</td>' : '<td>&nbsp;</td>'),
				($row['primary_contact'] == 1 ? '<td' . $style . ' align="center">$' . $row['cost'] . '</td>' : '<td>&nbsp;</td>'),
				($row['primary_contact'] == 1 ? '<td' . $style . ' align="center">' . paid_color($row['paid']) . '</td>' : '<td>&nbsp;</td>'),
				'<td' . $style . ' align="center"><a href="?p=view&id=' . $row['id'] . '">View</a></td>
			</tr>';
		}
		
		// No records
		if (mysql_affected_rows() == 0)
		{
			echo '<tr><td colspan="6" align="center"><strong>No data for this year!</strong></td></tr>';
		}
		
		echo '</table><div class="medium" align="center">';
		pagination('guests', $limit, $file, "ORDER BY $order $sort");
		echo '</div>';
	break;
}

include('../common/page_end.php');
?>