<?php
/**
 * @file
 * Display simplified UAQS Illustrated Link content.
 *
 * Available variables:
 * - $content: An associative array of fields ready for rendering
 *   - field_uaqs_prettylink_image: A decorative or supplementary image.
 *   - field_uaqs_prettylink_link: The link itself.
 *   field names as keys and the render arrays as values.
 * - $classes: A string containing CSS classes for the outer wrapper.
 * - $attributes: A string containing HTML attributes for the wrapper.
 * The link counts as the significant content: the image should be additional
 * decoration. The usual bean clearfix class on the wrapper is missing.
 *
 * @see bean.tpl.php
 */
?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($content['field_uaqs_prettylink_image']); ?>
  <?php print render($content['field_uaqs_prettylink_link']); ?>
</div>
