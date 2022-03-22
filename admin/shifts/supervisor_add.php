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
$page_options['title'] = 'Supervisors';
page_start($page_options);	
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="shifts.css">
</head>
<style type="text/css">
    table {
        table-layout: fixed;
        max-width: 750px;
        margin: auto;
        border-collapse:separate; 
        border-spacing:15px;
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
    .order-form-post {
        font-size: 20px;
        font-style: italic;
    }

</style>
<?php
function checkForm() {
    // Form validation goes here.
    return true;
}

//database
$db = new db_mysqli('signup');
$query = "SELECT MAX(id) FROM Supervisors WHERE id != '999'"; //get max id of table that isn't id 999 'Other' option. If you don't use MAX(id)+1 for new supervisor id the default id is '1000'
$result = $db->query($query);
$maxID = mysqli_fetch_array($result);
$newID = $maxID[0] + 1;

if (isset($_POST["submit"])) {
    if (checkForm()) {
        $query = "INSERT INTO Supervisors (id, first_name, last_name, email) 
            VALUES ('" . $newID . "', '" . $_POST["first_name"] . "', '" . $_POST["last_name"] . "', '" . $_POST["email"] ."')  ";
    }
    $result = $db->query($query);
    if ($result) {
        ?>
        <body>
            <div class="col-12 page_title">Add Supervisor - Success</div>
            <div class="order-form-post">
                The following supervisor information has been successfully added:
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr>
                    <td width="300" class="data"><div class="text_bold">FIRST NAME: </div></td>
                    <td><div class="text_bold">
                        <?=$_POST["first_name"]?>
                </div></td>
                </tr>
                <tr>
                    <td width="300" class="data"><div class="text_bold">LAST NAME: </div></td>
                    <td><div class="text_bold">
                        <?=$_POST["last_name"]?>
                </div></td>
                </tr>
                <tr>
                    <td width="300" class="data"><div class="text_bold">EMAIL: </div></td>
                    <td><div class="text_bold">
                        <?=$_POST["email"]?>
                </div></td>
                </tr>
                <tr>
                    <td>
                        <button><a href="./supervisors.php">Go Back</a></button> &nbsp;&nbsp;
                        <button><a href="./supervisor_add.php">Add Another</a></button>
                    </td>
                </tr>
        </table>
        </body>
        <?php
    }
} else {
?>
<body>
<div class="col-12 page_title">Add Supervisor</div>
<div class="order-form">
<form name="form" class="form-inline" action="" method="POST" onSubmit="return checkForm();">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
            <td width="300" class="data"><div class="text_bold">FIRST NAME <span class="asterisk">*</span></div></td>
            <td>
                <input type="text" name="first_name" required>
            </td>
        </tr>
        <tr>
            <td width="300" class="data"><div class="text_bold">LAST NAME <span class="asterisk">*</span></div></td>
            <td>
                <input type="text" name="last_name" required>
            </td>
        </tr>
        <tr>
            <td width="300" class="data"><div class="text_bold">EMAIL <span class="asterisk">*</span></div></td>
            <td>
                <input type="email" name="email" required>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" class="button" value="submit" id="submit"></td>
        </tr>
</table>
</div>
</body>
<?php } ?>
<?php page_finish(); ?>