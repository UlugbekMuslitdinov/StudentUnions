<?php
/**
 * @file
 * uaqs_content_chunks_full_width_media_row.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_content_chunks_full_width_media_row_defaultconfig_features() {
  return array(
    'uaqs_content_chunks_full_width_media_row' => array(
      'strongarm' => 'strongarm',
    ),
  );
}

/**
 * Implements hook_defaultconfig_strongarm().
 */
function uaqs_content_chunks_full_width_media_row_defaultconfig_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_paragraphs_item__uaqs_full_width_media_row';
  $strongarm->value = array(
    'view_modes' => array(
      'paragraphs_editor_preview' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_bg_img_content_left' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_bg_img_content_right' => array(
        'custom_settings' => TRUE,
      ),
      'full' => array(
        'custom_settings' => FALSE,
      ),
      'token' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_align_left' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_align_right' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_bg_img_content_center' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_landing_grid' => array(
        'custom_settings' => FALSE,
      ),
    ),
    'extra_fields' => array(
      'form' => array(),
      'display' => array(
        'uaqs_content_chunks_full_width_media_row_text_bg' => array(
          'uaqs_bg_img_content_right' => array(
            'weight' => '50',
            'visible' => TRUE,
          ),
          'uaqs_bg_img_content_left' => array(
            'weight' => '50',
            'visible' => TRUE,
          ),
          'uaqs_bg_img_content_center' => array(
            'weight' => '40',
            'visible' => TRUE,
          ),
          'paragraphs_editor_preview' => array(
            'weight' => '0',
            'visible' => FALSE,
          ),
        ),
      ),
    ),
  );
  $export['field_bundle_settings_paragraphs_item__uaqs_full_width_media_row'] = $strongarm;

  return $export;
}
