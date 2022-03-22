<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/involvement/template/involv.inc.php');

$page_options = array();
$page_options['header_image'] = '/template/images/banners/live5_banner.jpg';
$page_options['page'] = 'live';
involv_start('Live');
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

<h1 style="font-size: 2em;">Arizona Student Unions presents L!ve @ 5</h1>

<ul class="center-list" style="line-height: 1.5em; margin-top: .5em; margin-bottom: 1em;">
	<li>
		Arizona Student Unions proudly announces a new concert series, L!ve @ 5 to be held on the first Friday of every month.
		These concerts will be taking place at the North Plaza, located at the Student Unions.
	</li>

	<li>
		L!ve @ 5 brings free  live entertainment to the heart of campus to be enjoyed by students without having the hassle of
		fighting for parking downtown or on 4th street. This series is funded by the Student Services Fee Committee.
	</li>
</ul>

<!--
<h2>Upcoming Bands:</h2>

<ul>
	<li>
		November 1st, 2013 <br />
		<br />
		<a href="http://bestdogaward.bandcamp.com/"
	      		onclick="window.open(this.href); return false;"
	      		onkeypress="window.open(this.href); return false;" > Best Dog Award</a>, a local band comprised of three twenty-somethings hailing
	 			from the Tucson desert.Their sound is brave and quirky, as it is sincere. Their honest sonic ramblings serve as contemporary manifestations of
				suburban angst, whether it be in the form of frontman Joel Crocco's withery vocals, Nick Mazza's crashing and corroding waves of synth pads, or
				in drummer Andrew Ling's organic rhythmic delights. It's hard to pin BDA to 12 genres much less one, but if they had to put a label on it, they might
			    describe it as something like "non-denominational dad rock."
			<br />
	 </li>
</ul>



<p style="text-align:center;"><img src="/live/images/lv5_bda.jpg" alt="Best Dog Award"/></a></p>
-->
<?php
involv_finish();
?>
