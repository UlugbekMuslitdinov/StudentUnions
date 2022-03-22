<?php
	session_start();
	ini_set("display_errors", 1);
	if(!isset($_SESSION['app_id'])){
    header("Location: ./start.php");
    exit;
  }
  
	require('application_db.inc');
	
	if($_POST['submit4']=='Save and Continue'){
	
	$query = 'delete from work_history where studentID="'.$_SESSION['app_id'].'";';
			//print $query;
			db_query($query);
			//print mysql_error($DBlink);
		

		
		for($i=1; $i<sizeof($_POST['com_name']); $i++){

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
			
			if( $_SESSION['fromy'][$i]!=0){
				if($_SESSION['fromy'][$i]<21){
					$fromy1[$i] = $_SESSION['fromy'][$i]+79;
				}
				else{
					$fromy1[$i] = $_SESSION['fromy'][$i]-21;
					$fromy1[$i] = str_pad($fromy1[$i],2,"0",STR_PAD_LEFT);
				}
			}
			
			if( $_SESSION['toy'][$i]!=0){
				if($_SESSION['toy'][$i]<21){
					$toy1[$i] = $_SESSION['toy'][$i]+79;
				}
				else{
					$toy1[$i] = $_SESSION['toy'][$i]-21;
					$toy1[$i] =str_pad($toy1[$i],2,"0",STR_PAD_LEFT);
				}
			}
		
			$_SESSION['fromy1'][$i] = $fromy1[$i];
			$_SESSION['toy1'][$i] = $toy1[$i];	
			/*
			while($_SESSION['com_name'][$i]){
				unset($_SESSION['com_name'][$i]);
			}*/
			
			$query= "INSERT INTO work_history SET".
				  "   company  =\""	        .db_real_escape($_SESSION['com_name'][$i], 30) . 
				 "\",  address =\""	        .db_real_escape($_SESSION['add1'][$i], 60).
				 "\",  city_state_zip =\""  .db_real_escape($_SESSION['add2'][$i], 30). 
				 "\",  phone_number  =\""	    .db_real_escape($_SESSION['com_phone'][$i], 16) .
				 "\",  supervisor_name=\""	.db_real_escape($_SESSION['supervisor_name'][$i], 30).
				 "\",  job_duties  =\""	    .$_SESSION['textarea1'][$i].
				 "\",  period    =\""       .str_pad($_SESSION['fromm'][$i],2,"0",STR_PAD_LEFT)."/".$fromy1[$i]." - ".str_pad($_SESSION['tom'][$i],2,"0",STR_PAD_LEFT)."/".$toy1[$i].
				 "\",  pay_rate    =\""     .db_real_escape($_SESSION['textarea3'][$i], 20).
				 "\",  reason_leave =\""    .db_real_escape($_SESSION['textarea4'][$i], 200).
				 "\",  studentID ="         . $_SESSION['app_id']. 
				 ";";	
				db_query($query);
				//print mysql_error($DBlink);
						
		}
		while($_SESSION['com_name'][$i]){
			unset($_SESSION['com_name'][$i++]);
		
		}
		
		if($_FILES['userfile']){
			$_SESSION['resume'] = $_FILES['userfile'];
		}

		if($_SESSION['resume']['size'] > 0 ){
		
			$fileName = $_SESSION['resume']['name'];
			$tmpName  = $_SESSION['resume']['tmp_name'];
			$resume_size = $_SESSION['resume']['size'];
			$fileType = $_SESSION['resume']['type'];
			
			$fp = fopen($tmpName, 'r');
			$resume_content = fread($fp, $resume_size);
			$resume_content = addslashes($resume_content);
			$_SESSION['resume']['content'] = $resume_content;
			fclose($fp);
			
			$query = 'update application set '.
				 'resume="'.$_SESSION['resume']['content'].'", '.
				 'resume_size="'.$_SESSION['resume']['size'].'", '.
				 'resume_type="'.$_SESSION['resume']['type'].'" '.
				 'where studentID="'.$_SESSION['app_id'].'"';
			db_query($query);
			//print mysql_error($DBlink);
		}
		
		if($_SESSION['stage']<5){
			$_SESSION['stage']=5;
			db_query("update student set stage=5 where ID='".$_SESSION['app_id']."'");
		}
	}


	
      
ob_start();
?>
  @import url("forms.css");
  .cloud{
            float:left;
            margin-bottom:20px;
            display:block;
          }
          .active{
            cursor:pointer;
          } 
<?php
$page_options['styles'] = ob_get_clean();

ob_start();
?>
  function check_length(){
    var text = document.getElementById("comments").value;
    if(text.length >= 500){
      alert('too long');
      return false;
    }
  }
<?php
$page_options['scripts'] = ob_get_clean();


	
		require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Arizona Student Union employee application:';
  $page_options['header_image'] = 'images/student_employment.png';
  page_start($page_options);
		
?>


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
                <p style="font-size:13px;">Please use this box for any other important information you feel we should know (meetings, transportation issues, lab times, extenuating circumstances, special needs, etc). (500 character limit)</p>
                <form action="thankyou.php" enctype="multipart/form-data" method="post" >
                <div style="background-image:url(images/comments_BOX.gif); width:400px; height:254px; _height:304px; background-repeat:no-repeat; padding:25px;">

<textarea name="comments" id="comments" style="background-color:#FCF9D0; width:350px; height:204px; resize:none; overflow:hidden;" onkeydown="return check_length()"></textarea>
			</div>
<input type="submit" value="submit application" />
</form>
</div>
<?php page_finish(); ?>