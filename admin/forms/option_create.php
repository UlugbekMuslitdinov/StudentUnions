<?php
//AJAX interface for creating new options of secondary tables
include("config/forms.php");

//Request validation
if($_SERVER["REQUEST_METHOD"]!="POST"){
	//If user tries to access the page
	header("Location: ./list.php");
	exit();
}
if(empty($_POST["label"])){
	echo(json_encode(Array("error"=>"no_label")));
	exit();
}
ajax_precheck("edit");

//Get correct table
$s_tablename = $field["table"];
if($form["tables"][$s_tablename]["type"] == "option_array"){
	//Redirect to options table
	$s_tablename = $form["tables"][$s_tablename]["option_table"];
}

//Stop if not options table
if($form["tables"][$s_tablename]["type"] != "options"){
	echo(json_encode(Array("error"=>"invalid_field_type")));
	exit();
}

//Add new option to options table
$s_table = $form["tables"][$s_tablename];
$field_key = current(array_keys($s_table["fields"]));
$query  = "INSERT INTO `".$form["database"]."`.`".$s_table["table"]."` ";
$query .= "(`$field_key`) VALUES ";
$query .= "('".$form_conn->escape_string($_POST["label"])."')";
if($form_conn->query($query)){
	//Return index of new option
	echo(json_encode(Array(
		"index" => $form_conn->insert_id,
		"label" => $_POST["label"]
	)));
}else{
	echo(json_encode(Array("error"=>"db_error")));
}
?>