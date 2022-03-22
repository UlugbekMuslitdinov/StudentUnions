<?php
function employment_start($page_options) {
    global $page_options;
    require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');

    $nav['Apply Now!']['link'] = '/employment/application/start.php';
    $nav['Available Positions']['link'] = '/employment/available.php';
    $nav['Student HR Department']['link'] = '/about/student_hr';
    $nav['Arizona Applied Leadership Program (AALP)']['link'] = '/about/aalp/';
    $nav['FAQs']['link'] = '/employment/faq.php';
    $page_options['header_image'] = '/template/images/banners/employment_unions_banner.jpg';
    page_start($page_options);

?>
<div class="col-md-12 wrap-banner-img" style="width:100%;">
    <img src="<?php echo $page_options['header_image']; ?>" />
</div>

<!-- Left Col -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/about.php";
print_left_nav($about_route, $page_options['page'], ['other', 'other2']);
?>
<div class="col" style="width:100%;">
    <div class="col-12 mt-4">
<?php
}
?>


<?php
function employment_finish(){
?>
  </div>
</div>
<?php
  page_finish();
}
?>