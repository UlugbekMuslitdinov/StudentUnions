<?php include($_SERVER["DOCUMENT_ROOT"]."/admin/forms/config/forms.php"); ?>
<html>
	<head>
		<title>Catering Hub Event Order Creation Frame</title>
		<link rel="stylesheet" type="text/css" href="./style/hub_frame.css" />
		<script type="text/javascript" src="./scripts/reframe.js"></script>
	</head>
	<body>
		<table style="width: 100%; height: 100%;">
			<tbody>
				<tr>
					<td style="text-align: left; vertical-align: top;">
						<h1>Upload Event Order</h1>
					</td>
					<td style="text-align: right; vertical-align: top;">
					
						<div id="admin-subheader-user">
							<?//=admin_displayname()?> | 
							<a class="fake-link" href="<?//=create_logout_link("Log out")?>"><!--Log Out--></a>
						</div>
						
					</td>
				</tr>
				<?php 
					if(form_authorized($form_cfg["event_orders"], "add")){
						if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION["upload_order_confirm"] && isset($_POST["uoc"])){
							$newRecord = true;
							$_GET["form"] = "event_orders";
							$_GET["vea_validate_only"] = true;
							$_POST["event_id"] = $_POST["eod-id"];
							$_POST["event_time"] = $_POST["eod-date"];
							$_POST["event_type"] = $_POST["eod-type"];
							$_POST["pdf_link"] = $_SESSION["new_pdf_name"];
							// $_FILES["pdf_link"] = $_SESSION["beo_file"];
							$_POST["uploader"] = $_SESSION["adminUser"]["netID"];
							$show_feedback_box = false;
							
							$newpath = "";
							if($_POST["doc_action"] == "accept"){
								$_POST["data"] = json_encode($_SESSION["beo_doc"]);
								unset($_SESSION["beo_doc"]);
								unset($_SESSION["beo_file"]);
							}else{
								$show_feedback_box = true;
								$newpath = $_SERVER["DOCUMENT_ROOT"]."/catering/hub/pdftemp/f".basename($_SESSION["beo_file"]["tmp_name"]);
								copy($_SESSION["beo_file"]["tmp_name"], $newpath);
							}
							unset($_SESSION["upload_order_confirm"]);
							
							if($_POST["doc_action"] != "reject"){
								include($_SERVER["DOCUMENT_ROOT"]."/admin/forms/record_edit.php");
								if($vea_validate_success){
				?>
				<tr>
					<td style="vertical-align: top; text-align: center;" colspan="2">
						<h2 style="color: #B00;">Success<?=$show_feedback_box?"?":"!"?></h2>
						<h3 style="margin: 4px;">The event order has been added<?=$show_feedback_box?", however, the detailed event data has been discarded.":"."?></h3>
				<?php
								}else{
									unset($_SESSION["error_banner"]);
				?>
				<tr>
					<td style="vertical-align: top; text-align: center;" colspan="2">
						<h2>There were one or more errors with the form.</h2>
						<h3>Please double-check your inputs and try again.</h3>
						<br/>
				<?php
								}
							}else{
				?>
				<tr>
					<td style="vertical-align: top; text-align: center;" colspan="2">
						<h2 style="color: #B00;">Document Rejected.</h2>
						<h3 style="margin: 4px;">The original file and processed data have been discarded.</h3>
				<?php
							}
							
							if($show_feedback_box){
								$_SESSION["beo_file"]["tmp_name"] = $newpath;
				?>
						<div style="max-width: 800px; width: 80%; margin: 10 auto;">
							<h4 style="margin-bottom: 4px;">
								If you have the time, please explain why you did not accept the document.
								This explanation, along with the original file and processed output, will be sent to the web development team so we can improve the application.
							</h4>
							<form action="send_feedback.php" method="POST">
								<textarea rows="8" name="feedback" style="width: 100%; margin-bottom: 6px;" required></textarea>
								<input type="submit" />
							</form>
						</div>
						<br/>
				<?php
							}
				?>
						<a href="event_orders.php">Back to Main Page</a>
						<div class="hr-text"><span>or</span></div>
						<h2>Add another:</h2>
						<br/>
					</td>
				</tr>
				<?php
						}
						$files = glob($_SERVER["DOCUMENT_ROOT"]."/catering/hub/pdftemp/*");
						$now   = time();
						foreach ($files as $file) {
							if (is_file($file)) {
								if ($now - filemtime($file) >= 60 * 60 * 24)
									unlink($file);
							}
						}
				?>
				<tr>
					<td style="height: 80%; vertical-align: top;" colspan="2">
						<form action="verify_orders.php" enctype="multipart/form-data" method="POST">
							<table id="eo_upload">
								<tbody>
									<!--
									<tr>
										<td class="label" style="color: #B00;" colspan="2">
											All fields are required.
										</td>
									</tr>
									<tr>
										<td>
											<label for="event_id">
												Event ID #:
											</label>
										</td>
										<td>
											E<input type="number" min="0" name="event_id" id="event_id" style="width: 163px;" required />
										</td>
									</tr>
									<tr>
										<td>
											<label for="event_time">
												Event Date/Time:
											</label>
										</td>
										<td>
											<input type="text" class="picker-datetime" name="event_time" id="event_time" <?=(!empty($_POST["event_time"])?'value="'.$_POST["event_time"].'"':'')?> required />
										</td>
									</tr>
									<!---->
									<tr>
										<td style="padding-bottom: 6px;">
											<label>
												Event Order PDF:
											</label>
										</td>
										<td style="padding-bottom: 6px;">
											<!--<input type="file" name="pdf_link" id="pdf_link" accept="application/pdf" onchange="extractFromName(this.value)" required />-->
											<input type="file" name="beo" accept="application/pdf" required />
										</td>
									</tr>
									<tr>
										<td colspan="2" style="text-align: center; padding-top: 8px; border-top: 1px solid #ebebeb;">
											<input type="submit" />
										</td>
									</tr>
									<tr>
										<td class="label" style="padding-top: 10px; color: #666; font-size: 0.7em;" colspan="2">
											<!--If you choose a file with a name like "E12345 12.34pm.pdf", the event ID and time (but not date) will be automatically filled.-->
											If the file is an event order exported from CaterEase, the next screen will allow you to verify the extracted data.
										</td>
									</tr>
								</tbody>
							</table>
						</form>
					</td>
				</tr>
				<tr>
					<td style="text-align: center; vertical-align: top;" colspan="2">
						<h3><a target="_blank" href="/admin/forms/records.php?form=event_orders">
							Event Orders Admin Console
						</a></h3>
					</td>
				</tr>
				<?php
					}else{ 
				?>
				<tr>
					<td style="height: 85%; text-align: center; vertical-align: top;" colspan="2">
						<h2>You are not authorized to view this page. Please contact your supervisor for access.</h2>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</body>
</html>