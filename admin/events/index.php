<?php
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$db = new db_mysqli('su');
$query = "SELECT access_level FROM admin_users AU ";
$query .= "LEFT JOIN admin_access AA ON AA.admin_user_id = AU.id ";
$query .= "LEFT JOIN admin_screens AR ON AA.admin_screen_id = AR.id ";
$query .= "WHERE active = 1 AND admin_screen_id = 8 AND netid='" . $netID . "'";	//admin_screen_id: 8 => thanksgiving
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
$page_options['title'] = 'Events';
page_start($page_options);	
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
//before page functions, get desired form and year from user
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
    .dropdown {
        font-size: 18px;
        width:35%;
        background-color: blue;
        color:white;
        padding: 0px 0px 5px 10px;
    }
</style>
<body>
<div class="container dropdown">
    <form method="post"><br><br>
        <label for="formSelector">Choose a Form:</label>
        <select name="formSelector" id="formSelector" onChange="getDropdown()">
            <option value="All">All Forms</option>
            <option value="Thanksgiving">Thanksgiving</option>
            <option value="Valentine">Valentine</option>
            <option value="Holiday">Holiday</option>
        </select>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
<?php
$pg = 0;
if(isset($_GET['pg'])) {
	$pg = $_GET['pg'];
}
if($pg < 0) {
	$pg = 0;
}

$rows_per_page = 999;
$starting_row = $pg * $rows_per_page;

if ($_POST['formSelector']) {
    $formSelector = $_POST['formSelector'];
}
$_SESSION['formSelector'] = $formSelector;
//Create a where condition for sql queries specific to selected form
if ($formSelector=="Thanksgiving") {
    $whereCondition = "WHERE form LIKE '%Thanksgiving%'";
} else if ($formSelector=="Valentine") {
    $whereCondition = "WHERE form LIKE '%Valentine%'";
} else if ($formSelector=="Holiday") {
    $whereCondition = "WHERE form LIKE '%Holiday%'";
} else {
    $whereCondition = "";
    $formSelector = "All";
}

// Get last page count
$query = "SELECT COUNT(1) FROM forms " . $whereCondition . "ORDER BY id DESC";
$result = $db->query($query);
$rows = mysqli_fetch_array($result);
$total_rows = $rows[0];
$last_pg = ceil($total_rows/$rows_per_page) - 1;
// end

$query = "SELECT * FROM forms " . $whereCondition . "ORDER BY id DESC LIMIT " . $starting_row . ", " . $rows_per_page;
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
<div class="col-12 page_title"><?=$formSelector?> Orders 
    <span style="margin-left:750px;">
        <button>
            <a href="reporting.php">REPORTING</a>
        </button>
        <button>
            <a href="export.php">EXPORT</a>
        </button>
    </span>
</div>
<table width="100%" border="1" cellpadding="5">
	<tr id="tablehead">
		<td class="headtitle">ID</td>
		<td class="headtitle">Name</td>
		<!--<td>Email</td>
		<td>Phone</td>-->
		<td class="headtitle">Form</td>
		<td class="headtitle">Pickup Day</td>
		<td class="headtitle">Time</td>
		<td class="headtitle">Location</td>
		<td class="headtitle">Payment</td>
		<td class="headtitle">Status</td>
		<td class="headtitle">Timestamp</td>
	</tr>
<?php   
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
// Rename forms.
switch ($row['form']) {
	case "Thanksgiving Offerings To-Go":
		$form = "Thanksgiving Offerings To-Go";
		$pickupday = "11/24/21";
		break;
	case "Thanksgiving Side A La Carte To-Go":
		$form = "Thanksgiving A La Carte";
		$pickupday = "11/24/21";
		break;
	case "Holiday Bake Sale":
		$form = "Holiday Bake Sale";
		$date = strtotime($row['pickupday']);
		$dateformat = date('m/d/y',$date);
		$pickupday = $dateformat;
		break;
	default:
		$form = $row['form'];
		$date = strtotime($row['pickupday']);
		$dateformat = date('m/d/y',$date);
		$pickupday = $dateformat;
}
// Rename locations.
switch ($row['pickuplocation']) {
	case "SUMC Traffic Circle":
		$location = "Traffic Circle";
		break;
	case "On Deck Deli":
		$location = "On Deck";
		break;
	default:
		$location = $row['pickuplocation'];
}
// Rename payment.
switch ($row['payment']) {
	case "Credit Card/ Debit Card":
		$payment = "Credit Card";
		break;
	default:
		$payment = $row['payment'];
}	
$timestamp = date('m/d/y, g:i a',strtotime($row['timestamp']));
// $timestamp = date('m/d/y',$row['timestamp']);
?>
	<tr>
		<td><?=$row['id']?></td>
		<td><?=$row['name']?></td>
		<!--<td><?=$row['email']?></td>
		<td><?=$row['phone']?></td>-->
		<td><?=$form?></td>
		<td><?=$pickupday?></td>
		<td><?=$row['pickuptime']?></td>
		<td><?=$location?></td>
		<td><?=$payment?></td>
		<td><?=$row['status']?></td>
		<td><?=$timestamp?></td>
	</tr>

<?php
}
?>
<tr>
<!--<center>
	<a href="./index.php?pg=0">First Page</a> | <a href="./index.php?pg=<?php echo $pg-1; ?>">Prev</a> | Page <?php echo $pg+1; ?> | <a href="./index.php?pg=<?php echo $pg+1; ?>">Next</a> | <a href="./index.php?pg=<?php echo $last_pg; ?>">Last Page</a>
</center> -->
</tr>
</table>


<!--<center>
	<a href="./index.php?pg=0">First Page</a> | <a href="./index.php?pg=<?php echo $pg-1; ?>">Prev</a> | Page <?php echo $pg+1; ?> | <a href="./index.php?pg=<?php echo $pg+1; ?>">Next</a> | <a href="./index.php?pg=<?php echo $last_pg; ?>">Last Page</a>
</center> -->

</div>
</div>

<script>
function getDropdown() {
    var form = document.getElementById("formSelector");
    var formAns = form.value;
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php page_finish(); ?>