<?php

/**
 * @file
 * uaqs_content_chunks_marquee.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_content_chunks_marquee_defaultconfig_features() {
  return array(
    'uaqs_content_chunks_marquee' => array(
      'strongarm' => 'strongarm',
    ),
  );
}

/**
 * Implements hook_defaultconfig_strongarm().
 */
function uaqs_content_chunks_marquee_defaultconfig_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_paragraphs_item__uaqs_content_chunks_marquee';
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
      'uaqs_bg_img_content_bottom' => array(
        'custom_settings' => TRUE,
      ),
      'uaqs_borderless_card' => array(
        'custom_settings' => FALSE,
      ),
    ),
    'extra_fields' => array(
      'form' => array(),
      'display' => array(),
    ),
  );
  $export['field_bundle_settings_paragraphs_item__uaqs_content_chunks_marquee'] = $strongarm;

  return $export;
}
