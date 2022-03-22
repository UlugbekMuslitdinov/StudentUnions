<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/webauth/include.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
include('functions.php');

// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

//$db = new db_mysqli('su');
//$result = $db->query('select * from users where app_id=1 and netid="'.$_SESSION['webauth']['netID'].'"');
//$result = $db->query('select * from employment');

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');
$query = "SELECT access_level FROM admin_users AU ";
$query .= "LEFT JOIN admin_access AA ON AA.admin_user_id = AU.id ";
$query .= "LEFT JOIN admin_screens AR ON AA.admin_screen_id = AR.id ";
$query .= "WHERE active = 1 AND admin_screen_id = 9 AND netid='" . $netID . "'";	//admin_screen_id: 9 => employment
$result = $db->query($query);
$result = $result->fetch_assoc();

// Allow access for only Level 2.
if($result['access_level'] == 2){
	// Allowed to open the page.
}
else{
	print 'Permission denied.';
    header("Location: /");
    die('Permission denied.');
}

// Start page.
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Employment Popup Responses';
page_start($page_options);

// Query
$pg = 0;
if(isset($_GET['pg'])) {
	$pg = $_GET['pg'];
}
if($pg < 0) {
	$pg = 0;
}

$rows_per_page = 30;
$starting_row = $pg * $rows_per_page;

// Get last page count
$query = "SELECT COUNT(1) FROM employment ORDER BY id DESC";
$result = $db->query($query);
$rows = mysqli_fetch_array($result);
$total_rows = $rows[0];
$last_pg = ceil($total_rows/$rows_per_page) - 1;
// end

$query = "SELECT * FROM employment ORDER BY id DESC LIMIT " . $starting_row . ", " . $rows_per_page;
$result = $db->query($query);

function prevPg() {
	if($pg == 0) {
		return 0;
	}
	$pg -= 1;
	return $pg;
}

function nextPg() {
	$pg += 1;
	return $pg;
}
?>
<style type="text/css">
	body.togo_order {
		background: #F4E7D7 !important;
	}
	.page_background {
		background: #FFFFFF;
		margin-top:-20px;
		padding:10px;
	}
	.page_title {
		font-size: 24px;
		font-weight: 600;			
		color: orangered;
		margin-bottom:20px;
	}
	.page_content {
		line-height: 20px;
	}
	.text_description {
		font-size:16px;
	}
	#feast-form{
		width: 100%;
		background: #F4E7D7;
		margin-bottom: 20px;
		margin-top:-20px;
		padding-bottom: 0px;
	}
	.subheader{
		width: 100%;
		height: 16px;
		background: #CC9D66;
		overflow: hidden;
	}
	#tablehead {
		background: orange;
		color: white;
	}
	.headtitle {
		font-size: 16px;
		font-weight: bold;
	}
	td {
		text-align: center;
	}
	.monthlytotals {
		border-top: 2px solid;
	}
</style>

<body>
<div class="container">
<div class="row page_background mt-2">
<div class="col-12 page_title">Employment Popup Responses <span style="margin-left:750px;"><button><a href="reporting.php?year=2022">REPORTING</a></button>&nbsp;&nbsp;<button><a href="export.php">EXPORT</a></button></span></div>
<table width="100%" border="1" cellpadding="5">
	<tr id="tablehead">
		<td class="headtitle">ID</td>
		<td class="headtitle">Response Choice</td>
		<td class="headtitle">Other TextBox</td>
		<td class="headtitle">Timestamp</td>
	</tr>
<?php
//begin while statement//
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
$timestamp = date('m/d/y, g:i a',strtotime($row['timestamp']));
?>
	<tr>
		<td><?=$row['id']?></td>
		<td><?=$row['response']?></td>
		<td><?=$row['other']?></td>
		<td><?=$timestamp?></td>
	</tr>

<?php
}
//end while statement//
?>
<tr>
<center>
	<a href="./index.php?pg=0">First Page</a> | <a href="./index.php?pg=<?php echo $pg-1; ?>">Prev</a> | Page <?php echo $pg+1; ?> | <a href="./index.php?pg=<?php echo $pg+1; ?>">Next</a> | <a href="./index.php?pg=<?php echo $last_pg; ?>">Last Page</a>
</center>
</tr>
</table>


<center>
	<a href="./index.php?pg=0">First Page</a> | <a href="./index.php?pg=<?php echo $pg-1; ?>">Prev</a> | Page <?php echo $pg+1; ?> | <a href="./index.php?pg=<?php echo $pg+1; ?>">Next</a> | <a href="./index.php?pg=<?php echo $last_pg; ?>">Last Page</a>
</center>

</div>
</div>

<div class="col-12 page_title"><br><button><a href="./reporting.php?year=2022">Go To Reporting Page</a></button></div>

</body>
<?php page_finish(); ?>
