<?php
/**
 * @file
 * Wrapper for an individual instance of a UAQS Gallery Thumbnail image
 *
 * Available variables:
 * - $gallery_name: A unique value used to link thumbnail images to the proper fullscreen carousel/modal.
 * - $data_index: A Dynamically generated value for 'data-slide-to' ranging for a given gallery from [0-(n-1)] where n is the total number of images.
 * - $image: The FID of an image (?) //TODO: Figure this out.
 * - $alt_text: Alt text for a given gallery image.
 * - $title_text: Title text for a given gallery image.
 *
 */
?>
<div class="px-min py-min col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-2" data-toggle="modal" data-target="#<?php print $gallery_name; ?>-modal">
  <a href="#<?php print $gallery_name; ?>" data-slide-to="<?php print $data_index; ?>">
    <picture class="card-img img-responsive">
      <?php print render($thumbnail_image); ?>
    </picture>
  </a>
</div>
