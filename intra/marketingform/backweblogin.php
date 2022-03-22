<?php

if(!isset($_SERVER['HTTPS']))
    {
        header("location: https://union.arizona.edu/intra/marketingform/backweblogin.php");
    }

	session_start();
	include('webauth/webauth.php');
	$_SESSION['netID'] = $_SESSION['webauth']['netID'];
	include_once('access.php');
	
	for ($i = 1; $i <= $empCount; $i++) {
		if($_SESSION['netID'] == $user[$i]['netID']) {
		$access = true;
		$id = $i;
		}
	} 
	
	if ($access == true) {
	 require('global.inc');
  $page_options['title'] = 'Union Marketing Request Form:';
  page_start($page_options);
	?>
	
    <div style="padding-left:20px;">
    <h4>Marketing Request Backweb</h4>
    
    <?
	if (isset($user[$id]['pic']) && ($user[$id]['pic'] != "" )) {
	print "<table>";
		print "<tr>";
			print "<td width=\"150px\" style=\"vertical-align:top\">";
		print "<span style=\"font-size:14px; font-weight:bold\">Welcome " . $user[$id]['name'] . "!</span>";
			if ($user[$id]['rank'] == "admin") {
			print "<br /><font color=\"#FF0000\">Admin Status</font>";
			}

			print "</td>";
			print "<td>";
		print "<img src=\"images/" . $user[$id]['pic'] . "\">";
			print "</td>";
		print "</tr>";
	print "</table>"; 
	} else {
		print "<span style=\"font-size:14px; font-weight:bold\">Welcome " . $user[$id]['name'] . "!</span>";
			if ($user[$id]['rank'] == "admin") {
			print "<br /><font color=\"#FF0000\">Admin Status</font>";
			}
	}
	
	print "<br><br>";
	
	print "<a href=\"backweb.php\">View all new and current marketing requests</a>";
	print "<br>";
	print "<a href=\"backweb.php?assigned=" . $user[$id]['name'] . "\">View only current marketing requests assigned to YOU </a>";
	
	?>
	    </div>
<?php 
page_finish(); 
} else {
echo "not allowed";
}
?>