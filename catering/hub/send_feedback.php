<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin/forms/config/forms.php");
$feedback_ok = false;
$feedback_error = "";
if(form_authorized($form_cfg["event_orders"], "add")){
	if ($_SERVER["REQUEST_METHOD"]=="POST"
		&& !empty($_SESSION["beo_doc"])
		&& !empty($_SESSION["beo_file"])
		&& !empty($_POST["feedback"])
	){
		$filename1 = basename($_SESSION["beo_file"]["name"]);
		$content1 = file_get_contents($_SESSION["beo_file"]["tmp_name"]);
		$content1 = chunk_split(base64_encode($content1));
		$filename2 = $filename1.".json";
		$content2 = chunk_split(base64_encode(json_encode($_SESSION["beo_doc"], JSON_PRETTY_PRINT)));
		$uid = md5(uniqid(time()));
		$message = "New feedback from Catering Hub Event Order Upload: \r\n";
		$message .= $_POST["feedback"];
		
		$header = "From: Catering Hub Support <do-not-reply@email.arizona.edu> \r\n";
		$header .= "Reply-To: do-not-reply@email.arizona.edu\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		$alsoheader  = "--".$uid."\r\n";
		$alsoheader .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		$alsoheader .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$alsoheader .= $message."\r\n\r\n";
		$alsoheader .= "--".$uid."\r\n";
		$alsoheader .= "Content-Type: application/pdf; name=\"".$filename1."\"\r\n";
		$alsoheader .= "Content-Transfer-Encoding: base64\r\n";
		$alsoheader .= "Content-Disposition: attachment; filename=\"".$filename1."\"\r\n\r\n";
		$alsoheader .= $content1."\r\n\r\n";
		$alsoheader .= "--".$uid."\r\n";
		$alsoheader .= "Content-Type: application/json; name=\"".$filename2."\"\r\n";
		$alsoheader .= "Content-Transfer-Encoding: base64\r\n";
		$alsoheader .= "Content-Disposition: attachment; filename=\"".$filename2."\"\r\n\r\n";
		$alsoheader .= $content2."\r\n\r\n";
		$alsoheader .= "--".$uid."--";
		
		if(mail("jarowley@email.arizona.edu", "Catering Hub Feedback", $alsoheader, $header)){
			$feedback_ok = true;
		}else{
			$feedback_error = "The feedback email could not be sent.";
		}
	}else{
		$feedback_error = "There was a problem with your submission.";
	}
}else{
	$feedback_error = "You are not authorized to view this page.";
}
unset($_SESSION["beo_doc"]);
unset($_SESSION["beo_file"]);
//clean up old files
$files = glob($_SERVER["DOCUMENT_ROOT"]."/catering/hub/pdftemp/f*");
$now   = time();
foreach ($files as $file) {
	if (is_file($file)) {
		if ($now - filemtime($file) >= 60 * 60 * 24)
			unlink($file);
	}
}
?>
<html>
	<head>
		<title>Catering Hub Event Order Upload Feedback Frame</title>
		<link rel="stylesheet" type="text/css" href="./style/hub_frame.css" />
		<script type="text/javascript" src="./scripts/reframe.js"></script>
	</head>
	<body>
		<table style="width: 100%; height: 100%;">
			<tbody>
				<tr>
					<td style="text-align: left; vertical-align: top;">
						<h1>Upload Event Order Feedback</h1>
					</td>
					<td style="text-align: right; vertical-align: top;">
						<div id="admin-subheader-user">
							<?=admin_displayname()?> | 
							<a class="fake-link" href="<?=create_logout_link("Log out")?>">Log Out</a>
						</div>
					</td>
				</tr>
				<tr>
					<?php if($feedback_ok){ ?>
					<td style="height: 80%; vertical-align: top; text-align: center;" colspan="2">
						<h2>Your feedback has been received.</h2>
						<h3>Thank you for taking the time to help us improve our application.</h3>
					</td>
					<?php }else{ ?>
					<td style="height: 80%; vertical-align: top; text-align: center;" colspan="2">
						<h2>There was an error in sending your feedback.</h2>
						<h3><?=$feedback_error?></h3>
					</td>
					<?php } ?>
				</tr>
				<tr>
					<td style="text-align: center; vertical-align: top;" colspan="2">
						<h3><a href="event_orders.php">
							Back to Main Page
						</a></h3>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>