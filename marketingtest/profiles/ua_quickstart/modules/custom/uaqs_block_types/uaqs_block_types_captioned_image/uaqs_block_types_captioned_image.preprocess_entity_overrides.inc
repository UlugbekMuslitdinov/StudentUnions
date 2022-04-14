<?php
/**
 * @file
 * Overrides for template_preprocess_entity().
 *
 * Manipulate the variables for the block type before rendering.
 */

/**
 * Insert variables into the UAQS Captioned Image template.
 *
 * @param array &$variables
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The hook name (generally the block type name).
 */
function uaqs_block_types_captioned_image_preprocess_entity(array &$variables, $hook) {
  if ($variables['entity_type'] == 'bean' && $variables['bean']->type == 'uaqs_captioned_image') {

    $have_author = !empty($variables['content']['field_uaqs_image_author']);
    $have_caption = !empty($variables['content']['field_uaqs_image_caption']);
    $have_license = !empty($variables['content']['field_uaqs_image_license']);
    $have_title = !empty($variables['content']['field_uaqs_image_title']);
    $have_image = !empty($variables['content']['field_uaqs_isolated_image']);

    $have_attribution = ($have_author || $have_license || $have_title);
    $variables['content']['have_attribution'] = $have_attribution;
    $have_figcaption = ($have_caption || $have_attribution);
    $variables['content']['have_figcaption'] = $have_figcaption;
  }
}
