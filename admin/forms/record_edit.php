<?php
require_once("config/forms.php");

if(!isset($newRecord)) $newRecord = false;

if(!$newRecord){ //Skip normal checks if being called by record_add
	form_precheck("edit", true);
	$disallowed = false;
	if(!empty($form["disallow_matched_user"])){ //Check if user is blocked from editing their own record
		if($record[$form["disallow_matched_user"]] == $_SESSION["adminUser"]["netID"]){
			if(empty($form["disallowed_fields"])){ //If which fields are blocked are not specified, all of them are
				$_SESSION["error_banner"] = 'You cannot modify a record about yourself.';
				if(isset($_GET["vea_validate_only"])){
					$vea_validate_success = false;
					return;
				}else{
					header("Location: ./record_view.php?form=$formName&record=$recordID");
					exit();
				}
			}else{
				$disallowed = true;
			}
		}
	}
}else{
	form_precheck("add", false);
	$record = Array();
	//$record[$table["pk"]] = 0; //Less than 1 is auto increment here
	foreach($table["fields"] as $fieldname=>$field){
		if(isset($_POST[$fieldname])){
			$record[$fieldname] = $_POST[$fieldname];
			if(is_array($record[$fieldname])){ //convert submitted type of option array to outputted
				if($form["tables"][$field["table"]]["type"]=="option_array"){	//R E F A
					$array_options = retrieve_options($form, $field["table"]);	//C T O R
					foreach($record[$fieldname] as &$array_option){				//T H I S
						$array_option = $array_options[$array_option];
					}
					unset($array_option);
				}
			}
		}else{
			$blankValue = null;
			if($field["type"] == "secondary"){
				$type = "s_".$form["tables"][$field["table"]]["type"];
				$blankValue = Array();
			}else{
				$type = $field["type"];
				$blankValue = "";
			}
			$record[$fieldname] = $blankValue;
		}
	}
	/*
	$table["fields"][$table["pk"]] = Array( //Basically every pk is int > 0
		"title"=>"ID",
		"type"=>"integer",
		"int_min"=>0,
		"pk_check"=>true
	);
	*/
}

$save_errors = Array();
if($_SERVER["REQUEST_METHOD"]=="POST"){ //Save edited values, generate errors for invalid data
	$save = Array();
	$postMoveFiles = Array();
	foreach($table["fields"] as $fieldname=>$field){
		if($field["type"]=="bitfield" && is_array($_POST[$fieldname])){
			$inter = 0;
			foreach($_POST[$fieldname] as $bit_en){
				$inter |= pow(2, intval($bit_en));
			}
			$_POST[$fieldname] = $inter;
		}
		if($field["type"]=="file"){
			if(!is_array($_FILES[$fieldname]["size"])){
				if($_FILES[$fieldname]["size"] > 0 && !empty($field["required"])){
					if(empty($_FILES[$fieldname]["type"]) || empty($field["match_type"]) || $_FILES[$fieldname]["type"] == $field["match_type"]){
						$_POST[$fieldname] = $_FILES[$fieldname]["name"];
						$postMoveFiles[$fieldname] = $_FILES[$fieldname]["tmp_name"];
					}else{
						$save_errors[$fieldname] = "File must be of type &quot;".$field["match_type"]."&quot;.";
						continue;
					}
				}else if(!empty($record[$fieldname])){
					$_POST[$fieldname] = $record[$fieldname];
				}else{
					$save_errors[$fieldname] = "You must select a file.";
					continue;
				}
			}else{
				$save_errors[$fieldname] = "Multiple files are not allowed.";
				continue;
			}
		}
		if(!($disallowed && in_array($fieldname, $form["disallowed_fields"]))){ //Ignore disallowed fields
			if(!empty($_POST[$fieldname]) || (isset($_POST[$fieldname]) && $_POST[$fieldname]=="0")){ //Check that it's not empty, except 0.
				$valid_value = is_type($_POST[$fieldname], $field); //Check that it's the right type
				if($valid_value === true){
					/*
					if(empty($field["pk_check"])){
						$save[$fieldname] = $_POST[$fieldname];
					}else{ //Make sure PK isn't already used
						if($_POST[$fieldname]!="0"){ //If it isn't autoincrement
							$query  = "SELECT COUNT(*) FROM `".$form["database"]."`.`".$table["table"]."` ";
							$query .= "WHERE `".$table["pk"]."`='".$form_conn->escape_string($_POST[$fieldname])."'";
							$result = $form_conn->query($query);
							if($result && $result->num_rows==0){
								$save[$fieldname] = $_POST[$fieldname];
							}else{
								$save_errors[$fieldname] = "ID ".$_POST[$fieldname]." is already in use.";
							}
						}
					}
					*/
					$save[$fieldname] = $_POST[$fieldname];
				}else{
					$save_errors[$fieldname] = $valid_value;
				}
			}else if(empty($field["required"]) || $field["required"]!==true){ //If it's not required set it to null
				$save[$fieldname] = null;
			}else{ //Send error if it is
				$save_errors[$fieldname] = "Field is required.";
			}
		}else{
			if(isset($_POST[$fieldname]) && $_POST[$fieldname] != $record[$fieldname]){ //Inform the user they can't do that
				$save_errors[$fieldname] = "This field cannot be edited in a record about yourself.";
			}
		}
	}
	if($newRecord){
		if(!empty($form["disallow_matched_user"])){
			$user_match_field = $form["disallow_matched_user"];
			if($save[$user_match_field] == $_SESSION["adminUser"]["netID"]){
				$save_errors[$user_match_field] = "You cannot create a record about yourself.";
			}
		}
		if(!empty($save_errors)){
			$_SESSION["error_banner"] = "You must resolve all errors before the new record can be saved.";
		}else{
			$new_id = insert_record($form, $save);
			if($new_id !== false){
				$save[$table["pk"]] = $new_id;
				foreach($postMoveFiles as $fieldname=>$filename){ //Move uploaded files
					$field = $table["fields"][$fieldname];
					rename($filename, get_file_path($table, $fieldname, $save, true));
				}
				if(isset($_GET["vea_validate_only"])){
					$vea_validate_success = true;
					return;
				}else{
					header("Location: ./record_view.php?form=$formName&record=$new_id");
					exit();
				}
			}else{
				$_SESSION["error_banner"] = "Server error.";
			}
		}
	}else{
		update_record($form, $recordID, $save);
		if($disallowed){ //Reload user data if user has edited a record about themselves
			load_user();
		}
		$save[$table["pk"]] = $recordID;
		foreach($postMoveFiles as $fieldname=>$filename){ //Move uploaded files
			$field = $table["fields"][$fieldname];
			rename($filename, get_file_path($table, $fieldname, $save, true));
		}
		//Re-retrieve record - this can be optimized
		if(count($save_errors)==0){
			if(isset($_GET["vea_validate_only"])){
				$vea_validate_success = true;
				return;
			}else{
				header("Location: ./record_view.php?form=$formName&record=$recordID");
				exit();
			}
		}else{
			$record = retrieve_form($form, 1, 0, false, $recordID);
			$inter = array_keys($record);
			$record = $record[$inter[0]];
			unset($record[$table["pk"]]);
		}
	}
}

