<?php
	require('about.inc');
	$page_options['title'] = 'About the Unions';
  	$page_options['page'] = 'about'; 
  	$page_options['styles'] = '#center-col { width:780px;}';
  	$page_options['no_sidenav'] = 1;
  	$page_options['header_image'] = '/template/images/banners/tellus.jpg';
	about_start($page_options);
?>
<iframe src="http://studentvoice.com/arizona/tellusonlinecomments" frameborder="0" width="100%" height="1023"></iframe>
<?php
	about_finish();
?>