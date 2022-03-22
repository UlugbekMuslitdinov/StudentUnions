<?php
//Less bloated collection of commonly used functions from the admin hub
require_once("deliverance/inc_db_switch.php");
date_default_timezone_set("America/Phoenix");

//Returns true if user has access to this form
//$form is the form config
//$option is nothing for all veda data or the name of a veda option for a boolean of that option
function form_authorized($form, $option=false){
	$veda = Array(
		"view" => false,
		"edit" => false,
		"delete" => false,
		"add" => false
	);
	if($_SESSION["adminUser"]["accessLevel"]>2){ //If user is admin they have access to everything
		foreach($veda as &$opt){
			$opt = true;
		}
		if($option) return true;
		return $veda;
	}
	if(empty($form["veda_groups"])){ //If there is no security config the form is admin-only
		if($option) return false;
		return $veda;
	}
	if(!empty($form["veda_groups"][0])){ //Start with public access level if defined
		$veda = $form["veda_groups"][0];
	}
	foreach($_SESSION["adminUser"]["accessGroups"] as $groupID){
		if(!empty($form["veda_groups"][$groupID])){
			$vedaGroup = $form["veda_groups"][$groupID];
			foreach($veda as $opt=>&$current){ //Options are combined by OR, the user has the permissions of all their groups combined
				$current = $current || $vedaGroup[$opt];
			}
			unset($current);
		}
	}
	if($option) return $veda[$option];
	return $veda;
}

//Returns submitted value or default
function formOr($key, $default=""){
	if(!empty($_POST[$key])) return $_POST[$key];
	if(!empty($_GET[$key])) return $_GET[$key];
	return $default;
}

//Adds a query parameter to any URL
function addParam($url, $key, $value){
	if(strstr($url, "?") !== false){
		if(strpos($url, "&") != strlen($url)-1)
			$url .= "&$key=$value";
		else
			$url = "$key=$value";
	}else{
		$url .= "?$key=$value";
	}
	return $url;
}

//Checks if a user is in an access group
//Returns true if user is in specified group (integer)
//Returns false otherwise, or if the user is not logged in
function user_in_group($group){
	if(empty($_SESSION["adminUser"])) return false;
	return in_array($group, $_SESSION["adminUser"]["accessGroups"]);
}

//Checks if a user is logged in
function user_authenticated(){
	return !empty($_SESSION["adminUser"]);
}

//Gets the user's display name, which is their real name if defined or their netID.
function user_displayname(){
	if(!empty($_SESSION["adminUser"]["userData"]["directoryFN"])){
		return $_SESSION["adminUser"]["userData"]["directoryFN"]." ".$_SESSION["adminUser"]["userData"]["directoryLN"];
	}else{
		return $_SESSION["adminUser"]["netID"];
	}
}

//Logs in a user with webauth and gets their data from the admin database.
//MUST BE CALLED BEFORE ANY OUTPUT IS SENT
function authenticate_user(){
	global $conn;
	if(!$conn) $conn = new db_mysqli("su");
	require_once("webauth/include.php");
	if(empty($_SESSION["adminUser"]) || $_SESSION["webauth"]["netID"] != $_SESSION["adminUser"]["netID"]){
		$_SESSION["adminUser"] = Array();
		$_SESSION["adminUser"]["accessGroups"] = Array(0);
		$_SESSION["adminUser"]["userData"] = Array();
		$query  = "SELECT * FROM su.admin_users ";
		$query .= "WHERE netid='".$conn->escape_string($_SESSION["webauth"]["netID"])."'";
		$result = $conn->query($query);
		if($result && $result->num_rows==1){
			$result = $result->fetch_assoc();
			$staffID = $result["unionstaff_id"];
			$_SESSION["adminUser"]["userID"] = (int)$result["id"];
			$_SESSION["adminUser"]["netID"] = $result["netid"];
			$_SESSION["adminUser"]["accessLevel"] = (int)$result["access_level"];
			$_SESSION["adminUser"]["activeUser"] = ($result["active"]=="1"?true:false);
			$query  = "SELECT admin_screen_id AS access_group FROM su.admin_access ";
			$query .= "WHERE admin_user_id=".$result["id"];
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch_assoc()){
					array_push($_SESSION["adminUser"]["accessGroups"], (int)$row["access_group"]);
				}
			}
			if($staffID != ""){
				$conn->query("USE unionstaffdirectory");
				$query  = "SELECT employee.*, departments.departmentName FROM employee ";
				$query .= "LEFT JOIN departments ON departments.id=employee.departmentID ";
				$query .= "WHERE employee.id=".$staffID;
				$result = $conn->query($query);
				if($result && $result->num_rows==1){
					$_SESSION["adminUser"]["userData"] = $result->fetch_assoc();
				}
			}
		}
	}
}

