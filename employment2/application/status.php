<?php
session_start();
//print $_SESSION['app_id'];
if(!isset($_SESSION['app_id']) || $_SESSION['app_id'] == ''){
	header("Location:./start.php");
  exit();
}

require('application_db.inc');

if($_POST['deactivate']==1){
	$query = 'update student set active=-1 where ID='.$_SESSION['app_id'];
	mysql_query($query, $DBlink);
}

if($_POST['reactivate']==1){
	$query = 'update student set active=1 where ID='.$_SESSION['app_id'];
	mysql_query($query, $DBlink);
}


	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $page_options['title'] = 'Arizona Student Union employee application:';
  page_start($page_options);
	
	
				
				$status = 'Your application has been received.';
				
				$result=db_query("select active, email from student where ID=".$_SESSION['app_id']);
				$temp = mysql_fetch_assoc($result);				
				$active = $temp['active'];
				$email = $temp['email'];
?>

<div style="padding-left:30px; margin-left:0px; margin-top:-10px; margin-right:15px;">

		<div style="margin-bottom:20px; background-color:#438D41; width:100%; ">
    		<img src="images/banner.gif">
        </div>
        <div style="width:800px;">
        	<div>
            	<img src="images/application_status.gif" />
             </div>
             <div style="background-image:url(images/green_box_status.gif); background-repeat:no-repeat; width:700px; height:546px;">
             	<div align="center" style="width:100%; font-size:14px; font-weight:bold; color:#C01525; padding-top:45px; padding-bottom:5px;"><?php print $status; ?></div>
                <div align="center" style="width:90%; font-size:16px; font-weight:bold; color:#C01525; padding-top:5px; padding-bottom:45px; font-family:Arial, Helvetica, sans-serif;">If you are trying to apply for the fall semester, please click edit and fill in your fall availability on step 3 and click save if you haven't already done so.</div>
                <?php if($active==1){ ?>
                	<form name="edit_form" method="post" action="./start.php" style="padding:0px; margin:0px;">
                    <input type="hidden" name="edit" value="1" />
                    <input type="hidden" name="email" value="<?php print $email; ?>" />
                	<img src="images/edit_button.gif" style="float:left; margin-left:60px; cursor:pointer;" onclick="document.edit_form.submit();"/><div style="float:left; width:300px; margin-left:40px; font-size:14px;">You can edit your application at any time as long as it has not been deactivated.</div>
                    </form>
                   
                    <div style="clear:both; height:45px;"> </div>
                     <form name="deactivate_form" method="post" action="./status.php" style="padding:0px; margin:0px;">
                    <input type="hidden" name="deactivate" value="1" />
                    <img src="images/Deactivate_button.gif" style="float:left; margin-left:60px; cursor:pointer;" onclick="document.deactivate_form.submit();"/><div style="float:left; width:300px; margin-left:40px; font-size:14px;">If you no longer wish to be considered for employment at the Arizona Student Unions please deavctivate your application.</div>
                    </form>
                    <div style="clear:both; height:45px;"> </div>
                    <div >
                    	<img src="images/reactivate_button.gif" style="float:left; margin-left:60px; background-color:#999999; opacity: .5; filter:alpha(opacity=50);" onclick="alert('Your application is already active');" /><div style="float:left; width:300px; margin-left:40px; font-size:14px; color:#999999;">If you no longer wish to be considered for employment at the Arizona Student Unions please deavctivate your application.</div>
                    </div>
                <?php } else{ ?>
                <div >
                	<img src="images/edit_button.gif" style="float:left; margin-left:60px; background-color:#999999; opacity: .5; filter:alpha(opacity=50);" onclick="alert('Please reactivate your application before editing it.')" /><div style="float:left; width:300px; margin-left:40px; font-size:14px; color:#999999;">You can edit your application at any time as long as it has not been deactivated.</div>
                </div>
                    <div style="clear:both; height:45px;"> </div>
                 <div >
                    <img src="images/Deactivate_button.gif" style="float:left; margin-left:60px; background-color:#999999; opacity: .5; filter:alpha(opacity=50); " onclick="alert('Your application is already deactivated.')"/><div style="float:left; width:300px; margin-left:40px; font-size:14px; color:#999999;">If you no longer wish to be considered for employment at the Arizona Student Unions please deavctivate your application.</div>
                 </div>
                    <div style="clear:both; height:45px;"> </div>
                     <form name="reactivate_form" method="post" action="./status.php" style="padding:0px; margin:0px;">
                    <input type="hidden" name="reactivate" value="1" />
                    	<img src="images/reactivate_button.gif" style="float:left; margin-left:60px; cursor:pointer;" onclick="document.reactivate_form.submit();" /><div style="float:left; width:300px; margin-left:40px; font-size:14px;">If you no longer wish to be considered for employment at the Arizona Student Unions please deavctivate your application.</div>
                    </form>
                
                <?php } ?>
             
             </div>
             
              <?php page_finish(); ?>