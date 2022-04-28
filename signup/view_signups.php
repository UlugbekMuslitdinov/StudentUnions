<?php
session_start();
// Web Auth Login required
$webauth_splash = '';
if ((!isset($_SESSION['webauth']['netID'])) || (strlen($_SESSION['webauth']['netID']) == 0)) {
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
}

// Logout
$webauth_logout = 0;
if(array_key_exists('logout', $_GET) && $_GET['logout'] == 1){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if(isset($_SESSION['webauth']['netID'])){ $webauth_logout = 1; }
	session_destroy();
	session_start();
}

$shift_id = $_GET['id'];
$employee_id = $_GET['employee_id'];

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'View Signups';
page_start($page_options);	

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('signup');	
?>
<?php
// Log Out
if(isset($_GET['logout']) && $_GET['logout'] == 1 && $webauth_logout==1){
?>
<div id="webauth_logout_modal">
	<div class="modal-backdrop fade show" onclick="document.getElementById('webauth_logout_modal').remove();"></div>
	<div class="modal fade show" tabindex="-1" role="dialog" style="display:block;" aria-modal="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="border-bottom-width: 0px;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="document.getElementById('webauth_logout_modal').remove();">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<p>You are logged into webauth. Would you like to logout?</p>
				</div>

				<div class="modal-footer" style="border-top-width: 0px;">
					<a type="button" class="btn btn-primary" href="https://webauth.arizona.edu/webauth/logout?logout_href=https://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>&logout_text=Logout">Yes</a>
					<!--<button type="button" class="btn btn-outline-primary" onclick="document.getElementById('webauth_logout_modal').remove();">No</button>-->
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
<link rel="stylesheet" href="shifts.css">
<body>
<div style="margin-top:30px; margin-bottom: 20px;">
	<a href="index.php"><button class="navigation">SIGN-UP MAIN PAGE</button></a>&nbsp;&nbsp;
</div>
<div class="logout">Signed in as <span class="text_bold"><?=$_SESSION['webauth']['netID']?></span>&nbsp;&nbsp;&nbsp;&nbsp;
	<span><button><a href="index.php?logout=1">Log out</a></button></span>
</div>
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
