<?php
/**
 * @file
 * Wrapper for an individual instance of a UAQS Gallery Full Size image
 *
 * Available variables:
 * - $is_active: In order for the carousel to work the first item has to have the 'active' class. This variable ensures that the class gets added to only the first item.
 * - $fullsize_image: An image supplied by the uaqs_photo field.
 * - $caption: A caption supplied by the uaqs_short_title field.
 * - $gallery_index: Starts at 1 for the first image in the Gallery and increments by one per image.
 * - $gallery_count: The total number of images in a Gallery.
 */
?>
<div class="item ua-gallery-item <?php print $is_active; ?>">
  <div class="carousel-image">
    <picture>
      <?php print render($fullsize_image); ?>
    </picture>
  </div>
  <div class="ua-gallery-caption bg-black text-white text-center">
    <?php print $caption; ?>
    <span aria-title="Image <?php print $gallery_index; ?> of <?php print $gallery_count; ?>"><small><em><?php print $gallery_index; ?> of <?php print $gallery_count; ?></small></em></span>
  </div>
</div>