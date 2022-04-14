<?php
/**
 * @file
 * uaqs_featured_content_spotlight.features.inc
 */

/**
 * Implements hook_views_api().
 */
function uaqs_featured_content_spotlight_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_flag_default_flags().
 */
function uaqs_featured_content_spotlight_flag_default_flags() {
  $flags = array();
  // Exported flag: "Spotlight".
  $flags['uaqs_spotlight'] = array(
    'entity_type' => 'node',
    'title' => 'Spotlight',
    'global' => 1,
    'types' => array(),
    'flag_short' => 'Add to spotlight',
    'flag_long' => '',
    'flag_message' => '',
    'unflag_short' => 'Remove from spotlight',
    'unflag_long' => '',
    'unflag_message' => '',
    'unflag_denied_text' => '',
    'link_type' => 'toggle',
    'weight' => 0,
    'show_in_links' => array(
      'full' => 0,
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
    ),
    'show_as_field' => 0,
    'show_on_form' => 1,
    'access_author' => '',
    'show_contextual_link' => 1,
    'i18n' => 0,
    'module' => 'uaqs_featured_content_spotlight',
    'locked' => array(
      0 => 'name',
    ),
    'api_version' => 3,
  );
  return $flags;

}
