<?php
require_once('involv.inc');
require_once('../../../commontools/phplib/blogger/blogger_rss.inc');
$page_options = array();
$page_options['title'] = 'Cellar Concerts';
$page_options['page'] = 'gamesroom-cellarconcerts';
$page_options['header_image'] = '/template/images/banners/cellar_concerts.png';
involv_start('gamesroom-cellarconcerts');

embed_styled_blog('http://unioncellarconcerts.blogspot.com/feeds/posts/default');

involv_finish();