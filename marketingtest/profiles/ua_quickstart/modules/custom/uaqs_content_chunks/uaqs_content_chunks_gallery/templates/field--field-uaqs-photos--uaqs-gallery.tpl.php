<?php
/**
 * @file
 * Combination template for the UAQS Gallery
 *
 * Available variables:
 * - $thumbnail_list: An array of pre-formatted outputs from the uaqs_gallery_thumbnail_list template.
 * - $fullsize_list: An array of pre-formatted outputs from the uaqs_gallery_fullsize_list template.
 *
 *  @see uaqs_gallery_thumbnail_list.tpl.php
 *  @see uaqs_gallery_fullsize_list.tpl.php
 *
 */
?>
<?php
  print render($thumbnail_list);
  print render($fullsize_list);
?>
