<?php
/**
 * @file
 * uaqs_content_chunks_file_download.features.inc
 */

/**
 * Implements hook_paragraphs_info().
 */
function uaqs_content_chunks_file_download_paragraphs_info() {
  $items = array(
    'uaqs_file_download' => array(
      'name' => 'File attachment',
      'bundle' => 'uaqs_file_download',
      'locked' => '1',
    ),
  );
  return $items;
}
