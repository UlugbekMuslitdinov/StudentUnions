<?php
/**
 * @file
 * uaqs_block_types_call_to_action.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uaqs_block_types_call_to_action_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_bean__uaqs_call_to_action';
  $strongarm->value = array(
    'view_modes' => array(
      'default' => array(
        'custom_settings' => TRUE,
      ),
      'token' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_expanded' => array(
        'custom_settings' => FALSE,
      ),
      'uaqs_card_overlay' => array(
        'custom_settings' => FALSE,
      ),
    ),
    'extra_fields' => array(
      'form' => array(),
      'display' => array(
        'title' => array(
          'default' => array(
            'weight' => '-9',
            'visible' => FALSE,
          ),
        ),
      ),
    ),
  );
  $export['field_bundle_settings_bean__uaqs_call_to_action'] = $strongarm;

  return $export;
}
