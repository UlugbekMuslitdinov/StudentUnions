<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');

require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/studentapp.inc');
session_start();
if (!is_object($_SESSION['employment_app'])) {
	header("Location: /employment/application/index.php");
	exit();
}
if ($_POST['stage']) {
	$_SESSION['employment_app'] -> validate();
	$_SESSION['employment_app'] -> save();
}
// echo "<pre>"; print_r($_SESSION['employment_app']); echo "</pre>";
$page_options['title'] = 'Arizona Student Union employee application:';
$page_options['header_image'] = 'images/student_employment.png';
page_start($page_options);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<style>
	textarea {
		width: 345px;
		height: 180px;
	}
	.cloud{
            float:left;
            margin-bottom:20px;
            display:block;
          }
          .active{
            cursor:pointer;
          }
</style>
<div style="padding-left:0px; margin-left:0px; margin-top:-10px; margin-right:15px;">
	<div style="width:950px;">
    	<div style="float:left; width:75px;">
        	<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
            <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
            <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
            <img class="cloud active" src="images/4_green.gif" onclick="window.location='./4.php'"/>
            <img class="cloud active" src="images/5_red.gif" onclick="window.location='./5.php'"/>
        </div>
		<div style="float:left; width:700px; margin-left:30px;">
			<img src="images/comments.gif" />
			<?php $_SESSION['employment_app'] -> form_start(5);
				echo '<p class="error-msg reg14 left20 top10">' . $_SESSION['employment_app']->error_messages . '</p>';
			?>

			<p style="font-size:13px;">
				Please use this box for any other important information you feel we should know (meetings, transportation issues, lab times,
				extenuating circumstances, special needs, etc). (500 character limit)
			</p>  </td>
			</table>
			<div style="background-color:#dae8d4; width:350px; height:220px; background-repeat:no-repeat; padding:25px; margin-top:25px; margin-bottom:25px;">
				<?php $_SESSION['employment_app'] -> textArea('comments', $_SESSION['employment_app'] -> application -> application_values['comments']); ?>
			</div>
			<input type="button" id="previous" name="previous" value="Previous" onclick="location.href='/employment/application/4.php';" >
			<?php $_SESSION['employment_app'] -> submit('Save and Submit Application'); ?>
			<?php $_SESSION['employment_app'] -> form_finish(5); ?>
		</div>
	</div>
</div>


<?php  page_finish(); ?>
