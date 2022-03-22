<?php
//AJAX interface for deleting options of secondary tables
include("config/forms.php");

//Request Validation
if($_SERVER["REQUEST_METHOD"]!="POST"){
	//If user tries to access the page
	header("Location: ./list.php");
	exit();
}
if(empty($_POST["index"])){
	echo(json_encode(Array("error"=>"no_index")));
	exit();
}
ajax_precheck("delete");

//Get table and type
$s_tablename = $field["table"];
$s_table = $form["tables"][$s_tablename];
$s_pk = $s_table["pk"];
if($s_table["type"] == "option_array"){ //Option Array case
	$o_tablename = $s_table["option_table"];
	$o_table = $form["tables"][$o_tablename];
	$s_ok = $s_table["option_key"];
	$o_pk = $o_table["pk"];
	//Delete all option-array entries binding this option to a record
	$query  = "DELETE FROM `".$form["database"]."`.`".$s_table["table"]."` ";
	$query .= "WHERE `$s_ok`='".$form_conn->escape_string($_POST["index"])."'";
	if(!$form_conn->query($query)){
		echo(json_encode(Array("error"=>"db_error")));
		exit();
	}
	//Delete the option itself
	$query  = "DELETE FROM `".$form["database"]."`.`".$o_table["table"]."` ";
	$query .= "WHERE `$o_pk`='".$form_conn->escape_string($_POST["index"])."'";
	if(!$form_conn->query($query)){
		echo(json_encode(Array("error"=>"db_error")));
		exit();
	}
	echo(json_encode(Array(
		//Returning same index indicates success
		"index" => $_POST["index"]
	)));
}else if($s_table["type"] == "options"){ //Simple option case
	$replacement = "null";
	if(!empty($field["required"])) $replacement = "-1"; //If the field can't be null, make it clearly invalid
	//Update all records referring to this options to have no option set
	$query  = "UPDATE `".$form["database"]."`.`".$table["table"]."` ";
	$query .= "SET `".$form_conn->escape_string($_POST["field"])."`=$replacement ";
	$query .= "WHERE `".$form_conn->escape_string($_POST["field"])."`='".$form_conn->escape_string($_POST["index"])."'";
	if(!$form_conn->query($query)){
		echo(json_encode(Array("error"=>"db_error")));
		exit();
	}
	//Delete the option itself
	$query  = "DELETE FROM `".$form["database"]."`.`".$s_table["table"]."` ";
	$query .= "WHERE `$s_pk`='".$form_conn->escape_string($_POST["index"])."'";
	if(!$form_conn->query($query)){
		echo(json_encode(Array("error"=>"db_error")));
		exit();
	}
	echo(json_encode(Array(
		//Returning same index indicates success
		"index" => $_POST["index"]
	)));
}else{
	echo(json_encode(Array("error"=>"invalid_field_type")));
}
?>