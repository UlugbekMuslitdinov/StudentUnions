<?php

/**
 * @file
 * uaqs_admin.features.shortcut_set.inc
 */

/**
 * Implements hook_shortcut_default_shortcut_set().
 */
function uaqs_admin_shortcut_default_shortcut_set() {
  $shortcut_sets = array();
  $shortcut_sets['administrator'] = array(
    'set_name' => 'administrator',
    'title' => 'Administrator',
  );
  return $shortcut_sets;
}
