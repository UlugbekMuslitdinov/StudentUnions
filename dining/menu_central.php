<?php

// authenticate with WebAuth
$webauth_splash = '';
require_once('webauth/include.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Menu Central</title>

<style type="text/css">
* {
	margin:0;
	padding:0;
}

body {
	color:#000000;
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}

#calGrid {
	border: 1px solid #efefef;
	margin:20px auto 20px auto;
	padding: 20px;
	width:800px;
}

ul {
	list-style-type:disc;
	list-style-position: outside;
	margin:5px 20px 0 0;
	padding:0 0 15px 26px;

}

ul li {
	color:#666666;
	line-height:15px;
	margin:0;
	padding:0 0 4px 0;
}

ol {
	list-style-type: decimal;
	list-style-position: outside;
	margin:5px 20px 0 0;
	padding:0 0 15px 26px;

}

ol li {
	color:#000000;
	line-height:15px;
	margin:0;
	padding:0 0 4px 0;
}

</style>

</head>

<body>
<div id="calGrid">

<div style="margin:auto;">
	<h1 style="text-align:center; margin-bottom:10px;">Menu Central</h1>
	
	<h3>Which menu would you like to manage?</h3>
	<ol>
		<li><a href="/dining/menu_arizonaroom/admin_menu.php">Arizona Room</a></li>
		<li><a href="/dining/menu_85north/admin_menu.php">85 North</a></li>
		<li>Bear Down Kitchen
		<ul style="padding-bottom:0;">
			<li><a href="/dining/menu_bdk/breakfast/admin_menu.php">Breakfast</a></li>
			<li>Lunch
			<ul style="padding-bottom:0;">
				<li><a href="/dining/menu_bdk/grill/admin_menu.php">Grill & Deli</a></li>
				<li><a href="/dining/menu_bdk/lunch/admin_menu.php">Lunch</a></li>
				<li><a href="/dining/menu_bdk/pizza/admin_menu.php">Pizza</a></li>
				<li><a href="/dining/menu_bdk/salad/admin_menu.php">Salad Bar</a></li>
				<li><a href="/dining/menu_bdk/saute/admin_menu.php">Pasta/Stir-Fry</a></li>
			</ul></li>
			</li>
		</ul></li>

		<li>Cactus Grill
		<ul style="padding-bottom:0;">
			<li><a href="/dining/menu_cactus/hotline/admin_menu.php">Lunch</a></li>
			<li><a href="/dining/menu_cactus/hotline_dinner/admin_menu.php">Dinner</a></li>
		</ul></li>
		<li><!--<a href="/dining/menu_mesa/admin_menu.php">-->Mesa Room<!--</a>--> (closed)</li>
		<li>Pangea
		<ul style="padding-bottom:0;">
			<li><a href="/dining/menu_pangea/italian/admin_menu.php">Italian</a></li>
			<li><a href="/dining/menu_pangea/worldfare/admin_menu.php">World Fare</a></li>
		</ul></li>
		<li><!--<a href="/dining/redington_menu/admin_menu.php">-->Redington Restaurant<!--</a>--> (closed)</li>
	</ol>
	</div>

<?php
echo '<p style="padding-top:5px; text-align:center;"><a href="https://webauth.arizona.edu/webauth/logout?logout_href=http://' . $_SERVER['SERVER_NAME'] . '/dining/menu_central.php/&logout_text=Return%20to%20Menu%20Central">Logout of UA NetID WebAuth</a></p>';
?>


</div>

</body>
</html>