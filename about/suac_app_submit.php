<?php
	session_start();
	$required = array('name_required', 'phone_required', 'address_required',
			'voicemail_required', 'email_required', 'live_on_campus', 'major', 'GPA',
			'class_standing', 'other_org_involvement', 'why_interested',
			'two_issues');
	foreach($required as $item)
	{
		if(empty($_POST[$item]))
		{
			$_SESSION['error'] = 'Please complete all fields';
			$flag = true;
		}
		$_SESSION[$item] = $_POST[$item];
	}
	if($flag)
	{
		header('Location: suac_app.php');
		die();
	}
	require_once('about.inc');
	$page_options['title'] = 'Student Union Advisory Council';
	about_start($page_options);
?>
<h1>Student Unions Advisory Council</h1>
<h3>MEMBERSHIP APPLICATION</h3>

<?php
	
	$to = 'harrisoj@email.arizona.edu';
	
	$subject = 'SUAC Application - '.$_POST['name_required'];
	
	$body =  '<html><body>Student Union Advisory Council Application<br/>'.
				 '<table>'.
					 '<tr><td>Name</td><td>'.$_POST['name_required'].'</td></tr>'.
					 '<tr><td>Daytime Phone</td><td>'.$_POST['phone_required'].'</td></tr>'.
					 '<tr><td>Message Phone</td><td>'.$_POST['voicemail_required'].'</td></tr>'.
					 '<tr><td>Address</td><td>'.$_POST['address_required'].'</td></tr>'.
					 '<tr><td>E-mail</td><td>'.$_POST['email_required'].'</td></tr>'.
					 '<tr><td>Lives on Campus</td><td>'.$_POST['live_on_campus'].'</td></tr>'.
					 '<tr><td>Major</td><td>'.$_POST['major'].'</td></tr>'.
					 '<tr><td>GPA</td><td>'.$_POST['GPA'].'</td></tr>'.
					 '<tr><td>Class Standing</td><td>'.$_POST['class_standing'].'</td></tr>'.
					 '<tr><td>Involvement</td><td>'.$_POST['other_org_involvement'].'</td></tr>'.
					 '<tr><td>Why Interested</td><td>'.$_POST['why_interested'].'</td></tr>'.
					 '<tr><td>2 Issues of Concern</td><td>'.$_POST['two_issues'].'</td></tr>'.
				 '</table>'.
			 '</html>';
			 
    $headers = "From: \"SUAC Application\" <noreply@union.arizona.edu>\r\n".
    		   "Reply-To: noreply@union.arizona.edu\r\n".
    		   "Content-Type: text/html; charset=ISO-8859-1\r\n";
    
    mail($to, $subject, $body, $headers);
?>
<br/>
Thank you for your submission. It will be reviewed shortly.

<?php about_finish() ?>
