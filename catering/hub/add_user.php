<?php include($_SERVER["DOCUMENT_ROOT"]."/admin/forms/config/forms.php"); ?>
<html>
	<head>
		<title>Catering Hub Add/Remove User Frame</title>
		<link rel="stylesheet" type="text/css" href="./style/hub_frame.css" />
		<script type="text/javascript" src="./scripts/reframe.js"></script>
	</head>
	<body>
		<table style="width: 100%; height: 100%;">
			<tbody>
				<tr>
					<td style="text-align: left; vertical-align: top;">
						<h1>Add or Remove User</h1>
					</td>
					<td style="text-align: right; vertical-align: top;">
						<div id="admin-subheader-user">
							<?=admin_displayname()?> | 
							<a class="fake-link" href="<?=create_logout_link("Log out")?>">Log Out</a>
						</div>
					</td>
				</tr>
				<?php 
					if(form_authorized($form_cfg["event_orders"], "add")){
						if($_SERVER["REQUEST_METHOD"]=="POST"){
							$success = false;
							$error_msg = "Database error.";
							if(!empty($_POST["netid"]) && !stristr($_POST["netid"], "@")){
								$form = $form_cfg["admin_users"];
								$form_conn = $conn;
								$search = ["netid"=>$_POST["netid"]];
								$array_options = retrieve_options($form, "admin_screens");
								$array_options_inverse = array_flip($array_options);
								if(!empty($_POST["add_access"])){
									if(form_total_records($form, $search)){
										$records = retrieve_form($form, 1, 0, false, $search);
										$record = reset($records);
										if(in_array("cateringhub", $record["access"])){
											$error_msg = "This user already has Catering Hub access.";
										}else{
											$selected_options = Array();
											foreach($record["access"] as $opt_textual){
												array_push($selected_options, $array_options_inverse[$opt_textual]);
											}
											array_push($selected_options, $array_options_inverse["cateringhub"]);
											$record["access"] = $selected_options;
											if(update_record($form, $record["id"], $record)) $success=true;
										}
									}else{
										$record = Array();
										$record["netid"] = $_POST["netid"];
										$record["access"] = Array($array_options_inverse["cateringhub"]);
										$record["access_level"] = "1";
										$record["active"] = "1";
										if(insert_record($form, $record)) $success = true;
									}
								}else if(!empty($_POST["remove_access"])){
									if(form_total_records($form, $search)){
										$records = retrieve_form($form, 1, 0, false, $search);
										$record = reset($records);
										if(!in_array("cateringhub", $record["access"])){
											$error_msg = "This user does not have Catering Hub access.";
										}else if(in_array("cateringhub_admin", $record["access"])){
											$error_msg = "You can not remove the access of a Catering Hub admin.";
										}else{
											$selected_options = Array();
											foreach($record["access"] as $opt_textual){
												array_push($selected_options, $array_options_inverse[$opt_textual]);
											}
											$selected_options = array_diff($selected_options, Array($array_options_inverse["cateringhub"]));
											$record["access"] = $selected_options;
											if(update_record($form, $record["id"], $record)) $success=true;
										}
									}else{
										$error_msg = "This user does not exist.";
									}
								}else{
									$error_msg = "Form error, try again.";
								}
							}else{
								$error_msg = "You must enter a UA NetID, not an email.";
							}
							if($success){
				?>
				<tr>
					<td style="height: 80%; vertical-align: top; text-align: center;" colspan="2">
						<h2>Success!</h2>
						<h3>The user's permissions for the Catering Hub have been updated.</h3>
						<a href="event_orders.php">Back to Main Page</a>
					</td>
				</tr>
				<?php
							}else{
								unset($_SESSION["error_banner"]);
				?>
				<tr>
					<td style="height: 80%; vertical-align: top; text-align: center;" colspan="2">
						<h2>There was an error updating the user's permissions.</h2>
						<h3><span style="color: #B00;">Error: </span><span style="color: #333;"><?=$error_msg?></span></h3>
						<h3>Please try again later or contact an administrator.</h3>
						<a href="add_user.php">Back</a>
					</td>
				</tr>
				<?php
							}
						}else{ 
				?>
				<tr>
					<td style="height: 100%; text-align: center; vertical-align: center;" colspan="2">
						<h2>Add/Remove User Permissions for Catering Hub</h2>
						<form method="POST" style="margin-top: 10px;">
							<b>NetID (not email):</b>&nbsp;&nbsp;<input type="text" name="netid" required />
							<br/><br/>
							<input type="submit" name="add_access" value="Add User" />&nbsp;&nbsp;
							<input type="submit" name="remove_access" value="Remove User" />
						</form>
						<h3>This will only affect access to view event orders. To add a user with permission to create or modify events, please contact an administrator.</h3>
					</td>
				<?php	}
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