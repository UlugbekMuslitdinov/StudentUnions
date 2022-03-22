<?php

require_once('webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

if($netID == 'ldj' || $netID == 'nbischof' || $netID == 'nicka' || $netID == 'bphinney' || $netID == 'enezelek' || $netID == 'cblevins' || $netID == 'yontaek' || $netID == 'ricarlos' || $netID == 'eotkank87'){

}
else{
	print 'You do not have access.';
	exit();
}

	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Student Union Hours';
  page_start($page_options);
?>
<style>
span{
text-decoration:underline;
cursor:pointer;
}
form{
	padding:0px;
	margin:0px;
}
</style>
<?php

require('hours_db.inc');
//print mysql_error($DBlink);
$query = 'select * from location where location_id<>58 and location_id<>59 order by group_id, subgroup, location_name';
$result = $db->query($query);

$location = $result->fetch_array();
print '<div style="margin-left:30px; width:1200px;"><div style="float:left; width:auto;"><h2>SUMC</h2><div style="margin-left:15px;"><span onclick="window.frames[0].location=\'https://su-wdevtest.union.arizona.edu/infodesk/hoursnew/edithours?location=58\'">Building Hours</span><br><h2>Dining</h2><div style="margin-left:15px;">';
while($location['group_id']==1 && $location['subgroup']=='Dining'){

	print '<span onclick="document.getElementById(\'edit_hours\').setAttribute(\'src\',\'edithours.php?location='.$location['location_id'].'\')">'.$location['location_name'].'</span><br>';
	$location = $result->fetch_array();
}
print '</div><h2>Services</h2><div style="margin-left:15px;">';
while($location['group_id']==1){
	print '<span onclick=\'window.frames[0].location="edithours.php?location='.$location['location_id'].'"\'>'.$location['location_name'].'</span><br>';
	$location = $result->fetch_array();
}
print '</div></div><h2>PSU</h2><div style="margin-left:15px;"><span onclick="window.frames[0].location=\'edithours.php?location=59\'">Building Hours</span><br><h2>Dining</h2><div style="margin-left:15px;">';
while($location['group_id']==2 && $location['subgroup']=='Dining'){
	print '<span onclick=\'window.frames[0].location="edithours.php?location='.$location['location_id'].'"\'>'.$location['location_name'].'</span><br>';
	$location = $result->fetch_array();
}
print '</div><h2>Services</h2><div style="margin-left:15px;">';
while($location['group_id']==2){
	print '<span onclick=\'window.frames[0].location="edithours.php?location='.$location['location_id'].'"\'>'.$location['location_name'].'</span><br>';
	$location = $result->fetch_array();
}
print '</div></div><h2>Union Outlets</h2><div style="margin-left:30px;">';
while($location['group_id']==3){
	print '<span onclick=\'window.frames[0].location="edithours.php?location='.$location['location_id'].'"\'>'.$location['location_name'].'</span><br>';
	$location = $result->fetch_array();
}
print '</div><h2>Admin</h2><div style="margin-left:30px;">';
while($location['group_id']==4){
	print '<span onclick=\'window.frames[0].location="edithours.php?location='.$location['location_id'].'"\'>'.$location['location_name'].'</span><br>';
	$location = $result->fetch_array();
}
print '</div></div>';

?>
<div>
<div style="float:right;">
	<form name="nextweek" action="hours2.php?week=next" method="post"><input type="hidden" name="title" value=""><input type="button" onclick="document.nextweek.title.value = prompt('please enter a title', 'Summer 2009'); document.nextweek.submit();" value="print hours for next week" /></form>
	<form name="currentweek" action="hours2.php" method="post"><input type="hidden" name="title" value=""><input type="button" onclick="document.currentweek.title.value = prompt('please enter a title', 'Summer 2009'); document.currentweek.submit();" value="print hours for current week" /></form></div>
</div>
<div style="float:left; width:auto; margin-left:30px;">
<iframe name="edit_hours" frameborder="0" id="edit_hours" src="" style="width:800px; height:800px;"  ></iframe>
</div>
</div>
<?php page_finish(); ?>
