<?php
/**
 * @file
 * Enables modules and site configuration for a UA QuickStart site installation.
 */

const UAQS_FORM_DEMO = 'uaqs_demo_enable';
const UAQS_FORM_THEMEDEBUG = 'uaqs_themedebugging';
const UAQS_FORM_VERBOSE = 'uaqs_verbosity';
const UAQS_STATE_OPTIONS_SET = 'uaqs_options_set';
const UAQS_VAR_DEMO = 'uaqs_demo';
const UAQS_VAR_THEMEDEBUG = 'uaqs_themedebug';
const UAQS_VAR_VERBOSE = 'uaqs_verbose';

/**
 * Implements hook_install_tasks_alter().
 *
 * We need to insert our option-setting form after there's a database in which
 * to store variables, but before installing most of the non-core modules.
 *
 * @param $tasks
 *   The array of all available installation tasks.
 * @param $install_state
 *   The array of information about the current installation state.
 */
function ua_quickstart_install_tasks_alter(&$tasks, $install_state) {
  $optionsform = array('ua_quickstart_install_options_form' => array(
    'display_name' => st('Set profile-specific options'),
    'type' => 'form',
    'run' => empty($install_state[UAQS_STATE_OPTIONS_SET]) ? INSTALL_TASK_RUN_IF_NOT_COMPLETED : INSTALL_TASK_SKIP,
  ));
  $offset = array_search('install_bootstrap_full', array_keys($tasks));
  if ($offset) {
    // Found the built-in Drupal bootstrap install task at a non-zero offset.
    $preboot_tasks = array_slice($tasks, 0, $offset);
    $boot_tasks = array_slice($tasks, $offset);
    $tasks = array_merge($preboot_tasks, $optionsform, $boot_tasks);
  }
}

/**
 * Profile-specific options form submit handler.
 *
 * @param $form
 *   The nested array of form elements that defines the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function ua_quickstart_install_options_form_submit($form, &$form_state) {
  global $install_state;
  variable_set(UAQS_VAR_DEMO, (! empty($form_state['values'][UAQS_FORM_DEMO])));
  variable_set(UAQS_VAR_THEMEDEBUG, (! empty($form_state['values'][UAQS_FORM_THEMEDEBUG])));
  variable_set(UAQS_VAR_VERBOSE, (! empty($form_state['values'][UAQS_FORM_VERBOSE])));
  $install_state[UAQS_STATE_OPTIONS_SET] = TRUE;
}

/**
 * Display the profile-specific options (install task callback).
 *
 * @param $form
 *   Unused (we initialize the form here).
 * @param $form_state
 *   A keyed array containing the current state of the form.
 * @param $install_state
 *   The array of information about the current installation state.
 *
 * @return array
 *   The nested array of form elements that defines the form.
 */
function ua_quickstart_install_options_form($form, &$form_state, &$install_state) {
  drupal_set_title(st('Profile-specific options'));
  $form = array();
  $form[UAQS_FORM_VERBOSE] = array(
    '#type' => 'radios',
    '#title' => st('How much detail to show in optional messages during installation'),
    '#options' => array(
      0 => st('Terse (for normal users)'),
      1 => st('Verbose (for developers)'),
    ),
    '#default_value' => 0,
  );
  $form[UAQS_FORM_DEMO] = array(
    '#type' => 'radios',
    '#title' => st('Whether to pre-populate the site with demo content'),
    '#options' => array(
      0 => st('Clean empty site (nothing to show how UA QuickStart works)'),
      1 => st('Demo content installed (slow, may cause timeouts)'),
    ),
    '#default_value' => 1,
  );
  $form[UAQS_FORM_THEMEDEBUG] = array(
    '#type' => 'radios',
    '#title' => st('Enable or disable theme debugging (rebuild the theme registry on every page load, put template suggestions and file locations in the HTML markup)'),
    '#options' => array(
      0 => st('Production sites, and normal development'),
      1 => st('Debugging themes (never on production sites!)'),
    ),
    '#default_value' => 0,
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => st('Save and continue'),
    '#submit' => array('ua_quickstart_install_options_form_submit'),
  );
  return $form;
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function ua_quickstart_form_install_configure_form_alter(&$form, &$form_state) {
  // Hide some messages from various modules that are just too chatty!
  drupal_get_messages('status');
  drupal_get_messages('warning');

  // Set a default country and timezone.
  $form['server_settings']['site_default_country']['#default_value'] = 'US';
  $form['server_settings']['date_default_timezone']['#default_value'] = 'America/Phoenix';

  // Disable JS timezone detection.  It doesn't seem to work reliably for AZ.
  $key = array_search('timezone-detect', $form['server_settings']['date_default_timezone']['#attributes']['class']);
  if ($key !== FALSE) {
    unset($form['server_settings']['date_default_timezone']['#attributes']['class'][$key]);
  }
}
