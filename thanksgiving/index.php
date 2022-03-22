<?php
	// header("Location: ../index.php");
	// die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Thanksgiving Feast To Go';
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
<div class="row"><div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/thanksgiving_feast.jpg" class="img-fluid" alt=""></div></div>
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
<div class="col-12 page_title">Thanksgiving Offerings To-Go and Bake Sale!</div>
<div class="col-12 page_content">
	<p class="text_description">
	This year we are proud to feature a "Create Your Own Feast" dining experience for your Thanksgiving celebration at home. Beginning <b>November 8, 2021</b> Student Union will begin accepting reservation for the 2021 <b>Thanksgiving Offerings To-Go</b>. 
	</p><br />
	<p class="text_description">
	We will be featuring base entree packages this year with additional side selection available to accommodate your favorite sides.  The deadline for placing or canceling an order is <b>November 23, 2021</b>.  Credit card is required to guarantee every order.  Orders not picked up will be charged the full price for the package.  Thanksgiving Eve, our greeters will meet you at On Deck Deli or deliver your meal box to the circle drive and have your order ready for pick-up. All you have to do is relax and enjoy the day... we'll do everything else, except the dishes. 
	</p><br />
	<p class="text_description">
	<b>HEY STUDENTS!</b> If you're staying in Tucson for Thanksgiving, click <a href="https://www.eventbrite.com/e/uarizona-thanksgiving-grab-n-go-meals-registration-210209240497" target="_blank"><u><b>HERE</b></u></a> to order your FREE GRAB-N-GO MEAL!*<br /><b>Orders must be received by 5:00PM on Monday, November 22, 2021.*</b>  <i>Available while supplies last.</i>
	</p><br />
</div>
<br /><br />
<div class="col-12 mt-5">
	<div style="margin-left: auto; margin-right: auto;">
		
		<a href="/dining/sumc/thanksgiving.php" target="_blank"><img src="/template/images/buttons/thanksgiving_feast_to_go.png" alt="Thanksgiving Offerings To Go" width="180" height="72"></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/dining/sumc/thanksgiving_sides.php" target="_blank"><img src="/template/images/buttons/thanksgiving_side.png" alt="Thanksgiving Side Offerings To Go" width="180" height="72"></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/dining/forms/bakesale.php" target="_blank"><img src="/template/images/buttons/bake_sale.png" alt="Holiday Bake Sale" width="180" height="72"></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="/thanksgiving/MealToGo.pdf" target="_blank"><img src="/template/images/buttons/mealstogo.png" alt="Meals To Go" width="180" height="72"></a>&nbsp;&nbsp;&nbsp;&nbsp;
		
	</div>
</div>
<br /><br /><br />
</div>
</div>
</body>
<?php page_finish(); ?>
