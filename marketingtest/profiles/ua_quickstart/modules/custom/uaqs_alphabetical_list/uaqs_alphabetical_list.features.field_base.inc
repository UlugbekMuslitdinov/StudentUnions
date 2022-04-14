<?php

/**
 * @file
 * uaqs_alphabetical_list.features.field_base.inc
 */

/**
 * Implements hook_field_default_field_bases().
 */
function uaqs_alphabetical_list_field_default_field_bases() {
  $field_bases = array();

  // Exported field_base: 'field_uaqs_index_letter'.
  $field_bases['field_uaqs_index_letter'] = array(
    'active' => 1,
    'cardinality' => -1,
    'deleted' => 0,
    'entity_types' => array(),
    'field_name' => 'field_uaqs_index_letter',
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'locked' => 0,
    'module' => 'list',
    'settings' => array(
      'allowed_values' => array(
        '123' => '#',
        'a' => 'a',
        'b' => 'b',
        'c' => 'c',
        'd' => 'd',
        'e' => 'e',
        'f' => 'f',
        'g' => 'g',
        'h' => 'h',
        'i' => 'i',
        'j' => 'j',
        'k' => 'k',
        'l' => 'l',
        'm' => 'm',
        'n' => 'n',
        'o' => 'o',
        'p' => 'p',
        'q' => 'q',
        'r' => 'r',
        's' => 's',
        't' => 't',
        'u' => 'u',
        'v' => 'v',
        'w' => 'w',
        'x' => 'x',
        'y' => 'y',
        'z' => 'z',
      ),
      'allowed_values_function' => '',
    ),
    'translatable' => 0,
    'type' => 'list_text',
  );

  return $field_bases;
}
