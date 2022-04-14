<?php

include_once dirname(__FILE__) . '/includes/common.inc';

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function ua_zen_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL) {
  $theme = !empty($form_state['build_info']['args'][0]) ? $form_state['build_info']['args'][0] : FALSE;
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id) || $theme === FALSE) {
    return;
  }

  $form['theme_settings']['site_display_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Logo Text'),
    '#description' => t('This text will display in place of a logo image if the Logo option above is toggled off and the Site name option is toggled on.'),
    '#default_value' => ua_zen_settings_site_display_name(),
  );

  // Original Zen theme: breadcrumb settings.
  $form['breadcrumb'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Breadcrumb settings'),
  );
  $form['breadcrumb']['zen_breadcrumb'] = array(
    '#type'          => 'select',
    '#title'         => t('Display breadcrumb'),
    '#default_value' => theme_get_setting('zen_breadcrumb'),
    '#options'       => array(
                          'yes'   => t('Yes'),
                          'admin' => t('Only in admin section'),
                          'no'    => t('No'),
                        ),
  );
  $form['breadcrumb']['breadcrumb_options'] = array(
    '#type' => 'container',
    '#states' => array(
      'invisible' => array(
        ':input[name="zen_breadcrumb"]' => array('value' => 'no'),
      ),
    ),
  );
  $form['breadcrumb']['breadcrumb_options']['zen_breadcrumb_home'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Show home page link in breadcrumb'),
    '#default_value' => theme_get_setting('zen_breadcrumb_home'),
  );
  $form['breadcrumb']['breadcrumb_options']['zen_breadcrumb_title'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Append the content title to the end of the breadcrumb'),
    '#default_value' => theme_get_setting('zen_breadcrumb_title'),
    '#description'   => t('Useful when the breadcrumb is not placed just before the title.'),
  );

  // Original Zen theme: accessibility and support settings.
  $form['support'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Accessibility and support settings'),
  );
  $form['support']['zen_skip_link_anchor'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Anchor ID for the “skip link”'),
    '#default_value' => theme_get_setting('zen_skip_link_anchor'),
    '#field_prefix'  => '#',
    '#description'   => t('Specify the HTML ID of the element that the accessible-but-hidden “skip link” should link to. Note: that element should have the <code>tabindex="-1"</code> attribute to prevent an accessibility bug in webkit browsers. (<a href="!link">Read more about skip links</a>.)', array('!link' => 'https://drupal.org/node/467976')),
  );
  $form['support']['zen_skip_link_text'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Text for the “skip link”'),
    '#default_value' => theme_get_setting('zen_skip_link_text'),
    '#description'   => t('For example: <em>Jump to navigation</em>, <em>Skip to content</em>'),
  );
  $form['support']['zen_html5_respond_meta'] = array(
    '#type'          => 'checkboxes',
    '#title'         => t('Add HTML5 and responsive scripts and meta tags to every page.'),
    '#default_value' => theme_get_setting('zen_html5_respond_meta'),
    '#options'       => array(
                          'respond' => t('Add Respond.js JavaScript to add basic CSS3 media query support to IE 6-8.'),
                          'html5' => t('Add HTML5 shim JavaScript to add support to IE 6-8.'),
                          'meta' => t('Add meta tags to support responsive design on mobile devices.'),
                        ),
    '#description'   => t('IE 6-8 require a JavaScript polyfill solution to add basic support of HTML5 and CSS3 media queries. If you prefer to use another polyfill solution, such as <a href="!link">Modernizr</a>, you can disable these options. Respond.js only works if <a href="@url">Aggregate CSS</a> is enabled. Mobile devices require a few meta tags for responsive designs.', array('!link' => 'http://www.modernizr.com/', '@url' => url('admin/config/development/performance'))),
  );

  // Original Zen theme: theme development settings.
  $form['themedev'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Theme development settings'),
  );
  $form['themedev']['zen_rebuild_registry'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Rebuild theme registry on every page.'),
    '#default_value' => theme_get_setting('zen_rebuild_registry'),
    '#description'   => t('During theme development, it can be very useful to continuously <a href="!link">rebuild the theme registry</a>. WARNING: this is a huge performance penalty and must be turned off on production websites.', array('!link' => 'https://drupal.org/node/173880#theme-registry')),
  );

  // Display a warning if jQuery Update isn't enabled or using a lower version.
  if (!theme_get_setting('ua_bootstrap_toggle_jquery_error')) {
    $jquery_version = FALSE;
    if (module_exists('jquery_update')) {
      // Get theme specific jQuery version.
      $jquery_version = theme_get_setting('jquery_update_jquery_version', $theme);

      // Get site wide jQuery version if theme specific one is not set.
      if (!$jquery_version) {
        $jquery_version = variable_get('jquery_update_jquery_version', '3.1');
      }
    }

    // Ensure the jQuery version is >= 3.1.
    if (!$jquery_version || !version_compare($jquery_version, '3.1', '>=')) {
      drupal_set_message(t('UA Zen requires a minimum jQuery version of 3.1 or higher. Please enable the <a href="!jquery_update_project_url">jQuery Update</a> module. If you are seeing this message, then you must enable and <a href="!jquery_update_configure">configure</a> jQuery Update or optionally <a href="!suppress_jquery_error">suppress this message</a> instead.', array(
        '!jquery_update_project_url' => 'https://www.drupal.org/project/jquery_update',
        '!jquery_update_configure' => url('admin/config/development/jquery_update'),
        '!suppress_jquery_error' => url('admin/appearance/settings/' . $theme, array(
          'fragment' => 'edit-ua-bootstrap-toggle-jquery-error',
        )),
      )), 'error', FALSE);
    }
  }
  //
  // UA Bootstrap settings.
  //
  $form['ua_settings']['ua_bootstrap'] = array(
    '#type' => 'fieldset',
    '#title' => t('UA Bootstrap Settings'),
  );
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_source'] = array(
    '#type' => 'radios',
    '#title' => t('UA Bootstrap Source'),
    '#options' => array(
      'local' => t('Use local copy of UA Bootstrap packaged with UA Zen <em>(!stableversion)</em>', array('!stableversion' => UA_ZEN_UA_BOOTSTRAP_STABLE_VERSION)),
      'cdn' => t('Use external copy of UA Bootstrap hosted on the UA Bootstrap CDN'),
    ),
    '#default_value' => theme_get_setting('ua_bootstrap_source'),
    '#prefix' =>  t('UA Zen requires the !uabootstrap front-end framework.  UA Bootstrap can either be loaded from the local copy packaged with UA Zen or from the !uabootstrapcdn. !warning', array(
      '!uabootstrap' => l(t('UA Bootstrap'), 'http://uadigital.arizona.edu/ua-bootstrap', array(
        'external' => TRUE,
      )),
      '!uabootstrapcdn' => l(t('UA Bootstrap CDN'), 'https://cdn.uadigital.arizona.edu/lib/ua-bootstrap', array(
        'external' => TRUE,
      )),
      '!warning' => '<div class="alert alert-info messages info"><strong>' . t('NOTE') . ':</strong> ' . t('The UA Bootstrap CDN is the preferred method for providing huge performance gains in load time.') . '</div>',
    )),
  );
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_cdn'] = array(
    '#type' => 'fieldset',
    '#title' => t('UA Bootstrap CDN Settings'),
    '#states' => array(
      'visible' => array(
        ':input[name="ua_bootstrap_source"]' => array('value' => 'cdn'),
      )
    ),
  );
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_cdn']['ua_bootstrap_cdn_version'] = array(
    '#type' => 'radios',
    '#title' => t('UA Bootstrap CDN version'),
    '#options' => array(
      'stable' => t('Stable version: This option has undergone the most testing within the ua_zen theme. Currently: <em>!stableversion</em> (Recommended)', array('!stableversion' => UA_ZEN_UA_BOOTSTRAP_STABLE_VERSION)),
      'latest' => t('Latest tagged version. The most recently tagged stable release of UA Bootstrap. While this has not been explicitly tested on this version of ua_zen, it’s probably OK to use on production sites. Please report bugs to the UA Digital team.
      '),
      'master' => t('Latest dev version. This is the tip of the master branch of UA Bootstrap. Please do not use on production unless you are following the ua-bootstrap project closely. Please report bugs to the UA Digital team.'),
    ),
    '#default_value' => theme_get_setting('ua_bootstrap_cdn_version'),
  );
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_minified'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Use minified version of UA Bootstrap.'),
    '#default_value' => theme_get_setting('ua_bootstrap_minified'),
  );
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_style'] = array(
    '#type' => 'fieldset',
    '#title' => t('UA Bootstrap Style Settings'),
  );
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_style']['ua_brand_icons_source'] = array(
    '#type' => 'radios',
    '#title' => t('UA Brand Icons Source'),
    '#options' => array(
      'local' => t('Use local copy of <a href="http://uadigital.arizona.edu/ua-bootstrap/components.html#ua-brand-icons">UA Brand Icons</a> packaged with UA Zen <em>(!stableversion)</em>', array('!stableversion' => UA_ZEN_UA_BRAND_ICONS_STABLE_VERSION)),
      'cdn' => t('Use external copy of <a href="http://uadigital.arizona.edu/ua-bootstrap/components.html#ua-brand-icons">UA Brand Icons</a> hosted on the CDN'),
    ),
    '#default_value' => theme_get_setting('ua_brand_icons_source'),
  );
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_style']['ua_brand_icons_class'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Add <code>ua-brand-icons</code> class to <code>html</code> element.'),
    '#default_value' => theme_get_setting('ua_brand_icons_class'),
  );
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_style']['external_links'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Use UA Bootstrap external links styling.'),
    '#default_value' => theme_get_setting('external_links'),
  );
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_style']['sticky_footer'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Use the UA Bootstrap sticky footer template.'),
    '#default_value' => theme_get_setting('sticky_footer'),
  );

  // Suppress jQuery message.
  $form['ua_settings']['ua_bootstrap']['ua_bootstrap_toggle_jquery_error'] = array(
    '#type' => 'checkbox',
    '#title' => t('Suppress jQuery version error message.'),
    '#default_value' => theme_get_setting('ua_bootstrap_toggle_jquery_error'),
    '#description' => t('Enable this if the version of jQuery has been upgraded to 3.1+ using a method other than the !jquery_update module.', array(
      '!jquery_update' => l(t('jQuery Update'), 'https://drupal.org/project/jquery_update'),
    )),
  );
  // Tables.
  $form['ua_settings']['tables'] = array(
    '#type' => 'fieldset',
    '#title' => t('Tables'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['ua_settings']['tables']['ua_zen_table_bordered'] = array(
    '#type' => 'checkbox',
    '#title' => t('Bordered table'),
    '#default_value' => theme_get_setting('ua_zen_table_bordered', $theme),
    '#description' => t('Add borders on all sides of the table and cells.'),
  );
  $form['ua_settings']['tables']['ua_zen_table_condensed'] = array(
    '#type' => 'checkbox',
    '#title' => t('Condensed table'),
    '#default_value' => theme_get_setting('ua_zen_table_condensed', $theme),
    '#description' => t('Make tables more compact by cutting cell padding in half.'),
  );
  $form['ua_settings']['tables']['ua_zen_table_hover'] = array(
    '#type' => 'checkbox',
    '#title' => t('Hover rows'),
    '#default_value' => theme_get_setting('ua_zen_table_hover', $theme),
    '#description' => t('Enable a hover state on table rows.'),
  );
  $form['ua_settings']['tables']['ua_zen_table_striped'] = array(
    '#type' => 'checkbox',
    '#title' => t('Striped rows'),
    '#default_value' => theme_get_setting('ua_zen_table_striped', $theme),
    '#description' => t('Add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>. <strong>Note:</strong> Striped tables are styled via the <code>:nth-child</code> CSS selector, which is not available in Internet Explorer 8.'),
  );
  $form['ua_settings']['tables']['ua_zen_table_responsive'] = array(
    '#type' => 'checkbox',
    '#title' => t('Responsive tables'),
    '#default_value' => theme_get_setting('ua_zen_table_responsive', $theme),
    '#description' => t('Makes tables responsive by wrapping them in <code>.table-responsive</code> to make them scroll horizontally up to small devices (under 768px). When viewing on anything larger than 768px wide, you will not see any difference in these tables.'),
  );
  // Pager
  $form['pager'] = array(
    '#type' => 'fieldset',
    '#title' => t('Pagination'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  $form['pager']['ua_zen_pager_first_and_last'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show "First" and "Last" links in the pager'),
    '#description' => t('Allow user to choose whether to display "First" and "Last" links on pagers.'),
    '#default_value' => theme_get_setting('ua_zen_pager_first_and_last'),
  );

  $form['logo']['primary_logo_alt_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Custom primary logo alt text'),
    '#description' => t('Alternative text is used by screen readers, search engines, and when the image cannot be loaded. By adding alt text you improve accessibility and search engine optimization.'),
    '#default_value' => theme_get_setting('primary_logo_alt_text'),
    '#element_validate' => array('token_element_validate'),
  );
  $form['logo']['primary_logo_title_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Custom primary logo title text'),
    '#description' => t('Title text is used in the tool tip when a user hovers their mouse over the image. Adding title text makes it easier to understand the context of an image and improves usability.'),
    '#default_value' => theme_get_setting('primary_logo_title_text'),
    '#element_validate' => array('token_element_validate'),
  );

  $form['logo']['tokens'] = array(
    '#theme' => 'token_tree_link',
    '#global_types' => TRUE,
    '#click_insert' => TRUE,
  );

  $form['logo']['#weight'] = 0.1;
  $footer_logo_form_weight = $form['logo']['#weight'] + .01;
  $institutional_logo_form_weight = $footer_logo_form_weight + .01;

  // Add secondary logo upload field to theme settings. Code source: mjharmon's
  // research on Drupal core & his own knowledge of Drupal internals and
  // development doctrine this approach sidesteps the need to mark the file as
  // permanent - which the earlier technique did require because it never
  // copied the file from PHP's temporary holding space. This technique also
  // gives the field a "stock" feel to the user, rather than the bolt on feel
  // the prior solution created.
  $form['footer_logo'] = array(
    '#type' => 'fieldset',
    '#title' => t('Footer Logo Settings'),
    '#weight' => $footer_logo_form_weight,
  );

  $form['footer_logo']['footer_default_logo'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use the header logo settings'),
    '#default_value' => theme_get_setting('footer_default_logo'),
    '#tree' => FALSE,
    '#description' => t('Check here if you want the theme to match the logo settings used in the header.'),
  );

  $form['footer_logo']['settings'] = array(
    '#type' => 'container',
    '#states' => array(
      // Hide the logo settings when using the default logo.
      'invisible' => array(
        'input[name="footer_default_logo"]' => array(
          'checked' => TRUE,
        ),
      ),
    ),
  );

  $form['footer_logo']['footer_logo_link_destination'] = array(
    '#type' => 'textfield',
    '#title' => t('Footer logo link destination'),
    '#description' => t('Where should the footer logo link to. Example: &#x3C;front&#x3E;'),
    '#default_value' => theme_get_setting('footer_logo_link_destination'),
  );

  $form['footer_logo']['footer_logo_alt_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Footer logo alt text'),
    '#description' => t('Alternative text is used by screen readers, search engines, and when the image cannot be loaded. By adding alt text you improve accessibility and search engine optimization.'),
    '#default_value' => theme_get_setting('footer_logo_alt_text'),
    '#element_validate' => array('token_element_validate'),
  );

  $form['footer_logo']['footer_logo_title_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Footer logo title text'),
    '#description' => t('Title text is used in the tool tip when a user hovers their mouse over the image. Adding title text makes it easier to understand the context of an image and improves usability.'),
    '#default_value' => theme_get_setting('footer_logo_title_text'),
    '#element_validate' => array('token_element_validate'),
  );

  $form['footer_logo']['tokens'] = array(
    '#theme' => 'token_tree_link',
    '#global_types' => TRUE,
    '#click_insert' => TRUE,
  );

  $form['footer_logo']['settings']['footer_logo_path'] = array(
    '#type' => 'textfield',
    '#title' => t('Path to custom footer logo'),
    '#description' => t('The path to the file you would like to use as your footer logo file instead of the logo in the header.'),
    '#default_value' => theme_get_setting('footer_logo_path'),
  );

  $form['footer_logo']['settings']['footer_logo_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload footer logo image'),
    '#maxlength' => 40,
    '#description' => t("If you don't have direct file access to the server, use this field to upload your footer logo."),
  );

  $form['intitutional_logo'] = array(
    '#type' => 'fieldset',
    '#title' => t('Institutional Logo Settings'),
    '#weight' => $institutional_logo_form_weight,
  );

  $form['intitutional_logo']['wordmark'] = array(
    '#type' => 'checkbox',
    '#title' => t('Institutional header wordmark logo'),
    '#description' => t('With few execeptions, this should always be enabled.'),
    '#default_value' => theme_get_setting('wordmark'),
  );

  $form['ua_settings']['settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('Quickstart Site Settings'),
  );

  $form['ua_settings']['settings']['info_security_privacy'] = array(
    '#type' => 'checkbox',
    '#title' => t('University Information Security and Privacy link'),
    '#description' => t('With few execeptions, this should always be enabled.'),
    '#default_value' => theme_get_setting('info_security_privacy'),
  );

  $form['ua_settings']['settings']['ua_copyright_notice'] = array(
    '#type' => 'textfield',
    '#title' => t('Copyright notice'),
    '#maxlength' => 512,
    '#description' => t('A copyright notice for this site. The value here will appear after a "Copyright YYYY" notice (where YYYY is the current year).'),
    '#default_value' => theme_get_setting('ua_copyright_notice'),
  );

  $form['ua_settings']['settings']['ua_zen_hide_front_title'] = array(
    '#type' => 'checkbox',
    '#title' => t('Hide title of front page node'),
    '#description' => t('If this is checked, the title of the node being displayed on the front page will not be visible'),
    '#default_value' => theme_get_setting('ua_zen_hide_front_title'),
  );

  $form['ua_settings']['settings']['ua_zen_back_to_top'] = array(
    '#type' => 'checkbox',
    '#title' => t('Add back to top button to pages longer than 4 screens (browser window height).'),
    '#default_value' => theme_get_setting('ua_zen_back_to_top'),
  );

  $form['ua_settings']['main_menu'] = array(
    '#type' => 'fieldset',
    '#title' => t('Main Menu Settings'),
  );

  $form['ua_settings']['main_menu']['ua_zen_main_menu_style'] = array(
    '#type' => 'radios',
    '#options' => array(
      'bootstrap' => t('Render the main menu element using UA Bootstrap\'s Dropdown Navbar component.'),
      'superfish' => t('Render the main menu element using Superfish (requires UAQS Navigation & Superfish modules).'),
    ),
    '#title' => t('Main menu style'),
    '#default_value' => theme_get_setting('ua_zen_main_menu_style'),
    '#prefix' =>  t('UA Zen can render the \'Main menu\' page element in a number of different styles.  The UA Bootstrap Dropdown Navbar component style will be used as the fallback option if the dependencies for the other styles are missing.'),
  );
   $form['ua_settings']['main_menu']['ua_zen_main_menu_style']['menu_style_enhancements'] = array(
    '#type' => 'fieldset',
    '#weight' => 100,
    '#title' => t('Menu Style Enhancements'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
    '#states' => array(
      'visible' => array(
        ':input[name="ua_zen_main_menu_style"]' => array('value' => 'bootstrap'),
      )
    )
  );

  $form['ua_settings']['main_menu']['ua_zen_main_menu_style']['menu_style_enhancements']['ua_zen_bs_overlay_menu_scroll'] = array(
    '#type' => 'checkbox',
    '#title' => t('Overlay Menu Scroll'),
    '#default_value' => theme_get_setting('ua_zen_bs_overlay_menu_scroll', $theme),
    '#description' => t('Render the main menu element using UAQS customized Bootstrap Overlay Menu Scroll Navigation'),
  );

  $form['ua_settings']['main_menu']['ua_zen_main_menu_style']['menu_style_enhancements']['ua_zen_bs_dropdown_direction'] = array(
    '#type' => 'radios',
    '#title' => t('Fix Dropdown Menu Direction'),
    '#default_value' => theme_get_setting('ua_zen_bs_dropdown_direction', $theme),
    '#description' => t('Prevent longer menu items from overflowing off the right side of the screen by aligning the menu to the right instead of to the left.'),
    '#options' => array(
      'disabled' => t("Don't apply any fix."),
      'last' => t('Apply "dropdown-right" class to last menu item only.'),
      'js' => t('Fix all dropdowns that are too wide with Javascript.'),
    ),
  );

  $form['#validate'][] = 'ua_zen_settings_form_validate';
  $form['#submit'][] = 'ua_zen_settings_form_submit';

  // We are editing the $form in place, so we don't need to return anything.
}

