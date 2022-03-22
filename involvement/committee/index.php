<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//require 'PHPMailer/src/Exception.php'; 
//require 'PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/SMTP.php';
require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';

//Load Composer's autoloader
require '../../vendor/autoload.php';
	// header("Location: ../index.php");
	// die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc'); //server
	//require_once('template/global.inc'); //local
	$page_options['title'] = "Auxiliary Services' Student Advisory Committee"; //tab title
	page_start($page_options);	
?>
<style type="text/css">
	body.togo_order {
		background: #F4E7D7 !important;
	}
	.page_background {
		background: #FFFFFF;
		margin-top:-20px;
		padding:10px;
	}
	.page_title {
		font-size: 24px;
		font-weight: 600;			
		color: orangered;
		margin-bottom:20px;
	}
	.page_content {
		line-height: 20px;
	}
	.text_description {
		margin-top: -10px;
		margin-bottom: 10px;
		font-size:22px;
	}
	.text_bold {
		font-size: 20px;
		font-weight: bold;
	}
	.subheader{
		width: 100%;
		height: 16px;
		background: #CC9D66;
		overflow: hidden;
	}
	.asterisk {
		margin-left: 5px;
		font-size: 20px;
		font-weight: bold;
		color: red;
	}
	.submit_button {
		font-size: 20px;
		font-weight: bold;
		background-color: blanchedalmond;
	}
	.submit_success {
		font-size: 20px;
		font-weight: bold;
		color: red;
	}
	.button {
  		background-color: grey;
		color: white;
		padding: 0.5rem;
		font-family: sans-serif;
		border-radius: 0.3rem;
		cursor: crosshair, pointer;
		margin-top: 1rem;
	}
	.file_size_button {
		background-color: orangered;
		color: white;
		padding: 0.5rem;
		font-family: sans-serif;
		border-radius: 0.3rem;
		cursor: crosshair, pointer;
		margin-top: 1rem;
	}
	.file_size_button_text {
	padding: 1.0rem;
	margin-top: 1rem;
	}
	.radio_text {
	padding: 0.5rem;
	}
</style>
<script>
function setFocusToTextBox(){
	document.getElementById('first_name').focus();
}
	
// Check the uploaded file size.
function checkFileSize() {
	var input = document.getElementById('fileToUpload');
	var file = input.files[0];
	
	// The file size limit is 2 Mb.
	if (file.size > 2000000) {
		alert("The allowed file size limit is 2Mb.  Please reduce the file size and try again.");
		return false;
	} else {
		return true;
	}
}
</script>
<body onload='setFocusToTextBox()'>
<div class="container">
<div class="row">
	<div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/involvement_banner.jpg" class="img-fluid" alt="">
	</div>
</div><br />
	
