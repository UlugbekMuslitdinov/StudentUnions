<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
require_once('includes/studentapp.inc');
session_start();
if(!is_object($_SESSION['employment_app'])){
	header("Location: /employment/application/index.php");
	exit();
}
if($_POST['stage']){
	$_SESSION['employment_app']->validate();
	$_SESSION['employment_app']->save();
}
// echo "<pre>"; print_r($_SESSION['employment_app']); echo "</pre>";

$active_semesters = $_SESSION['employment_app']->get_active_semester_ids();

ob_start();
?>
	@import url("forms.css");
	.textbox{
		border:none;
		background-color:#FCF9D0;
	}
	p{
		font-size:13px;
		margin-top: 15px;
		_margin-top: 14px;
		margin-bottom: 0px;
		line-height:15px;
	}
	.cloud{
		float:left;
		margin-bottom:20px;
		display:block;
	}
	.active{
		cursor:pointer;
	}					
	div{
		font-size:13px;
		
	}
					
<?php
$page_options['styles'] = ob_get_clean();

ob_start();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="schedule.js" ></script>


<script>
$(document).ready(function(){
	load_schedules();
});
function load_schedules(){
	document.getElementById("stage3").onsubmit = function(data){ return save_schedule();};
	schedule = <?= $_SESSION['employment_app']->get_schedules_as_json($active_semesters)?>;
	<?php
		// Parameters:
		// 1 div
		// 2 vertical
		// 3 num_sched
		// 4 sizex
		// 5 sizey
		// 6 nrow  = number of rows = 19 ends at midnight (midnight will not show)
		// 7 ncol
		// 8 divis
		// 9 start = 10 = 5am
		// 10 rowh
		// 11 colh
		// 12 new_schedule
		// 13 saved_schedules
		foreach($active_semesters as $id => $name)
			print "init( 'schedule_".$id."', 'vertical', 1, 26, 26, 19, 7, 2, 10, '', '', 1, 1);";
	?>
}
function save_schedule(){
	for(var i in instances){
		document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][0]" value="'+schedule[i][0][0]+'">';
		document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][1]" value="'+schedule[i][0][1]+'">';
		document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][2]" value="'+schedule[i][0][2]+'">';
		document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][3]" value="'+schedule[i][0][3]+'">';
		document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][4]" value="'+schedule[i][0][4]+'">';
		document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][5]" value="'+schedule[i][0][5]+'">';
		document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][6]" value="'+schedule[i][0][6]+'">';
	}
	document.getElementById("stage3").submit();
	return false;
}

</script>

<?php 
$page_options['title'] = 'Arizona Student Union employee application:';
$page_options['header_image'] = 'images/student_employment.png';
page_start($page_options);
?>

<div style="padding-left:0px; width:100%; z-index:2; ">
	
        <div style="margin-top:10px; width:1100px;">
        	<div style="float:left; width:75px;">
            	<?php
				switch($_SESSION['employment_app']->stage){
					case 4:
				?>
        			<img class="cloud active" src="images/1_green.gif" onClick="window.location='./1.php'";/>
                    <img class="cloud active" src="images/2_green.gif" onClick="window.location='./2.php'"/>
                    <img class="cloud active" src="images/3_red.gif" onClick="window.location='./3.php'"/>
                    <img class="cloud active" src="images/4_green.gif" onClick="window.location='./4.php'"/>
                    <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;  
					
					case 5:
				?>
        			<img class="cloud active" src="images/1_green.gif" onClick="window.location='./1.php'";/>
                    <img class="cloud active" src="images/2_green.gif" onClick="window.location='./2.php'"/>
                    <img class="cloud active" src="images/3_red.gif" onClick="window.location='./3.php'"/>
                    <img class="cloud active" src="images/4_green.gif" onClick="window.location='./4.php'"/>
                    <img class="cloud active" src="images/5_green.gif" onClick="window.location='./5.php'"/>
                <?php
					break;  
				
					default:
				?>
        			<img class="cloud active" src="images/1_green.gif" onClick="window.location='./1.php'";/>
                    <img class="cloud active" src="images/2_green.gif" onClick="window.location='./2.php'"/>
                    <img class="cloud active" src="images/3_red.gif" onClick="window.location='./3.php'"/>
                    <img class="cloud" src="images/4_grey.gif" />
                    <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;
				}	
				?>
            </div>
			 <div style="float:left; margin-left:30px; width:950px;">
				<div>
            		<img src="images/availabilty.gif" />
                    <p>
                   		<strong style="font-size:14px;">Click and drag through areas when you are able to work</strong>. Blocks can be erased by clicking on them again. Please enter your schedule to the <strong style="font-size:14px;">nearest half hour.</strong>
                	</p>
                </div>
                <div>
					<?php
						$_SESSION['employment_app']->form_start(3);
						echo '<p class="error-msg reg14 left20 top10">' . $_SESSION['employment_app']->error_messages . '</p><br/><br/>';
						foreach($active_semesters as $id => $name){
							print '<div style="float:left;">';
							$schedule_id = "schedule_".$id;
							print '<span style="color:#C01525; font-size:16px;"><strong>'. $name.'</strong></span><br />';
							print '<div style="float:left;">';
							print '<span  style="font-size:13px;">Number of hours you would prefer to work each week: </span>';
							$_SESSION['employment_app']->dropdown('hours_week'.$id, array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30), $_SESSION['employment_app']->application->schedules[$id]->hours_week);
							print '<br />';
							echo "<span style='padding-left:10px; font-size:10px;''>note: International students may only work 20 hours per week.</span>   <br/><br/>";
							print '<div id="schedule_'.$id.'" style="position:relative; margin-left:80px; margin-top:30px; width: 375px; height: 510px;"></div></div>';
							$_SESSION['employment_app']->hidden('semester_id', $id, 1);	
							print '</div>';
						}
						print '<br style="clear: both;" />';
					?>
					
					<div id="hidden" ></div>
					<input type="button" id="previous" name="previous" value="Previous" onclick="location.href='/employment/application/2.php';" >
					<?php $_SESSION['employment_app']->submit('Save and Continue'); ?>
					<?php $_SESSION['employment_app']->form_finish(3); ?>
				</div>
			</div>
		</div>

</div>
<?php  page_finish(); ?>  
