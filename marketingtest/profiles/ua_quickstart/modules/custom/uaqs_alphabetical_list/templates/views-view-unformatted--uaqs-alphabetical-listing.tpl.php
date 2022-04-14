<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
<div id="<?php print strtoupper($title); ?>" class="uaqs-js-letter-container">
  <h3 class="text-uppercase text-blue60b sans"><?php print $title; ?></h3>
  <?php foreach ($rows as $id => $row): ?>
    <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
      <?php print $row; ?>
    </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>

