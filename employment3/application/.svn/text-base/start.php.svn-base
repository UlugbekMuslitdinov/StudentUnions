<?php
require_once ('includes/studentapp.inc');
session_start();
if (!is_object($_SESSION['employment_app']) || !isset($_SESSION['webauth'])) {
	header("Location: /employment/application/index.php");
	exit();
}
ob_start();
?>
	li, p, div{
		font-size:13px;
		line-height:15px;
	}
	ul{
	 margin-top: 0px;
	 margin-bottom: 0px;
	 list-style-position:inside;
	}
	li{
	 margin-top: 15px;
	 margin-bottom: 0px;
	 list-style:none;
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
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


