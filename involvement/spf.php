<?php
// require_once('global.inc');
require_once($_SERVER['DOCUMENT_ROOT'] . '/infodesk/template/infodesk.main.php');
$page_options = array();
$page_options['title'] = 'Social';
// $page_options['styles']= '#center-col td{vertical-align:top; padding:10px 5px;} #right-col{width:292px;} #center-col{width:470px;} .col{float:left;} .left-space{margin-left:15px;}';
$page_options['styles']= '#center-col td{vertical-align:top; padding:10px 5px;}';
$page_options['page'] = 'Student Union Social Media';
$page_options['header_image'] = '/template/images/banners/about_union_banner.jpg';
// page_start($page_options);
infodesk_start($page_options);
?>
<!-- <div align="center" style="background-color:#000; margin:5px 0px 15px 0px;" class="round-corners">
<iframe width="434" height="302" src="http://www.youtube.com/embed/AG72JoOYG5c" frameborder="0" allowfullscreen></iframe>
</div> -->
<!-- <div id="right-col">
	<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
	<script>
	new TWTR.Widget({
	  version: 2,
	  type: 'profile',
	  rpp: 4,
	  interval: 30000,
	  width: 292,
	  height: 330,
	  theme: {
	    shell: {
	      background: '#333333',
	      color: '#ffffff'
	    },
	    tweets: {
	      background: '#ffffff',
	      color: '#333333',
	      links: '#eb075b'
	    }
	  },
	  features: {
	    scrollbar: false,
	    loop: false,
	    live: false,
	    behavior: 'all'
	  }
	}).render().setUser('arizonaunions').start();
	</script>
	<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FArizonaunions&amp;width=292&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;appId=17228313556" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:590px; margin-top:15px;" allowTransparency="true"></iframe>
</div> -->
<!-- <div id="left-col">
	<img src="/involvement/template/images/SPF_Image.jpg">
