<?php
session_start();
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netid = $_SESSION['webauth']['netID'];
// $netid = "yontaek";
$_SESSION["netid"] = $netid;
// Restrict page access.
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');
$query = "SELECT access_level FROM admin_users AU LEFT JOIN admin_access AA ON AA.admin_user_id = AU.id LEFT JOIN admin_screens AR ON AA.admin_screen_id = AR.id WHERE active = 1 AND admin_screen_id = 13 AND netid='" . $netid . "'";		//admin_screen_id: 13 => shifts
$result = $db->query($query);
$result = mysqli_fetch_assoc($result);

// Allow access for only Level 2.
if($result['access_level'] == 2){
	// Allowed to open the page.
}
else{
	print 'Permission denied.';
    header("Location: /");
    die('Permission denied.');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Shift Admin';
page_start($page_options);	

// Database connection
$db = new db_mysqli('signup');	
?>
<link rel="stylesheet" href="shifts.css">
<body>
<div style="margin-top:50px; margin-left:30px;"><a href="index.php"><button class="navigation">SHIFT LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_shift.php"><button class="navigation">ADD SHIFT</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="employees.php"><button class="navigation">EMPLOYEE LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div class="col-12 major_heading">Shifts</div>
<?php
// Display the list of available shifts.
$query = "SELECT S.*, location FROM Shifts S LEFT JOIN Locations L ON S.location_id = L.id ORDER BY shift_date DESC";
$shifts = $db->query($query);
// Check if records exist.	
if (mysqli_num_rows($shifts)==0) { 
?>
<div class="isnull">No record. </div>
<br /><br /><br />
<?php
} else {
?>
<div class="choose_shift">
<?php
while($row = mysqli_fetch_array($shifts, MYSQLI_ASSOC)) { 
	
// Number of Shift application.
$query2 = "SELECT count(id) as shift_count FROM Signups WHERE shift_id = " . $row['id'] . "";
$record = $db->query($query2);
$num_signup = mysqli_fetch_assoc($record);
$num_signup = $num_signup['shift_count']
?>
<div class="text" style="margin-bottom:0px;">
<table width="100%" border="0" cellspacing="0" cellpadding="3" class="employees">
  <tbody>
    <tr>
      <td width="350px"><a href="view_shifts.php?id=<?=$row['id']?>"><img src="images/bullet.jfif" width="13px;" />&nbsp;&nbsp;<span class="shift_date"><?=$row['shift_date']?></span> (<?=$row['time_from']?> - <?=$row['time_to']?>)</a></td>
      <td width="250px"><span class="location"><?=$row['location']?></span></td>
      <td width="100px"><span class="text"><?=$row['event']?></span></td>
      <td width="100px"><span class="num_positions"><?=$num_signup?></span> of <span class="num_positions"><?=$row['num_positions']?></span></td>
      <td width="100px"><?php if ($row['urgent'] == 1) { ?> &nbsp;&nbsp;&nbsp;<img src="images/urgent.png" height="40px" /> <?php } ?>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
</div>
<?php }
}
?>
<br /><br /><br /><br /><br />
</body>
<?php page_finish(); ?>
