<?php
/**
 * @file
 * uaqs_fields.default_entity_embed_configurations.inc
 */

/**
 * Implements hook_default_entity_embed_configuration().
 */
function uaqs_fields_default_entity_embed_configuration() {
  $export = array();

  $configuration = new stdClass();
  $configuration->disabled = FALSE; /* Edit this to true to make a default configuration disabled initially */
  $configuration->api_version = 1;
  $configuration->admin_title = 'Block';
  $configuration->name = 'uaqs_bean';
  $configuration->entity_type = 'bean';
  $configuration->entity_type_bundles = array();
  $configuration->button_icon_fid = 0;
  $configuration->display_plugins = array(
    'entityreference:entityreference_entity_view' => 'entityreference:entityreference_entity_view',
  );
  $export['uaqs_bean'] = $configuration;

  $configuration = new stdClass();
  $configuration->disabled = FALSE; /* Edit this to true to make a default configuration disabled initially */
  $configuration->api_version = 1;
  $configuration->admin_title = 'Content';
  $configuration->name = 'uaqs_content';
  $configuration->entity_type = 'node';
  $configuration->entity_type_bundles = array();
  $configuration->button_icon_fid = 0;
  $configuration->display_plugins = array();
  $export['uaqs_content'] = $configuration;

  $configuration = new stdClass();
  $configuration->disabled = FALSE; /* Edit this to true to make a default configuration disabled initially */
  $configuration->api_version = 1;
  $configuration->admin_title = 'File';
  $configuration->name = 'uaqs_files';
  $configuration->entity_type = 'file';
  $configuration->entity_type_bundles = array();
  $configuration->button_icon_fid = 0;
  $configuration->display_plugins = array(
    'file_entity:file_rendered' => 'file_entity:file_rendered',
  );
  $export['uaqs_files'] = $configuration;

  return $export;
}
