<?php

//ini_set('display_errors', 1);
///////start session to use session variables//////////
session_start();
	
	
require_once('application_db.inc');
	
	
////////////////////////////////////////////////////////////////////////////
//get current url for webauth so don't have to change for different server//
////////////////////////////////////////////////////////////////////////////	
	$pageURL = 'http';
 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 		$pageURL .= "://";
 	if ($_SERVER["SERVER_PORT"] != "80") {
  		$server = $pageURL.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 	}
	else {
  		$server = $pageURL.$_SERVER["SERVER_NAME"];
  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 	}





	


////////////////////////////////////////////////////////////////////////////
//					get either netid or email pass combo				  //
////////////////////////////////////////////////////////////////////////////


	if(isset($_GET['title'])){
		if(!in_array(trim($_GET['title']), $_SESSION['specificpos'])){
			$_SESSION['specificpos'][] = trim(html_entity_decode($_GET['title']));
		
		  $param = array('intReportID'=>945);

      $client = new SoapClient("https://www.career.arizona.edu/WS/CS_Webservices.asmx?WSDL", array('trace' => TRUE, 'soap_version'   => SOAP_1_2));
      
      try{
        $listing = $client->CS_Get_JobListings($param);
      }
      catch (SoapFault $exception) { 
          var_dump($exception); 
      } 
      var_dump($listing);
      
      $xmlparse = simplexml_load_string($listing->CS_Get_JobListingsResult->any);
      
      $UnionJobListings_count = 0;
      
    
      if($xmlparse->ReportData['Job_JobTitle']){
        $job = $xmlparse->ReportData;
        
      
        
        $jobtitle = (string)$job->Job_JobTitle;
        if($jobtitle == $_SESSION['specificpos'][(count($_SESSION['spefificpos'])-1)]){
                      $query = 'select portal_id from joblink_convert where name="'.$job['Employer_Division'].'"';
                      $result = db_query($query);
                      $jobid = mysql_fetch_assoc($result);
                      $_SESSION['specificposnum'][] = $jobid['portal_id'];
        }
        var_dump($job, $_SESSION['specificposnum']);
      }
      else{
    
        foreach($xmlparse->ReportData as $job) {
          $jobtitle =   (string)$job->Job_JobTitle;  
                  if(trim($job['Job_JobTitle']) == $_SESSION['specificpos'][(count($_SESSION['specificpos'])-1)]){
                      //print 'found';
                      $query = 'select portal_id from joblink_convert where name="'.$job['Employer_Division'].'"';
                      $result = db_query($query);
                      $jobid = mysql_fetch_assoc($result);
                      //var_dump($jobid);
                      $_SESSION['specificposnum'][] = $jobid['portal_id'];
                      break;
                    }
          var_dump($job, $_SESSION['specificposnum']);
          
        }
      }
     }
   }
					
	if(isset($_POST['email'])){
  
    $_SESSION['email'] = $_POST['email'];
    $query = 'select * from student where email="'.$_SESSION['email'].'"';
    
  }
  else{
  	$webauth_splash = '/employment/application/splash.php';
    require_once('webauth/include.php');
    $_SESSION["netID"] = $_SESSION['webauth']["netID"];
    $query = "select * from student where netID='".$_SESSION['webauth']["netID"]."'";
  }					
						
	/*
	$pageURL = 'http://www.union.arizona.edu/employment/application/start.php';

	if(isset($_GET['ticket'])){
		$tix = $_GET['ticket'];
		
		$url = 'https://webauth.arizona.edu/webauth/serviceValidate?ticket='.$tix.'&service='.$pageURL.'';
		
		
		$curlHandle = curl_init();
		$options = array(
			CURLOPT_HEADER => false,
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FORBID_REUSE => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_TIMEOUT => 10
		);
		curl_setopt_array($curlHandle, $options);
		
		$temp = curl_exec($curlHandle);
		//var_dump($temp);
		
		//create xml parser
		$xml_parser = xml_parser_create();
		
		//parse xml into an array of values and an array of indexes
		xml_parse_into_struct($xml_parser, $temp, &$struct, &$index);
		
		
		
		//check if ticket was authenticated successfully
		if(isset($index['CAS:AUTHENTICATIONSUCCESS'])){
			
			//save response to session
			$_SESSION['webauth']['netID'] = $struct[$index['CAS:USER'][0]]['value'];
			$_SESSION['webauth']['studentID'] = $struct[$index['CAS:STUDENTID'][0]]['value'];
			$_SESSION['webauth']['activeemployee'] = $struct[$index['CAS:ACTIVEEMPLOYEE'][0]]['value'];
			$_SESSION['webauth']['activestudent'] = $struct[$index['CAS:ACTIVESTUDENT'][0]]['value'];
			$_SESSION['webauth']['employeeID'] = $struct[$index['CAS:EMPLOYEEID'][0]]['value'];
			$_SESSION['webauth']['emplid'] = $struct[$index['CAS:EMPLID'][0]]['value'];
			$_SESSION['webauth']['ua_id'] = $struct[$index['CAS:DBKEY'][0]]['value'];
			
			$_SESSION['netID'] = $_SESSION['webauth']['netID'];
			
			$query = "select * from student where netID='".$_SESSION["netID"]."'";
			
			
		}
		
		//if not send back to webauth to get valid ticket
		else{
			header("Location: https://webauth.arizona.edu/webauth/login?service=".$pageURL);
			exit;
		}
	}
	elseif(isset($_POST['email'])){
	
		$_SESSION['email'] = $_POST['email'];
		$query = 'select * from student where email="'.$_SESSION['email'].'"';
		
	}
	else{
		header("Location: https://webauth.arizona.edu/webauth/login?service=".$pageURL);
		exit;	
	}
	
	*/
				
	
	$result = db_query($query);
	//print mysql_error($DBlink);
	$has_logged_in_before = mysql_num_rows($result);
	if($has_logged_in_before > 0){
	
		$info = mysql_fetch_assoc($result);
		
		$_SESSION['app_id'] = $info['ID'];
		$_SESSION['email'] = $info['email'];
		
		if($info['active']!=0 && $_POST['edit']!=1){
			$stat_query='update student set status_check= status_check + 1 where ID="'.$_SESSION['app_id'].'"';
			db_query($stat_query);
			//print mysql_error($DBlink);
			
			header("Location: ./status.php");
			exit;
		}
		elseif($_POST['edit']==1){
			$stat_query='update student set edits = edits + 1 where ID="'.$_SESSION['app_id'].'"';
			db_query($stat_query);
			//print mysql_error($DBlink);
		}
		else{
			$stat_query='update student set finished_later=1 where ID="'.$_SESSION['app_id'].'"';
			db_query($stat_query);
			//print mysql_error($DBlink);
		}
		
		
		
		$_SESSION['netID'] = $info['netID'];
		$_SESSION['password'] = $info['password'];
		$_SESSION['refer'] = $info['refered'];
		$_SESSION['crime1'] = $info['crime_info'];
		$_SESSION['year'] = $info['class_standing'];
		$_SESSION['student'] = $info['student_type'];
		$_SESSION['first_name'] = $info['first'];
		$_SESSION['last_name'] = $info['last'];
		$_SESSION['add'] = $info['address'];
		$_SESSION['city'] = $info['city'];
		$_SESSION['state'] = $info['state'];
		$_SESSION['zip'] = $info['zip'];
		$_SESSION['email'] = $info['email'];
		$_SESSION['phone'] = $info['phone'];
		$_SESSION['workStudy'] = $info['work_study'];
		$_SESSION['workUnions'] = $info['worked_for_union'];
		$_SESSION['convictCrime'] = $info['crime'];
		$_SESSION['stage'] = $info['stage'];
		
		$query = 'select * from application where studentID='.$_SESSION['app_id'];
		$result = db_query($query);
		$info = mysql_fetch_assoc($result);
		
		$_SESSION['redistribute'] = $info['redistribute'];
		//$_SESSION['specificpos'] = array_merge($_SESSION['specificpos'], explode(", ", $info['specific_location']));
		$_SESSION['Dining'] = $info['area1'];
		$_SESSION['CSIL'] = $info['area2'];
		$_SESSION['Retail'] = $info['area3'];
		$_SESSION['Operations'] = $info['area4'];
		$_SESSION['comments'] = $info['comments'];
		$_SESSION['resume_content'] = $info['resume'];
		$_SESSION['resume_size'] = $info['resume_size'];
		$_SESSION['resume_type'] = $info['resume_type'];
		
		if(count($_SESSION['specificpos']) && $_SESSION['stage']>1){
			$_SESSION['stage'] = 2;	
		}
		$query = 'select * from app_history where studentID='.$_SESSION['app_id'].' and phase="0"';
		$result = db_query($query);
		while($posit = mysql_fetch_assoc($result)){
			if(is_array($_SESSION['specificpos']) && !in_array(trim($posit['phase_info']), $_SESSION['specificpos'])){
				$_SESSION['specificpos'][] = trim($posit['phase_info']);
				$_SESSION['specificposnum'][] = $posit['unit'];
			}
		}
		

		$query = 'select * from semester left join  (select * from schedule where studentID='.$_SESSION['app_id'].') as studentschedule on semester.title=studentschedule.semester  where start_hiring<="'.date("Y-m-d").'" and end_hiring>="'.date("Y-m-d").'"';
		
				
		
		$result = db_query($query);
		//print mysql_error($DBlink);
		$i = 0;
		$_SESSION['allschedules'] = '[';
		while($temp_schedule = mysql_fetch_assoc($result)){
			$_SESSION['semesters'][$i++] = $temp_schedule['title'];
			$_SESSION[$temp_schedule['semester']]['mon'] =  $temp_schedule['mon'];
			$_SESSION[$temp_schedule['semester']]['mon1'] =  $temp_schedule['mon2'];
			$_SESSION[$temp_schedule['semester']]['tue'] =  $temp_schedule['tue'];
			$_SESSION[$temp_schedule['semester']]['tue1'] =  $temp_schedule['tue2'];
			$_SESSION[$temp_schedule['semester']]['wed'] =  $temp_schedule['wed'];
			$_SESSION[$temp_schedule['semester']]['wed1'] =  $temp_schedule['wed2'];
			$_SESSION[$temp_schedule['semester']]['thu'] =  $temp_schedule['thu'];
			$_SESSION[$temp_schedule['semester']]['thu1'] =  $temp_schedule['thu2'];
			$_SESSION[$temp_schedule['semester']]['fri'] =  $temp_schedule['fri'];
			$_SESSION[$temp_schedule['semester']]['fri1'] =  $temp_schedule['fri2'];
			$_SESSION[$temp_schedule['semester']]['sat'] =  $temp_schedule['sat'];
			$_SESSION[$temp_schedule['semester']]['sat1'] =  $temp_schedule['sat2'];
			$_SESSION[$temp_schedule['semester']]['sun'] =  $temp_schedule['sun'];
			$_SESSION[$temp_schedule['semester']]['sun1'] =  $temp_schedule['sun2'];
			$_SESSION['work_hours'.$temp_schedule['semester']] =  $temp_schedule['hours_week'];
			if($temp_schedule['semester'] == NULL){
				$_SESSION['allschedules'] .= '[[';
				$_SESSION['allschedules'] .= '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],';
				$_SESSION['allschedules'] .= '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],';
				$_SESSION['allschedules'] .= '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],';
				$_SESSION['allschedules'] .= '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],';
				$_SESSION['allschedules'] .= '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],';
				$_SESSION['allschedules'] .= '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],';
				$_SESSION['allschedules'] .= '[0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]';
				$_SESSION['allschedules'] .= ']],';
			}
			else{
				$_SESSION['allschedules'] .= '[[';
				$mon = preg_split("//",str_pad(decbin($temp_schedule['mon']), 24, '0', STR_PAD_LEFT).str_pad(decbin($temp_schedule['mon2']), 24, '0', STR_PAD_LEFT), 49);
				unset($mon[0]);
				$tue = preg_split("//",str_pad(decbin($temp_schedule['tue']), 24, '0', STR_PAD_LEFT).str_pad(decbin($temp_schedule['tue2']), 24, '0', STR_PAD_LEFT), 49);
				unset($tue[0]);
				$wed = preg_split("//",str_pad(decbin($temp_schedule['wed']), 24, '0', STR_PAD_LEFT).str_pad(decbin($temp_schedule['wed2']), 24, '0', STR_PAD_LEFT), 49);
				unset($wed[0]);
				$thu = preg_split("//",str_pad(decbin($temp_schedule['thu']), 24, '0', STR_PAD_LEFT).str_pad(decbin($temp_schedule['thu2']), 24, '0', STR_PAD_LEFT), 49);
				unset($thu[0]);
				$fri = preg_split("//",str_pad(decbin($temp_schedule['fri']), 24, '0', STR_PAD_LEFT).str_pad(decbin($temp_schedule['fri2']), 24, '0', STR_PAD_LEFT), 49);
				unset($fri[0]);
				$sat = preg_split("//",str_pad(decbin($temp_schedule['sat']), 24, '0', STR_PAD_LEFT).str_pad(decbin($temp_schedule['sat2']), 24, '0', STR_PAD_LEFT), 49);
				unset($sat[0]);
				$sun = preg_split("//",str_pad(decbin($temp_schedule['sun']), 24, '0', STR_PAD_LEFT).str_pad(decbin($temp_schedule['sun2']), 24, '0', STR_PAD_LEFT), 49);
				unset($sun[0]);
				$_SESSION['allschedules'] .= '['.implode(', ', $mon).'], ['.implode(', ', $tue).'], ['.implode(', ', $wed).'], ['.implode(', ', $thu).'], ['.implode(', ', $fri).'], ['.implode(', ', $sat).'], ['.implode(', ', $sun) .']';
				
				
			
				$_SESSION['allschedules'] .= ']],';
				
				
			}
		}
		
		$_SESSION['allschedules'] = rtrim($_SESSION['allschedules'], ",");
		$_SESSION['allschedules'] .= ']';
		
		

		$query = 'select * from work_history  where studentID="'.$_SESSION['app_id'].'"';
		$result = db_query($query);
		//print mysql_error($DBlink);
		$i=1;
		while($temp_work_history = mysql_fetch_assoc($result)){
					$_SESSION['com_name'][$i]=$temp_work_history["company"];
					$_SESSION['add1'][$i]=$temp_work_history["address"];
					$_SESSION['add2'][$i]=$temp_work_history["city_state_zip"];
					$_SESSION['com_phone'][$i]=$temp_work_history["phone_number"];
					$_SESSION['supervisor_name'][$i]=$temp_work_history["supervisor_name"];
					$_SESSION['textarea1'][$i]=addslashes($temp_work_history["job_duties"]);
					preg_match_all("/\d\d/", $temp_work_history["period"], $matches);
					
					if(((int) $matches[0][1]) < 9){
						$matches[0][1] += 21;
					}
					else{
						$matches[0][1] -= 79;
					}
					
					if(((int) $matches[0][3]) < 9){
						$matches[0][3] += 21;
					}
					else{
						$matches[0][3] -= 79;
					}
					
					
					$_SESSION['fromm'][$i]=$matches[0][0];
					$_SESSION['fromy'][$i]=$matches[0][1];
					$_SESSION['tom'][$i]=$matches[0][2];
					$_SESSION['toy'][$i]=$matches[0][3];
					$_SESSION['textarea3'][$i]=$temp_work_history["pay_rate"];
					$_SESSION['textarea4'][$i++]=$temp_work_history["reason_leave"];
				
				
			
		}
		if($_SESSION['stage']==5){
			header("Location:./1.php");
			exit;
		}
		else{
		header("Location:./".$_SESSION['stage'].".php");
		exit;
		}
	}
	else{
		
		//following lines used to shut down app
		
		//header("Location:shut_down.php");
		//exit();
	
		$query = 'insert into student set email="'.$_SESSION['email'].'", netID="'.$_SESSION['netID'].'", stage=1, active=0, status_check=0, edits=0';
		db_query($query);
		//print mysql_error($DBlink);
		
		$_SESSION['app_id'] = mysql_insert_id($DBlink);
		
		
		$query = 'insert into application set studentID='.$_SESSION['app_id'];
		db_query($query);
		//print mysql_error($DBlink); 
		
	}



