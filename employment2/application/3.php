<?php
	session_start();
	
	if(!isset($_SESSION['app_id'])){
    header("Location: ./start.php");
    exit;
  }
  
	require('application_db.inc');	
	
	if($_POST['submit2'] == 'Save and Continue'){
		
		//Register variables from previous page
		$_SESSION['redistribute']	= $_POST['redistribute'];
					
		if(!$_POST['redistribute']) {
			$_SESSION['error_msg2'] = 'You must choose one of the options';
			header("Location: ./2.php");
		}
		else{
			unset($_SESSION['error_msg2']);
		}
			

		if($_POST['redistribute'] == 'position'){
		
			$_SESSION['specificpos'] = $_POST["specificpos"];
			$_SESSION['specificposnum'] = $_POST["specificposnum"];
			unset($_SESSION['Dining']	);
			unset($_SESSION['CSIL']);
			unset($_SESSION['Retail']);
			unset($_SESSION['Operations']);
		}
		
		elseif($_SESSION['redistribute'] == 'area'){
			$_SESSION['Dining']		= $_POST["Dining"];
			$_SESSION['CSIL']		= $_POST["CSIL"];
			$_SESSION['Retail']		= $_POST["Retail"];
			$_SESSION['Operations']		= $_POST["Operations"];	
			unset($_SESSION['specificpos']);
			unset($_SESSION['specificposnum']);
				
		}
		
		else{
			unset($_SESSION['specificpos']);
			unset($_SESSION['specificposnum']);
			unset($_SESSION['Dining']	);
			unset($_SESSION['CSIL']);
			unset($_SESSION['Retail']);
			unset($_SESSION['Operations']);
			
		}
		db_query('delete from app_history where studentID='.$_SESSION['app_id'].' and phase="0"');
		db_query('delete from checked_out where studentID='.$_SESSION['app_id'].' and phase=0');
		if(is_array($_SESSION['specificpos'])){
			$specific_loc =implode(", ",$_SESSION['specificpos']);
			
			foreach($_SESSION['specificpos'] as $key => $title){
				if($_SESSION['specificposnum'][$key] != ''){
					//check to see if app has already been declined from unit
					$query = 'select * from checked_out where phase=7 and studentID='.$_SESSION['app_id'].' and unit='.$_SESSION['specificposnum'][$key];
					
					$result = db_query($query);
					
					if(mysql_num_rows($result)==0){
						$query = 'insert into checked_out set studentID='.$_SESSION['app_id'].', unit='.$_SESSION['specificposnum'][$key].', manager_checked_out="'.substr($title, 0, 49).'", phase=0, phase_date="'.date("Y-m-d").'", done=0';
						db_query($query);
					}
					$query = 'insert into app_history set studentID='.$_SESSION['app_id'].', unit='.$_SESSION['specificposnum'][$key].', phase_info="'.trim($title).'", phase="0", phase_date="'.date("Y-m-d").'"';
					db_query($query);
				}
			}
		}
		
			
				
		$query = 'update application set '.
				 'redistribute="'.$_SESSION['redistribute'].'", '.
				 'specific_location="'.$specific_loc.'", '.
				 'area1="'.$_SESSION['Dining'].'", '.
				 'area3="'.$_SESSION['CSIL'].'", '.
				 'area2="'.$_SESSION['Retail'].'", '.
				 'area4="'.$_SESSION['Operations'].'" '.
				 'where studentID="'.$_SESSION['app_id'].'"';
				 
		//print $query;
		db_query($query);
		//print mysql_error($DBlink);
		
		if($_SESSION['stage']<3){
			$_SESSION['stage']=3;
			db_query("update student set stage=3 where ID='".$_SESSION['app_id']."'");
		}
	}
	
	
	
	


	
	
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
$page_options['script_incs'] = array('schedule.js');

ob_start();
?>
function save_schedule(){
//alert(document.schedule_form.work_hoursFall_08.options.selectedIndex);
for(var i in instances){
//document.schedule_form.innerHTML += '<input type="hidden" name="semester[]" value="'+instances[i]+'">';
//alert(document.schedule_form.work_hoursFall_08.options.selectedIndex);
document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][0]" value="'+schedule[i][0][0]+'">';
document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][1]" value="'+schedule[i][0][1]+'">';
document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][2]" value="'+schedule[i][0][2]+'">';
document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][3]" value="'+schedule[i][0][3]+'">';
document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][4]" value="'+schedule[i][0][4]+'">';
document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][5]" value="'+schedule[i][0][5]+'">';
document.getElementById('hidden').innerHTML += '<input type="hidden" name="schedule['+instances[i]+'][6]" value="'+schedule[i][0][6]+'">';
}
//alert(document.schedule_form.work_hoursFall_08.options.selectedIndex);
document.getElementById('hidden').innerHTML += '<input type="hidden" name="allschedules" value="'+schedule+'">';


