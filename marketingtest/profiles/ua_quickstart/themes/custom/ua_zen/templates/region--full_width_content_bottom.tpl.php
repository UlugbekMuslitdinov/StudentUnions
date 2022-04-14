<?php
/**
 * @file
 * Returns the HTML for the full_width_content_2 region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728140
 */
?>
<?php if ($content): ?>
<div class="<?php print $classes;?>">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
    	<?php print $content; ?>
      </div>
    </div>
  </div>
</div> <!--Close wrapper-->
<?php endif; ?>

