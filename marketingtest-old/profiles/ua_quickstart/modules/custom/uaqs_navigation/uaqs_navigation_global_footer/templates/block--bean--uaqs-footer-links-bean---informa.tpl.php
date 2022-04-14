<?php
/**
 * @file
 * Returns the HTML for a block.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728246
 */
?>
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> col-xs-12 col-sm-4 col-md-3 col-lg-3"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <h2 class="h5"><strong class="text-uppercase"><?php print render($title); ?></strong></h2>
  <?php print render($title_suffix); ?>
  <?php print $content; ?>
</div>
<div class="clearfix visible-xs-block col-xs-12">
    <hr>
</div>
