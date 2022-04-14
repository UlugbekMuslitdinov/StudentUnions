<?php
/**
 * @file
 * Display UAQS Plain Text.
 *
 * Available variables:
 * - $content: An associative array of fields ready for rendering
 *   - field_uaqs_text_area: One paragraph of text.
 * - $classes: A string containing CSS classes for the download.
 * - $attributes: A string containing HTML attributes for the download.
 * Unlike most paragraph-items from Paragraphs, this actually marks up
 * the text with <p></p>.
 *
 * @see paragraphs-item.tpl.php
 */

?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($content['field_uaqs_text_area']); ?>
</div>
