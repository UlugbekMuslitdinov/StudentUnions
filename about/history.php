<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . '/about/template/about.inc');
	$page_options['title'] = 'About the Unions';
  	$page_options['page'] = 'History'; 
	about_start($page_options);
?>
<h1>Union Timeline</h1>
	<br/>
	<iframe frameborder="0" style="border-width:0;" id="tl-timeline-iframe" width="780" height="480" src="https://www.tiki-toki.com/timeline/embed/52513/0705055651/">
	</iframe>
<?php about_finish() ?>