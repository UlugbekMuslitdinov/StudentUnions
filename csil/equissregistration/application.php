<?php
// Force WWW
if (!strstr($_SERVER['HTTP_HOST'], 'styx') && !strstr($_SERVER['HTTP_HOST'], 'sutest') && !strstr($_SERVER['HTTP_HOST'], 'www.'))
{
	//header('Location: https://www.union.arizona.edu' . $_SERVER['PHP_SELF']);
	//exit;
}

session_start();
require_once('page_start.php');
?>

<script type="text/javascript">
function textLimit(field, maxlen) {
	if (field.value.length > maxlen + 3) {
		alert('Your answer exceeded the 1800 character allotment.  Your answer has been truncated.');
	}
	if (field.value.length > maxlen) {
		field.value = field.value.substring(0, maxlen);
	}
}
</script>
<h1>Equiss Social Justice Retreat</h1>
	
<?php
	if(!isset($_SESSION['display'])) {
		$_SESSION['display'] = 1;
	}
	
	//Check to see if we are coming from the IDB buttonn
	if(isset($_POST['check'])){
		$_SESSION['check'] = true;
	}
	
	//Check to see if we are comming from the scholarship button
	if(isset($_POST['scholarship'])){
		$_SESSION['scholarship'] = true;
	}
	
	//Check to see if we are coming from the IDB buttonn
	if(isset($_POST['idb'])){
		$_SESSION['idb'] = true;
	}
	
	//They thought they had a scholarship, but now they need to pay with credit card
	if(isset($_GET['page']) && $_GET['page'] == "cc3") {
		$_SESSION['display'] = 3;
		unset($_SESSION['check'], $_SESSION['scholarship'], $_SESSION['idb']);
	}
	
	//var_dump($_POST, '<br>', $_SESSION);
	
	if ($_SESSION['display'] == 1) {  //Show page 1
		if (close_registration())
		{
			echo 'We are sorry but the registration period for Equiss has ended!';
		}
		else
		{
			include_once("app_page1.php");	
			
			if($_POST['page1_submitted']) {
				//If submit has been pressed, process
			
				$error_string = verify_personal_info();
				$error_string .= verify_questions();
				
				if($error_string != "") {
					print '<p style="color:red">';
					print "<b>The following errors were encountered:</b><br>";
					print $error_string;
					print '</p>';
					print $form1;
				}else{
					register_page1_variables();
					$_SESSION['display'] = 2;
				}
			}else {
				//first time page is displayed just show the form
				print $form1;
			}
		}
	}
	
	if($_SESSION['display'] == 2) {
		
		include_once("app_page2.php");
		
		if($_POST['page2_submitted']) {
			//If submit has been pressed, process
			
			$error_string = verify_page2_info();
			
			if($error_string != ""){
				print '<p style="color:red">';
				print "<b>The following errors were encountered:</b><br>";
				print $error_string;
				print '</p>';
				print $form2;
			}else{
				register_page2_variables();
				$_SESSION['display'] = 3;
			}
			
		}else {
			//first time page is displayed just show the form
			print $form2;
		}
		
	}
	
	if($_SESSION['display'] == 3) {
	
		if(isset($_SESSION['check'])){
		
			include_once("check_payment.php");
			
		}else if(isset($_SESSION['scholarship'])){
		
			include_once("scholarship_payment.php");
		
		}else if(isset($_SESSION['idb'])){
		
			include_once("IDB_payment.php");
			
		}else{
		
			include_once("app_page3.php");
		}	
			
		if($_POST['page3_submitted']) {
			//If submit has been pressed, process
			
			$error_string = verify_page3_info();
			
			if($error_string != ""){
				print '<p style="color:red">';
				print "<b>The following errors were encountered:</b><br>";
				print $error_string;
				print '</p>';
				print $form3;
			}else{
				register_page3_variables();
				$_SESSION['display'] = 4;
			}
			
		}else {
			//first time page is displayed just show the form
			print $form3;
		}
	}
	
	if($_SESSION['display'] == 4) {
	
		if(isset($_SESSION['check']) || isset($_SESSION['idb'])) {// || isset($_SESSION['scholarship'])
			$_SESSION['display'] = 5;
		}else {
			include_once("checkpay.php");
		}
	}
	
	if ($_SESSION['display'] == 5)
	{
		include_once("store_app.php");
	}

require_once('page_end.php');
?>