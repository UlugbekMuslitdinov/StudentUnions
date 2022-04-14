<?php

/**
 * @file
 * uaqs_core.admin.inc
 */

/**
 * Form builder for UAQS Core admin settings form.
 */
function uaqs_core_settings_form($form, &$form_state) {
  $form['clear_cache'] = array(
    '#type' => 'fieldset',
    '#title' => t('Clear cache'),
  );

  $form['clear_cache']['clear'] = array(
    '#type' => 'submit',
    '#value' => t('Clear all caches'),
    '#submit' => array('uaqs_core_clear_cache_submit'),
  );

  $form['site_information']['site_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Site name'),
    '#default_value' => variable_get('site_name', 'UA Quickstart'),
    '#required' => TRUE,
  );

  $form['monitoring_page'] = array(
    '#type' => 'fieldset',
    '#title' => t('Monitoring page'),
    '#access' => user_access('administer site configuration'),
  );

  $form['monitoring_page']['uaqs_monitoring_page_enabled'] = array(
    '#title' => t('Enable monitoring page'),
    '#type' => 'checkbox',
    '#description' => t("Provides an uncacheable page intended for use with uptime monitoring tools to check the health of the site, bypassing any edge cache layer (e.g. varnish)."),
    '#default_value' => variable_get('uaqs_monitoring_page_enabled', FALSE),
  );

  $form['monitoring_page']['uaqs_monitoring_page_path'] = array(
    '#title' => t('Monitoring page path'),
    '#type' => 'textfield',
    '#description' => t('Path for monitoring page.'),
    '#default_value' => variable_get('uaqs_monitoring_page_path', 'uaqs_monitoring_page'),
    '#element_validate' => array('uaqs_core_monitoring_page_path_validate'),
    '#states' => array(
      'visible' => array(':input[name="uaqs_monitoring_page_enabled"]' => array('checked' => TRUE)),
      'enabled' => array(':input[name="uaqs_monitoring_page_enabled"]' => array('checked' => TRUE)),
      'required' => array(':input[name="uaqs_monitoring_page_enabled"]' => array('checked' => TRUE)),
    ),
  );

  $form['#submit'][] = 'uaqs_core_settings_form_submit';

  return system_settings_form($form);
}

/**
 * Form element validation handler for monitoring page path form element.
 */
function uaqs_core_monitoring_page_path_validate($element, &$form_state, $complete_form) {
  if ($form_state['values']['uaqs_monitoring_page_enabled']) {
    $submitted_value = $form_state['values']['uaqs_monitoring_page_path'];
    if (empty($submitted_value)) {
      form_set_error('uaqs_monitoring_page_path', t('A monitoring page path must be provided.'));
    }

    $path = strtolower(trim(trim($submitted_value), " \\/"));
    $menu_item = menu_get_item($path);
    if (!empty($path) && $submitted_value != $element['#default_value']) {
      if (!empty($menu_item)) {
        form_error($element, t('The path is already in use.'));
      }
    }
  }
}

/**
 * Submit callback; clear system caches.
 */
function uaqs_core_clear_cache_submit($form, &$form_state) {
  drupal_flush_all_caches();
  drupal_set_message(t('Caches cleared.'));
}

/**
 * Submit callback for uaqs_core_settings_form().
 */
function uaqs_core_settings_form_submit($form, &$form_state) {
  variable_set('menu_rebuild_needed', TRUE);
}
