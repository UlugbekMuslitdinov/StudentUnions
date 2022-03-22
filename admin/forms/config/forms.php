<?php
include("administration.inc");
include("forms.db");

//Returns true if configuration data exists for a form
function form_exists($name){
	global $form_cfg;
	if(!empty($form_cfg[$name])){
		return true;
	}else{
		return false;
	}
}

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

//Checks that form and record are specified and valid and user is authorized, and sets globals accordingly
//Also, set up alternate database connection if necessary
//$action is the VEDA action - "view", "edit", "delete", or "add"
//$need_record is whether a particular record needs to be selected
function form_precheck($action, $need_record){
	global $form_cfg, $formName, $form, $table, $vedaAuth, $conn, $form_conn;
	if(empty($_GET["form"])){
		$_SESSION["error_banner"] = "You must select a form.";
		header("Location: ./list.php");
		exit();
	}else{
		$formName = $_GET["form"];
	}
	if(!form_exists($formName)){
		$_SESSION["error_banner"] = 'Form "'.$formName.'" does not exist.';
		header("Location: ./list.php");
		exit();
	}else{
		$form = $form_cfg[$formName];
		$table = $form["tables"][$form["primary_table"]];
	}
	$vedaAuth = form_authorized($form);
	if(!$vedaAuth[$action]){ //Check that user is authorized for this action
		$deniedText = "You are not allowed to ";
		switch($action){
			case "view":
				$deniedText .= "view ";
				break;
			case "edit":
				$deniedText .= "edit records in ";
				break;
			case "delete":
				$deniedText .= "delete records from ";
				break;
			case "add":
				$deniedText .= "add records to ";
				break;
		}
		$_SESSION["error_banner"] = $deniedText.$form["title"].'.';
		if($action=="view"){
			header("Location: ./list.php");
		}else{
			header("Location: ./records.php?form=".$_GET["form"]);
		}
		exit();
	}
	if(!empty($form["alternate_db"])){
		$form_conn = new db_mysqli(
			null,
			$form["alternate_db"]["host"],
			$form["alternate_db"]["user"],
			$form["alternate_db"]["pass"]
			);
	}else{
		$form_conn = $conn;
	}
	if($need_record){ //Get record as well
		global $recordID, $record;
		if(empty($_GET["record"])){
			$_SESSION["error_banner"] = "You must select a record.";
			header("Location: ./records.php?form=".$_GET["form"]);
			exit();
		}else{
			$recordID = $_GET["record"];
		}
		$record = retrieve_form($form, 1, 0, false, $recordID);
		if(count($record)!==1){
			$_SESSION["error_banner"] = 'Record "'.$recordID.'" does not exist.';
			header("Location: ./records.php?form=".$formName);
			exit();
		}else{ //Pull actual record out of array
			$inter = array_keys($record);
			$record = $record[$inter[0]];
			unset($record[$table["pk"]]);
		}
	}
}

//Special precheck for option_create and option_delete
//Checks that form and field are specified and valid and user is authorized, and sets globals accordingly
//Also, set up alternate database connection if necessary
//$action is the VEDA action - "view", "edit", "delete", or "add"
function ajax_precheck($action){
	global $form_cfg, $formName, $form, $table, $field, $vedaAuth, $conn, $form_conn;
	if(empty($_POST["form"]) || empty($_POST["field"])){
		echo(json_encode(Array("error"=>"malformed")));
		exit();
	}else{
		$formName = $_POST["form"];
	}
	if(!form_exists($formName)){
		echo(json_encode(Array("error"=>"invalid_form")));
		exit();
	}else{
		$form = $form_cfg[$formName];
		$table = $form["tables"][$form["primary_table"]];
	}
	if(
	  !empty($table["fields"][$_POST["field"]])
	  && !empty($form["tables"][$table["fields"][$_POST["field"]]["table"]])
	){
		$field = $table["fields"][$_POST["field"]];
	}else{
		echo(json_encode(Array("error"=>"invalid_field")));
	}
	$vedaAuth = form_authorized($form);
	if(!$vedaAuth[$action]){
		echo(json_encode(Array("error"=>"unauthorized")));
		exit();
	}
	if(!empty($form["alternate_db"])){
		$form_conn = new db_mysqli(
			null,
			$form["alternate_db"]["host"],
			$form["alternate_db"]["user"],
			$form["alternate_db"]["pass"]
			);
	}else{
		$form_conn = $conn;
	}
}