</div> -->
<div id="center-col" class="col">
	<div class="col-12">
		<h1 class="mb-0">oh yeah, we're social</h1>
		<hr />
		<div class="row">

			<div class="col-md-12 mb-3">
				<iframe style="width:100%;" height="302" src="https://www.youtube.com/embed/AG72JoOYG5c" frameborder="0" allowfullscreen></iframe>
			</div>

			<table class="col-md-6">
				<tr>
					<td><img src="/involvement/template/images/fbplaces.png" /></td>
					<td>
						<b>Facebook:</b><br />
						<a href="https://facebook.com/arizonaunions" target="_blank">Arizona Student Unions</a><br />
						<br />
						<b>Facebook Places:</b><br />
						<a href="https://www.facebook.com/pages/Bagel-Talk/151274911562182" target="_blank">Bagel Talk</a><br />
						<a href="https://www.facebook.com/pages/Cactus-Grill/125217844211370" target="_blank">Cactus Grill</a><br />
						<a href="https://www.facebook.com/pages/Canyon-Cafe-SUMC/161630527185377" target="_blank">Canyon Cafe</a><br />
						<a href="https://www.facebook.com/pages/Core/167921903235332" target="_blank">Core</a><br />
						<a href="https://www.facebook.com/CoreatPSU" target="_blank">Core PSU</a><br />
						<a href="https://www.facebook.com/pages/Highland-Market/146689895365761" target="_blank">Highland Market</a><br />
						<a href="https://www.facebook.com/pages/Highland-Market/146689895365761" target="_blank">IQ</a><br />
						<a href="https://www.facebook.com/pages/On-Deck-Deli/146203788790819" target="_blank">On Deck Deli</a><br /> 
						<a href="https://www.facebook.com/pages/Redington-Restaurant/152372028137534" target="_blank">Redington Restaurant</a><br />
						<a href="https://www.facebook.com/pages/Sabor/164959176852551" target="_blank">Sabor</a><br />
						<a href="https://www.facebook.com/pages/Umart/180402738660549" target="_blank">UMart</a>
					</td>
				</tr>
				<tr>
					<td><img src="/involvement/template/images/foursquare.png" /></td>
					<td>
						<b>Foursquare Places:</b><br />
						<a href="https://foursquare.com/v/bagel-talk/4bba6d1ccf2fc9b63e8da102" target="_blank">Bagel Talk</a><br />
						<a href="https://foursquare.com/v/cactus-grill/4b4f8f04f964a520600b27e3" target="_blank">Cactus Grill</a><br />
						<a href="https://foursquare.com/v/canyon-cafe/4b0586cff964a520916f22e3" target="_blank">Canyon Cafe</a><br />
						<a href="https://foursquare.com/v/core-sumc/4b883148f964a52063e631e3" target="_blank">Core</a><br />
						<a href="https://foursquare.com/v/core-psu/4d90e140fa943704e43f3cc6" target="_blank">Core PSU</a><br />
						<a href="https://foursquare.com/v/highland-market/4b27fd16f964a520528d24e3" target="_blank">Highland Market</a><br />
						<a href="https://foursquare.com/v/iq-fresh/4b7abb54f964a520b8392fe3" target="_blank">IQ</a><br />
						<a href="https://foursquare.com/v/on-deck-deli/4ba10646f964a5201c9037e3" target="_blank">On Deck Deli</a><br /> 
						<a href="https://foursquare.com/v/redington-restaurant-sumc/4bb50b700ef1c9b6ecccf412" target="_blank">Redington Restaurant</a><br />
						<a href="https://foursquare.com/v/sabor-mexican-fare/4e4d641eb0fb84443d41b1c0" target="_blank">Sabor</a><br />
						<a href="https://foursquare.com/v/umart/4b5a2f7ef964a520c7b228e3" target="_blank">UMart</a>
					</td>
				</tr>
			</table>

			<table class="col-md-6">
				<tr>
					<td><img src="/involvement/template/images/google.png" /></td>
					<td>
						<b>Google+:</b><br />
						<a href="https://plus.google.com/u/0/b/107547940930443377348/" target="_blank">Arizona Student Unions</a>
					</td>
				</tr>
				<tr>
					<td><img src="/involvement/template/images/youtube.png" /></td>
					<td>
						<b>YouTube</b><br />
						<a href="https://www.youtube.com/arizonastudentunions" target="_blank">Arizona Student Unions</a>
					</td>
				</tr>
				<tr>
					<td><img src="/involvement/template/images/twitter.png" /></td>
					<td>
						<b>Twitter:</b><br />
						<a href="https://twitter.com/#!/arizonaunions" target="_blank">Arizona Student Unions</a>
					</td>
				</tr>
			</table>

		</div>
	</div>

	<div class="col-md-12">
		<script charset="utf-8" src="https://widgets.twimg.com/j/2/widget.js"></script>
		<script>
		new TWTR.Widget({
		version: 2,
		type: 'profile',
		rpp: 4,
		interval: 30000,
		width: 500,
		height: 330,
		theme: {
			shell: {
			background: '#333333',
			color: '#ffffff'
			},
			tweets: {
			background: '#ffffff',
			color: '#333333',
			links: '#eb075b'
			}
		},
		features: {
			scrollbar: false,
			loop: false,
			live: false,
			behavior: 'all'
		}
		}).render().setUser('arizonaunions').start();
		</script>
		<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FArizonaunions&amp;width=400&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;appId=17228313556" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:590px; margin-top:0px;" allowTransparency="true"></iframe>
	</div>

</div>

<!-- <div class="col">
	<iframe width="434" height="302" src="http://www.youtube.com/embed/AG72JoOYG5c" frameborder="0" allowfullscreen></iframe>
	<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
	<script>
	new TWTR.Widget({
	  version: 2,
	  type: 'profile',
	  rpp: 4,
	  interval: 30000,
	  width: 292,
	  height: 330,
	  theme: {
	    shell: {
	      background: '#333333',
	      color: '#ffffff'
	    },
	    tweets: {
	      background: '#ffffff',
	      color: '#333333',
	      links: '#eb075b'
	    }
	  },
	  features: {
	    scrollbar: false,
	    loop: false,
	    live: false,
	    behavior: 'all'
	  }
	}).render().setUser('arizonaunions').start();
	</script>
	<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FArizonaunions&amp;width=292&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;appId=17228313556" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:590px; margin-top:15px;" allowTransparency="true"></iframe>
</div> -->

<?php
page_finish();
