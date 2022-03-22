<?php
// Variables from AJAX
$shift_id = $_GET['id'];
$checked = $_GET['checked'];

// Display Requirements if checked.
if ($checked == 1) {
	// Database connection
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	$db = new db_mysqli('signup');	

	// Display the list of Tasks.
	$query = "SELECT *, T.id AS task_id, ST.id AS st_id, task FROM Tasks T LEFT JOIN ShiftsTasks ST ON T.id = ST.task_id WHERE shift_id = " . $shift_id . " ORDER BY task ASC";
	$tasks = $db->query($query);	// For the Task list.
	
	while($row = mysqli_fetch_array($tasks, MYSQLI_ASSOC)) { 
	?>
	<div style="margin-left:25px;">
	  <input type="checkbox" name="task[]" id="task_<?=$row['st_id']?>" value="<?=$row['task_id']?>" onClick="selectTasks(<?=$row['task_id']?>, <?=$row['st_id']?>)" >&nbsp;<?=$row['task']?>&nbsp;&nbsp;&nbsp;
	</div>
	<!--This is the placeholder for requirements. -->
	<div style="margin-left:50px;" id="show_requirements_<?=$row['st_id']?>"></div>	
<?php } } ?>
