<?php
	// header("Location: ../index.php");
	// die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Celebration Cookies';
	page_start($page_options);	
?>
<body>
<div class="container">
<div class="row"><div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/CelebrationCookieBanner.jpg" class="img-fluid" alt=""></div></div>
<div class="row page_background mt-2">
<h2 style="margin-top:0px;"><br />
<div style="color:red">The form was submitted successfully.</div><br /><br />
Thank you!<br />
</h2>
</div>
<br /><br /><br /><br /><br /><br />
</body>
<?php page_finish(); ?>