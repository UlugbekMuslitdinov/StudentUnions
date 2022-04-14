<?php

/**
 * @file
 * Describe the data that can be used with the calendar filter.
 */

/**
 * Implements hook_views_data().
 */
function uaqs_calendar_filter_views_data() {
  $data = array();

  $tables = date_views_base_tables();

  foreach ($tables as $base_table => $entity) {
    // A calendar date filter for each base table.
    $data[$base_table]['calendar_filter'] = array(
      'group' => t('Calendar Filter'),
      'title' => t('Calendar Filter (!base_table)', array('!base_table' => $base_table)),
      'help' => t('Filter any Views !base_table date field.', array('!base_table' => $base_table)),
      'filter' => array(
        'handler' => 'uaqs_calendar_filter_filter_handler',
        'empty field name' => t('Undated'),
        'is date' => TRUE,
      ),
    );
  }

  return $data;
}
