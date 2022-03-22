<?php
session_start();
require_once('webauth/include.php');
require_once ('includes/mysqli.inc');

$db = new db_mysqli('mealplans');

if($_SESSION['webauth']['netID'] != 'nicka'){
//include code to control access to backweb
require_once('../includes/access.inc');
}


if(isset($_POST['login'])){

	switch($_POST['login']){
		case 'Test Student':
			$_SESSION['webauth']['netID'] = 'mptest';
			$_SESSION['webauth']['emplid'] = '1234';
			$_SESSION['webauth']['activestudent'] = 1;
			$_SESSION['webauth']['activeemployee'] = 0;
		break;
		case 'Test Staff':
			$_SESSION['webauth']['netID'] = 'mptest';
			$_SESSION['webauth']['emplid'] = '1234';
			$_SESSION['webauth']['activestudent'] = 0;
			$_SESSION['webauth']['activeemployee'] = 1;
		break;
		case 'Test Student/Staff':
			$_SESSION['webauth']['netID'] = 'mptest';
			$_SESSION['webauth']['emplid'] = '1234';
			$_SESSION['webauth']['activestudent'] = 1;
			$_SESSION['webauth']['activeemployee'] = 1;
		break;
		case 'No Plan Student':
			$_SESSION['mp_cust']['state'] = 'no plan';
      $_SESSION['webauth']['activestudent'] = 1;
			$_SESSION['webauth']['activeemployee'] = 0;
			header("Location:../chooseplan.php");
			exit();
		break;
    case 'No Plan Staff':
			$_SESSION['mp_cust']['state'] = 'no plan';
      $_SESSION['webauth']['activestudent'] = 0;
			$_SESSION['webauth']['activeemployee'] = 1;
			header("Location:../chooseplan.php");
			exit();
		break;
    case 'No Plan Student/Staff':
			$_SESSION['mp_cust']['state'] = 'no plan';
      $_SESSION['webauth']['activestudent'] = 1;
			$_SESSION['webauth']['activeemployee'] = 1;
			header("Location:../chooseplan.php");
			exit();
		break;
    case 'No Plan':
			$_SESSION['mp_cust']['state'] = 'no plan';
      $_SESSION['webauth']['activestudent'] = 0;
			$_SESSION['webauth']['activeemployee'] = 0;
			header("Location:../chooseplan.php");
			exit();
		break;

	}

	header("Location:../login.php");
	exit();

}



?>
<form action="" method ="post">
	<input type="submit" name="login" value="Test Student" />
	<input type="submit" name="login" value="Test Staff" />
	<input type="submit" name="login" value="Test Student/Staff" />
	<input type="submit" name="login" value="No Plan Student" />
  <input type="submit" name="login" value="No Plan Staff" />
  <input type="submit" name="login" value="No Plan Student/Staff" />
  <input type="submit" name="login" value="No Plan" />
</form>
