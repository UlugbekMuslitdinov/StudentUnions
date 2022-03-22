<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/template/' . 'global.inc');
$page_options['title'] = 'Arizona Catering Company';
require_once ('deliverance.inc.php');
page_start($page_options);

?>
<?php
require_once ('catering_slider.inc.php');
?>
<div id="catering_page" >
<?php
require_once ('catering_left_col.inc.php');
?>

<link rel="StyleSheet" href="/template/catering.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="/template/fancyapps-fancyBox-18d1712/source/jquery.fancybox.css" type="text/css"/>
<script type="text/javascript" src="/template/fancyapps-fancyBox-18d1712/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	false 
		});
	});
</script>
<div id="center-col" >
	<h2>Arizona Catering Co.</h2>
	<p>
		Click on any of the images below to see a larger image.
	</p>
	
	<div class="gallery-col">
		<ul> 
			<li><a class="fancybox" rel="image1" href="/template/images/gallery/01_big.jpg"><img src="/template/images/gallery/01_small.jpg" alt="image1" /></a></li>
			<li><a class="fancybox" rel="image2" href="/template/images/gallery/02_big.jpg"><img src="/template/images/gallery/02_small.jpg" alt="image2" /></a></li>
			<li><a class="fancybox" rel="image3" href="/template/images/gallery/03_big.jpg"><img src="/template/images/gallery/03_small.jpg" alt="image3" /></a></li>
		</ul> 
		
	</div>

	<div class="gallery-col">
		<ul> 
			<li><a class="fancybox" rel="image4" href="/template/images/gallery/04_big.jpg"><img src="/template/images/gallery/04_small.jpg" alt="image4" /></a></li>
			<li><a class="fancybox" rel="image5" href="/template/images/gallery/05_big.jpg"><img src="/template/images/gallery/05_small.jpg" alt="image5" /></a></li>
			<li><a class="fancybox" rel="image6" href="/template/images/gallery/06_big.jpg"><img src="/template/images/gallery/06_small.jpg" alt="image6" /></a></li>
		</ul> 
		
	</div>
	
	<div class="gallery-col">
		<ul> 
			<li><a class="fancybox" rel="image7" href="/template/images/gallery/07_big.jpg"><img src="/template/images/gallery/07_small.jpg" alt="image7" /></a></li>
			<li><a class="fancybox" rel="image8" href="/template/images/gallery/08_big.jpg"><img src="/template/images/gallery/08_small.jpg" alt="image8" /></a></li>
			<li><a class="fancybox" rel="image9" href="/template/images/gallery/09_big.jpg"><img src="/template/images/gallery/09_small.jpg" alt="image9" /></a></li>
		</ul> 
		
	</div>
	
	<br style="clear: both; margin-top: 2em;" /><br />

</div>

<?php
require_once ('catering_right_col.inc.php');
?>
</div>
<div style="clear:both;">
	<br /><br />
</div>

<?php page_finish(); ?>