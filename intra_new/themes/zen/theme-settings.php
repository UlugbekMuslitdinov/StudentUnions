<?php
// $Id: theme-settings.php,v 1.1.2.10 2008/09/20 17:12:29 johnalbin Exp $

/**
 * Implementation of THEMEHOOK_settings() function.
 *
 * @param $saved_settings
 *   An array of saved settings for this theme.
 * @param $subtheme_defaults
 *   Allow a subtheme to override the default values.
 * @return
 *   A form array.
 */
function zen_settings($saved_settings, $subtheme_defaults = array()) {

  // Add the form's CSS
  drupal_add_css(drupal_get_path('theme', 'zen') .'/theme-settings.css', 'theme');

  // Add javascript to show/hide optional settings
  drupal_add_js(drupal_get_path('theme', 'zen') .'/theme-settings.js', 'theme');

  /*
   * The default values for the theme variables. Make sure $defaults exactly
   * matches the $defaults in the theme-settings-init.php file.
   */
  $defaults = array(
    'zen_block_editing' => 1,
    'zen_breadcrumb' => 'yes',
    'zen_breadcrumb_separator' => ' › ',
    'zen_breadcrumb_home' => 1,
    'zen_breadcrumb_trailing' => 1,
    'zen_breadcrumb_title' => 0,
    'zen_layout' => 'border-politics-liquid',
    'zen_primary_links' => 1,
    'zen_secondary_links' => 1,
    'zen_wireframes' => 0,
  );
  $defaults = array_merge($defaults, $subtheme_defaults);

  // Merge the saved variables and their default values
  $settings = array_merge($defaults, $saved_settings);

  /*
   * Create the form using Form API
   */
  $form['toggle'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Toggle display'),
    '#attributes'    => array('id' => 'zen-toggle'),
    '#description'   => t('Enable or disable the display of certain page elements.'),
  );
  $form['toggle']['zen_primary_links'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Primary links'),
    '#default_value' => $settings['zen_primary_links'],
  );

  $form['toggle']['zen_secondary_links'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Secondary links'),
    '#default_value' => $settings['zen_secondary_links'],
  );

  $form['toggle']['zen_block_editing'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Block editing links'),
    '#description'   => t('Privileged users will see these when hovering over a block.'),
    '#default_value' => $settings['zen_block_editing'],
  );

  $form['zen-div-opening'] = array(
    '#value'         => '<div id="zen-settings">',
  );

  $form['breadcrumb'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Breadcrumb settings'),
    '#attributes'    => array('id' => 'zen-breadcrumb'),
  );
  $form['breadcrumb']['zen_breadcrumb'] = array(
    '#type'          => 'select',
    '#title'         => t('Display breadcrumb'),
    '#default_value' => $settings['zen_breadcrumb'],
    '#options'       => array(
                          'yes'   => t('Yes'),
                          'admin' => t('Only in admin section'),
                          'no'    => t('No'),
                        ),
  );
  $form['breadcrumb']['zen_breadcrumb_separator'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Breadcrumb separator'),
    '#description'   => t('Text only. Don’t forget to include spaces.'),
    '#default_value' => $settings['zen_breadcrumb_separator'],
    '#size'          => 5,
    '#maxlength'     => 10,
    '#prefix'        => '<div id="div-zen-breadcrumb-collapse">', // jquery hook to show/hide optional widgets
  );
  $form['breadcrumb']['zen_breadcrumb_home'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Show home page link in breadcrumb'),
    '#default_value' => $settings['zen_breadcrumb_home'],
  );
  $form['breadcrumb']['zen_breadcrumb_trailing'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Append a separator to the end of the breadcrumb'),
    '#default_value' => $settings['zen_breadcrumb_trailing'],
    '#description'   => t('Useful when the breadcrumb is placed just before the title.'),
  );
  $form['breadcrumb']['zen_breadcrumb_title'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Append the content title to the end of the breadcrumb'),
    '#default_value' => $settings['zen_breadcrumb_title'],
    '#description'   => t('Useful when the breadcrumb is not placed just before the title.'),
    '#suffix'        => '</div>', // #div-zen-breadcrumb
  );

  $form['themedev'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Theme development settings'),
    '#attributes'    => array('id' => 'zen-themedev'),
  );
  $form['themedev']['zen_layout'] = array(
    '#type'          => 'radios',
    '#title'         => t('Layout method'),
    '#options'       => array(
                          'border-politics-liquid' => t('Liquid layout') .' <small>(layout-liquid.css)</small>',
                          'border-politics-fixed' => t('Fixed layout') .' <small>(layout-fixed.css)</small>',
                        ),
    '#default_value' => $settings['zen_layout'],
  );
  $form['themedev']['zen_wireframes'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Display borders around main layout elements'),
    '#default_value' => $settings['zen_wireframes'],
    '#description'   => l(t('Wireframes'), 'http://www.boxesandarrows.com/view/html_wireframes_and_prototypes_all_gain_and_no_pain') . t(' are useful when prototyping a website.'),
    '#prefix'        => '<div id="div-zen-wireframes"><strong>'. t('Wireframes:') .'</strong>',
    '#suffix'        => '</div>',
  );

  $form['zen-div-closing'] = array(
    '#value'         => '</div>',
  );

  // Return the form
  return $form;
}