if(isset($_GET["vea_validate_only"])) return;

$nav_path = Array(
	"Admin Home" => "index.php",
	"Forms" => "forms/list.php",
	$form["title"] => "forms/records.php?form=$formName"
);
$page_options['ssheets'][] = "/template/xdpicker/jquery.periodpicker.min.css";
$page_options['ssheets'][] = "/template/xdpicker/jquery.timepicker.min.css";
$page_options['script_incs'][] = "/template/xdpicker/jquery.min.js";
$page_options['script_incs'][] = "/template/xdpicker/jquery.periodpicker.full.min.js";
$page_options['script_incs'][] = "/template/xdpicker/jquery.timepicker.min.js";
$page_options['script_incs'][] = '/admin/js/optarray.js';
$page_options['script_incs'][] = '/admin/js/addpickers.js';
$page_options['script_incs'][] = '/admin/js/errortabs.js';
if($newRecord){
	$page_options['title'] = $form["title"].' | Add New Record';
}else{
	$page_options['title'] = $form["title"].' | Edit Record #'.$recordID;
}
admin_start($page_options);
?>
<div id="center-col">
	<?php if($newRecord){ ?>
	<h2 class="formtitle"><?=$form["title"]?> - Add New Record</h2>
	<?php }else{ ?>
	<h2 class="formtitle"><?=$form["title"]?> - Edit Record #<?=$recordID?></h2>
	<?php } ?>
	<form id="form-edit" enctype="multipart/form-data" method="POST">
		<table class="formtable recordtable"><tbody>
			<tr>
				<th>Field</th>
				<th>Value</th>
