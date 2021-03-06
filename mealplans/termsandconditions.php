<?php
require_once('template/mp.inc');
require_once ('includes/mysqli.inc');

$db = new db_mysqli('mealplans');
$db2 = new db_mysqli('hours2');


//make sure if the hit back after making it all the way to the cc page it gets cleared out
unset($_SESSION['paymentID']);

//make sure users session is stull active and that this is an appropriate page for the user to be on
if(!isset($_SESSION['mp_cust']['id']) || !isset($_SESSION['webauth']['netID']) || $_SESSION['mp_cust']['state'] != 'no plan'){
  header("Location:index.php");
  exit();
}

//check if submitting from chooseplan page
if(isset($_POST['chooseplan'])){
  //do some error checking
	if(isset($_POST['plan'])){
	  //save plan and get other info that will be used later into the session
		$_SESSION['plan'] = $_POST['plan'];


    $query = 'select * from plan where plan_id='.$_SESSION['plan'];
    $result = $db->query($query);
    $plan = mysqli_fetch_assoc($result);

    $_SESSION['import_plan_name'] = $plan['name'];

    $_SESSION['errors'][1] = '';

    $_SESSION['stage'] = 2;
	}
	else{
		$_SESSION['errors'][1] = 'Please choose a plan.';
		header('Location: chooseplan.php');
		exit();
	}


}
else{
  //make sure they have selected a plan before coming to this page
  if($_SESSION['stage'] < 2){
    header('Location: chooseplan.php');
    exit();
  }
}




mp_start('Terms and Conditions', 0, 1, 1);
?>
<style>
	#terms p, #terms ul, #terms li{
		font-size:10px;
		line-height:10px;
	}
</style>
<h1>Terms and Conditions</h1>
<span style="color:#cc0033;"><?php echo ( (isset($_SESSION['errors'][2]) ? $_SESSION['errors'][2] : '') ); ?></span>
<div id="terms" style="overflow:auto; width:500px; height:395px; padding:5px; font-size:10px; border:2px inset;">
<?php

