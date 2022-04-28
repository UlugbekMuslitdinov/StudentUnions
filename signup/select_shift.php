<?php
// Variables from AJAX
$shift_id = $_GET['id'];
$checked = $_GET['checked'];

// Display Requirements if checked.
if ($checked == 1) {
	// Database connection
	require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	$db = new db_mysqli('signup');

	// Display the list of Tasks.
	$query = "SELECT *, T.id AS task_id, ST.id AS st_id, task, ST.shift_id AS shift_id 
				FROM Tasks T 
				LEFT JOIN ShiftsTasks ST ON T.id = ST.task_id 
				WHERE shift_id = " . $shift_id . " ORDER BY task ASC";
	$tasks = $db->query($query);	// For the Task list.
?>
	<div style="margin-left:20px;">You can sign up for multiple positions you want. The supervisor will assign a position as needed.</div>
	<?php
	while ($row = mysqli_fetch_array($tasks, MYSQLI_ASSOC)) {
	?>
		<div style="margin-left:25px;">
			<input type="checkbox" name="task[]" id="task_<?= $row['st_id'] ?>" value="<?= $shift_id ?>Shift-Task_<?= $row['task_id'] ?>" onClick="selectTasks(<?= $shift_id ?>, <?= $row['task_id'] ?>, <?= $row['st_id'] ?>)">&nbsp;<span class="text_bold"><?= $row['task'] ?></span>&nbsp;&nbsp;&nbsp;
		</div>
		<!--This is the placeholder for requirements. -->
		<div style="margin-left:50px;" id="show_requirements_<?= $row['st_id'] ?>"></div>
<?php }
} ?>