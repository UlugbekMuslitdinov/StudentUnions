<?php
include("config/forms.php");

form_precheck("view", false);

$nav_path = Array(
	"Admin Home" => "index.php",
	"Forms" => "forms/list.php"
);
$page_options['title'] = $form["title"].' | Records';
if (!isset($_GET["singleview"]) && !isset($_GET["frameview"])) {
	admin_start($page_options);
} else if(!isset($_GET["singleview"])) {
	$page_options['script_incs'][] = "/admin/js/reframe.js";
	frameview_start();
}
echo '<form id="formsearch" method="GET">';
echo '<div id="center-col">';

if(!empty($table["default_count"]) && empty($_GET["count"])) $_GET["count"] = (string)$table["default_count"];
$per_page = admin_pagebar_per_page();
$start_page = admin_pagebar_start_page();
$page = ($start_page-1)*$per_page;

$sort = &$form["tables"][$form["primary_table"]]["sort"];
if(empty($sort)){ //Default sort by pk asc
	$sort = Array(
		"field" => $table["pk"],
		"direction" => "ascending",
	);
}
if(!empty($_GET["formsearch_control_sort"])){ //Allow custom sort
	if(!empty($table["fields"][$_GET["formsearch_control_sort"]]) || $_GET["formsearch_control_sort"] == $table["pk"]){
		$sort["field"] = $_GET["formsearch_control_sort"];
		if(isset($_GET["formsearch_control_sort_desc"])){
			$sort["direction"] = "descending";
		}else{
			$sort["direction"] = "ascending";
		}
	}
}
unset($sort); //Kill reference so we don't ruin everything later
$sort = $form["tables"][$form["primary_table"]]["sort"];

$search = Array();
if($_SERVER["REQUEST_METHOD"]=="GET"){
	foreach($_GET as $searchfield=>$searchvalue){
		if(!empty($table["fields"][$searchfield])){
			if($table["fields"][$searchfield]["type"] == "date"){
				$search[$searchfield] = date("Y-m-d", strtotime($searchvalue));
			}else if($table["fields"][$searchfield]["type"] == "datetime"){
				$inter = new DateTime($searchvalue);
				if($inter->format("His")=="000000") #no time
					$search[$searchfield] = $inter->format("Y-m-d");
				else
					$search[$searchfield] = $inter->format("Y-m-d H:i:s");
			}else{
				$search[$searchfield] = $searchvalue;
			}
		}
	}
}
if($search != $_SESSION["formsearch_previous"]){
	$start_page = 1;
	$_GET["page"] = "0";
	$page = 0;
}
$_SESSION["formsearch_previous"] = $search;
if(count($search)<1) $search = false;

$records = retrieve_form($form, $per_page, $page, true, $search);
if(count($records)<1){ //Stop if no records
	echo '<h3 style="width: 100%; text-align: center;">No records on this page.</h3>';
	echo '<div class="fake-link" style="text-align: center;" onclick="history.go(-1)">&lt;&lt;&lt; Back</div>';
	echo '<br/>';
	if(!isset($_GET["frameview"]) && !isset($_GET["singleview"])){
		admin_pagebar();
		admin_finish();
	}else if(!isset($_GET["singleview"])){
		admin_pagebar();
	}
	exit();
}

