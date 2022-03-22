<?php
require_once 'template/fw.inc';
require_once 'events.inc';
require_once '/Library/WebServer/commontools/cardtaker/cardtaker.inc';
require_once '/Library/WebServer/commontools/db.inc';


//chech that session hasn't died
if($_SESSION['fw']['active_session'] != 1){
	$_SESSION['errors']['1'] = "We're sorry you session has timed out.";
	header("Location:reg.php");
}

$initial_values = array(
    'orderAmount'=>$_SESSION['fw']['total']  //required
);

$order_form = new payment_process($initial_values);
//check if canceling registration
if($_POST['action']=='Cancel'){
	unset($_SESSION['fw']);	
	session_destroy();		//unset saved variables
	header('Location:index.php');	//go back to lanfing page
}

////////////////////////////// ERROR CHECKING ///////////////////////////////////////////////////

//check if submitting previous page
else if(isset($_POST['action']) || $order_form->get_stage()!='approved'){
	
	if(empty($_SERVER['HTTPS'])){
		header('Location:https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		exit();
	}
	
	$_SESSION['fw']['stage'] = max($_SESSION['fw']['stage'], 7);
	fw_start('Payment', 0);
	$order_form->require_contact(TRUE);    //optional
    $order_form->show_contact(TRUE);    //optional
    $order_form->display_form();
    fw_finish(); 
    exit(); 
}


////////////////////////////// END ERROR CHECKING ///////////////////////////////////////////////////




///////////////////////////////// SAVE TO DATABASE //////////////////////////////////////////////////

db_connect();
db_select('familyweekend10');

function prepare_string($string, $len){
	$string = substr($string, 0, $len);
	$string = stripslashes($string);
	$string = mysql_real_escape_string($string);
	return $string;
}

// Payment info
	$firstname 	= prepare_string($order_form->get_firstName(), 25);
	$lastname 	= prepare_string($order_form->get_lastName(), 25);
	$street 	= prepare_string($order_form->get_address(), 50);
	$city 		= prepare_string($order_form->get_city(), 30);
	$state 		= $order_form->get_state();
	$zip 		= $order_form->get_postalCode();
	$phone 		= $order_form->get_phoneNumber();
	$email 		= prepare_string($order_form->get_email(), 50);
	$cardtype 	= $order_form->get_cardtype();
	$cardmonth 	= $order_form->get_expirationMonth();
	$cardyear 	= $order_form->get_expirationYear();
	$cardlast 	= $order_form->get_lastFour();
	$orderamount= $order_form->get_orderAmount();
	$ordernum 	= $order_form->get_paymentID();
	$discount 	= $_SESSION['fw']['PlusParents']==1?'1':'0';
	
    $result = db_query("INSERT INTO payment (firstname, lastname, address, city, state, zip, phone, email, cardlastfour, total, cybersource_orderNum, parentplus_discount)
				VALUES ('$firstname', '$lastname', '$street', '$city', '$state', $zip, '$phone', '$email', '$cardlast', $orderamount, '$ordernum', $discount)");
    $payment_id = mysql_insert_id();

//Alumni
foreach($_SESSION['fw']['alumni'] as $guestid){
	db_query('insert into alumni set payment_id='.$payment_id.', payment_lname="'.prepare_string($lastname, 25).'", alumniFN="'.prepare_string($_SESSION['fw']['guest_first'][$guestid], 25).'", alumniLN="'.prepare_string($_SESSION['fw']['guest_last'][$guestid], 25).'"');
}

//Attendee
	//students
	for($x=0; $x<$_SESSION['fw']['num_students']; $x++){
		db_query('insert into attendee set payment_id='.$payment_id.', cost="0.00", firstName="'.prepare_string($_SESSION['fw']['student_first'][$x], 25).'", lastName="'.prepare_string($_SESSION['fw']['student_last'][$x],25).'", student=1, class_hometown="'.prepare_string($_SESSION['fw']['student_class'][$x], 25).'"');
	}
	
	//guests
	for($x=0; $x<$_SESSION['fw']['num_guests']; $x++){
		db_query('insert into attendee set payment_id='.$payment_id.', cost="'.$reg_costs[$_SESSION['fw']['package_type']].'", firstName="'.prepare_string($_SESSION['fw']['guest_first'][$x], 25).'", lastName="'.prepare_string($_SESSION['fw']['guest_last'][$x],25).'", student=0, class_hometown="'.prepare_string($_SESSION['fw']['guest_hometown'][$x], 25).'"');
	}

//EventRegistration
		//Friday
		foreach($_SESSION['fw']['fri_events'] as $key => $value){
			if($fri_events[$key]['stu_cost'] == $fri_events[$key]['guest_cost']){
				for($x=0; $x < $value; $x++)
					db_query('insert into eventregistration set payment_id='.$payment_id.', cost="'.$fri_events[$key]['stu_cost'].'", event_title="'.$fri_events[$key]['title'].'"');
			}
			else{
				for($x=0; $x < $value['student']; $x++)
					db_query('insert into eventregistration set payment_id='.$payment_id.', cost="'.$fri_events[$key]['stu_cost'].'", event_title="'.$fri_events[$key]['title'].'"');
				for($x=0; $x < $value['guest']; $x++)
					db_query('insert into eventregistration set payment_id='.$payment_id.', cost="'.$fri_events[$key]['guest_cost'].'", event_title="'.$fri_events[$key]['title'].'"');
			}
				
		}
		
		//Saturday
		foreach($_SESSION['fw']['sat_events'] as $key => $value){
			if($sat_events[$key]['stu_cost'] == $sat_events[$key]['guest_cost']){
				for($x=0; $x < $value; $x++)
					db_query('insert into eventregistration set payment_id='.$payment_id.', cost="'.$sat_events[$key]['stu_cost'].'", event_title="'.$sat_events[$key]['title'].'"');
			}
			else{
				for($x=0; $x < $value['student']; $x++)
					db_query('insert into eventregistration set payment_id='.$payment_id.', cost="'.$sat_events[$key]['stu_cost'].'", event_title="'.$sat_events[$key]['title'].'"');
				for($x=0; $x < $value['guest']; $x++)
					db_query('insert into eventregistration set payment_id='.$payment_id.', cost="'.$sat_events[$key]['guest_cost'].'", event_title="'.$sat_events[$key]['title'].'"');
			}
				
		}
		
		//Sunday
		foreach($_SESSION['fw']['sun_events'] as $key => $value){
			if($sun_events[$key]['stu_cost'] == $sun_events[$key]['guest_cost']){
				
				for($x=0; $x < $value; $x++)
					db_query('insert into eventregistration set payment_id='.$payment_id.', cost="'.$sun_events[$key]['stu_cost'].'", event_title="'.$sun_events[$key]['title'].'"');
				
			}
			else{
				
				
				for($x=0; $x < $value['student']; $x++)
					db_query('insert into eventregistration set payment_id='.$payment_id.', cost="'.$sun_events[$key]['stu_cost'].'", event_title="'.$sun_events[$key]['title'].'"');
					
				for($x=0; $x < $value['guest']; $x++)
					db_query('insert into eventregistration set payment_id='.$payment_id.', cost="'.$sun_events[$key]['guest_cost'].'", event_title="'.$sun_events[$key]['title'].'"');
				
			}
				
		}
		
//TshirtOrder
	db_query('insert into tshirtorder set payment_id='.$payment_id.', xsmall="'.$_SESSION['fw']['xsmall'].'", small="'.$_SESSION['fw']['small'].'", medium="'.$_SESSION['fw']['medium'].'", large="'.$_SESSION['fw']['large'].'", xlarge="'.$_SESSION['fw']['xlarge'].'", x2large="'.$_SESSION['fw']['x2large'].'"');

////////////////////////////////////////////////////////////////////////////////////////////////////





$_SESSION['fw']['stage'] = max($_SESSION['fw']['stage'], 8);

fw_start('Payment', 0);
?>
<p style="marign-left:0px; padding-left:0px; margin-top:40px;"><b>Thank you</b>, your registration has been Recieved. Below is a copy of what you registered for and a confirmation email has been sent to <?=$email?>.</p>
<?php ob_start();?>
<table>
	<tbody>
		<tr>
			<td width="400"><h2>Registrations</h2></td>
			<td width="180"></td>
			<td width="100"><h2>Cost</h2></td>
		</tr>
		<tr>
			<td><h3>Students</h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			for($x=0; $x<$_SESSION['fw']['num_students']; $x++){
		?>
				<tr>
					<td><?=$_SESSION['fw']['student_first'][$x].' '.$_SESSION['fw']['student_last'][$x]?></td>
					<td></td>
					<td>Free</td>
				</tr>
		<?php
			} 
		?>
		<tr>
			<td><h3>Other Guests</h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if($_SESSION['fw']['num_guests']==0){
		?>
			<tr>
				<td>You registered no guests.</td>
				<td></td>
				<td></td>
			</tr>
			
		<?php 
			}
		
			else{
		?>
			<?php 
				for($x=0; $x<$_SESSION['fw']['num_guests']; $x++){
			?>
					<tr>
						<td><?=$_SESSION['fw']['guest_first'][$x].' '.$_SESSION['fw']['guest_last'][$x]?></td>
						<td><?=$_SESSION['fw']['package_type']?></td>
						<td>$<?=$reg_costs[$_SESSION['fw']['package_type']]?></td>
					</tr>
			<?php
				} 
			?>
		<?php 
			}
		?>
		<tr>
			<td><h2>Events</h2></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><h3>Friday</h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if(sizeof($_SESSION['fw']['fri_events']) == 0){
		?>
			<tr>
				<td>You made no event selections for Friday.</td>
				<td></td>
				<td></td>
			</tr>
			
		<?php 
			}
		
			else{
		?>
			<?php 
				foreach($_SESSION['fw']['fri_events'] as $key => $value){
			?>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$fri_events[$key]['title']?></td>
					<td><?= $_SESSION['fw']['fri_events'][$key].' Attendees '?><?=$fri_events[$key]['price']==''?'':'@ $'.$fri_events[$key]['stu_cost']?></td>
					<td><?=$fri_events[$key]['price']==''?'Included':'$'.($_SESSION['fw']['fri_events'][$key]*$fri_events[$key]['stu_cost'])?></td>
				</tr>
			<?php 
				}
			?>
		<?php 
			}
		?>
		<tr>
			<td><h3>Saturday</h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if(sizeof($_SESSION['fw']['sat_events']) == 0){
		?>
			<tr>
				<td>You made no event selections for Saturday.</td>
				<td></td>
				<td></td>
			</tr>
		<?php 
			}
		
			else{
		?>
			<?php 
				foreach($_SESSION['fw']['sat_events'] as $key => $value){
			?>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$sat_events[$key]['title']?></td>
					<td>
						<?php 
						if($sat_events[$key]['stu_cost']==$sat_events[$key]['guest_cost']){					
							print $_SESSION['fw']['sat_events'][$key].' Attendees '.($sat_events[$key]['price']==''?'':'@ $'.$sat_events[$key]['stu_cost']);
						}
						else{
							print $_SESSION['fw']['sat_events'][$key]['student'].' Students @ $'.$sat_events[$key]['stu_cost'].'<br />';
							print $_SESSION['fw']['sat_events'][$key]['guest'].' Guests @ $'.$sat_events[$key]['guest_cost'];
						}
						?>
					</td>
					<td>
						<?php 
						if($sat_events[$key]['stu_cost']==$sat_events[$key]['guest_cost']){
							print $sat_events[$key]['price']==''?'Included':'$'.($_SESSION['fw']['sat_events'][$key]*$sat_events[$key]['stu_cost']);
						}
						else{
							print '$'.($_SESSION['fw']['sat_events'][$key]['student']*$sat_events[$key]['stu_cost']).'<br />';
							print '$'.($_SESSION['fw']['sat_events'][$key]['guest']*$sat_events[$key]['guest_cost']).'<br />';
						}
						?>
					</td>
				</tr>
			<?php 
				}
			?>
		<?php 
			}
		?>
		<tr>
			<td><h3>Sunday</h3></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if(sizeof($_SESSION['fw']['sun_events']) == 0){
		?>
			<tr>
				<td>You made no event selections for Sunday.</td>
				<td></td>
				<td></td>
			</tr>
		<?php 
			}
		
			else{
		?>
			<?php 
				foreach($_SESSION['fw']['sun_events'] as $key => $value){
			?>
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$sun_events[$key]['title']?></td>
					<td>
						<?php 
						if($sun_events[$key]['stu_cost']==$sun_events[$key]['guest_cost']){					
							print $_SESSION['fw']['sun_events'][$key].' Attendees '.($sun_events[$key]['price']==''?'':'@ $'.$sun_events[$key]['stu_cost']);
						}
						else{
							print $_SESSION['fw']['sun_events'][$key]['student'].' Students @ $'.$sun_events[$key]['stu_cost'].'<br />';
							print $_SESSION['fw']['sun_events'][$key]['guest'].' Guests @ $'.$sun_events[$key]['guest_cost'];
						}
						?>
					</td>
					<td>
						<?php 
						if($sun_events[$key]['stu_cost']==$sun_events[$key]['guest_cost']){
							print $sun_events[$key]['price']==''?'included':'$'.($_SESSION['fw']['sun_events'][$key]['student']*$sun_events[$key]['stu_cost']);
						}
						else{
							print '$'.($_SESSION['fw']['sun_events'][$key]['student']*$sun_events[$key]['stu_cost']).'<br />';
							print '$'.($_SESSION['fw']['sun_events'][$key]['guest']*$sun_events[$key]['guest_cost']).'<br />';
						}
						?>
					</td>
				</tr>
			<?php 
				}
			?>
		<?php 
			}
		?>
		<tr>
			<td><h2>T-Shirts</h2></td>
			<td></td>
			<td></td>
		</tr>
		<?php 
			if($_SESSION['fw']['xsmall']==0 && $_SESSION['fw']['small']==0 && $_SESSION['fw']['medium']==0 && $_SESSION['fw']['large']==0 && $_SESSION['fw']['xlarge']==0 && $_SESSION['fw']['x2large']==0){
		?>
			<tr>
				<td>You made no T-shirt selections.</td>
				<td></td>
				<td></td>
			</tr>
		<?php 
			}
		
			else{
		?>
			<?php if($_SESSION['fw']['xsmall'] != 0){?>
				<tr>
					<td>Kids Size 6</td>
					<td><?=$_SESSION['fw']['xsmall']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['xsmall']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['small'] != 0){?>
				<tr>
					<td>Small</td>
					<td><?=$_SESSION['fw']['small']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['small']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['medium'] != 0){?>
				<tr>
					<td>Medium</td>
					<td><?=$_SESSION['fw']['medium']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['medium']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['large'] != 0){?>
				<tr>
					<td>Large</td>
					<td><?=$_SESSION['fw']['large']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['large']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['xlarge'] != 0){?>
				<tr>
					<td>XL</td>
					<td><?=$_SESSION['fw']['xlarge']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['xlarge']?></td>
				</tr>
			<?php }?>
			
			<?php if($_SESSION['fw']['x2large'] != 0){?>
				<tr>
					<td>XXL</td>
					<td><?=$_SESSION['fw']['x2large']?> Shirts</td>
					<td>$<?=$tshirt_cost*$_SESSION['fw']['x2large']?></td>
				</tr>
			<?php }?>
		<?php }?>
		<?php if($_SESSION['fw']['PlusParents'] == 1){ ?>
		<tr>
			<td><h2>Parents Plus Discount</h2></td>
			<td></td>
			<td>-$5</td>
		</tr>
		<?php }?>		
		<tr>
			<td></td>
			<td style="font-size:16px;"><b>Total Cost:</b></td>
			<td style="font-size:16px;"><b>$<?=$_SESSION['fw']['total']?></b></td>
		</tr>
	</tbody>
</table>
<p>Refund requests made and received prior to October 1, 2010 are guaranteed on everything except your registration fees. To request a refund please send us the following information via e-mail to uabfamw@email.arizona.edu: name, mailing address, phone number, e-mail address, events you wish to cancel, brief explanation of why you are requesting a refund. Refund requests made and received after October 1, 2010, as well as during the weekend are not guaranteed. You must complete a refund request form when you arrive at the University and refund checks will take up to 4 to 6 weeks to process.
</p><p>
All refund requests must be received no later than October 22, 2010</p>
<?php 
$registration_summary = ob_get_clean();

print $registration_summary;

 require_once('/Library/WebServer/commontools/phplib/mimemail/htmlMimeMail5.php');
    
    $mail = new htmlMimeMail5();

    /**
    * Set the from address of the email
    */
    $mail->setFrom('Arizona Student Union<no-reply@email.arizona.edu>');
	$mail->setReturnPath('no-reply@email.arizona.edu');
    
    /**
    * Set the subject of the email
    */
    $mail->setSubject('Family Weekend 2010 Registration Confirmation');
    
        
    /**
    * Set the HTML of the email. Any embedded images will be automatically found as long as you have added them
    * using addEmbeddedImage() as below.
    */
    $mail->setHTML('<p>Below is a summary of your registration for Family Weekend</p><br />'.$registration_summary);


    /**
    * Send the email. Pass the method an array of recipients.
    */
    $result  = $mail->send(array($email));

session_destroy();
	
fw_finish();
?>