/**
 * Custom function to determine the site display name setting.
 */
function ua_zen_settings_site_display_name() {
  $str_site_display_name = check_plain(theme_get_setting('site_display_name'));
    if (empty($str_site_display_name)) {
      $str_site_display_name = check_plain(variable_get('site_name'));
    }
  
  return $str_site_display_name;
}

/**
 * Custom validation handler for theme settings form.
 */
function ua_zen_settings_form_validate($form, &$form_state) {
  // Validate the incoming file appropriately.
  $ary_validators = array('file_validate_is_image' => array(), 'file_validate_extensions' => array('png gif jpg jpeg'));
  $str_path = "";
  // Check for a new uploaded logo.
  $obj_file = file_save_upload('footer_logo_upload', $ary_validators);

  if (isset($obj_file)) {
    // File upload was attempted.
    if ($obj_file) {
      // Put the temporary file in form_values so we can save it on submit.
      $form_state['values']['footer_logo_upload'] = $obj_file;
    }
    else {
      // File upload failed.
      form_set_error('footer_logo_upload', t('The footer logo could not be uploaded.'));
    }
  }

  if (!empty($form_state['values']['footer_logo_path'])) {
    $str_path = _system_theme_settings_validate_path($form_state['values']['footer_logo_path']);
    if (!$str_path) {
      form_set_error('footer_logo_path', t('The custom logo path is invalid.'));
    }
  }
}

/**
 * Custom submit handler for theme settings form.
 */
function ua_zen_settings_form_submit($form, &$form_state) {
  $ary_values = $form_state['values'];
  $str_filename = "";

  // If the user uploaded a new logo, save it to a permanent location.
  if (!empty($ary_values['footer_logo_upload'])) {
    $obj_file = $ary_values['footer_logo_upload'];
    unset($form_state['values']['footer_logo_upload']);
    $str_filename = file_unmanaged_copy($obj_file->uri, NULL, FILE_EXISTS_REPLACE);
    $ary_values['footer_logo_path'] = $str_filename;
  }

  // If the path as been entered (either automatically or directly) check that
  // it exists. Only store it if does.
  if (!empty($ary_values['footer_logo_path'])) {
    $str_filename = _system_theme_settings_validate_path($ary_values['footer_logo_path']);
    if ($str_filename === FALSE) {
      $form_state['values']['footer_logo_path'] = "";
    }
    else {
      $form_state['values']['footer_logo_path'] = $str_filename;
    }
  }
}
