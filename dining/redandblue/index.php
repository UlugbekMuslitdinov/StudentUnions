<?php 
require_once('dining.inc');
$page_options['page'] = 'redblue';
$page_options['header_image'] = '/template/images/banners/rbm_banner.png';
$page_options['header_alt'] = 'Red and Blue Market';
$page_options['video_image'] = '/template/images/photos/video_placeholder.jpg';
$page_options['video_alt'] = 'Dining Video';
	
$page_options['styles'] .= 'h1 {margin-bottom:20px}';
$page_options['styles'] .= '#center-col h2, #center-col h2 a:active, #center-col h2 a:link, #center-col h2 a:hover, #center-col h2 a:visited{ font-size:11px; color:#393939;}';
$page_options['styles'] .= '#center-col h2 a:hover{ color:#cc0033; }';
$page_options['styles'] .= '#center-col p{font-size:9px; margin:0px; margin-bottom:8px; line-height:11px;}';
$page_options['styles'] .= '#center-col p a:active, #center-col p a:link, #center-col p a:hover, #center-col p a:visited{ font-size:9px;}';
$page_options['styles'] .= '.black-button { height:20px; width:118px; text-align:center; background-color:#393939; float:left; margin-right:12px;}';
$page_options['styles'] .= '#center-col .black-button a:active, #center-col .black-button a:link, #center-col .black-button a:hover, #center-col .black-button a:visited{ color:#ffffff; line-height:20px; font-size:13px; font-weight:bold;}';
$page_options['styles'] .= '#location-description p{font-size:12px; line-height:14px;}';
$page_options['styles'] .= '#location-description p a:active, #location-description p a:link, #location-description p a:hover, #location-description p a:visited{ font-size:12px;}';
	
$page_options['has_mobile_version'] = 1;
$no_menu = array(31, 32, 2, 57, 24, 29, 26, 36, 37, 65, 66, 67);

$coming_soon = array();
/* "Now Open" places get a "Now Open"
 * indicator next to their name
 */
$now_open = array(20, 67);

$page_options['ad'] = '<a href="http://www.youtube.com/embed/oG7sMjd1t54?autoplay=1" rel="shadowbox;width=560;height=347;"><img src="/dining/healthy/images/Healthy_video_still.jpg"></a>';

dining_start($page_options);  
?>
<link rel="stylesheet" type="text/css" href="/template/expand.css" />
<link rel="stylesheet" type="text/css" href="/template/red-blue.css" />


<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>

<script  type="text/javascript" src="/template/expand.js"></script>
<script type="text/javascript">
	$(function() {
		// --- Using the default options:
		$("div.expand").toggler();
		// --- Other options:
		//$("h2.expand").toggler({method: "toggle", speed: 0});
		//$("h2.expand").toggler({method: "toggle"});
		//$("h2.expand").toggler({speed: "fast"});
		//$("h2.expand").toggler({method: "fadeToggle"});
		//$("h2.expand").toggler({method: "slideFadeToggle"});
		$("#content").expandAll({
			trigger : "li.expand",
			ref : "div.demo",
			localLinks : "p.top a"
		});
	}); 
</script>
<script type="text/javascript" >
		// alternate gray rows
		$(function() {
			$('.menu tr:even').addClass('grayrow');
		});
