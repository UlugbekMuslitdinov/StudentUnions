<?php
require_once('template/mp.inc');
require_once ('includes/mysqli.inc');

//make sure if the hit back after making it all the way to the cc page it gets cleared out
unset($_SESSION['paymentID']);

if($_SESSION['mp_cust']['state'] == '50/50'){
  $_SESSION['mp_cust']['state'] = 'no plan';
}

//make sure users session is stull active and that this is an appropriate page for the user to be on
if(!isset($_SESSION['mp_cust']['id']) || !isset($_SESSION['webauth']['netID']) || $_SESSION['mp_cust']['state'] != 'no plan' || $_SESSION['mp_cust']['state'] == 'swipe' ) {
	header("Location:index.php");
	exit();
}


$db = new db_mysqli('mealplans');

//check if mealplans is turned off currently
$query = "select * from control";
$result = $db->query($query);
$control = mysqli_fetch_assoc($result);

if(!$control['signup'] && $_SESSION['webauth']['netID'] != 'jmasson'){
  print '<p>'.$control['signup_message'].'</p>';
  exit();
}

//get important dates from the current yearly config
$query = 'select * from yearly_config where start <= "'.date("Y-m-d").'" and end >= "'.date("Y-m-d").'"';
$result = $db->query($query);
$_SESSION['yearly_config'] = mysqli_fetch_assoc($result);

if(isset($_SESSION['debug']) && $_SESSION['debug'] && isset($_SESSION['now'])){
    $now = $_SESSION['now'];
}
else{
    $now = time();
}

//check if we are in the full  year or half year plan signup phases and make appropriate variable assignments also if we are still allowing wildcat plan signups
if($now > strtotime($_SESSION['yearly_config']['half_plan_start'])){
  $_SESSION['config']['is_half_year'] = 1;
  $fee_type = 'half_year_fee';
  $prorate_divisor = 2;
  if($now > strtotime($_SESSION['yearly_config']['stop_plus_signup'])){
    $_SESSION['config']['no_plusplan'] = 1;
  }
  else{
    $_SESSION['config']['no_plusplan'] = 0;
  }
}
else{
  $_SESSION['config']['is_half_year'] = 0;
  $_SESSION['config']['no_plusplan'] = 0;
  $fee_type = 'full_year_fee';
  $prorate_divisor = 1;
}

$allow_students = '';
if ($_SESSION['webauth']['activestudent']) {
  $allow_students = 'allow_students=1';
}

$allow_staff = '';
if ($_SESSION['webauth']['activeemployee']) {
  $allow_staff = 'allow_faculty=1';

  if ($_SESSION['webauth']['activestudent']) {
    $allow_staff = ' or ' . $allow_staff;
  }
}

//get all plans that user could signup for based on their student/faculty status
if ($_SESSION['webauth']['activestudent'] || $_SESSION['webauth']['activeemployee']) {
  $query = 'select * from plan where enabled=1 and (' . $allow_students . $allow_staff . ')';
  if($_SESSION['config']['no_plusplan'])
  	$query .= ' and plus_plan=0';
  $result = $db->query($query);
}
else {
  $result = NULL;
}

//start mp template with title, no header, must be logged in, and is signup page
mp_start('Choose a Meal Plan', 0, 1, 1);
?>
<h1 style="font-size:30px; margin-top:30px;">Choose Plan</h1>
<?php echo (isset($_SESSION['errors'][1]) ? $_SESSION['errors'][1] : ''); ?>
<?=$_SESSION['config']['is_half_year']?'<h2>Half Year Plans</h2>':''?>
<form action="termsandconditions.php" method="post" name="choose_plan_form" id="choose_plan_form">
<table>
	<tbody>
		<?php
		while($plan = mysqli_fetch_assoc($result)){
			if (!isset($_SESSION['plan'])){
				$_SESSION['plan'] = null;
			}
		?>
		<tr>
			<td><input type="radio" name="plan" value="<?=$plan['plan_id']?>" <?= $plan['plan_id']==$_SESSION['plan'] ? 'checked' : '' ?>  /></td>
			<td>
			<b><?=$plan['name']?></b>
			</td>
		</tr>
		<tr>
			<td></td>
			<td style="padding-bottom:8px; font-size:12px;">
			<p style="position:relative; top:-2px; line-height:14px;">
			<?php
			if($plan['discount']!=0 && $plan['tax_discount']!=0){
				print 'Receive $'.($plan['min_deposit']*$plan['discount']/100).' bonus + save '.$plan['tax_discount'].'% sales tax<br />';
			}
			elseif($plan['discount']!=0){
				print 'Save '.$plan['discount'].'% &middot;';
			}
			elseif($plan['tax_discount']!=0){
				print 'Save '.$plan['tax_discount'].'% sales tax &middot;';
			}

			setlocale(LC_MONETARY, 'en_US');
			?>

			<?=$plan['min_deposit']!=0?'Required Minimum Deposit: '.money_format("%.0n", $plan['plus_plan']?$plan['min_deposit']/$prorate_divisor:$plan['min_deposit']):'No Minimum Deposit'?><?=$plan[$fee_type]!=0?' + '.money_format("%.0n",$plan[$fee_type]).' processing fee':''?><br />
			</p>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
<?php if (!$result) { ?>
  <p>No plans are available.</p>
<?php } else { ?>
  <input type="submit" name="chooseplan" value="continue" />
<?php } ?>
</form>
<?php mp_finish();?>
