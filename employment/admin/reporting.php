<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/webauth/include.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
include('functions.php');
require_once('./phpChart_Lite/conf.php');

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
	
	/* Dropdown Button */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
</style>
<script>
function showTable(id, type) {
	var element = document.getElementById(id);
	if (element.style.display === "none") {
		element.style.display = type;
	} else {
		element.style.display = "none";
	}
}
function showQuarter1() {
	var element = document.getElementById('2021quarter0');
	var div = document.getElementById('2021quarter0div');
	if (element.style.display === "none") {
		element.style.display = "table";
		div.style.display = "block";
	} else {
		element.style.display = "none";
		div.style.display = "none";
	}
}
function showQuarter2() {
	var element = document.getElementById('2021quarter1');
	var div = document.getElementById('2021quarter1div');
	if (element.style.display === "none") {
		element.style.display = "table";
		div.style.display = "block";
	} else {
		element.style.display = "none";
		div.style.display = "none";
	}
}
function showQuarter3() {
	var element = document.getElementById('2021quarter2');
	var div = document.getElementById('2021quarter2div');
	if (element.style.display === "none") {
		element.style.display = "table";
		div.style.display = "block";
	} else {
		element.style.display = "none";
		div.style.display = "none";
	}
}
function showQuarter4() {
	var element = document.getElementById('2021quarter3');
	var div = document.getElementById('2021quarter3div');
	if (element.style.display === "none") {
		element.style.display = "table";
		div.style.display = "block";
	} else {
		element.style.display = "none";
		div.style.display = "none";
	}
}
function showYears() {
  document.getElementById("yearDropdown").classList.toggle("show");
}
</script>
<body>

<!-- Summary Total Counts All Time Table By Response Type Begin -->
<div class="container">
<div class="row page_background mt-2">
<div class="col-12 page_title">Summary - Total Counts - All Time</div>
<table width="100%" border="1" cellpadding="5">
	<tr id="tablehead">
		<td class="headtitle">Response Choice</td>
		<td class="headtitle">Total Count</td>
	</tr>
<?php
//get summaries//
//$result = $db->query($query); //these two $result lines are for reference
//$result = $result->fetch_assoc();
//create array of response types to be iterated over. This array is used in monthly and quarterly tables below as well.
$responseTypes = array('Direct Mail', 'Social Media', 'Tabling Event/Job Fair', 'Recruitment Site', 'YouTube Ad', 'Other');
for ($i=0; $i<6; $i++) {
	$response = $db->query("SELECT count(response) as count FROM su.employment WHERE response='".$responseTypes[$i]."'");
	$response = $response->fetch_assoc();
	?>
	<tr>
		<td><?=$responseTypes[$i]?></td>
		<td><?=$response['count']?></td>
	</tr>
	<?php
}
?>
</table>
</div><br><br>
</div> 
<!-- Total Count Summary Table By Response Type End -->

<!-- Get years and display drop down menu Begin -->
<?php


//initialize $year as 2022
$yearSelected = 2022;

$yearsAvailable = $db->query("SELECT DISTINCT year(timestamp) as year FROM su.employment ORDER BY year DESC");
$yearsAvailable = $yearsAvailable->fetch_all();
?>
<div class="page_title">Select a year for a detailed summary:&ensp;</div> 
<form method="get" name="form" action="reporting.php" onsubmit="document.getElementById("subtables").style.display = 'block';">
<select class="dropdown" id="dropdown" name="year" onchange="setYear()" size="1">
	<div id="yearDropdown" class="dropdown-content" >
	<?php
	foreach ($yearsAvailable as $year) {
		?>
		<option  value=<?=$year[0]?>><?=$year[0]?></option>
		<?php
	}
	?>
	</div>
</select>
<input type="submit" value="Submit"> <br>
</form>	
<script>
var year;
function setYear() {
	//year value stored for js
	year = document.getElementById("dropdown").value;
	//year value stored for php
	<?php $yearSelected = $_GET["year"]; ?>
}
</script>
<!-- years and drop down menu End -->
<div class="container" id="subtables" style="display:">
<!-- Summary Table For Response By Month And Year Begin -->
<div class="container"> 
<div class="row page_background mt-2"> <br>
<div class="col-12 page_title">
	
	Monthly Counts By Year, <?=$yearSelected?>:  <br><br>
	<button onclick="showTable('month', 'table')">Show Monthly Table</button> <br>
</div>
<table width="100%" border="1" cellpadding="5"  id="month" style="display:none;" > 
	<tr id="tablehead">
		<td class="headtitle">Response Choice</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">JAN</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">FEB</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">MAR</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">APR</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">MAY</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">JUN</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">JUL</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">AUG</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">SEP</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">OCT</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">NOV</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">DEC</td>
	</tr>
