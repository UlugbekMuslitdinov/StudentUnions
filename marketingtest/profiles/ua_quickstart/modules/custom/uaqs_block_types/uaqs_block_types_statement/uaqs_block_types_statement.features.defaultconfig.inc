<?php

/**
 * @file
 * uaqs_block_types_statement.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_statement_defaultconfig_features() {
  return array(
    'uaqs_block_types_statement' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_statement_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'view any uaqs_statement bean'.
  $permissions['view any uaqs_statement bean'] = array(
    'name' => 'view any uaqs_statement bean',
    'roles' => array(
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
