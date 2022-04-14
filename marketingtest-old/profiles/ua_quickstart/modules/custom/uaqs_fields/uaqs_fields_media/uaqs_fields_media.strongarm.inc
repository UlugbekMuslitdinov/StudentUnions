<?php

/**
 * @file
 * uaqs_fields_media.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uaqs_fields_media_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_file__audio';
  $strongarm->value = array(
    'view_modes' => array(
      'preview' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_inline_link' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_small' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_medium' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_large' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_square' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_media_list' => array(
        'custom_settings' => TRUE,
      ),
      'teaser' => array(
        'custom_settings' => FALSE,
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
      'uaqs_bg' => array(
        'custom_settings' => FALSE,
      ),
    ),
    'extra_fields' => array(
      'form' => array(
        'preview' => array(
          'weight' => '-5',
        ),
      ),
      'display' => array(
        'file' => array(
          'default' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_small' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_medium' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_large' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_square' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_media_list' => array(
            'weight' => '6',
            'visible' => TRUE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'preview' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
        ),
      ),
    ),
  );
  $export['field_bundle_settings_file__audio'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_file__document';
  $strongarm->value = array(
    'view_modes' => array(
      'teaser' => array(
        'custom_settings' => FALSE,
      ),
      'preview' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_inline_link' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_small' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_medium' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_large' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_square' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_media_list' => array(
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
      'uaqs_bg' => array(
        'custom_settings' => FALSE,
      ),
    ),
    'extra_fields' => array(
      'form' => array(
        'preview' => array(
          'weight' => '0',
        ),
      ),
      'display' => array(
        'file' => array(
          'default' => array(
            'weight' => '1',
            'visible' => TRUE,
          ),
          'uaqs_small' => array(
            'weight' => '10',
            'visible' => TRUE,
          ),
          'uaqs_medium' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_large' => array(
            'weight' => '1',
            'visible' => TRUE,
          ),
          'uaqs_square' => array(
            'weight' => '3',
            'visible' => TRUE,
          ),
          'uaqs_media_list' => array(
            'weight' => '4',
            'visible' => TRUE,
          ),
          'preview' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
        ),
        'uaqs_file_view_text' => array(
          'uaqs_media_list' => array(
            'weight' => '5',
            'visible' => TRUE,
          ),
          'default' => array(
            'weight' => '6',
            'visible' => FALSE,
          ),
          'preview' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_small' => array(
            'weight' => '5',
            'visible' => TRUE,
          ),
          'uaqs_medium' => array(
            'weight' => '4',
            'visible' => TRUE,
          ),
          'uaqs_large' => array(
            'weight' => '7',
            'visible' => TRUE,
          ),
          'uaqs_square' => array(
            'weight' => '8',
            'visible' => TRUE,
          ),
        ),
        'uaqs_file_separator' => array(
          'uaqs_media_list' => array(
            'weight' => '7',
            'visible' => TRUE,
          ),
          'default' => array(
            'weight' => '5',
            'visible' => FALSE,
          ),
          'preview' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_small' => array(
            'weight' => '6',
            'visible' => TRUE,
          ),
          'uaqs_medium' => array(
            'weight' => '8',
            'visible' => TRUE,
          ),
          'uaqs_large' => array(
            'weight' => '11',
            'visible' => TRUE,
          ),
          'uaqs_square' => array(
            'weight' => '11',
            'visible' => TRUE,
          ),
        ),
        'uaqs_file_download_text' => array(
          'uaqs_media_list' => array(
            'weight' => '8',
            'visible' => TRUE,
          ),
          'default' => array(
            'weight' => '4',
            'visible' => FALSE,
          ),
          'preview' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_small' => array(
            'weight' => '7',
            'visible' => TRUE,
          ),
          'uaqs_medium' => array(
            'weight' => '50',
            'visible' => TRUE,
          ),
          'uaqs_large' => array(
            'weight' => '15',
            'visible' => TRUE,
          ),
          'uaqs_square' => array(
            'weight' => '7',
            'visible' => TRUE,
          ),
        ),
        'uaqs_file_size' => array(
          'uaqs_media_list' => array(
            'weight' => '9',
            'visible' => TRUE,
          ),
          'default' => array(
            'weight' => '3',
            'visible' => FALSE,
          ),
          'preview' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_small' => array(
            'weight' => '8',
            'visible' => TRUE,
          ),
          'uaqs_medium' => array(
            'weight' => '10',
            'visible' => TRUE,
          ),
          'uaqs_large' => array(
            'weight' => '13',
            'visible' => TRUE,
          ),
          'uaqs_square' => array(
            'weight' => '14',
            'visible' => TRUE,
          ),
        ),
      ),
    ),
  );
  $export['field_bundle_settings_file__document'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_file__image';
  $strongarm->value = array(
    'view_modes' => array(
      'teaser' => array(
        'custom_settings' => FALSE,
      ),
      'full' => array(
        'custom_settings' => FALSE,
      ),
      'preview' => array(
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
      'uaqs_small' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_medium' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_square' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_media_list' => array(
        'custom_settings' => TRUE,
      ),
    ),
    'extra_fields' => array(
      'form' => array(
        'preview' => array(
          'weight' => '0',
        ),
      ),
      'display' => array(
        'file' => array(
          'default' => array(
            'weight' => '1',
            'visible' => TRUE,
          ),
          'uaqs_small' => array(
            'weight' => '1',
            'visible' => TRUE,
          ),
          'uaqs_medium' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_square' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_media_list' => array(
            'weight' => '12',
            'visible' => TRUE,
          ),
          'preview' => array(
            'weight' => '1',
            'visible' => TRUE,
          ),
          'uaqs_large' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
        ),
      ),
    ),
  );
  $export['field_bundle_settings_file__image'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_file__video';
  $strongarm->value = array(
    'view_modes' => array(
      'preview' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_small' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_medium' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_large' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_square' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_media_list' => array(
        'custom_settings' => TRUE,
      ),
      'teaser' => array(
        'custom_settings' => FALSE,
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
      'uaqs_inline_link' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_bg' => array(
        'custom_settings' => TRUE,
      ),
    ),
    'extra_fields' => array(
      'form' => array(
        'preview' => array(
          'weight' => '0',
        ),
      ),
      'display' => array(
        'file' => array(
          'default' => array(
            'weight' => '1',
            'visible' => TRUE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_small' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_medium' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_large' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_square' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
          'uaqs_media_list' => array(
            'weight' => '8',
            'visible' => TRUE,
          ),
          'uaqs_bg' => array(
            'weight' => '1',
            'visible' => FALSE,
          ),
          'preview' => array(
            'weight' => '0',
            'visible' => TRUE,
          ),
        ),
        'uaqs_play_button' => array(
          'default' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'preview' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_small' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_medium' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_large' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_square' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_media_list' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_bg' => array(
            'weight' => '50',
            'visible' => TRUE,
          ),
        ),
        'uaqs_pause_button' => array(
          'default' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_inline_link' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'preview' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_small' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_medium' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_large' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_square' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_media_list' => array(
            'weight' => '50',
            'visible' => FALSE,
          ),
          'uaqs_bg' => array(
            'weight' => '50',
            'visible' => TRUE,
          ),
        ),
      ),
    ),
  );
  $export['field_bundle_settings_file__video'] = $strongarm;

  return $export;
}
