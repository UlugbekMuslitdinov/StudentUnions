<?php
require_once ('includes/studentapp.inc');
session_start();
if (!is_object($_SESSION['employment_app']) || !isset($_SESSION['webauth'])) {
	header("Location: /employment/application/index.php");
	exit();
}

require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
$page_options['title'] = 'Arizona Student Union employee application:';
page_start($page_options);

// echo "<pre>"; print_r($_SESSION); echo "</pre>";
?>
<div style="margin:auto 30px;">
	<div style="margin-bottom:20px; background-color:#438D41; width:100%; ">
		<img src="images/banner.gif">
    </div>	
	<div style="width:800px; margin:0 auto">
		<div>
        	<img src="images/application_status.gif" />
        </div>
		<div style="background-image:url(images/green_box_status.gif); background-repeat:no-repeat; width:700px; height:546px;padding-top:45px;margin:inherit;">
		<?php
			if($_GET['action'] == 'activate')
				$_SESSION['employment_app']->application->activate();
			elseif($_GET['action'] == 'deactivate')
				$_SESSION['employment_app']->application->deactivate();

			if($_SESSION['employment_app']->application->application_values['active'] == 1){
		?>
			<div align="center" style="width:100%; font-size:14px; font-weight:bold; color:#C01525; padding-top:5px; padding-bottom:45px;">
				<p>Your application was submitted on <?= date('M d, Y ', strtotime($_SESSION['employment_app']->application->application_values['date_submitted'])); ?></p><br/>
				<p>Last updated on <?= date('M d, Y ', strtotime($_SESSION['employment_app']->application->application_values['date_updated'])); ?></p>
			</div>

			<input type="image" src="images/edit_button.gif" value="edit" style="float:left; margin-left:60px; cursor:pointer;" onclick="window.location='index.php?edit=1'" />
			<p style="float:left; width:300px; margin-left:40px; font-size:14px;">You can edit your application at any time as long as it has not been deactivated.</p>

			<div style="clear:both; height:45px;"></div>

			<br />
			<input type="image" src="images/Deactivate_button.gif" value="deactivate" onclick="window.location='status.php?action=deactivate'" style="float:left; margin-left:60px; cursor:pointer;" />
			<p style="float:left; width:300px; margin-left:40px; font-size:14px;">If you no longer wish to be considered for employment at the Arizona Student Unions please deactivate your application.</p>
		<?php
		}
		else{
		?>
			<input type="image" style="float:left; margin-left:60px; cursor:pointer;" src="images/reactivate_button.gif" value="activate" onclick="window.location='status.php?action=activate'" />
			<p style="float:left; width:300px; margin-left:40px; font-size:14px;">If you wish to be considered for employment again at the Department of Arizona Student Unions please reactivate your application.</p>
		<?php } ?>
	</div>
	</div>
</div>
<?php page_finish(); ?>