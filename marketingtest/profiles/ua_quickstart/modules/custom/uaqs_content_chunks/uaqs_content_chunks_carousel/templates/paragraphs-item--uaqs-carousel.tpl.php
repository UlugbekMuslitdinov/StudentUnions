<?php

/**
 * @file
 * Display an UAQS Carousel
 *
 * Available variables:
 * - $content: An associative array of fields ready for rendering
 *   - field_uaqs_text_area: One paragraph of text.
 * - $classes: A string containing CSS classes
 * - $attributes: A string containing HTML attributes
 * Unlike most paragraph-items from Paragraphs, this actually marks up
 * the text with <p></p>.
 *
 * @see paragraphs-item.tpl.php
 */
?>
<div class="row">
  <div class="<?php print $classes; ?>">
    <div class="carousel slide" data-ride="carousel" id="carousel-slide-<?php print $id; ?>">
      <?php print render($content); ?>
      <a class="left carousel-control" data-slide="prev" href="#carousel-slide-<?php print $id; ?>" role="button">
        <i aria-hidden="true" class="carousel-prev ua-brand-left-arrow text-size-h1"></i>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" data-slide="next" href="#carousel-slide-<?php print $id; ?>" role="button">
        <i aria-hidden="true" class="carousel-next ua-brand-right-arrow text-size-h1"></i>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>