//http://stackoverflow.com/q/19261987
//Checks if an email is valid insofar as the domain it references has an MX (email) record
function domain_exists($email, $record = 'MX'){
	list($user, $domain) = explode('@', $email);
	return checkdnsrr($domain, $record);
}

//Check if a value is valid to a certain config
function is_type($value, $cfg){
	$type = $cfg["type"];
	switch($type){
		case "bitfield":
		case "integer":
			$numericValue = (int)($value);
			if($value!=(string)$numericValue){
				return "Field must be an integer.";
			}
			if((isset($cfg["int_max"]) && $value>$cfg["int_max"]) ||
				  (isset($cfg["int_min"]) && $value<$cfg["int_min"])){
				if(!isset($cfg["int_max"])){
					return "Field must be an integer no less than ".$cfg["int_min"].".";
				}else if(!isset($cfg["int_min"])){
					return "Field must be an integer no more than ".$cfg["int_max"].".";
				}else{
					return "Field must be an integer between ".$cfg["int_min"]." and ".$cfg["int_max"].".";
				}
			}
			break;
		case "number":
			if(!ctype_digit($value)){
				return "Field must be numeric.";
			}
			break;
		case "date":
		case "datetime":
		case "date-sometimes":
			try{
				$datetime = new DateTime($value);
			}catch (Exception $ex){
				return "Field must be a valid date or datetime.";
			}
			break;
		case "email":
			if(!(filter_var($value, FILTER_VALIDATE_EMAIL) && domain_exists($value))){
				return "Field must be a valid email address.";
			}
			break;
		case "text":
		case "textopts":
		case "time": //At least until we have a better way to validate
			if(empty($value) && $value != "0"){
				return "Field must not be empty.";
			}
			break;
		case "remote":
			return "Field cannot be changed."; 
			//No value is valid as an input for remote, it can never be changed
			break;
		case "yesno":
			if(!($value == "yes" || $value == "no")){
				return "Field must be &quot;yes&quot; or &quot;no&quot; only.";
			}
			break;
	}
	return true;
}

