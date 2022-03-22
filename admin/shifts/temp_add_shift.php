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
<!--For JQuery Datepicker and Timepicker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="prototype.js"></script>
<SCRIPT LANGUAGE="javascript">
// JQuery Datepicker
$( function() {
$( "#datepicker" ).datepicker();
} );
// JQuery Timepicker
$(document).ready(function(){
    $('input.timepicker').timepicker({});
});

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
	var url = 'select_task.php';
	var postData = "id=" + id;
	var placeholder = "show_requirements_" + id;
	var myUpdater = new Ajax.Updater(placeholder,url,{method:'get',parameters:postData});
	}
</SCRIPT>

<body>
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
		  <input type="radio" name="event" value="Other" onClick="checkShift(3)" >&nbsp;Other&nbsp;&nbsp;&nbsp;</div>
	  </td>
    </tr>
    <tr>
	  <td><div class="text_bold">LOCATION <span class="asterisk">*</span></div></td>
      <td>
		  <div id="show_location">
		  <select name="location" id="location" class="text">
			  <option value="0">Select Location</option>
			  <option value="0">=====================</option>
			  <option value="1">Einstein Bros Bagels</option>
			  <option value="2">On Deck Deli</option>
			  <option value="3">Global Market</option>
			  <option value="4">85 North</option>
			  <option value="5">Other</option>
		  </select>
		  </div>
	  </td>
    </tr>
    <tr>
      <td><div class="text_bold">DATE <span class="asterisk">*</span></div></td>
      <td><input type="text" id="datepicker" name="shift_date" required></td>
    </tr>
    <tr>
      <td><div class="text_bold">TIME <span class="asterisk">*</span></div></td>
      <td>FROM: <input id="timepicker" class="timepicker" name="timefrom" size="10" required />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  TO: <input id="timepicker" class="timepicker" name="timeto" size="10" required />
	  </td>
    </tr>
    <tr>
      <td><div class="text_bold">NUMBER OF POSITIONS <span class="asterisk">*</span></div></td>
      <td><input class="text-align" type="text" name="num_positions" id="num_positions" value="1" size="5" required></td>
    </tr>
    <tr>
      <td valign="top"><div class="text_bold">SHIFT SUPERVISOR <span class="asterisk">*</span></div></td>
      <td><div class="text">
		  <table width="80%" border="0" cellspacing="0" cellpadding="3">
			  <tbody>
				<tr>
				  <td>
				  <input type="radio" name="supervisor" value="emily" required>&nbsp;Emily Romero <br />
				  <input type="radio" name="supervisor" value="lupita">&nbsp;Lupita Hollis <br />
				  <input type="radio" name="supervisor" value="angelica">&nbsp;Angelica Osuna <br />
				  <input type="radio" name="supervisor" value="michelle">&nbsp;Michelle Ward</div>
			  	  </td>
				  <td valign="top">
				  <input type="radio" name="supervisor" value="judy" required>&nbsp;Judy Stout <br />
				  <input type="radio" name="supervisor" value="beaney">&nbsp;Beaney Cota<br />
				  <input type="radio" name="supervisor" value="stephanie">&nbsp;Stephanie Bixby <br />
			  	  </td>
				</tr>
			  </tbody>
			</table>	  
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
		  <input type="checkbox" name="task" value="<?=$row['id']?>" onClick="selectTasks(<?=$row['id']?>)" required>&nbsp;<?=$row['task']?>&nbsp;&nbsp;&nbsp;
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
