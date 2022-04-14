<?php
/**
 * @file
 * uaqs_block_types_captioned_image.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_block_types_captioned_image_defaultconfig_features() {
  return array(
    'uaqs_block_types_captioned_image' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_block_types_captioned_image_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'view any uaqs_captioned_image bean'.
  $permissions['view any uaqs_captioned_image bean'] = array(
    'name' => 'view any uaqs_captioned_image bean',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'bean',
  );

  return $permissions;
}
