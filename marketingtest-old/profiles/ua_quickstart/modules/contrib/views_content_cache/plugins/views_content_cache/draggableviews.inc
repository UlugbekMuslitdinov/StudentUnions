<?php

/**
 * @file
 * Provides the Views content cache draggableviews plugin.
 */

/**
 * Draggable Views views_content_cache_key plugin.
 */
class views_content_cache_key_draggableviews extends views_content_cache_key {

  function options_form($value, &$handler = NULL) {
    // Get options array keyed by and named after views and display names.
    $options = _draggableviews_get_views_options();
    natcasesort($options);

    return array(
      '#title' => t('Draggable views'),
      '#description' => t('Select the draggable views which this view is based on.'),
      '#type' => 'checkboxes',
      '#options' => $options,
      '#default_value' => $value,
    );
  }

  function content_key($object, $object_type) {
    if ($object_type === 'draggableviews') {
      return $object->name . ':' . $object->current_display;
    }
  }

  function clause_mode() {
    return 'OR';
  }

}
