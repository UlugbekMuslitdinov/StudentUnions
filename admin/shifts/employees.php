<?php
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
//
//// Limit access.
//$db = new db_mysqli('su');
//$query = "SELECT access_level FROM admin_users AU ";
//$query .= "LEFT JOIN admin_access AA ON AA.admin_user_id = AU.id ";
//$query .= "LEFT JOIN admin_screens AR ON AA.admin_screen_id = AR.id ";
//$query .= "WHERE active = 1 AND admin_screen_id = 8 AND netid='" . $netID . "'";	//admin_screen_id: 8 => thanksgiving
//$result = $db->query($query);
//$result = $result->fetch_assoc();
//
//// Allow access for only Level 2.
//if($result['access_level'] == 2){
//	// Allowed to open the page.
//}
//else{
//	print 'Permission denied.';
//    header("Location: /");
//    die('Permission denied.');
//}

// Start page.
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Employees';
page_start($page_options);	
?><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style type="text/css">
     table {
        table-layout: fixed;
        margin: auto;
        text-align: center;
    }
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
    .dropdown {
        font-size: 18px;
        width:35%;
        background-color: blue;
        color:white;
        padding: 0px 0px 5px 10px;
    }
	.deleteBTN {
		color: red !important;
	}
</style>
<link rel="stylesheet" href="shifts.css">
<body>
<?php
$pg = 0;
if(isset($_GET['pg'])) {
	$pg = $_GET['pg'];
}
if($pg < 0) {
	$pg = 0;
}

$rows_per_page = 1000;
$starting_row = $pg * $rows_per_page;

$db = new db_mysqli('signup');
// Get last page count
$query = "SELECT COUNT(id) FROM Employees";
$result = $db->query($query);
$rows = mysqli_fetch_array($result);
$total_rows = $rows[0];
$last_pg = ceil($total_rows/$rows_per_page) - 1;
// end

$query = "SELECT * FROM Employees ORDER BY first_name, last_name, netid LIMIT " . $starting_row . ", " . $rows_per_page;
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

<div class="container">
<div class="row page_background mt-2">
<div style="margin-top:30px; margin-bottom: 20px;"><a href="index.php"><button class="navigation">SHIFT LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_shift.php"><button class="navigation">ADD SHIFT</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="employees.php"><button class="navigation">EMPLOYEE LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div class="col-12 page_title">Employees 
    <!-- <span style="margin-left:750px;">
        {/*<button>
            <a href="reporting.php">REPORTING</a>
        </button>
        <button>
            <a href="export.php">EXPORT</a>
        </button> */}
    </span> -->
</div>

<table width="100%" border="1" cellpadding="5">
	<tr id="tablehead">
		<td class="headtitle">First Name</td>
		<td class="headtitle">Last Name</td>
		<td class="headtitle">NetID</td>
		<td class="headtitle">Affiliation</td>
		<td class="headtitle">Banned</td>
		<td class="headtitle">Performance</td>
		<td class="headtitle"> </td>
	</tr>
<?php   
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
//$timestamp = date('m/d/y, g:i a',strtotime($row['timestamp']));
// $timestamp = date('m/d/y',$row['timestamp']);
?>
	<tr>
		<td><?=$row['first_name']?></td>
		<td><?=$row['last_name']?></td>
		<td><?=$row['netid']?></td>
		<td><?=$row['affiliation']?></td>
		<td><?=$row['banned']?></td>
		<td><?=$row['performance']?></td>
		<td align="center">
			<a href="./employee_view.php?id=<?=$row['id']?>"><button><b>VIEW</b></button></a>
			<!-- <a href="./employee_delete.php?id=<?=$row['id']?>"><button class="deleteBTN"><b>DELETE</b></button></a> -->
		</td>
	</tr>

<?php
}
?>
<tr>
<!--
<center>
	<a href="./employees/index.php?pg=0">First Page</a> | <a href="./employees/index.php?pg=<?php echo $pg-1; ?>">Prev</a> | Page <?php echo $pg+1; ?> | <a href="./employees/index.php?pg=<?php echo $pg+1; ?>">Next</a> | <a href="./employees/index.php?pg=<?php echo $last_pg; ?>">Last Page</a>
</center>
-->
</tr>
</table>

<!--
<center>
	<a href="./employees/index.php?pg=0">First Page</a> | <a href="./employees/index.php?pg=<?php echo $pg-1; ?>">Prev</a> | Page <?php echo $pg+1; ?> | <a href="./employees/index.php?pg=<?php echo $pg+1; ?>">Next</a> | <a href="./employees/index.php?pg=<?php echo $last_pg; ?>">Last Page</a>
</center>
-->
</div>
</div>
