<?php
session_start();
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netid = $_SESSION['webauth']['netID'];
// $netid = "test25";
$_SESSION["netid"] = $netid;

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Shift Signup';
page_start($page_options);	

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');

// Check if the record exists for this NetID.
$query = "SELECT * FROM Employees WHERE netid = '" . $netid . "'";
$result = $db->query($query);
$record = mysqli_fetch_assoc($result);
// Check if this NetID already exists in the database.

if ($record['id'] > 0) {		// If YES, pre-load the records on the form.
	$employee_id = $record['id'];
	$first_name = $record['first_name'];
	$last_name = $record['last_name'];
	$email = $record['email'];
	$phone = $record['phone'];
	$affiliation = $record['affiliation'];
	// Get the suprevisor record.
	$query = "SELECT * FROM Supervisors WHERE id = " . $record['supervisor_id'] . "";
	$record = $db->query($query);
	$supervisor = mysqli_fetch_assoc($record);
	$supervisor_id = $supervisor['id'];
	$supervisor_first_name = $supervisor['first_name'];
	$supervisor_last_name = $supervisor['last_name'];
	$select_supervisor = "Or Change Supervisor";
} else {						
	$first_name = "";
	$last_name = "";
	$email = "";
	$phone = "";
	$affiliation = "";
	$supervisor = "";
	$select_supervisor = "Select Supervisor";
}


// Get the list of supervisors.
$query = "SELECT * FROM Supervisors ORDER BY first_name ASC";
$supervisors = $db->query($query);
?>
<link rel="stylesheet" href="shifts.css">
<!--We need this for the AJAX calls.--> 
<script type="text/javascript" src="prototype.js"></script>
<script>
function setFocusToTextBox(){
	document.getElementById('first_name').focus();
}
	
// Display Tasks for this Shift.
function checkShift(id) {	
	var isChecked = document.getElementById("shift_" + id).checked;
	if (isChecked === true) {
		var checked = 1;	// Display Requirements if checked.
	} else {
		var checked = 0;	// Hide Requirements if unchecked.
	}
	var url = 'select_shift.php';
	var postData = "id=" + id + "&checked=" + checked;
	var placeholder = "show_tasks_" + id;
	var myUpdater = new Ajax.Updater(placeholder,url,{method:'get',parameters:postData});
	}

// Display Tasks for this Shift.
function selectTasks(shiftid, taskid, stid) {
	var isChecked = document.getElementById("task_" + stid).checked;
	if (isChecked === true) {
		var checked = 1;	// Display Requirements if checked.
	} else {
		var checked = 0;	// Hide Requirements if unchecked.
	}
	var url = 'select_task.php';
	var postData = "shiftid=" + shiftid + "&taskid=" + taskid + "&stid=" + stid + "&checked=" + checked;
	var placeholder = "show_requirements_" + stid;
	var myUpdater = new Ajax.Updater(placeholder,url,{method:'get',parameters:postData});
	}
	
// Select the Requirement checkbox on Yes/No/Maybe.
function selectFulfill(id) {
	var requirement_checkbox = document.getElementById("requirement_" + id);
	// var requirement = document.getElementById("filled1_" + id).checked;
	if (requirement_checkbox.checked === false) {
		requirement_checkbox.checked = true;	// Check Requirement Checkbox.
	} 
}
	
