<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');

// includes the display functions
// include("/srv/www/htdocs/commontools/deliverance/display_functions.php");
include($_SERVER['DOCUMENT_ROOT']."/commontools/deliverance/display_functions.php");

// connect to database
// include("/srv/www/htdocs/commontools/deliverance/inc_db_switch.php");
include($_SERVER['DOCUMENT_ROOT']."/commontools/deliverance/inc_db_switch.php");

// Define links to map shadowboxes
// Student Union Memorial Center Links. 1 for each floor
$sumc_level1_link = '<a href="/infodesk/maps/sumc_maps.php?level=level1" rel="shadowbox;height=612;width=792" target="_blank">Level 1</a>';
$sumc_level2_link = '<a href="/infodesk/maps/sumc_maps.php?level=level2" rel="shadowbox;height=612;width=792" target="_blank">Level 2</a>';
$sumc_level3_link = '<a href="/infodesk/maps/sumc_maps.php?level=level3" rel="shadowbox;height=612;width=792" target="_blank">Level 3</a>';
$sumc_level4_link = '<a href="/infodesk/maps/sumc_maps.php?level=level4" rel="shadowbox;height=612;width=792" target="_blank">Level 4</a>';

// Park Student Union Links
$park_level1_link = '<a href="/infodesk/maps/psu_maps.php?level=level1" rel="shadowbox;height=650;width=675" target="_blank">Level 1</a>';
$park_level2_link = '<a href="/infodesk/maps/psu_maps.php?level=level2" rel="shadowbox;height=650;width=675" target="_blank">Level 2</a>';

//$park_level1_link = '<a href="/infodesk/maps/psu_maps.php?level=level1" rel="shadowbox;height=745;width=1000" target="_blank">Level 1</a>';
//$park_level2_link = '<a href="/infodesk/maps/psu_maps.php?level=level2" rel="shadowbox;height=713;width=1000" target="_blank">Level 2</a>';

function infodesk_start($page_options){

    $page_options['title'] = 'Student Union Maps';
    // $page_options['header_image'] = '/template/images/banners/Maps_Parking.png';
    $page_options['nav']['Information Desk']['Hours of Operation']['link'] = '/infodesk/hours/index.php';
    $page_options['nav']['Information Desk']['Hours of Operation']['sname'] = 'null';
    $page_options['nav']['Information Desk']['Building Maps']['link'] = '/infodesk/maps/index.php';
    $page_options['nav']['Information Desk']['Building Maps']['sname'] = 'null';
    $page_options['scripts'] = 'function webPopUp(url) {webWin=window.open(url,"win",\'toolbar=0,location=0,directories=0,status=1,menubar=1,scrollbars=1,resizable=1,width=650,height=700\'); self.name = "mainWin"; }';
    $page_options['no_sidenav'] = false;
    if (!isset($page_options['header_image'])){
        $page_options['header_image'] = '/template/images/banners/maps_banner.jpg';
    }
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

function infodesk_finish(){
    page_finish();
}