//Get data from DB based on configuration and format it in desired way.
//$form is the form config
//$records is how many records it will return (all if 0)
//$start is the offset of the above
//$abbrev is either an array of fields to select, a string with the name of a single
//field to select (will return as simple array), true to use the key_fields
//property of the table, or false to select all fields
//$search is either an array of fields and partial values, which is used to only return
//records whose fields contain the specified values, or a string/int, which is used to
//match the primary key. In any other case no filtering will occur.
function retrieve_form($form, $records=10, $start=0, $abbrev=true, $search=false){
	if(empty($form["primary_table"])){ //Simple check to see that we have a valid form config
		return false;
	}else{
		$table = $form["tables"][$form["primary_table"]]; //Get the primary table
	}
	global $form_conn;
	if(!$form_conn->query("USE `".$form["database"]."`")){
		error_log("Could not switch DB");
		return false;
	}
	$pk = $table["pk"]; //Get configured primary key
	$deferred = Array(); //Where the names of deferred fields go
	$one_d = false; //Whether to return a simple array of pk=>field (true) or an array of array rows (false)
	$query = "SELECT ";
	if($abbrev === true){ //Use the predefined list of important fields
		if(isset($table["key_fields"])){
			$abbrev = $table["key_fields"];
		}else{
			$abbrev = array_slice(array_keys($table["fields"]), 0, 5);
		}
	}else if($abbrev === false){ //Use all the fields
		$abbrev = array_keys($table["fields"]);
	}else if(is_string($abbrev)){ //Select a single field
		if(!empty($table["fields"][$abbrev])){ //Make sure field is valid
			$abbrev = Array($abbrev);
			$one_d = true;
		}
	}
	if(!is_array($abbrev)) return false; //Make sure we actually have a list of fields
	if(count($abbrev) < 1) return Array(); //If that list is empty, save some time and return an empty array
	foreach($abbrev as $index=>$field){ //Move secondary fields and other stuff to deferred processing
		if(!empty($table["fields"][$field])){ //Verify fields exist
			if(!empty($table["fields"][$field]["data_source"])){
				if(strpos($table["fields"][$field]["data_source"], "json_unpack") === 0){
					$source = explode(".", $table["fields"][$field]["data_source"])[1];
					if(@$table["fields"][$source]["type"]=="json_unpack"){
						if(!in_array($source, $abbrev))
							array_push($abbrev, $source);
						if(!in_array($source, $deferred))
							array_unshift($deferred, $source);
						array_push($deferred, $field);
					}
					unset($abbrev[$index]);
				}else{
					$abbrev[$index] = $table["fields"][$field]["data_source"]."` AS `".$field;
				}
			}
			if($table["fields"][$field]["type"]=="secondary"){
				array_push($deferred, $field);
				if($form["tables"][$table["fields"][$field]["table"]]["type"] != "options"){
					unset($abbrev[$index]);
				}
			}
		}else{
			unset($abbrev[$index]);
		}
	}
	$fieldcount = count($abbrev);
	if(!in_array($pk, $abbrev)){
		array_push($abbrev, $pk); //Select the primary key if it's not in the list
	}
	$query .= "`".join("`, `", $abbrev)."`";
	$query .= " FROM `".$table["table"]."`";
	if(is_array($search)){ //If we have an array of fields and values to filter by, build that into the query
		$query .= " WHERE (";
		$conditions = Array();
		foreach($search as $field=>$condition){
			array_push($conditions, "`".$field."` LIKE '%".$form_conn->escape_string($condition)."%'");
			//This will make it so the returned rows all have $condition as some part of the value of $field
		}
		$query .= join(" AND ", $conditions); 
		$query .= ")";
	}else if(is_string($search)){ //If we have a single search value, use it to match the primary key
		$query .= " WHERE `".$table["pk"]."`='".$form_conn->escape_string($search)."'";
	}else if(is_int($search)){ //As above but numeric
		$query .= " WHERE `".$table["pk"]."`=".$search;
	}
	if(is_array($table["sort"])){ //Sort the table in by something other than the pk if set up to do so
		$query .= " ORDER BY `".$table["sort"]["field"]."`";
		if($table["sort"]["direction"]=="ascending"){
			$query .= " ASC";
		}else if($table["sort"]["direction"]=="descending"){
			$query .= " DESC";
		}else{
			return false; //config problem
		}
	}
	$query .= " LIMIT $records OFFSET $start"; //Limit and offset, for paging
	$result = $form_conn->query($query);
	$records = Array();
	if($result){ //If the query is successful
		while($row=$result->fetch_assoc()){ //Put all the rows in an array
			if(ctype_digit($row[$pk])){ //If pk is all digits, convert to integer for output array key
				$index = (int)$row[$pk];
			}else{
				$index = $row[$pk];
			}
			if($one_d){ //If we only are getting one field, store it as a simple associative array
				$records[$index] = $row[$abbrev[0]];
			}else{
				$records[$index] = $row;
			}
		}
	}else{
		return false;
	}
	$unpacked_json = Array(); //Place where the JSON goes
	foreach($deferred as $s_fieldname){
		$s_field = $table["fields"][$s_fieldname];
		if($s_field["type"]=="secondary"){ //Secondary tables
			if(!empty($s_field["data_source"])){ //Allow alternate data source
				$s_fieldname_real = $s_field["data_source"];
			}else{
				$s_fieldname_real = $s_fieldname;
			}
			if(!empty($form["tables"][$s_field["table"]])){
				$s_table = $form["tables"][$s_field["table"]];
				switch($s_table["type"]){
					case "reference":
						$p_rk = $s_fieldname_real; //Key in primary table referencing ID of secondary record
						$p_dbtable = $table["table"]; //SQL table name of primary table
						$p_db = $form["database"]; //Database of primary table
						if(empty($GLOBALS["form_cfg"][$s_table["form"]])) return false;
						$s_form = $GLOBALS["form_cfg"][$s_table["form"]]; //Referenced form
						$s_dbtable = $s_form["tables"][$s_form["primary_table"]]["table"]; //SQL table name of secondary table
						$s_db = $s_form["database"]; //Database of secondary table
						$s_rfield = $s_table["label_field"]; //Name of column with label info
						$s_pk = $s_table["pk"];
						$query  = "SELECT `$p_db`.`$p_dbtable`.`$pk` AS p_pk, "; //Select pk of primary table and relevant secondary data
						$query .= "`$s_db`.`$s_dbtable`.`$s_pk` AS s_pk, ";
						$query .= "`$s_db`.`$s_dbtable`.`$s_rfield` AS label\n";
						$query .= "FROM `$p_db`.`$p_dbtable`\n"; //Start at primary table
						$query .= "INNER JOIN `$s_db`.`$s_dbtable`\n"; //Connect with records in secondary table
						$query .= "ON `$s_db`.`$s_dbtable`.`$s_pk` = `$p_db`.`$p_dbtable`.`$p_rk`\n";
						$query .= "WHERE `$p_db`.`$p_dbtable`.`$pk` IN ('".join("', '", array_keys($records))."')\n"; //Limit to only records we already have
						$result = $form_conn->query($query);
						if(!$result) return false;
						foreach($records as &$record){ //Initialize field as an array in each row of the output data
							$record[$s_fieldname] = Array( //Default value if there isn't a match
								"s_id" => 0,
								"label" => "Invalid link"
							);
						}
						unset($record);
						while($row = $result->fetch_assoc()){
							$records[$row["p_pk"]][$s_fieldname]["s_id"] = $row["s_pk"]; //Put single option datum in record field array
							$records[$row["p_pk"]][$s_fieldname]["label"] = $row["label"]; //Put single option datum in record field array
						}
						break;
					case "option_array":
						$o_table = $form["tables"][$s_table["option_table"]]; //Get option table
						//Set up variables to use in query
						$s_pk = $s_table["pk"]; //Option array table primary key
						$o_pk = $o_table["pk"]; //Option table primary key
						$p_dbtable = $table["table"]; //SQL table name of primary table
						$s_dbtable = $s_table["table"]; //SQL table name of option_array table
						$o_dbtable = $o_table["table"]; //SQL table name of option table
						$s_rk = $s_field["relation_key"]; //Key in option_array table referencing primary key of primary table
						$s_ok = $s_table["option_key"]; //Key in option_array table referencing primary key of option table
						$o_fields = ""; //Inter variable for field select list
						foreach($o_table["fields"] as $o_field=>$meta){ //Build list of fields to select from option table
							$o_fields .= ", `$o_dbtable`.`$o_field`";
						}
						$query  = "SELECT `$p_dbtable`.`$pk`$o_fields\n"; //Select pk of primary table and relevant option data
						$query .= "FROM `$p_dbtable`\n"; //Start at primary table
						$query .= "INNER JOIN `$s_dbtable`\n"; //Connect with records in option_array table
						$query .= "ON `$s_dbtable`.`$s_rk` = `$p_dbtable`.`$pk`\n";
						$query .= "INNER JOIN `$o_dbtable`\n"; //Connect with options in option table
						$query .= "ON `$o_dbtable`.`$o_pk` = `$s_dbtable`.`$s_ok`\n";
						$query .= "WHERE `$p_dbtable`.`$pk` IN ('".join("', '", array_keys($records))."')\n"; //Limit to only records we already have
						$query .= "ORDER BY `$o_dbtable`.`$o_pk`";
						$result = $form_conn->query($query); //Final result is mapping of primary table record to all options selected for that record
						if(!$result) return false;
						foreach($records as &$record){ //Initialize field as an array in each row of the output data
							$record[$s_fieldname] = Array();
						}
						unset($record);
						if(count($o_table["fields"])>1){ //Determine if we can return as a simple associative array or not
							while($row = $result->fetch_assoc()){
								array_push($records[$row[$pk]][$s_fieldname], $row); //Put array of all option data in record field array
							}
						}else{
							$o_fieldnames = array_keys($o_table["fields"]);
							$o_field = $o_fieldnames[0];
							while($row = $result->fetch_assoc()){
								array_push($records[$row[$pk]][$s_fieldname], $row[$o_field]); //Put single option datum in record field array
							}
						}
						break;
					case "options":
						$options = retrieve_options($form, $s_field["table"], true);
						foreach($records as &$record){
							if(isset($options[$record[$s_fieldname]])){
								$record[$s_fieldname] = $options[$record[$s_fieldname]];
							}else{
								$record[$s_fieldname] = Array();
							}
						}
						unset($record);
						break;
					default:
						return false; //Anything else
						break;
				}
			}else{ //Config error
				return false;
			}
		}else if($s_field["type"]=="json_unpack"){ //Unpack JSON from DB
			foreach($records as $index=>$record){
				$unpacked_json[$index] = Array();
				$json = $record[$s_fieldname];
				$unpacked_json[$index][$s_fieldname] = json_decode($record[$s_fieldname], true);
			}
		}else if(strpos($s_field["data_source"], "json_unpack") === 0){ //Access unpacked JSON
			foreach($records as $index=>&$record){
				$keys = array_slice(explode('.', $s_field["data_source"]), 1);
				$array = $unpacked_json[$index];
				foreach($keys as $key){
					if(!is_array($array) || !isset($array[$key])){
						$array = "";
						break;
					}
					$array = $array[$key];
				}
				$record[$s_fieldname] = $array;
			}
			unset($record);
		}else{
			error_log("Application error in secondary processing loop: no conditions met");
			return false;
		}
	}
	return $records;
}

