<?php

/**
 * @file
 * Drush commands for UAQS Core.
 */

/**
 * Implements hook_drush_command().
 */
function uaqs_core_drush_command() {
  $items = array();
  $items['uaqs-list-assets'] = array(
    'description' => 'Print a count of all the uaqs assets',
    'callback' => 'uaqs_core_drush_uaqs_list_assets',
    'outputformat' => array(
      'default' => 'table',
      'pipe-format' => 'json',
      'field-labels' => array(
        'entity_type' => dt('Entity type'),
        'bundle' => dt('Bundle'),
        'bundle_label' => dt('Bundle label'),
        'count' => dt('Entity count'),
      ),
      'examples' => array(
        'drush uaqs-list-assets' => 'Returns the results as a table formatted list.',
        'drush uaqs-list-assets --format=json' => 'Returns the results as JSON.',
        'drush uaqs-list-assets --format=csv' => 'Returns the results as CSV.'
      ),
      'fields-default' => array('bundle', 'entity_type', 'count'),
      'fields-pipe' => array('bundle', 'entity_type', 'count'),
      'output-data-type' => 'format-table',
    ),
  );
  return $items;
}

/**
 * Callback for uaqs-list-assets drush command
 *
 * Returns an entity count for each content type, block type,
 * paragraph bundle and taxonomy vocabulary in use as a table. 
 */

function uaqs_core_drush_uaqs_list_assets() {
  $results = array();
  $uaqs_entity_types = array(
    'node',
    'taxonomy_term',
    'paragraphs_item',
    'bean',
  );
  $field_bundle_data = field_info_bundles();

  foreach ($uaqs_entity_types as $entity_type) {
    foreach ($field_bundle_data[$entity_type] as $bundle => $info) {
      $query = new EntityFieldQuery();
      $query->entityCondition('entity_type', $entity_type)
        ->entityCondition('bundle', $bundle);

      $count = $query->count()->execute();
      array_push($results, array(
        'entity_type' => $entity_type,
        'bundle' => $bundle,
        'bundle_label' => $info['label'],
        'count' => $count,
      ));
    }
  }

  return $results;
}
