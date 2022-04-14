<?php

/**
 * @file
 * uaqs_block_types_related_links.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_related_links_defaultconfig_features() {
  return array(
    'uaqs_block_types_related_links' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_related_links_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'view any uaqs_related_links bean'.
  $permissions['view any uaqs_related_links bean'] = array(
    'name' => 'view any uaqs_related_links bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
