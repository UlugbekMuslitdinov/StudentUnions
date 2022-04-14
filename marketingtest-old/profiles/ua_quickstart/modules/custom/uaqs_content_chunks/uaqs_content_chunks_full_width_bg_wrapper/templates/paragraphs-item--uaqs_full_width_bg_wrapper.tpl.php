<?php
/**
 * @file
 * Display a UAQS full-width background wrapper paragraphs item.
 *
 * Available variables:
 * - $content: An associative array of fields ready for rendering.
 * - $classes: A string containing CSS classes.
 * - $attributes: A string containing HTML attributes.
 *
 * @see paragraphs-item.tpl.php
 */
?>

<?php if (!empty($content)): ?>
            </div>
        </div>
    </div>
</div>
<div class="<?php print $classes; ?>">
  <div class="container">
    <div class="row">
        <?php print render($content); ?>
    </div>
  </div>
</div><!--Close wrapper-->
<div class="container container-collapsed">
    <div class="row">
        <div <?php print $content_column_class; ?>>
            <div>
<?php endif; ?>
