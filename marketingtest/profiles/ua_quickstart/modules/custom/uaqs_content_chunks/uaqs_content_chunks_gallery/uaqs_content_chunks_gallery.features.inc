<?php
/**
 * @file
 * uaqs_content_chunks_gallery.features.inc
 */

/**
 * Implements hook_image_default_styles().
 */
function uaqs_content_chunks_gallery_image_default_styles() {
  $styles = array();

  // Exported image style: uaqs_gallery_thumbnail.
  $styles['uaqs_gallery_thumbnail'] = array(
    'label' => 'Gallery Thumbnail',
    'effects' => array(
      0 => array(
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => 500,
          'height' => 350,
          'upscale' => 1,
        ),
        'weight' => 0,
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_gallery_paragraphs_info() {
  $items = array(
    'uaqs_gallery' => array(
      'name' => 'Photo Gallery',
      'bundle' => 'uaqs_gallery',
      'locked' => '1',
    ),
  );
  return $items;
}