if(!isset($_GET["singleview"])){
	echo '<div style="float:left;width:20px;"></div>';
	echo '<button id="formsearch-button"><img src="../style/search.png" alt="Search Records" /></button>';
	echo '<h2 class="formtitle">'.(!empty($form["category"])?($form["category"].": "):"").$form["title"].'</h2>';
}
if(isset($_GET["singleview"])){
	echo '<input type="hidden" name="singleview" />';
	$vedaAuth["edit"] = false;
	$vedaAuth["delete"] = false;
	$vedaAuth["add"] = false;
}
if(isset($_GET["frameview"])){
	echo '<input type="hidden" name="frameview" />';
	$vedaAuth["edit"] = false;
	$vedaAuth["add"] = false;
}
echo '<input type="hidden" name="form" value="'.$formName.'" />';
echo '<input type="hidden" name="formsearch_control_sort" value="'.$sort["field"].'" />';
echo '<input type="submit" style="display:none" />';
if(isset($table["key_fields"])){
	$key_fields = $table["key_fields"];
}else{
	$key_fields = array_slice(array_keys($table["fields"]), 0, 5);
}
if(!in_array($table["pk"], $key_fields)){
	if(empty($_GET["fields_only"])){
		array_unshift($key_fields, $table["pk"]);
	}else{
		echo '<input type="hidden" name="fields_only" />';
	}
}
echo '<table class="formtable"><tbody><tr>';
foreach($key_fields as $field){
	$title = $table["fields"][$field]["title"];
	if(empty($title)) $title = "ID";
	if(!empty($table["fields"][$field]["locked"]) && empty($table["fields"][$field]["searchable"])){
		echo '<th>'.$title.'</th>';
	}else{
		if($sort["field"]==$field){
			if($sort["direction"]=="ascending"){
				echo '<th><button type="submit" name="formsearch_control_sort_desc" value="">'.$title.'&#x25B2;</button></th>';
			}else{
				echo '<th><button type="submit">'.$title.'&#x25BC;</button></th>';
			}
		}else{
			echo '<th><button type="submit" name="formsearch_control_sort" value="'.$field.'">'.$title.'</button></th>';
		}
	}
}

$vedCount = 1;
if(!isset($_GET["singleview"])){
	echo '<th class="ved-icon">V</th>';
}
if($vedaAuth["edit"]){
	echo '<th class="ved-icon">E</th>';
	$vedCount++;
}
if($vedaAuth["delete"]){
	echo '<th class="ved-icon">D</th>';
	$vedCount++;
}

$noSearchKeys = Array(); //Keys NOT for searching because they are locked
if(!isset($_GET["singleview"])){
	//Search bar, starts hidden
	$showing = false;
	foreach($key_fields as $field){
		if(!empty($_GET[$field])) $showing = true;
	}
	if($showing){
		echo '<tr id="formsearch-row">';
	}else{
		echo '<tr id="formsearch-row" class="concealed">';
	}
	foreach($key_fields as $field){
		echo '<td>';
		$value = "";
		if(isset($_GET[$field])){
			$value = 'value="'.$_GET[$field].'"';
		}
		if($field==$table["pk"]){
			echo '<input type="text" size="3" name="'.$field.'" '.$value.'/>';
		}else if(empty($table["fields"][$field]["locked"])){
			echo '<input type="text" name="'.$field.'" '.$value.'/>';
		}else{
			array_push($noSearchKeys, $field);
		}
		echo '</td>';
	}
	echo '<td><button id="formsearch-clear" class="tbl-formsearch-action"><img src="../style/delete.png" /></button></td>';
	for($vedCounter = 1; $vedCounter < $vedCount; $vedCounter++){
		echo '<td></td>';
	}
	echo '</tr>';
}else{
	foreach($key_fields as $field){
		if(!empty($_GET[$field])){
			echo '<input type="hidden" name="'.$field.'" value="'.$_GET[$field].'" />';
		}
	}
}


