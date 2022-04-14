<?php
/**
 * @file
 * Overrides for template_preprocess_entity().
 *
 * Manipulate the variables for the block type before rendering.
 */

/**
 * Insert variables into the UAQS Statement template.
 *
 * @param array &$variables
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The hook name (generally the block type name).
 */
function uaqs_block_types_statement_preprocess_entity_bean_uaqs_statement(array &$variables, $hook) {
  $have_link = !empty($variables['content']['field_uaqs_read_more']);
  $variables['content']['have_link'] = $have_link;
}


