<?php
include('./functions/main.php');
loginCheck();

if(isset($_SESSION['webauth'])) {
	$netid = $_SESSION['webauth']['netID'];
	$emplid = $_SESSION['webauth']['emplid'];
	// echo "netID2: " . $_SESSION['webauth']['netID'] . "</br>";
	// echo "emplid2: " . $_SESSION['webauth']['emplid'] . "</br>";
	updateDB($netid, $emplid);
	header("Location: https://digitalcampus.swankmp.net/VS-UOA44480/watch/18502d9da95ce5d1");
	// header("Location: https://digitalcampus.swankmp.net/vs-uoa44480/play/c4ad9a4e16715cca?referrer=direct");	
}

?>
<html>
<head>
<meta charset="utf-8">
<title>Gallagher Movie Streaming</title>
</head>

<body>
	<!--
	Gallagher Movie Streaming <br />
	<h1>HELLO!<a id="form-login-btn" href="/mealplans/index.php?logout=1" class="learn-more" style="font-size:11px; font-weight:bold;"><br />Log out</a></h1>
-->
</body>
</html>
