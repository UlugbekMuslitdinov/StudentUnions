<?php
/**
 * @file
 * Returns the HTML for the footer region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728140
 */
?>
<?php if ($footer_logo || $content): ?>
  <div class="<?php print $classes; ?>">
    <div class="container">
      <div class="row">
        <div class="page-row-padding-top page-row-padding-bottom"></div>
        <div class="page-row-padding-top page-row-padding-bottom"></div>
        <?php if ($footer_logo): ?>
          <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 text-center-xs text-left-not-xs">
            <div class="row bottom-buffer-30">
              <div class="col-xs-12">
               <?php print $footer_logo; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($content): ?>
          <!-- Add the extra clearfix for only the required viewport -->
          <div class="clearfix visible-xs-block"></div>
          <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
            <?php print $content; ?>
          </div>
        <?php endif; ?>
        <div class="col-xs-12">
          <hr>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
