<?php
/**
 * @file
 * Display an UAQS Captioned Image as an HTML5 figure.
 *
 * Available variables:
 * - $content: An associative array of fields ready for rendering
 *   - field_uaqs_image_author: Image credit author.
 *   - field_uaqs_image_caption: Image caption.
 *   - field_uaqs_image_license: Image credit usage information.
 *   - field_uaqs_image_title: Image credit title and source.
 *   - field_uaqs_isolated_image: The image itself.
 * - $classes: A string containing CSS classes for the figure.
 * - $attributes: A string containing HTML attributes for the figure.
 * Gather related fields inline, rather than using some additional mechanism
 * such as Field Groups.
 *
 * @see bean.tpl.php
 */
?>
<figure class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <?php
    if (!empty($content['field_uaqs_isolated_image'])):
      print render($content['field_uaqs_isolated_image']);
    endif;
  ?>
  <?php if ($content['have_figcaption']): ?>
    <figcaption>
      <?php if ($content['have_attribution']): ?>
        <small>
          <?php
            $fineprint = array();
            if (!empty($content['field_uaqs_image_title'])):
              $fineprint[] = render($content['field_uaqs_image_title']);
            endif;
            if (!empty($content['field_uaqs_image_author'])):
              if (count($fineprint)):
                $fineprint[] = ' by ';
              endif;
              $fineprint[] = render($content['field_uaqs_image_author']);
            endif;
            if (!empty($content['field_uaqs_image_license'])):
              if (count($fineprint)):
                $fineprint[] = ', ';
              endif;
              $fineprint[] = render($content['field_uaqs_image_license']);
            endif;
            print implode($fineprint);
          ?>
        </small>
      <?php endif; ?>
      <?php
        if (!empty($content['field_uaqs_image_caption'])):
          print render($content['field_uaqs_image_caption']);
        endif;
      ?>
    </figcaption>
  <?php endif; ?>
</figure>
