<?php

/**
 * @file
 * uaqs_content_chunks.default_picture_mapping.inc
 */

/**
 * Implements hook_default_picture_mapping().
 */
function uaqs_content_chunks_default_picture_mapping() {
  $export = array();

  $picture_mapping = new PictureMapping();
  $picture_mapping->disabled = FALSE; /* Edit this to true to make a default picture_mapping disabled initially */
  $picture_mapping->api_version = 2;
  $picture_mapping->label = 'Marquee - Aspect Ratio Placeholder';
  $picture_mapping->machine_name = 'uaqs_aspect_ratio_placeholder';
  $picture_mapping->breakpoint_group = 'ua_zen';
  $picture_mapping->mapping = array(
    'breakpoints.theme.ua_zen.screen-xs-max' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'uaqs_full_width_xs_aspect_ratio_placeholder',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-sm-min' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'uaqs_full_width_lg_aspect_ratio_placeholder',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-sm-max' => array(
      '1x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-md-min' => array(
      '1x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-md-max' => array(
      '1x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-lg-min' => array(
      '1x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
  );
  $export['uaqs_aspect_ratio_placeholder'] = $picture_mapping;

  $picture_mapping = new PictureMapping();
  $picture_mapping->disabled = FALSE; /* Edit this to true to make a default picture_mapping disabled initially */
  $picture_mapping->api_version = 2;
  $picture_mapping->label = 'Marquee - Full Browser Width';
  $picture_mapping->machine_name = 'uaqs_full_width_marquee';
  $picture_mapping->breakpoint_group = 'ua_zen';
  $picture_mapping->mapping = array(
    'breakpoints.theme.ua_zen.screen-xs-max' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'uaqs_full_width_xs',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-sm-min' => array(
      '1x' => array(
        'mapping_type' => 'image_style',
        'image_style' => 'uaqs_full_width_lg',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-sm-max' => array(
      '1x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-md-min' => array(
      '1x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-md-max' => array(
      '1x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
    'breakpoints.theme.ua_zen.screen-lg-min' => array(
      '1x' => array(
        'mapping_type' => '_none',
      ),
      '1.5x' => array(
        'mapping_type' => '_none',
      ),
      '2x' => array(
        'mapping_type' => '_none',
      ),
    ),
  );
  $export['uaqs_full_width_marquee'] = $picture_mapping;

  return $export;
}
