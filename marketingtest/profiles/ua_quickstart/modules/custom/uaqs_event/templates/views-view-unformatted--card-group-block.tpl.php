<?php

/**
 * @file
 * View template to display a list of rows suitable for a UA Bootstrap card
 * group block display.
 *
 * Excludes unused row wrapper div element provided by
 * views-view-unformatted.tpl.php.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h4><?php print $title; ?></h4>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
<?php endforeach; ?>