//alert(document.schedule_form.work_hoursFall_08.options.selectedIndex);
form_submit();
//document.schedule_form.submit();
return true;
}

function form_submit(){
document.schedule_form.submit();  
}

function load_scheduletool(){
  <?php $query = 'select title from semester where start_hiring<="'.date("Y-m-d").'" and end_hiring>="'.date("Y-m-d").'"';
                $result = db_query($query);
        
        if($_SESSION['allschedules']){
          print 'schedule='.$_SESSION['allschedules'].";";
        }
                      
                
                while($semester = mysql_fetch_assoc($result)){
          if($_SESSION['allschedules']){
            print 'init( \''.$semester['title'].'table\', \'vertical\', 1, 26, 26, 16, 7, 2, 16, \'\', \'\', 1, 1);';
          }
          else{
            print 'init( \''.$semester['title'].'table\', \'vertical\', 1, 26, 26, 16, 7, 2, 16, \'\', \'\', 1, 0);';
          }
          
          print 'init( \''.$semester['title'].'table\', \'vertical\', 1, 26, 26, 24, 7, 2, 0, \'\', \'\', 0);';
        }
  ?>
}
<?php
$page_options['scripts'] = ob_get_clean();
$page_options['onload'] = 'load_scheduletool()';
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Arizona Student Union employee application:';
  $page_options['header_image'] = 'images/student_employment.png';
  page_start($page_options);
?>



