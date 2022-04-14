<?php

/**
 * @file
 * ua_cas.admin.inc
 */

/**
 * Form builder for UA CAS admin settings form.
 */
function ua_cas_settings_form($form, &$form_state) {
  $form['ua_cas_disable_password_recovery_link'] = array(
    '#title' => t("Disable 'request new password' form"),
    '#type' => 'checkbox',
    '#description' => t("Disables the default password recovery functionality provided by Drupal core."),
    '#default_value' => variable_get('ua_cas_disable_password_recovery_link', TRUE),
  );

  $form['#submit'][] = 'ua_cas_settings_form_submit';

  return system_settings_form($form);
}

/**
 * Add a submit handler/function to the form.
 */
function ua_cas_settings_form_submit($form, &$form_state) {
  variable_set('menu_rebuild_needed', TRUE);
}
