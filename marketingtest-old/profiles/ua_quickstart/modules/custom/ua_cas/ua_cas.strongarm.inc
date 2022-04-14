<?php
/**
 * @file
 * ua_cas.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function ua_cas_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'cas_cert';
  $strongarm->value = DRUPAL_ROOT . '/' . drupal_get_path('module', 'ua_cas') . '/ca_bundle.cer';
  $export['cas_cert'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'cas_domain';
  $strongarm->value = 'email.arizona.edu';
  $export['cas_domain'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'cas_hide_password';
  $strongarm->value = 1;
  $export['cas_hide_password'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'cas_login_drupal_invite';
  $strongarm->value = 'Cancel UA WebAuth Login';
  $export['cas_login_drupal_invite'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'cas_login_invite';
  $strongarm->value = 'Log in using UA WebAuth';
  $export['cas_login_invite'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'cas_login_message';
  $strongarm->value = 'Logged in via UA WebAuth as %cas_username.';
  $export['cas_login_message'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'cas_login_redir_message';
  $strongarm->value = 'You will be redirected to the secure UA WebAuth login page.';
  $export['cas_login_redir_message'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'cas_server';
  $strongarm->value = 'webauth.arizona.edu';
  $export['cas_server'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'cas_uri';
  $strongarm->value = '/webauth';
  $export['cas_uri'] = $strongarm;

  return $export;
}
