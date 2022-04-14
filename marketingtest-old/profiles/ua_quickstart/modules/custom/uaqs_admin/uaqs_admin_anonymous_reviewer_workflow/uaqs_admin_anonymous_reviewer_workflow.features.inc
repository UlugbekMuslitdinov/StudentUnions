<?php
/**
 * @file
 * uaqs_admin_anonymous_reviewer_workflow.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_admin_anonymous_reviewer_workflow_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
