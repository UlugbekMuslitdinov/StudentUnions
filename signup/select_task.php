<?php
// Variables from AJAX
$shift_id = $_GET['shiftid'];
$task_id = $_GET['taskid'];
$st_id = $_GET['stid'];
$checked = $_GET['checked'];

// Display Requirements if checked.
if ($checked == 1) {
	// Database connection
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	$db = new db_mysqli('signup');	

	// Get Requirement this id.
	$query = "SELECT R.id, requirement, name FROM TasksRequirements TR LEFT JOIN Requirements R ON TR.requirement_id = R.id WHERE TR.task_id = " . $task_id . " ORDER BY requirement ASC";
	$requirements = $db->query($query);
	?>
	
	<?php 
	while($row = mysqli_fetch_array($requirements, MYSQLI_ASSOC)) { 
	// If requirement is assigned for this task.	
	if ($row['id'] > 0) {
	?>
	<!--Display requirement list if any.-->
	
	<div style="margin-left:10px;">
	  <input type="hidden" name="requirement[]" id="requirement_<?=$row['id']?>" value="<?=$shift_id?>Shiftx<?=$row['id']?>yTask_<?=$task_id?>" >&nbsp;REQUIREMENT: <span class="text_bold"><?=$row['requirement']?></span>
	</div>
	<div style="margin-left:50px;">Do you fulfill the requirement?&nbsp;&nbsp;&nbsp;  
	<input type="radio" name="filled_<?=$row['id']?>" id="filled1_<?=$row['id']?>" value="Yes" onClick="selectFulfill(<?=$row['id']?>);">&nbsp;YES&nbsp;&nbsp;&nbsp;
	<input type="radio" name="filled_<?=$row['id']?>" id="filled2_<?=$row['id']?>" value="No" onClick="selectFulfill(<?=$row['id']?>);">&nbsp;NO&nbsp;&nbsp;&nbsp;
	<input type="radio" name="filled_<?=$row['id']?>" id="filled3_<?=$row['id']?>" value="Maybe" onClick="selectFulfill(<?=$row['id']?>);">&nbsp;MAYBE&nbsp;&nbsp;&nbsp;
	</div>
<?php } } } ?>