//Get the total number of records in a form
//Search filters the results as with retrieve_form
function form_total_records($form, $search=false){
	if(empty($form["primary_table"])){ //Simple check to see that we have a valid form config
		return false;
	}else{
		$table = $form["tables"][$form["primary_table"]]; //Get the primary table
	}
	global $form_conn;
	$query = "SELECT COUNT(*)";
	$query .= " FROM `".$form["database"]."`.`".$table["table"]."`";
	if(is_array($search)){ //If we have an array of fields and values to filter by, build that into the query
		$query .= " WHERE (";
		$conditions = Array();
		foreach($search as $field=>$condition){
			array_push($conditions, "`".$field."` LIKE '%".$form_conn->escape_string($condition)."%'");
			//This will make it so the returned rows all have $condition as some part of the value of $field
		}
		$query .= join(" AND ", $conditions); 
		$query .= ")";
	}else if(is_string($search)){ //If we have a single search value, use it to match the primary key
		$query .= " WHERE `".$table["pk"]."`='".$form_conn->escape_string($search)."'";
	}else if(is_int($search)){ //As above but numeric
		$query .= " WHERE `".$table["pk"]."`=".$search;
	}
	$result = $form_conn->query($query);
	if($result){
		$inter = $result->fetch_assoc();
		return (int)$inter["COUNT(*)"];
	}else{
		return false;
	}
}

