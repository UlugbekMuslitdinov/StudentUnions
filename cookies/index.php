<?php
	// header("Location: https://union.arizona.edu/celebrationcookies/index.php");
	// die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Celebration Cookies';
	page_start($page_options);	
	// DIsplay confirmation after Feast submission.
    // $confirm = $_GET["confirm"];
?>
<style type="text/css">
	body.togo_order {
		background: #F4E7D7 !important;
	}
	.page_background {
		background: #FFFFFF;
		margin-top:-20px;
		padding:10px;
	}
	.page_title {
		font-size: 24px;
		font-weight: 600;			
		color: orangered;
		margin-top: -20px;
		margin-bottom:20px;
		line-height: 30px;
	}
	.page_content {
		line-height: 20px;
	}
	.text_description {
		font-size:16px;
	}
	.subheader{
		width: 100%;
		height: 16px;
		background: #CC9D66;
		overflow: hidden;
	}
</style>
<body>
<div class="container">
<div class="row"><div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/CelebrationCookieBanner.jpg" class="img-fluid" alt=""></div></div>
<div class="row page_background mt-2">
<h2 style="margin-top:0px;">Each mouth-watering butter cookie is gently glazed with a sweetened velvet smooth icing and hand-decorated by our cookie artists.<br /><br />Ordering website will launch on April 19.  Cookie pick-up will begin April 26 at The Scoop location at the Student Unions Memorial Center.</h2>
<!--<div class="col-12 page_title">Celebration Cookies</div>--><p>&nbsp;</p>
<div class="col-12 page_content">
	<p class="text_description">
<div class="col-12 page_content" style="font-weight:bold; margin-left: 20px;">
	<a href="./order.php"><img src="images/CookiesSpring.jpg" alt="Spring Cookies" width="1042" height="146"></a>
	<div width="80%" align="left"><p class="text_description">
	<h1>Celebrate with a delicious Cookie Bouquet or Box!</h1>
	<div class="page_title">
	Potted Cookie Bouquet - $19.99<br />
	Spring Cookie 4-Pack - $9.99<br />
	Spring Cookie 5-Pack - $11.99
	</div>
	</p></div>
	<div align="center"><a href="./order.php"><img src="/template/images/banners/CelebrationCookieBanner.jpg" alt="Spring Cookies" width="400" height="105"></a></div><br /><br /><br />
	<a href="./order.php"><img src="images/CookiesGrad.jpg" alt="Graduation Cookies" width="1042" height="146"></a>
	<div width="80%" align="left"><p class="text_description">
	<h1>Celebrate with a delicious Cookie Bouquet or Box!</h1>
	<div class="page_title">
	Potted Cookie Bouquet - $19.99<br />
	Graduation Cookie 4-Pack - $9.99<br />
	Graduation Cookie 5-Pack - $11.99<br />
	Sports Cookie 5-Pack - $11.99
	</div>
	</p></div>
	<div align="center"><a href="./order.php"><img src="images/CookiesGradOrder.png" alt="Spring Cookies" width="400" height="90"></a></div><br /><br /><br /><br />
	
</div><br /><br /><br />
</div>
</div>
</body>
<?php page_finish(); ?>
