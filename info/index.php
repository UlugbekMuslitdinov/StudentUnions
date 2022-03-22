<?php
include('./functions/main.php');

require_once ('../commontools/includes/mysqli.inc');
$db = new db_mysqli('su');

$webauth_splash = '';
require_once('../commontools/webauth/include.php');
$netID = $_SESSION['webauth']['netID'];


if(isset($_SESSION['webauth']['netID'])) {
    echo 'Logged In as ' . $netID;
}

$query = 'select * from admin_users where netid="' . $netID . '" LIMIT 1';
$result = $db->query($query);

$result = $result->fetch_assoc();

if($result['access_level'] == 3){

}
else{
	print 'Permission denied.';
    header("Location: /");
    die('Permission denied.');
}

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'INFO';
page_start($page_options);
?>

<div>
    <form method="POST">
        <div>
            <label>Student ID</label>
            <input type="text" name="id" required>
        </div>
        <div>
            <label>Term</label>
            <input type="text" name="term" required>
        </div>
        <div>
            <input type="submit" name="submit">
        </div>
    </form>
</div>
<?php


if(isset($_POST['submit'])) {
    $custId = addslashes($_POST['id']);
    $term = addslashes($_POST['term']);


    $custInfo = getCustInfo($custId);

    $enrollment = getEnrollment($custId, $term);

    echo '<div><p>';

    if (!empty($custInfo) && isset($custInfo)) {

        foreach($custInfo as $k => $v) {
            echo '<b>' . $k . ':</b> ';
            print_r($v);
            echo '<br>';
        }

    } else {

        echo "Didn't find anything";

    }


    if (!empty($enrollment) && isset($enrollment)) {

        foreach($enrollment as $k => $v) {
            echo '<b>' . $k . ':</b> ' . $v . '<br>';
        }


    } else {

        echo "Didn't find anything";

    }

    echo '</p></div>';
}
?>

<?php
echo '<p style="text-align:center;"><a href="https://webauth.arizona.edu/webauth/logout?logout_href=https://' . $_SERVER['SERVER_NAME'] . '/info/index.php/&logout_text=">Logout of UA NetID WebAuth</a></p>';
?>

<?php page_finish(); ?>