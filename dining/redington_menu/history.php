<?php

// authenticate with WebAuth
$webauth_splash = '';
require_once('webauth/include.php');

// connect to database
include("mysql_link.inc");

// CHECK FOR VALID ACCESS
// include list of authorized users
include("webauth.php");

if (!$grantAccessAdmin) {

	echo "<p style=\"padding-top:20px; text-align:center;\">You are not on the list of authorized users. Please contact <a href=\"mailto:kmbeyer@email.arizona.edu\">kmbeyer@email.arizona.edu</a> if you need access or have questions.<br />&nbsp;<br />
	<a href=\"admin_menu.php\">Return to the Menu Editor</a></p>";
//	echo '<p style="padding-top:20px; text-align:center;"><a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/sumc/redingtonrestaurant/&logout_text=Return%20to%20Redington Menu">Logout of UA NetID WebAuth</a></p>';

	session_unset();
} else { // access has been granted so continue
		
// include menu settings
include("admin_menu_settings.php");

// select database
mysql_select_db("menus_redington", $DBlink)
	or die(mysql_error());

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Menu Admin Update Log ~ Redington Restaurant Menu System</title>
<link rel="stylesheet" type="text/css" href="admin_menu.css" />
</head>

<body>
<h1 style="text-align:center; margin-top:20px;">Redington Restaurant Menu System</h1>
<div style="width:980px; border:1px solid #CCC; margin:20px auto 0 auto;">
<h2>Menu Admin Update Log</h2>
<span style="padding-left:20px;"><a href="admin_menu.php">Return to Menu Editor</a></span>

<?php

if (!$_POST) {
	// default setting for history
	$defaultLimit = time() - (30 * 86400); // 30 days

	// query to get all events in the last 30 days
	$event = mysql_query("SELECT * FROM history_event WHERE timestamp > " . $defaultLimit . " ORDER BY timestamp DESC ");

} else if (is_numeric($_POST['age'])) {

	// calculate new limit setting for history
	$limit = time() - ($_POST['age'] * 86400); // 30 days

	// query to get all events in the last 30 days
	$event = mysql_query("SELECT * FROM history_event WHERE timestamp > " . $limit . " ORDER BY timestamp DESC ");

} else if ($_POST['age'] == 'all') {

	// query to get all events
	$event = mysql_query("SELECT * FROM history_event ORDER BY timestamp DESC ");

}

?>

	<div style="padding:10px 20px;">
		<div style="float:left">By default, this history only displays the last 30 days of edits. To view more records, select from the pulldown menu to the right.</div>
		<div style="float:right">
			<form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
				<select name="age" onChange="this.form.submit();">
					<option value="">Limit to...</option>
					<option<?= $_POST['age'] == '1' ? ' selected' : '' ?> value="1">1 day</option>
					<option<?= $_POST['age'] == '7' ? ' selected' : '' ?> value="7">7 days</option>
					<option<?= $_POST['age'] == '14' ? ' selected' : '' ?> value="14">14 days</option>										
					<option<?= $_POST['age'] == '30' ? ' selected' : '' ?> value="30">30 days</option>																		<option<?= $_POST['age'] == '60' ? ' selected' : '' ?> value="60">60 days</option>
					<option<?= $_POST['age'] == '90' ? ' selected' : '' ?> value="90">90 days</option>
					<option<?= $_POST['age'] == '180' ? ' selected' : '' ?> value="180">180 days</option>
					<option<?= $_POST['age'] == '365' ? ' selected' : '' ?> value="365">365 days</option>
					<option<?= $_POST['age'] == 'all' ? ' selected' : '' ?> value="all">No limit</option>
				</select>
			</form>
		</div>
		
		<br class="clear" />
		
		<table style="margin-top:5px;" cellpadding="0" class="history">
		<tr style="color:#ffffff; font-size:12px; background-color:#666666;">
			<th>#</th>
			<th>NetID</th>
			<th>Menu Name</th>
			<th>Soups</th>
			<th>Salads</th>
			<th>Entrees</th>
			<th>Sides</th>
			<th>Comments</th>
			<th>Time Stamp</th>
		</tr>
		
		<?php
		
		// init counter for alternating row colors
		$cnt = 1;
		
		// init counter for event count
		$i = 1;
		
		// init the flag to track whether we have any data or not
		$data = false;
		
		// loop through the event results
		while ($eventRow = mysql_fetch_array($event)) {

			echo "<tr valign=\"top\" style=\"font-size:10px;"; if($cnt%2 == 0) { echo "background-color:#efefef;\">"; } else { echo "\">"; }
			echo '<td class="history">' . $i . '</td>
			<td class="history">' . $eventRow['netID'] . '</td>
			<td class="history">' . $eventRow['menu'] . '<br /><br />Visible: ' . $eventRow['display'] . '</td>';
			

			// query to get all soups updated during a specific event
			$eventSoup = mysql_query("SELECT * FROM history_event_content WHERE id = '" . $eventRow['id'] . "' AND dishID = " . $soups . " ");
			
			echo '<td class="history"><ol class="historyNums">';
			while ($eventSoupRow = mysql_fetch_array($eventSoup)) {
				echo '<li>' . $eventSoupRow['name'] . '</li>';
			}
			echo '</ul></td>';


			// query to get all salads updated during a specific event
			$eventSalad = mysql_query("SELECT * FROM history_event_content WHERE id = '" . $eventRow['id'] . "' AND dishID = " . $salads . " ");
			
			echo '<td class="history"><ol class="historyNums">';
			while ($eventSaladRow = mysql_fetch_array($eventSalad)) {
				echo '<li>' . $eventSaladRow['name'] . '</li>';
			}
			echo '</ul></td>';


			// query to get all entrees updated during a specific event
			$eventEntree = mysql_query("SELECT * FROM history_event_content WHERE id = '" . $eventRow['id'] . "' AND dishID = " . $entrees . " ");

			echo '<td class="history"><ol class="historyNums">';			
			while ($eventEntreeRow = mysql_fetch_array($eventEntree)) {
				echo '<li>' . $eventEntreeRow['name'] . '</li>';
			}
			echo '</ul></td>';
			
			
			// query to get all sides updated during a specific event
			$eventSide = mysql_query("SELECT * FROM history_event_content WHERE id = '" . $eventRow['id'] . "' AND dishID = " . $sides . " ");

			echo '<td class="history"><ol class="historyNums">';			
			while ($eventSideRow = mysql_fetch_array($eventSide)) {
				echo '<li>' . $eventSideRow['name'] . '</li>';
			}
			echo '</ul></td>';


			// query to get all comments updated during a specific event
			$eventComment = mysql_query("SELECT comments FROM history_event_content WHERE id = '" . $eventRow['id'] . "' ");

			echo '<td class="history">';			
			while ($eventCommentRow = mysql_fetch_array($eventComment)) {
				echo $eventCommentRow['comments'];
			}
			echo '</td>';

			echo '<td class="history">' . date("m/d/Y g:i:s A", $eventRow['timestamp']) . '</td>';
			echo '</tr>';


		// increment the counters
		$i++;
		$cnt++;
		
		$data = true;

		} // END while ($eventRow = mysql_fetch_array($event))

		if (!$data) {
			echo '<tr><td colspan="9" style="color:#ff0000;">No results. Please try again.</td></tr>';
		}
		
		?>		
		
		</table>
		
	</div>

</div>

</body>
</html>

<?php
} // END IF for granting access
?>