//Get option data for secondary tables.
//$form is the form config
//$table is the name of the table as defined in the form configuration
//$always_array as true will return array indexed by pks of arrays with all row data
//Returns array of options
//Each option is a string/number if it's a single column, or an array otherwise
function retrieve_options($form, $table, $always_array=false){
	if(empty($form["tables"][$table])){ //Check that table exists
		return false;
	}
	if($form["tables"][$table]["type"]=="option_array"){ //If option array table is selected, redirect to option table
		$table = $form["tables"][$table]["option_table"];
	}
	if($form["tables"][$table]["type"]!="options"){ //If the table isn't an option table, exit
		return false;
	}
	global $form_conn;
	$table = $form["tables"][$table];
	$query = "SELECT `";
	if(!in_array($table["pk"], array_keys($table["fields"]))){
		$query .= $table["pk"]; //Select the primary key if it's not in the list
	}
	$count = 0; //Number of fields, used later
	foreach($table["fields"] as $column=>$meta){ //Select all the fields defined in the config
		$query .= "`, `".$column;
		$count++;
	}
	$query .= "` FROM `".$form["database"]."`.`".$table["table"]."`";
	$result = $form_conn->query($query);
	$options = Array();
	if($result){
		if($always_array || $count > 1){ //Return 2D associative array with pk as key and row data (incl. pk) as value
			while($row=$result->fetch_assoc()){
				if(ctype_digit($row[$table["pk"]])){
					$index = (int)$row[$table["pk"]];
				}else{
					$index = $row[$table["pk"]];
				}
				$options[$index] = $row;
			}
		}else if($count < 1){ //Return array of primary keys
			while($row=$result->fetch_assoc()){
				array_push($options, $row[$table["pk"]]);
			}
		}else{ //$count == 1: Return simple associative array with pk as key and field value as value
			$inter = array_keys($table["fields"]);
			$column = $inter[0];
			while($row=$result->fetch_assoc()){
				if(ctype_digit($row[$table["pk"]])){
					$index = (int)$row[$table["pk"]];
				}else{
					$index = $row[$table["pk"]];
				}
				$options[$index] = $row[$column];
			}
		}
		return $options;
	}else{
		return false;
	}
}