<?php
//get summaries by month//
//$result = $db->query($query); //these two $result lines are for reference
//$result = $result->fetch_assoc(); //save this for reference
//array of reponse types defined above and used here
//create empty array for associative array containing each month as key and the respective total as value pair.
$monthlyTotals = array();
//iterate through response types to create each row //$responseType length is 6. Change this $i<6 in for loop if the amount of response types changes
for ($i=0; $i<6; $i++) {
	?> <tr> <td><?=$responseTypes[$i]?></td> <?php
	//iterate through months as ints to display count in each column follow responseType name.
	for ($j=1; $j<13; $j++) {
		//convert month int j to string and then make every month string two characters ('01', '02'... '12')
		if ($j >=10) {
			$j = strval($j);
		} else { //if month is 1-9, need to prefix with 0 so 01,02, and so on to match timestamp format
			$j = "0" . strval($j);
		}
		//Count response type by month. Example query: "SELECT count(response) FROM su.employment WHERE response='Direct Mail' AND timestamp LIKE '2021-12%';"
		$count = $db->query("SELECT count(response) as count FROM su.employment WHERE response='" . $responseTypes[$i] . "' AND timestamp LIKE '" . $yearSelected . "-" . $j . "%'");
		$count = $count->fetch_assoc();
		?> <td><?=$count['count']?></td> <?php //put queried count into table data for current row
		//get month total for all response types
		$monthsTotal = $db->query("SELECT count(response) as total FROM su.employment WHERE timestamp LIKE '" . $yearSelected . "-" . $j . "%'"); //should look like ('01'=>'some int', '02'=>'some int'... '12'=>'some int')
		$monthsTotal = $monthsTotal->fetch_assoc();
		$monthlyTotals[$j] = $monthsTotal['total'];
	}
	?> </tr> <?php	
} ?> 
<tr> <!-- monthly totals row -->
	<td class="monthlytotals">Totals</td> 
	<td class="monthlytotals"><?=$monthlyTotals['01']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['02']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['03']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['04']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['05']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['06']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['07']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['08']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['09']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['10']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['11']?></td>
	<td class="monthlytotals"><?=$monthlyTotals['12']?></td>
</tr>
</table> 
<span style="margin:5px 0 0 5px;"><button><a href="export<?=$yearSelected?>.php">EXPORT <?=$yearSelected?> All Responses</a></button></span>
<span style="margin:5px 0 0 5px;"><button><a href="export<?=$yearSelected?>ByMonth.php">EXPORT <?=$yearSelected?> Monthly Table</a></button></span> 
</div>
</div>
<!-- Summary Table For Response By Month And Year End -->



