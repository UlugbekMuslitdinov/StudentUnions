<?php
/**
 * @file
 * Display simplified UAQS Mini Blurb content.
 *
 * Available variables:
 * - $content: An associative array of fields ready for rendering
 *   - field_uaqs_text_area: A freestanding text block.
 * - $classes: A string containing CSS classes for the outer wrapper.
 * - $attributes: A string containing HTML attributes for the outer wrapper.
 * - $content_attributes: A string of HTML attributes for the inner wrapper.
 * This generates less markup than the default Bean template, adding few
 * wrappers and relying on some minimalist field renderings, but retains an
 * inner content wrapper.
 *
 * @see bean.tpl.php
 */

?>
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <?php print render($content['field_uaqs_text_area']); ?>
  </div>
</div>
