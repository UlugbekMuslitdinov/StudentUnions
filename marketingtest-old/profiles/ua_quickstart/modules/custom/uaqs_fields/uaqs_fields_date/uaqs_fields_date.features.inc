<?php
/**
 * @file
 * uaqs_fields_date.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_fields_date_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
