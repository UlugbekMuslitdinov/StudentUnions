<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/commontools/mysql_link.inc');
if (!$DBlink) {
	$error=TRUE;
	die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 1)<br />" . mysql_error()) . "</p>";
}
$DBselected = mysql_select_db("sickfest", $DBlink);
if (!$DBselected) {
	$error=TRUE;
	die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 2)<br />" . mysql_error()) . "</p>";
}
$query = 'SELECT (sum(num_student)+sum(num_general)) AS total_sold FROM purchase;';
$result = mysql_query($query, $DBlink);
if (!$result) {
	$error=TRUE;
	die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 3)<br />" . mysql_error()) . "</p>";
}
else {
	$tickets = mysql_fetch_assoc($result);
	$tickets = $tickets['total_sold'];
	$maxSale = 350;
	$soldout = FALSE;
	if ($tickets > $maxSale) {
		$soldout = TRUE;
	}
}
if (!$soldout):
?>
<html>
<head>
<style type="text/css">
a, img, a:hover, a:active, a:focus, a:visited {
	text-decoration:none;
	border:0;
	outline: none;
	cursor:pointer;
}
</style>
</head>
<body style="font-family:Helvetica, Verdana, Geneva, sans-serif;font-size:12px; background-image:url('images/orderform_bg.png'); background-repeat:repeat; color:#FFF;">
<div style="margin-left:30px;margin-top:30px;height:340px;">
<div style="width:100%;float:left;margin-bottom:15px;">
<img src="images/purchase_tix_head.png" alt="Purchase Tickets" width="167" height="22">
</div>
<?php
if ($_SESSION['authorized']==TRUE && $_SESSION['webauth']['activestudent']==TRUE) {
	$isStudent = TRUE;
	$_SESSION['netID'] = $_SESSION['webauth']['netID'];
	$query = 'SELECT id FROM purchase WHERE netID="'.$_SESSION['netID'].'";';
	$result = mysql_query($query, $DBlink);
	if (!$result) {
		$error=TRUE;
		die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please try again later.  (error 3)<br />" . mysql_error()) . "</p>";
	}
	if ($error) {
		$isStudent = FALSE;
		echo "Sudent Ticket Verification Error!";
	}
	else {
		if (!mysql_fetch_assoc($result)) {
			$isStudent = TRUE;
		}
		else {
			$isStudent = FALSE;
			$hasPurchasedStudent = TRUE;
		}
	}
}
else {
	$isStudent = FALSE;
}
?>
<div style="width:100%;float:left;margin-bottom:8px;font-size:14px;">
Event: <strong>Doug Benson</strong> - UA SOCIAL SCIENCES BLDG. RM 100
</div>
<form id="paymentForm" name="paymentForm" method="post" action="payment.php" >
  <input type="hidden" name="submited" value="Submited" >
  <?php
		  if ($isStudent):
  ?>
  <script type="text/javascript">
  	<!--
	var browserType;
	if (document.layers) {browserType = "nn4"}
	if (document.all) {browserType = "ie"}
	if (window.navigator.userAgent.toLowerCase().match("gecko")) {
		browserType= "gecko"
	}
	
  	function changeMax() {
		if (browserType == "gecko" || browserType == "ie")
			document.poppedLayer = eval('document.getElementById("generalAdmissions")');
		else
			document.poppedLayer = eval('document.layers["generalAdmissions"]');
		var genTickets = document.poppedLayer.value;
		if (browserType == "gecko" || browserType == "ie")
			document.poppedLayer = eval('document.getElementById("studentTickets")');
		else
			document.poppedLayer = eval('document.layers["studentTickets"]');
		var stuTickets = document.poppedLayer.value;
		if (stuTickets == 1) {
			if (browserType == "gecko" || browserType == "ie")
				document.poppedLayer = eval('document.getElementById("generalAdmissions_5")');
			else
				document.poppedLayer = eval('document.layers["generalAdmissions_5"]');
			document.poppedLayer.disabled = false;
		}
		if (stuTickets == 2) {
			if (genTickets == 5) {
				alert("Maximum number of tickets exceeded\n(Non-Student Tickets reduced to 4)");
				if (browserType == "gecko" || browserType == "ie")
					document.poppedLayer = eval('document.getElementById("generalAdmissions_4")');
				else
					document.poppedLayer = eval('document.layers["generalAdmissions_4"]');
				document.poppedLayer.selected = true;
			}
			if (browserType == "gecko" || browserType == "ie")
				document.poppedLayer = eval('document.getElementById("generalAdmissions_5")');
			else
				document.poppedLayer = eval('document.layers["generalAdmissions_5"]');
			document.poppedLayer.disabled = true;
		}
		changeTotal();
	}
	
	function changeTotal() {
		var stuPrice = 5;
		var genPrice = 5;
		var numStu = document.paymentForm.studentTickets.value;
		var numGen = document.paymentForm.generalAdmissions.value;
		var total = stuPrice*numStu + genPrice*numGen;
		if (browserType == "gecko" || browserType == "ie")
			document.poppedLayer = eval('document.getElementById("total")');
		else
			document.poppedLayer = eval('document.layers["total"]');
		document.poppedLayer.innerHTML = total;
	}
	-->
  </script>
  <div style="width:100%;float:left;margin-bottom:5px;">
    <div style="float:left;">Number of Student Tickets:&nbsp;</div>
    <div style="float:left;">
      <select id="studentTickets" name="studentTickets" onChange="changeMax();">
        <?php
		// maxAllowed 
		$maxAllowed = 2;
		$cur = 1;
		while ($cur <= $maxAllowed) {
			echo '<option id="studentTickets_'.$cur.'" value="'.$cur.'">'.$cur.'</option>';
			$cur++;
		}
      ?>
      </select>
    </div>
  </div>
  <div style="width:100%;float:left;">
    <div style="float:left;">Number of Non-Student Tickets:&nbsp;</div>
    <div style="float:left;">
      <select id="generalAdmissions" name="generalAdmissions" onChange="changeTotal();">
        <?php
		// maxAllowed 
		$maxAllowed = 5;
		$cur = 0;
		while ($cur <= $maxAllowed) {
			echo '<option id="generalAdmissions_'.$cur.'" value="'.$cur.'">'.$cur.'</option>';
			$cur++;
		}
      ?>
      </select>
    </div>
  </div>
  <?php endif; ?>
  <?php
  	// Everyone else sees this
  	if (!$isStudent):
  ?>
  <script type="text/javascript">
  	<!--
	var browserType;
	if (document.layers) {browserType = "nn4"}
	if (document.all) {browserType = "ie"}
	if (window.navigator.userAgent.toLowerCase().match("gecko")) {
		browserType= "gecko"
	}
    function changeTotal() {
		var genPrice = 5;
		var numGen = document.paymentForm.generalAdmissions.value;
		var total = genPrice*numGen;
		if (browserType == "gecko" || browserType == "ie")
			document.poppedLayer = eval('document.getElementById("total")');
		else
			document.poppedLayer = eval('document.layers["total"]');
		document.poppedLayer.innerHTML = total;
	}
	-->
  </script>
  <div style="width:100%;float:left;margin-bottom:8px;font-size:16px;color:#F00;">
  <?php
  if ($hasPurchasedStudent == TRUE) {
	echo 'You have already purchased the maximum number of sutdent tickets.';  
  }
  ?>
  </div>
  <div style="width:100%;float:left;">
    <div style="float:left;">Number of General Admissions Tickets:&nbsp;</div>
    <div style="float:left;">
      <select id="generalAdmissions" name="generalAdmissions" onChange="changeTotal();">
        <?php
		// maxAllowed 
		$maxAllowed = 6;
		$cur = 1;
		while ($cur <= $maxAllowed) {
			echo '<option value="'.$cur.'">'.$cur.'</option>';
			$cur++;
		}
      ?>
      </select>
    </div>
  </div>
  <?php endif; 
  ?>
