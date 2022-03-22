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
  page_start($page_options);
 }

function policies_finish(){
  page_finish();
}
