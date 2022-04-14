<?php

/**
 * @file
 * uaqs_block_types_flexible_block.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_flexible_block_defaultconfig_features() {
  return array(
    'uaqs_block_types_flexible_block' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_flexible_block_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'view any uaqs_flexible_block bean'.
  $permissions['view any uaqs_flexible_block bean'] = array(
    'name' => 'view any uaqs_flexible_block bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
