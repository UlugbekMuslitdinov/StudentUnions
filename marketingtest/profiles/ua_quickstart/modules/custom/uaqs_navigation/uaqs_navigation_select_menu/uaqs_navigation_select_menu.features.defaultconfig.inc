<?php
/**
 * @file
 * uaqs_navigation_select_menu.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_navigation_select_menu_defaultconfig_features() {
  return array(
    'uaqs_navigation_select_menu' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_navigation_select_menu_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'create any uaqs_select_menu bean'.
  $permissions['create any uaqs_select_menu bean'] = array(
    'name' => 'create any uaqs_select_menu bean',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'delete any uaqs_select_menu bean'.
  $permissions['delete any uaqs_select_menu bean'] = array(
    'name' => 'delete any uaqs_select_menu bean',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'edit any uaqs_select_menu bean'.
  $permissions['edit any uaqs_select_menu bean'] = array(
    'name' => 'edit any uaqs_select_menu bean',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bean',
  );

  // Exported permission: 'view any uaqs_select_menu bean'.
  $permissions['view any uaqs_select_menu bean'] = array(
    'name' => 'view any uaqs_select_menu bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
