<?php
/**
 * @file
 * uaqs_navigation_global_footer.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_navigation_global_footer_defaultconfig_features() {
  return array(
    'uaqs_navigation_global_footer' => array(
      'user_default_permissions' => 'user_default_permissions',
    ),
  );
}
