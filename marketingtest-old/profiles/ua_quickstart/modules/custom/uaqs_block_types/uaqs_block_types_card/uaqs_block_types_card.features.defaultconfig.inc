<?php

/**
 * @file
 * uaqs_block_types_card.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_card_defaultconfig_features() {
  return array(
    'uaqs_block_types_card' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_card_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'view any uaqs_card bean'.
  $permissions['view any uaqs_card bean'] = array(
    'name' => 'view any uaqs_card bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
