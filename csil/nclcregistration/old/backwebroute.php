<?php
	session_start();
	
	
	if(!isset($_SERVER['HTTPS']))
		{
			header("location: https://www.union.arizona.edu/csil/nclcregistration/backweb.php");
		}

	if(!isset($_SESSION['netID'])){

	if(!isset($_GET['ticket'])) {
		header("Location: https://webauth.arizona.edu/webauth/login?service=https://www.union.arizona.edu/csil/nclcregistration/backweb.php");
	}else {
		
		$tix = $_GET['ticket'];
		$url = '"https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service=https://www.union.arizona.edu/csil/nclcregistration/backweb.php"';
		exec("curl -m 120 $url " ,$return_message_array, $return_number);
		
	
		$netID = $return_message_array[2];
	
		$netID = trim(str_replace("<cas:user>","",str_replace("</cas:user>","", $netID)));
		$_SESSION['netID'] = $netID;
	}
}
	
	include_once("../common/page_startbw.php");

	
	/*if($_SESSION['netID'] != styx $_SESSION['netID'] != sanorris  && $_SESSION['netID'] != ahoefner && $_SESSION['netID'] != hroundtr && $_SESSION['netID'] != tam && $_SESSION['netID'] != den && $_SESSION['netID'] != crs) {  
	
		echo "not allowed";
	
	
	}
	else {*/
	
	
	
	
	$DBlink = mysql_connect("trinity.sunion.arizona.edu", "web", "viv3nij")
			or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later. (error 1)</p>");
	
		//Choose DB
		mysql_select_db("NCLC09", $DBlink)
			or die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 2)</p>");
	
	
if (isset($_POST['search'])) {
	$_SESSION['search'] = $_POST['search'];
	}


print "<div class=\"content_block\">";

if ($_SESSION['search'] == "names" || $_SESSION['search'] == "email" || $_SESSION['search'] == "total" || isset($_GET['expand']) || isset($_GET['group'])) {

include_once('backwebres.php');

} elseif ($_SESSION['search'] == "tShirts" || $_SESSION['search'] == "meals" || $_SESSION['search'] == "housing") {

include_once('backwebcount.php');

} else {

print "Your Search Produced No Results";

print "<br>";
				
print "<a href=\"backweb.php\">Start New Search</a>";

}



print "</div>";

//NETID TEST
//}

	include_once("../common/page_end.php");
?>