//Deletes one or more records by primary key.
//$form is the form config
//$keys is either a single primary key, or an array of them
//$table is the name of a table, if unset, it will be the primary table
//This function will delete records in the primary or specified table,
//as well as any associated records (such as in option-array tables).
//Currently this only goes one layer deep!
function delete_records($form, $keys, $table=""){
	if(empty($form["primary_table"])){ //Simple check to see that we have a valid form config
		return false;
	}
	global $form_conn;
	if(empty($keys)){ //Exit if there is nothing to delete
		return true;
	}
	if(!is_array($keys)) $keys = Array($keys); //Make keys into array
	if(empty($table)){ //Use primary table if not specified
		$table = $form["primary_table"];
	}
	if(empty($form["tables"][$table])){ //Check that table exists
		return false;
	}
	$table = $form["tables"][$table]; //Get main table
	$tables = Array($table["table"]=>$table["pk"]); //Array of sql tables and pk's to delete from
	$files_deferred = Array(); //Array of files to delete if the database goes well
	if(!empty($table["fields"])){
		foreach($table["fields"] as $fieldname=>$field){ //Find other tables to delete from
			if($field["type"]=="secondary" && $form["tables"][$field["table"]]["type"]=="option_array"){
				$table_sql = $form["tables"][$field["table"]]["table"];
				$table_pk = $field["relation_key"];
				$tables[$table_sql]=$table_pk; //Add name of secondary table
			}else if($field["type"]=="file"){
				foreach($keys as $pkey){
					$filename = retrieve_form($form, 1, 0, false, $pkey);
					array_push($files_deferred, get_file_path($table, $fieldname, $filename[$pkey], true));
				}
			}
		}
	}
	foreach($tables as $table_sql=>$table_pk){ //Delete records from all selected tables
		$query  = "DELETE FROM `".$form["database"]."`.`".$table_sql."` "; //Begin delete
		$query .= "WHERE `".$table_pk."` IN ('"; //Clause to only delete desired records
		$query .= join("', '", $keys); //Add list of desired IDs to delete
		$query .= "');";
		if(!$form_conn->query($query)) return false; //Run the query, error out on failure
	}
	foreach($files_deferred as $filepath){ //Delete all the files from the records
		$realpath = realpath($filepath);
		if(is_writeable($realpath)){ //Make sure it is valid
			unlink($realpath);
		}else{
			return false; //Error out if it isn't
		}
	}
	return true; //If we haven't errored out yet, it was a success
}

//Checks if data is valid for a secondary table
//$form is the form config
//$table is the name of the table as defined in the form configuration
//$data is the data
function validate_secondary($form, $table, $data){
	if(empty($form["tables"][$table])){ //Check that table exists
		return false;
	}
	if($form["tables"][$table]["type"]=="simple"){ //If the table is a simple table, exit
		return false;
	}
	global $form_conn;
	$table = $form["tables"][$table];
	switch($table["type"]){
		case "options": //Check that option exists
			if(is_array($data)) return false;
			$db_name = $form["database"];
			$db_table = $table["table"];
			$query  = "SELECT * FROM `$db_name`.`$db_table`";
			$query .= " WHERE `".$table["pk"]."`='".$form_conn->escape_string($data)."'";
			$result = $form_conn->query($query);
			if($result && $result->num_rows==1){
				return true;
			}
			break;
		case "reference": //Check that referenced record exists
			if(is_array($data)) return false;
			global $form_cfg;
			if(empty($form_cfg[$table["form"]])) return false;
			$s_form = $form_cfg[$table["form"]];
			$db_name = $s_form["database"];
			$db_table = $s_form["tables"][$s_form["primary_table"]]["table"];
			$query  = "SELECT * FROM `$db_name`.`$db_table`";
			$query .= " WHERE `".$table["pk"]."`='".$form_conn->escape_string($data)."'";
			$result = $form_conn->query($query);
			if($result && $result->num_rows==1){
				return true;
			}
			break;
		case "option_array": //Check that all options exist
			if(!is_array($data)) return false;
			if(count($data)==0) return true;
			$db_name = $form["database"];
			$o_table = $form["tables"][$table["option_table"]];
			$db_table = $o_table["table"];
			$query  = "SELECT * FROM `$db_name`.`$db_table`";
			$query .= " WHERE `".$o_table["pk"]."` IN (";
			$first = true;
			foreach($data as $datum){
				if($first){ //join() is for squares
					$first = false;
				}else{
					$query .= ", ";
				}
				$query .= "'".$form_conn->escape_string($datum)."'";
			}
			$query .= ")";
			$result = $form_conn->query($query);
			if($result && $result->num_rows==count($data)){
				return true;
			}
			break;
	}
	return false;
}

