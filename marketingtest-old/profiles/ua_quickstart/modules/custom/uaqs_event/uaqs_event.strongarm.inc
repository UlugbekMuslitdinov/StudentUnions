<?php

/**
 * @file
 * uaqs_event.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uaqs_event_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_node__uaqs_event';
  $strongarm->value = array(
    'view_modes' => array(
      'uaqs_card' => array(
        'custom_settings' => TRUE,
      ),
      'full' => array(
        'custom_settings' => FALSE,
      ),
      'teaser' => array(
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
        'custom_settings' => FALSE,
      ),
      'diff_standard' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_med_media_list' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_marquee' => array(
        'custom_settings' => FALSE,
      ),
    ),
    'extra_fields' => array(
      'form' => array(
        'path' => array(
          'weight' => '12',
        ),
      ),
      'display' => array(
        'uaqs_event_month_short' => array(
          'uaqs_med_media_list' => array(
            'weight' => '48',
            'visible' => TRUE,
          ),
          'uaqs_card' => array(
            'weight' => '11',
            'visible' => FALSE,
          ),
          'default' => array(
            'weight' => '8',
            'visible' => FALSE,
          ),
        ),
        'uaqs_event_day_short' => array(
          'uaqs_med_media_list' => array(
            'weight' => '29',
            'visible' => TRUE,
          ),
          'uaqs_card' => array(
            'weight' => '9',
            'visible' => FALSE,
          ),
          'default' => array(
            'weight' => '9',
            'visible' => FALSE,
          ),
        ),
        'webform' => array(
          'uaqs_med_media_list' => array(
            'weight' => '10',
            'visible' => FALSE,
          ),
          'uaqs_card' => array(
            'weight' => '10',
            'visible' => FALSE,
          ),
          'default' => array(
            'weight' => '7',
            'visible' => TRUE,
          ),
        ),
      ),
    ),
  );
  $export['field_bundle_settings_node__uaqs_event'] = $strongarm;

  return $export;
}
