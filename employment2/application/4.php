<?php
	session_start();
  
  if(!isset($_SESSION['app_id'])){
    header("Location: ./start.php");
    exit;
  }
  
    require('application_db.inc');
    
	if($_POST['submit3']=='Save and Continue'){
	
		
	
		$_SESSION['semesters'] = $_POST['semesters'];
		
		if(sizeof($_POST['semesters'])==2){
		
			$_SESSION['allschedules'] = '[[[['.substr($_POST['allschedules'],0,95).'],['.substr($_POST['allschedules'], 96, 95).'],['.substr($_POST['allschedules'], 192,95).'],['.substr($_POST['allschedules'], 288,95).'],['.substr($_POST['allschedules'], 384,95).'],['.substr($_POST['allschedules'], 480,95).'],['.substr($_POST['allschedules'], 576,95).']]],[[['.substr($_POST['allschedules'], 672,95).'],['.substr($_POST['allschedules'], 768,95).'],['.substr($_POST['allschedules'], 864,95).'],['.substr($_POST['allschedules'], 960,95).'],['.substr($_POST['allschedules'], 1056,95).'],['.substr($_POST['allschedules'], 1152,95).'],['.substr($_POST['allschedules'],1248,95).']]]]';
			
		}
		else{
		
			$_SESSION['allschedules'] = '[[[['.substr($_POST['allschedules'],0,95).'],['.substr($_POST['allschedules'], 96, 95).'],['.substr($_POST['allschedules'], 192,95).'],['.substr($_POST['allschedules'], 288,95).'],['.substr($_POST['allschedules'], 384,95).'],['.substr($_POST['allschedules'], 480,95).'],['.substr($_POST['allschedules'], 576,95).']]]]';
		
		}
		
		
		
		$empty = 0;
		
		foreach($_POST['semesters'] as $semester){
				
				$temp3=0;
			
				$temp = str_replace(',', '', $_POST['schedule'][$semester.'table'][0]);
				$_SESSION[$semester]['mon']  = bindec(substr($temp, 0, 24));
				$_SESSION[$semester]['mon1'] = bindec(substr($temp, 24));
				
				$temp = str_replace(',', '', $_POST['schedule'][$semester.'table'][1]);
				$_SESSION[$semester]['tue']  = bindec(substr($temp, 0, 24));
				$_SESSION[$semester]['tue1'] = bindec(substr($temp, 24));
				
				$temp = str_replace(',', '', $_POST['schedule'][$semester.'table'][2]);
				$_SESSION[$semester]['wed']  = bindec(substr($temp, 0, 24));
				$_SESSION[$semester]['wed1'] = bindec(substr($temp, 24));
				
				$temp = str_replace(',', '', $_POST['schedule'][$semester.'table'][3]);
				$_SESSION[$semester]['thu']  = bindec(substr($temp, 0, 24));
				$_SESSION[$semester]['thu1'] = bindec(substr($temp, 24));
				
				$temp = str_replace(',', '', $_POST['schedule'][$semester.'table'][4]);
				$_SESSION[$semester]['fri']  = bindec(substr($temp, 0, 24));
				$_SESSION[$semester]['fri1'] = bindec(substr($temp, 24));
				
				$temp = str_replace(',', '', $_POST['schedule'][$semester.'table'][5]);
				$_SESSION[$semester]['sat']  = bindec(substr($temp, 0, 24));
				$_SESSION[$semester]['sat1'] = bindec(substr($temp, 24));
				
				$temp = str_replace(',', '', $_POST['schedule'][$semester.'table'][6]);
				$_SESSION[$semester]['sun']  = bindec(substr($temp, 0, 24));
				$_SESSION[$semester]['sun1'] = bindec(substr($temp, 24));
				
				foreach($_SESSION[$semester] as $temp2){
					$temp3 += $temp2;
				}
				
				if($temp3 == 0){
					$empty++;
				}
				else{
					unset($_SESSION['error_msg3']);
				}
				
				
				$_SESSION['work_hours'.$semester] = $_POST['work_hours'.str_replace(' ', '_', $semester)];
				//print str_replace(' ', '_', $semester);
				
				if($temp3 != 0 && $_POST['work_hours'.str_replace(' ', '_', $semester)]==''){
					$hours_error = 1;
				}
			
				$query = 'delete from schedule where semester="'.$semester.'" and studentID='.$_SESSION['app_id'];
				db_query($query);
				//print mysql_error($DBlink);
		    
		    if($_SESSION['work_hours'.$semester] == '')
          $_SESSION['work_hours'.$semester]=0;		
		
				$query = 'insert into schedule set '.
						 'studentID="'.$_SESSION['app_id'].'", '.
						 'semester="'.$semester.'", '.
						 'mon="'.$_SESSION[$semester]['mon'].'", '.
						 'mon2="'.$_SESSION[$semester]['mon1'].'", '.
						 'tue="'.$_SESSION[$semester]['tue'].'", '.
						 'tue2="'.$_SESSION[$semester]['tue1'].'", '.
						 'wed="'.$_SESSION[$semester]['wed'].'", '.
						 'wed2="'.$_SESSION[$semester]['wed1'].'", '.
						 'thu="'.$_SESSION[$semester]['thu'].'", '.
						 'thu2="'.$_SESSION[$semester]['thu1'].'", '.
						 'fri="'.$_SESSION[$semester]['fri'].'", '.
						 'fri2="'.$_SESSION[$semester]['fri1'].'", '.
						 'sat="'.$_SESSION[$semester]['sat'].'", '.
						 'sat2="'.$_SESSION[$semester]['sat1'].'", '.
						 'sun="'.$_SESSION[$semester]['sun'].'", '.
						 'sun2="'.$_SESSION[$semester]['sun1'].'", '.
						 'hours_week="'.$_SESSION['work_hours'.$semester].'"';
				//print $query;
				db_query($query);
				//print mysql_error($DBlink);
		}
		
		
		
		
	
			
		if($empty == sizeof($_SESSION['semesters'])){
				$_SESSION['error_msg3'] = "You must put available hours in for at least one semester.";
				header("Location: ./3.php");
		}
		
		if($hours_error == 1){
				$_SESSION['error_msg3'] = "You must put hours per week in for at least one semester.";
				header("Location: ./3.php");
		}
		
		if($_SESSION['stage']<4){
			$_SESSION['stage']=4;
			db_query("update student set stage=4 where ID='".$_SESSION['app_id']."'");
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
					.textbox{
						background-color:#FCF9D0;
						border:none;
						width:100%;
					}
					.label{
						font-size:13px;
						width:1px;
						padding-right:10px;
						white-space: nowrap;
					}
					 td #form4{
						width:auto;
						white-space: nowrap;
						
					}
					textarea{
						resize:none;
					}
					 #saved_jobs p{
						color:#C01525;
						font-size:13px;
					}
					#saved_jobs p span{
						color:green;
						text-decoration:underline;
						cursor:pointer;
					}
