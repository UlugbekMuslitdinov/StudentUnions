<?php
	if(!isset($_SERVER['HTTPS']))
    {
        header("location: https://www.union.arizona.edu/csil/leadership/equiss/backweb/bwapp.php");
    }
	session_start();
?>
<title>Welcome to Equiss</title>

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

<?php
require_once('page_start.php');
require_once('password_protect.php');
?>

<h1>2008 Equiss Social Justice Retreat</h1>

	
<?php
	if(!isset($_SESSION['display'])) {
		$_SESSION['display'] = 1;
	}

	if($_SESSION['display'] == 1) {  //Show page 1
	
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
		include_once("app_page3.php");
		
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
		include_once("checkpay.php");
		
			if($_POST['page4_submitted']) {
			
			include_once('thankyou.php');
			
			
			if($error_string != ""){
				print '<p style="color:red">';
				print "<b>The following errors were encountered:</b><br>";
				print $error_string;
				print '</p>';
				print $form4;
			}else{
				$_SESSION['display'] = 5;
				register_page4_variables();
				}
			}else {
			//first time page is displayed just show the form
			print $form4;
			}	
	
		}
	
	
	
?>
	

<?php 
require_once('page_end.php');
?>