<body onLoad="load_scheduletool();">
<div style="padding-left:0px; width:100%; z-index:2; ">
	
        <div style="margin-top:10px; width:1100px;">
        	<div style="float:left; width:75px;">
            	<?php
				switch($_SESSION['stage']){
					
                       
					
					 
					
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
					<? if( isset($_SESSION['error_msg3'])) {
                            print '<span class="error_message">' . $_SESSION['error_msg3'] . '</span>';
                        }
                    ?>
                    <p>
                   		<strong style="font-size:14px;">Click and drag through areas when you are able to work</strong>. Blocks can be erased by clicking on them again. Please enter your schedule to the <strong style="font-size:14px;">nearest half hour.</strong>
                	</p>
                                  	
                </div><br>
                <div>
                	 <form name="schedule_form" action="4.php" enctype="multipart/form-data" method="post">
                     	<?php
                                $query = 'select title, name from semester where start_hiring<="'.date("Y-m-d").'" and end_hiring>="'.date("Y-m-d").'"';
                                $result = db_query($query);
                                $i=0;
                                while($semester = mysql_fetch_assoc($result)){
                                    print '<div style="float:left; width:460px;">';
                                    print '<input type="hidden" name="semesters[]" value="'.$semester['title'].'">';
                                   
                                   	print '<span style="color:#C01525; font-size:16px;"><strong>'.$semester['title']."</strong></span><br>";?>
                                    
                                   	<span style="font-size:13px;">Number of hours you would prefer to work each week: </span>
                        
                   					<select name="work_hours<?php print $semester['title']; ?>">
                                        <option value=""></option>
                                        <option value="1"  <?php print $_SESSION['work_hours'.$semester['title']]==1  ?  'selected':  ''; ?>>1</option>
                                        <option value="2"  <?php print $_SESSION['work_hours'.$semester['title']]==2  ?  'selected':  ''; ?>>2</option>
                                        <option value="3"  <?php print $_SESSION['work_hours'.$semester['title']]==3  ?  'selected':  ''; ?>>3</option>
                                        <option value="4"  <?php print $_SESSION['work_hours'.$semester['title']]==4  ?  'selected':  ''; ?>>4</option>
                                        <option value="5"  <?php print $_SESSION['work_hours'.$semester['title']]==5  ?  'selected':  ''; ?>>5</option>
                                        <option value="6"  <?php print $_SESSION['work_hours'.$semester['title']]==6  ?  'selected':  ''; ?>>6</option>
                                        <option value="7"  <?php print $_SESSION['work_hours'.$semester['title']]==7  ?  'selected':  ''; ?>>7</option>
                                        <option value="8"  <?php print $_SESSION['work_hours'.$semester['title']]==8  ?  'selected':  ''; ?>>8</option>
                                        <option value="9"  <?php print $_SESSION['work_hours'.$semester['title']]==9  ?  'selected':  ''; ?>>9</option>
                                        <option value="10" <?php print $_SESSION['work_hours'.$semester['title']]==10 ?  'selected':  ''; ?>>10</option>
                                        <option value="11" <?php print $_SESSION['work_hours'.$semester['title']]==11 ?  'selected':  ''; ?>>11</option>
                                        <option value="12" <?php print $_SESSION['work_hours'.$semester['title']]==12 ?  'selected':  ''; ?>>12</option>
                                        <option value="13" <?php print $_SESSION['work_hours'.$semester['title']]==13 ?  'selected':  ''; ?>>13</option>
                                        <option value="14" <?php print $_SESSION['work_hours'.$semester['title']]==14 ?  'selected':  ''; ?>>14</option>
                                        <option value="15" <?php print $_SESSION['work_hours'.$semester['title']]==15 ?  'selected':  ''; ?>>15</option>
                                        <option value="16" <?php print $_SESSION['work_hours'.$semester['title']]==16 ?  'selected':  ''; ?>>16</option>
                                        <option value="17" <?php print $_SESSION['work_hours'.$semester['title']]==17 ?  'selected':  ''; ?>>17</option>
                                        <option value="18" <?php print $_SESSION['work_hours'.$semester['title']]==18 ?  'selected':  ''; ?>>18</option>
                                        <option value="19" <?php print $_SESSION['work_hours'.$semester['title']]==19 ?  'selected':  ''; ?>>19</option>
                                        <option value="20" <?php print $_SESSION['work_hours'.$semester['title']]==20 ?  'selected':  ''; ?>>20</option>
                                        <option value="21" <?php print $_SESSION['work_hours'.$semester['title']]==21 ?  'selected':  ''; ?>>21</option>
                                        <option value="22" <?php print $_SESSION['work_hours'.$semester['title']]==22 ?  'selected':  ''; ?>>22</option>
                                        <option value="23" <?php print $_SESSION['work_hours'.$semester['title']]==23 ?  'selected':  ''; ?>>23</option>
                                        <option value="24" <?php print $_SESSION['work_hours'.$semester['title']]==24 ?  'selected':  ''; ?>>24</option>
                                        <option value="25" <?php print $_SESSION['work_hours'.$semester['title']]==25 ?  'selected':  ''; ?>>25</option>
                                        <option value="26" <?php print $_SESSION['work_hours'.$semester['title']]==26 ?  'selected':  ''; ?>>26</option>
                                        <option value="27" <?php print $_SESSION['work_hours'.$semester['title']]==27 ?  'selected':  ''; ?>>27</option>
                                        <option value="28" <?php print $_SESSION['work_hours'.$semester['title']]==28 ?  'selected':  ''; ?>>28</option>
                                        <option value="29" <?php print $_SESSION['work_hours'.$semester['title']]==29 ?  'selected':  ''; ?>>29</option>
                                        <option value="30" <?php print $_SESSION['work_hours'.$semester['title']]==30 ?  'selected':  ''; ?>>30</option>
                    				</select><br>
                                    <span style="padding-left:10px; font-size:10px;">note: International students may only work 20 hours per week.</span>
                                    <br><br>
                    			<?php
                                    print '<div id="'.$semester['title'].'table1">';
                                   
                                   		print '<span style="color:#387D31; text-decoration:underline; cursor:pointer; margin-left:230px; font-size:12px; font-weight:bold;" onclick="reset_s(\''.$semester['title'].'table\')">clear</span>';
                                    	print '<div id="'.$semester['title'].'table" class="schedule" style="width:375px; height:650px; position:relative; margin-top:30px; margin-left:80px; "></div>';
                                   
                                    	print '</div>';
										
                                    print '</div>';
                                    
                                    
                                $i++;
								
                                }
                                
                            ?>
							<div id="hidden" style="clear:both; padding-top:5px; margin-left:<?php print $i==1? 200: 525;?>px;">
                                <input type="hidden" name="submit3" value="Save and Continue">
                                <input type="button" value="Save and Continue" onClick="save_schedule();">
                            </div>
	                  	</form>
                 	</div>
            	</div>
          	</div>
</div>
<?php  page_finish(); ?>                      