<?php
$page_options['styles'] = ob_get_clean();

ob_start();
?>
  var jobs = [];
  
  var current_profile=-1;
  
  
function prev_job_profile(com_name, addr, add2, phone, super_name, duties, fm, fy, tm, ty, pay, leaving, id){

  this.company = com_name;
  this.address = addr;
  this.city_state_zip = add2;
  this.phone_number = phone;
  this.supervisor_name = super_name;
  this.job_duties = duties;
  this.fromm = fm;
  this.fromy = fy;
  this.tom = tm;
  this.toy = ty;
  this.pay_rate = pay;
  this.reason_leave = leaving;
  this.id = id;
  this.add_profile = add_profile;
  this.remove_profile = remove_profile;
  this.load_profile = load_profile;
  this.save_profile = save_profile;
}

function add_profile(){
  
  document.getElementById('saved_jobs').innerHTML += '<p><span style="float:right; margin-right:25px;" onclick="jobs['+this.id+'].load_profile();">edit</span>'+(this.id+1)+') '+this.company+'</p>'; 

}

function remove_profile(){
  var i=0;
  
  while(jobs[i] != this){
    i++;
  }
  
  jobs.splice(i, 1);
  
  while(jobs[i]){
    jobs[i++].id--;
  }
  document.getElementById('saved_jobs').innerHTML = '';
  i=0;
  while(jobs[i]){
    jobs[i++].add_profile();
  }
  
   document.page5[3].value = '';
   document.page5[4].value = '';
   document.page5[5].value ='';
   document.page5[6].value = '';
   document.page5[7].value = '';
   document.page5[8].value = '';
   document.page5[9].options.selectedIndex = 0;
   document.page5[10].options.selectedIndex = 0;
   document.page5[11].options.selectedIndex = 0;
   document.page5[12].options.selectedIndex = 0;
   document.page5[13].value = '';
   document.page5[14].value = '';
   
   
   document.getElementById('save_changes').style.display = 'none';
   
   current_profile = -1;

}

