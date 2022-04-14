<?php
	//header("Location: https://union.arizona.edu/celebrationcookies/index.php");
//	die();
	require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
	$page_options['title'] = 'Celebration Cookies';
	page_start($page_options);	
	// DIsplay confirmation after Feast submission.
    // $confirm = $_GET["confirm"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Document</title>
</head>
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
<div class="row"><div class="col-md-12 wrap-banner-img mb-0"><img src="/template/images/banners/CookieBanner.jpg" class="img-fluid" alt=""></div></div>
<div class="row page_background mt-2">
<h2 style="margin-top:0px;">Each mouth-watering butter cookie is gently glazed with a sweetened velvet smooth icing and hand-decorated by our cookie artists.<br /><br />Ordering website will launch on April 18.  Cookie pick-up will begin April 18 at The Scoop location at the Student Unions Memorial Center.</h2>
<!--<div class="col-12 page_title">Celebration Cookies</div>--><p>&nbsp;</p>
<div class="col-12 page_content">
	<p class="text_description">





<div style="margin: 30px">
	<a href="./order.php"><img src="images/SpringBanner.jpg" alt="Spring Cookies" width="100%" height="146" style="margin-bottom: -20px"></a>
	<div width="100%" align="left"><p class="text_description">
	<div class="mb-5" style="border: 5px solid #287d7d; border-radius: 0 0 30px 30px">
	<div class="row row-cols-1 row-cols-md-2 mb-2 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body">
		  <img src="images/SpringBox.png" width="70%" alt="Spring Box"/><br />
		  <div class="mt-3 mb-4 ml-5 mr-5 border border-primary border-2 rounded-3">
			  <h4>Spring Box</h4>
			  5-pack: $12.99
			</div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body">
		  <img src="images/ArizonaBox.png" width="70%" alt="Spring Box"/><br />
		  <div class="mt-3 mb-4 ml-5 mr-5 border border-primary border-2 rounded-3">
			  <h4>Easter Box</h4>
			  5-pack: $12.99
			</div>
          </div>
        </div>
      </div>
</div>
</div>



<div style="margin: 30px">
	<a href="./order.php"><img src="images/GradBanner.jpg" alt="Spring Cookies" width="100%" height="146" style="margin-bottom: -20px"></a>
	<div width="100%" align="left"><p class="text_description">
	<div class="mb-5" style="border: 5px solid #a1292b; border-radius: 0 0 30px 30px">
	<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body">
		  <img src="images/GradBox.png" width="70%" alt="Spring Box"/><br />
		  <div class="mt-3 mb-4 ml-5 mr-5 border border-danger border-2 rounded-3">
			  <h4>Grad Box</h4>
			  5-pack:$14.99
			</div>
          </div>
        </div>
      </div>

     <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body">
		  <img src="images/BaseballBox.png" width="70%" alt="Spring Box"/><br />
		  <div class="mt-3 mb-4 ml-5 mr-5 border border-danger border-2 rounded-3">
			  <h4>Easter Box</h4>
			  5-pack: $14.99
			</div>
          </div>
        </div>
      </div> 

	  <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body">
		  <img src="images/BasketballBox.png" width="70%" alt="Spring Box"/><br />
		  <div class="mt-3 mb-4 ml-5 mr-5 border border-danger border-2 rounded-3">
			  <h4>Easter Box</h4>
			  5-pack: $14.99
			</div>
          </div>
        </div>
      </div>

	</div>

	<div class="row row-cols-1 row-cols-md-1 mb-2 text-center">

	<div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-body d-flex justify-content-center">
		  <img src="images/ABox.png" width="20%" alt="Spring Box" class="w-30"/>

		  <div class="mt-3 mb-4 border border-danger border-2 rounded-3 flex-shrink-1 bd-highlight w-70">
			  <h4>Easter Box</h4>
			  5-pack: $14.99
			</div>
          </div>
        </div>
      </div>

	</div>
</div>



	<a href="./order.php"><img src="images/GradBanner.jpg" alt="Graduation Cookies" width="1042" height="146"></a>
	<div width="80%" align="left"><p class="text_description">
	<h1>Celebrate with a delicious Cookie Bouquet or Box!</h1>
	<div class="page_title">
	Graduation Cookie 5-Pack - $14.99<br />
	"A" Cookie 4-Pack - $14.99<br />
	Sports Cookie 5-Pack - $14.99<br />
	</div>
	</p></div>
	<div align="center"><a href="./order.php"><img src="images/OrderHere.png" alt="Order" width="200" height=""></a></div><br /><br /><br /><br />
	
</div><br /><br /><br />
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
<?php page_finish(); ?>
