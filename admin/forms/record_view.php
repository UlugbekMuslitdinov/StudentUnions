<?php
include("config/forms.php");

form_precheck("view", true);

$nav_path = Array(
	"Admin Home" => "index.php",
	"Forms" => "forms/list.php",
	$form["title"] => "forms/records.php?form=$formName"
);
$page_options['title'] = $form["title"].' | Record #'.$recordID;
if (!isset($_GET["singleview"]) && !isset($_GET["frameview"])) {
	admin_start($page_options);
} else if(!isset($_GET["singleview"])) {
	$page_options['script_incs'][] = "/admin/js/reframe.js";
	frameview_start();
}
echo '<div id="center-col">';

if(!isset($_GET["singleview"])){
	echo '<h2 class="formtitle">';
	if(isset($_GET["frameview"]))
		echo '<a href="/admin/forms/records.php?form='.$formName.'&frameview">'.$form["title"].'</a> - Record #'.$recordID;
	else
		echo $form["title"].' - Record #'.$recordID;
	echo '</h2>';
}
echo '<table class="formtable recordtable"><tbody><tr>';
echo "<th>Field</th>";
echo "<th>Value</th>";
foreach($record as $fieldname=>$field){
	if(!empty($table["fields"][$fieldname]["hidden"])) continue;
	echo "</tr><tr>";
	if(is_array($field)){
		$tablename_2nd = $table["fields"][$fieldname]["table"];
		if(empty($form["tables"][$tablename_2nd])) break;
		$table_2nd = $form["tables"][$table["fields"][$fieldname]["table"]];
		echo "<td class=\"tbl-key tbl-array-key\">".$table["fields"][$fieldname]["title"]."</td>";
		switch($table_2nd["type"]){
			case "reference":
				echo '<td><a href="record_view.php?form='.$table_2nd["form"].'&record='.$field["s_id"].'">';
				echo $field["s_id"].' - '.$field["label"].'</a></td>';
				break;
			case "options":
				$separator = ", ";
				if(isset($table_2nd["separator"])){
					$separator = $table_2nd["separator"];
				}
				unset($field[$table_2nd["pk"]]);
				echo "<td>".join($separator, $field)."</td>";
				break;
			default:
				echo "<td>";
				echo join("<br/>", $field);
				echo "</td>";
				break;
		}
	}else{
		echo "<td class=\"tbl-key\">".$table["fields"][$fieldname]["title"]."</td>";
		switch($table["fields"][$fieldname]["type"]){
			case "date":
				$dtinter = new DateTime($field);
				$dtinter = $dtinter->format("m/d/y");
				echo "<td>$dtinter</td>";
				break;
			case "date-sometimes":
			case "datetime":
				$dtinter = new DateTime($field);
				$dtinter = $dtinter->format("m/d/y g:ia");
				echo "<td>$dtinter</td>";
				break;
			case "url":
				$href = $table["fields"][$fieldname]["prefix"].$field.$table["fields"][$fieldname]["suffix"];
				if(!empty($table["fields"][$fieldname]["linktext"])) $field = $table["fields"][$fieldname]["linktext"];
				echo "<td><a href=\"$href\">$field</a></td>";
				break;
			case "bitfield":
				$bitmap = $table["fields"][$fieldname]["bitfields"];
				echo "<td>";
				for($bit = 0; $bit < count($bitmap); $bit++){
					if($field & pow(2, $bit)) echo $bitmap[$bit]."<br/>";
				}
				echo "</td>";
				break;
			case "file":
				echo '<td><a href="'.get_file_path($table, $fieldname, [$table["pk"]=>$recordID,$fieldname=>$field]).'">'.$field.'</a></td>';
				break;
			default:
				echo "<td>".$field."</td>";
				break;
		}
	}
}
echo "</tr></tbody></table>";
echo '</div>';
if(!isset($_GET["singleview"])){
?>
<div class="admin-subheader">
	<div id="admin-pagebar-left"></div>
	<div id="admin-pagebar-right"></div>
	<div id="admin-pagebar">
		<?php if(isset($_GET["frameview"])){ ?>
		<a href="record_delete.php?form=<?=$formName?>&record=<?=$recordID?>&frameview">Delete</a>
		<?php }else{ ?>
		<a href="record_edit.php?form=<?=$formName?>&record=<?=$recordID?>">Edit</a> | 
		<a href="record_delete.php?form=<?=$formName?>&record=<?=$recordID?>">Delete</a>
		<?php } ?>
	</div>
</div>
<?php
}
if(!isset($_GET["singleview"]) && !isset($_GET["frameview"])) admin_finish();
else if(!isset($_GET["singleview"])) frameview_finish();
?>