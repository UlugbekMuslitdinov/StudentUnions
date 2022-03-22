<?php
session_start();
unset($_SESSION['authorized']);
require_once('cardtaker/cardtaker.inc');
?>
<html>
<head>
<title></title>
<link rel="stylesheet" href="https://union.arizona.edu/commontools/cardtaker/cardtaker.css" type="text/css" />
<script type="text/javascript" src="https://union.arizona.edu/commontools/cardtaker/cardtaker.js" ></script>
<style type="text/css">
body, html, {
	margin:none;
	padding:0;
}
#wrapper {
	text-align:center;
	margin-left:45px;
	font-family:Helvetica,Verdana, Geneva, sans-serif;
}
.ct_table {
	margin-left:auto;
	margin-right:auto;
	color:#FFF;
}
#submit_row, #total_row {
	display:none;
}
#wrapper h2 {
	display:none;
}
a, img, a:hover, a:active, a:focus, a:visited {
	text-decoration:none;
	border:0;
	outline: none;
	cursor:pointer;
}
#ct_error {
	height:20px;
	display:block;
}
</style>
</head>
<body style="background-image:url('images/orderform_bg.png');background-repeat:repeat;color:#FFF;">
<div id="wrapper">
<div style="width:100%; text-align:left; margin-bottom:8px; margin-top:30px; margin-left:-15px;"><img src="images/billing_info_head.png" /></div>
<div style="width:100%;height:273px;">
<?php
if ($_POST['submited'] == "Submited") {
	$_SESSION['generalAdmissions'] = $_POST['generalAdmissions'];
	$_SESSION['studentTickets'] = $_POST['studentTickets'];
}
$stuPrice = 5;
$genPrice = 5;
$total = $stuPrice*$_SESSION['studentTickets'] + $genPrice*$_SESSION['generalAdmissions'];
$_SESSION["total"] = $total;
$initial_values = array(
    'orderAmount'=>$total  //required
);
$order_form = new payment_process($initial_values);
$order_form->display_form();
?>
</div>
</div>
<br />
<div style="text-align: right; margin-top:45px; margin-right: 15px; float: right;">
<a href="javascript:if(validateInput(document.ct_form)){ document.ct_form.submit();}"><img src="images/submit_pymnt_btn.png" /></a>
</div>
<div style="margin-right:20px;margin-top:65px;float:right;font-family:Helvetica, sans-serif;font-size:20px;">AMNT TO BE CHARGED: $<?php echo $total; ?></div>
</body>
</html>