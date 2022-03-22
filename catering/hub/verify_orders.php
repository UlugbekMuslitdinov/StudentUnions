<?php 
	include($_SERVER["DOCUMENT_ROOT"]."/admin/forms/config/forms.php");
	include("depdf.php");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!isset($_FILES['beo']['error']) ||
			is_array($_FILES['beo']['error']) ||
			$_FILES['beo']['error'] != UPLOAD_ERR_OK ||
			$_FILES['beo']['size'] > 4000000 ||
			$_FILES['beo']['type'] != "application/pdf"
		) {
			$_SESSION["error_banner"] = "The submitted file is not valid.";
			header("Location: /catering/hub/upload_orders.php");
			exit();
		}
	
		$Opath0 = uniqid("t", true);
		$Opath = "/catering/hub/pdftemp/" . $Opath0;
		$Opath2 = $Opath . ".pdf";
		$Opath3 = $Opath0 . ".pdf";
		$_SESSION["new_pdf_name"] = $Opath3;
		$Ipath = $_SERVER["DOCUMENT_ROOT"].$Opath;
		move_uploaded_file($_FILES["beo"]["tmp_name"], $Ipath);
		copy($Ipath, $Ipath . ".pdf");
		$textdata = prepare_pdf($Ipath);
		$event_data = extract_data($textdata);		
		$_FILES["beo"]["tmp_name"] = $Ipath ;		
		$_SESSION["beo_file"] = $_FILES["beo"];
		$_SESSION["beo_doc"] = $event_data;
		$_SESSION["upload_order_confirm"] = true;

		function iInput($name, $number = false, $addtlclass = ""){
			global $event_data;
			return '<input size="" type="'.($number?"number":"text").'" class="inline'.(!empty($addtlclass)?" ".$addtlclass:"").'" name="eod-'.$name.'" value="'.$event_data[$name].'" data-autosize-input=\'{ "space": 3 }\'/>';
		}
?>
<html>
	<head>
		<title>Catering Hub Event Order Verification Frame</title>
		<link rel="stylesheet" type="text/css" href="./style/hub_frame.css" />
		<link rel="stylesheet" type="text/css" href="./style/beo_cards.css" />
		<link rel="stylesheet" type="text/css" href="/template/xdpicker/jquery.periodpicker.min.css" />
		<link rel="stylesheet" type="text/css" href="/template/xdpicker/jquery.timepicker.min.css" />
		<script type="text/javascript" src="/template/xdpicker/jquery.min.js";></script>
		<script type="text/javascript" src="/template/xdpicker/jquery.periodpicker.full.min.js";></script>
		<script type="text/javascript" src="/template/xdpicker/jquery.timepicker.min.js";></script>
		<script type="text/javascript" src='./scripts/addpickers.js';></script>
		<script type="text/javascript" src="./scripts/reframe.js"></script>
		<script type="text/javascript" src="./scripts/jquery.autosize.input.min.js"></script>
	</head>
	<body>
		<form action="upload_orders.php" method="POST">
			<table style="width: 100%; height: 100%;">
				<tbody>
					<tr>
						<td style="height: 50px; text-align: left; vertical-align: top;">
							<h1>Verify Event Order</h1>
						</td>
						<td style="height: 50px; text-align: right; vertical-align: top;">
							<div id="admin-subheader-user">
								<?//=admin_displayname()?> | 
								<a class="fake-link" href="<?//=create_logout_link("Log out")?>"><!--Log Out--></a>
							</div>
						</td>
					</tr>
					<?php 
						if(form_authorized($form_cfg["event_orders"], "add")){
					?>
					<tr>
						<td style="height: 100%; width: 50%; padding: 0 1.1% 0 0; vertical-align: top;">
							<h2 class="label" style="color: #B00; text-align: center; font-size: 20px;">
								Basic Document Info:
							</h2>
							<p>
								<b>Event ID #:</b> E<?=iInput("id", true)?><br/>
								<b>Event Date:</b> <?=iInput("date", false, "picker-datetime")?><br/>
								<b>Event Order Type:</b> <?=iInput("type")?> Event Order<br/>
							</p>
							<h2 class="label" style="color: #B00; text-align: center; font-size: 20px;">
								Additional Info:
							</h2>
							<div class="cardbox">
								<h2>Event Info</h2>
								<div class="deck">
									<h3>Business</h3>
									<table class="assoc-h">
										<tbody>
											<?php foreach($event_data['meta'] as $key=>$value){ ?>
											<tr>
												<th><?=trim(preg_replace('/([A-Z])/', ' $1', $key))?>:</th>
												<td><?=$value?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="deck">
									<h3>Venue</h3>
									<table class="assoc-h">
										<tbody>
											<?php foreach($event_data['event'] as $key=>$value){ ?>
											<tr>
												<th><?=trim(preg_replace('/([A-Z])/', ' $1', $key))?>:</th>
												<td><?=$value?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<?php
									$last_category = "";
									foreach($event_data["foodservice"] as $foodcard){
										if($foodcard["category"] != $last_category)
											echo('<h2>'.ucfirst($foodcard["category"]).'</h2>');
										$last_category = $foodcard["category"];
										
										echo('<div class="deck">');
										
										if(!empty($foodcard["title"]) && $foodcard["title"] != "Comments")
											echo('<h3>'.$foodcard["title"].'</h3>');
										if(!empty($foodcard["text"]))
											echo('<p>'.nl2br($foodcard["text"]).'</p>');
										
										foreach($foodcard["items"] as $fooditem){
											echo('<div class="card">');
											if(!empty($fooditem["title"]))
												echo('<h4>'.$fooditem["title"].'</h4>');
											if(!empty($fooditem["text"]))
												echo('<p>'.nl2br($fooditem["text"]).'</p>');
											echo('</div>');
										}
										
										if(count($foodcard["meta"])){
											$metakeys = array_keys($foodcard["meta"]);
											$metavalues = array_values($foodcard["meta"]);
										?>
											<table class="assoc-v">
												<thead>
													<tr>
														<?php
															foreach($metakeys as $key){
																echo("<th>$key</th>");
															}
														?>
													</tr>
												</thead>
												<tbody>
													<tr>
														<?php
															foreach($metavalues as $value){
																echo("<td>$value</td>");
															}
														?>
													</tr>
												</tbody>
											</table>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
							<?php /*
							<h2 class="label" style="color: #B00; text-align: center; font-size: 20px;">
								Temporary raw output:
							</h2>
							<p>
								<pre style="font-size: 12px; white-space: pre-wrap;"><?=var_export($event_data, true)?></pre>
							</p>
							//*/ ?>
						</td>
						<td style="height: 100%; width: 50%; vertical-align: top;">
							<embed src="<?php print($Opath2); ?>" type="application/pdf" style="height: 100%; width: 100%;"/>
						</td>
					</tr>

					<tr>
						<td style="height: 40px; text-align: center; vertical-align: bottom;" colspan="2">
							<input type="hidden" name="uoc" />
							<button type="submit" name="doc_action" value="accept"><b>Accept Document</b></button>
							<!--<button type="submit" name="doc_action" value="fileonly"><b>Accept File/Basic Info Only</b></button>-->
							<button type="submit" name="doc_action" value="reject"><b>Reject Document</b></button>
						</td>
					</tr>
					<?php }else{ ?>
					<tr>
						<td style="height: 85%; text-align: center; vertical-align: top;" colspan="2">
							<h2>You are not authorized to view this page. Please contact your supervisor for access.</h2>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</form>
	</body>
</html>
<?php
	} else {
		header("Location: /catering/hub/upload_orders.php");
	}
?>