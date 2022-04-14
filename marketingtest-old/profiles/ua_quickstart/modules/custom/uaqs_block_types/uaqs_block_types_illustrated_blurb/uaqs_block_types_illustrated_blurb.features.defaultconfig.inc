<?php

/**
 * @file
 * uaqs_block_types_illustrated_blurb.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_illustrated_blurb_defaultconfig_features() {
  return array(
    'uaqs_block_types_illustrated_blurb' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_illustrated_blurb_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'view any uaqs_illustrated_blurb bean'.
  $permissions['view any uaqs_illustrated_blurb bean'] = array(
    'name' => 'view any uaqs_illustrated_blurb bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
