<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>
<?php if (!empty($page['alert'])) : ?>
<section class="container">
  <div class="row">
    <div class="col-xs-12">
      <?php print render($page['alert']); ?>
    </div>
  </div>
</section>
<?php endif; // End alert ?>

<header id="header_ua" class="page-row l-arizona-header bg-red bg-cochineal-red">
  <section class="container l-container">
    <div class="row">
      <?php // Defined in template file: region--header-ua.tpl.php. ?>
      <?php if (!empty($page['header_ua'])) : ?>
        <div class="col-xs-10 col-sm-6">
          <?php print render($page['header_ua']); ?>
        </div>
      <?php endif;?>
      <?php if (!empty($page['header_ua_utilities'])) : ?>
        <div class="col-xs-2 col-sm-6">
          <div class="row">
            <?php print render($page['header_ua_utilities']); ?>
          </div>
        </div>
      <?php endif; // End header_ua_utilities ?>
    </div>
  </section>
</header>

<header class="header page-row" id="header_site" role="banner">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-lg-4">
        <?php if ($logo):?>
          <?php print $logo; ?>
        <?php endif; ?>
      </div>
      <div class="col-xs-12 col-sm-6 col-lg-8">
        <div class="row">
          <div class="col-xs-12">
            <?php if ($secondary_menu): ?> <!-- Using Secondary Menu for Utility Links -->
              <div class="header__secondary-menu" id="utility_links" role="complementary" aria-label="utility links"> <!-- id was #secondary-menu -->
                <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'inline', 'clearfix')))); ?>
              </div>
            <?php endif; // End $secondary_menu ?>
            <?php if (!empty($page['header'])) : ?>
              <?php print render($page['header']); ?>
            <?php endif; // End header ?>
          </div>
        </div>
        <?php if (!empty($page['header_2'])) : ?>
          <div class="row">
            <?php print render($page['header_2']); ?>
          </div>
        <?php endif; // End header_2 ?>
      </div>
    </div> <!-- /.row -->
  </div> <!-- /.container -->

  <?php if (!empty($primary_nav) || !empty($page['navigation'])): ?>
    <div id="nav-container" class="container">
      <nav id="main_nav" class="navbar navbar-default navbar-static-top" role="navigation" aria-label="main">
        <?php if (!empty($primary_nav)): ?>
          <?php print render($primary_nav); ?>
        <?php endif; ?>
        <?php if (!empty($page['navigation'])): ?>
          <?php print render($page['navigation']); ?>
        <?php endif; ?>
      </nav> <!-- /#main_nav-->
    </div> <!-- /.container -->
  <?php endif; // End primary_nav ?>
</header>

<div id="main" class="page-row page-row-expanded page-row-padding-bottom <?php print $classes; ?>" role="main">
  <?php if (!empty($page['help']) || ($messages)) : ?>
  <section class="container">
      <div class="row">
          <div class="col-xs-12">
              <?php print $messages; ?>
              <?php if (!empty($page['help'])) : ?>
              <?php print render($page['help']); ?>
              <?php endif; ?>
          </div>
      </div>
  </section>
  <?php endif; // End help ?>
  <?php if (!empty($page['content_featured'])) : ?>
  <section id="content_featured">
    <?php print render($page['content_featured']); ?>
  </section>
  <?php endif; // End content_featured ?>
    <?php if (!empty($page['highlighted'])) : ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php print render($page['highlighted']); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12" aria-label="breadcrumb">
            <?php print $breadcrumb; ?>
            <?php if (!empty($page['content_top'])) : ?>
              <?php print render($page['content_top']); ?>
            <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
        <div id="content" class="<?php print $content_column_class; ?>">
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
          <h1 class="page__title title mt-4" id="page-title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php print render($tabs); ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
        </div>
        <?php if (!empty($page['sidebar_first']) && empty($page['sidebar_second'])): ?>
          <aside class="col-sm-3 col-sm-pull-9" role="complementary">
            <?php print render($page['sidebar_first']); ?>
          </aside>  <!-- /#sidebar-first -->
        <?php endif; ?>
        <?php if (!empty($page['sidebar_first']) && !empty($page['sidebar_second'])): ?>
          <aside class="col-sm-3 col-sm-pull-6" role="complementary">
            <?php print render($page['sidebar_first']); ?>
          </aside>  <!-- /#sidebar-first -->
        <?php endif; ?>
        <?php if (!empty($page['sidebar_second'])): ?>
          <aside class="col-sm-3" role="complementary">
            <?php print render($page['sidebar_second']); ?>
          </aside>  <!-- /#sidebar-second -->
        <?php endif; ?>
        </div>
    </div>
   <?php if (!empty($page['full_width_content_bottom'])) : ?>
     <?php print render($page['full_width_content_bottom']) ?>
   <?php endif; ?>
   <?php if (!empty($page['content_2_col_1']) || !empty($page['content_2_col_2'])) : ?>
    <div class="container">
        <div class="row">
           <div class="col-md-6">
               <?php print render($page['content_2_col_1']); ?>
           </div>
           <div class="col-md-6">
               <?php print render($page['content_2_col_2']); ?>
           </div>
        </div>
    </div>
   <?php endif; ?>
   <?php if (!empty($page['content_3_col_1']) || !empty($page['content_3_col_2']) || !empty($page['content_3_col_3'])) : ?>
    <div class="container">
        <div class="row">
                <div class="col-md-4">
                    <?php print render($page['content_3_col_1']); ?>
                </div>
                <div class="col-md-4">
                    <?php print render($page['content_3_col_2']); ?>
                </div>
                <div class="col-md-4">
                    <?php print render($page['content_3_col_3']); ?>
                </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if (!empty($page['content_bottom'])) : ?>
    <div class="container">
        <div class="row">
        <article class="col-xs-12">
           <?php print render($page['content_bottom']); ?>
        </article>
        </div>
    </div>
   <?php endif; ?>
   <?php if (!empty($page['content_4_col_1']) || !empty($page['content_4_col_2']) || !empty($page['content_4_col_3']) || !empty($page['content_4_col_4'])) : ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php print render($page['content_4_col_1']); ?>
            </div>
            <div class="col-md-3">
                <?php print render($page['content_4_col_2']); ?>
            </div>
            <div class="col-md-3">
                <?php print render($page['content_4_col_3']); ?>
            </div>
            <div class="col-md-3">
                <?php print render($page['content_4_col_4']); ?>
            </div>
        </div>
    </div>
     <?php endif; ?>
</div> <!-- /.main -->
<!-- back to top button --->
<?php if (!empty($ua_zen_back_to_top)) : ?>
  <?php print render($ua_zen_back_to_top); ?>
<?php endif; ?>

<footer id="footer_site" class="page page-row" role="contentinfo">
  <?php print render($page['footer']); ?>
  <?php print render($page['footer_sub']); ?>
</footer>

<?php print render($page['bottom']); ?>
