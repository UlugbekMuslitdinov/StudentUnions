<?php
/**
 * @file
 * Returns the HTML for a block.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728246
 */
?>
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> small text-right-lg text-right-md  text-right-sm text-center-xs"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php if($title) : ?>
    <h2 class="h5"><strong class="text-uppercase"><?php print render($title); ?></strong></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php print $content; ?>
</div>
