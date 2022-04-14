<?php
session_start();
// Web Auth Login required
$webauth_splash = '';
require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];

// Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/mysqli.inc');

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

// Get shift date, location, task, and attendance for every shift for this employee. This is the 'Previously approved shifts' table at bottom of page
$query = "SELECT * FROM SignupTasks AS ST
            WHERE ST.employee_id = '" . $id . "' AND ST.status = 'Approved'  ";
$result = $db->query($query);
$result = $result->fetch_assoc();
if ($result) {
    $query_2 = "SELECT S.shift_date, T.task, L.location, ST.attendance, S.id AS shiftID, S.time_from AS time_from, S.time_to AS time_to, Si.performance AS performance
            FROM signup.SignupTasks AS ST
            JOIN signup.Shifts AS S ON ST.shift_id = S.id 
            JOIN signup.Tasks AS T ON ST.task_id = T.id
            JOIN signup.Locations AS L ON S.location_id = L.id
            JOIN signup.Signups AS Si ON S.id = Si.shift_id
            WHERE ST.employee_id = '" . $id . "' AND ST.status = 'Approved' ORDER BY S.shift_date DESC  ";
    $result_2 = $db->query($query_2);
    //begin table structure
    $signupTasks_msg = '<div class="headtitle">Previously approved shifts:</div>
                        <table class="shiftsTable table-responsive"  border="0" cellpadding="5">
                            <tr>
                                <td class="headtitle shiftsTableTD">Shift Date</td>
                                <td class="headtitle shiftsTableTD">Shift Time</td>
                                <td class="headtitle shiftsTableTD">Location</td>
                                <td class="headtitle shiftsTableTD">Task</td>
                                <td class="headtitle shiftsTableTD">Attendance</td>
                                <td class="headtitle shiftsTableTD">Performance</td>
                            </tr>';
    //initialize row id to be added to radio id and label. If radios don't have unique id for each iteration of while loop all labels will set the first row.
    $rowid = 0;
    while ($row = mysqli_fetch_array($result_2, MYSQLI_ASSOC)) {
        $rowid++; 
        //check if performance has been entered and allow edit if not
        if (!$row['performance']) {
            $row['performance'] = '
                <a href="edit_performance.php?shift_id='.$row['shiftID'].'&id='.$id.'&performance=Excellent"><button type="button" name="performance" value="Excellent" id="Excellent'.$rowid.'"><b>Excellent</b></button></a>
		        <a href="edit_performance.php?shift_id='.$row['shiftID'].'&id='.$id.'&performance=Average"><button type="button" name="performance" value="Average"  id="Average'.$rowid.'"><b>Average</b></button></a>
			    <a href="edit_performance.php?shift_id='.$row['shiftID'].'&id='.$id.'&performance=Poor"><button type="button" name="performance" value="Poor" id="Poor'.$rowid.'"><b>Poor</b></button></a>
                ';
        }
        //check if attendance has been entered and allow edit if not
        if (!$row['attendance']) {
            $row['attendance'] = '<a href="./view_shifts.php?id=' .$row['shiftID'].'"><button type="button"><b>Edit Shift</b></button></a>';
        }
        $signupTasks_msg .= '<tr>
                    <td class="shiftsTableTD">' . $row['shift_date'] . '</td>
                    <td class="shiftsTableTD">' . $row['time_from'] . ' - ' . $row['time_to'] . '</td>
                    <td class="shiftsTableTD">' . $row['location'] . '</td>
                    <td class="shiftsTableTD">' . $row['task'] . '</td>
                    <td class="shiftsTableTD">' . $row['attendance'] . '</td>
                    <td class="shiftsTableTD">' . $row['performance'] . '</td>
                </tr>';
    	}
		$signupTasks_msg .= '</table>';
} else {
    $signupTasks_msg = '<div class="headtitle">This employee has zero approved shifts</div>';
}

//Retrieve and display comments about employee from Comments table
$query = "SELECT * FROM Comments WHERE employee_id =". $id ."";
$result = $db->query($query);
$result = $result->fetch_assoc(); //just to check if there are comments for this employee
if ($result) {
    //initialize list for comments that will be added to 'Comment Records' section
    $previousComments = '<ul class="commentRecord">';
    //get fresh query so fetch_assoc() hasnt been applied yet
    $query = "SELECT * FROM Comments WHERE employee_id =". $id ." ORDER BY timestamp DESC";
    $result = $db->query($query);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        //first change timestamp to mm/dd/yyyy format for each Comments table row
        $time = $row['timestamp'];
        $time = date("m/d/Y", strtotime($time));
        //set up list item for each comment
        $previousComments .= '<li>' . $row['comment'] .' ';
        $previousComments .= '<span class="netid">by '. $row['netid'] .'</span> ('. $time .')';
        $previousComments .= '</li>';
    }
    $previousComments .= '</ul>';
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
        vertical-align: top;
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
    .commentRecord {
        font-weight: normal;
    }
    .netid {
        color: darkred;
    }
</style>
<link rel="stylesheet" href="shifts.css">
<body>
<div class="container" style="margin-bottom:50px;">
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
        <td class="headtitle">Banned</td>
        <td class="text_bold">
			<input type="radio" name="banned" value="Yes" <?php if ($employee['banned'] == "Yes") { ?>checked <?php } ?>>&nbsp;Yes&nbsp;&nbsp;&nbsp;
		    <input type="radio" name="banned" value="No" <?php if ($employee['banned'] == "No") { ?>checked <?php } ?>>&nbsp;No&nbsp;&nbsp;&nbsp;
		</td>
    </tr>
    <tr>
        <td class="headtitle">Comment Records</td>
        <td class="text_bold">
			<?=$previousComments?>
		</td>
    </tr>
	<tr>
        <td class="headtitle">Comment</td>
        <td class="text_bold">
			<textarea name="note" cols="100%" rows="5" id="note" placeholder="Add a comment. Your netID will be shown with your comment."></textarea>
		</td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td><input type="hidden" name="employee_id" value="<?=$id?>" >
		  <input type="submit" name="submit" class="button" value="SUBMIT" id="submit">&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="button" value="GO BACK" class="button" onclick="window.history.back()" />
	  </td>
    </tr>
</table> 
</form>
</div>
<?=$signupTasks_msg?>
</body>
<?php page_finish(); ?>