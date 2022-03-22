<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="/template/responsiveslides.min.js"></script>
<link href="/template/responsiveslides.css" rel="stylesheet" type="text/css"/>
 
 

<script type="text/javascript" >
	jQuery(function ($) {
		$(".rslides").responsiveSlides({
			auto : true, // Boolean: Animate automatically, true or false
			speed : 5500, // Integer: Speed of the transition, in milliseconds
			timeout : 6000, // Integer: Time between slide transitions, in milliseconds
			pager : false, // Boolean: Show pager, true or false
			nav : false, // Boolean: Show navigation, true or false
			random : false, // Boolean: Randomize the order of the slides, true or false
			pause : false, // Boolean: Pause on hover, true or false
			pauseControls : true, // Boolean: Pause when hovering controls, true or false
			prevText : "Previous", // String: Text for the "previous" button
			nextText : "Next", // String: Text for the "next" button
			maxwidth : "", // Integer: Max-width of the slideshow, in pixels
			navContainer : "", // Selector: Where controls should be appended to, default is after the 'ul'
			manualControls : "", // Selector: Declare custom pager navigation
			namespace : "rslides", // String: Change the default namespace used
			before : function() {
			}, // Function: Before callback
			after : function() {
			} // Function: After callback
		});
	}); 
</script>

<div style="height:auto; max-height:302px;">
	
	<ul class="rslides" >
		<li>
			<img src="/template/images/banners/catering1.jpg" alt="catering banner">
		</li>
		<li>
			<img src="/template/images/banners/catering2.jpg" alt="catering banner">
		</li>
		<li>
			<img src="/template/images/banners/catering3.jpg" alt="catering banner">
		</li>
		<li>
			<img src="/template/images/banners/catering4.jpg" alt="catering banner">
		</li>
		<li>
			<img src="/template/images/banners/catering5.jpg" alt="catering banner">
		</li>
		<li>
			<img src="/template/images/banners/catering6.jpg" alt="catering banner">
		</li>
		<li>
			<img src="/template/images/banners/catering7.jpg" alt="catering banner">
		</li>
		<li>
			<img src="/template/images/banners/catering8.jpg" alt="catering banner">
		</li>
	</ul>
	
</div>

