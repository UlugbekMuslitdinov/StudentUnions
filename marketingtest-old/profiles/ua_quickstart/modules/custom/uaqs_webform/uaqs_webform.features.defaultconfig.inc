<?php
/**
 * @file
 * uaqs_webform.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_webform_defaultconfig_features() {
  return array(
    'uaqs_webform' => array(
      'strongarm' => 'strongarm',
    ),
  );
}

/**
 * Implements hook_defaultconfig_strongarm().
 */
function uaqs_webform_defaultconfig_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'webform_node_types_primary';
  $strongarm->value = array();
  $export['webform_node_types_primary'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'webform_node_uaqs_event';
  $strongarm->value = 1;
  $export['webform_node_uaqs_event'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'webform_node_uaqs_flexible_page';
  $strongarm->value = 1;
  $export['webform_node_uaqs_flexible_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'webform_progressbar_style';
  $strongarm->value = array(
    0 => 'progressbar_bar',
    1 => 'progressbar_pagebreak_labels',
  );
  $export['webform_progressbar_style'] = $strongarm;

  return $export;
}
