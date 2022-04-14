<?php
/**
 * @file
 * Returns the HTML for a block.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728246
 */
?>
<div class="col-sm-5 col-md-4 col-lg-3 hidden-xs pull-right no-gutter">
  <div id="<?php print $block_html_id; ?>" class="resource-menu <?php print $classes; ?>"<?php print $attributes; ?>>
    <a class="btn btn-block btn-hollow-reverse dropdown-toggle btn-hollow-reverse-bloom btn-sm btn-hollow-no-hover-effect btn-resource" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" tabindex="0">
      <?php print render($title_prefix); ?>
      <?php if($title) : ?>
        <?php print render($title); ?>
      <?php endif; ?>
      <span class="caret"></span>
    </a>
    <?php print render($title_suffix); ?>
    <?php print $content; ?>
  </div>
</div>
