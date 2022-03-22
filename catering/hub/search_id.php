<?php
date_default_timezone_set("America/Phoenix");
if((empty($_GET["event_id"]) || !ctype_digit($_GET["event_id"]))
	&& (empty($_GET["day"]) || !ctype_digit($_GET["day"]))
	&& empty($_GET["event_time"]))
{
	header("Location: event_orders.php"); 
	exit();
}
?>
<html>
	<head>
		<title>Event Orders - Search by ID</title>
		<link rel="stylesheet" type="text/css" href="./style/forms_reduced.css" />
		<link rel="stylesheet" type="text/css" href="./style/hub_frame.css" />
		<script type="text/javascript" src="./scripts/reframe.js"></script>
	</head>
	<body>
	<?php
		if(!empty($_GET["day"])){
			$offset = $_GET["day"]-date('N');
			error_log($offset);
			if($offset < 0) $offset += 7;
			$_GET["event_time"] = date('Y-m-d', strtotime('+'.$offset.'days'));
			unset($_GET["day"]);
		}
		$_GET["form"] = "event_orders";
		$_GET["singleview"] = true;
		$_GET["fields_only"] = true;
		include($_SERVER["DOCUMENT_ROOT"]."/admin/forms/records.php");
		if(count($records)==1){
	?>
	<h3 style="text-align: center;">
		Click on the link in the table above to access the Event Order PDF, or
		<a target="_blank" href="./orders/<?=array_values($records)[0]["id"]?>.pdf">click here to view the Event Order.</a>
	</h3>
	<?php }else{ ?>
	<h3 style="text-align: center;">
		Click on the links in the table above to access the Event Order PDFs for the corresponding times.
	</h3>
	<?php } ?>
	</body>
</html>