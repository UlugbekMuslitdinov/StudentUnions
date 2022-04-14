<?php

/**
 * @file
 * uaqs_content_chunks.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_content_chunks_defaultconfig_features() {
  return array(
    'uaqs_content_chunks' => array(
      'strongarm' => 'strongarm',
    ),
  );
}

/**
 * Implements hook_defaultconfig_strongarm().
 */
function uaqs_content_chunks_defaultconfig_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'exclude_node_title_content_type_modes_uaqs_flexible_page';
  $strongarm->value = array(
    'full' => 'full',
    'teaser' => 0,
    'rss' => 0,
    'search_index' => 0,
    'search_result' => 0,
    'token' => 0,
    'uaqs_featured_content' => 0,
    'uaqs_teaser_list' => 0,
    'uaqs_sidebar_teaser_list' => 0,
    'uaqs_med_media_list' => 0,
    'uaqs_card' => 0,
    'uaqs_marquee' => 0,
    'nodeform' => 0,
  );
  $export['exclude_node_title_content_type_modes_uaqs_flexible_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'exclude_node_title_content_type_value_uaqs_flexible_page';
  $strongarm->value = 'user';
  $export['exclude_node_title_content_type_value_uaqs_flexible_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'menu_options_uaqs_flexible_page';
  $strongarm->value = array(
    0 => 'main-menu',
  );
  $export['menu_options_uaqs_flexible_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'menu_parent_uaqs_flexible_page';
  $strongarm->value = 'main-menu:0';
  $export['menu_parent_uaqs_flexible_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_preview_uaqs_flexible_page';
  $strongarm->value = '1';
  $export['node_preview_uaqs_flexible_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_submitted_uaqs_flexible_page';
  $strongarm->value = 0;
  $export['node_submitted_uaqs_flexible_page'] = $strongarm;

  return $export;
}
