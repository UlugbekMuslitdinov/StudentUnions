<?php

check_login();

function check_login() {
    $webauth_splash = '';
    require_once ($_SERVER['DOCUMENT_ROOT'].'/commontools/includes/mysqli.inc');
    require_once($_SERVER['DOCUMENT_ROOT'].'/commontools/webauth/include.php');

    $netID = $_SESSION['webauth']['netID'];


    if(isset($_SESSION['webauth']['netID'])) {
        // echo 'Logged in as ' . $netID . '<br>';
    }

    $db = new db_mysqli('su');

    $query = 'select * from admin_users where netid="' . $netID . '" LIMIT 1';
    $result = $db->query($query);

    $result = $result->fetch_assoc();

    if($result['access_level'] == 3){

    }
    else{
        die('Permission denied.');
        // header("Location: ../");
        exit();
    }
}

function logout($url) {
    echo '<p style="text-align:center;"><a href="https://webauth.arizona.edu/webauth/logout?logout_href=https://' . $_SERVER['SERVER_NAME'] . $url .'?logout_text=">Logout of UA NetID WebAuth</a></p>';
}
?>