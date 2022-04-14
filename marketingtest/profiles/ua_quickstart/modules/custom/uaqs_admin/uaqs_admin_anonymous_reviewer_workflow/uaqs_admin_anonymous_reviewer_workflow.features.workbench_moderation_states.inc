<?php
/**
 * @file
 * uaqs_admin_anonymous_reviewer_workflow.features.workbench_moderation_states.inc
 */

/**
 * Implements hook_workbench_moderation_export_states().
 */
function uaqs_admin_anonymous_reviewer_workflow_workbench_moderation_export_states() {
  $items = array(
    'draft' => array(
      'name' => 'draft',
      'label' => 'Draft',
      'description' => 'Work in progress',
      'weight' => -10,
    ),
    'published' => array(
      'name' => 'published',
      'label' => 'Published',
      'description' => 'Make this version live',
      'weight' => -10,
    ),
  );
  return $items;
}
