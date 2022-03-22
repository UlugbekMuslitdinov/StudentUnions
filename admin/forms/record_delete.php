<?php
include("config/forms.php");

form_precheck("delete", false);
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
}else{
	$inter = array_keys($record);
	$record = $record[$inter[0]];
	unset($record[$table["pk"]]);
	if(!empty($form["disallow_matched_user"])){
		if($record[$form["disallow_matched_user"]] == $_SESSION["adminUser"]["netID"]){
			$_SESSION["error_banner"] = 'You cannot delete a record about yourself.';
			header("Location: ./record_view.php?form=".$formName."&record=".$recordID);
			exit();
		}
	}
	if(isset($_GET["confirm"])){
		if(delete_records($form, $recordID)){
			$_SESSION["success_banner"] = 'Deleted record #'.$recordID.'.';
			header("Location: ./records.php?form=".$formName.(isset($_GET["frameview"])?"&frameview":""));
			exit();
		}else{
			$_SESSION["error_banner"] = 'Database error.';
		}
	}
}

$nav_path = Array(
	"Admin Home" => "index.php",
	"Forms" => "forms/list.php",
	$form["title"] => "forms/records.php?form=$formName"
);
$page_options['title'] = $form["title"].' | Delete Record #'.$recordID;
if (!isset($_GET["frameview"])) {
	admin_start($page_options);
} else {
	$page_options['script_incs'][] = "/admin/js/reframe.js";
	frameview_start();
}
echo '<div id="center-col">';

echo '<h2 class="formtitle">';
if(isset($_GET["frameview"]))
	echo '<a href="/admin/forms/records.php?form='.$formName.'&frameview">'.$form["title"].'</a> - Delete Record #'.$recordID;
else
	echo $form["title"].' - Record #'.$recordID;
echo '</h2>';
echo '<table class="formtable recordtable"><tbody><tr>';

if(isset($table["key_fields"])){
	$key_fields = $table["key_fields"];
}else{
	$key_fields = array_slice(array_keys($table["fields"]), 0, 5);
}

foreach($key_fields as $fieldname){ //REFACTOR THIS
	$field = $record[$fieldname];
	echo "</tr><tr>";
	if(is_array($field)){
		echo "<td class=\"tbl-key tbl-array-key\">".$table["fields"][$fieldname]["title"]."</td>";
		echo "<td>";
		echo join("<br/>", $field);
		echo "</td>";
	}else{
		echo "<td class=\"tbl-key\">".$table["fields"][$fieldname]["title"]."</td>";
		echo "<td>".$field."</td>";
	}
}
?>
		</tr>
		<tr>
			<th colspan="2" class="tbl-actions">
				<form action="record_delete.php">
					<?php if(isset($_GET["frameview"])) echo '<input type="hidden" name="frameview" />'; ?>
					<input type="hidden" name="form" value="<?=$formName?>" />
					<input type="hidden" name="record" value="<?=$recordID?>" />
					<input type="hidden" name="confirm" />
					<input type="submit" value="Confirm" />
				</form>
			</th>
		</tr>
	</tbody></table>
</div>
<div class="admin-subheader">
	<div id="admin-pagebar-left"></div>
	<div id="admin-pagebar-right"></div>
	<div id="admin-pagebar">
		<?php if(isset($_GET["frameview"])){ ?>
		<a href="record_view.php?form=<?=$formName?>&record=<?=$recordID?>&frameview">View</a>
		<?php }else{ ?>
		<a href="record_view.php?form=<?=$formName?>&record=<?=$recordID?>">View</a> | 
		<a href="record_edit.php?form=<?=$formName?>&record=<?=$recordID?>">Edit</a>
		<?php } ?>
	</div>
</div>
<?php
if(!isset($_GET["frameview"])) admin_finish();
else frameview_finish();
?>