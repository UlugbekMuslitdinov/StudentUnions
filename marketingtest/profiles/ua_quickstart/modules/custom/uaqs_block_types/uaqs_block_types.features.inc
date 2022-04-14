<?php
/**
 * @file
 * uaqs_block_types.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_block_types_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "bean_admin_ui" && $api == "bean") {
    return array("version" => "5");
  }
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_image_default_styles().
 */
function uaqs_block_types_image_default_styles() {
  $styles = array();

  // Exported image style: large_tile.
  $styles['large_tile'] = array(
    'label' => 'Large Tile',
    'effects' => array(
      3 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 480,
          'height' => 480,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: medium_inset_square.
  $styles['medium_inset_square'] = array(
    'label' => 'Medium Inset Square',
    'effects' => array(
      2 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 210,
          'height' => 210,
        ),
        'weight' => 1,
      ),
    ),
  );

  // Exported image style: medium_tile.
  $styles['medium_tile'] = array(
    'label' => 'Medium Tile',
    'effects' => array(
      1 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 220,
          'height' => 220,
        ),
        'weight' => 1,
      ),
    ),
  );

  return $styles;
}

