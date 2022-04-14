<?php
/**
 * @file
 * uaqs_admin_anonymous_reviewer_workflow.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function uaqs_admin_anonymous_reviewer_workflow_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'access_unpublished_display_link_in_drupal_message';
  $strongarm->value = 1;
  $export['access_unpublished_display_link_in_drupal_message'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'access_unpublished_display_link_in_node_content';
  $strongarm->value = 1;
  $export['access_unpublished_display_link_in_node_content'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'access_unpublished_display_link_on_node_form';
  $strongarm->value = 1;
  $export['access_unpublished_display_link_on_node_form'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'access_unpublished_url_key';
  $strongarm->value = 'review';
  $export['access_unpublished_url_key'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'node_options_uaqs_flexible_page';
  $strongarm->value = array(
    0 => 'revision',
    1 => 'moderation',
  );
  $export['node_options_uaqs_flexible_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'workbench_moderation_default_state_uaqs_flexible_page';
  $strongarm->value = 'draft';
  $export['workbench_moderation_default_state_uaqs_flexible_page'] = $strongarm;

  return $export;
}
