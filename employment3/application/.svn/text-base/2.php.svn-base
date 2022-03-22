<?php
// require_once ('../import_jobs.php');
require_once ('includes/studentapp.inc');
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
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<?php ob_start(); ?>
@import url("forms.css");
	ul{
		list-style:none;
	}
	.textbox{
		border:none;
		background-color:#FCF9D0;
	}
	p{
		font-size:13px;
		margin-top: 15px;
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
	.info_box{
		position:absolute; 
		z-index:1000; 
		background-color:#387D31; 
		color:#fff;
		left: 0px;
		display:none;
		padding: 5px;
		margin: 15px;
		font-size:11px;
		line-height:13px;
	
	}
	.more_info{
		color:#C01525;
		cursor:pointer;
		text-decoration:underline;
	}
	label{
		font-size:12px;
		vertical-align:baseline;
	}
	input, label, span{
		margin-top:0px;
		margin-bottom:0px;
		padding-top:0px;
		padding-bottom:0px;
		
	}
	.remove{
		color:#387D31;
		text-decoration:underline;
		font-size:11px;
		cursor:pointer;
	}
	#shadow{
		background-color:#000000;
		opacity: .75; 
		filter:alpha(opacity=75);
		display:none;
		position:absolute;
		top:0;
		left:0;
		margin:0px;
		padding:0px;
		z-index:100;
		height:3000px;
		width:3000px;
	
	}
	.noscroll{
		overflow:hidden;
	}
	#scrollbox{
		overflow:auto;
		top:0;
		left:0;
		position:absolute;
		z-index:101;
		width:100%;
		height:100%;
		display:none;
		
	}
	.popup_box{
		background:white;
		position:absolute;
		width:600px;
		height:480px;
		left:50%;
		margin-left:-300px;
		top:50%;
		margin-top:-240px;						
		display:none;
		padding:15px;
		border:5px solid #999999;
		z-index:102;
	}

<?php
$page_options['styles'] = ob_get_clean();
ob_start();
?>

$(document).ready(function(){
	$('input:radio[name=redistribute]').click(function(){
		switch($(this).val()){
			case "area":
				$('input:checkbox[value=1]').attr('disabled',false);
				$('input:checkbox[value=2]').attr('disabled',false);
				$('input:checkbox[value=3]').attr('disabled',false);
				$('input:checkbox[value=4]').attr('disabled',false);
			break;
			case "position":
				$('input:checkbox[value=1]').attr({disabled:true});
				$('input:checkbox[value=2]').attr({disabled:true});
				$('input:checkbox[value=3]').attr({disabled:true});
				$('input:checkbox[value=4]').attr({disabled:true});
			break;
			case "any":
				$('input:checkbox').attr({disabled:true});
			break;
			case "unit":

			break;
		}
	});


});

<?php
	$page_options['scripts'] = ob_get_clean();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Arizona Student Union employee application:';
	$page_options['header_image'] = 'images/student_employment.png';
	page_start($page_options);