<?php
foreach($record as $fieldname=>$field){ //TODO: Get the secondary fields to be in the order they appear in forms.db (maybe an adjustment in forms.php)
	echo "</tr><tr>";
	$locked = '';
	$editclass = '';
	$errormsg .= '';
	if( (isset($table["fields"][$fieldname]["locked"]) && $table["fields"][$fieldname]["locked"]===true) ||
		  ($disallowed && in_array($fieldname, $form["disallowed_fields"])) ){
		$locked = 'readonly ';
		$editclass .= " fake-disabled";
	}
	//"Switch" of whether to highlight the fields
	//if(!empty($field)){
	//if(true){
	if(false){
		$editclass .= ' tbl-edit-set';
	}
	if(!empty($save_errors[$fieldname])){
		$editclass .= ' tbl-edit-error';
		$errormsg = ' data-error="'.$save_errors[$fieldname].'"';
	}
	if(is_array($field)){ //Field with secondary data
		$tablename_2nd = $table["fields"][$fieldname]["table"];
		if(empty($form["tables"][$tablename_2nd])) break;
		$table_2nd = $form["tables"][$table["fields"][$fieldname]["table"]];
		echo "<td class=\"tbl-key tbl-array-key\">".$table["fields"][$fieldname]["title"]."</td>";
		switch($table_2nd["type"]){
			case "option_array":
				$array_options = retrieve_options($form, $tablename_2nd);
				$array_options_inverse = array_flip($array_options);
				$num_options = count($array_options);
				if(count(current($array_options))==1){ //Simple multi-select if there is only one column in the options
					echo '<td class="tbl-optarray'.$editclass.'"'.$errormsg.' style="position:relative;">';
					echo '<input class="tbl-option-create" type="text" />';
					$options = retrieve_options($form, $tablename_2nd, true);
					$separator = ", ";
					if(isset($table_2nd["separator"])){
						$separator = $table_2nd["separator"];
					}
					echo '<select class="tbl-option-select">';
					echo '<option></option>';
					foreach($options as $option){
						echo "<option value=\"".$option[$table_2nd["pk"]]."\">";
						unset($option[$table_2nd["pk"]]);
						echo join($separator, $option);
						echo "</option>";
					}
					echo '</select>';
					echo '<select name="'.$fieldname.'[]" class="tbl-optarray-selected" multiple size="'.$num_options.'" '.$locked.'>';
					foreach($field as $opt){ //Selected options
						$optid = $array_options_inverse[$opt];
						if(!$locked){
							echo "<option value=\"$optid\">$opt</option>";
						}else{
							echo "<option disabled value=\"$optid\">$opt</option>";
						}
					}
					echo "</select>";
					echo '<div class="tbl-optarray-actions">';
					if(empty($locked)){ //Buttons to move/(un)select options
						echo '<button type="button" class="tbl-optarray-action act-left-all"></button>';
						echo '<button type="button" class="tbl-optarray-action act-left"></button>';
						echo '<button type="button" class="tbl-optarray-action act-right"></button>';
						echo '<button type="button" class="tbl-optarray-action act-right-all"></button>';
					}else{ //Or just a lock symbol if it's locked
						echo '<div class="tbl-optarray-action act-locked"></div>';
					}
					echo '</div>';
					if(empty($locked)){
						echo '<button class="tbl-extended-options teo-create" type="button"><img src="../style/opt_combo.png" alt="Add Option" /></button>';
						echo '<button class="tbl-extended-options teo-delete" type="button"><img src="../style/opt_combo2.png" alt="Delete Option" /></button>';
					}
					echo '<select class="tbl-optarray-options" multiple size="'.$num_options.'" '.$locked.'>';
					$unsel = array_diff($array_options, $field);
					foreach($unsel as $optid=>$opt){ //Unselected options
						if(!$locked){
							echo "<option value=\"$optid\">$opt</option>";
						}else{
							echo "<option disabled value=\"$optid\">$opt</option>";
						}
					}
					echo "</select>";
					echo "</td>";
				}
				break;
			case "reference": //TODON'T: Replace this with autofill mechanism of the referenced table
				echo '<td class="tbl-edit'.$editclass.'"'.$errormsg.'><input type="number" name="'.$fieldname.'" value="'.$field["s_id"].'" '.$locked.'/></td>';
				break;
			case "options":
				$options = retrieve_options($form, $tablename_2nd, true);
				$separator = ", ";
				if(isset($table_2nd["separator"])){
					$separator = $table_2nd["separator"];
				}
				echo '<td class="tbl-edit tbl-optselect'.$editclass.'"'.$errormsg.'>';
				echo '<input class="tbl-option-create" type="text" />';
				echo '<select class="tbl-option-select" name="'.$fieldname.'" '.$locked.'>';
				echo '<option></option>';
				foreach($options as $option){
					$selected = "";
					if($option[$table_2nd["pk"]] == $field[$table_2nd["pk"]]){
						$selected = " selected";
					}
					echo "<option$selected value=\"".$option[$table_2nd["pk"]]."\">";
					unset($option[$table_2nd["pk"]]);
					echo join($separator, $option);
					echo "</option>";
				}
				echo '</select>';
				if(empty($locked)){
					echo '<button class="tbl-extended-options teo-create" type="button"><img src="../style/opt_combo.png" alt="Add Option" /></button>';
					echo '<button class="tbl-extended-options teo-delete" type="button"><img src="../style/opt_combo2.png" alt="Delete Option" /></button>';
				}
				echo '</td>';
				break;
		}
	}else{
		echo "<td class=\"tbl-key\">".$table["fields"][$fieldname]["title"]."</td>";
		echo '<td class="tbl-edit'.$editclass.'"'.$errormsg.'>';
		switch($table["fields"][$fieldname]["type"]){
			case "textopts": //Text field with some presets TODO: Replace this w/ dynamic JS dropdown as "datalist" doesn't really work
				echo '<input type="text" name="'.$fieldname.'" value="'.$field.'" list="'.$fieldname.'-textopts" '.$locked.'/>';
				echo '<datalist style="display: none;" id="'.$fieldname.'-textopts">';
				foreach($table["fields"][$fieldname]["options"] as $textopt){ //Available "presets"
					echo '<option value="'.$textopt.'">';
				}
				echo "</datalist>";
				break;
			case "integer": //Numeric field
				$field_cfg = $table["fields"][$fieldname];
				if(isset($field_cfg["int_min"])){
					$locked .= 'min="'.$field_cfg["int_min"].'" ';
				}
				if(isset($field_cfg["int_max"])){
					$locked .= 'max="'.$field_cfg["int_max"].'" ';
				}
				echo '<input type="number" name="'.$fieldname.'" value="'.$field.'" '.$locked.'step="1" />';
				break;
			case "html":
				echo '<textarea name="'.$fieldname.'" '.$locked.' rows="'.max(min(substr_count($field, "\n"), 16), 4).'">';
				echo htmlspecialchars($field);
				echo '</textarea>';
				break;
			case "yesno":
				echo '<select name="'.$fieldname.'" '.$locked.'>';
				if($field == "yes"){
					echo "<option selected>yes</option>";
					echo "<option>no</option>";
				}else{
					echo "<option>yes</option>";
					echo "<option selected>no</option>";
				}
				echo "</select>";
				break;
			case "bitfield":
				foreach($table["fields"][$fieldname]["bitfields"] as $bitnum=>$bitlbl){
					echo '<label>';
					echo '<input style="height:initial;min-width:0px;width:initial;vertical-align:middle;" type="checkbox" name="'.$fieldname.'[]" value="'.$bitnum.'" '.($field & pow(2, $bitnum) ? "checked " : "").'/>';
					echo $bitlbl;
					echo '</label><br/>';
				}
				echo '<hr style="margin: 0px; border: none; border-bottom: 1px solid #ccc;"/>';
				break;
			case "file":
				echo '<span style="display: block; padding: 3px 0px 2px 0px; border-bottom: 1px solid #ccc;">';
				echo '<span style="margin-left: 4px;">';
				if(empty($field)){
					echo 'No File.';
				}else{
					echo $field;
				}
				echo '</span>';
				echo '<label style="margin-left: 8px; margin-right: 4px; float: right;" class="fake-link">Replace';
				echo '<input style="display: none;" type="file" name="'.$fieldname.'" onchange="relocateFilename(this)"/></label>';
				echo '</span>';
				break;
			default: //Text field
				if(in_array($table["fields"][$fieldname]["type"], Array("date", "time", "datetime")) && empty($locked)){ //Add a date/time/datetime picker to applicable fields
					$addtl_class = "tbl-picker-".$table["fields"][$fieldname]["type"];
					echo '<input class="'.$addtl_class.'" type="text" name="'.$fieldname.'" value="'.$field.'" '.$locked.'/>';
				}else if($table["fields"][$fieldname]["type"]=="date-sometimes" && empty($locked)){
					echo '<input class="tbl-picker-datetime" type="text" name="'.$fieldname.'" value="'.$field.'" '.$locked.'/>';
				}else{
					echo '<input type="text" name="'.$fieldname.'" value="'.$field.'" '.$locked.'/>';
				}
				break;
		}
		echo "</td>";
	}
}
?>
			</tr>
			<tr>
				<th colspan="2" class="tbl-actions">
					<input id="edit-save" type="submit" value="Save" />
					<input id="edit-reset" type="reset" value="Reset" />
				</th>
			</tr>
		</tbody></table>
	</form>
</div>
<div class="admin-subheader">
	<div id="admin-pagebar-left"></div>
	<div id="admin-pagebar-right"></div>
	<div id="admin-pagebar">
		<?php if(!$newRecord){ ?>
		<a href="record_view.php?form=<?=$formName?>&record=<?=$recordID?>">View</a> | 
		<a href="record_delete.php?form=<?=$formName?>&record=<?=$recordID?>">Delete</a>
		<?php } ?>
	</div>
</div>
<script>
	//File upload reformat helper
	function relocateFilename(base){
		var target = base.parentElement.parentElement.children[0];
		var filepath = base.value;
		var fileparts = filepath.split(/\\|\//);
		var filename = fileparts[fileparts.length - 1];
		target.innerHTML = filename;
	}
</script>
<?php
admin_finish();
?>