<!-- Quarterly Tables For Response By Week/Quarter/Year Begin -->
<?php
//get four arrays of dates that relate to each quarter. 
//DatePeriod(start-date, interval, end-date) gets array of dates between start and end dates, using given interval. Left inclusive, right exclusive
//DateInterval() gives entered interval: 'P1D' means 'Period 1 day', 'P2W' means 'Period 2 weeks', 'P1Y1D' means 'Period 1 year and 1 day'
//$quarter1 = new DatePeriod(new DateTime('2021-01-01'), new DateInterval('P1D'), new DateTime('2021-04-01')); //this is how to generically make these dates, below is incorporating a variable
$quarter1 = new DatePeriod(new DateTime($yearSelected . '-01-01'), new DateInterval('P1D'), new DateTime($yearSelected . '-04-01'));
$quarter2 = new DatePeriod(new DateTime($yearSelected . '-04-01'), new DateInterval('P1D'), new DateTime($yearSelected . '-07-01'));
$quarter3 = new DatePeriod(new DateTime($yearSelected . '-07-01'), new DateInterval('P1D'), new DateTime($yearSelected . '-10-01'));
$quarter4 = new DatePeriod(new DateTime($yearSelected . '-10-01'), new DateInterval('P1D'), new DateTime($yearSelected+1 . '-01-01')); //right end exclusive, so if last DateTime was ('2021-12-31') the 31st would be excluded. Also cannot be '2021-12-32' or error fails script
//Made a function to repeat the task of putting one quarter data of the year (13 weeks) into an array vof arrays.
function getWeeksByQuarter($arr,$responseTypes, $db) {
	//need to bring in these variables ($responseTypes and $db) to be able to use this in the scope of this function.
	$results = array(); //empty array to store arrays of each weeks data
	$day = 1; //begin on day 1 of the year	
	$week = 1; //begin on week 1
	foreach ($arr as $value) {
		$date = $value->format('Y-m-d');
		$month = $value->format('m');
		$day = $value->format('d');
		if ($day%7===1) { //if $day is the first day of a new week 
			//start new week in array
			$results[$week - 1] = array('week'.strval($week)); //[0] => 'week1', [1] => 'week2', and so on. This makes $results sliceable to each week, ex. $results[0] is week 1 data, $results[1] is week 2 data.
			//put in initial value for each response type
			$results[$week-1][1][0] = array($responseTypes[0], 0); //'Direct Mail' 		  //This is how you would slice to this week, 'Direct Mail' to assign a value: $results[$week-1][1][0][1] = value;
			$results[$week-1][1][1] = array($responseTypes[1], 0); //'Social Media'	 	  //$results[$week-1][1][1][1] = value;
			$results[$week-1][1][2] = array($responseTypes[2], 0); //'Tabling Event/Job Fair' //$results[$week-1][1][2][1] = value;
			$results[$week-1][1][3] = array($responseTypes[3], 0); //'Recruitment Site' 	  //$results[$week-1][1][3][1] = value;
			$results[$week-1][1][4] = array($responseTypes[4], 0); //'YouTube Ad' 	 	  //$results[$week-1][1][4][1] = value;
			$results[$week-1][1][5] = array($responseTypes[5], 0); //'Other' 		  //$results[$week-1][1][5][1] = value;
		}
		//use mysql to enter data for each response type for the current day
		for ($i=0; $i<6; $i++) { //$responseType length is 6. Change this $i<6 in for loop if the amount of response types changes
			$count = $db->query("SELECT count(response) as count FROM su.employment WHERE response='" . $responseTypes[$i] . "' AND timestamp LIKE '" . $date . "%'");
			$count = $count->fetch_assoc();
			$results[$week-1][1][$i][1] += $count['count'];
		}
		//end of foreach loop clean-up
		if ($day%7===0) { //if $day is the last day of the week, $week variable needs to increment by 1
			$week += 1;
		}
		$day += 1; //increase day after determining if week needs to change.
	}
	return $results;
}
//fill out quarters
$quarter1 = getWeeksByQuarter($quarter1, $responseTypes, $db);
$quarter2 = getWeeksByQuarter($quarter2, $responseTypes, $db);
$quarter3 = getWeeksByQuarter($quarter3, $responseTypes, $db);
$quarter4 = getWeeksByQuarter($quarter4, $responseTypes, $db);
$year = array($quarter1, $quarter2, $quarter3, $quarter4);
?> 
<!-- begin quarters tables -->
<div class="container"> <br>
<div class="row page_background mt-2" >
<div class="col-12 page_title" >Weekly Counts By Quarter, <?=$yearSelected?> :  <br><br>
	<button onclick="showQuarter1();showQuarter2();showQuarter3();showQuarter4();">Show Quarters Tables</button> 

<?php
//iterate over each quarter and display a table
for ($i=0; $i<4; $i++) {
	?>
	<div id="2021quarter<?=$i?>div" style="display:none;"><?=$yearSelected?> Quarter <?=$i+1?></div>
	<table width="100%" border="1" cellpadding="5" id="2021quarter<?=$i?>" style="display:none;"> 
	<tr id="tablehead">
		<td class="headtitle">Response Choice</td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+1?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+2?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+3?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+4?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+5?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+6?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+7?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+8?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+9?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+10?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+11?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+12?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Week <br><?=$i*13+13?></td>
		<td class="headtitle" style="min-width:3rem; max-width:3rem;">Total</td>
	</tr>
	<?php
	//iterate over each response type //$responseType length is 6. Change this $j<6 in for loop if the amount of response types changes
	for ($j=0; $j<6; $j++) {
		//get total counts
		$total = 0;
		for ($k=0; $k<13; $k++) {
			$total += $year[$i][$k][1][$j][1];
		}
		//display table data
		?><tr>
			<td><?=$responseTypes[$j]?></td>
			<td><?=$year[$i][0][1][$j][1]?></td> <!-- $year[quarter][week][placeholder][response type][value] -->
			<td><?=$year[$i][1][1][$j][1]?></td>
			<td><?=$year[$i][2][1][$j][1]?></td>
			<td><?=$year[$i][3][1][$j][1]?></td>
			<td><?=$year[$i][4][1][$j][1]?></td>
			<td><?=$year[$i][5][1][$j][1]?></td>
			<td><?=$year[$i][6][1][$j][1]?></td>
			<td><?=$year[$i][7][1][$j][1]?></td>
			<td><?=$year[$i][8][1][$j][1]?></td>
			<td><?=$year[$i][9][1][$j][1]?></td>
			<td><?=$year[$i][10][1][$j][1]?></td>
			<td><?=$year[$i][11][1][$j][1]?></td>
			<td><?=$year[$i][12][1][$j][1]?></td>
			<td><?=$total?></td>
		</tr><?php
	}
	?>
	</table>
	<?php
}
?>
</div>
</div>
</div>
<!-- Quarterly Tables For Response By Week/Quarter/Year End -->
</div> <!-- end whole wrap -->
</body>
<?php page_finish(); ?>
