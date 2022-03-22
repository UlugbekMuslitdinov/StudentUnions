<?php
//Typical display functions for admin section, plus:
//Admin authorization checking
//Navigation + account bar
//Paged navigation bar
//Recovery of GET variables for users not yet logged in

session_start();
if(empty($_SESSION["recoverGET"])){
	$_SESSION["recoverGET"] = $_GET;
}else{
	$_GET = $_SESSION["recoverGET"];
}

require_once('global.inc');
require_once("webauth/include.php");
require_once("deliverance/inc_db_switch.php");

date_default_timezone_set("America/Phoenix");
$conn = new db_mysqli("su");
$conn->set_charset("utf8mb4");
unset($_SESSION["recoverGET"]);

//Get user auth and data from DB
if(empty($_SESSION["adminUser"])){
	load_user();
}

//Check if current user is authorized
$unauthorized = true;
if(!empty($_SESSION["adminUser"]["accessLevel"])) $unauthorized = false;

//Gets user info (webauth must alread be done)
function load_user(){
	global $conn;
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

//Called at start of page
function admin_start($page_options, $big_header=false){
	global $page_options;
	$page_options['ssheets'][] = '/admin/style/admin.css';
	
	unset($page_options['header_image']);
	
	page_start('Admin');
?>
	<?php if($big_header){ ?>
	<div id="admin-header" class="noselect">
		<div id="admin-header-text">Administration</div>
	</div>
	<?php } addtl_header(); ?>
<?php
}

//Called at end of page
function admin_finish(){
	page_finish();
	$GLOBALS["conn"]->close();
}

function admin_displayname(){
	if(!empty($_SESSION["adminUser"]["userData"]["directoryFN"])){
		return $_SESSION["adminUser"]["userData"]["directoryFN"]." ".$_SESSION["adminUser"]["userData"]["directoryLN"];
	}else{
		return $_SESSION["adminUser"]["netID"];
	}
}

//Output user info bar to top of page - called by administration.inc
function addtl_header(){
	global $unauthorized, $nav_path;
	?>
	<div class="admin-subheader">
		<div id="admin-subheader-nav">
		<?php
			if(!empty($nav_path)){
				$navlinks = Array();
				foreach($nav_path as $title=>$link){
					array_push($navlinks, "<a href=\"/admin/$link\">$title</a>");
				}
				echo(join(" > ", $navlinks));
			}
		?>
		</div>
		<div id="admin-subheader-user">
			<?=admin_displayname()?> | 
			<a class="fake-link" href="<?php=create_logout_link("Log out")?>">Log Out</a>
		</div>
	</div>
	<?php
	if($unauthorized){ //Output bar saying user is unauthorized, finish page, and completely stop script.
		?>
		<div class="admin-subheader-unauthorized">
			You do not have permission to view this page.
		</div>
		<?php
		admin_finish();
		exit();
	}else if(!empty($_SESSION["error_banner"])){ //Output red bar with some error
		?>
		<div class="admin-subheader-unauthorized">
			<?=$_SESSION["error_banner"]?>
		</div>
		<?php 
		unset($_SESSION["error_banner"]);
	}else if(!empty($_SESSION["success_banner"])){ //Output green bar with some message, it will auto-hide
		?>
		<div class="admin-subheader-banner" id="success-banner">
			<?=$_SESSION["success_banner"]?>
		</div>
		<script>
			document.addEventListener("DOMContentLoaded", function(){
				window.setTimeout(function(){
					var banner = document.getElementById("success-banner");
					banner.style.height = "0";
					banner.style.margin = "0";
					banner.style.padding = "0";
					banner.style.minHeight = "0";
				}, 5000);
			});
		</script>
		<?php 
		unset($_SESSION["success_banner"]);
	}
}

//Get number of records per page, as shown on the pagebar
function admin_pagebar_per_page($per_page_field="count"){
	if(!empty($_GET[$per_page_field]) && ctype_digit($_GET[$per_page_field])){
		$per_page = (int)$_GET[$per_page_field];
	}else{
		$per_page = 25;
	}
	$_GET[$per_page_field] = (string)$per_page;
	return $per_page;
}

//Get current page, as shown on the pagebar
function admin_pagebar_start_page($start_page_field="page", $per_page_field="count"){
	$per_page = admin_pagebar_per_page($per_page_field);
	if(!empty($_GET[$start_page_field]) && ctype_digit($_GET[$start_page_field])){
		if(isset($_SESSION["admin_pagebar_per_page_prev"]) && $_SESSION["admin_pagebar_per_page_prev"]!=$per_page){
			//If per page has changed remap start page to have about same record as start of last page
			$start_record = $_SESSION["admin_pagebar_per_page_prev"] * ($_SESSION["admin_pagebar_start_page_prev"] - 1) + 1;
			$start_page = ceil($start_record/$per_page);
		}else{
			$start_page = (int)$_GET[$start_page_field];
		}
	}else{
		$start_page = 1;
	}
	$_SESSION["admin_pagebar_per_page_prev"] = $per_page;
	$_SESSION["admin_pagebar_start_page_prev"] = $start_page;
	$_GET[$start_page_field] = (string)$start_page;
	return $start_page;
}

//Display the pagebar
//TODO: remove dependency on form
function admin_pagebar(
	  $form_already_open=false, //Live inside another form instead of making a new one
	  $record_addable=true, //Have link to add record if true
	  $form_name=false, //Substitution for form name
	  $start_page=false, //"" for start page
	  $per_page=false, //"" for page count
	  $form_name_field="form", //GET name of form name
	  $start_page_field="page", //"" of start page
	  $per_page_field="count" //"" of page count
	){
	if($form_name === false) $form_name = $_GET[$form_name_field];
	if($start_page === false) $start_page = admin_pagebar_start_page($start_page_field);
	if($per_page === false) $per_page = admin_pagebar_per_page($per_page_field);
	?>
	<div class="admin-subheader">
		<?php if(!$form_already_open){ ?>
		<form method="GET">
		<?php } ?>
			<input type="hidden" name="<?=$form_name_field?>" value="<?=$form_name?>" />
			<?php if(isset($_GET["sort"])){ ?>
			<input type="hidden" name="sort" value="<?=$_GET["sort"]?>" />
			<?php } if(isset($_GET["sort_desc"])){ ?>
			<input type="hidden" name="sort_desc" />
			<?php } ?>
			<div id="admin-pagebar-left">
				<label id="admin-pagebar-count">
					<select name="<?=$per_page_field?>" onchange="this.form.submit()">
						<?php
						$standard_counts = Array(10, 25, 50, 100);
						if(!in_array($per_page, $standard_counts)){
							array_push($standard_counts, $per_page);
						}
						sort($standard_counts);
						foreach($standard_counts as $count){
							if($count==$per_page){
								echo "<option selected>$count</option>";
							}else{
								echo "<option>$count</option>";
							}
						}
						?>
					</select>
					Per Page
				</label>
				<?php
				global $form_cfg, $search;
				if(empty($search)) $search = false;
				$record_count = form_total_records($form_cfg[$form_name], $search);
				?>
				<span>
					/ <?=$record_count?> Total
				</span>
			</div>
			<div id="admin-pagebar-right">
				<?php if($record_addable){ ?>
				<a class="fake-link" href="record_add.php?form=<?=$form_name?>">Add Record</a>
				<?php } ?>
			</div>
			<div id="admin-pagebar">
				<?php
				$maxPages=ceil($record_count/$per_page);
				$pageOption = function($pagenum, $pagetext="", $current=false) use ($start_page_field){
					if(empty($pagetext)){
						$pagetext = $pagenum;
					}
					?>
					&nbsp;
					<label <?=$current?'':'class="fake-link" '?>>
						&nbsp;<?=$pagetext?>
						<input type="radio" name="<?=$start_page_field?>" value="<?=$pagenum?>" style="display:none" onclick="this.form.submit()" <?=$current?"checked ":""?>/>
					</label>
					<?php
				};
				
				echo '<div id="pagebar-subsect-left">';
				if($start_page>1){
					$pageOption(1, "&lt;&lt; First");
					$pageOption($start_page-1, "&lt; Prev");
				}
				echo '&nbsp;</div><div id="pagebar-subsect-center">';
				
				if($start_page<=5){
					$optStart = 1;
					$optEnd = 10;
				}else if($start_page>($maxPages-5)){
					$optStart = $maxPages-10;
					$optEnd = $maxPages;
				}else{
					$optStart = $start_page-5;
					$optEnd = $start_page+4;
				}
				if($optStart<1) $optStart=1;
				if($optEnd>$maxPages) $optEnd=$maxPages;
				for($optI=$optStart; $optI<=$optEnd; $optI++){
					if($optI==$start_page){
						$pageOption($optI, $optI, true);
					}else{
						$pageOption($optI);
					}
				}
				if($start_page>$maxPages){
					$pageOption($start_page, $start_page, true);
				}
				
				echo '&nbsp;</div><div id="pagebar-subsect-right">';
				if($start_page<$maxPages){
					$pageOption($start_page+1, "Next &gt;");
					$pageOption($maxPages, "Last &gt;&gt;");
				}
				echo '&nbsp;</div>';
				?>
			</div>
		<?php if(!$form_already_open){ ?>
		</form>
		<?php } ?>
	</div>
	<?php
} 
?>
