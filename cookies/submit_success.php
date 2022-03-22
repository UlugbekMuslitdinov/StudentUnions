<?php
	// header("Location: ../index.php");
	// die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Cookies';
	page_start($page_options);	
?>
<body>
<div class="container">
<div class="row"><div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/CelebrationCookieBanner.jpg" class="img-fluid" alt=""></div></div>
<div class="row page_background mt-2">
<h2 style="margin-top:0px;"><br />
<div style="color:red">The form was submitted successfully.</div><br /><br />
Hello!<br />
Thank you for your purchase of cookies through the Student Union Memorial Center.  Please instruct your student to check their CatMail for pick up instructions.  If you have any further questions please call us at 520-621-1414 or email us at <br /><a href="mailto:su-sueventplanning@email.arizona.edu">su-sueventplanning@email.arizona.edu</a>.<br /><br />

Thank you!<br />
Student Union Culinary and Events Team
</h2>
</div>
<br /><br /><br /><br /><br /><br />
</body>
<?php page_finish(); ?>
