<?php
/**
 * @file
 * uaqs_block_types_contact_summary.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_contact_summary_defaultconfig_features() {
  return array(
    'uaqs_block_types_contact_summary' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_contact_summary_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'view any uaqs_contact_summary bean'.
  $permissions['view any uaqs_contact_summary bean'] = array(
    'name' => 'view any uaqs_contact_summary bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
