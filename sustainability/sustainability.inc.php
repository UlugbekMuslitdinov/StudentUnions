<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');

function sustainability_start($page_options){
    global $page_options;
    $section_options['header_image'] = '/template/images/banners/about.png';
    $nav['Home']['link'] = '/sustainability/index.php';
    $nav['Efforts']['link'] = '/sustainability/efforts.php';
    $nav['Committee']['link'] = '/sustainability/committee.php';
    $nav['Links']['link'] = '/sustainability/links.php';
    $nav['Take Action']['link'] = '/sustainability/action.php';

  $page_options = array_merge($section_options, $page_options);

  page_start($page_options);
?>
  <div class="col-md-12 wrap-banner-img">
		<img src="<?=$page_options['header_image']?>" />
	</div>

    <div class="col wrap-left-col">
        <div class="wrap-left-col-menu">
            <h2 class="left-col-menu-header" style="margin-bottom: 7px !important;">Sustainability</h2>
            <ul>
              <?php
              foreach($nav as $key => $value){
                  echo '<li><a href="' . $value['link'] . '" >' . $key . '</a></li>';
              }
              ?>
            </ul>
        </div>
    </div>
    <div class="col">
      <div class="col-12 mt-4">
<?php
}

function sustainability_finish(){
?>
  </div></div>

<div id="right-col" class="col" style="display:none;">
    <div style="width:205px;">
            <a href="http://www.youtube.com/embed/eC443-lR5YU?autoplay=1" rel="shadowbox;width=560;height=347;"><img src="images/Video_Sustainability.png"></a>
            <?php randomFeed(37); ?>    
            <a href="/events"><img src="/dining/template/images/events_btn.jpg" alt="events"></a>
            <a href="/about/marketing/ask.php"><img src="/dining/template/images/feedback_btn.jpg" alt="contact"></a>
            <a href="/tellus"><img src="/dining/template/images/tellus_btn.jpg" alt="donate"></a>
    </div>
</div>
<?php
  page_finish();
}