//Updates the data contained in a record, including secondary tables.
//$form is the form config
//$id is the record ID
//$data is an array with fields as keys and new values as values
//Data should be passed in the same way it is passed out by retrieve_form
//except for secondary table "options" which should just be the option id
//and secondary table "reference" which should just be the referenced id
function update_record($form, $id, $data){
	if(empty($form["primary_table"])){ //Simple check to see that we have a valid form config
		return false;
	}else{
		$table = $form["tables"][$form["primary_table"]]; //Get the primary table
	}
	global $form_conn;
	$secondary = Array();
	$fields = Array();
	foreach($data as $fieldname=>$value){
		if(!empty($table["fields"][$fieldname])){
			$field = $table["fields"][$fieldname];
			$required = isset($field["required"]) && $field["required"] === true;
			$locked = isset($field["locked"]) && $field["locked"] === true;
			if(!$locked){
				if($field["type"]=="secondary"){
					if(!empty($form["tables"][$field["table"]]) && !$locked){
						$s_table = $form["tables"][$field["table"]];
						if(($value===null || empty($value)) && !$required){
							switch($s_table["type"]){
								case "options":
								case "reference":
									array_push($fields, "`".$fieldname."`=null");
									break;
								case "option_array":
									$secondary[$fieldname]=Array();
							}
						}else if(validate_secondary($form, $field["table"], $value) === true){
							switch($s_table["type"]){
								case "options":
								case "reference":
									array_push($fields, "`".$fieldname."`='".$form_conn->escape_string($value)."'");
									break;
								default:
									$secondary[$fieldname]=$value;
									break;
							}
						}else if($required){
							return false;
						}
					}
				}else{
					if($value===null && !$required){
						array_push($fields, "`".$fieldname."`=null");
					}else if(is_type($value, $field) === true){
						if($field["type"]=="bitfield"){
							array_push($fields, "`".$fieldname."`=".$form_conn->escape_string($value));
						}else{
							array_push($fields, "`".$fieldname."`='".$form_conn->escape_string($value)."'");
						}
					}else if($required){
						return false;
					}
				}
			}
		}
	}
	if(count($fields)>0){ //If we have any non-secondary fields
		$query  = "UPDATE `".$form["database"]."`.`".$table["table"]."` SET ";
		$query .= join(", ", $fields);
		$query .= " WHERE `".$table["pk"]."`='$id' LIMIT 1";
		if(!$form_conn->query($query)) return false;
	}
	foreach($secondary as $fieldname=>$value){
		$field = $table["fields"][$fieldname];
		$required = isset($field["required"]) && $field["required"] === true;
		$s_table = $form["tables"][$field["table"]];
		if($s_table["type"]=="option_array"){
			if($value === null) $value = Array();
			if(!is_array($value)) return false;
			if($required && count($value)<1) return false;
			$rk = $field["relation_key"];
			$s_pk = $s_table["pk"];
			$s_ok = $s_table["option_key"];
			$query  = "SELECT `$s_pk`, `$s_ok` "; //Start by getting current value
			$query .= "FROM `".$form["database"]."`.`".$s_table["table"]."` ";
			$query .= "WHERE `$rk`='$id'";
			$result = $form_conn->query($query);
			if(!$result) return false;
			$selected_options = Array();
			while($row = $result->fetch_assoc()){
				$selected_options[$row[$s_pk]] = $row[$s_ok];
			}
			$options = retrieve_options($form, $field["table"]);
			$delete_options = Array();
			foreach($selected_options as $s_id=>$optnum){
				if(!in_array($optnum, $value)){
					array_push($delete_options, $s_id);
					unset($selected_options[$s_id]);
				}
			}
			if(count($delete_options)){ //Delete options no longer selected
				delete_records($form, $delete_options, $field["table"]);
			}
			$add_options = Array();
			foreach($value as $optnum){
				if(!in_array($optnum, $selected_options) && !empty($options[$optnum])){
					array_push($add_options, "('$id', '".$optnum."')");
				}
			}
			if(count($add_options)){ //Add options not previously selected
				$query  = "INSERT INTO `".$form["database"]."`.`".$s_table["table"]."` ";
				$query .= "(`$rk`, `$s_ok`) VALUES ";
				$query .= join(", ", $add_options);
				if(!$form_conn->query($query)) return false;
			}
		}
	}
	return true;
}