function load_profile(){

   document.page5[3].value = this.company;
   document.page5[4].value = this.address;
   document.page5[5].value = this.city_state_zip;
   document.page5[6].value = this.phone_number;
   document.page5[7].value = this.supervisor_name;
   document.page5[8].value = this.job_duties;
   document.page5[9].options.selectedIndex = this.fromm;
   document.page5[10].options.selectedIndex = this.fromy;
   document.page5[11].options.selectedIndex = this.tom;
   document.page5[12].options.selectedIndex = this.toy;
   document.page5[13].value = this.pay_rate;
   document.page5[14].value = this.reason_leave;
   
  
  current_profile = this.id;
   
   document.getElementById('save_changes').style.display = 'block';
  
  }

function save_profile(){

  

  this.company =  document.page5[3].value;
  this.address =  document.page5[4].value;
  this.city_state_zip =  document.page5[5].value;
  this.phone_number =  document.page5[6].value;
  this.supervisor_name =  document.page5[7].value;
  this.job_duties =  document.page5[8].value;
  this.fromm =  document.page5[9].options.selectedIndex;
  this.fromy =  document.page5[10].options.selectedIndex;
  this.tom =  document.page5[11].options.selectedIndex;
  this.toy =  document.page5[12].options.selectedIndex;
  this.pay_rate = document.page5[13].value;
  this.reason_leave = document.page5[14].value; 
  
   document.page5[3].value = '';
   document.page5[4].value = '';
   document.page5[5].value ='';
   document.page5[6].value = '';
   document.page5[7].value = '';
   document.page5[8].value = '';
   document.page5[9].options.selectedIndex = 0;
   document.page5[10].options.selectedIndex = 0;
   document.page5[11].options.selectedIndex = 0;
   document.page5[12].options.selectedIndex = 0;
   document.page5[13].value = '';
   document.page5[14].value = '';
  
  document.getElementById('save_changes').style.display = 'none';
  current_profile = -1;

}



