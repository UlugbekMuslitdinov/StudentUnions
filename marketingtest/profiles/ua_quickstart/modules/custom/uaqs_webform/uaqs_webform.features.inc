<?php
/**
 * @file
 * uaqs_webform.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_webform_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
