<?php
function rooms_start($page_options){
  global $page_options;
  require_once($_SERVER['DOCUMENT_ROOT'].'/template/'.'global.inc');
  $section_options['title'] = 'Event Services';
  $page_options['no_sidenav'] = false;
  $section_options['nav']['Event Services']['Banner Policies']['link'] = '/rooms/banner_policies.php';
  $section_options['nav']['Event Services']['Banner Policies']['sname'] = 'banner_policies';
  // $section_options['nav']['Event Services']['Bulletin Board Policies']['link'] = '/operations/policies/bulletinboards.php';
  $section_options['nav']['Event Services']['Cancellation/No-Show Policy']['link'] = '/rooms/procedures.php#cancellation';
  $section_options['nav']['Event Services']['Cancellation/No-Show Policy']['sname'] = 'procedures';

  $section_options['nav']['Event Services']['Catering']['link'] = '/catering';
  $section_options['nav']['Event Services']['Catering']['sname'] = 'catering';

  $section_options['nav']['Event Services']['Conference Services']['link'] = '/rooms/services.php';
  $section_options['nav']['Event Services']['Conference Services']['sname'] = 'services';

  // $section_options['nav']['Event Services']['Confirmations']['link'] = '/rooms/procedures.php#confirmation';
  $section_options['nav']['Event Services']['Equipment Rental Pricing']['link'] = '/rooms/audiovisual.php';
  $section_options['nav']['Event Services']['Equipment Rental Pricing']['sname'] = 'audiovisual';

  // $section_options['nav']['Event Services']['Hours of Operation']['link'] = '/infodesk/hours/index.php';
  // $section_options['nav']['Event Services']['Making a reservation']['link'] = '/rooms/procedures.php';
  // $section_options['nav']['Event Services']['Miscellaneous Service Rates']['link'] = '/rooms/procedures.php#servicerates';
  $section_options['nav']['Event Services']['Non-University Groups']['link'] = '/rooms/procedures_other.php';
  $section_options['nav']['Event Services']['Non-University Groups']['sname'] = 'procedures_other';

  $section_options['nav']['Event Services']['Reservation Form']['link'] = '/rooms/reservation_form.php';
  $section_options['nav']['Event Services']['Reservation Form']['sname'] = 'reservation_form';

  $section_options['nav']['Event Services']['Reservation Procedures']['link'] = '/rooms/procedures.php';
  $section_options['nav']['Event Services']['Reservation Procedures']['sname'] = 'procedures';

  $section_options['nav']['Event Services']['Reserving a Room']['link'] = '/rooms/reserving.php';
  $section_options['nav']['Event Services']['Reserving a Room']['sname'] = 'reserving';

  $section_options['nav']['Event Services']['Room Layouts']['link'] = '/rooms/layouts/index.php';
  $section_options['nav']['Event Services']['Room Layouts']['sname'] = 'layouts';

  $section_options['nav']['Event Services']['Room Rates']['link'] = '/rooms/roomrates.php';
  $section_options['nav']['Event Services']['Room Rates']['sname'] = 'roomrates';

  $section_options['nav']['Event Services']['Room Rental']['link'] = '/rooms/';
  $section_options['nav']['Event Services']['Room Rental']['sname'] = 'rooms';

  $section_options['nav']['Event Services']['Room Use Policies']['link'] = '/rooms/policies.php';
  $section_options['nav']['Event Services']['Room Use Policies']['sname'] = 'policies';

  $section_options['nav']['Event Services']['Special Events Policies']['link'] = '/rooms/catering_policies.php';
  $section_options['nav']['Event Services']['Special Events Policies']['sname'] = 'catering_policies';

  $section_options['nav']['Event Services']['Student Clubs & Organizations']['link'] = '/rooms/procedures_studentorg.php';
  $section_options['nav']['Event Services']['Student Clubs & Organizations']['sname'] = 'procedures_studentorg';

  $section_options['nav']['Event Services']['Types of Events']['link'] = '/rooms/event_types.php';
  $section_options['nav']['Event Services']['Types of Events']['sname'] = 'event_types';

  $section_options['nav']['Event Services']['Union Policies']['link'] = '/operations/policies/index.php';
  $section_options['nav']['Event Services']['Union Policies']['sname'] = 'policies';

  $section_options['nav']['Event Services']['University Offices or Departments']['link'] = '/rooms/procedures_university.php';
  $section_options['nav']['Event Services']['University Offices or Departments']['sname'] = 'procedures_university';

  $section_options['header_image'] = '/template/images/banners/mall.png';
  $page_options = array_merge($section_options, $page_options);
  page_start($page_options);
 }

function rooms_finish(){
  page_finish();
}