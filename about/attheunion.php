<?php
	require('about.inc');
	$page_options['title'] = 'Today at the Union';
  	$page_options['page'] = 'about'; 
	about_start($page_options);
	
	require_once('phplib/blogger/blogger_rss.inc');//

	embed_styled_blog('http://todayattheunion.blogspot.com/feeds/posts/default');//

	about_finish();
?>