<h1>Auxiliary Services' Student Advisory Committee</h1>
<div class="text_description">
<?php
// if the submit button was clicked.
if (isset($_POST['submit'])) {		
	include_once('class.phpmailer.php');
	include_once('class.smtp.php');
	// Upload file.
	if (($_FILES['fileToUpload']['name'])){		
		// Where the file is going to be stored
		$target_dir = "upload/";
		$file = $_FILES['fileToUpload']['name'];	// Uploaded file name
		$file_extension = pathinfo($file, PATHINFO_EXTENSION);	// Extension of the file
		$extension_pos = strrpos($file, '.'); // Find the position of the dot.
		$date = new DateTime();
		$filename = substr($file, 0, $extension_pos) . '_' . $date->getTimestamp();	// Add timestamp.
		$filename = $filename . '.' . $file_extension;	// Add extension.
		$file = $filename;		// This will be used as email attachment.
		$temp_name = $_FILES['fileToUpload']['tmp_name'];	
		$path_filename_ext = $target_dir.$filename.".".$ext;
		move_uploaded_file($temp_name,"upload/" . $filename);
		// echo "File Uploaded Successfully.";
		// exit();	
	} else {
		echo "File Uploading Failed.";
		exit();
	}
	// Send the confirmation email.
	$first_name = $_POST["first_name"];
	$last_name = $_POST["last_name"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$statement = $_POST["statement"];
	// Email message:
	$subject = "Auxiliary Services' Student Advisory Committee Application";
	//these headers are for default php mailer. currently using PHPMailer, so you must edit $mail below to change addresses
	$headers = 'From: Arizona Student Unions <no-reply@email.arizona.edu>' . "\r\n"; 
	$headers .= 'Reply-To: DO-NOT-REPLY <no-reply@email.arizona.edu>' . "\r\n";
	// $headers .= "Bcc: su-studadvisorycmte@email.arizona.edu\r\n";
	$headers .= "Bcc: su-web@email.arizona.edu\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";
	$message = '<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body style="font-family: verdana;font-size: 14px; line-height: 150%">
		<br /><h3 style="width:100%;border-top:1px solid #333;border-bottom:1px solid #333;padding-top:5px;padding-bottom:6px;margin-top:0px;margin-bottom:10px;">Auxiliary Services Student Advisory Committee Application Details</h3>
		<b>FIRST NAME: </b> '.$first_name.'<br/>
		<b>LAST NAME: </b> '.$last_name.'<br/
		<b>EMAIL: </b> '.$email.'<br/>
		<b>PHONE: </b> '.$phone.'<br/>
		<b>STATEMENT:</b><br/><pre><div style="font-family: verdana; font-size: 14px;"> '.$statement.'</div></pre><br/>	
		<b>ATTACHED FILE: </b> <br/>
		<b>filename: </b> '.$file.'<br/>
	</body>
	</html>';
		
	//Send email.	 //PHPMailer start
	$mail = new PHPMailer(true);
    	//Recipients
    	//$mail->SetFrom('no-reply@email.arizona.edu', 'Arizona Student Unions'); //production
		$mail->SetFrom('su-web@email.arizona.edu', 'Arizona Student Unions');  //testing
    	$mail->AddAddress($email, $first_name);     //customer email
    	$mail->AddReplyTo('no-reply@email.arizona.edu', 'DO-NOT-REPLY');
    	$mail->addBCC('su-studadvisorycmte@email.arizona.edu'); //production
    	$mail->addBCC('su-web@email.arizona.edu'); 		 //testing

	//check if file exists to prevent sending bad information when no file upload by user
	if (($_FILES['fileToUpload']['name'])){  
    		$mail->AddAttachment('upload/'.$file); 
	}
	
    	//Content
    	$mail->isHTML(true);                                  //Set email format to HTML
    	$mail->Subject = 'Auxiliary Services\' Student Advisory Committee Application';
    	$mail->Body    = $message;
    	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	//send the message, check for errors
    	if (!$mail->send()) {	
		echo "Mailer Error: " . $mail->ErrorInfo;
   	 } else {
     	   echo "<form><input type='hidden' id='submit_success'></form><p class='submit_success' >Thank you. The form was submitted successfully.</p><br />";
  	 } //PHPMailer end
} 	
?>	
	The Business Affairs - Auxiliary Services organization, made up of the BookStores, Parking and Transportation Services, and Student Unions, is establishing a Student Advisory Committee to engage students in our efforts to develop new services and programs that enrich the student experience on the UA main campus.<br /><br />

	The committee will have 20-25 members. We are inviting you to submit your interest in serving on this newly created advisory committee for the 2021-22 academic year. <b>If interested in applying for the committee, please fill out the form.</b>
</div><br />

<?php
// Display the form before the form is submitted.
if (!isset($_POST['submit'])) {
?>	
<div class="col-sm-12 order-form">
	<form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" onSubmit="return checkFileSize();">
	<div class="row">
		<div class="col-sm-12 no-padding client-contact-info">
			<div class="form-group col-sm-8">
			<div class="form-group col-sm-8">
				<label class="text_bold">FIRST NAME <span class="asterisk">*</span></label>
				<input type="text" name="first_name" id="first_name" size="50" required>
			</div><br /><br /><br />
			<div class="form-group col-sm-8">
				<label class="text_bold">LAST NAME <span class="asterisk">*</span></label>
				<input type="text" name="last_name" id="last_name" size="50" required>
			</div><br /><br /><br />
			<div class="form-group col-sm-8">
				<label class="text_bold">EMAIL <span class="asterisk">*</span></label>
				<input type="text" name="email" id="email" size="50" required>
			</div><br /><br /><br />
			<div class="form-group col-sm-8">
				<label class="text_bold">PHONE <span class="asterisk">*</span></label>
				<input type="text" name="phone" id="phone" size="50" required>
			</div><br /><br /><br />
			</div><br />
			<div class="form-group col-sm-8">
			<div class="form-group col-sm-12">
				<label class="text_bold">A short statement on why you are interested in serving on the committee <span class="asterisk">*</span></label><br/>
				<textarea name="statement" cols="100" rows="5" id="statement" maxlength="5000"  required></textarea>
			</div>
			</div><br />
			
			<div class="form-group col-sm-12">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" > 
  					<label class="text_bold">Upload your resume: <span class="asterisk">*</span>&nbsp&nbsp&nbsp</label>
  					<input type="file" name="fileToUpload" id="fileToUpload" class="button" required></form><br/>
					<!--<input type="button" name="btnLoad" class="file_size_button" value="Check File Size" id="btnLoad" >-->
					<div class="file_size_button_text"> ***File size must be less than 2000KB (2MB).***</div>
					<div id="filePrintOut"></div>			
			</div><br />
						
			<div class="form-group col-sm-8">
			<p id="xcomment" >
			<div class="form-group col-sm-12">
			<input type="submit" name="submit" class="submit_button" value="SUBMIT" id="submit">
			</div><br />
			</p>
			</div>
			
		</div>
	</div>
	</form>
</div>
<?php 
	}	
?>
</body>