?>
<div style="padding-left:0px; width:100%; z-index:1000; position:relative; top:-10;">
		
        <div style="margin-top:15px; width:950px;">
        	<div style="float:left; width:75px;">
        		<?php
				switch($_SESSION['employment_app']->stage){
					case 3:
				?>
        			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                    <img class="cloud active" src="images/2_red.gif" onclick="window.location='./2.php'"/>
                    <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                    <img class="cloud" src="images/4_grey.gif" />
                    <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;  
					
					case 4:
				?>
        			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                    <img class="cloud active" src="images/2_red.gif" onclick="window.location='./2.php'"/>
                    <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                    <img class="cloud active" src="images/4_green.gif" onclick="window.location='./4.php'"/>
                    <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;  
					
					case 5:
				?>
        			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                    <img class="cloud active" src="images/2_red.gif" onclick="window.location='./2.php'"/>
                    <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                    <img class="cloud active" src="images/4_green.gif" onclick="window.location='./4.php'"/>
                    <img class="cloud active" src="images/5_green.gif" onclick="window.location='./5.php'"/>
                <?php
					break;  
				
					default:
				?>
        			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                    <img class="cloud active" src="images/2_red.gif" onclick="window.location='./2.php'"/>
                    <img class="cloud" src="images/3_grey.gif" />
                    <img class="cloud" src="images/4_grey.gif" />
                    <img class="cloud" src="images/5_grey.gif" />
                <?php
					break; 
				}			
				?>
            	
			</div>

			<div style="float:left; margin-left:30px; width:840px;">

				<div>
            		<img src="images/where_to_work.gif" /><br>
                    In order to provide you with the best student job opportunities available to you, please choose one of the following three options which best describes you.<br>
                   		<?php print '<p>' . $_SESSION['employment_app']->error_messages . '</p>'; ?>
                </div>

				<div style="background-color:#D2E5CA; padding: 1px 0px 15px 15px;">

					<div style="padding: 15px 0;">
						<? $_SESSION['employment_app'] -> form_start(2); ?>
						
						<div style="width:30%;margin:0 1.5%;float:left;">
							<section>
								<h1 style="color:red;">Option #1</h1>
								<?php $_SESSION['employment_app'] -> radio('redistribute', 'unit', $_SESSION['employment_app']->application->applying_for->type); ?><strong>I want to work in the following unit(s): </strong>
								<?php 
									$units = $_SESSION['employment_app']->get_units();
									// print_r($units);
									asort($units);
									echo '<ul >';
									foreach ($units as $id => $unit) {
										echo '<li>';
										 $_SESSION['employment_app']->checkbox('unit', $id, $_SESSION['employment_app']->application->applying_for->unit_ids,($unit['accept'] == 0 ? "disabled" : ""));
										echo $unit['title'] . ($unit['accept'] == 0 ? " - Not accepting applications" : "") . '</li>';
									}
									echo '</ul>';
								?>
							</section>
						</div>
						<div style="width:30%;margin:0 1.5%;float:left;">
							<h1 style="color:red;">Option #2</h1>
							<section>
								<?php $_SESSION['employment_app'] -> radio('redistribute', 'position', $_SESSION['employment_app']->application->applying_for->type); ?><strong>I want to work in the following positions: </strong>
								<br/>
								<?php 
									$positions = $_SESSION['employment_app']->get_positions();

									if ((count($positions) == 0)) {
										print '<p class="bold14" >No Job Listings available at this time.</p>';
									} else {
										foreach ($positions as $id=>$position) {
											$todayDate = new DateTime();
											// set hours, minutes and seconds to zero
											$todayDate -> setTime(0, 0, 0);
											$startTime = new DateTime($position['Job_PostingDate']);
											$endTime = new DateTime($position['Job_EndDate']);
											// Verify that opening is to be currently displayed (i.e. within the date range).
											if (($startTime <= $todayDate) && ($todayDate <= $endTime) && ($position['unit_id'] !== 0)) {
												$_SESSION['employment_app'] -> checkbox('position', $position['Job_ID'], array_keys($_SESSION['employment_app']->application->applying_for->position_ids));
												$start_pos = 0;
												$start_pos = strpos($position['Job_Description'], 'SUMMARY:');
												if ($start_pos > 0) {
													$start_pos += 8;
												}
												if ($start_pos == 0) {
													$start_pos = strpos($position['Job_Description'], 'Description:');
													if ($start_pos > 0) {
														$start_pos += 12;
													}
												}
												$short_desc = strip_tags(substr($position['Job_Description'], $start_pos, 390));
												$title = $position['Job_JobTitle'] . ' - ' . $position['Employer_Division'];
												$short_title = strip_tags(substr($title, 0, 70));
												echo "<label>" . $short_title . ": <a class='more_info' href='/employment/available.php?job_index=".$position['Job_ID']."' target='_blank'>more info</a></label><br/>";
											}
										}
									}
								?>
							</section>
						</div>

<!-- 						<div style="width:30%;margin:0 1.5%;float:left;">
							<h1 style="color:red;">Option #2</h1>
							<?php $_SESSION['employment_app'] -> radio('redistribute', 'area', $_SESSION['employment_app']->application->applying_for->type); ?>
							<strong>I want to work in the following areas: </strong>
							<?php $areas = $_SESSION['employment_app']->get_areas();
								echo "<ul style='margin:20px 25px;''>";
								foreach($areas as $key => $value){
									echo "<li style='margin-bottom:2px;'>"; 
									$_SESSION['employment_app'] -> checkbox('area', $key, $_SESSION['employment_app']->application->applying_for->area_ids);
									echo "<label>" . $value . "</label></li>";
								}
								echo "</ul>";
							?>
						</div> -->
						
						<div style="width:30%;margin:0 1.5%;float:left;">
							<h1 style="color:red;">Option #3</h1>
							<?php $_SESSION['employment_app'] -> radio('redistribute', 'any', $_SESSION['employment_app']->application->applying_for->type); ?><label for="redistribute" ><strong>I want to work anywhere in the Union </strong><span class="more_info" onmouseover="document.getElementById('op1').style.display='block';" onmouseout="document.getElementById('op1').style.display='none';">more info</span></label>
						</div>
					</div>
					<div style="clear:both"></div>
					
				</div>
				<input type="button" id="previous" name="previous" value="Previous" onclick="location.href='/employment/application/1.php';" >
					<?php $_SESSION['employment_app'] -> submit('Save and Continue'); ?>
					<?php $_SESSION['employment_app'] -> form_finish(2); ?>

			</div>
		</div>

<?php  page_finish(); ?>
