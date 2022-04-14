<?php
/**
 * @file
 * Wrapper for the thumbnail view of the UAQS Gallery
 *
 * Available variables:
 * - $thumbnails: An array of templates generated using the uaqs_gallery_thumbnail_item template
 *
 * @see uaqs_gallery_thumbnail_item.tpl.php
 *
 */
?>
<div class="container-fluid">
  <div class="row">
    <?php foreach ($thumbnail_items as $delta => $item) : ?>
      <?php print render($item); ?>
    <?php endforeach; ?>
  </div>
</div>
