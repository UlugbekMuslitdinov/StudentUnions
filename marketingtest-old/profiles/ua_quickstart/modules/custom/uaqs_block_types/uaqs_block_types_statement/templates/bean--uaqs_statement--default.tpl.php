<?php
/**
 * @file
 * Display simplified UAQS Statement content.
 *
 * Available variables:
 * - $content: An associative array of fields ready for rendering
 *   - field_uaqs_text_area: One or two paragraphs of text.
 *   - field_uaqs_read_more: A link to further relevant content.
 * - $classes: A string containing CSS classes for the outer wrapper.
 * - $attributes: A string containing HTML attributes for the outer wrapper.
 * - $content_attributes: A string containing HTML attributes for the inner
 *   wrapper.
 *
 * This generates less markup than the default Bean template, adding few
 * wrappers and relying on some minimalist field renderings.
 *
 * @see bean.tpl.php
 */
?>
<section class="<?php print $classes; ?> background-wrapper bg-triangles-mosaic bg-sky"<?php print $attributes; ?>>
  <div class="container bs-docs-container">
    <div class="row">
      <p class="col-md-10 col-md-offset-1 text-center-not-xs text-center-md lead serif" <?php print $content_attributes; ?>>
        <?php
          print render($content['field_uaqs_text_area']);
        ?>
        <?php if (isset($content['field_uaqs_read_more'])): ?>
          <br />
          <?php
            print render($content['field_uaqs_read_more']);
          ?>
        <?php endif; ?>
      </p>
    </div>
  </div>
</section>
