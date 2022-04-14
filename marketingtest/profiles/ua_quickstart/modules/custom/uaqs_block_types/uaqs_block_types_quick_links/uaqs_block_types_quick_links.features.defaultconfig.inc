<?php
/**
 * @file
 * uaqs_block_types_quick_links.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_quick_links_defaultconfig_features() {
  return array(
    'uaqs_block_types_quick_links' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_quick_links_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'create any uaqs_quick_links bean'.
  $permissions['create any uaqs_quick_links bean'] = array(
    'name' => 'create any uaqs_quick_links bean',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'delete any uaqs_quick_links bean'.
  $permissions['delete any uaqs_quick_links bean'] = array(
    'name' => 'delete any uaqs_quick_links bean',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'edit any uaqs_quick_links bean'.
  $permissions['edit any uaqs_quick_links bean'] = array(
    'name' => 'edit any uaqs_quick_links bean',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'view any uaqs_quick_links bean'.
  $permissions['view any uaqs_quick_links bean'] = array(
    'name' => 'view any uaqs_quick_links bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
