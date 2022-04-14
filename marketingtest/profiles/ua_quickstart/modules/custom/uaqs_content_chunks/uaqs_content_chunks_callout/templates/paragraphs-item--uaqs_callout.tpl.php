<?php
/**
 * @file
 * Display a UAQS Callout paragraphs item.
 *
 * Available variables:
 * - $content: An associative array of fields ready for rendering.
 * - $classes: A string containing CSS classes.
 *
 * @see paragraphs-item.tpl.php
 */
?>

<?php if (!empty($content)): ?>
<div class="<?php print $classes; ?>">
  <div class="container-fluid">
    <div class="row">
        <?php print render($content); ?>
    </div>
  </div>
</div>
<?php endif; ?>