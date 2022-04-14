<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Add Shift';
page_start($page_options);	
session_start();
// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	
?>
<link rel="stylesheet" href="shifts.css">
<!--We need this for the AJAX calls.--> 
<script type="text/javascript" src="prototype.js"></script>
<SCRIPT LANGUAGE="javascript">
// Check form.
function checkForm() {
  // Form validation goes here.
  return true;
}
	
// Display Locations depending on SHIFT selection.
function checkShift(num) {
	var url = 'select_shift.php';
	var postData = "num=" + num;
	var placeholder = "show_location";
	var myUpdater = new Ajax.Updater(placeholder,url,{method:'get',parameters:postData});
	}

// Display Requirements depending on Task selection.
function selectTasks(id) {
	var isChecked = document.getElementById("task_" + id).checked;
	if (isChecked === true) {
		var checked = 1;	// Display Requirements if checked.
	} else {
		var checked = 0;	// Hide Requirements if unchecked.
	}
	var url = 'select_task.php';
	var postData = "id=" + id + "&checked=" + checked;
	var placeholder = "show_requirements_" + id;
	var myUpdater = new Ajax.Updater(placeholder,url,{method:'get',parameters:postData});
	}
</SCRIPT>

<body>
<div style="margin-top:50px; margin-bottom: 20px;"><a href="index.php"><button class="navigation">SHIFT LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_shift.php"><button class="navigation">ADD SHIFT</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="employees.php"><button class="navigation">EMPLOYEE LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div class="col-12 page_title">Add Shift</div>
<div class="order-form">
<form name="form" class="form-inline" action="insert_shift.php" method="POST" onSubmit="return checkForm();">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tbody>
    <tr>
      <td width="300"><div class="text_bold">SHIFT <span class="asterisk">*</span></div></td>
      <td><div class="text">
		  <input type="radio" name="event" value="Dining" onClick="checkShift(1)" checked required>&nbsp;Dining&nbsp;&nbsp;&nbsp;
		  <input type="radio" name="event" value="Catering" onClick="checkShift(2)" >&nbsp;Catering&nbsp;&nbsp;&nbsp;
		   <input type="radio" name="event" value="Kitchen" onClick="checkShift(3)" >&nbsp;Kitchen&nbsp;&nbsp;&nbsp;
		  <input type="radio" name="event" value="Other" onClick="checkShift(9)" >&nbsp;Other&nbsp;&nbsp;&nbsp;</div>
	  </td>
    </tr>
<?php
// Display the list of available shifts.
$query = "SELECT * FROM Locations WHERE id NOT IN (998, 999) ORDER BY location ASC";
// 998 - Catering Dock
// 999 - Other
$locations = $db->query($query);
// Display the list of Shift supervisors.
$query2 = "SELECT * FROM Shiftsupervisors ORDER BY category ASC, first_name ASC";
$shiftsupervisors = $db->query($query2);
?>
    <tr>
	  <td><div class="text_bold">LOCATION <span class="asterisk">*</span></div></td>
      <td>
		  <div id="show_location">
		  <select name="location" id="location" class="text">
			  <option value="0">Select Location</option>
			  <option value="0">=====================</option>
			  <?php
				while($row = mysqli_fetch_array($locations, MYSQLI_ASSOC)) { 
			  ?>
			  <option value="<?=$row['id']?>"><?=$row['location']?></option>
			  <?php } ?>
		  </select>
		  </div>
	  </td>
    </tr>
    <tr>
      <td><div class="text_bold">DATE <span class="asterisk">*</span></div></td>
      <td><input type="date" id="datepicker" name="shift_date" required></td>
    </tr>
    <tr>
      <td><div class="text_bold">TIME <span class="asterisk">*</span></div></td>
      <td>
		  FROM: <input type="time" id="timepicker" class="timepicker" name="timefrom" size="10" value="09:00" required />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  TO: <input type="time" id="timepicker" class="timepicker" name="timeto" size="10" value="17:00" required />
	  </td>
    </tr>
    <tr>
      <td><div class="text_bold">NUMBER OF POSITIONS <span class="asterisk">*</span></div></td>
      <td><input class="text-align" type="text" name="num_positions" id="num_positions" value="1" size="5" required></td>
    </tr>
    <tr>
      <td valign="top"><div class="text_bold">SHIFT SUPERVISOR <span class="asterisk">*</span></div></td>
      <td>
		  <div id="shiftsupervisors">
		  <select name="shiftsupervisor" id="shiftsupervisor" class="text">
			  <option value="0">Select Shift Supervisor</option>
			  <option value="0">=====================</option>
			  <?php
				while($row = mysqli_fetch_array($shiftsupervisors, MYSQLI_ASSOC)) { 
			  ?>
			  <option value="<?=$row['id']?>"><?=$row['first_name']?> <?=$row['last_name']?> - <?=$row['category']?></option>
			  <?php } ?>
		  </select>
		  </div>  
	  </td>
    </tr>
	<tr>
	  <td><div class="text_bold">URGENT <span class="asterisk">*</span></div></td>
      <td><div class="text">
		  <input type="radio" name="urgent" value="1" required>&nbsp;Yes&nbsp;&nbsp;&nbsp;
		  <input type="radio" name="urgent" value="0" checked >&nbsp;No&nbsp;&nbsp;&nbsp;</div>
	  </td>
    </tr>
<?php
// Display the list of Tasks.
$query = "SELECT * FROM Tasks ORDER BY task ASC";
$tasks = $db->query($query);	// For the Task list.
$tasks2 = $db->query($query);	// For the Placeholder.  The same query can't be used twice.
?>
	<tr>
	  <td valign="top"><div class="text_bold">TASKS <span class="asterisk">*</span></div></td>
      <td><div class="text">
		<div class="text">
		<?php
		while($row = mysqli_fetch_array($tasks, MYSQLI_ASSOC)) { 
		?>
		  <input type="checkbox" name="task[]" id="task_<?=$row['id']?>" value="<?=$row['id']?>" onClick="selectTasks(<?=$row['id']?>)" >&nbsp;<?=$row['task']?>&nbsp;&nbsp;&nbsp;
		<?php } ?>
		</div>
		<!--This is the placeholder for requirements. -->
		<?php
		while($row = mysqli_fetch_array($tasks2, MYSQLI_ASSOC)) { 
		?>
		<div id="show_requirements_<?=$row['id']?>"></div>
		<?php } ?>
	  </td>
    </tr>
	
    <tr>
      <td><div class="text_bold">ADD NOTE</div>This will be included in the email notification<br /> to the shift applicant.</td>
      <td><textarea name="note" cols="100%" rows="5" id="note" ></textarea></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" class="button" value="SUBMIT" id="submit"></td>
    </tr>
  </tbody>
</table>
</form>
</div>
</div>
</body>
<?php page_finish(); ?>
