<?php
/**
 * @file
 * uaqs_block_types_illustrated_link.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_illustrated_link_defaultconfig_features() {
  return array(
    'uaqs_block_types_illustrated_link' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_illustrated_link_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'view any uaqs_illustrated_link bean'.
  $permissions['view any uaqs_illustrated_link bean'] = array(
    'name' => 'view any uaqs_illustrated_link bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