foreach($records as $record){
	echo "</tr><tr>";
	foreach($key_fields as $field){
		switch($table["fields"][$field]["type"]){
			case "secondary":
				$s_table = $form["tables"][$table["fields"][$field]["table"]];
				switch($s_table["type"]){
					case "option_array":
						echo "<td>...</td>";
						break;
					case "options":
						$separator = ", ";
						if(isset($s_table["separator"])){
							$separator = $s_table["separator"];
						}
						unset($record[$field][$s_table["pk"]]);
						echo "<td>".join($separator, $record[$field])."</td>";
						break;
					case "reference":
						echo '<td><a href="record_view.php?form='.$s_table["form"].'&record='.$record[$field]["s_id"].'">';
						echo $record[$field]["s_id"].' - '.$record[$field]["label"].'</a></td>';
						break;
				}
				break;
			case "date-sometimes":
			case "date":
				$dtinter = new DateTime($record[$field]);
				$dtinter = $dtinter->format("m/d/y");
				echo "<td>$dtinter</td>";
				break;
			case "datetime":
				$dtinter = new DateTime($record[$field]);
				$dtinter = $dtinter->format("m/d/y g:ia");
				echo "<td>$dtinter</td>";
				break;
			case "url":
				if(!empty($record[$field])){
					$href = $table["fields"][$field]["prefix"].$record[$field].$table["fields"][$field]["suffix"];
					$linktext = "Link";
					if(!empty($table["fields"][$field]["linktext"])) $linktext = $table["fields"][$field]["linktext"];
					echo '<td><a href="'.$href.'">'.$linktext.'</a></td>';
				}else{
					echo '<td></td>';
				}
				break;
			case "file":
				echo '<td><a href="'.get_file_path($table, $field, $record).'">'.$record[$field].'</a></td>';
				break;
			case "bitfield":
				echo "<td>...</td>";
				break;
			default:
				echo "<td>".$record[$field]."</td>";
				break;
		}
	}
	if(!isset($_GET["singleview"])){
		echo '<td class="ved-icon"><a href="record_view.php?form='.$formName.'&record='.$record[$table["pk"]].(isset($_GET["frameview"])?"&frameview":"").'"><img src="../style/view.png" alt="View" /></a></td>';
	}
	if(empty($form["disallow_matched_user"]) || $record[$form["disallow_matched_user"]] != $_SESSION["adminUser"]["netID"]){
		if($vedaAuth["edit"]){
			echo '<td class="ved-icon"><a href="record_edit.php?form='.$formName.'&record='.$record[$table["pk"]].'"><img src="../style/edit.png" alt="Edit" /></a></td>';
		}
		if($vedaAuth["delete"]){
			echo '<td class="ved-icon"><a href="record_delete.php?form='.$formName.'&record='.$record[$table["pk"]].(isset($_GET["frameview"])?"&frameview":"").'"><img src="../style/delete.png" alt="Delete" /></a></td>';
		}
	}else{
		if(!empty($form["disallowed_fields"])){
			if($vedaAuth["edit"]){
				echo '<td class="ved-icon"><a href="record_edit.php?form='.$formName.'&record='.$record[$table["pk"]].'"><img src="../style/edit_half.png" alt="Edit" /></a></td>';
			}
		}
	}
}
echo "</tr></tbody></table>";
echo '</div>';

if(!isset($_GET["singleview"])) admin_pagebar(true, form_authorized($form, "add") && !isset($_GET["frameview"]));
echo '</form>';
$searchFieldMask = array_fill_keys(array_diff(array_merge(Array($table["pk"]), $key_fields), $noSearchKeys), 0);
if(!isset($_GET["singleview"])){
?>
<script>
var searchButton = document.getElementById("formsearch-button");
var clearButton = document.getElementById("formsearch-clear");
var searchRow = document.getElementById("formsearch-row");
var searchFields = <?=json_encode(array_merge($searchFieldMask, array_intersect_key($_GET, $searchFieldMask)))?>;
var searchOpen = false;

searchButton.onclick = function (e){
	e.preventDefault();
	if (!searchOpen) {
		searchRow.className = "";
		searchOpen = true;
	} else {
		var searching = false;
		for (var field in searchFields) {
			if (document.forms["formsearch"][field].value != "") searching = true;
		}
		if (searching) {
			document.forms["formsearch"].submit();
		} else {
			searchRow.className = "concealed";
			searchOpen = false;
		}
	}
};

clearButton.onclick = function(e){
	e.preventDefault();
	var searching = false;
	for (var field in searchFields) {
		if (searchFields[field] != "") searching = true;
		document.forms["formsearch"][field].value = "";
	}
	if (searching) {
		document.forms["formsearch"].submit();
	}
}

HTMLFormElement.prototype._submit = HTMLFormElement.prototype.submit;
document.forms["formsearch"].submit = function (){
	for (var field in searchFields) {
		if(document.forms["formsearch"][field].value == ""){
			document.forms["formsearch"][field].removeAttribute("value");
			document.forms["formsearch"][field].setAttribute("name", "");
		}
	}
	this._submit();
};
document.forms["formsearch"].onsubmit = document.forms["formsearch"].submit;
</script>
<?php
}
if(!isset($_GET["singleview"]) && !isset($_GET["frameview"])) admin_finish();
else if(!isset($_GET["singleview"])) frameview_finish();
?>