////////////////////////////////////////////////////////////////////////////
//						apply union website template					                      //
////////////////////////////////////////////////////////////////////////////	
ob_start();
?>
						li, p, div{
							font-size:13px;
							line-height:15px;
						}
						ul{
						 margin-top: 0px;
						 margin-bottom: 0px;
						}
						li{
						 margin-top: 15px;
						 margin-bottom: 0px;
						}
						p{
						 margin-top: 15px;
						 margin-bottom: 0px;
						}
<?php
  $page_options['styles'] = ob_get_clean();

	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Arizona Student Union employee application:';
  $page_options['header_image'] = 'images/student_employment.png';
	page_start($page_options);
	
?>

<div style="padding-left:0px; width:100%; z-index:1000; position:relative; top:-10;">
        <div style="margin-top:15px; width:900px;">
           	<div style="float:left; background-image:url(images/green_box.gif); background-repeat:no-repeat; width:491px; _width:525px; height:611px; padding:0px 17px 0 17px;">
            	<p style="color:#C01525; font-size:16px; font-weight:bold;" align="center" >
                	What you should know about working at the<br> Arizona Student Unions
                </p>
                <p>Here at the Unions, our goal is to help students find the right job. Before beginning, please be aware of the following:</p>
                <ul>
                    <li><p>You can only apply for Student Union positions here, (does not include other campus departments such as the UA BookStores and Campus Rec).</p></li>
                    	
                    <li><p>This application is for part-time student employment only. If you are not a UA, Pima, or High School student, please contact U of A HR at 621-3662.</p></li>
                    	
                    <li><p>Have a copy of your schedule handy.</p></li>
                    
                   <!-- <li><p>If hired, you will need your social security card (not a copy).</p></li>
                    	
                    <li><p>If you are an international student, please have all your documentation available.</p></li>-->
                    	
                    <li><p>You may save your application and return to it at a later date. You may also log back into this site to edit or track a submitted application.</p></li>
                
                </ul>
				<p>If you have any problems or questions about the online application, give us a call at 520-626-9205, or send an email to unionshr@email.arizona.edu. Good luck!</p>
                    
 				<p> Please answer every question on this application completely and accurately without concealing any information. If you do not, and you are hired, you could lose your job regardless of length of employment. This application is not an offer, promise, or contract of employment, either expressed or implied.</p>
                 
                <div align="center" style="margin-top:0px; margin-bottom:0px;">
                	<form action="./1.php" method="post" style="margin:0px;">
                    	<p style="font-size:11px; font-weight:bold;">
                        	I understand the above conditions.<br />
                            <input name="agreement" type="submit" value="Accept">
                        </p>
                    </form>
                </div>  
			</div>
            <div style="float:left; margin-left:35px;">
            	<img src="images/Benefits_cloud.gif" usemap="#cloud" style="border:none; text-decoration:none;">
                	<map name="cloud">
                    	<area href="../index.php" target="_blank" coords="75,250,210,280" />
                    </map>
            </div>
		</div>
	
</div>

<?php  page_finish(); ?>