<?php

if(!isset($_SERVER['HTTPS'])) {
	header("location: https://union.arizona.edu/welcome/brunchbbq.php");
}
if((strpos($_SERVER['HTTP_HOST'], 'www')===false)){
		header('Location:https://www.union.arizona.edu/welcome/brunchbbq.php');
		exit();
}


function select_error($db_host,$db_user,$db_name) {
	include_once("mimemail/htmlMimeMail.php");
	$mail = new htmlMimeMail();
	//Set the From and Reply-To headers
	$mail->setFrom('Arizona Student Union<no-reply@email.arizona.edu>');
	$mail->setReturnPath('no-reply@email.arizona.edu');
	//Set the subject
	$mail->setSubject('Well-u Submition');
	$email_message.="Problem SELECTING the wildcatwelcom1e0 database";
	$mail->setHTML($email_message);
	$result=$mail->send(array('SAMarketingNoise@gmail.com'));
	die("<br><p><h3>Oops!</h3></p> <p>We're sorry, but something went wrong while connecting to our Database Server</p> <p>It is not your fault, Please <a href='mailto:SAMarketingAdmin@gmail.com'>contact us</a>.  (error 2)</p>");
}

session_start();
//session_destroy();//
require('template/main.php');
include_once("cardtaker/cardtaker.inc");

//page_start('Wildcat Welcome - Brunch/BBQ Registration');
page_start('brunchbbq');
?>
<div id="content" style="float:left; width:715px; padding-left:10px; padding-top:5px; color:#666666;">
<?php

//check if registration has ended
if (mktime(0, 1, 0, 8, 18, 2010) < time())
//if(false)
{
	echo('Registration for Wildcat Welcome is currenty closed.');
	page_end();
	exit();
}
 //If the cancel button had been clicked display the appropiate information
