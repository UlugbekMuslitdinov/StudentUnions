<?php
	require($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'SICKFEST';
	page_start($page_options);
?>
<html>
<head>
<title>SICKFEST</title>
<style type="text/css">
body, html {
	margin:0;
	padding:0;
	background-color:#FFF;
}
a, img, a:hover, a:active, a:focus, a:visited {
	text-decoration:none;
	border:0;
	outline: none;
	cursor:pointer;
}
#wrapper {
	text-align:center;
	width:950px;
	height:702px;
	background-image:url('images/home.jpg');
	margin-left:auto;
	margin-right:auto;
	margin-top:10px;
}
#footer_text {
	text-align:center;
	width:950px;
	height:90px;
	background-image:url('images/footertext.png');
	margin-left:auto;
	margin-right:auto;
	margin-top:10px;
}

#purchase {
	width:201px;
	height:50px;
	position:relative;
	top:610px;
	left:730px;
	background-image:url('images/button.png');
}
</style>
<script type="text/javascript" src="https://union.arizona.edu/commontools/jslib/jquery.js" ></script>
<link rel="stylesheet" href="https://union.arizona.edu/commontools/jslib/shadowbox/shadowbox.css" type="text/css" />
<script type="text/javascript" src="https://union.arizona.edu/commontools/jslib/shadowbox/shadowbox.js" ></script>
<script type="text/javascript">
Shadowbox.init();
</script>
</head>
<body>

<div id="wrapper">
<a rel="shadowbox[PURCHASE];width=650;height=465;color=#FFF;" href="tickets.php">
    <div id="purchase"></div> 
</a>
</div>
<div id="footer_text" title="Friday, March 25, 8pm, Cellar Bistro, FREE: Improv w/ Comedy Corner, Barren Mind & Farce Side Comedy Hour.
Saturday, March 26, 6pm, Social Sciences 100, $5: Comedy Corner and Grahm Elwood open for DOUG BENSON.
** Get your tickets online here or in the Student Union Games Room, or at the door.**">
</div>
</body>
</html>