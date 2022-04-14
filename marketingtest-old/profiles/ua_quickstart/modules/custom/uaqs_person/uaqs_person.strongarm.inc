<?php

/**
 * @file
 * uaqs_person.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uaqs_person_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_node__uaqs_person';
  $strongarm->value = array(
    'view_modes' => array(
      'teaser' => array(
        'custom_settings' => TRUE,
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
      'uaqs_card' => array(
        'custom_settings' => TRUE,
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
      'full' => array(
        'custom_settings' => FALSE,
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
        'title' => array(
          'weight' => '0',
        ),
        'path' => array(
          'weight' => '13',
        ),
      ),
      'display' => array(),
    ),
  );
  $export['field_bundle_settings_node__uaqs_person'] = $strongarm;

  return $export;
}
