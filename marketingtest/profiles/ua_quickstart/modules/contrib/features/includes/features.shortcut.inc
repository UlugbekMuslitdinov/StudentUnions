<?php

/**
 * Implements hook_features_api().
 */
function shortcut_features_api() {
  return array(
    'shortcut_set' => array(
      'name' => t('Shortcut set'),
      'feature_source' => TRUE,
      'default_hook' => 'shortcut_default_shortcut_set',
      'default_file' => FEATURES_DEFAULTS_INCLUDED,
    ),
  );
}

/**
 * Implements hook_features_export().
 */
function shortcut_set_features_export($data, &$export, $module_name = '') {
  $export['dependencies']['features'] = 'features';
  $export['dependencies']['shortcut'] = 'shortcut';

  $map = features_get_default_map('menu_links', 'menu_links_features_identifier');
  foreach ($data as $shortcut_set_name) {
    if ($shortcut_set = shortcut_set_load($shortcut_set_name)) {
      foreach ($shortcut_set->links as $link) {
        $identifier = menu_links_features_identifier($link);

        // If this link is provided by a different module, add it as a dependency.
        if (isset($map[$identifier]) && $map[$identifier] != $module_name) {
          $export['dependencies'][$map[$identifier]] = $map[$identifier];
        }
        else {
          $export['features']['menu_links'][$identifier] = $identifier;
        }
      }
      $export['features']['shortcut_set'][$shortcut_set_name] = $shortcut_set_name;
    }
  }
  return array();
}

/**
 * Implements hook_features_export_options().
 */
function shortcut_set_features_export_options() {
  $options = array();
  foreach (shortcut_sets() as $set) {
    $options[$set->set_name] = $set->title;
  }
  return $options;
}

/**
 * Implements hook_features_export_render().
 */
function shortcut_set_features_export_render($module_name, $data, $export = NULL) {
  $code = array();
  $code[] = '  $shortcut_sets = array();';
  foreach ($data as $name) {
    $shortcut_set = shortcut_set_load($name);

    // Don't export links, these are handled separately.
    unset($shortcut_set->links);
    $code[] = "  \$shortcut_sets['{$name}'] = " . features_var_export($shortcut_set, '  ') .";";
  }
  $code[] = "  return \$shortcut_sets;";
  $code = implode("\n", $code);
  return array('shortcut_default_shortcut_set' => $code);
}

/**
 * Implementation of hook_features_export_revert().
 */
function shortcut_set_features_revert($module) {
  shortcut_set_features_rebuild($module);
}

/**
 * Implementation of hook_features_export_rebuild().
 */
function shortcut_set_features_rebuild($module) {
  if ($defaults = features_get_default('shortcut_set', $module)) {
    foreach ($defaults as $shortcut_set) {
      $shortcut_set = (object) $shortcut_set;
      shortcut_set_save($shortcut_set);
    }
  }
}