//Simple yet versatile form validator, validates GET or POST
//$fields is an associative array as ["field_name" => (int)max_length],
//	fields longer than max_length will be truncated unless $value_errors
//	is true. If max_length is "bool" or "number" the values will be cast,
//	if they cannot be cast they will be false or 0 respectively, unless
//	$value_errors is true. If max_length is 0 there are no limits.
//$required is an array of field names which are required (not empty), if
//	it is boolean true then all fields are required.
//$escape will escape values witch mysqli::escape_string if set to a MySQL
//	connection or with htmlspecialchars if (boolean)true. Defaults to false.
//$methods is a flags field:
define("VF_GET", 0b01); //Will check $_GET for the fields
define("VF_POST", 0b10); //Will check $_POST for the fields
//	POST has priority over GET. Defaults to VF_GET | VF_POST.
//$default, if not false, will be used to fill any fields which are not
//	required and not present. Defaults to false.
//$value_errors, if not false, will cause fields longer than the max_length,
//	or fields which couldn't be cast, to cause an error as if they were missing.
//Returns associative array as ["field_name" => field_value] if all required
//	fields are present, otherwise it returns the name of the errant field.
function validateForm(
	$fields,
	$required,
	$escape = false,
	$methods = 0b11,
	$default = false,
	$value_errors = false
) {
	if (!$methods) return Array();
	if (empty($fields)) return Array();
	if (!is_array($fields))
		throw new InvalidArgumentException('validateForm: $fields must be an array.');
	if (!(is_array($required) || $required === true))
		throw new InvalidArgumentException('validateForm: $required must be an array or true.');
	if (!is_int($methods))
		throw new InvalidArgumentException('validateForm: $methods must be an integer.');
	
	$output = Array();
	
	foreach ($fields as $fname => $maxlength) {
		$outfield = "";
		
		//Getting the field raw value
		if (($methods & VF_POST) && !empty($_POST[$fname])) {
			$outfield = $_POST[$fname];
		} else if (($methods & VF_GET) && !empty($_GET[$fname])) {
			$outfield = $_GET[$fname];
		} else if ($required === true || in_array($fname, $required)) {
			return $fname;
		} else if ($default !== false) {
			$outfield = $default;
		} else {
			continue;
		}
		
		//Coercing the raw value to something, checks $escape because there is no
		//	point in changing the type just to go back to a string later.
		if ($escape === false && $maxlength === "bool"){ //Boolean cast
			if (mb_strtolower($outfield) === "false") {
				$outfield = false;
			} else if (mb_strtolower($outfield) === "true") {
				$outfield = true;
			} else { //Cast error case
				if ($value_errors) {
					return $fname;
				} else {
					$outfield = false;
				}
			}
		} else if ($escape === false && $maxlength === "int") { //Number cast
			if (ctype_digit($outfield)) { //Try as int first
				$outfield = intval($outfield);
			} else if (is_numeric($outfield)) {
				$outfield = floatval($outfield);
			} else { //Cast error case
				if ($value_errors) {
					return $fname;
				} else {
					$outfield = 0;
				}
			}
		} else if ($maxlength > 0 && mb_strlen($outfield) > $maxlength) { //Normal string length cap
			if ($value_errors) {
				return $fname;
			} else {
				$outfield = mb_strimwidth($outfield, $maxlength);
			}
		}
		
		//Escaping value
		if ($escape === true) {
			$outfield = htmlspecialchars($outfield);
		} else if ($escape instanceof MySQLi) {
			$outfield = $escape->escape_string($outfield);
		}
		
		$output[$fname] = $outfield;
	}
	
	return $output;
}