</script>
	<h1>All your go-tos. To go.</h1>
	
	<p>You know what it’s like to grab a bite between classes. You have ten minutes to run
	across campus. You have to trample some innocent bystanders just to get out of class,
	and you get stuck… (stuck)… (still stuck)… behind a wall of slow walkers EVERY. SINGLE. TIME.
	</p>
	
	<p>Thankfully Red & Blue Market, the UA’s line of to-go meals, is here to make eating
	on the go easy. Find sandwiches, salads, sushi, gluten free, and vegan choices at
	Pangea, U-Mart, and other campus convenience stores today!</p>

	<p>
		Okay. Deep breath.
	</p>
	<br/>
	
	<div id="sushi" class="expand"><span style="font-weight: bold">PANGEA SUSHI</span></div>
	<div class="collapse">
		
		<div class="category">NIGIRI (3 pieces)</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Edamame Vegan</td>
				<td class="menu-item">$2.35</td>
			</tr>
			<tr>
				<td class="menu-item">Inari</td>
				<td class="menu-item">$2.95</td>
			</tr>
		</table>
		<br/>
		<div class="category">MAKI SUSHI (Full roll)</div>
		<table class="menu">
			<tr>
				<td class="menu-item">California Roll</td>
				<td class="menu-item">$5.55</td>
			</tr>
			<tr>
				<td class="menu-item">Surimi Crab Roll</td>
				<td class="menu-item">$5.55</td>
			</tr>
			<tr>
				<td class="menu-item">Philadelphia Roll</td>
				<td class="menu-item">$5.55</td>
			</tr>
			<tr>
				<td class="menu-item">Spicy Tuna Roll</td>
				<td class="menu-item">$5.85</td>
			</tr>
			<tr>
				<td class="menu-item">Vegetarian Roll</td>
				<td class="menu-item">$4.85</td>
			</tr>
			<tr>
				<td class="menu-item">Salmon Poke Roll</td>
				<td class="menu-item">$5.85</td>
			</tr>
		</table>
		<br/>
		<div class="category">COMBO PACKS (8 pieces)</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Hamachi, Tuna, Ebi, &amp; California</td>
				<td class="menu-item">$7.55</td>
			</tr>
			<tr>
				<td class="menu-item">Unagi, Ebi Nigiri, Spicy Salmon Roll</td>
				<td class="menu-item">$8.75</td>
			</tr>
		</table>
		<br/>
	</div>
	
	<div id="redblue" class="expand"><span style="font-weight: bold">RED & BLUE</span></div>
	<div class="collapse">
		<div class="category">SANDWICHES</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Peanut Butter and Jelly Sandwich</td>
				<td class="menu-item">$1.65</td>
			</tr>
			<tr>
				<td class="menu-item">Turkey Sandwich on Croissant</td>
				<td class="menu-item">$3.95</td>
			</tr>
			<tr>
				<td class="menu-item">Tuna Sandwich</td>
				<td class="menu-item">$3.45</td>
			</tr>
			<tr>
				<td class="menu-item">Egg Salad Sandwich</td>
				<td class="menu-item">$3.45</td>
			</tr>
			<tr>
				<td class="menu-item">Turkey and Provolone Sandwich</td>
				<td class="menu-item">$3.95</td>
			</tr>
			<tr>
				<td class="menu-item">Ham and Swiss Sandwich</td>
				<td class="menu-item">$3.95</td>
			</tr>
			<tr>
				<td class="menu-item">Chunky Chicken Sandwich</td>
				<td class="menu-item">$3.95</td>
			</tr>
		</table>
		<br/>
		<div class="category">WRAPS</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Buffalo  Chicken Wrap</td>
				<td class="menu-item">$4.15</td>
			</tr>
			<tr>
				<td class="menu-item">Turkey Club Wrap</td>
				<td class="menu-item">$4.95</td>
			</tr>
			<tr>
				<td class="menu-item">Roast Beef &amp; Blue Cheese Wrap</td>
				<td class="menu-item">$3.95</td>
			</tr>
			<tr>
				<td class="menu-item">Bombay Chicken Wrap</td>
				<td class="menu-item">$3.95</td>
			</tr>
		</table>
		<br/>
		<div class="category">PARFAITS</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Strawberry Parfait</td>
				<td class="menu-item">$3.55</td>
			</tr>
			<tr>
				<td class="menu-item">Blueberry Parfait</td>
				<td class="menu-item">$3.55</td>
			</tr>
			<tr>
				<td class="menu-item">Honey and Greek Yogurt Parfait</td>
				<td class="menu-item">$3.95</td>
			</tr>
		</table> 
		<br/>
		<div class="category">SALADS AND OTHERS</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Caesar Salad w/ Dressing</td>
				<td class="menu-item">$4.95</td>
			</tr>
			<tr>
				<td class="menu-item">Buffalo Chicken Salad w/ Dressing</td>
				<td class="menu-item">$5.45</td>
			</tr> 
			<tr>
				<td class="menu-item">Chicken Caesar Salad</td>
				<td class="menu-item">$5.95</td>
			</tr> 
			<tr>
				<td class="menu-item">Chef Salad w/ Dressing</td>
				<td class="menu-item">$5.95</td>
			</tr> 
			<tr>
				<td class="menu-item">Chicken Signature Salad</td>
				<td class="menu-item">$6.95</td>
			</tr>
			<tr>
				<td class="menu-item">Roasted Red Pepper Hummus</td>
				<td class="menu-item">$2.55</td>
			</tr>  
		</table> 
	</div>
	
	<div id="glutenfree" class="expand"><span style="font-weight: bold">GLUTEN FREE</span></div>
	<div class="collapse">
		<div class="category">SANDWICHES</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Peanut Butter and Jelly Sandwich (GF)</td>
				<td class="menu-item">$4.95</td>
			</tr>
			<tr>
				<td class="menu-item">Ham and Swiss Sandwich (GF)</td>
				<td class="menu-item">$5.95</td>
			</tr>
			<tr>
				<td class="menu-item">Turkey and Provolone Sandwich (GF)</td>
				<td class="menu-item">$5.95</td>
			</tr>
		</table> 
		<br/>
		<div class="category">WRAPS</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Chicken Basil Wrap (GF)</td>
				<td class="menu-item">$6.55</td>
			</tr>
			<tr>
				<td class="menu-item">Roast Vegetable Wrap w/ Hummus (GF)</td>
				<td class="menu-item">$5.95</td>
			</tr>
			<tr>
				<td class="menu-item">Turkey Club Wrap (GF)</td>
				<td class="menu-item">$6.55</td>
			</tr>  
		</table> 
		<br/>
		<div class="category">SALADS AND OTHER</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Cobb Salad w/ Dressing</td>
				<td class="menu-item">$5.95</td>
			</tr>
			<tr>
				<td class="menu-item">Crudite with Choice of Dressing</td>
				<td class="menu-item">$3.45</td>
			</tr>
			<tr>
				<td class="menu-item">Crudite w/ out Dressing</td>
				<td class="menu-item">$2.95</td>
			</tr> 
			<tr>
				<td class="menu-item">Fruit Plate</td>
				<td class="menu-item">$5.65</td>
			</tr> 
			<tr>
				<td class="menu-item">Fruit Cup</td>
				<td class="menu-item">$2.55</td>
			</tr>   
		</table> 
	</div>
	
	<div id="vegan" class="expand"><span style="font-weight: bold">VEGAN</span></div>
	<div class="collapse">
		<div class="category">SANDWICHES</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Veggie Sandwich</td>
				<td class="menu-item">$3.55</td>
			</tr>
			<tr>
				<td class="menu-item">9 Grain Sandwich</td>
				<td class="menu-item">$3.55</td>
			</tr>
		</table> 
		<br/>
		<div class="category">SALADS AND OTHERS</div>
		<table class="menu">
			<tr>
				<td class="menu-item">Red & Blue Salad w/ Dressing</td>
				<td class="menu-item">$5.25</td>
			</tr>
			<tr>
				<td class="menu-item">Edamame, Lentil and Bean Salad</td>
				<td class="menu-item">$2.25</td>
			</tr>
			<tr>
				<td class="menu-item">Southwest Pita</td>
				<td class="menu-item">$3.25</td>
			</tr>
			<tr>
				<td class="menu-item">Tofu Pita W/ Hummus </td>
				<td class="menu-item">$3.25</td>
			</tr>
		</table> 
	</div>	
<?php
dining_finish();
?>

















