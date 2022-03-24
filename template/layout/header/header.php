<link rel="stylesheet" type="text/css" href="/template/common/css/global.css">
<link rel="stylesheet" type="text/css" href="/template/common/css/global.mobile.css">
<link rel="stylesheet" type="text/css" href="/template/layout/header/css/style.css">
<link rel="stylesheet" type="text/css" href="/template/layout/header/css/megamenu.css">
<link rel="stylesheet" type="text/css" href="/template/layout/header/css/nav.mobile.css">
<noscript>You need to enable JavaScript to run this app.</noscript>

<?php
include_once "C:/xampp/htdocs/template/layout/header/routes/about.php";
include_once "C:/xampp/htdocs/template/layout/header/routes/mealplans.php";
include_once "C:/xampp/htdocs/template/layout/header/routes/cateringevent.php";
include_once "C:/xampp/htdocs/template/layout/header/routes/involvement.php";
include_once "C:/xampp/htdocs/template/layout/header/routes/about.php";
?>


<script>
const restaurants = <?php echo json_encode($restaurant_route); ?>;
const mealplan = <?php echo json_encode($mealplans_route); ?>;
const catering = <?php echo json_encode($catering_route); ?>;
const involvement = <?php echo json_encode($involvement_route); ?>;
const about = <?php echo json_encode($about_route); ?>;
</script>
<!-- <script type="text/javascript" src="/template/layout/header/routes/mealplan.js"></script> -->
<!-- <script type="text/javascript" src="/template/layout/header/routes/cateringevent.js"></script> -->
<!-- <script type="text/javascript" src="/template/layout/header/routes/involvement.json"></script> -->
<!-- <script type="text/javascript" src="/template/layout/header/routes/about.js"></script> -->
<!-- <style>
    .corona-box {
        
    }
    .corona-box a {
        display: block;
        width: 100%;
        height: 250px;
        line-height: 250px;
        font-size: 50px;
        color: #fff !important;
        text-align: center;
        background-color: #2e5c8e;
    }
    .corona-box a:hover {
        background-color: #4d6d90;
    }
</style>

<div class="container mt-5 mb-5" style="padding-bottom: 20px;">
    <div class="row">
        <div class="col-md-12 mb-3" style="color: #ac051f; text-align: center; font-size: 45px; font-weight: 500;">Message</div>
        <div class="col-md-6 corona-box"><a>For Students</a></div>
        <div class="col-md-6 corona-box"><a>For Parents</a></div>
    </div>
</div> -->
<section id="su_header" style="display: unset">
	<su-red-banner></su-red-banner>
	 <!--<div style="background-color: #00275b; width: 100%; top: 0px; padding-top: 20px; padding-bottom: 20px;">
		<p style="color: #fff; font-weight: 600; font-size: 20px; text-align: center;">
		The Union site will be down between 7:00 - 8:00 am on Dec. 15 during the server maintenance.
		</p>
	</div> -->
	<su-header>
		<su-navigation>
			<su-mega-dropdown
			id="restaurant"
			name="restaurants"
			url="/dining/"
			>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="restaurants.sumc" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="restaurants.psu" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="restaurants.other" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="restaurants.nutrition" > </div>
			</su-mega-dropdown>

			<su-mega-dropdown
			id="mealplan"
			name="meal plans"
			url="/mealplans/"
			>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="mealplan.login" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="mealplan.get" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="mealplan.swipe" > </div>
				<div class="col-3"> 
					<span><su-mega-dropdown-li v-bind:data="mealplan.honor" /></span>
					<span><su-mega-dropdown-li v-bind:data="mealplan.flyer" /></span>
				</div>
			</su-mega-dropdown>

			<su-mega-dropdown
			id="catering"
			name="Catering & Events"
			url="/catering/"
			>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="catering.plan_form" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="catering.arizona_catering" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="catering.ordering" > </div>
				<div class="col-3"> 
					<!-- <span><su-mega-dropdown-li v-bind:data="catering.guidelines" /></span> -->
					<span><su-mega-dropdown-li v-bind:data="catering.contact" /></span>
				</div>
			</su-mega-dropdown>

			<su-mega-dropdown
			id="involvement"
			name="Involvement & Services"
			url="/involvement/"
			>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="involvement.involvement" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="involvement.involvement2" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="involvement.other" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="involvement.other2" > </div>
			</su-mega-dropdown>

			<su-mega-dropdown
			id="about"
			name="About Unions"
			url="/about/"
			>
				<div class="col-3"> </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="about.about" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="about.about2" > </div>
				<div class="col-3"> <su-mega-dropdown-li v-bind:data="about.about3" > </div>
			</su-mega-dropdown>


		</su-navigation>
		<su-mobile-navigation>

			<su-mobile-nav-li
			title="Restaurants"
			id="restaurant"
			selected="none"
			v-bind:data="restaurants"
			></su-mobile-nav-li>

			<su-mobile-nav-li
			title="Meal Plans"
			id="mealplans"
			selected="none"
			v-bind:data="mealplan"
			></su-mobile-nav-li>

			<su-mobile-nav-li
			title="Involvements"
			id="involvement"
			selected="none"
			v-bind:data="involvement"
			></su-mobile-nav-li>

			<su-mobile-nav-li
			title="About"
			id="about"
			selected="none"
			v-bind:data="about"
			></su-mobile-nav-li>

		</su-mobile-navigation>
	</su-header>
</section>
<script type="text/javascript" src="/template/layout/helper.js"></script>
<script type="text/javascript" src="/template/layout/header/su-mobile-navigation.component.js"></script>
<script type="text/javascript" src="/template/layout/header/su-navigation.component.js"></script>
<script type="text/javascript" src="/template/layout/header/su-red-banner.component.js"></script>
<script type="text/javascript" src="/template/layout/header/su-header.component.js"></script>