function save_work_history(){

  if(current_profile == -1){
  
  jobs.push(new prev_job_profile( document.page5[3].value,  document.page5[4].value,  document.page5[5].value,  document.page5[6].value,  document.page5[7].value,  document.page5[8].value,  document.page5[9].options.selectedIndex,  document.page5[10].options.selectedIndex,  document.page5[11].options.selectedIndex,  document.page5[12].options.selectedIndex, document.page5[13].value, document.page5[14].value, jobs.length));
  
  jobs[jobs.length-1].add_profile();
  }
  else{
    jobs[current_profile].save_profile();
  }


   document.page5[3].value = '';
   document.page5[4].value = '';
   document.page5[5].value ='';
   document.page5[6].value = '';
   document.page5[7].value = '';
   document.page5[8].value = '';
   document.page5[9].options.selectedIndex = 0;
   document.page5[10].options.selectedIndex = 0;
   document.page5[11].options.selectedIndex = 0;
   document.page5[12].options.selectedIndex = 0;
   document.page5[13].value = '';
   document.page5[14].value = '';
return true;  

} 


  
function submit_page5(){
    if(document.page5[3].value != ''){
      save_work_history();
    }
  
  var allofthem='';
  //alert(jobs.length);
  for(i=0; i<jobs.length; i++){ 
    allofthem += '<input type="hidden" name="com_name['+(i+1)+']" value="'+jobs[i].company.replace(/"/g,'&quot;')+'">';
    allofthem += '<input type="hidden" name="add1['+(i+1)+']" value="'+jobs[i].address.replace(/"/g,'&quot;')+'">';
    allofthem += '<input type="hidden" name="add2['+(i+1)+']" value="'+jobs[i].city_state_zip.replace(/"/g,'&quot;')+'">';
    allofthem += '<input type="hidden" name="phone['+(i+1)+']" value="'+jobs[i].phone_number.replace(/"/g,'&quot;')+'">';
    allofthem += '<input type="hidden" name="supervisor_name['+(i+1)+']" value="'+jobs[i].supervisor_name.replace(/"/g,'&quot;')+'">';
    allofthem += '<input type="hidden" name="textarea1['+(i+1)+']" value="'+jobs[i].job_duties.replace(/"/g,'&quot;')+'">';
    allofthem += '<input type="hidden" name="fromm['+(i+1)+']" value="'+jobs[i].fromm+'">';
    allofthem += '<input type="hidden" name="fromy['+(i+1)+']" value="'+jobs[i].fromy+'">';
    allofthem += '<input type="hidden" name="tom['+(i+1)+']" value="'+jobs[i].tom+'">';
    allofthem += '<input type="hidden" name="toy['+(i+1)+']" value="'+jobs[i].toy+'">';
    allofthem += '<input type="hidden" name="textarea3['+(i+1)+']" value="'+jobs[i].pay_rate.replace(/"/g,'&quot;')+'">';
    allofthem += '<input type="hidden" name="textarea4['+(i+1)+']" value="'+jobs[i].reason_leave.replace(/"/g,'&quot;')+'">';
    
    document.getElementById('save_changes').innerHTML += allofthem;
  }
  
  document.page5.submit();

return true;  
}
<?php
$page_options['scripts'] = ob_get_clean();
  			
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Arizona Student Union employee application:';
  $page_options['header_image'] = 'images/student_employment.png';
  page_start($page_options);
?>



<div style="padding-left:0px; width:100%; z-index:2; position:relative; top:-10;">
	
    <div style="margin-top:15px; width:950px;">
      	<div style="float:left; width:75px;">
           	<?php
				switch($_SESSION['stage']){
					
              
					case 5:
			?>
    	           			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                            <img class="cloud active" src="images/4_red.gif" onclick="window.location='./4.php'"/>
                            <img class="cloud active" src="images/5_green.gif" onclick="window.location='./5.php'"/>
             <?php
					break;  
				
					default:
        	 ?>
                			<img class="cloud active" src="images/1_green.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                            <img class="cloud active" src="images/4_red.gif" onclick="window.location='./4.php'"/>
                            <img class="cloud" src="images/5_grey.gif" />
             <?php
					break; 
				}			
			 ?>
      	</div>
        <div style="float:left; margin-left:30px; width:800px;">
        	<div>
        		<img src="images/work_history.gif" />
                <p style="white-space:normal;">
                	Please give work history information either by submitting a resume(preferred) or by filling in past job history in the fields provided. You may also check "I do not wish to submit any work history at this time". Then click "Save and Continue" to proceed to the next step of the application.
                </p>
            </div><br />
           	<div style="float:left; width:550px;">    
                <div id="f" style="background-color:#D2E5CA; width:525px; _width:545px; padding: 10px 10px 10px 10px;">
                	<table cellpadding="0" cellspacing="0" width="100%">
                    	<tr>
                        	<td style="width:auto; font-size:13px;">
                            	<input type="checkbox" /> I do not have or wish to submit any work history at this time
                            </td>
                        </tr>
                    </table>                    
                </div>
                
                <form action="5.php" enctype="multipart/form-data" method="post" name="page5" >
				
                <div style="font-size:14px; margin:10px 0 10px 0;">
                	OR
                </div>
                
                <div id="formdiv" style="background-color:#D2E5CA; width:525px; _width:545px; padding: 10px 10px 10px 10px;">
                	<span style="font-size:14px; font-weight:bold;">
                    	Resume
                    </span>
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="width:auto; font-size:13px;">
                                Please choose a .doc, .txt, or .pdf file to submit.
                            <td>
                                <input name="userfile" type="file" id="userfile" style="float:right;">
                                <?php
                               // $DBlink =   mysql_connect("trinity.sunion.arizona.edu","web","viv3nij");
                                //mysql_select_db("unions_app", $DBlink);
                                $query = 'SELECT resume_type FROM application WHERE studentID="'.$_SESSION['app_id'].'"';
                                $result = db_query($query);
                                $result = mysql_fetch_assoc($result);
                                $result = $result['resume_type'];
                                if ($result!=NULL) {
                                  echo '<div style="color:#D12125;font-weight:bold;width:100%;text-align:right;">Resume previously uploaded.</div>';
                                }
                                ?>
                            </td>
                            </td>
                        </tr>
                    </table>                    
                </div>                
                
                <div style="font-size:14px; margin:10px 0 10px 0;">
                	OR
                </div>
                
                <div id="form4" style="background-color:#D2E5CA; width:525px; _width:545px; padding: 10px 10px 10px 10px;">
	            	<span style="font-size:14px; font-weight:bold;">
                    	Present/Past Work History
                    </span>
                 	<div id="save_changes" style="display:none;">
                    	<input id="delete" type="button" value="remove" onclick="jobs[current_profile].remove_profile();" style="float:right;">
                        <input id="save" type="button" value="save changes" onclick="jobs[current_profile].save_profile();" style="float:right;" /><br />
                 	</div>
                 	<p>
                    	<table cellpadding="0" cellspacing="0px" width="100%">
                        	<tr>
                            	<td class="label">Company:</td>
                            	<td><input name="com_name[0]" class="textbox" type="text" id="com_name1" /></td>
                        	</tr>
                      	</table>
                  	</p>
                  	<p>
                      	<table cellpadding="0" cellspacing="0px" width="100%">         
                           	<tr>
                                <td class="label"> Address:</td>          
                                <td><input type="text" name="add1[0]" class="textbox" id="add1"  /></td>
                           	</tr>
                       	</table>
                   	</p>
                   	<p>
                       <table cellpadding="0" cellspacing="0px" width="100%">
                           <tr>   
                                    <td class="label">City/State/Zip:</td>       
                                    <td><input type="text" name="add2[0]" class="textbox" id="add12"  /></td>
                          </tr>
                       </table>
                   </p>
                   <p>
                       <table cellpadding="0" cellspacing="0px" width="100%">
                       		<tr>          
                                	<td class="label">Phone#:</td>      
                                	<td><input type="text" name="phone[0]" class="textbox" id="phone1"/></td>
                      		</tr>
                       </table>
                   </p>
                   <p>
                      <table cellpadding="0" cellspacing="0px" width="100%"><tr>          
                                <td class="label" style="width:1px;"><div style="overflow:visible; _width:120px;">Supervisor Name:</div></td>
                                <td><input type="text" class="textbox" name="supervisor_name[0]" id="supervisor_name1" /></td>
                      </tr></table>
                   </p>
                   <p>
                      <table cellpadding="0" cellspacing="0px" width="100%"><tr>   
                                 <td class="label" valign="top">Duties:</td>
                                 <td><textarea name="textarea1[0]" class="textbox" id="textarea1"  rows="3" wrap=soft onBlur="if(this.value.length>250){ alert('Too Long('+this.value.length+'). 250 character maximum.'); this.focus();}" style="overflow:hidden;" locked></textarea></td>
                      </tr></table>
                   </p>
                   <p>
                      <table cellpadding="0" cellspacing="0px" width="100%"><tr>
                     <td style="font-size:13px; width:60%;" >Employed From: <select name="fromm[0]">
                                        <option></option>
                                        <option>January</option>
                                        <option>Feburary</option>
                                        <option>March</option>
                                        <option>April</option>
                                        <option>May</option>
                                        <option>June</option>
                                        <option>July</option>
                                        <option>August</option>
                                        <option>September</option>
                                        <option>October</option>
                                        <option>November</option>
                                        <option>December</option>
                                    </select>
                                    <select name="fromy[0]">
                                    <option></option>
									<?php
									$year_options = '';
									$year = (int)date('Y');
									for($x=0; $x <= ($year-1980); $x++)
										$year_options .= '<option>'.(1980+$x).'</option>';
                                    print $year_options;
									?>
                                  </select></td>
                                    
                    <td style="width:40%; font-size:13px;">
                    <span style="float:right;">
                    To: <select name="tom[0]">
                    <option></option>
                                        <option>January</option>
                                        <option>Feburary</option>
                                        <option>March</option>
                                        <option>April</option>
                                        <option>May</option>
                                        <option>June</option>
                                        <option>July</option>
                                        <option>August</option>
                                        <option>September</option>
                                        <option>October</option>
                                        <option>November</option>
                                        <option>December</option>
                                    </select>
                                    <select name="toy[0]">
                                    <option></option>
                                        <?=$year_options?>
                                  </select></span></td>
           </tr></table>
           </p>
           <p>
           <table cellpadding="0" cellspacing="0px" width="100%"><tr>
                     <td class="label" style="width:1px;"><div style="overflow:visible; _width:100px;">Last Pay Rate:</div></td>
                     <td><textarea name="textarea3[0]" id="textarea3" class="textbox"  rows="1" wrap=soft onBlur="if(this.value.length>250) alert('Too Long('+this.value.length+'). 250 character maximum.');" style="height:15px; overflow:hidden;" locked></textarea></td>
           </tr></table>
           </p>
           <p>
           <table cellpadding="0" cellspacing="0px" width="100%"><tr>
                      <td class="label" style="width:1px;"><div style="overflow:visible; _width:135px;">Reason for Leaving:</div></td>
                      <td><textarea name="textarea4[0]" id="textarea4" class="textbox"  rows="1" wrap=soft onBlur="if(this.value.length>250) alert('Too Long('+this.value.length+'). 250 character maximum.');" style="height:15px; font-size:13px; line-height:15px; overflow:hidden;"></textarea></td>
                  </tr>
                  
     </table>
     		</p>
                  <p style="font-size:13px;">
                     <input type="button" value="add another employer" onclick="save_work_history(); document.getElementById('employers_popup').style.display='block';" />
                  </p>
                  
                  </div> 
                  <div style="width:545px;">
                      <input type="hidden" name="submit4" value="Save and Continue" />
                      <input type="button"  value="Save and Continue" style="float:right; margin-top:15px;" onclick="submit_page5();"/>
                  </div>
                  </form>
              </div>
              <div id="employers_popup" style="float:left; width:200px; margin-left:30px; margin-top:200px; <?php if(is_array($_SESSION['com_name'])){print 'display:block;';}else{print 'display:none;';} ?>">
                  	<img src="images/employers.gif" />
                    <div id="saved_jobs" style="background-image:url(images/employers_BOX.gif); background-repeat:no-repeat; width:180px; _width:195px; height:277px; padding:5px 0px 0px 15px;;">
                    <script type="text/javascript">
					<?php
					
					$_SESSION['com_name'][$i]=$_POST["com_name"][$i];
			$_SESSION['add1'][$i]=$_POST["add1"][$i];
			$_SESSION['add2'][$i]=$_POST["add2"][$i];
			$_SESSION['com_phone'][$i]=$_POST["phone"][$i];
			$_SESSION['supervisor_name'][$i]=$_POST["supervisor_name"][$i];
			$_SESSION['textarea1'][$i]=$_POST["textarea1"][$i];
			$_SESSION['fromm'][$i]=$_POST["fromm"][$i];
			$_SESSION['fromy'][$i]=$_POST["fromy"][$i];
			$_SESSION['tom'][$i]=$_POST["tom"][$i];
			$_SESSION['toy'][$i]=$_POST["toy"][$i];
			$_SESSION['textarea3'][$i]=$_POST["textarea3"][$i];
			$_SESSION['textarea4'][$i]=$_POST["textarea4"][$i];
					
					
					
					
					
						for($i=1; $i<sizeof($_SESSION['com_name']); $i++){
							print 'jobs.push(new prev_job_profile( "'.$_SESSION['com_name'][$i].'", "'.$_SESSION['add1'][$i].'", "'.$_SESSION['add2'][$i].'", "'.$_SESSION['com_phone'][$i].'", "'.$_SESSION['supervisor_name'][$i].'", "'.$_SESSION['textarea1'][$i].'", "'.$_SESSION['fromm'][$i].'", "'.$_SESSION['fromy'][$i].'", "'.$_SESSION['tom'][$i].'", "'.$_SESSION['toy'][$i].'", "'.$_SESSION['textarea3'][$i].'", "'.$_SESSION['textarea4'][$i].'", jobs.length));';
	
							print 'jobs[jobs.length-1].add_profile();'; 
						}
					
					?>
					</script>
                    	
                    </div>
              </div>
       	</div>
 	</div>
</div>



<?php page_finish(); ?>