if($_SESSION['plan'] != 3){

?>
<p>Acceptance of a Meal Plan constitutes a binding contract between the student,
faculty, staff (Account Owner) and the University of Arizona Student Unions as
stipulated in the Meal Plan Terms &amp; Conditions.
</p>

<p>
<b>CatCard</b>
<br />
Treat your CatCard as if it were cash. Report lost cards immediately to the Meal
Plan office in the Business Center (Student Union Memorial Center, 621-7043) at
which time a freeze can be placed on your Meal Plan. You can also freeze your
card online at <a href="http://union.arizona.edu/mealplans">union.arizona.edu/mealplans</a>. On weekends and evenings leave
a message on the voice mail or report to the Information Desk in the Student
Union. Replacement cards are issued by the CatCard office in the Business Center
(Student Union Memorial Center, 626-9162). Replacement cards cost $25.
</p>

<p>
<b>Privacy of Information</b>
<br />
Meal Plan balance and transaction information cannot be released to anyone
other than the Account Owner. However, anonymous deposits can be made
online with the Account Owner???s Student or Employee ID and last name. Students
can provide families online access to their meal plan information by creating a
Guest Account through the UAccess (<a href="http://uaccess.arizona.edu">uaccess.arizona.edu</a>) website. Instructions
for creating a Guest Account are at <a href="http://union.arizona.edu/mealplans">union.arizona.edu/mealplans</a>. Students can
also submit a signed ???Balance Information Release Form??? to the Meal Plan Office,
although this will not give online access to information.
</p>

<p>
<b>Unused Balances at Semester End</b>
<br />
All Wildcat Meal Plans expire at the end of the Spring Semester. The unused
funds will automatically be converted to a Commuter
Plan (Commuter Plans never expires) at no charge.
</p>

<p>
<b>Inactive Accounts</b>
<br />
Funds deposited to a Meal Plan account should be used or withdrawn in full
before leaving the University of Arizona. Accounts unused for six months will
enter inactive status and any funds left on deposit will be forfeited.
Notification of forfeiture for accounts over $50 will be sent to the last
known permanent address.
</p>

<p>
<b>Wildcat Meal Plans</b>
<br />
Wildcat Meal Plans are specifically designed for students living on campus. As
with all University Meal Plans, Wildcat meal plans are exempt from state sales
tax of 6.1% per campus transaction. Wildcat Meal Plan options and savings are
as follows:
<ul style="margin-left:15px; margin-bottom: 15px;">
	<li>With the Wildcat Gold Meal Plan, you deposit $4,950 for the
	academic year, never pay state sales tax and receive 7% off
	every purchase.</li>
	<li>With the Wildcat Silver Meal Plan, you deposit $3,550 for the
	academic year, never pay state sales tax and receive 5% off
	every purchase.</li>
	<li>With the Wildcat Copper Meal Plan, you deposit $2,150 for the
	academic year, never pay state sales tax and receive 3% off
	every purchase.</li>
</ul>
Additional deposits have a $25 minimum per transaction. All Wildcat Meal
Plans expire at the end of the Spring Semester.
</p>

<p>
<b>Refunds</b>
<br />
Refunds of unused Wildcat Meal Plans are permitted only at the end of the
Spring Semester. Wildcat Plan refunds
will not be processed at any other time with the exception of students who
officially withdraw from the University of Arizona. Refunds for all Meal Plans
will have a $50 charge deducted from them. All refunds are sent to the student???s
Bursar account and are then issued by the Bursar???s Office per their policies.
Refunds will not be paid unless all University accounts are paid in full. Only the
s tudent may request refunds and must do so in person or in writing.
A 30-day waiting period is required on deposits made by check. Requests
made within six months of paying with a credit/debit card may be credited
back to that same credit/debit card.
</p>

<p>
<b>Wildcat Meal Plan Conversions</b>
<br />
Wildcat Meal Plans may be converted during the first three weeks of the Fall Semester
 at no additional charge. After 3 week grace period, no conversions are permitted until the end of the Spring Semester.
 Unused funds will automatically be converted to a Commuter Plan
(Commuter Plan never expires) for no charge on the first day of summer.
</p>

<p>
<b>Payment Options</b>
<br />For Wildcat Meal Plans only, you may elect to pay your Wildcat Meal Plan in
two equal installments through your Bursar???s account. With the 2-Payment
option: first half is funded and due at the start of Fall semester and the second
half funded during the middle of December with payment due at the start of
Spring semester.
</p>

<p>
<b>Meal Plan Processing Fee</b>
<br />A $50 non-refundable processing fee is charged to all Wildcat and Commuter Meal Plans.</p>

<p>
<b>Participating Meal Plan Locations</b>
<br />
All campus dining locations accept University of Arizona Meal Plans*:<br />
<ul style="font-size:12px; list-style-type:none;">
	<li>Student Union</li>
	<li>
		<ul style="font-size:12px; list-style-type:none; margin-left:15px;">
		      <?php
          $query = 'select location_name, location_url from location where group_id=1 and subgroup="Dining" and accept_plus_discount order by location_name';
          $result = $db2->query($query);
          while($location = mysqli_fetch_assoc($result)){
            print '<li><a href="'.$location['location_url'].'">'.$location['location_name'].'</a></li>';
          }
          ?>
		</ul>
	</li>
	<li>Park Student Union</li>
	<li>
		<ul style="font-size:12px; list-style-type:none; margin-left:15px;">
			<?php
	          $query = 'select location_name, location_url from location where group_id=2 and subgroup="Dining" and accept_plus_discount order by location_name';
	          $result = $db2->query($query);
	          while($location = mysqli_fetch_assoc($result)){
	            print '<li><a href="'.$location['location_url'].'">'.$location['location_name'].'</a></li>';
	          }
	    	?>
		</ul>
	</li>
	<li>Other Dining Locations</li>
	<li>
		<ul style="font-size:12px; list-style-type:none; margin-left:15px;">
			<li>Bear Down Kitchen</li>
			<li>Hot Dog Carts (Nugent, Harvill)</li>
			<li>Coffee Carts (Modern Languages, Social Sciences)</li>
			<li>Convenience Stores (AME, Keating, McClelland & McKale)</li>
			<li>The Counter</li>
			<li><a href="/dining/other/fuel">Fuel Modern Eatery</a></li>
			<li><a href="/dining/other/highland">Highland Market</a></li>
			<li>Oy Vey Cafe</li>
			<li>Starbucks at the Library</li>
			<li>Vending Machines</li>
		</ul>
	</li>
</ul>
<br />*locations subject to change</p>

<p>
<b>User Responsibility</b>
<br />The CatCard is the property of the University of Arizona, but it is entrusted to you for your convenience while enrolled or affiliated. Although Meal Plan accounts linked to your CatCard are voluntary, once a Meal Plan account is initiated, Account Owners will be held responsible for the proper use of their Meal Plan. All Meal Plan accounts are monitored on a regular basis, and the University of Arizona Student Unions reserves the right to freeze, cancel, or deny future use of the Meal Plan account if any fraudulent behavior or account abuse is detected. Fraudulent behavior/abuse includes but is not limited to unauthorized use, alteration or duplication. No Meal Plan account should be accessed by anyone other than the intended cardholder. Only the person pictured on the CatCard is entitled to spend money within the Meal Plan account. Unauthorized use, fraudulent behavior or abuse warrants termination of the Meal Plan account and/or disciplinary action.
</p>

<?php	 }
		else{
?>
<p>
Acceptance of a Meal Plan constitutes a binding contract between the student,
faculty, staff (Account Owner) and the University of Arizona Student Unions as
stipulated in the Meal Plan Terms &amp; Conditions.
</p>

<p>
<b>CatCard</b> <br />
Treat your CatCard as if it were cash. Report lost cards immediately to the Meal
Plan office in the Business Center (Student Union Memorial Center, 621-7043) at
which time a freeze can be placed on your Meal Plan. You can also freeze your
card online at <a href="http://union.arizona.edu/mealplans">union.arizona.edu/mealplans</a>. On weekends and evenings leave
a message on the voice mail or report to the Information Desk in the Student
Union. Replacement cards are issued by the CatCard office in the Business Center
(Student Union Memorial Center, 626-9162). Replacement cards cost $25.<br />
</p>

<p>
<b>Privacy of Information</b> <br />
Meal Plan balance and transaction information cannot be released to anyone
other than the Account Owner. However, anonymous deposits can be made
online with the Account Owner???s Student or Employee ID and last name. Students
can provide families online access to their meal plan information by creating a
Guest Account through the UAccess (<a href="http://uaccess.arizona.edu">uaccess.arizona.edu</a>) website. Instructions
for creating a Guest Account are at <a href="http://union.arizona.edu/mealplans">union.arizona.edu/mealplans</a>. Students can
also submit a signed ???Balance Information Release Form??? to the Meal Plan Office,
although this will not give online access to information.<br />
</p>

<p>
<b>Inactive Accounts</b><br />
Funds deposited to a Meal Plan account should be used or withdrawn in full
before leaving the University of Arizona. Accounts unused for six months will
enter inactive status and any funds left on deposit will be forfeited.
Notification of forfeiture for accounts over $50 will be sent to the last
known permanent address.<br />
</p>

<p>
<b>Refunds</b><br />
Refunds of unused Wildcat Meal Plans are permitted only at the end of the
Spring Semester. Wildcat Plan refunds
will not be processed at any other time with the exception of students who
officially withdraw from the University of Arizona. Refunds for all Meal Plans
will have a $50 charge deducted from them. All refunds are sent to the student???s
Bursar account and are then issued by the Bursar???s Office per their policies.
Refunds will not be paid unless all University accounts are paid in full. Only the
s tudent may request refunds and must do so in person or in writing.
A 30-day waiting period is required on deposits made by check. Requests
made within six months of paying with a credit/debit card may be credited
back to that same credit/debit card.<br />
</p>

<p>
<b>Tax Exemption</b><br />
Staff and Faculty Plan holders must pay tax.<br />
</p>

<p>
<b>Payment Option</b><br />
At this time, credit/debit cards are the only payment options for Faculty/Staff meal plans.
</p>

<p>
<b>Participating Meal Plan Locations</b>
<br />
All campus dining locations accept University of Arizona Meal Plans*:<br />
<ul style="font-size:12px; list-style-type:none;">
	<li>Student Union</li>
	<li>
		<ul style="font-size:12px; list-style-type:none; margin-left:15px;">
		      <?php
          $query = 'select location_name, location_url from location where group_id=1 and subgroup="Dining" and accept_plus_discount order by location_name';
          $result = $db2->query($query);
          while($location = mysqli_fetch_assoc($result)){
            print '<li><a href="'.$location['location_url'].'">'.$location['location_name'].'</a></li>';
          }
          ?>
		</ul>
	</li>
	<li>Park Student Union</li>
	<li>
		<ul style="font-size:12px; list-style-type:none; margin-left:15px;">
			<?php
	          $query = 'select location_name, location_url from location where group_id=2 and subgroup="Dining" and accept_plus_discount order by location_name';
	          $result = $db2->query($query);
	          while($location = mysqli_fetch_assoc($result)){
	            print '<li><a href="'.$location['location_url'].'">'.$location['location_name'].'</a></li>';
	          }
	    	?>
    		<li>Creperie / Bakery</li>
		</ul>
	</li>
	<li>Other Dining Locations</li>
	<li>
		<ul style="font-size:12px; list-style-type:none; margin-left:15px;">
			<li>Bear Down Kitchen</li>
			<li>Hot Dog Carts (Nugent, Harvill)</li>
			<li>Coffee Carts (Modern Languages, Social Sciences)</li>
			<li>Convenience Stores (AME, Keating, McClelland & McKale)</li>
			<li>The Counter</li>
			<li><a href="/dining/other/fuel">Fuel Modern Eatery</a></li>
			<li><a href="/dining/other/highland">Highland Market</a></li>
			<li>Oy Vey Cafe</li>
			<li>Starbucks at the Library</li>
			<li>Vending Machines</li>
		</ul>
	</li>
</ul>
<br />*locations subject to change</p>

<p>
<b>User Responsibility</b>
<br />The CatCard is the property of the University of Arizona, but it is entrusted to you for your convenience while enrolled or affiliated. Although Meal Plan accounts linked to your CatCard are voluntary, once a Meal Plan account is initiated, Account Owners will be held responsible for the proper use of their Meal Plan. All Meal Plan accounts are monitored on a regular basis, and the University of Arizona Student Unions reserves the right to freeze, cancel, or deny future use of the Meal Plan account if any fraudulent behavior or account abuse is detected. Fraudulent behavior/abuse includes but is not limited to unauthorized use, alteration or duplication. No Meal Plan account should be accessed by anyone other than the intended cardholder. Only the person pictured on the CatCard is entitled to spend money within the Meal Plan account. Unauthorized use, fraudulent behavior or abuse warrants termination of the Meal Plan account and/or disciplinary action.
</p>

<?php
		}
?>
</div>
<form name="termsandconditions" method="post" action="paymentoptions.php" style="margin-top:15px;">
<input type="checkbox" name="agreetoterms" value="1" <?php echo ( isset($_SESSION['agreetoterms']) ? 'checked' : '' ); ?> />I have read and agree to the above statements.<br /><br />
<input type="submit" name="termsandconditions" value="Continue" />
<input type="button" value="back" onclick="location='chooseplan.php'" style="margin-top: 10px;" />
</form>
<?php mp_finish();?>
