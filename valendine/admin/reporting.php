<?php
// header("Location: ../index.php");
// die();

// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];
// $netID = "yontaek";

//if(isset($_SESSION['webauth']['netID'])) {
//    echo 'Logged In as <b>' . $netID . '</b>';
//}
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

$start_date = '2022-01-01';
$end_date = date("Y-m-d", time());

if(isset($_POST['startdate']) && !empty($_POST['startdate'])) {
	$start_date = $_POST['startdate'];
}

if(isset($_POST['enddate']) && !empty($_POST['enddate'])) {
	$end_date = $_POST['enddate'];
}
$query = "SELECT timestamp FROM forms ORDER BY timestamp ASC LIMIT 1";
$date = $db->query($query);
$date = $date->fetch_assoc();
$date = explode(" ",$date['timestamp']);
$date = strval(date('Y-m-d',strtotime($date[0])));
if (!$date) { //if date query returns no timestamp the database is empty and start date can be beginning of year
	$start_date = '2022-01-01';
} else {
	$start_date = $date;
}

// Start page.
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Valentine Orders';
page_start($page_options);

function getCount($db, $query) {
	$result = $db->query($query);
	$rows = mysqli_fetch_array($result);
	$total_rows = $rows[0];
	return $total_rows;
}

// Get page counts
$forms = array("Dinner To-Go", "Bakesale");
$date_cond = "DATE(timestamp) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";

// Table 1
$val = array();
$dataPoints1 = array( 
	array("label"=>"Paid", "y"=>0),
	array("label"=>"Not Paid", "y"=>0)
);

foreach ($forms as $form) {
	$c = array("", 0, 0, 0);
	
	$form_cond = "form='Valentine " . $form . "'";
	$form_cc_cond = "form='Valentine " . $form . "' AND payment='Credit Card/ Debit Card'";

	$c[0] = $form;
	$c[4] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_cond); //This must be last index because this is totals query and is now at the end of the table
	$c[1] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_cc_cond);
	$c[2] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_cc_cond ." AND status='Paid'");
	$c[3] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_cc_cond ." AND status<>'Paid'");

	$dataPoints1[0]["y"] += $c[3];
	$dataPoints1[1]["y"] += $c[4];

	array_push($val, $c);
}

// Table 2
$val2 = array();
$dataPoints2 = array( 
	array("label"=>"Credit/Debit Card", "y"=>0),
	array("label"=>"Meal Plan", "y"=>0),
	array("label"=>"Other", "y"=>0)
);

foreach ($forms as $form) {
	$c = array("", 0, 0, 0);
	
	$form_cond = "form='Valentine " . $form . "'";
	$form_cc_cond = $form_cond . " AND payment='Credit Card/ Debit Card'";
	$form_mp_cond = $form_cond . " AND payment='Meal Plan'";
	$form_oth_cond = $form_cond . " AND payment='Other'";

	$c[0] = $form;
	$c[4] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_cond); //This must be last index because this is totals query and is now at the end of the table
	$c[1] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_cc_cond);
	$c[2] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_mp_cond);
	$c[3] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_oth_cond);

	$dataPoints2[0]["y"] += $c[2];
	$dataPoints2[1]["y"] += $c[3];
	$dataPoints2[2]["y"] += $c[4];

	array_push($val2, $c);
}

// Table 3
$val3 = array();
$dataPoints3 = array( 
	array("label"=>"SUMC Traffic Circle", "y"=>0),
	array("label"=>"On Deck Deli", "y"=>0)
);

foreach ($forms as $form) {
	$c = array("", 0, 0, 0);
	
	$form_cond = "form='Valentine " . $form . "'";
	$form_sumc_cond = $form_cond . " AND pickuplocation='SUMC Traffic Circle'";
	$form_deli_cond = $form_cond . " AND pickuplocation='On Deck Deli'";

	$c[0] = $form;
	$c[1] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_cond);
	$c[2] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_sumc_cond);
	$c[3] = getCount($db, "SELECT COUNT(1) FROM forms WHERE " . $date_cond . " AND " . $form_deli_cond);

	$dataPoints3[0]["y"] += $c[2];
	$dataPoints3[1]["y"] += $c[3];

	array_push($val3, $c);
}


// end
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
		width: 250px !important;
	}
	.tableTitle {
		font-weight:bold !important;
		font-size:24px !important;
	}
	td {
		height: 45px;
	}
</style>
<script>
window.onload = function() {
	loadCharts();
}


function loadCharts() { 
var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	data: [{
		type: "pie",
		yValueFormatString: "#,##0",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	data: [{
		type: "pie",
		yValueFormatString: "#,##0",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	data: [{
		type: "pie",
		yValueFormatString: "#,##0",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();
chart2.render();
/*chart3.render();*/
 
}
</script>
<body>

<div class="container">
<div class="row page_background mt-2">
<div class="col-12 page_title">Valentine Orders</div>

<table width="100%"><tr><td width="50%">
<div class="tableTitle"><b>Credit Card Payment</b></div>
<table width="100%" border="1" cellpadding="5">
	<tr id="tablehead">
		<td class="headtitle">Form</td>		
		<td class="headtitle">Credit Card</td>
		<td class="headtitle">CC Paid</td>
		<td class="headtitle">CC Not Paid</td>
		<td class="headtitle">Total</td>
	</tr>

	<?php
	$totals = array(0,0,0,0);

	foreach($val as $row) {
		//get values for totals
		for ($i=1; $i<5; $i++) { //start at index 1 because index 0 is row title
			$totals[$i-1] += $row[$i];
		}
		//display values
		echo '<tr>';
		foreach($row as $col) {
			echo '<td>'.$col.'</td>';
		}

		echo '</tr>';
	}
	echo '<tr>'; //begin total row
	echo '<td>Total</td>';
	for ($i=0; $i<4; $i++) {
		echo '<td>'.$totals[$i].'</td>';
	}
	echo '</tr>'; //end total row
	?>
</table>
</td><td>
<div id="chartContainer1" style="height: 200px; width: 100%;"></div>
</td></tr></table>


<table width="100%"><tr><td width="50%">
<br />
<div class="tableTitle"><b>Payment Types</b></div>
<table width="100%" border="1" cellpadding="5">
	<tr id="tablehead">
		<td class="headtitle">Form</td>
		<td class="headtitle">Credit/Debit card</td>
		<td class="headtitle">Meal Plan</td>
		<td class="headtitle">Others</td>
		<td class="headtitle">Total</td>
	</tr>

	<?php
	$totals = array(0,0,0,0);
	
	foreach($val2 as $row) {
		//get values for totals
		for ($i=1; $i<5; $i++) { //start at index 1 because index 0 is row title
			$totals[$i-1] += $row[$i];
		}
		//display values
		echo '<tr>';

		foreach($row as $col) {
			echo '<td>'.$col.'</td>';
		}

		echo '</tr>';
	}
	echo '<tr>'; //begin total row
	echo '<td>Total</td>';
	for ($i=0; $i<4; $i++) {
		echo '<td>'.$totals[$i].'</td>';
	}
	echo '</tr>'; //end total row
	?>
</table>
</td><td>
<div id="chartContainer2" style="height: 200px; width: 100%;"></div>
</td></tr></table>




<form method="POST" style="margin-top: 15px;">
	<label>Start Date</label>
	<input type="date" name="startdate" value="<?= $start_date ?>" />
	<label>End Date</label>
	<input type="date" name="enddate" value="<?= $end_date ?>" />
	<input type="submit" name="submit" value="Filter" />
</form>
</div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<?php


?>
</body>
<?php page_finish(); ?>
