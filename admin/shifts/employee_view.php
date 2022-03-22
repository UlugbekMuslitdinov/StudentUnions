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
$page_options['title'] = 'View Employee';
page_start($page_options);	
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');
$id = $_GET['id']; //employee id
$db = new db_mysqli('signup');
// Get employee details and supervisor info for that employee.
$query = "SELECT E.*, S.first_name AS supervisor_first_name, S.last_name AS supervisor_last_name 
            FROM signup.Employees E JOIN signup.Supervisors S ON E.supervisor_id=S.id
            WHERE E.id=" . $id ."";
$result = $db->query($query);
//$employee = mysqli_fetch_assoc($result);
$employee = $result->fetch_assoc();

// Get shift date, location, task, and attendance for every shift for this employee.
$query = "SELECT * FROM signup.SignupTasks AS ST
            WHERE ST.employee_id = '" . $id . "' AND ST.status = 'Approved'  ";
$result = $db->query($query);
$result = $result->fetch_assoc();
if ($result) {
    $query = "SELECT S.shift_date, T.task, L.location, ST.attendance, S.id AS shiftID, S.time_from AS time_from, S.time_to AS time_to
            FROM signup.SignupTasks AS ST
            JOIN signup.Shifts AS S ON ST.shift_id = S.id 
            JOIN signup.Tasks AS T on ST.task_id = T.id
            JOIN signup.Locations AS L on S.location_id = L.id
            WHERE ST.employee_id = '" . $id . "' AND ST.status = 'Approved' ORDER BY S.shift_date DESC  ";
    $result = $db->query($query);
    //begin table structure
    $signupTasks_msg = '<div class="headtitle">Previously approved shifts:</div>
                        <table class="shiftsTable table-responsive"  border="0" cellpadding="5">
                            <tr>
                                <td class="headtitle shiftsTableTD">Shift Date</td>
                                <td class="headtitle shiftsTableTD">Shift Time</td>
                                <td class="headtitle shiftsTableTD">Location</td>
                                <td class="headtitle shiftsTableTD">Task</td>
                                <td class="headtitle shiftsTableTD">Attendance</td>
                            </tr>';
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
        if (!$row['attendance']) {
            $row['attendance'] = '<a href="./view_shifts.php?id=' .$row['shiftID'].'"><button type="button"><b>Edit Shift</b></button></a>';
        }
        $signupTasks_msg .= '<tr>
                    <td class="shiftsTableTD">' . $row['shift_date'] . '</td>
                    <td class="shiftsTableTD">' . $row['time_from'] . ' - ' . $row['time_to'] . '</td>
                    <td class="shiftsTableTD">' . $row['location'] . '</td>
                    <td class="shiftsTableTD">' . $row['task'] . '</td>
                    <td class="shiftsTableTD">' . $row['attendance'] . '</td>
                </tr>';
    }
} else {
    $signupTasks_msg = '<div class="headtitle">This employee has zero approved shifts</div>';
}

?><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    table {
       
        margin: auto;
        margin-top: 10px;
    }
    td {
        font-size: 18px !important;
    }
    .shiftsTable {
        text-align: center;
    }
    .shiftsTableTD {
        border: 1px solid black;
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
</style>
<link rel="stylesheet" href="shifts.css">
<body>
<div class="container">
<div style="margin-top:30px; margin-bottom: 20px;"><a href="index.php"><button class="navigation">SHIFT LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="employees.php"><button class="navigation">EMPLOYEE LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
<form name="form" action="edit_employee.php" method="POST">
<table class="table-responsive" border="0" cellpadding="5">
    <tr>
        <td class="headtitle" width="200px">Name</td>
        <td width="800px"><?=$employee['first_name']?> <?=$employee['last_name']?></td>
    </tr>
    <tr>
        <td class="headtitle">Email</td>
        <td><?=$employee['email']?></td>
    </tr>
    <tr>
        <td class="headtitle">Phone</td>
        <td><?=$employee['phone']?></td>
    </tr>
    <tr>
        <td class="headtitle">NetID</td>
        <td><?=$employee['netid']?></td>
    </tr>
    <tr>
        <td class="headtitle">Affiliation</td>
        <td><?=$employee['affiliation']?></td>
    </tr>
    <tr>
        <td class="headtitle">Supervisor</td>
        <td><?=$employee['supervisor_first_name']?> <?=$employee['supervisor_last_name']?></td>
    </tr>
    <tr>
        <td class="headtitle">Performance</td>
        <td class="text_bold">
			<input type="radio" name="performance" value="Excellent" <?php if ($employee['performance'] == "Excellent") { ?>checked <?php } ?>>&nbsp;Excellent&nbsp;&nbsp;&nbsp;
		    <input type="radio" name="performance" value="Average" <?php if ($employee['performance'] == "Average") { ?>checked <?php } ?>>&nbsp;Average&nbsp;&nbsp;&nbsp;
			<input type="radio" name="performance" value="Poor" <?php if ($employee['performance'] == "Poor") { ?>checked <?php } ?>>&nbsp;Poor&nbsp;&nbsp;&nbsp;
		</td>
    </tr>
    <tr>
        <td class="headtitle">Banned</td>
        <td class="text_bold">
			<input type="radio" name="banned" value="Yes" <?php if ($employee['banned'] == "Yes") { ?>checked <?php } ?>>&nbsp;Yes&nbsp;&nbsp;&nbsp;
		    <input type="radio" name="banned" value="No" <?php if ($employee['banned'] == "No") { ?>checked <?php } ?>>&nbsp;No&nbsp;&nbsp;&nbsp;
		</td>
    </tr>
	<tr>
        <td class="headtitle">Comment</td>
        <td class="text_bold">
			<textarea name="note" cols="100%" rows="5" id="note" ><?=$employee['comment']?></textarea>
		</td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td><input type="hidden" name="employee_id" value="<?=$id?>" >
		  <input type="submit" name="submit" class="button" value="SUBMIT" id="submit">&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="button" value="GO BACK" class="button" onclick="window.history.back()" />
	  </td>
    </tr>
</table> <br><br>
<?=$signupTasks_msg?>
</form>
</div>
</body>
<?php page_finish(); ?>