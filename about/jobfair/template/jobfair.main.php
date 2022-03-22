<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
// includes the display functions
// include("/srv/www/htdocs/commontools/deliverance/display_functions.php");
include($_SERVER['DOCUMENT_ROOT']."/commontools/deliverance/display_functions.php");
// connect to database
// include("/srv/www/htdocs/commontools/deliverance/inc_db_switch.php");
include($_SERVER['DOCUMENT_ROOT']."/commontools/deliverance/inc_db_switch.php");

function jobfair_start($page_options){
    page_start($page_options);
?>
	<div class="col-md-12 wrap-banner-img">
		<img src="<?php echo $page_options['header_image']; ?>" />
    </div>

    <!-- Left Col -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/about_leftnav.php";
    print_left_nav($aboutleft_route, $page_options['page'], []);
    ?>
<?php
}

function jobfair_finish(){
    page_finish();
}