if (isset($_POST['cancel'])){
	session_destroy();
?>
    	<div style="margin-left:10px; margin-top:15px; font-size:12px;">Registration for Brunch &amp; BBQ Cancelled.</div>
        <div style="margin-left:20px; margin-top:8px; font-size:12px;">
        	<div><a class="links" href="./brunchbbq.php">Register for Brunch &amp; BBQ</a></div>
            <div style="margin-top:2px;"><a class="links" href="./index.php">General Information</a></div>
        </div>
<?php
	page_end();
	exit();
}
?>
<div style="width:715px;">
<?php 
//check if selecting guests to come
if(!isset($_SESSION['pay']) && !isset($_POST['pay'])){

// Set number of attendees
$num = (isset($_POST['num'])) ? intval($_POST['num']) : 1;
$num += (isset($_POST['add'])) ? 1 : 0;
$num -= (isset($_POST['remove']) && $num > 1) ? 1 : 0;
if(isset($_POST['num']) || isset($_POST['add']) || isset($_POST['remove'])){
	$_SESSION['num'] = $num;
}
/*
 // Display constant total
  echo '<script type="text/javascript">
  function update()
  {
    var total = 0;
    for (i = 0; i < ' . $num . '; i++)
    {
      // BBQ (check if student)
      if (document.forms[0]["bbq["+i+"]"].checked == true) {
	    total += (document.forms[0]["uastudent["+i+"]"].checked == true) ? 5 : 10;
	  }
	  
	  // Student
	  if (document.forms[0]["uastudent["+i+"]"].checked == true) {
	  	document.getElementById(\'bbqcost\'+i).innerHTML = \'$5&nbsp;&nbsp;\';
	  }
	  else {
	  	document.getElementById(\'bbqcost\'+i).innerHTML = \'$10\';
	  }
	
      // Brunch
      if (document.forms[0]["brunch["+i+"]"].checked == true)
        total += 20;
    }
    document.getElementById(\'total\').innerHTML = \'<h2 style="margin:0;color:#513023;">Total:</h2> $\' + total;
  }

  window.onload = function(){update();};
  </script>
  */
echo '
  <div align="center">
  <form method="post" action="">';
 	include('../commontools/mysql_link.inc');
	mysql_select_db('wildcatwelcome10', $DBlink) or select_error();
	$result = mysql_query('select count(id) as brunches from attendees where brunch=1');
	$count = mysql_fetch_array($result);
	//var_dump($count['brunches']);
  // Attendee forms
  for ($i = 0; $i < $num; $i++)
  {
    $firstname = stripslashes($_POST['firstname'][$i]);
    $lastname = stripslashes($_POST['lastname'][$i]);
  
    $uastudent = (isset($_POST['uastudent'][$i])) ? ' checked="checked"' : '';
    $bbq = (isset($_POST['bbq'][$i])) ? ' checked="checked"' : '';
    $vegetarian = (isset($_POST['vegetarian'][$i])) ? ' checked="checked"' : '';
    $brunch = (isset($_POST['brunch'][$i])) ? ' checked="checked"' : '';
	

    echo '<div style="width:357px;float:left;"><table width="300" cellpadding="3" border="0" style="padding-left:20px;font-size:12px;">
      <tr><th colspan="2"><h3 style="margin:0;font-size:14px;">Attendee Information</h3></th></tr>
      <tr><td><h2 style="margin:0;">First Name</h2></td><td><input type="text" name="firstname[]" value="' . $firstname . '" /></td></tr>
      <tr><td><h2 style="margin:0;">Last Name</h2></td><td><input type="text" name="lastname[]" value="' . $lastname . '" /></td></tr>
      <tr><td><h2 style="margin:0;">UA Student?</h2></td><td><input type="checkbox" name="uastudent[' . $i . ']" onclick="update()"' . $uastudent . ' /></td></tr>
      <tr><th colspan="2"><h3 style="margin:0;font-size:14px;">Meal Selection</h3></th></tr>
      <tr><td><h2 style="margin:0;">BBQ</h2></td><td><span id="bbqcost'.$i.'">$15</span>&nbsp;<input type="checkbox" name="bbq[' . $i . ']" onclick="update()"' . $bbq . ' /> Vegetarian? <input type="checkbox" name="vegetarian['.$i.']"' . $vegetarian . ' /></td></tr>';
	  if($count['brunches'] < 100 ){  
      	echo '<tr><td><h2 style="margin:0;">Brunch</h2></td><td>$20 <input type="checkbox" name="brunch[' . $i . ']" onclick="update()"' . $brunch . ' /></td></tr>';
	  }
	  else{
		 echo '<tr><td colspan="2"><h2 style="margin:0;">The brunch is full.</h2></td></tr>'; 
	  }
	  
    echo '</table><div style="width:90%;"><hr /></div></div>';
  }
  
  $disabled = ($num == 1) ? ' disabled="disabled"' : '';
  echo '<br /><div style="width:715px;float:left;"><div id="total" style="width:715px;text-align:center;color:#513023;"></div>
  <div>
  <input type="hidden" name="num" value="' . $num . '" />
  <div style="width:715px;text-align:center;">
  	<div style="width:353px;text-align:right;float:left;padding-right:4px;margin-top:4px;">
  		<input type="submit" name="add" value="Add Attendee" />
	</div>
	<div style="width:353px;text-align:left;float:left;padding-left:4px;margin-top:4px;">
  	<input type="submit" name="remove" value="Remove Attendee"' . $disabled . ' />
	</div>
  </div>
  <div style="width:715px;text-align:center;">
  	<div style="width:353px;text-align:right;float:left;padding-right:4px;margin-top:4px;">
   		<input type="submit" name="pay" value="Submit Registration" />
	</div>
	<div style="width:353px;text-align:left;float:left;padding-left:4px;margin-top:4px;">
  		<input type="submit" name="cancel" value="Cancel Registration" />
	</div>
  </div>
  </div>
  </div>
  </form>
  </div>';
}
//sumitted registrations and now onto payment form
else{
$initial_values = array(
    		'orderAmount'=>$_SESSION['total']  //required
		);
		
$order_form = new payment_process($initial_values);	
	
//just submitted registrants now need to display payment form
if(isset($_POST['pay'])){

		 $_SESSION = $_POST;
		 



		






  //Hate it but inline style works here
  echo '<style>td{color:#666666;font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px;}</style>';
  $total = 0;
  
  for ($i = 0; $i < $_SESSION['num']; $i++)
  { 
    $uastudent = (isset($_POST['uastudent'][$i])) ? 1 : 0;
    $bbq = (isset($_POST['bbq'][$i])) ? 1 : 0;
    $brunch = (isset($_POST['brunch'][$i])) ? 1 : 0;
	
	// BBQ (check if student)
	if (!empty($bbq))
	  $total += (!empty($uastudent)) ? 5 : 10;
	
	// Brunch
	$total += (!empty($brunch)) ? 20 : 0;
  }
  $_SESSION['total'] = $total;
  
 
$_SESSION['saved_session'] = serialize($_SESSION);
		$order_form->set_total($total);
		$order_form->require_contact(TRUE);    //optional
    	$order_form->show_contact(TRUE);    //optional
    	$order_form->display_form(); 
    	print '<form method="post" action=""><input type="submit" value="Cancel" name="cancel" /></form>'; 
}
//otherwise was there an error on payment submission so its not complete
elseif($order_form->get_stage()!='approved'){
		$order_form->require_contact(TRUE);    //optional
    	$order_form->show_contact(TRUE);    //optional
    	$order_form->display_form();
    	print '<form method="post" action=""><input type="submit" value="Cancel" name="cancel" /></form>';
}
else{
	
	$paymentID = $_SESSION['paymentID'];
	$_SESSION = unserialize($_SESSION['saved_session']);
	$_SESSION['paymentID'] = $paymentID;
		// Database
    include('../commontools/mysql_link.inc');
	mysql_select_db('wildcatwelcome10', $DBlink) or select_error();
	
	
	
    // Payment info
	$firstname = $order_form->get_firstName();
	$lastname = $order_form->get_lastName();
	$street = $order_form->get_address();
	$city = $order_form->get_city();
	$state = $order_form->get_state();
	$zip = $order_form->get_postalCode();
	$phone = $order_form->get_phoneNumber();
	$email = $order_form->get_email();
	$cardtype =$order_form->get_cardtype();
	$cardmonth = $order_form->get_expirationMonth();
	$cardyear = $order_form->get_expirationYear();
	$cardlast = $order_form->get_lastFour();
	$orderamount = $order_form->get_orderAmount();
	$ordernum =$order_form->get_paymentID();
    $payment_submit = mysql_query("INSERT INTO payment (firstname, lastname, street, city, state, zip, phone, email, cardtype, cardmonth, cardyear, cardlast, orderamount, ordernum)
				VALUES ('$firstname', '$lastname', '$street', '$city', '$state', $zip, '$phone', '$email', '$cardtype', $cardmonth, $cardyear, '$cardlast', $orderamount, '$ordernum')");
				
	//echo 'payment query returned: '.$payment_submit.'  payment query was: ';
	//echo ("INSERT INTO payment (firstname, lastname, street, city, state, zip, phone, email, cardtype, cardmonth, cardyear, cardlast, orderamount, ordernum)
		//		VALUES ('$firstname', '$lastname', '$street', '$city', '$state', $zip, '$phone', '$email', '$cardtype', $cardmonth, $cardyear, '$cardlast', $orderamount, '$ordernum')");
	//print mysql_error();
	//echo '<br />';
	
	/*$query = mysql_query("SELECT MAX(id) FROM 'payment'");
	$results = mysql_fetch_array($query);
	if ($results['MAX(id)']!=null) {
		$payment_id = $results['MAX(id)'];
	}
	else {
		$payment_id = 0;
	}*/
	$payment_id = mysql_insert_id ($DBlink);
	
	// Attendee info
	//var_dump($_SESSION['num']);
	for ($i = 0; $i < $_SESSION['num']; $i++)
    {
      $firstname = str_replace("\'", "''", $_SESSION['firstname'][$i]);
      $lastname = str_replace("\'", "''", $_SESSION['lastname'][$i]);
  
      $uastudent = (isset($_SESSION['uastudent'][$i])) ? 1 : 0;
      $bbq = (isset($_SESSION['bbq'][$i])) ? 1 : 0;
      $vegetarian = (isset($_SESSION['vegetarian'][$i])) ? 1 : 0;
      $brunch = (isset($_SESSION['brunch'][$i])) ? 1 : 0;
	  
	  $attendee_submit = mysql_query("INSERT INTO attendees (payment_id, firstname, lastname, uastudent, bbq, brunch, vegetarian)
	  				VALUES ($payment_id, '$firstname', '$lastname', $uastudent, $bbq, $brunch, $vegetarian)");
	//  echo 'attendee query returned: '.$attendee_submit.'  atendeee query was: ';
     // echo ("INSERT INTO attendees (payment_id, firstname, lastname, uastudent, bbq, brunch, vegetarian)
	 // 				VALUES ($payment_id, '$firstname', '$lastname', $uastudent, $bbq, $brunch, $vegetarian)");
      //echo '<br />';
	 // print mysql_error();
    }
	$es = 0;
	$sbbq = 0;
	$obbq = 0;
	$abrunch = 0;
	for ($i = 0; $i < $_SESSION['num']; $i++)
    {
      if(isset($_SESSION['uastudent'][$i])){
		$es++;
		if (isset($_SESSION['bbq'][$i])){
			$sbbq++;	
		}
	  }
	  else{
		if (isset($_SESSION['bbq'][$i])){
			$obbq++;	
		}
	  }
	  if(isset($_SESSION['brunch'][$i])){
		$abrunch++;  
	  }
	}
     
	
	include_once("mimemail/htmlMimeMail.php");
	$mail = new htmlMimeMail();
	//Set the From and Reply-To headers
	$mail->setFrom('Wildcat Welcome<no-reply@email.arizona.edu>');
	$mail->setReturnPath('no-reply@email.arizona.edu');
	//Set the subject
	$mail->setSubject('Wildcat Welcome Registration');
	$email_message.="<h2>Your Wildcat Welcome Registration has been received.</h2>";
	//$email_message .="<p>You registered ".$es." student(s) and ".($_SESSION['num']-$es)." non-students for:<br>";
	$email_message .="<h3>You registered:</h3>";
	for ($i = 0; $i < $_SESSION['num']; $i++){
		$email_message .= $_SESSION['firstname'][$i].' '.$_SESSION['lastname'][$i].''.((isset($_SESSION['uastudent'][$i])) ? ' - student' : '').'<br>';
		//$email_message .= $_SESSION['firstname'][$i].' '.$_SESSION['lastname'][$i].'<br>';
		$email_message .= 'for the '.((isset($_SESSION['vegetarian'][$i])) ? 'vegetarian ' : '').((isset($_SESSION['bbq'][$i])) ? 'bbq' : '').((isset($_SESSION['brunch'][$i]) && (isset($_SESSION['bbq'][$i]))) ? ' and ' : '').((isset($_SESSION['brunch'][$i])) ? 'brunch' : '').'<br><br>';
	}
	$email_message .="for a total of $".$orderamount;
	
	$mail->setHTML($email_message);
	$result=$mail->send(array($email));
	session_destroy();
	
	
	print 'Thank you. Your registration has been received.';
 
  
}
} 
?>
    </div></div>
 
    
    
   
    
<!-- Following required by template -->   
<div style="clear:both;"></div>
<?php
page_end();
?>