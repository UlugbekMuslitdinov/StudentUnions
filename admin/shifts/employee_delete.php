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


?><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="shifts.css"></link>
</head>

<style>
    table {
        table-layout: fixed;
        margin: auto;
        margin-top: 50px;
    }
    td {
        font-size: 18px !important;
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
    .deleteTXT {
        color: red;
        font-size: 26px;
    }
</style>

<?php
if (isset($_POST["submit"])) {
    
    $query = "DELETE FROM signup.Employees WHERE id =". $id . "";
    
    $result = $db->query($query);
    if ($result) {
        ?>
        <body>
            <div class="col-12 page_title">Delete Employee - Success</div>
            <div class="order-form-post">
                The following employee information has been successfully deleted:
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td width="300" class="data"><div class="text_bold">FIRST NAME: </div></td>
                    <td><div class="text_bold">
                        <?=$employee["first_name"]?>
                </div></td>
                </tr>
                <tr>
                    <td width="300" class="data"><div class="text_bold">LAST NAME: </div></td>
                    <td><div class="text_bold">
                        <?=$employee["last_name"]?>
                </div></td>
                </tr>
                <tr>
                    <td width="300" class="data"><div class="text_bold">EMAIL: </div></td>
                    <td><div class="text_bold">
                        <?=$employee["email"]?>
                </div></td>
                </tr>
                <tr>
                    <td width="300" class="data"><div class="text_bold">NetID: </div></td>
                    <td><div class="text_bold">
                        <?=$employee["netid"]?>
                </div></td>
                </tr>
                <tr>
                    <td width="300" class="data"><div class="text_bold">Affiliation: </div></td>
                    <td><div class="text_bold">
                        <?=$employee["affiliation"]?>
                </div></td>
                </tr>
                <tr>
                    <td width="300" class="data"><div class="text_bold">Supervisor: </div></td>
                    <td><div class="text_bold">
                    <?=$employee['supervisor_first_name']?> <?=$employee['supervisor_last_name']?>
                </div></td>
                </tr>
                <tr>
                    <td>
                        <button><a href="./employees.php">Go Back</a></button> &nbsp;&nbsp;
                    </td>
                </tr>
        </table>
        </body>
        <?php
    }
} else {
?>
<body>
<div style="margin-top:30px; margin-bottom: 20px;"><a href="index.php"><button class="navigation">SHIFT LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="employees.php"><button class="navigation">EMPLOYEE LIST</button></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
<form name="form" action="" method="POST">
<table width="100%" border="0" cellpadding="5">
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
        <td>&nbsp;</td>
        <td>
          <input type="hidden" name="employee_id" value="<?=$id?>" >
          <div class="headtitle deleteTXT">Would you like to delete this employee?</div>
		  <input type="submit" name="submit" class="button" value="submit" id="submit">
        </td>
    </tr>
</table>
</form>
	
</body>
<?php } ?>
<?php page_finish(); ?>