</form>
</div>
<?php 
if($_SESSION['authorized']!=TRUE): ?>
<div style="float:left;margin-left:15px;text-align:center;">
FOR STUDENT TICKETS LOG
<br />
IN WITH YOUR NET ID FIRST
<br />
<a href="webauth.php"><img src="images/web_auth_btn.png" /></a>
</div>
<? endif; ?>
<div style="float:right;margin-top:27px;margin-right:15px;">
<a href="javascript:document.paymentForm.submit()" ><img src="images/next_btn.png" /></a>
</div>
<div style="margin-right:20px;margin-top:47px;float:right;font-family:Helvetica, sans-serif;font-size:20px;">TOTAL: $<span id="total">
<?php
if($isStudent) {
	echo "5";	
}
else {
	echo "5";
}
?>
</span></div>
</body>
</html>
<?php
endif; 
if ($soldout) {
	echo '
	<html>
	<head>
	<style type="text/css">
	a, img, a:hover, a:active, a:focus, a:visited {
		text-decoration:none;
		border:0;
		outline: none;
		cursor:pointer;
	}
	</style>
	</head>
	<body style=\'font-family:Helvetica, Verdana, Geneva, sans-serif;font-size:14px; background-image:url("images/orderform_bg.png"); background-repeat:repeat; color:#FFF;\'>
	<div style="margin-left:30px;margin-top:30px;height:340px;">
	<div style="width:100%;float:left;margin-bottom:15px;">
	<img src="images/purchase_tix_head.png" alt="Purchase Tickets" width="167" height="22">
	</div>
	Ticket sales are temporary unavailable.
	</div>
	</body>
	</html>
	';
}
?>