<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
//require_once ('../involvement/involv.inc');
$page_options = array();
$page_options['title'] = 'Arizona Catering Company';
// $page_options['header_image'] = '/template/images/banners/involvement.jpg';
page_start($page_options);
?>
<style type="text/css" >
	.center-list li {
		margin-top: 1.5em !important;
	}	
	.center-list a:active, .center-list a:link, .center-list a:visited {
		color: #444444 !important;
		font-weight: bold !important;
	}
	.center-list a:hover {
		color: #CC0033 !important;
		font-weight: bold !important;
	}
</style>
<link rel="stylesheet" type="text/css" href="catering_main_style.css">
<link rel="stylesheet" type="text/css" href="lib/wallop/wallop.css">
<link rel="stylesheet" type="text/css" href="lib/wallop/wallop--fade.css">

<div class="wrap_catering" style="margin-top: 5px;">
	
	<div class="c_header">
		<img src="images/catering_banner.jpg">
	</div>

	<div style="background-color: #00275b; width: 100%; top: 0px; padding-top: 20px; padding-bottom: 20px; margin-top: 20px;">
		<p style="margin-bottom: 0px; color: #fff; font-weight: 600; font-size: 20px; text-align: center;">
			Due to COVID-19 we are re-evaluating our menu selections. Please contact your Event Planner or call the Event Planning Office at 621-1414.
		</p>
	</div>

	<div class="c_content">
		<div class="cc_top">
			<img src="images/gold_rule.jpg">
		</div>

		<div class="cc_left">
			<img src="images/intro_box.png">
		</div>

		<div class="cc_right">
			<ul class="ccr_nav">

				<li class="nav_li_no_child">
					<a href="/catering/team/" target="_blank" >
						<img src="images/meet_the_team.jpg">
					</a>
				</li>

				<li class="nav_li_1 nav_li" id="nav_li_1">
					<a class="nav_li_a">
						<img src="images/nav_guidelines.png">
					</a>
					<div class="ccr_subnav">
						<ul class="subnav_ul">
							<li class="subnav_li">
								<a href="resources/catering_event_guidelines.pdf" target="_blank" >Catering & Events</a>
							</li>
							<li class="subnav_li">
								<a href="../rooms/audiovisual.php" target="_blank" >Audio & Visual</a>
							</li>
							<li class="subnav_li">
								<a href="../alcohol/index.php" target="_blank" >Alcohol</a>
							</li>
							<li class="subnav_li">
								<a href="../rooms/reserving.php" target="_blank" >Room & Layout Maps</a>
							</li>
							<li class="subnav_li">
								<a href="../rooms/banner_policies.php" target="_blank" >Banner Guidelines</a>
							</li>
							<li class="subnav_li">
								<a href="../operations/policies/index.php" target="_blank" >Union Guidelines</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav_li_2 nav_li" id="nav_li_2">
					<a class="nav_li_a" href="/catering/request/event">
						<img src="images/nav_catering_form.png">
					</a>
					<!-- <div class="ccr_subnav">
						<ul class="subnav_ul">
							<li class="subnav_li">
								<a href="resources/room_catering_form.pdf" target="_blank" >Unions Room & Catering</a>
							</li>
							<li class="subnav_li">
								<a href="resources/offsite_form.pdf" target="_blank" >Campus & Offsite Catering</a>
							</li>
						</ul>
					</div> -->
				</li>

				<!-- <li class="nav_li_3 nav_li" id="nav_li_3">
					<a class="nav_li_a">
						<img src="images/nav_catering_menu.png">
					</a>
					<div class="ccr_subnav">
						<ul class="subnav_ul">
							<li class="subnav_li">
								<a href="resources/Catering_Menus_18_Breakfast.pdf" target="_blank">Breakfast</a>
							</li>
							<li class="subnav_li">
								<a href="resources/Catering_Menus_18_Lunch.pdf" target="_blank">Lunch</a>
							</li>
							<li class="subnav_li">
								<a href="resources/Catering_Menus_18_Dinner.pdf" target="_blank" >Dinner</a>
							</li>
							<li class="subnav_li">
								<a href="resources/Catering Menus_18_Cakes&Desserts.pdf" target="_blank" >Cakes & Desserts</a>
							</li>
							<li class="subnav_li">
								<a href="resources/Catering Menus_18_Snacks&Breaks.pdf" target="_blank" >Snacks & Breaks</a>
							</li>
							<li class="subnav_li">
								<a href="resources/Catering_Menus_Beverage.pdf" target="_blank" >Beverages</a>
							</li>
							<li class="subnav_li">
								<a href="resources/Catering Menus_18_Reception.pdf" target="_blank" >Reception</a>
							</li>
						</ul>
					</div>
				</li> -->

				<li class="nav_li_contact">
					<a href="../catering/contact_us.php" target="_blank" >
						<img src="images/nav_contact_us.jpg">
					</a>
				</li>

			</ul>
		</div>

		<div class="cc_bottom">
			<img src="images/gold_rule.jpg">
		</div>
	</div>

	<div class="c_footer">
		<div class="Wallop Wallop--fade">
			<div class="Wallop-list">
				<div class="Wallop-item">
					<img src="images/slides/slide1.jpg">
				</div>
				<div class="Wallop-item">
					<img src="images/slides/slide2.jpg">
				</div>
				<!-- <div class="Wallop-item">
					<img src="images/slides/slide3.jpg">
				</div> -->
				<div class="Wallop-item">
					<img src="images/slides/slide4.jpg">
				</div>
				<!-- <div class="Wallop-item">
					<img src="images/slides/slide5.jpg">
				</div> -->
				<div class="Wallop-item">
					<img src="images/slides/slide6.jpg">
				</div>
				<div class="Wallop-item">
					<img src="images/slides/slide7.jpg">
				</div>
				<div class="Wallop-item">
					<img src="images/slides/slide8.jpg">
				</div>
			</div>
			<!-- <button class="Wallop-buttonPrevious">Previous</button>
			<button class="Wallop-buttonNext">Next</button> -->
		</div>
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="lib/wallop/Wallop.min.js"></script>
<script type="text/javascript">
	var sub_nav_open = false;
	var current_open_nav = '';

	$('.nav_li').on('click', function(event){
		
		// check status of dropdown
		if (sub_nav_open)
		{
			// Check if different nav is clicked
			var selected_id = $(this).attr('id');
			if (selected_id == current_open_nav)
			{
				// Only Close current one
				$('#'+current_open_nav).find('.ccr_subnav').slideUp();
				sub_nav_open = false;
				current_open_nav = '';
			}
			else
			{
				// Close previous one and open current one
				$('#'+current_open_nav).find('.ccr_subnav').slideUp();
				$(this).find('.ccr_subnav').slideDown();
				sub_nav_open = true;
				current_open_nav = $(this).attr('id');
			}

		}
		else
		{
			// Slide Up
			$(this).find('.ccr_subnav').slideDown();
			sub_nav_open = true;
			current_open_nav = $(this).attr('id');
		}

	});


	// var nav_order = -1;
	// $('body').on('click',function(event){
	// 	var className = $(event.target).attr('class');
	// 	if (className == 'nav_li_1' || className == 'nav_li_2' || className == 'nav_li_3')
	// 	{
	// 		if (!sub_nav_open)
	// 		{
	// 			sub_nav_open = true;
	// 			// console.log($(event.target).parent());
	// 			$('.'+className).find('.ccr_subnav').slideDown();
	// 			prev_nav = className;
	// 			// nav_order = $('.'+className).index();
	// 		}
	// 		else
	// 		{
	// 			// Check if another nav_li is chosen
	// 			if (prev_nav != className)
	// 			{
	// 				$('.'+prev_nav).find('.ccr_subnav').slideUp();
	// 				prev_nav = className;
	// 				$('.'+prev_nav).find('.ccr_subnav').slideDown();
	// 			}
	// 		}

	// 	}
	// 	else if (className == 'nav_li_a')
	// 	{
	// 		if (!sub_nav_open)
	// 		{
	// 			sub_nav_open = true;
	// 			prev_nav = $(event.target).parent().attr('class');
	// 			$(event.target).parent().find('.ccr_subnav').slideDown();
	// 		}
	// 	}

	// });

	// $('body').on('mouseover',function(event){
	// 	var className = $(event.target).attr('class');
	// 	if (className == 'nav_li_no_child' || className == 'cc_right' || className == 'cc_left' || className == '')
	// 	{
	// 		if (sub_nav_open)
	// 		{
	// 			if (prev_nav != '')
	// 			{
	// 				sub_nav_open = false;
	// 				$('.'+prev_nav).find('.ccr_subnav').slideUp();
	// 				prev_nav = '';
	// 			}
	// 		}
	// 	}
	// });

	var wallopEl = document.querySelector('.Wallop');
 	var slider = new Wallop(wallopEl);

 	autoplay(3000);

 	function autoplay(interval) {
		var lastTime = 0;  

		function frame(timestamp) {
			var update = timestamp - lastTime >= interval;

			if (update) {
				slider.next();
				lastTime = timestamp;
			}

			requestAnimationFrame(frame);
		}

		requestAnimationFrame(frame);
	};
</script>
<?php page_finish(); ?>
