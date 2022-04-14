<?php

/**
 * @file
 * uaqs_content_chunks.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uaqs_content_chunks_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_node__uaqs_flexible_page';
  $strongarm->value = array(
    'view_modes' => array(
      'teaser' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_card' => array(
        'custom_settings' => TRUE,
      ),
      'full' => array(
        'custom_settings' => FALSE,
      ),
      'rss' => array(
        'custom_settings' => FALSE,
      ),
      'search_index' => array(
        'custom_settings' => FALSE,
      ),
      'search_result' => array(
        'custom_settings' => FALSE,
      ),
      'token' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_featured_content' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_teaser_list' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_sidebar_teaser_list' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_med_media_list' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_marquee' => array(
        'custom_settings' => FALSE,
      ),
    ),
    'extra_fields' => array(
      'form' => array(
        'exclude_node_title' => array(
          'weight' => '1',
        ),
        'path' => array(
          'weight' => '6',
        ),
      ),
      'display' => array(
        'webform' => array(
          'default' => array(
            'weight' => '2',
            'visible' => TRUE,
          ),
          'uaqs_sidebar_teaser_list' => array(
            'weight' => '12',
            'visible' => FALSE,
          ),
          'teaser' => array(
            'weight' => '4',
            'visible' => FALSE,
          ),
          'uaqs_card' => array(
            'weight' => '2',
            'visible' => FALSE,
          ),
        ),
      ),
    ),
  );
  $export['field_bundle_settings_node__uaqs_flexible_page'] = $strongarm;

  return $export;
}
