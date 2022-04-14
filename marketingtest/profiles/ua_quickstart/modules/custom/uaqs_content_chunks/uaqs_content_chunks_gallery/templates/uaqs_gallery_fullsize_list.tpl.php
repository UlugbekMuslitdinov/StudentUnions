<?php
/**
 * @file
 * Wrapper for the fullscreen view of the UAQS Gallery
 *
 * Available variables:
 * - $gallery_name: A unique value used to link thumbnail images to the proper fullscreen carousel/modal.
 * - $fullsize_items: An array of templates generated using the uaqs_gallery_fullsize_item template
 *
 *  @see uaqs_gallery_fullsize_item.tpl.php
 *
 */
?>
<div class="modal fade modal-full modal-bg-dark container-fluid" tabindex="-1" id="<?php print $gallery_name; ?>-modal" role="dialog" aria-labelledby="<?php print $gallery_name; ?>-modal-label">
  <div id="<?php print $gallery_name; ?>" class="carousel slide" data-interval="false" style="height:100%;">
  <button type="button" class="close text-white text-size-h3 pull-right mt-3 ua-gallery-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i aria-hidden="true" class="ua-brand-x"></i></span></button>
    <div class="carousel-inner" style="height:98% !important;">
      <?php foreach ($fullsize_items as $delta => $item) : ?>
        <?php print render($item); ?>
      <?php endforeach; ?>
    </div>
    <a class="left carousel-control ua-gallery-carousel-control" data-slide="prev" href="#<?php print $gallery_name; ?>" role="button">
      <i aria-hidden="true" class="carousel-next ua-brand-left-arrow"></i>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control ua-gallery-carousel-control" data-slide="next" href="#<?php print $gallery_name; ?>" role="button">
      <i aria-hidden="true" class="carousel-prev ua-brand-right-arrow"></i>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
