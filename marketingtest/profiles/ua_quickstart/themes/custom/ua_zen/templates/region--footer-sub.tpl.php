<?php
/**
 * @file
 * Returns the HTML for the sub footer region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728140
 */
?>
<?php if ($info_security_privacy || $copyright_notice || $content): ?>
<div id="footer_sub" class="<?php print $classes; ?>">
  	<div class="container">
        <div class="row">
    	    <?php print $content; ?>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
            <?php if ($content): ?>
                <hr>
            <?php endif; ?>
            <?php print $info_security_privacy ?>
            <?php print $copyright_notice ?>
            </div>
        </div>
  	</div>
</div>
<?php endif ?>
