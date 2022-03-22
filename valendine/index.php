<?php
	// header("Location: ../index.php");
//	 die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Valentine Dinner To Go';
  	$page_options['header_image'] = '/template/images/banners/thanksgiving_feast.jpg';
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
		margin-bottom:20px;
	}
	.page_content {
		line-height: 20px;
	}
	.text_description {
		font-size:16px;
	}
	#feast-form{
		width: 100%;
		background: #F4E7D7;
		margin-bottom: 20px;
		margin-top:-20px;
		padding-bottom: 0px;
	}
	.subheader{
		width: 100%;
		height: 16px;
		background: #CC9D66;
		overflow: hidden;
	}
</style>
<!-- <body class="togo_order"> -->
<body>
<div class="container">
<div class="row"><div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/valendine_home.jpg" class="img-fluid" alt=""></div></div>
<?php
	if (isset($_GET["confirm"])) {
?>
<div id="feast-form">
	<div class="subheader">
	</div><br /><br />
	<div style="font-size:20px;font-weight:400;" align="center">Thank you for your order!</div>
	<h3 style="text-align: center;">An email has been sent confirming the details of your order.</h3>
	<br /><br /><br />
	<div class="subheader">
	</div>
</div>
<?php
}
?>
<div class="row page_background mt-2">
<div class="col-12 page_title">Valentine's Day Meals To Go & Bake Sale</div>
<div class="col-12 page_content">
	<p class="text_description">
	This year we are proud to feature a "Dinner for 2" dining experience for your Valentine’s Day celebration at home. The Student Union is accepting reservations for Valentine’s Offerings To-Go, featuring your choice of entrée coupled with your favorite side packages to share.
	</p><br />
	<p class="text_description">
	Reservations can be made by going online <a href="https://union.arizona.edu/ValenDine">https://union.arizona.edu/ValenDine</a> or calling 520-621-7038. All orders must be placed by 12 pm on Thursday, February 10th.  Cancellations must be made by 12 pm on February 10th to avoid charges.  Those not paying online will be contacted Thursday, February 10th for payment. Orders not picked up will be charged the full price for the package. Friday, February 11th or Monday, February 14th, our greeters will meet you at On Deck Deli in SUMC and have your order ready for pick-up.  All you have to do is relax and enjoy the day… we'll do everything else, except the dishes...
	</p><br />
</div>
<br /><br />
<div class="col-12 mt-5">
	<div style="margin-left: auto; margin-right: auto;">
		<a href="/valendine/datenightmenu.php" target="_blank"><img src="/valendine/images/button_dinnertogo.png" width="200" alt="Valentine Dinner To Go"></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<!--<a href="/valendine/alacarte.php" target="_blank"><img src="/template/images/buttons/A La Carte_Button.png" width="200" alt="Valentine A La Carte"></a>&nbsp;&nbsp;&nbsp;&nbsp;-->
		<a href="/valendine/bakesale.php" target="_blank"><img src="/valendine/images/button_bakesale.png" width="200" alt="Valentine Bake Sale"></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/valendine/singlemeals_Valentines_Day_22.pdf" target="_blank"><img src="/valendine/images/button_singlemeals.png" width="200" alt="Valentine Single Meals To GO"></a>
	</div>
</div>
<br /><br /><br />
</div>
</div>
</body>
<?php page_finish(); ?>
