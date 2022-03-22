<?
	session_start();
	require_once ('includes/mysqli.inc');
	require_once('cardtaker/cardtaker.inc');
	$db = new db_mysqli("nclc10");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>National Collegiate Leadership Conference</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link type="text/css" rel="stylesheet" href="/csil/nclcregistration/common/main.css" />
<link rel="stylesheet" href="http://union.arizona.edu/commontools/cardtaker/cardtaker.css" type="text/css" />
<script type="text/javascript" src="http://union.arizona.edu/commontools/cardtaker/cardtaker.js" ></script>
</head>

<div id="header"><img src="/csil/nclcregistration/common/banner_whiteB.gif"></div>

<body style="margin:0px; padding:0px" bgcolor="#DCDDDE">
<div id="container">
  <div id="menu">
    <img src="/csil/nclcregistration/common/NCLC_header_noBar1.jpg" style="width:875px; height:148px" />

    <a href="http://arizonaleadership.orgsync.com/org/nclc/details" style="color:#002D62; font-size:12px; font-weight:bold;">Attend</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/workshops" style="color:#002D62; font-size:12px; font-weight:bold;">Present</a>
    <a href="https://orgsync.com/:nclc/join" style="color:#002D62; font-size:12px; font-weight:bold;">Plan</a>
  </div>

  <div id="navigation">
    <strong><a href="http://arizonaleadership.orgsync.com/org/nclc" style="font-size:12px; color:#333333;">Home</a></strong>

    <strong><a href="http://union.arizona.edu/csil/nclcregistration/index.php" style="color:#002D62; font-size:12px; margin-top: 5px;">Registration</a></strong>

    <h1>Conference Details</h1>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/details">details</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/keynote">keynote</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/excursions">excursions</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/workshops">workshops</a>

    <a href="http://arizonaleadership.orgsync.com/org/nclc/callforprograms">call for programs</a>

    <h1>Accomodations &amp; Travel</h1>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/directions">directions</a>
    <a href="http://www.union.arizona.edu/">venue</a>

    <h1>Support NCLC</h1>

    <a href="http://arizonaleadership.orgsync.com/org/nclc/meet">meet the NCLC team</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/sponsors">our sponsors</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/becomeasponsor">become a sponsor</a>
	
    <h1>Contact Us</h1>
    <a href="mailto:nclc@email.arizona.edu">email us</a>
    <a href="http://arizonaleadership.orgsync.com/org/nclc/addressandphone">address and phone</a>

    <a href="http://arizonaleadership.orgsync.com/org/ualeadership">leadership programs</a>
  </div>

  <div id="content">
	<script type="text/javascript" src="include.js"></script>
	
    <?php
		if(isset($_POST['selectexcursion']))
			$_SESSION['selectexcursion'] = $_POST['selectexcursion'];
		$selection = $_SESSION['selectexcursion'];
		if(!is_numeric($selection) || (int)$selection > 8 || (int)$selection < 1)
		{
			print "You have not made an excursion selection. <a href='/csil/nclcregistration/excursions/'>Click here</a> to do so.";
			goto end;
		}
		
		if(!isset($_SESSION['cost'])){
			$result = $db->query("SELECT cost FROM excursions WHERE id=$selection");
			$row = $result->fetch_array();
			$_SESSION['cost'] = $row[0];
		}
		
		$initial_values = array(
			
			'orderAmount'=>$_SESSION['cost']  //required
		);
		$order_form = new payment_process($initial_values);
		
		
		if($order_form->get_stage()!='approved'){
			//$order_form->set_total('3.00');              //required
			$order_form->require_contact(TRUE);    //optional
			$order_form->show_contact(TRUE);    //optional
			$order_form->display_form();            //required
		}
		else{
			$fname = $order_form->get_firstName();
 			$lname = $order_form->get_lastName();
			$payment_id = $order_form->get_paymentID();
			print "Thank you. You have succesfully registered for an NCLC excursion.";
			$db->query("INSERT INTO excursionguests (`firstName` , `lastName` , `excursionID`, `payment_id`) VALUES ('$fname', '$lname', '$selection', '$payment_id')");
      session_destroy();
      session_start();
		}
		end:
	?>
  </div>

  <div id="footer" align="center">
    <div style="float:left; position:absolute; top:5px; left:220px; padding-right:20px;" align="left">

      NCLC is brought to you by the <br />
      Center for Student Involvement and Leadership at The University of Arizona<br />
      PO Box 210017, Tucson, AZ 85721-0017<br />
    </div>
    <div style="padding-top:10px; padding-right:8px; width:200px; height:30px; border-right:2px solid; position:absolute; top:5px;" align="right">
      520.621.8046<br />
    </div>

  </div>
</div>

</body>
</html>