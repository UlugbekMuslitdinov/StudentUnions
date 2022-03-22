<?php
//URL redirection target for the orders directory 
//Verifies the user is logged in and has access, then just returns the PDF verbatim.
include($_SERVER["DOCUMENT_ROOT"]."/admin/forms/config/forms.php");
if(form_authorized($form_cfg["event_orders"], "view")){
	if(empty($_GET["id"])){
		header("Location: event_orders.php?err=no_id");
		exit();
	}
	$form_conn = $conn;
	$record = retrieve_form($form_cfg["event_orders"], 1, 0, false, $_GET["id"]);
	if(count($record)!=1){
		header("Location: event_orders.php?err=no_record");
		exit();
	}
	if(!file_exists("./orders/".$_GET["id"])){
		header("Location: event_orders.php?err=no_file");
		exit();
	}
	if(!empty($_GET["fn"] && $_GET["fn"] != $record[$_GET["id"]]["pdf_link"])){
		header("Location: event_orders.php?err=wrong_file");
		exit();
	}
	header("Content-Type: application/pdf");
	echo file_get_contents("./orders/".$_GET["id"]);
}else{
	header("Location: event_orders.php?err=unauthorized");
}
?>