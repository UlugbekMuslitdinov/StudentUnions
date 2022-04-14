<?php

/**
 * @file
 * uaqs_d8cache.admin.inc
 */

/**
 * Form builder for UAQS D8 Cache admin settings form.
 */
function uaqs_d8cache_settings_form($form, &$form_state) {
  $form['uaqs_d8cache_info'] = array(
    '#markup' => '<p>' . t('Out of the box, the D8cache module adds entity-specific cache tags for *all* entity types, including entities like field collection items and paragraph items. Because paragraph and field collection entities are normally only ever rendered as part of their parent entity, the UAQS D8cache module excludes all field collection and paragraph item specific tags from the cache tags emitted by the D8cache module by default.') . '</p>',
  );

  $form['uaqs_d8cache_exclude_field_collection_tags'] = array(
    '#title' => t('Exclude field collection entity tags'),
    '#type' => 'checkbox',
    '#description' => t("Excludes field collection item entity-specific tags from cache tags emitted by the D8cache module."),
    '#default_value' => variable_get('uaqs_d8cache_exclude_field_collection_tags', TRUE),
  );

  $form['uaqs_d8cache_exclude_paragraph_tags'] = array(
    '#title' => t('Exclude paragraph entity tags'),
    '#type' => 'checkbox',
    '#description' => t("Excludes paragraph item entity-specific tags from cache tags emitted by the D8cache module."),
    '#default_value' => variable_get('uaqs_d8cache_exclude_paragraph_tags', TRUE),
  );

  return system_settings_form($form);
}
