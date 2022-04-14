<?php
session_start();
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$shift_id = $_GET['id'];

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Shift Admin';
page_start($page_options);	

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	
?>
<link rel="stylesheet" href="shifts.css">
<body>
<div style="margin-top:30px; margin-bottom: 20px;"><a href="index.php"><button class="navigation">SHIFT LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="employees.php"><button class="navigation">EMPLOYEE LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div class="col-12 major_heading"><!--Shift--></div>
<?php
// Display the location for the shifts.
$query = "SELECT S.*, location FROM Shifts S LEFT JOIN Locations L ON S.location_id = L.id WHERE S.id = " . $shift_id;
$shifts = $db->query($query);
$row = mysqli_fetch_assoc($shifts);
?>

<div class="text">
<a href="view_shifts.php?id=<?=$row['id']?>"><span class="shift_date"><?=$row['shift_date']?></span> (<?=$row['time_from']?> - <?=$row['time_to']?>) at <span class="location"><?=$row['location']?></span></a> (<?=$row['event']?>) - <span class="num_positions"><?=$row['num_positions']?></span> Avalilable <?php if ($row['urgent'] == 1) { ?> &nbsp;&nbsp;&nbsp;<img src="images/urgent.png" height="40px" /> <?php } ?></div>

<!-- List of applied names 	-->
<?php
// Find Employees applied for each shift.
$query_employees = "SELECT shift_id, employee_id, status, E.* FROM Shifts S LEFT JOIN Signups SU ON S.id = SU.shift_id LEFT JOIN Employees E ON SU.employee_id = E.id WHERE shift_id = " . $row['id'] . " ORDER BY first_name, last_name";	
$employees = $db->query($query_employees);
// Check if records exist.	
if (mysqli_num_rows($employees)==0) { 
	?>
	<div class="isnull">No record (Nobody signed up.)</div>
	<?php
	} else {
while($row2 = mysqli_fetch_array($employees, MYSQLI_ASSOC)) { 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="3" class="employees">
  <tbody>
    <tr>
      <td><img src="images/bullet.jfif" width="10px;" />&nbsp;&nbsp;<a href="employee_view.php?id=<?=$row2['employee_id']?>"><span class="text_bold"><u><?=$row2['first_name']?> <?=$row2['last_name']?></u></span></a> (at <span class="filled"><?=$row2['affiliation']?></span>) 
		  <?php if (isset($row2['performance'])) { ?> <span class="banned"><?=$row2['performance']?></span> performance <?php } ?>
		  <?php if ((isset($row2['banned'])) && (($row2['banned']) == "Yes")) { ?><img src="images/banned.jpg" alt="Banned" height="30px;" /><!--<span class="banned">Banned</span>-->  <?php } ?>
	  </td>
		<td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<?php	
// Find Employees applied for each shift.
$query = "SELECT * FROM SignupTasks ST LEFT JOIN Tasks T ON ST.task_id = T.id WHERE employee_id = " . $row2['employee_id'] . " AND shift_id = " . $row2['shift_id'];
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
		  <td width="400px"><span class="text_bold_green"><img src="images/bullet_black.png" width="10px;" />&nbsp;&nbsp;<?=$row3['task']?></span></td>
		  <td width="100px"><span class="text_bold_blue"><?=$row3['status']?></span></td>
		  <td width="100px">
			  <?php if ($row3['status'] == "Pending") { ?> <button class="approve"><a href="approve_signup.php?shift_id=<?=$row2['shift_id']?>&employee_id=<?=$row2['employee_id']?>&task_id=<?=$row3['task_id']?>">APPROVE</a></button> <?php } ?>
			  
			  <?php if (($row3['attendance'] == "Excused") || ($row3['attendance'] == "No Show")) { ?> <span class="text_bold_blue"><?=$row3['attendance']?></span> <?php } 
			  
		  	  elseif ($row3['status'] == "Approved") { ?> <button class="approve"><a href="mark_excused.php?shift_id=<?=$row2['shift_id']?>&employee_id=<?=$row2['employee_id']?>&task_id=<?=$row3['task_id']?>">EXCUSED</a></button> <?php } ?>	
			  
			  
		  </td>
		  <td width="100px">
			  <?php if ($row3['status'] == "Pending") { ?> <button class="approve"><a href="deny_signup.php?shift_id=<?=$row2['shift_id']?>&employee_id=<?=$row2['employee_id']?>&task_id=<?=$row3['task_id']?>">FILLED</a></button> <?php } ?>
			 
			  <?php if (($row3['attendance'] == "Excused") || ($row3['attendance'] == "No Show")) {  } 
		
			  elseif ($row3['status'] == "Approved") { ?> <button class="approve"><a href="mark_noshow.php?shift_id=<?=$row2['shift_id']?>&employee_id=<?=$row2['employee_id']?>&task_id=<?=$row3['task_id']?>">NO SHOW</a></button> <?php } ?>
		  </td>
		</tr>
	  </tbody>
	</table>
			<?php	
			// Find Requirements.
			$query = "SELECT * FROM SignupRequirements SR LEFT JOIN Requirements R ON SR.requirement_id = R.id WHERE employee_id = " . $row2['employee_id'] . " AND shift_id = " . $row2['shift_id'] . " AND task_id = " . $row3['task_id'];
			$requirements = $db->query($query);
			?>
			<!-- List of Requirements if any 	-->	
			<div class="requirements">
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
	<?php 															 
	}
	?>	
	</div>	
<?php 															 
} }
?>
</div>
</body>
<?php page_finish(); ?>
