<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/commontools/includes/studentapp.inc');
session_start();

if (isset($_SESSION['employment_app'])){

  if (!is_object($_SESSION['employment_app']) && !isset($_SESSION['webauth'])) 
  // if (!is_object($_SESSION['employment_app']) )
  {
  	header("Location: /employment/application/index.php");
  	exit();
  }

}
else {
	header("Location: /employment/application/index.php");
  exit();
}
ob_start();
?>
	.apply-intro-wrap li, .apply-intro-wrap p, .apply-intro-wrap div {
		font-size:13px;
		line-height:15px;
	}
	.apply-intro-wrap ul {
	 margin-top: 0px;
	 margin-bottom: 0px;
	 list-style-position:inside;
	}
	.apply-intro-wrap li {
	 margin-top: 15px;
	 margin-bottom: 0px;
	 list-style:none;
	}
	.apply-intro-wrap p {
	 margin-top: 15px;
	 margin-bottom: 0px;
	}
<?php
$page_options['styles'] = ob_get_clean();
require_once($_SERVER['DOCUMENT_ROOT'].'/employment/template/employment.include.php');
$page_options['title'] = 'Arizona Student Union employee application:';
$page_options['header_image'] = 'images/student_employment.png';
$page_options['page'] = '';
employment_start($page_options);

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<div class="apply-intro-wrap" style="padding-left:0px; width:100%; z-index:1000; position:relative; top:-10;">
        <div style="margin-top:15px;">
           	<div style="float:left; background-image:url(images/green_box.gif); background-repeat:no-repeat; width:525px; _width:525px; height:611px; padding:0px 17px 0 17px;">
            	<p style="color:#C01525; font-size:16px; font-weight:bold;" align="center" >
                	What you should know about working at the<br> Arizona Student Unions
                </p>
                <p>Here at the Unions, our goal is to help students find the right job. Before beginning, please be aware of the following:</p>
                <ul>
                    <li><p>You can only apply for Student Union positions here, (does not include other campus departments such as the UA BookStores and Campus Rec).</p></li>

                    <li><p>This application is for part-time student employment only. If you are not a UA, or High School student, please contact U of A HR at 621-3662.</p></li>

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
            	<p style="color:#C01525; font-size:16px; font-weight:bold;" align="center" >BENEFITS!</p>
							<ul>
								<li style="list-style-type:disc;">50% off meals</li>
								<li style="list-style-type:disc;">Flexible hours</li>
								<li style="list-style-type:disc;">Competitive wages</li>
								<li style="list-style-type:disc;">Meet new friends</li>
								<li style="list-style-type:disc;">Work Study accepted</li>
								<li style="list-style-type:disc;">Work with other students</li>
								<li style="list-style-type:disc;">Convenience (we're on campus)</li>
								<li style="list-style-type:disc;">Opportunity for advancement</li>
							</ul>
            </div>
		</div>

</div>

<?php  employment_finish(); ?>
