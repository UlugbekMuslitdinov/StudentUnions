<?php
include("config/forms.php");
$nav_path = Array(
	"Admin Home" => "index.php"
);
$page_options['title'] = 'Available Forms';
admin_start($page_options);

$sorted_forms = Array();
foreach($form_cfg as $name=>$form){
	if(!empty($form["category"])){
		// echo $form["category"];
		if(!in_array($form["category"],$sorted_forms))
			$sorted_forms[$form["category"]] = Array();
		array_push($sorted_forms[$form["category"]], $name);
	}else{
		array_push($sorted_forms, $name);
	}
}
?>
<div id="center-col" style="display: inline-block; width: auto !important;">
	<h1>Forms:</h1>
	<?php 
		$disabled_forms = Array();
		foreach($sorted_forms as $label=>$name){
			if(is_array($name)){
				?>
					<h2 class="form-category-title"><?=$label?></h2>
					<div class="form-category">
				<?php
				foreach($name as $true_name){
					$form = $form_cfg[$true_name];
					if(form_authorized($form, "view")){
						?>
							<h2 class="form-list-title"><a href="records.php?form=<?=$true_name?>"><?=$form["title"]?></a></h2>
							<h3><?=$form["description"]?></h3>
						<?php
					}else{
						if(!is_array($disabled_forms[$name]))
							$disabled_forms[$name] = Array();
						array_push($disabled_forms[$name], $true_name);
					}
				}
				?>
					</div>
				<?php
			}else{
				$form = $form_cfg[$name];
				if(form_authorized($form, "view")){
					?>
						<h2 class="form-list-title"><a href="records.php?form=<?=$name?>"><?=$form["title"]?></a></h2>
						<h3><?=$form["description"]?></h3>
					<?php
				}
			}
		}
		if(count($disabled_forms)>0){
		?>
			<h2 style="margin-top: 16px; margin-bottom: 0; font-size: 24px; color: #765;">Unavailable Forms:</h2>
		<?php
		}
		foreach($disabled_forms as $label=>$name){
			if(is_array($name)){
				?>
					<h2 class="form-category-title"><?=$label?></h2>
					<div class="form-category">
				<?php
				foreach($name as $true_name){
					$form = $form_cfg[$true_name];
					?>
						<h2 class="form-list-title"><?=$form["title"]?></h2>
						<h3><?=$form["description"]?></h3>
					<?php
				}
				?>
					</div>
				<?php
			}else{
				$form = $form_cfg[$name];
				?>
					<h2 class="form-list-title"><?=$form["title"]?></h2>
					<h3><?=$form["description"]?></h3>
				<?php
			}
		}
	?>
</div>
<?php
admin_finish();
?>