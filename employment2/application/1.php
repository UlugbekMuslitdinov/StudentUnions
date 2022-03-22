<?php
	session_start();
	
	if(!isset($_SESSION['app_id'])){
		header("Location: ./start.php");
		exit;
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
					a:hover, a:link, a:visited{
						font-size:13px;
					}
<?php
$page_options['styles'] = ob_get_clean();

ob_start();
?>
	
function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode;
		 
		// alert(charCode);
		 
         if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 45)
            return false;

         return true;
      }
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
				switch($_SESSION['stage']){
					default:
				?>
                			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud" src="images/2_grey.gif" />
                            <img class="cloud" src="images/3_grey.gif" />
                            <img class="cloud" src="images/4_grey.gif" />
                            <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;
					
                    case 2:
				?>
                			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud" src="images/3_grey.gif" />
                            <img class="cloud" src="images/4_grey.gif" />
                            <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;    
					
					case 3:
				?>
                			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                            <img class="cloud" src="images/4_grey.gif" />
                            <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;  
					
					case 4:
				?>
                			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                            <img class="cloud active" src="images/4_green.gif" onclick="window.location='./4.php'"/>
                            <img class="cloud" src="images/5_grey.gif" />
                <?php
					break;  
					
					case 5:
				?>
                			<img class="cloud active" src="images/1_red.gif" onclick="window.location='./1.php'";/>
                            <img class="cloud active" src="images/2_green.gif" onclick="window.location='./2.php'"/>
                            <img class="cloud active" src="images/3_green.gif" onclick="window.location='./3.php'"/>
                            <img class="cloud active" src="images/4_green.gif" onclick="window.location='./4.php'"/>
                            <img class="cloud active" src="images/5_green.gif" onclick="window.location='./5.php'"/>
                <?php
					break;			
				}			
				?>
            </div>
            <div style="float:left; margin-left:30px; width:800px;">
            <form action="2.php" enctype="multipart/form-data" method="post" >
            	<div>
            		<img src="images/personal_info.gif" /><span style="color:#C01525; font-size:11px; top:-10px; left:10px; position:relative;">(all fields required)</span>
                </div>
    			<div style="background-color:#D2E5CA; padding: 1px 0px 15px 15px;">
    
    				<? print '<span class="error_message">' . $_SESSION['error_msg1'] . '</span>'; ?>
                    
                    <p>
                		<label for="first_name">First Name </label><input name="first_name" type="text" class="textbox" id="first_name" size="25" value="<?=htmlentities($_SESSION['first_name'])?>" style=" <?php print $_SESSION['error1']['first_name'];?>"/> 
                     
                   		<label for="first_name">Last Name </label><input name="last_name" type="text" class="textbox" id="last_name" size="25" value="<?=htmlentities($_SESSION['last_name'])?>" style=" <?php print $_SESSION['error1']['last_name'];?>"/> 
                    </p>
                     
                    <p>
                    
                        <label for="phone">Phone number </label><input name="phone" type="text" class="textbox" id="phone" value="<?=htmlentities($_SESSION['phone'])?>"  style="<?php print $_SESSION['error1']['phone'];?>  " onkeypress="return isNumberKey(event)"/>
                         
                    </p>
                    
                    <p>
                        <label for="email">Email </label><input name="email" type="text" class="textbox" id="email" size="65" value="<?=htmlentities($_SESSION['email'])?>"  style="<?php print $_SESSION['error1']['email'];?> "/>
                         
                    </p>
                    
                    <p>
                        <label for="add">Present Address </label><input name="add" type="text" class="textbox" id="add" size="60" value="<?=htmlentities($_SESSION['add'])?>" style="<?php print $_SESSION['error1']['add'];?>" />
                    </p>
                    
                     <p>
        				<label for="city">City </label>
                        	<input name="city" type="text" class="textbox" id="add" size="15" value="<?=htmlentities($_SESSION['city'])?>" style="<?php print $_SESSION['error1']['city'];?>" />							
                            &nbsp;&nbsp; 
                       	<label for="state">State </label> 
                         	<select name="state"> 
                                <option value="<?=htmlentities($_SESSION['state'])?>" selected="selected"><?=htmlentities($_SESSION['state'])?></option> 
                                <option value="AL">Alabama</option> 
                                <option value="AK">Alaska</option> 
                                <option value="AZ">Arizona</option> 
                                <option value="AR">Arkansas</option> 
                                <option value="CA">California</option> 
                                <option value="CO">Colorado</option> 
                                <option value="CT">Connecticut</option> 
                                <option value="DE">Delaware</option> 
                                <option value="DC">District Of Columbia</option> 
                                <option value="FL">Florida</option> 
                                <option value="GA">Georgia</option> 
                                <option value="HI">Hawaii</option> 
                                <option value="ID">Idaho</option> 
                                <option value="IL">Illinois</option> 
                                <option value="IN">Indiana</option> 
                                <option value="IA">Iowa</option> 
                                <option value="KS">Kansas</option> 
                                <option value="KY">Kentucky</option> 
                                <option value="LA">Louisiana</option> 
                                <option value="ME">Maine</option> 
                                <option value="MD">Maryland</option> 
                                <option value="MA">Massachusetts</option> 
                                <option value="MI">Michigan</option> 
                                <option value="MN">Minnesota</option> 
                                <option value="MS">Mississippi</option> 
                                <option value="MO">Missouri</option> 
                                <option value="MT">Montana</option> 
                                <option value="NE">Nebraska</option> 
                                <option value="NV">Nevada</option> 
                                <option value="NH">New Hampshire</option> 
                                <option value="NJ">New Jersey</option> 
                                <option value="NM">New Mexico</option> 
                                <option value="NY">New York</option> 
                                <option value="NC">North Carolina</option> 
                                <option value="ND">North Dakota</option> 
                                <option value="OH">Ohio</option> 
                                <option value="OK">Oklahoma</option> 
                                <option value="OR">Oregon</option> 
                                <option value="PA">Pennsylvania</option> 
                                <option value="RI">Rhode Island</option> 
                                <option value="SC">South Carolina</option> 
                                <option value="SD">South Dakota</option> 
                                <option value="TN">Tennessee</option> 
                                <option value="TX">Texas</option> 
                                <option value="UT">Utah</option> 
                                <option value="VT">Vermont</option> 
                                <option value="VA">Virginia</option> 
                                <option value="WA">Washington</option> 
                                <option value="WV">West Virginia</option> 
                                <option value="WI">Wisconsin</option> 
                                <option value="WY">Wyoming</option>
							</select>
                             <?php print $_SESSION['error1']['state'];//'<span class="error_message">*</span>';}?>
                
                		&nbsp;&nbsp;
                        <label for="zip">Zip Code </label>
                        	<input name="zip" type="text" class="textbox" id="zip" size="10" value="<?=htmlentities($_SESSION['zip'])?>" style="<?php print $_SESSION['error1']['zip'];?>" /> 
      				</p>
                    
                    <p>
                        <label for="student">I am a </label>
                        <select name="student">
                                <option value="UA_student" selected>U of A student</option>
                                <option value="Pima_student" <?php if($_SESSION['student']=="Pima_student"){print "selected";} ?>>Pima student</option>
                                <option value="high_school_student" <?php if($_SESSION['student']=="high_school_student"){print "selected";} ?>>High school student</option>
                                
                        </select>
                    
                                
                        <label for="year">Year: </label>
                         <select name="year" id="year">
                            <option value="freshman" <?php if($_SESSION['year']=="freshman"){print "selected";} ?>>Freshman</option>
                            <option value="sophmore" <?php if($_SESSION['year']=="sophmore"){print "selected";} ?>>Sophmore</option>
                            <option value="junior" <?php if($_SESSION['year']=="junior"){print "selected";} ?>>Junior</option>
                            <option value="senior" <?php if($_SESSION['year']=="senior"){print "selected";} ?>>Senior</option>
                            <option value="grad" <?php if($_SESSION['year']=="grad"){print "selected";} ?>>Grad Student</option>
                        </select>
                    </p>
                    
                    <p>
                    	<label for="refer">How did you find out about Student Union jobs? </label>
                         
                        <select name="refer">
                            
                            <option value="Brochure/Handout" <?php if($_SESSION['refer']=="Brochure/Handout"){print "selected";} ?>>Brochure/Handout</option>
                            <option value="Expo/Orientation" <?php if($_SESSION['refer']=="Expo/Orientation"){print "selected";} ?>>Expo/Orientation</option>
                            <option value="Friends" <?php if($_SESSION['refer']=="Friends"){print "selected";} ?>>Friends</option>
                            <option value="Joblink" <?php if($_SESSION['refer']=="Joblink"){print "selected";} ?>>Joblink</option>
                            <option value="Signs" <?php if($_SESSION['refer']=="Signs"){print "selected";} ?>>Signs around the Union</option>
                            <option value="Website" <?php if($_SESSION['refer']=="Website"){print "selected";} ?>>Website</option>
                            <option value="Other" selected>Other</option>
                    	</select>
                    </p>
        
                    <p>
                    	<label for="workStudy">Are you eligible for <a href="https://financialaid.arizona.edu/WorkStudy/default.aspx" target="_blank">work-study</a>? </label>
                        <input type="radio"  name="workStudy" id="yes" value="1" <?php if($_SESSION['workStudy'] == "1"){print 'checked';}?>/> YES <input type="radio"  name="workStudy" id="no" value="0" <?php if($_SESSION['workStudy'] == "0"){print 'checked';}?>/> NO <?php print $_SESSION['error1']['workStudy'];//'<span class="error_message">*</span>';}?>
                         
                         
                       
                         
                    </p>
        
                    <p>
                        <label for="workUnions">Have you ever worked for the Unions? </label>
                        <input type="radio" name="workUnions" id="yes" value="1" <?php if($_SESSION['workUnions'] == "1"){print 'checked';}?>/> YES <input type="radio" name="workUnions" id="no" value="0" <?php if($_SESSION['workUnions'] == "0"){print 'checked';}?>/> NO <?php print $_SESSION['error1']['workUnions'];?>
                       
                         
                    </p>
    
                    <p>
                        <label for="convictCrime">Have you ever been convicted of a crime other than a minor traffic violation? </label>
                        <input type="radio" name="convictCrime" id="yes" value="1" <?php if($_SESSION['convictCrime'] == "1"){print 'checked';}?>/> YES <input type="radio" name="convictCrime" id="no" value="0" <?php if($_SESSION['convictCrime'] == "0"){print 'checked';}?>/> NO <?php print $_SESSION['error1']['convictCrime'];?> 
                        
                    </p>
 					
                        <label for="crime1" style=" vertical-align:top; font-size:13px;">If yes, please explain:</label>
                        <textarea   rows="3" name="crime1"   id="crime1"  class="textbox" value="<?=htmlentities($_SESSION['crime1'])?>" style="resize:none; width:400px; height:57px;" ></textarea><br />
                        
                        <label style=" vertical-align:top; visibility:hidden; float:left; font-size:13px;">If yes, please explain&nbsp;</label>
                        <div style="font-size:11px;  width:400px; float:left;">
                            The existence of a criminal record will not automatically disqualify your application. Do not answer "yes" if your "official" conviction record has been annulled, expunged, or sealed.
                        </div>
                    
        			<div style="clear:both;">
                    </div>
    			</div>
				<p>
    	 			<input type="submit" name="submit1" value="Save and Continue" style="float:right;">
				</p>
                </form>
			</div>
 		</div>
</div>
<?php  page_finish(); ?>