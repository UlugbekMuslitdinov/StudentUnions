<?php
/**
 * @file
 * uaqs_block_types_search.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_search_defaultconfig_features() {
  return array(
    'uaqs_block_types_search' => array(
      'strongarm' => 'strongarm',
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_strongarm().
 */
function uaqs_block_types_search_defaultconfig_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'field_bundle_settings_bean__uaqs_search';
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
            'visible' => TRUE,
          ),
        ),
      ),
    ),
  );
  $export['field_bundle_settings_bean__uaqs_search'] = $strongarm;

  return $export;
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_search_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'create any uaqs_search bean'.
  $permissions['create any uaqs_search bean'] = array(
    'name' => 'create any uaqs_search bean',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'delete any uaqs_search bean'.
  $permissions['delete any uaqs_search bean'] = array(
    'name' => 'delete any uaqs_search bean',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'edit any uaqs_search bean'.
  $permissions['edit any uaqs_search bean'] = array(
    'name' => 'edit any uaqs_search bean',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'view any uaqs_search bean'.
  $permissions['view any uaqs_search bean'] = array(
    'name' => 'view any uaqs_search bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
