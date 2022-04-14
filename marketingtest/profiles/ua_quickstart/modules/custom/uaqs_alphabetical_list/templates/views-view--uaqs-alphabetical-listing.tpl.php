<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>
<div class="<?php print $classes; ?>">
  <div class="row">
    <div class="col-xs-2 col-sm-12">
      <div class="row">
        <div id="uaqs-js-floating-alpha-nav-container">
          <nav id="uaqs-js-floating-alpha-nav" data-spy="affix" class="hidden-print affix-top uaqs-floating-alpha-nav bg-trans-white">
            <div class="container">
              <div class="row bottom-buffer-20">
                <section class="col-xs-12">
                    <ul id="uaqs-js-alpha-navigation" class="pagination pagination-sm pagination-square">
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#123">#</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#A">a</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#B">b</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#C">c</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#D">d</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#E">e</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#F">f</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#G">g</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#H">h</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#I">i</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#J">j</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#K">k</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#L">l</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#M">m</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#N">n</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#O">o</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#P">p</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#Q">q</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#R">r</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#S">s</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#T">t</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#U">u</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#V">v</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#W">w</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#X">x</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#Y">y</a></li>
                      <li class="text-uppercase disabled"><a aria-hidden="true" tabindex="-1" data-href="#Z">z</a></li>
                    </ul>
                </section>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
    <div class="col-xs-10 col-sm-12">

    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <?php print $title; ?>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
      <?php if ($header): ?>
        <div class="view-header">
          <?php print $header; ?>
        </div>
      <?php endif; ?>
      <div class="row">
        <section class="col-sm-4">
          <div class="form-group">
            <?php if (isset($view->args[1])) : ?>
            <label for="ua-js-bootstrap-search"><?php print filter_xss($view->args[1]); ?></label>
            <?php else: ?>
            <label class="sr-only" for="ua-js-bootstrap-search">Search</label>
            <?php endif; ?>
            <div class="search-form local-search">
              <input class="form-control input-search no-submit-btn" id="ua-js-bootstrap-search" type="text" placeholder="Search">
            </div>
          </div>
        </section><!-- /.col-lg-6 -->
      </div><!-- /.row -->
      <?php if ($exposed): ?>
        <div class="view-filters">
          <?php print $exposed; ?>
        </div>
      <?php endif; ?>

      <?php if ($attachment_before): ?>
        <div class="attachment attachment-before">
          <?php print $attachment_before; ?>
        </div>
      <?php endif; ?>

      <?php if ($rows): ?>
        <div class="view-content uaqs-js-search-results">
          <?php print $rows; ?>
        </div>
      <?php elseif ($empty): ?>
        <div class="view-empty">
          <?php print $empty; ?>
        </div>
      <?php endif; ?>

      <?php if ($pager): ?>
        <?php print $pager; ?>
      <?php endif; ?>

      <?php if ($attachment_after): ?>
        <div class="attachment attachment-after">
          <?php print $attachment_after; ?>
        </div>
      <?php endif; ?>

      <?php if ($more): ?>
        <?php print $more; ?>
      <?php endif; ?>

      <?php if ($footer): ?>
        <div class="view-footer">
          <?php print $footer; ?>
        </div>
      <?php endif; ?>

      <?php if ($feed_icon): ?>
        <div class="feed-icon">
          <?php print $feed_icon; ?>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="column col-xs-12">
          <div class="uaqs-js-no-results" style="display:none;">
            <h2>No results</h2>
            <p>Try a different search query.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /* class view */ ?>