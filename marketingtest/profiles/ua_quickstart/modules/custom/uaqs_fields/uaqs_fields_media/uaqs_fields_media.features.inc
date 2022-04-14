<?php

/**
 * @file
 * uaqs_fields_media.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function uaqs_fields_media_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "file_entity" && $api == "file_default_displays") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
