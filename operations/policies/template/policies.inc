<?php
function policies_start($page_options){
  global $page_options;
  require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $section_options['header_image'] = '/template/images/banners/operations.png';
  $section_options['title'] = 'Policies';
  // $page_options['no_sidenav'] = false;
  $section_options['nav']['Policies']['Banner Hanging Policy']['link'] = '/operations/policies/banners.php';
  $section_options['nav']['Policies']['Computer Lab Policy']['link'] = '/operations/policies/computerlab.php';
  $section_options['nav']['Policies']['Conflict of Interest Policy']['link'] = '/operations/policies/conflictofinterest.php';
  $section_options['nav']['Policies']['Dance Policy']['link'] = '/operations/policies/dances.php';
  $section_options['nav']['Policies']['Dock Access Policy']['link'] = '/operations/policies/dockaccess.php';

  $section_options['nav']['Policies']['Facility Checklist']['link'] = '/operations/policies/template/resources/facchecklist.pdf';

  $section_options['nav']['Policies']['Flyers &amp; Bulletin Boards Policy']['link'] = '/operations/policies/bulletinboards.php';


  $section_options['nav']['Policies']['Keyless Access Policy']['link'] = '/operations/policies/keylessaccess.php';
  $section_options['nav']['Policies']['Loitering & Solicitation Policy']['link'] = '/operations/policies/loitering.php';
  $section_options['nav']['Policies']['Lost & Found Policy']['link'] = '/operations/policies/lostandfound.php';
  $section_options['nav']['Policies']['Smoking Policy']['link'] = '/operations/policies/smoking.php';
  $section_options['nav']['Policies']['Space Occupancy Policy']['link'] = '/operations/policies/spaceoccupancy.php';
  $section_options['nav']['Policies']['UA Catering Waiver']['link'] = '/catering/resources/CateringWaiver.pdf';
  $page_options = array_merge($section_options, $page_options);
  $page_options['header_image'] = '/template/images/banners/policies_banner.jpg';
  page_start($page_options);

?>

<div class="col-md-12 wrap-banner-img">
		<img src="<?php echo $page_options['header_image']; ?>" />
</div>

<!-- Left Col -->
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/template/layout/header/routes/involvement.php";
print_left_nav($involvement_route, $page_options['page'], ['other', 'other2']);
?>

<div class="col">
  <div class="col-12 mt-4">
<?php
  }
?>

<?php
function policies_finish(){
  ?>
    </div>
  </div>
  <?php
  page_finish();
}
?>