//Inserts a record into a form's entries
//$form is the form config
//$data is an array with fields as keys and new values as values
//$data should be the same format as for update_record
//If the PK is in $data it will be used
function insert_record($form, $data){
	if(empty($form["primary_table"])){ //Simple check to see that we have a valid form config
		return false;
	}else{
		$table = $form["tables"][$form["primary_table"]]; //Get the primary table
	}
	global $form_conn;
	$secondary = Array();
	$values = Array();
	if(isset($data[$table["pk"]]) && $data[$table["pk"]]!==0){
		$values[$table["pk"]] = $form_conn->escape_string($data[$table["pk"]]);
	}
	foreach($table["fields"] as $fieldname=>$field){
		if(!isset($data[$fieldname])){
			if(!empty($field["required"])){
				return false; //error out if required field is empty
			}
		}else if($field["type"]=="secondary"){
			$s_table = $form["tables"][$field["table"]];
			if(validate_secondary($form, $field["table"], $data[$fieldname]) == true){
				switch($s_table["type"]){
					case "options":
					case "reference": //These could be required so we'll process them now
						$values[$fieldname]=$form_conn->escape_string($data[$fieldname]);
						break;
					default: //Will send these to update_record later
						$secondary[$fieldname] = $data[$fieldname];
						break;
				}
			}
		}else{
			if(is_type($data[$fieldname], $field) === true){
				if($field["type"]=="bitfield"){
					$values[$fieldname] = $form_conn->escape_string($data[$fieldname]);
				}else{
					$values[$fieldname] = "'".$form_conn->escape_string($data[$fieldname])."'";
				}
			}else{
				return false; //error out if types don't match up
			}
		}
	}
	if(count($values)<1) return false; //exit if there's nothing to do
	$query  = "INSERT INTO `".$form["database"]."`.`".$table["table"]."` ";
	$query .= "(`".join("`, `", array_keys($values))."`) VALUES ";
	$query .= "(".join(", ", $values).")";
	if($form_conn->query($query)){
		$newID = $form_conn->insert_id;
		update_record($form, $newID, $secondary);
		return $newID;
	}else{
		return false;
	}
}

//Generates a local or web file path based on the field configuration and data
//$form is the table configuration
//$field is the field name
//$record is the record to make the path from
//$local is a boolean, if true, the path will be local, otherwise, it will be for the web
function get_file_path($table, $fieldname, $record, $local=false){
	$val_pk = $record[$table["pk"]];
	$val_fn = $record[$fieldname];
	$field = $table["fields"][$fieldname];
	if(!$local && empty($field["webpath"])) return "";
	$filepath = $local ? $field["target_file"] : $field["webpath"];
	$filepath = str_replace("%ID%", $val_pk, $filepath);
	$filepath = str_replace("%FN%", $val_fn, $filepath);
	if($local) $filepath = $field["target_dir"] . $filepath;
	return $filepath;
}

//Similar to start function of any other template, but it *just* puts the bare minimum
function frameview_start(){
	global $page_options, $DBlink;
	$page_options['ssheets'][] = '/admin/style/admin.css';
?>
<html class="admin-framed">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
		<title><?php print $page_options['title']; ?></title>
		
		<?=$page_options['head']?>
		
		
		<link rel="StyleSheet" href="/template/global.css" type="text/css" media="screen" />
		<?php
			if(isset($page_options['ssheets'])){
				foreach($page_options['ssheets'] as $style_sheet){
		?>
		<link rel="StyleSheet" href="<?php print $style_sheet ?>" type="text/css" media="screen" />
		<?php
				}
			}
		?>
		
		<?php
			if(isset($page_options['script_incs'])){
				foreach($page_options['script_incs'] as $script){
		?>
		<script type="text/javascript" src="<?php print $script ?>"></script>
		<?php
				}
			}
		?>
	</head>
	<body>
<?php
}

//Similar to end function of any other template, but it *just* puts the bare minimum
function frameview_finish(){
?>
	</body>
</html>
<?php
}

?>