// Check form.
function checkForm() {
  // Form validation goes here.
  return true;
}
</script>
<body onload='setFocusToTextBox()'>
<div class="page_title">Shift Signup</div>
<div>
<form class="form-inline" action="insert_signup.php" method="POST" onSubmit="return checkForm();">
<div class="major_heading">Personal Information</div>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tbody>
    <tr>
      <td width="300"><div class="text_bold">FIRST NAME <span class="asterisk">*</span></div></td>
      <td><input type="text" class="text" name="first_name" id="first_name" size="40" value="<?php echo $first_name; ?>" required></td>
    </tr>
    <tr>
	  <td><div class="text_bold">LAST NAME <span class="asterisk">*</span></div></td>
      <td><input type="text" class="text" name="last_name" id="last_name" size="40" value="<?php echo $last_name; ?>" required></td>
    </tr>
    <tr>
      <td><div class="text_bold">EMAIL <span class="asterisk">*</span></div></td>
      <td><input type="text" class="text" name="email" id="email" size="40" value="<?php echo $email; ?>" required></td>
    </tr>
    <tr>
      <td><div class="text_bold">PHONE <span class="asterisk">*</span></div></td>
      <td><input type="text" class="text" name="phone" id="phone" size="40" value="<?php echo $phone; ?>" required></td>
    </tr>
    <tr>
      <td><div class="text_bold">YOUR AFFILIATION <span class="asterisk">*</span></div></td>
      <td><div class="text">
		  <input type="radio" name="affiliation" value="Student Unions" <?php if ($affiliation == "Student Unions") { echo "checked"; }; ?> required>&nbsp;Student Unions&nbsp;&nbsp;&nbsp;
		  <input type="radio" name="affiliation" value="Bookstore" <?php if ($affiliation == "Bookstore") { echo "checked"; }; ?>>&nbsp;Bookstore&nbsp;&nbsp;&nbsp;
		  <input type="radio" name="affiliation" value="Parking and Transportation" <?php if ($affiliation == "Parking and Transportation") { echo "checked"; }; ?>>&nbsp;Parking and Transportation&nbsp;&nbsp;&nbsp;
		  <input type="radio" name="affiliation" value="Other" <?php if ($affiliation == "Other") { echo "checked"; }; ?>>&nbsp;Other&nbsp;&nbsp;&nbsp;</div>
	  </td>
    </tr>
    <tr>
      <td><div class="text_bold">YOUR SUPERVISOR <span class="asterisk">*</span></div></td>
      <td><div class="text">
		  <select name="supervisor" id="supervisor" class="text">
			  <option value="<?=$supervisor_id?>"><?=$supervisor_first_name?> <?=$supervisor_last_name?></option>
			  <option value="0"><?=$select_supervisor?></option>
			  <option value="0">=====================</option>
			  <?php
				while($row = mysqli_fetch_array($supervisors, MYSQLI_ASSOC)) { 
			  ?>
			  <option value="<?=$row['id']?>"><?=$row['first_name']?> <?=$row['last_name']?></option>
			  <?php
				}
			  ?>
			  <option value="999">Other</option>
		  </select>
		  </div>
	  </td>
    </tr>
  </tbody>
</table>

<?php 
// Display the Shift list in checkboxes.
if ($employee_id > 0) {
// If this employee record exists, don't display the shifts already applied.
$query = "SELECT S.*, location FROM Shifts S LEFT JOIN Locations L ON S.location_id = L.id  WHERE S.id NOT IN (SELECT shift_id FROM Signups WHERE employee_id = " . $employee_id . ") ORDER BY shift_date DESC";
		
// Display already applied shifts.
$query_signup = "SELECT S.*, location, employee_id, status FROM Shifts S LEFT JOIN Locations L ON S.location_id = L.id RIGHT JOIN Signups SU ON S.id = SU.shift_id WHERE employee_id = " . $employee_id . " ORDER BY shift_date DESC;";	
?> 
<div class="choose_shift">
<div class="major_heading">Requested Shift</div>
<?php
$pending_shifts = $db->query($query_signup);	
// Check if records exist.	
if (mysqli_num_rows($pending_shifts)==0) { 
?>
<div class="isnull">No record.  You haven't signed up.</div>
<?php
} else {
// Display alreay signed up shifts.	
while($row = mysqli_fetch_array($pending_shifts, MYSQLI_ASSOC)) { 
?>
<div class="text"><img src="images/check.png" width="13px;" />&nbsp;&nbsp;<a href="view_signups.php?id=<?=$row['id']?>&employee_id=<?=$row['employee_id']?>"><span class="shift_date"><u><?=$row['shift_date']?></u></span> (<?=$row['time_from']?> - <?=$row['time_to']?>)</a> at <span class="location"><?=$row['location']?></span> (<?=$row['event']?>) <?php /*?>- <span class="text_bold_red"><?=$row['status']?></span><?php */?></div>
<?php
}
}
?>
<?php }
	else {
$query = "SELECT S.*, location FROM Shifts S LEFT JOIN Locations L ON S.location_id = L.id ORDER BY shift_date ASC";
}
$shifts = $db->query($query);
?>
<div class="choose_shift">
<div class="major_heading">Choose Shift</div>
<?php
while($row = mysqli_fetch_array($shifts, MYSQLI_ASSOC)) { 

?>
<div class="text"><input class="major_heading" type="checkbox" name="shift[]" id="shift_<?=$row['id']?>" value="<?=$row['id']?>" onClick="checkShift(<?=$row['id']?>)" >&nbsp;&nbsp;<span class="choose_shift_date"><?=$row['shift_date']?></span> (<?=$row['time_from']?> - <?=$row['time_to']?>) at <span class="location"><?=$row['location']?></span> (<?=$row['event']?>) - <span class="num_positions"><?=$row['num_positions']?></span> Available <?php if ($row['urgent'] == 1) { ?> &nbsp;&nbsp;&nbsp;<img src="images/urgent.png" height="40px" /> <?php } ?></div>
	<div id="show_tasks_<?=$row['id']?>"><!--The Tasks will be displayed here.--></div>
<?php
}
?>
</div>
</div>
	
<div class="form-group col-sm-12">
<input type="submit" name="submit" class="button" value="SUBMIT" id="submit">
</div><br />
</form>
</div>

</div>
</body>
<?php page_finish(); ?>
