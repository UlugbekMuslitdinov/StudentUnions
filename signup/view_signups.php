<?php
session_start();
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
//$shift_id = 1;
//$employee_id = 2;
$shift_id = $_GET['id'];
$employee_id = $_GET['employee_id'];

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'View Signups';
page_start($page_options);	

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	
?>
<link rel="stylesheet" href="shifts.css">
<body>
<div style="margin-top:30px; margin-bottom: 20px;"><a href="index.php"><button class="navigation">SIGN-UP MAIN PAGE</button></a></div>
<div class="col-12 major_heading"></div>
<?php
// Display the location for the shifts.
$query = "SELECT S.*, location FROM Shifts S LEFT JOIN Locations L ON S.location_id = L.id WHERE S.id = " . $shift_id;
$shifts = $db->query($query);
$row = mysqli_fetch_assoc($shifts);
?>

<div class="text">
<span class="shift_date"><?=$row['shift_date']?></span> (<?=$row['time_from']?> - <?=$row['time_to']?>) at <span class="location"><?=$row['location']?></span> (<?=$row['event']?>) - <span class="num_positions"><?=$row['num_positions']?></span> Avalilable <?php if ($row['urgent'] == 1) { ?> &nbsp;&nbsp;&nbsp;<img src="images/urgent.png" height="40px" /> <?php } ?>
</div>
	
<?php	
// Find the details of this shift application.
$query = "SELECT * FROM SignupTasks ST LEFT JOIN Tasks T ON ST.task_id = T.id WHERE shift_id = " . $shift_id . " AND employee_id = " . $employee_id;
$tasks = $db->query($query);
?>
<!-- List of Tasks (Positions) 	-->	
	<div class="tasks">
	<?php
	while($row3 = mysqli_fetch_array($tasks, MYSQLI_ASSOC)) { 	
	?>
	<table width="" border="0" cellspacing="0" cellpadding="3" class="employees">
	  <tbody>
		<tr>
		  <td width="500px"><span class="text_bold_green"><img src="images/bullet.jfif" width="10px;" />&nbsp;&nbsp;<?=$row3['task']?></span></td>
		  <td width="100px"><span class="text_bold_blue"><?=$row3['status']?></span></td>
		  <td width="100px">&nbsp;</td>
		</tr>
	  </tbody>
	</table>
		
		<?php	
			// Find Requirements.
			$query = "SELECT * FROM SignupRequirements SR LEFT JOIN Requirements R ON SR.requirement_id = R.id WHERE employee_id = " . $employee_id . " AND shift_id = " . $shift_id . " AND task_id = " . $row3['task_id'];
			$requirements = $db->query($query);
			?>
			<!-- List of Requirements if any 	-->	
			<div class="requirements" style="margin-left: 35px;">
			<?php
				while($row4 = mysqli_fetch_array($requirements, MYSQLI_ASSOC)) { 	
			?>			
				<table width="100%" border="0" cellspacing="0" cellpadding="3" class="employees">
				  <tbody>
					<tr>
					  <td width="400px">&nbsp;&nbsp;<span class="filled"><?=$row4['requirement']?></span></td>
					  <td width="100px"><span class="filled">Trained?</span></td>
					  <td width="100px"><span class="text_bold_red"><?=$row4['filled']?></span></td>
					  <td><span class="text_bold_blue">&nbsp;</span></td>
					  <td width="100px">&nbsp;</td>
					  <td width="100px">&nbsp;</td>
					</tr>
				  </tbody>
				</table>
			<?php 															 
				}
			?>	
			</div>
</body>
<?php } ?>	<br /><br /><br /><br /><br /><br />
<?php page_finish(); ?>
