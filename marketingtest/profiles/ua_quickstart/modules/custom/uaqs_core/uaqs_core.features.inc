<?php

/**
 * @file
 * uaqs_core.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_core_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "breakpoints" && $api == "default_breakpoint_group") {
    return array("version" => "1");
  }
  if ($module == "breakpoints" && $api == "default_breakpoints") {
    return array("version" => "1");
  }
}