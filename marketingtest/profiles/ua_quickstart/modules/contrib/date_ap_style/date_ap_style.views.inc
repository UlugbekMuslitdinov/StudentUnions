<?php

/**
 * @file
 * Provides views handler for AP date style.
 */

/**
 * Implements hook_views_data_alter().
 */
function date_ap_style_views_data_alter(&$data) {
  foreach ($data as $table => $config) {
    foreach ($config as $item => $item_config) {
      if (isset($item_config['field']['handler']) && $item_config['field']['handler'] == 'views_handler_field_date') {
        $data[$table][$item]['field']['handler'] = 'date_ap_style_handler_field_date';
      }
    }
  }

  return $data;
}

/**
 * Implements hook_views_handlers().
 */
function date_ap_style_views_handlers() {
  return array(
    'info' => array(
      'path' => drupal_get_path('module', 'date_ap_style') . '/includes/views/handlers',
    ),
    'handlers' => array(
      'date_ap_style_handler_field_date' => array(
        'parent' => 'views_handler_field_date',
      ),
    ),
  );
}
