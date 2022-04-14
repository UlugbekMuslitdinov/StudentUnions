<?php
/**
 * @file
 * uaqs_admin_anonymous_reviewer_workflow.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_admin_anonymous_reviewer_workflow_defaultconfig_features() {
  return array(
    'uaqs_admin_anonymous_reviewer_workflow' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}

/**
 * Implements hook_defaultconfig_user_default_permissions().
 */
function uaqs_admin_anonymous_reviewer_workflow_defaultconfig_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'access unpublished configuration'.
  $permissions['access unpublished configuration'] = array(
    'name' => 'access unpublished configuration',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'access_unpublished',
  );

  // Exported permission: 'access unpublished view hashkey'.
  $permissions['access unpublished view hashkey'] = array(
    'name' => 'access unpublished view hashkey',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'access_unpublished',
  );

  // Exported permission: 'access unpublished view unpublished node'.
  $permissions['access unpublished view unpublished node'] = array(
    'name' => 'access unpublished view unpublished node',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'access_unpublished',
  );

  // Exported permission: 'access unpublished view workbench moderation drafts'.
  $permissions['access unpublished view workbench moderation drafts'] = array(
    'name' => 'access unpublished view workbench moderation drafts',
    'roles' => array(
      'administrator' => 'administrator',
      'anonymous user' => 'anonymous user',
      'authenticated user' => 'authenticated user',
    ),
    'module' => 'access_unpublished',
  );

  // Exported permission: 'administer workbench moderation'.
  $permissions['administer workbench moderation'] = array(
    'name' => 'administer workbench moderation',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'workbench_moderation',
  );

  // Exported permission: 'bypass workbench moderation'.
  $permissions['bypass workbench moderation'] = array(
    'name' => 'bypass workbench moderation',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'workbench_moderation',
  );

  // Exported permission: 'use workbench_moderation my drafts tab'.
  $permissions['use workbench_moderation my drafts tab'] = array(
    'name' => 'use workbench_moderation my drafts tab',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'workbench_moderation',
  );

  // Exported permission: 'use workbench_moderation needs review tab'.
  $permissions['use workbench_moderation needs review tab'] = array(
    'name' => 'use workbench_moderation needs review tab',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'workbench_moderation',
  );

  // Exported permission: 'view all unpublished content'.
  $permissions['view all unpublished content'] = array(
    'name' => 'view all unpublished content',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'workbench_moderation',
  );

  // Exported permission: 'view moderation history'.
  $permissions['view moderation history'] = array(
    'name' => 'view moderation history',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'workbench_moderation',
  );

  // Exported permission: 'view moderation messages'.
  $permissions['view moderation messages'] = array(
    'name' => 'view moderation messages',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'workbench_moderation',
  );

  return $permissions;
}
