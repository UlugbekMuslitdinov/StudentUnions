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
// Get supervisor details and employee info for that employee.
$query = "SELECT * FROM signup.Supervisors WHERE id=" . $id ."";
$result = $db->query($query);
//$employee = mysqli_fetch_assoc($result);
$supervisor = $result->fetch_assoc();
//fill out employees under current supervisor
$query = "SELECT first_name, last_name FROM Employees WHERE supervisor_id=". $id ."";
$result = $db->query($query);
$employees_msg = '';
$employee_count = 0;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 
    $employee_count++;
    $employees_msg .= "<div>" . $row["first_name"] . " " . $row["last_name"] . "</div>";
}

?><head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="shifts.css"></link>
</head>

<style>
    table {
        table-layout: fixed;
        max-width: 750px;
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
    $query = "DELETE FROM signup.Supervisors WHERE id =". $id . "";
    $result = $db->query($query);
    if ($result) {
        ?>
        <body>
            <div class="col-12 page_title">Delete Supervisor - Success</div>
            <div class="order-form-post">
                The following Supervisor information has been successfully deleted:
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td class="headtitle">Name</td>
                    <td><?=$supervisor['first_name']?> <?=$supervisor['last_name']?></td>
                </tr>
                <tr>
                    <td class="headtitle">Email</td>
                    <td><?=$supervisor['email']?></td>
                </tr>
                <tr>
                    <td>
                        <button><a href="./supervisors.php">Go Back</a></button> &nbsp;&nbsp;
                    </td>
                </tr>
        </table>
        </body>
        <?php
    }
} else {
?>
<body>
<form name="form" action="" method="POST">
<table width="100%" border="0" cellpadding="5">
<tr>
        <td class="headtitle">Name</td>
        <td><?=$supervisor['first_name']?> <?=$supervisor['last_name']?></td>
    </tr>
    <tr>
        <td class="headtitle">Email</td>
        <td><?=$supervisor['email']?></td>
    </tr>
    <tr>
        <td class="headtitle">Employees (<?=$employee_count?>)</td>
        <td><?=$employees_msg?></td>
    </tr>
	<tr>
        <td>&nbsp;</td>
        <td>
          <input type="hidden" name="employee_id" value="<?=$id?>" >
          <div class="headtitle deleteTXT">Would you like to delete this supervisor?</div>
		  <input type="submit" name="submit" class="button" value="submit" id="submit">
        </td>
    </tr>
</table>
</form>

</body>
<?php } ?>
<?php page_finish(); ?>