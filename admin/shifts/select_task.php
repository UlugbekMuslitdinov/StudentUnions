<?php
// Variables from AJAX
$task_id = $_GET['id'];
$checked = $_GET['checked'];

// Display Requirements if checked.
if ($checked == 1) {
	// Database connection
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
	$db = new db_mysqli('signup');	

	// Get Task for this id.
	$query = "SELECT T.id, task, requirement FROM Tasks T LEFT JOIN TasksRequirements TR ON T.id = TR.task_id LEFT JOIN Requirements R ON TR.requirement_id = R.id WHERE T.id = " . $task_id . " ORDER BY requirement ASC";
	$task = $db->query($query);
	$task = mysqli_fetch_assoc($task);
	?>
	
	<?php 
	// If requirement assigned for this task.
	if (strlen($task['requirement']) > 1) {
	?>
	<div class="text_bold">REQUIREMENT for <b><?=$task['task']?></b></div>
	<?php
		// Display requirement list if any.
		$query_2 = "SELECT T.id, task, requirement FROM Tasks T LEFT JOIN TasksRequirements TR ON T.id = TR.task_id LEFT JOIN Requirements R ON TR.requirement_id = R.id WHERE T.id = " . $task_id . " ORDER BY requirement ASC";
		$records = $db->query($query_2);
		while($row = mysqli_fetch_array($records, MYSQLI_ASSOC)) { 
		?>
		<div class="text">
		<?=$row['requirement']?>
		</div>
	<?php }  ?>	
<?php } } ?>



