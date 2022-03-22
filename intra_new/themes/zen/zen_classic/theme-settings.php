<?php
// $Id: theme-settings.php,v 1.1.2.10 2008/05/06 13:22:41 johnalbin Exp $

/**
 * Implementation of THEMEHOOK_settings() function.
 *
 * @param $saved_settings
 *   An array of saved settings for this theme.
 * @return
 *   A form array.
 */
function zen_classic_settings($saved_settings) {

  /*
   * The default values for the theme variables. Make sure $defaults exactly
   * matches the $defaults in the theme-settings-init.php file.
   */
  $defaults = array(
    'zen_classic_fixed' => 0,
    'zen_block_editing' => 1,
    'zen_breadcrumb' => 'yes',
    'zen_breadcrumb_separator' => ' :: ',
    'zen_breadcrumb_home' => 1,
    'zen_breadcrumb_trailing' => 0,
    'zen_breadcrumb_title' => 0,
  );

  // Merge the saved variables and their default values
  $settings = array_merge($defaults, $saved_settings);

  /*
   * Create the form using Forms API: http://api.drupal.org/api/5
   */
  $form = array();
  $form['zen_classic_fixed'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Use fixed width for theme'),
    '#default_value' => $settings['zen_classic_fixed'],
    '#description'   => t('The theme should be centered and fixed at 960 pixels wide.'),
  );

  // Add the base theme's settings.
  include_once './'. drupal_get_path('theme', 'zen') .'/theme-settings.php';
  $form += zen_settings($saved_settings, $defaults);

  // Remove some of the base theme's settings.
  unset($form['themedev']);
  //unset($form['themedev']['zen_layout']); // We don't need to select the base stylesheet.

  // Return the form
  return $form;
}
