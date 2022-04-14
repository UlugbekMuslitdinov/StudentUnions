<?php

/**
 * @file
 * The drush file for UAQS Mail module.
 */

/**
 * Implements hook_drush_command().
 */
function uaqs_mail_drush_command() {
  $items = array();
  $items['ses-smtp-secret'] = array(
    'description' => 'This command converts an AWS secret key to an AWS SMTP credential.',
    'callback' => 'uaqs_mail_drush_ses_smtp_secret',
    'arguments' => array(
      'region' => 'The region SES is configured in.',
      'secret' => 'The IAM secret key.',
    ),
    'options' => [
      'force' => 'Forcibly overwrite existing SMTP password.',
    ],
    'examples' => array(
      'drush ses-smtp-secret us-west-2 foo' => 'smtp_password set successfully',
    ),
    'output-data-type' => 'string',
  );
  $items['ses-migrate'] = array(
    'description' => 'This command attempts to migrate SES config to the SMTP module.',
    'callback' => 'uaqs_mail_drush_ses_migrate',
    'examples' => array(
      'drush ses-migrate' => 'SES config migrated successfully.',
    ),
    'output-data-type' => 'string',
  );
  return $items;
}

/**
 * Ses-smtp-secret command logic.
 */
function uaqs_mail_drush_ses_smtp_secret() {
  $args = func_get_args();
  if (count($args) === 2) {
    $smtp_password = variable_get('smtp_password');
    if (!isset($smtp_password) || drush_get_option('force', FALSE)) {
      $ses_hashed_secret = uaqs_mail_ses_hash($args[1], $args[0]);
      variable_set('smtp_password', $ses_hashed_secret);
      drush_print('smtp_password set successfully');
    }
    else {
      drush_set_error(DRUSH_FRAMEWORK_ERROR, "There is already an SMTP password set. Please delete it before setting a new password or use the --force option.");
    }
  }
  else {
    drush_set_error(DRUSH_FRAMEWORK_ERROR, "Invalid number of arguments. Please provide region and AWS IAM secret key.");
  }
}

/**
 * Ses-migrate command logic.
 */
function uaqs_mail_drush_ses_migrate() {
  if (uaqs_mail_migrate_ses()) {
    drush_print('SES config migrated successfully.');
  }
  else {
    drush_set_error(DRUSH_FRAMEWORK_ERROR, "SES config could not be migrated.");
  }
}
