<?php
/**
 * @file
 * uaqs_block_types_search.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_block_types_search_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "bean_admin_ui" && $api == "bean") {
    return array("version" => "5");
  }
}
