<?php
require_once('template/mp.inc');
require_once ('includes/mysqli.inc');

$db = new db_mysqli('mealplans');

//make sure a user is currently logged in and session hasn't expired
if(!isset($_SESSION['mp_cust']['id'])){
	header("Location:index.php");
	exit();
}

//make sure someone didn't just manualy hit this address while account was in different state
if($_SESSION['mp_cust']['state'] == 'no plan' || $_SESSION['mp_cust']['state'] == 'no account'){
	header("Location:index.php");
	exit();
}

//check to see if MP is in a state that doesn't allow deposits
if($_SESSION['mp_cust']['state'] == 'pending'){
	header("Location:pending.php");
	exit();
}


if(isset($_POST['deactivate'])){
	$_SESSION['mp_cust']['state'] = 'deactive';
	mp_start('Payment Options', 0, 1);
	$query = 'insert into lost_card set first_name="'.$_SESSION['mp_cust']['firstname'].'", last_name="'.$_SESSION['mp_cust']['lastname'].'", cust_id="'.$_SESSION['mp_cust']['cust_num'].'", account_active="F"';
	$db->query($query);
	print '<h1>Card Deactivation</h1>It will take about 10 minutes for the change to propagate through our system. After the 10 minutes have passed, your Catcard will no longer be able to access your Mealplan money and you cannot make deposits online.';
	mp_finish();
	exit();
}

if(isset($_POST['activate'])){
	mp_start('Payment Options', 0, 1);
	$query = 'update lost_card set account_active="T", status="Pending Export" where cust_id='.$_SESSION['mp_cust']['cust_num'].' and account_active="F"';
	$db->query($query);
	print '<h1>Card Reactivation</h1>It will take about 10 minutes for the change to propagate through our system. After the 10 minutes have passed, your Catcard will be able to access your Mealplan money and you can make deposits online.';
	mp_finish();
	exit();
}





mp_start('Payment Options', 0, 1);
?>
<h1>Deactivate Your Mealplan</h1>
<p>
By clicking the button below, you will temporarily deactivate your mealplan. If you have lost your catcard, this will ensure that no one can spend your mealplan money. If you find your card or replace it, you can reactivate your card by logging back into the mealplan site or contacting the Mealplans Office.
</p>
<p>
While your account is inactive you will not be able to use your mealplan or make deposits.
</p>
<form action="deactivate" method="post">
	<input type="submit" name="deactivate" value="Deactivate" />
</form>
<?php mp_finish();?>
