<?php
/**
 * @file
 * uaqs_navigation.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uaqs_navigation_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'menu_secondary_links_source';
  $strongarm->value = 'uaqs-utility-links';
  $export['menu_secondary_links_source'] = $strongarm;

  return $export;
}
