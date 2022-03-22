<?php
include("administration.inc");
//Until this page has anything other than forms on it, just go to the forms list
header("Location: ./forms/list.php");
exit();
$page_options['title'] = 'Admin Hub';
admin_start($page_options, true);
?>
<div id="center-col">
	<h1>Forms:</h1>
	<h3><a href="forms/records.php?form=room_reservation">Room Reservations</a></h3>
	<h3><a href="forms/records.php?form=deliverance_current">Deliverance - Current</a></h3>
	<h3><a href="forms/records.php?form=hours_location">Union Locations</a></h3>
	<h3><a href="forms/list.php">All Forms</a></h3>
</div>
<?php admin_finish(); ?>