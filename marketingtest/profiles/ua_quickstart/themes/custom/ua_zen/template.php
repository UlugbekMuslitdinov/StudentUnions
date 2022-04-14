<?php

/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */

include_once dirname(__FILE__) . '/includes/common.inc';

// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('zen_rebuild_registry') && !defined('MAINTENANCE_MODE')) {
  // Rebuild .info data.
  system_rebuild_theme_data();
  // Rebuild theme registry.
  drupal_theme_rebuild();
}


/**
 * Implements HOOK_theme().
 */
function ua_zen_theme(&$existing, $type, $theme, $path) {
  include_once './' . drupal_get_path('theme', 'ua_zen') . '/includes/template.theme-registry.inc';
  return _ua_zen_theme($existing, $type, $theme, $path);
}


/**
 * Implements hook_css_alter().
 */
function ua_zen_css_alter(&$css) {
  // Exclude specified CSS files from theme.
  $excludes = ua_zen_get_theme_info(NULL, 'exclude][css');
  if (!empty($excludes)) {
    $css = array_diff_key($css, drupal_map_assoc($excludes));
  }

  // Add UA Bootstrap CSS based on theme settings.
  $ua_bootstrap_path = ua_zen_bootstrap_assets_path('css');
  if (!$ua_bootstrap_path) {
    return;
  }
  $ua_bootstrap_token = '';
  $ua_bootstrap_css_info = array(
    'every_page' => TRUE,
    'media' => 'all',
    'preprocess' => FALSE,
    'group' => CSS_SYSTEM,
    'browsers' => array('IE' => TRUE, '!IE' => TRUE),
    'weight' => -2,
  );

  $ua_bootstrap_source = theme_get_setting('ua_bootstrap_source');
  if ($ua_bootstrap_source == 'cdn') {
    if (theme_get_setting('ua_bootstrap_cdn_version') != 'stable') {
      $ua_bootstrap_token = '?=' . variable_get('css_js_query_string', '0');
    }
    $ua_bootstrap_css_info['type'] = 'external';
  }
  else {
    $ua_bootstrap_css_info['type'] = 'file';
  }

  $ua_bootstrap_css_info['data'] = $ua_bootstrap_path . $ua_bootstrap_token;
  $css[$ua_bootstrap_path] = $ua_bootstrap_css_info;

  // Popluate UA Bootstrap location variable for CKEditor.
  variable_set(UA_BOOTSTRAP_LOCATION, $ua_bootstrap_path . $ua_bootstrap_token);

  // Add UA Brand Icons CSS based on theme settings.
  $ua_brand_icons_path = ua_zen_brand_icons_assets_path('css');

  $ua_brand_icons_css_info = array(
    'every_page' => TRUE,
    'media' => 'all',
    'preprocess' => FALSE,
    'group' => CSS_SYSTEM,
    'browsers' => array('IE' => TRUE, '!IE' => TRUE),
    'weight' => -2,
  );

  $ua_brand_icons_source = theme_get_setting('ua_brand_icons_source');
  if ($ua_brand_icons_source == 'cdn') {
    $ua_brand_icons_css_info['type'] = 'external';
  }
  else {
    $ua_brand_icons_css_info['type'] = 'file';
  }

  $ua_brand_icons_css_info['data'] = $ua_brand_icons_path;
  $css[$ua_brand_icons_path] = $ua_brand_icons_css_info;
}

/**
 * Implements hook_js_alter().
 */
function ua_zen_js_alter(&$js) {
  // Add UA Bootstrap JS based on theme settings.
  $ua_bootstrap_path = ua_zen_bootstrap_assets_path('js');
  if (!$ua_bootstrap_path) {
    return;
  }
  $ua_bootstrap_token = '';
  $ua_bootstrap_js_info = array(
    'group' => JS_THEME,
    'weight' => 3,
    'scope' => 'footer',
  );

  $ua_bootstrap_source = theme_get_setting('ua_bootstrap_source');
  if ($ua_bootstrap_source == 'cdn') {
    if (theme_get_setting('ua_bootstrap_cdn_version') != 'stable') {
      $ua_bootstrap_token = '?=' . variable_get('css_js_query_string', '0');
    }
    $ua_bootstrap_js_info['type'] = 'external';
  }
  else {
    $ua_bootstrap_js_info['type'] = 'file';
  }

  $ua_bootstrap_js_info['data'] = $ua_bootstrap_path . $ua_bootstrap_token;
  $js[$ua_bootstrap_path] = $ua_bootstrap_js_info;
  $js[$ua_bootstrap_path] += drupal_js_defaults($ua_bootstrap_path);
}

/**
 * Helper function for constructing UA Bootstrap asset paths.
 */
function ua_zen_bootstrap_assets_path($type) {
  if (empty($type)) {
    return FALSE;
  }
  $ua_bootstrap_path = '';
  $ua_bootstrap_source = theme_get_setting('ua_bootstrap_source');
  $ua_bootstrap_minified = theme_get_setting('ua_bootstrap_minified');

  if ($ua_bootstrap_source == 'cdn') {
    $ua_bootstrap_cdn_version = theme_get_setting('ua_bootstrap_cdn_version');
    if ($ua_bootstrap_cdn_version == 'stable') {
      $ua_bootstrap_cdn_version = UA_ZEN_UA_BOOTSTRAP_STABLE_VERSION;
    }
    $ua_bootstrap_path = 'https://cdn.uadigital.arizona.edu/lib/ua-bootstrap/' . $ua_bootstrap_cdn_version . '/ua-bootstrap';
  }
  else {
    $ua_bootstrap_path = drupal_get_path('theme', 'ua_zen') . "/ua-bootstrap/ua-bootstrap";
  }

  if ($ua_bootstrap_minified) {
    $ua_bootstrap_path .= ".min";
  }

  return $ua_bootstrap_path . "." . $type;
}

/**
 * Helper function for constructing UA Brand Icons asset paths.
 */
function ua_zen_brand_icons_assets_path($type) {
  $ua_brand_icons_path = '';
  $ua_brand_icons_source = theme_get_setting('ua_brand_icons_source');

  if ($ua_brand_icons_source == 'cdn') {
    $ua_brand_icons_path = 'https://cdn.digital.arizona.edu/lib/ua-brand-icons/' . UA_ZEN_UA_BRAND_ICONS_STABLE_VERSION . '/ua-brand-icons.min.css';
  }
  else {
    $ua_brand_icons_path = drupal_get_path('theme', 'ua_zen') . "/ua-brand-icons/ua-brand-icons.min.css";
  }

  return $ua_brand_icons_path;
}

/**
 * Custom function for the secondary footer logo option.
 */
function ua_zen_footer_logo() {
  $str_return = "";
  $str_footer_logo_path = theme_get_setting('footer_logo_path');
  $str_footer_link_destination = theme_get_setting('footer_logo_link_destination');
  $str_footer_alt_text = check_plain(theme_get_setting('footer_logo_alt_text'));
  $str_footer_title_text = check_plain(theme_get_setting('footer_logo_title_text'));
  if (module_exists('token')) {
    $str_footer_alt_text = token_replace($str_footer_alt_text);
    $str_footer_title_text = token_replace($str_footer_title_text);
  }

  // Use uploaded image for footer logo
  if (!theme_get_setting('footer_default_logo')) {
    if (strlen($str_footer_logo_path) > 0) {
      $str_url = file_create_url($str_footer_logo_path);
      $str_return = "<img src=\"" . $str_url . "\" alt=\"" . $str_footer_alt_text . "\" />";
      if (strlen($str_footer_link_destination) > 0) {
        $str_return = l($str_return , $str_footer_link_destination, array('html' => TRUE, 'attributes' => array('title' => $str_footer_title_text,'class' => array('remove-external-link-icon'))));
      }
      else if (strlen($str_footer_link_destination) == 0) {
        $str_return = l($str_return , '<front>', array('html' => TRUE));
      }
    }
  }
  // use primary logo for footer image
  elseif (theme_get_setting('toggle_logo')) {
    if (strlen($str_return) == 0) {
      $str_logo_path = theme_get_setting('logo');
      $str_logo_alt = check_plain(theme_get_setting('primary_logo_alt_text'));
      $str_logo_title = check_plain(theme_get_setting('primary_logo_title_text'));
      if (module_exists('token')) {
        $str_logo_alt = token_replace($str_logo_alt);
        $str_logo_title = token_replace($str_logo_title);
      }
      if (strlen($str_logo_path) > 0) {
        $str_footer_logo_html = "<img src='" . file_create_url($str_logo_path) . "' alt='" . $str_logo_alt . "'/>";
        $str_footer_logo_html = l($str_footer_logo_html , '<front>', array(
          'attributes' => array('title'=> $str_logo_title),
          'html' => TRUE)
        );
        $str_return = $str_footer_logo_html;
      }
    }
  }
  // Use a text logo instead of an image.
  elseif (theme_get_setting('toggle_name')) {
    $str_site_display_name = check_plain(theme_get_setting('site_display_name'));
    if (empty($str_site_display_name)) {
      $str_site_display_name = check_plain(variable_get('site_name'));
    }
    $str_return = l('<span>'.$str_site_display_name.'</span>', $str_footer_link_destination, array(
      'html' => TRUE,
      'attributes' => array(
        'title' => $str_footer_title_text,
        'class' => array('webheader'),
        'id' => 'logo' )
      )
    );
  }
  return $str_return;
}

/**
 * Custom function for the primary logo.
 */
function ua_zen_primary_logo() {
  $str_return = "";
  $str_primary_logo_path = theme_get_setting('logo');
  $str_primary_alt_text = check_plain(theme_get_setting('primary_logo_alt_text'));
  $str_primary_title_text = check_plain(theme_get_setting('primary_logo_title_text'));
  if (module_exists('token')) {
    $str_primary_alt_text = token_replace($str_primary_alt_text);
    $str_primary_title_text = token_replace($str_primary_title_text);
  }
  # Use a logo image
  if (theme_get_setting('toggle_logo')) {
    if (strlen($str_primary_logo_path) > 0) {
      $str_url = file_create_url($str_primary_logo_path);
      $str_image = "<img src=\"" . $str_url . "\" alt=\"" . $str_primary_alt_text . "\" class='header__logo-image'/>";
      $str_return = l($str_image , '<front>', array(
        'html' => TRUE,
        'attributes' => array(
          'title' => $str_primary_title_text,
          'class' => array('header__logo'),
          'rel' => 'home',
          'id' => 'logo' )
        )
      );
    }
  }
  # Use a text logo
  elseif (theme_get_setting('toggle_name')){
    $str_site_display_name = theme_get_setting('site_display_name');
    if (empty($str_site_display_name)) {
      $str_site_display_name = check_plain(variable_get('site_name'));
    }
    $str_return = l('<span>'.$str_site_display_name.'</span>' , '<front>', array(
      'html' => TRUE,
      'attributes' => array(
        'title' => $str_primary_title_text,
        'class' => array('header__logo','webheader', 'pl-2'),
        'rel' => 'home',
        'id' => 'logo' )
      )
    );
  }
  return $str_return;
}

// http://getbootstrap.com/css/#overview-responsive-images
function ua_zen_preprocess_image_style(&$vars) {
  if(!module_exists('image_class')){
    $vars['attributes']['class'][] = 'img-responsive';
  }
}

/**
 * Implements hook_preprocess_menu_link().
 */
function ua_zen_preprocess_menu_link(&$variables, $hook) {
  // Normalize menu item classes to be an array.
  if (empty($variables['element']['#attributes']['class'])) {
    $variables['element']['#attributes']['class'] = array();
  }
  $menu_item_classes =& $variables['element']['#attributes']['class'];
  if (!is_array($menu_item_classes)) {
    $menu_item_classes = array($menu_item_classes);
  }

  // Normalize menu link classes to be an array.
  if (empty($variables['element']['#localized_options']['attributes']['class'])) {
    $variables['element']['#localized_options']['attributes']['class'] = array();
  }
  $menu_link_classes =& $variables['element']['#localized_options']['attributes']['class'];
  if (!is_array($menu_link_classes)) {
    $menu_link_classes = array($menu_link_classes);
  }

  // Add BEM-style classes to the menu item classes.
  $extra_classes = array('menu__item');
  foreach ($menu_item_classes as $key => $class) {
    switch ($class) {
      // Menu module classes.
      case 'expanded':
      case 'collapsed':
      case 'leaf':
      case 'active':
      // Menu block module classes.
      case 'active-trail':
        $extra_classes[] = 'is-' . $class;
        break;
      case 'has-children':
        $extra_classes[] = 'is-parent';
        break;
    }
  }
  $menu_item_classes = array_merge($extra_classes, $menu_item_classes);

  // Add BEM-style classes to the menu link classes.
  $extra_classes = array('menu__link');
  if (empty($menu_link_classes)) {
    $menu_link_classes = array();
  }
  else {
    foreach ($menu_link_classes as $key => $class) {
      switch ($class) {
        case 'active':
        case 'active-trail':
          $extra_classes[] = 'is-' . $class;
          break;
      }
    }
  }
  $menu_link_classes = array_merge($extra_classes, $menu_link_classes);
}

/**
 * Returns HTML for status and/or error messages, grouped by type.
 *
 * An invisible heading identifies the messages for assistive technology.
 * Sighted users see a colored box. See http://www.w3.org/TR/WCAG-TECHS/H69.html
 * for info.
 *
 * @param array $variables
 *   An associative array containing:
 *   - display: (optional) Set to 'status' or 'error' to display only messages
 *     of that type.
 *
 * @return string
 *   The constructed HTML.
 *
 * @see theme_status_messages()
 *
 * @ingroup theme_functions
 */

function ua_zen_status_messages($variables) {
  $display = $variables['display'];
  $output = '';

  $status_heading = array(
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
    'info' => t('Informative message'),
  );

  // Map Drupal message types to their corresponding Bootstrap classes.
  // @see http://twitter.github.com/bootstrap/components.html#alerts
  $status_class = array(
    'status' => 'success',
    'error' => 'danger',
    'warning' => 'warning',
    // Not supported, but in theory a module could send any type of message.
    // @see drupal_set_message()
    // @see theme_status_messages()
    'info' => 'info',
  );

  foreach (drupal_get_messages($display) as $type => $messages) {
    $class = (isset($status_class[$type])) ? ' alert-' . $status_class[$type] : '';
    $output .= "<div class=\"alert alert-block$class messages $type\" role=\"alertdialog\" aria-labelledby=\"$status_class[$type]-label\" aria-describedby=\"$status_class[$type]-description\">\n";
    $output .= "  <span class=\"sr-only\" aria-hidden=\"true\"></span>\n";
    $output .= "  <a class=\"close\" data-dismiss=\"alert\" href=\"#\" aria-hidden=\"true\"><i class=\"ua-brand-x\" aria-hidden=\"true\"></i></a>\n";

    if (!empty($status_heading[$type])) {
        $output .= "<h4 aria-hidden=\"true\" class=\"sr-only\" id=\"$status_class[$type]-label\">$status_heading[$type]</h4>\n";
    }

    if (count($messages) > 1) {
      $output .= " <ul id=\"$status_class[$type]-description\">\n";
      foreach ($messages as $message) {
        $has_link = strstr($message, 'href');
        if ($has_link){
            $message = str_replace('href=', 'class="alert-link" href=', $message);
        }
        $output .= "  <li role=\"alert\">$message</li>\n";
      }
      $output .= " </ul>\n";
    }
    else {
        $has_link = strstr($messages[0], 'href');
        if ($has_link){
            $messages[0] = str_replace('href', 'class="alert-link" href', $messages[0]);
        }
        $output .= "<span id=\"$status_class[$type]-description\" role=\"alert\">$messages[0]</span>";
        }

    $output .= "</div>\n";
  }
  return $output;
}

/**
 * Returns HTML for a marker for new or updated content.
 */
function ua_zen_mark($variables) {
  $type = $variables['type'];

  if ($type == MARK_NEW) {
    return ' <mark class="new">' . t('new') . '</mark>';
  }
  elseif ($type == MARK_UPDATED) {
    return ' <mark class="updated">' . t('updated') . '</mark>';
  }
}

/**
 * Implement hook_html_head_alter().
 */
function ua_zen_html_head_alter(&$head) {
  // Simplify the meta tag for character encoding.
  if (isset($head['system_meta_content_type']['#attributes']['content'])) {
    $head['system_meta_content_type']['#attributes'] = array('charset' => str_replace('text/html; charset=', '', $head['system_meta_content_type']['#attributes']['content']));
  }
}

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
function ua_zen_preprocess_maintenance_page(&$variables, $hook) {
  ua_zen_preprocess_html($variables, $hook);
  // There's nothing maintenance-related in ua_zen_preprocess_page(). Yet.
  //ua_zen_preprocess_page($variables, $hook);
}

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
function ua_zen_process_maintenance_page(&$variables, $hook) {
  ua_zen_process_html($variables, $hook);
  // Ensure default regions get a variable. Theme authors often forget to remove
  // a deleted region's variable in maintenance-page.tpl.
  foreach (array('header', 'navigation', 'highlighted', 'help', 'content', 'sidebar_first', 'sidebar_second', 'footer', 'bottom') as $region) {
    if (!isset($variables[$region])) {
      $variables[$region] = '';
    }
  }
}

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
function ua_zen_preprocess_html(&$variables, $hook) {
  // Original Zen Theme generic setup....
  // Add variables and paths needed for HTML5 and responsive support.
  $variables['base_path'] = base_path();
  $variables['path_to_zen'] = drupal_get_path('theme', 'ua_zen');
  // Get settings for HTML5 and responsive support. array_filter() removes
  // items from the array that have been disabled.
  $html5_respond_meta = array_filter((array) theme_get_setting('zen_html5_respond_meta'));
  $variables['add_respond_js']          = in_array('respond', $html5_respond_meta);
  $variables['add_html5_shim']          = in_array('html5', $html5_respond_meta);
  $variables['default_mobile_metatags'] = in_array('meta', $html5_respond_meta);

  // Attributes for html element.
  $variables['html_attributes_array'] = array(
    'lang' => $variables['language']->language,
    'dir' => $variables['language']->dir,
  );

  // Send X-UA-Compatible HTTP header to force IE to use the most recent
  // rendering engine.
  // This also prevents the IE compatibility mode button to appear when using
  // conditional classes on the html tag.
  if (is_null(drupal_get_http_header('X-UA-Compatible'))) {
    drupal_add_http_header('X-UA-Compatible', 'IE=edge');
  }

  $variables['skip_link_anchor'] = check_plain(theme_get_setting('zen_skip_link_anchor'));
  $variables['skip_link_text']   = check_plain(theme_get_setting('zen_skip_link_text'));

  // Return early, so the maintenance page does not call any of the code below.
  if ($hook != 'html') {
    return;
  }

  // Serialize RDF Namespaces into an RDFa 1.1 prefix attribute.
  if ($variables['rdf_namespaces']) {
    $prefixes = array();
    foreach (explode("\n  ", ltrim($variables['rdf_namespaces'])) as $namespace) {
      // Remove xlmns: and ending quote and fix prefix formatting.
      $prefixes[] = str_replace('="', ': ', substr($namespace, 6, -1));
    }
    $variables['rdf_namespaces'] = ' prefix="' . implode(' ', $prefixes) . '"';
  }

  // Classes for body element. Allows advanced theming based on context
  // (home page, node of certain type, etc.)
  if (!$variables['is_front']) {
    // Add unique class for each page.
    $path = drupal_get_path_alias($_GET['q']);
    // Add unique class for each website section.
    list($section, ) = explode('/', $path, 2);
    $arg = explode('/', $_GET['q']);
    if ($arg[0] == 'node' && isset($arg[1])) {
      if ($arg[1] == 'add') {
        $section = 'node-add';
      }
      elseif (isset($arg[2]) && is_numeric($arg[1]) && ($arg[2] == 'edit' || $arg[2] == 'delete')) {
        $section = 'node-' . $arg[2];
      }
    }
    $variables['classes_array'][] = drupal_html_class('section-' . $section);
  }
  if (theme_get_setting('zen_wireframes')) {
    $variables['classes_array'][] = 'with-wireframes'; // Optionally add the wireframes style.
  }
  // Store the menu item since it has some useful information.
  $variables['menu_item'] = menu_get_item();
  if ($variables['menu_item']) {
    switch ($variables['menu_item']['page_callback']) {
      case 'views_page':
        // Is this a Views page?
        $variables['classes_array'][] = 'page-views';
        break;
      case 'page_manager_blog':
      case 'page_manager_blog_user':
      case 'page_manager_contact_site':
      case 'page_manager_contact_user':
      case 'page_manager_node_add':
      case 'page_manager_node_edit':
      case 'page_manager_node_view_page':
      case 'page_manager_page_execute':
      case 'page_manager_poll':
      case 'page_manager_search_page':
      case 'page_manager_term_view_page':
      case 'page_manager_user_edit_page':
      case 'page_manager_user_view_page':
        // Is this a Panels page?
        $variables['classes_array'][] = 'page-panels';
        break;
    }
  }
  // UA Zen specifics....
  // Add itemtype code for Google+ in the 'html_attributes_array' which is only
  // available in Zen theme. Note Zen will convert rdf_namespaces to RDFa 1.1 with
  // prefix, so putting itemtype there will cause it to be added to the
  // prefix="itemtype=..." attribute.
  if (module_exists('metatag_google_plus') && isset($variables['itemtype'])) {
    $variables['html_attributes_array']['itemscope itemtype'] = "http://schema.org/{$variables['itemtype']}";
  }

  if (theme_get_setting('sticky_footer') == TRUE) {
    $variables['html_classes_array'][] = 'sticky-footer';
  }
  if (theme_get_setting('external_links') == TRUE) {
    $variables['html_classes_array'][] = 'external-links';
  }
  if (theme_get_setting('ua_brand_icons_class') == TRUE) {
    $variables['html_classes_array'][] = 'ua-brand-icons';
  }
  if (theme_get_setting('ua_zen_bs_overlay_menu_scroll')) {
    $variables['html_classes_array'][]= 'overlay-menu-scroll-hide';
  }
  $variables['html_classes'] = '';
  if (isset($variables['html_classes_array'])) {
    $variables['html_classes'] = implode(' ', $variables['html_classes_array']);
  }
}

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
function ua_zen_process_html(&$variables, $hook) {
  // Flatten out html_attributes.
  $variables['html_attributes'] = drupal_attributes($variables['html_attributes_array']);
}

/**
 * Override or insert variables in the html_tag theme function.
 */
function ua_zen_process_html_tag(&$variables) {
  $tag = &$variables['element'];

  if ($tag['#tag'] == 'style' || $tag['#tag'] == 'script') {
    // Remove redundant CDATA comments.
    unset($tag['#value_prefix'], $tag['#value_suffix']);

    // Remove redundant type attribute; don't remove the JSON-LD indicator. https://www.drupal.org/project/zen/issues/2934644
    if (isset($tag['#attributes']['type'])) {
      if ($tag['#attributes']['type'] !== 'text/ng-template'
          && $tag['#attributes']['type'] !== 'application/ld+json') {
        unset($tag['#attributes']['type']);
      }
    }

    // Remove media="all" but leave others unaffected.
    if (isset($tag['#attributes']['media']) && $tag['#attributes']['media'] === 'all') {
      unset($tag['#attributes']['media']);
    }
  }
}

/**
 * Override or insert variables into the page templates.
 *
 * @param array $variables
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("page" in this case.)
 */
function ua_zen_preprocess_page(&$variables, $hook) {
  // Original Zen Theme generic setup....
  // Find the title of the menu used by the secondary links.
  $secondary_links = variable_get('menu_secondary_links_source', 'user-menu');
  if ($secondary_links) {
    $menus = function_exists('menu_get_menus') ? menu_get_menus() : menu_list_system_menus();
    $variables['secondary_menu_heading'] = isset($menus[$secondary_links]) ? $menus[$secondary_links] : '';
  }
  else {
    $variables['secondary_menu_heading'] = '';
  }
  // UA Zen specifics....
  // Set the has-local-menu-tasks on the #main div if the local menu tasks
  // appear on the page.
  if (isset($variables['tabs']) && !empty($variables['tabs']['#primary'])) {
    $variables['classes_array'][] = 'has-local-menu-tasks';
  }

  // Add margin bottom for content types that contain webforms and all content types that are not flexible pages.
  if (isset($variables['node'])) {
    if (isset($variables['node']->webform)) {
      if (isset($variables['node']->webform['nid'])) {
        $variables['classes_array'][] = 'mb-4';
      }
    }
    elseif (isset($variables['node']->type)) {
      if ($variables['node']->type !== 'uaqs_flexible_page') {
        $variables['classes_array'][] = 'mb-4';
      }
    }
  }

  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = 'col-sm-6 col-sm-push-3';
  }
  elseif (!empty($variables['page']['sidebar_first']) && empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = 'col-sm-9 col-sm-push-3';
  }
  elseif (empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = 'col-sm-9';
  }
  else {
    $variables['content_column_class'] = 'col-sm-12';
  }

  // Allows there to be a template file for the UA Header and Footers without
  // allowing blocks to be placed there - regions defined in .info, but
  // commented out.
  if (!isset($variables['page']['header_ua']) || empty($variables['page']['header_ua'])) {
    $variables['page']['header_ua'] = array(
      '#region' => 'header_ua',
      '#weight' => '-10',
      '#theme_wrappers' => array('region'));
  }

  if (!isset($variables['page']['footer']) || empty($variables['page']['footer'])) {
    $variables['page']['footer'] = array(
      '#region' => 'footer',
      '#weight' => '-10',
      '#theme_wrappers' => array('region'));
  }

  // Force sub footer to be rendered.
  if (!isset($variables['page']['footer_sub']) || empty($variables['page']['footer_sub'])) {
    $variables['page']['footer_sub'] = array(
      '#region' => 'footer_sub',
      '#weight' => '-10',
      '#theme_wrappers' => array('region'));
  }

  // Primary nav.
  $variables['primary_nav'] = FALSE;
  if ($variables['main_menu']) {
    $menu_name = variable_get('menu_main_links_source', 'main-menu');
    // If Superfish module is available, render primary nav as Superfish menu.
    if (theme_get_setting('ua_zen_main_menu_style') == 'superfish' && module_exists('uaqs_navigation') && module_exists('superfish')) {
      $variables['primary_nav'] = array(
        '#prefix' => '<div id="navbar">',
        '#suffix' => '</div>',
        'superfish' => uaqs_navigation_sf_nav($menu_name),
      );
    }
    else {
      // Render the primary nav as a Bootstrap dropdown.
      // TODO: Do this in a less hacky way?
      $navbar_header_markup = '<div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="text">MAIN MENU</span>
             </button>
          </div>';
      $navbar_header = array(
        '#markup' => $navbar_header_markup,
      );
      $variables['primary_nav'] = array(
        'navbar_header' => $navbar_header,
        'navbar' => array(
          '#prefix' => '<div id="navbar" class="navbar-collapse collapse">',
          '#suffix' => '</div>',
          'menu' => ua_zen_build_menu_tree($menu_name),
        ),
      );
      $variables['primary_nav']['navbar']['menu']['#theme_wrappers'] = array('menu_tree__primary');
      if (theme_get_setting('ua_zen_bs_overlay_menu_scroll')) {
        $navbar_header_markup = '<div class="navbar-header overlay-menu-scroll-toggle">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-parent="#main_nav" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="text">MAIN MENU</span>
                 <span class="hamburger">Open Navigation</span>
               </button>
            </div>';
        $navbar_header = array(
          '#markup' => $navbar_header_markup,
        );
        $variables['primary_nav']['navbar_header'] = $navbar_header;
        $variables['primary_nav']['navbar']['#prefix'] = '<div id="navbar" class="overlay-menu-scroll" role="navigation" aria-expanded="false"><div class="navbar-scroller">';
        $variables['primary_nav']['navbar']['#suffix'] = '</div></div>';
        $variables['primary_nav']['#attached'] = array(
          'css' => array(
            drupal_get_path('theme', 'ua_zen') . '/css/uaqs_navigation_overlay_menu_scroll.css' => array(
              'group' => CSS_THEME,
              'weight' => 115
            )
          ),
          'js' => array(
            array(
              'data' => drupal_get_path('theme', 'ua_zen') . '/js/uaqs_navigation_overlay_menu_scroll.js',
              'type' => 'file',
              'scope' => 'footer',
              'group' => JS_THEME,
            ),
          ),
        );
        if (theme_get_setting('ua_zen_bs_dropdown_direction') == 'js') {
          $variables['primary_nav']['#attached']['js'][] = array(
            'data' => drupal_get_path('theme', 'ua_zen') . '/js/uaqs_navigation_dropdown_direction.js',
            'type' => 'file',
            'scope' => 'footer',
            'group' => JS_THEME,
          );
        }
      }
    }
  }

  // Allow hiding of title of front page node
  if (theme_get_setting('ua_zen_hide_front_title') == 1 && drupal_is_front_page()){
    $variables['title'] = FALSE;
  }

  // Add title and alt text to logo.
  $variables['logo'] = ua_zen_primary_logo();

  // Back to top settings.
  if (theme_get_setting('ua_zen_back_to_top') == TRUE) {
    $button_value = array(
      'sr-span' => array(
        '#type' => 'html_tag',
        '#tag' => 'span',
        '#attributes' => array('class' => 'sr-only'),
        '#value' => t('Return to the top of this page.'),
      ),
      'icon' => array(
        '#type' => 'html_tag',
        '#tag' => 'i',
        '#attributes' => array('class' => 'ua-brand-up-arrow'),
        '#value' => '',
      ),
    );
    $button_classes = array('ua-zen-back-to-top', 'btn', 'btn-primary');
    $variables['ua_zen_back_to_top'] = array(
      '#type' => 'html_tag',
      '#tag' => 'button',
      '#value' => drupal_render_children($button_value),
      '#attributes' => array(
        'id' => 'js-ua-zen-back-to-top',
        'role' => 'button',
        'aria-label' => 'Return to the top of this page.',
        'class' => implode(' ', $button_classes),
      ),
      '#attached' => array(
        'css' => array(
          drupal_get_path('theme', 'ua_zen') . '/css/ua_zen_back_to_top.css',
        ),
        'js' => array(
          array(
            'data' => drupal_get_path('theme', 'ua_zen') . '/js/ua_zen_back_to_top.js',
            'type' => 'file',
            'scope' => 'footer',
            'group' => JS_THEME,
          ),
        ),
      ),
    );
  }
}

/**
 * Override or insert variables into the node templates.
 *
 * @param array $variables
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("node" in this case.)
 */
function ua_zen_preprocess_node(&$variables, $hook) {
  // Add $unpublished variable.
  $variables['unpublished'] = (!$variables['status']) ? TRUE : FALSE;

  // Set preview variable to FALSE if it doesn't exist.
  $variables['preview'] = isset($variables['preview']) ? $variables['preview'] : FALSE;

  // Add pubdate to submitted variable.
  $variables['pubdate'] = '<time pubdate datetime="' . format_date($variables['node']->created, 'custom', 'c') . '">' . $variables['date'] . '</time>';
  if ($variables['display_submitted']) {
    $variables['submitted'] = t('Submitted by !username on !datetime', array('!username' => $variables['name'], '!datetime' => $variables['pubdate']));
  }

  // Add a class for the view mode.
  if (!$variables['teaser']) {
    $variables['classes_array'][] = 'view-mode-' . $variables['view_mode'];
  }

  // Add a class to show node is authored by current user.
  if ($variables['uid'] && $variables['uid'] == $GLOBALS['user']->uid) {
    $variables['classes_array'][] = 'node-by-viewer';
  }

  $variables['title_attributes_array']['class'][] = 'node__title';
  $variables['title_attributes_array']['class'][] = 'node-title';
}

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
function ua_zen_preprocess_comment(&$variables, $hook) {
  // If comment subjects are disabled, don't display them.
  if (variable_get('comment_subject_field_' . $variables['node']->type, 1) == 0) {
    $variables['title'] = '';
  }

  // Add pubdate to submitted variable.
  $variables['pubdate'] = '<time pubdate datetime="' . format_date($variables['comment']->created, 'custom', 'c') . '">' . $variables['created'] . '</time>';
  $variables['submitted'] = t('!username replied on !datetime', array('!username' => $variables['author'], '!datetime' => $variables['pubdate']));

  // Zebra striping.
  if ($variables['id'] == 1) {
    $variables['classes_array'][] = 'first';
  }
  if ($variables['id'] == $variables['node']->comment_count) {
    $variables['classes_array'][] = 'last';
  }
  $variables['classes_array'][] = $variables['zebra'];

  $variables['title_attributes_array']['class'][] = 'comment__title';
  $variables['title_attributes_array']['class'][] = 'comment-title';
}

/**
 * Override or insert variables into the region templates.
 *
 * @param array $variables
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("region" in this case.)
 */
function ua_zen_preprocess_region(&$variables, $hook) {
  // Original Zen Theme generic setup....
  // Sidebar regions get some extra classes and a common template suggestion.
  if (strpos($variables['region'], 'sidebar_') === 0) {
    $variables['classes_array'][] = 'column';
    $variables['classes_array'][] = 'sidebar';
    // Allow a region-specific template to override Zen's region--sidebar.
    array_unshift($variables['theme_hook_suggestions'], 'region__sidebar');
  }
  // Use a template with no wrapper for the content region.
  elseif ($variables['region'] == 'content') {
    // Allow a region-specific template to override Zen's region--no-wrapper.
    array_unshift($variables['theme_hook_suggestions'], 'region__no_wrapper');
  }
  // Add a SMACSS-style class for header region.
  elseif ($variables['region'] == 'header') {
    array_unshift($variables['classes_array'], 'header__region');
  }
  // UA Zen specifics....
  $str_footer_logo_html = "";
  $str_logo_path = "";
  $str_info_security_privacy = "";
  $str_copyright_notice = "";
  switch ($variables['region']) {
    case "footer":
      $str_footer_logo_html = ua_zen_footer_logo();
      break;

    case "footer_sub":
      $display_info_security_privacy = theme_get_setting('info_security_privacy');
      if ($display_info_security_privacy) {
        $str_info_security_privacy = "<p class=\"small\"><a href=\"https://www.arizona.edu/information-security-privacy\" target=\"_blank\">University Information Security and Privacy</a></p>";
      }
      $str_copyright_notice = theme_get_setting('ua_copyright_notice');
      if (strlen($str_copyright_notice) > 0) {
        $str_copyright_notice = "<p class=\"copyright small\">&copy; " . date('Y') . " " . $str_copyright_notice . "</p>";
      }
      else {
        $str_copyright_notice = "<p class=\"copyright small\">&copy; " . date('Y') . " The Arizona Board of Regents on behalf of <a href=\"https://www.arizona.edu\" target=\"_blank\">The University of Arizona</a>.</p>";
      }
  }

  $variables['info_security_privacy'] = $str_info_security_privacy;
  $variables['copyright_notice'] = $str_copyright_notice;
  $variables['footer_logo'] = $str_footer_logo_html;
  // Allow wordmark to be disabled
  if (theme_get_setting('wordmark') == 0) {
    $variables['wordmark'] = FALSE;
  }
  else {
    $variables['wordmark'] = TRUE;
  }
}

/**
 * Override or insert variables into the block templates.
 *
 * @param array $variables
 *   An array of variables to pass to the theme template.
 * @param string $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function ua_zen_preprocess_block(&$variables, $hook) {
  // Original Zen Theme generic setup....
  // Use a template with no wrapper for the page's main content.
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'][] = 'block__no_wrapper';
  }

  // Classes describing the position of the block within the region.
  if ($variables['block_id'] == 1) {
    $variables['classes_array'][] = 'first';
  }
  // The last_in_region property is set in ua_zen_page_alter().
  if (isset($variables['block']->last_in_region)) {
    $variables['classes_array'][] = 'last';
  }
  $variables['classes_array'][] = $variables['block_zebra'];

  $variables['title_attributes_array']['class'][] = 'block__title';
  $variables['title_attributes_array']['class'][] = 'block-title';

  // Add Aria Roles via attributes.
  switch ($variables['block']->module) {
    case 'system':
      switch ($variables['block']->delta) {
        case 'main':
          // Note: the "main" role goes in the page.tpl, not here.
          break;
        case 'help':
        case 'powered-by':
          $variables['attributes_array']['role'] = 'complementary';
          break;
        default:
          // Any other "system" block is a menu block.
          $variables['attributes_array']['role'] = 'navigation';
          break;
      }
      break;
    case 'menu':
    case 'menu_block':
    case 'blog':
    case 'book':
    case 'comment':
    case 'forum':
    case 'shortcut':
    case 'statistics':
      $variables['attributes_array']['role'] = 'navigation';
      break;
    case 'search':
      $variables['attributes_array']['role'] = 'search';
      break;
    case 'help':
    case 'aggregator':
    case 'locale':
    case 'poll':
    case 'profile':
      $variables['attributes_array']['role'] = 'complementary';
      break;
    case 'node':
      switch ($variables['block']->delta) {
        case 'syndicate':
          $variables['attributes_array']['role'] = 'complementary';
          break;
        case 'recent':
          $variables['attributes_array']['role'] = 'navigation';
          break;
      }
      break;
    case 'user':
      switch ($variables['block']->delta) {
        case 'login':
          $variables['attributes_array']['role'] = 'form';
          break;
        case 'new':
        case 'online':
          $variables['attributes_array']['role'] = 'complementary';
          break;
      }
      break;
  }

  // UA Zen specifics....
  if (isset($variables['title_attributes_array'])) {
    $variables['title_attributes_array']['class'][] = 'h3 mt-4';
  }
  if (!empty($variables['block']->subject)) {
    $variables['block']->subject = $variables['block']->subject;
  }
  if ($variables['block_html_id'] == 'block-menu-block-uaqs-second-level') {
    $variables['attributes_array']['aria-label'] = 'secondary';
  }
}

/**
 * Implements hook_block_view_alter().
 *
 * Applies menu_tree__stacked_pills theme wrapper to sidebar menu blocks.
 */
function ua_zen_block_view_alter(&$data, $block) {
  // Adds custom theme wrapper to all menu_block blocks in sidebar regions.
  if (strpos($block->region, 'sidebar') === 0) {
    switch($block->module) {
      case 'menu_block':
        if (isset($data['content']['#content']) && !empty($data['content']['#content'])) {
          $data['content']['#content'] = ua_zen_add_menu_block_wrappers(
            $data['content']['#content'],
            'menu_tree__stacked_pills'
          );
        }
      case 'system':
      case 'menu':
      case 'bean':
        // Do not alter custom UAQS audience or resources menu beans.
        $special_beans = array(
          'uaqs-audience-select',
          'uaqs-resources-bean',
        );
        if (in_array($block->delta, $special_beans)) {
          return;
        }
        if (isset($data['content']) && !empty($data['content']) &&
          isset($data['content']['#theme_wrappers']) &&
          preg_grep("/^menu_tree.*/", $data['content']['#theme_wrappers']))
        {
          $data['content'] = ua_zen_add_menu_block_wrappers(
            $data['content'],
            'menu_tree__stacked_pills'
          );
        }
    }
  }
}

/**
 * Implements hook_ENTITY_TYPE_embed_alter().
 *
 * Applies menu_tree__stacked_pills theme wrapper to embedded menu beans.
 */
function ua_zen_bean_embed_alter(&$build, $entity, array &$context) {
  if ($entity->type === 'menu_bean') {
    $build['bean'][$entity->delta] = ua_zen_add_menu_block_wrappers(
      $build['bean'][$entity->delta],
      'menu_tree__stacked_pills'
    );
  }
}

/**
 * Helper function for adding a theme wrapper to menu blocks.
 *
 * Recursively prepends the specified theme wrapper to all levels of a menu_tree
 * render array that has already been processed by the menu_block module.
 *
 * @param array $content
 *   A render array created by menu_tree_output() or menu_block_tree_output().
 * @param string $wrapper
 *   The theme wrapper.
 *
 * @see menu_tree_output()
 * @see menu_block_tree_output()
 */
function ua_zen_add_menu_block_wrappers(array $content, $wrapper) {
  if (isset($content['#theme_wrappers'])) {
    // Add wrapper to list of theme_wrappers (for menu_block module).
    if (is_array($content['#theme_wrappers'][0])) {
      array_unshift($content['#theme_wrappers'][0], $wrapper);
    }
    // Replace existing theme_wrapper (for core / menu_bean module).
    else {
      unset($content['#theme_wrappers']);
      $content['#theme_wrappers'] = array($wrapper);
    }
  }
  foreach($content as $key => $data) {
    if (isset($data['#below']) && !empty($data['#below'])) {
      $content[$key]['#below'] = ua_zen_add_menu_block_wrappers($data['#below'], $wrapper);
    }
  }
  return $content;
}

/**
 * Implements theme_form_search_block_form_alter.
 */
function ua_zen_form_search_block_form_alter(&$form, &$form_state, $form_id) {
  $form['search_block_form']['#attributes']['placeholder'] = t('Search Site');
  $form['search_block_form']['#attributes']['class'][] = 'input-search';
  $form['search_block_form']['#attributes']['onfocus'] = "this.placeholder = ''";
  $form['search_block_form']['#attributes']['onblur'] = "this.placeholder = '" . t('Search Site') . "'";
}

/**
 * Override or insert variables into the search result page template.
 */
function ua_zen_preprocess_search_result(&$variables) {
  $variables['info'] = '';
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $variables
 *   - title: An optional string to be used as a navigational heading to give
 *     context for breadcrumb links to screen-reader users.
 *   - title_attributes_array: Array of HTML attributes for the title. It is
 *     flattened into a string within the theme function.
 *   - breadcrumb: An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function ua_zen_preprocess_breadcrumb(&$variables) {
  $breadcrumb = &$variables['breadcrumb'];

  // Optionally get rid of the homepage link.
  $show_breadcrumb_home = theme_get_setting('zen_breadcrumb_home');
  if (!$show_breadcrumb_home) {
    array_shift($breadcrumb);
  }

  if (theme_get_setting('zen_breadcrumb_title') && !empty($breadcrumb)) {
    $item = menu_get_item();
    $breadcrumb[] = array(
      // If we are on a non-default tab, use the tab's title.
      'data' => !empty($item['tab_parent']) ? check_plain($item['title']) : drupal_get_title(),
      'class' => array('active'),
    );
  }
}

function ua_zen_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  $output = '';

  // Determine if we are to display the breadcrumb.
  $show_breadcrumb = theme_get_setting('zen_breadcrumb');
  if ($show_breadcrumb == 'yes' || $show_breadcrumb == 'admin' && arg(0) == 'admin') {
    $output = theme('item_list', array(
      'attributes' => array(
        'class' => array('breadcrumb'),
      ),
      'items' => $breadcrumb,
      'type' => 'ol',
    ));
  }
  return $output;
}

/**
 * Overrides theme_menu_local_tasks().
 */
function ua_zen_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="sr-only">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs--primary nav nav-tabs">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }

  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="sr-only">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs--secondary pagination pagination-sm">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
}

/**
 * Returns HTML for a single local task link.
 */
function ua_zen_menu_local_task($variables) {
  $type = $class = FALSE;

  $link = $variables['element']['#link'];
  $link_text = $link['title'];

  // Check for tab type set in ua_zen_menu_local_tasks().
  if (is_array($variables['element']['#theme'])) {
    $type = in_array('menu_local_task__secondary', $variables['element']['#theme']) ? 'tabs-secondary' : 'tabs-primary';
  }

  // Add SMACSS-style class names.
  if ($type) {
    $link['localized_options']['attributes']['class'][] = $type . '__tab-link';
    $class = $type . '__tab';
  }

  if (!empty($variables['element']['#active'])) {
    // Add text to indicate active tab for non-visual users.
    $active = ' <span class="element-invisible">' . t('(active tab)') . '</span>';

    // If the link does not contain HTML already, check_plain() it now.
    // After we set 'html'=TRUE the link will not be sanitized by l().
    if (empty($link['localized_options']['html'])) {
      $link['title'] = check_plain($link['title']);
    }
    $link['localized_options']['html'] = TRUE;
    $link_text = t('!local-task-title!active', array('!local-task-title' => $link['title'], '!active' => $active));

    if (!$type) {
      $class = 'active';
    }
    else {
      $link['localized_options']['attributes']['class'][] = 'is-active';
      $class .= ' is-active';
    }
  }

  return '<li' . ($class ? ' class="' . $class . '"' : '') . '>' . l($link_text, $link['href'], $link['localized_options']) . "</li>\n";
}

/**
 *  Theme wrapper function for the uaqs_second_level menu block.
 */
function ua_zen_menu_tree__menu_block__uaqs_second_level(array $variables) {
  return ua_zen_menu_tree__stacked_pills($variables);
}

/**
 *  Theme wrapper function for theme_menu_tree().
 */
function ua_zen_menu_tree__stacked_pills(array $variables) {
  $output = '<ul class="nav nav-pills nav-stacked">' . $variables['tree'] . '</ul>';

  return $output;
}

/**
 *  Theme wrapper function for the primary menu links.
 */
function ua_zen_menu_tree__primary(&$variables) {
      return '<ul class="menu nav navbar-nav">' . $variables['tree'] . '</ul><div class="clearfix"></div>';
}

/**
 *  Theme wrapper function for the header resources menu.
 */
function ua_zen_menu_tree__uaqs_header_resources(array $variables) {
  if ($variables['#tree']['#block']->delta == 'uaqs-resources-bean') {
    $js['#attached']['js'][] = drupal_get_path('module', 'uaqs_navigation_resources') . '/js/uaqs_navigation_resources.js';
    drupal_render($js);
  }
  return '<ul class="dropdown-menu dropdown-menu-right">' . $variables['tree'] . '</ul>';
}

/**
 * Modified version of core menu_tree() function for primary menu.
 *
 * Renders a menu tree based on the current path using our custom
 * menu_link__primary theme hook for menu links.
 *
 * @param $menu_name
 *   The name of the menu.
 *
 * @return
 *   A structured array representing the specified menu on the current page, to
 *   be rendered by drupal_render().
 *
 * @see menu_tree()
 */
function ua_zen_build_menu_tree($menu_name) {
  $menu_output =& drupal_static(__FUNCTION__, array());
  if (!isset($menu_output[$menu_name])) {
    $tree = menu_tree_page_data($menu_name);

    // Replace theme hook for menu links with our custom one.
    $menu_output[$menu_name] = array_map(function($item) {
      if (is_array($item)) {
        $item = ua_zen_change_menu_link_theme($item, 'menu_link__primary');
      }
      return $item;
    }, menu_tree_output($tree));
  }
  return $menu_output[$menu_name];
}

/**
 * Helper function for modifying theme hook of menu links.
 *
 * Recursively changes a menu link's theme hook to the specified one.
 *
 * @param array $item
 *   The render array for an individual menu link generated by menu_tree_output.
 * @param string $hook
 *   The theme hook/function to apply.
 */
function ua_zen_change_menu_link_theme(array $item, $hook) {
  if (isset($item['#theme'])) {
    $item['#theme'] = $hook;
  }
  if (isset($item['#below']) && !empty($item['#below'])) {
    foreach($item['#below'] as $key => $data) {
      if (is_array($data)) {
        $item['#below'][$key] = ua_zen_change_menu_link_theme($data, $hook);
      }
    }
  }
  return $item;
}

/**
 * Overrides theme_menu_link().
 */
function ua_zen_menu_link(array $variables) {
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  $element = $variables['element'];
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $variables['element']['#attributes']['class'][] = 'active';
  }

  return theme_menu_link($variables);
}

/**
 * Overrides theme_menu_link().
 *
 * Returns HTML for a menu link and submenu in the primary navigation menu using
 * Bootstrap dropdowns.
 */
function ua_zen_menu_link__primary(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';
  $dropdown_menu_right = '';

  if (($element['#original_link']['depth'] <= 1)) {
    $element['#localized_options']['attributes']['class'][] = 'text-uppercase';
  }
  if ($element['#below']) {
    if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      if (theme_get_setting('ua_zen_bs_dropdown_direction') == 'last') {
        $dropdown_menu_right = (in_array('last', $element['#attributes']['class'])) ? ' dropdown-menu-right' : '';
      }
      $sub_menu = '<ul class="dropdown-menu' . $dropdown_menu_right . '">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#title'] .= ' <span class="caret"></span>';
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      $element['#localized_options']['attributes']['data-target'] = '#';
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      if ($element['#href'] === '<nolink>') {
        $element['#localized_options']['attributes']['role'] = 'button';
      }
      $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
      $element['#localized_options']['attributes']['aria-haspopup'] = 'true';
      $element['#localized_options']['attributes']['aria-expanded'] = 'false';
    }
  }
  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Overrides theme_menu_link().
 *
 * Restores default behavior for menu blocks.
 *
 * @see https://www.drupal.org/node/1850194
 */
function ua_zen_menu_link__menu_block($variables) {
  return theme_menu_link($variables);
}

/**
 * Overrides theme_menu_link().
 *
 * Returns HTML for a menu link and submenu in footer resources menu decorated
 * with UA Brand icons.
 */
function ua_zen_menu_link__uaqs_footer_resources(array $variables) {
  $prefix = FALSE;
  $path = $variables['element']['#original_link']['link_path'];
  $icon_path_patterns = array(
    '/^(?:https?:\/\/)?(?:www\.)?arizona\.edu\/weather$/' => 'weather',
    '/^(?:https?:\/\/)?(?:www\.)?uanews\.org$/' => 'news',
    '/^(?:https?:\/\/)?(?:www\.)?uanews\.arizona\.edu$/' => 'news',
    '/^(?:https?:\/\/)?(?:www\.)?news\.arizona\.edu$/' => 'news',
    '/^(?:https?:\/\/)?(?:www\.)?directory\.arizona\.edu.*/' => 'directory',
    '/^(?:https?:\/\/)?(?:www\.)?map\.arizona\.edu$/' => 'campus-map',
    '/^(?:https?:\/\/)?(?:www\.)?arizona\.edu\/calendars-events$/' => 'calendar'
  );
  foreach ($icon_path_patterns as $pattern => $icon_class) {
    if (preg_match($pattern, $path)) {
      $prefix = '<i class="ua-brand-'.$icon_class.'"></i>';
    }
  }
  if ($prefix) {
    $variables['element']['#localized_options']['html'] = TRUE;
    $variables['element']['#title'] = $prefix . $variables['element']['#title'];
  }

  return ua_zen_menu_link($variables);
}

/**
 * Returns HTML for a query pager.
 *
 * Menu callbacks that display paged query results should call theme('pager') to
 * retrieve a pager control so that users can view other results. Format a list
 * of nearby pages with additional query results.
 *
 * @param array $variables
 *   An associative array containing:
 *   - tags: An array of labels for the controls in the pager.
 *   - element: An optional integer to distinguish between multiple pagers on
 *     one page.
 *   - parameters: An associative array of query string parameters to append to
 *     the pager links.
 *   - quantity: The number of pages in the list.
 *
 * @return string
 *   The constructed HTML.
 *
 * @see theme_pager()
 *
 * @ingroup theme_functions
 */
function ua_zen_pager($variables) {
  $output = "";
  $items = array();
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];

  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // Current is the page we are currently paged to.
  $pager_current = $pager_page_array[$element] + 1;
  // First is the first page listed by this pager piece (re quantity).
  $pager_first = $pager_current - $pager_middle + 1;
  // Last is the last page listed by this pager piece (re quantity).
  $pager_last = $pager_current + $quantity - $pager_middle;
  // Max is the maximum page number.
  $pager_max = $pager_total[$element];

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }

  // End of generation loop preparation.
  $li_first = theme('pager_first', array(
    'text' => (isset($tags[0]) ? $tags[0] : t('first')),
    'element' => $element,
    'parameters' => $parameters,
  ));
  $li_previous = theme('pager_previous', array(
    'text' => (isset($tags[1]) ? $tags[1] : t('previous')),
    'element' => $element,
    'interval' => 1,
    'parameters' => $parameters,
  ));
  $li_next = theme('pager_next', array(
    'text' => (isset($tags[3]) ? $tags[3] : t('next')),
    'element' => $element,
    'interval' => 1,
    'parameters' => $parameters,
  ));
  $li_last = theme('pager_last', array(
    'text' => (isset($tags[4]) ? $tags[4] : t('last')),
    'element' => $element,
    'parameters' => $parameters,
  ));
  if ($pager_total[$element] > 1) {

    // Only show "first" link if set on components' theme setting
    if ($li_first && theme_get_setting('ua_zen_pager_first_and_last')) {
      $items[] = array(
        'class' => array('pager-first'),
        'data' => $li_first,
      );
    }
    if ($li_previous) {
      $items[] = array(
        'class' => array('prev'),
        'data' => $li_previous,
      );
    }
    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis', 'disabled'),
          'data' => '<span>…</span>',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            // 'class' => array('pager-item'),
            'data' => theme('pager_previous', array(
              'text' => $i,
              'element' => $element,
              'interval' => ($pager_current - $i),
              'parameters' => $parameters,
            )),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            // Add the active class.
            'class' => array('active'),
            'data' => "<span>$i</span>",
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'data' => theme('pager_next', array(
              'text' => $i,
              'element' => $element,
              'interval' => ($i - $pager_current),
              'parameters' => $parameters,
            )),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis', 'disabled'),
          'data' => '<span>…</span>',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('next'),
        'data' => $li_next,
      );
    }
    // // Only show "last" link if set on components' theme setting
    if ($li_last && theme_get_setting('ua_zen_pager_first_and_last')) {
      $items[] = array(
       'class' => array('pager-last'),
       'data' => $li_last,
      );
    }

    $build = array(
      '#theme_wrappers' => array('container__pager'),
      '#attributes' => array(
        'class' => array(
          'text-center',
        ),
      ),
      'pager' => array(
        '#theme' => 'item_list',
        '#items' => $items,
        '#attributes' => array(
          'class' => array('pagination'),
        ),
      ),
    );
    return drupal_render($build);
  }
  return $output;
}
/**
 * Returns HTML for a table.
 *
 * @param array $variables
 *   An associative array containing:
 *   - header: An array containing the table headers. Each element of the array
 *     can be either a localized string or an associative array with the
 *     following keys:
 *     - "data": The localized title of the table column.
 *     - "field": The database field represented in the table column (required
 *       if user is to be able to sort on this column).
 *     - "sort": A default sort order for this column ("asc" or "desc"). Only
 *       one column should be given a default sort order because table sorting
 *       only applies to one column at a time.
 *     - Any HTML attributes, such as "colspan", to apply to the column header
 *       cell.
 *   - rows: An array of table rows. Every row is an array of cells, or an
 *     associative array with the following keys:
 *     - "data": an array of cells
 *     - Any HTML attributes, such as "class", to apply to the table row.
 *     - "no_striping": a boolean indicating that the row should receive no
 *       'even / odd' styling. Defaults to FALSE.
 *     Each cell can be either a string or an associative array with the
 *     following keys:
 *     - "data": The string to display in the table cell.
 *     - "header": Indicates this cell is a header.
 *     - Any HTML attributes, such as "colspan", to apply to the table cell.
 *     Here's an example for $rows:
 * @code
 *     $rows = array(
 *       // Simple row
 *       array(
 *         'Cell 1', 'Cell 2', 'Cell 3'
 *       ),
 *       // Row with attributes on the row and some of its cells.
 *       array(
 *         'data' => array('Cell 1', array('data' => 'Cell 2', 'colspan' => 2)), 'class' => array('funky')
 *       )
 *     );
 * @endcode
 *   - footer: An array containing the table footer. Each element of the array
 *     can be either a localized string or an associative array with the
 *     following keys:
 *     - "data": The localized title of the table column.
 *     - "field": The database field represented in the table column (required
 *       if user is to be able to sort on this column).
 *     - "sort": A default sort order for this column ("asc" or "desc"). Only
 *       one column should be given a default sort order because table sorting
 *       only applies to one column at a time.
 *     - Any HTML attributes, such as "colspan", to apply to the column footer
 *       cell.
 *   - attributes: An array of HTML attributes to apply to the table tag.
 *   - caption: A localized string to use for the <caption> tag.
 *   - colgroups: An array of column groups. Each element of the array can be
 *     either:
 *     - An array of columns, each of which is an associative array of HTML
 *       attributes applied to the COL element.
 *     - An array of attributes applied to the COLGROUP element, which must
 *       include a "data" attribute. To add attributes to COL elements, set the
 *       "data" attribute with an array of columns, each of which is an
 *       associative array of HTML attributes.
 *     Here's an example for $colgroup:
 * @code
 *     $colgroup = array(
 *       // COLGROUP with one COL element.
 *       array(
 *         array(
 *           'class' => array('funky'), // Attribute for the COL element.
 *         ),
 *       ),
 *       // Colgroup with attributes and inner COL elements.
 *       array(
 *         'data' => array(
 *           array(
 *             'class' => array('funky'), // Attribute for the COL element.
 *           ),
 *         ),
 *         'class' => array('jazzy'), // Attribute for the COLGROUP element.
 *       ),
 *     );
 * @endcode
 *     These optional tags are used to group and set properties on columns
 *     within a table. For example, one may easily group three columns and
 *     apply same background style to all.
 *   - sticky: Use a "sticky" table header.
 *   - empty: The message to display in an extra row if table does not have any
 *     rows.
 *
 * @return string
 *   The constructed HTML.
 *
 * @see theme_table()
 *
 * @ingroup theme_functions
 */
function ua_zen_table($variables) {
  $footer = NULL;
  $header = $variables['header'];
  $rows = $variables['rows'];
  if (isset($variables['footer'])) {
    $footer = $variables['footer'];
  }
  $attributes = $variables['attributes'];
  $caption = $variables['caption'];
  $colgroups = $variables['colgroups'];
  $sticky = $variables['sticky'];
  $empty = $variables['empty'];
  $responsive = $variables['responsive'];

  // Add sticky headers, if applicable.
  if (is_array($header) && count($header) && $sticky) {
    drupal_add_js('misc/tableheader.js');
    // Add 'sticky-enabled' class to the table to identify it for JS.
    // This is needed to target tables constructed by this function.
    $attributes['class'][] = 'sticky-enabled';
  }

  $output = '';

  if ($responsive) {
    $output .= "<div class=\"table-responsive\">\n";
  }

  $output .= '<table' . drupal_attributes($attributes) . ">\n";

  if (isset($caption)) {
    $output .= '<caption>' . $caption . "</caption>\n";
  }

  // Format the table columns:
  if (!empty($colgroups)) {
    foreach ($colgroups as $number => $colgroup) {
      $attributes = array();

      // Check if we're dealing with a simple or complex column.
      if (isset($colgroup['data'])) {
        foreach ($colgroup as $key => $value) {
          if ($key == 'data') {
            $cols = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $cols = $colgroup;
      }

      // Build colgroup.
      if (is_array($cols) && count($cols)) {
        $output .= ' <colgroup' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cols as $col) {
          $output .= ' <col' . drupal_attributes($col) . ' />';
        }
        $output .= " </colgroup>\n";
      }
      else {
        $output .= ' <colgroup' . drupal_attributes($attributes) . " />\n";
      }
    }
  }

  // Add the 'empty' row message if available.
  if (empty($rows) && !empty($empty)) {
    $header_count = 0;
    foreach ($header as $header_cell) {
      if (is_array($header_cell)) {
        $header_count += isset($header_cell['colspan']) ? $header_cell['colspan'] : 1;
      }
      else {
        $header_count++;
      }
    }
    $rows[] = array(
      array(
        'data' => $empty,
        'colspan' => $header_count,
        'class' => array('empty', 'message'),
      ),
    );
  }

  // Format the table header:
  if (!empty($header)) {
    $ts = tablesort_init($header);
    // HTML requires that the thead tag has tr tags in it followed by tbody
    // tags. Using ternary operator to check and see if we have any rows.
    $output .= (count($rows) ? ' <thead><tr>' : ' <tr>');
    foreach ($header as $cell) {
      $cell = tablesort_header($cell, $header, $ts);
      $output .= _theme_table_cell($cell, TRUE);
    }
    // Using ternary operator to close the tags based on whether or not there
    // are rows.
    $output .= (count($rows) ? " </tr></thead>\n" : "</tr>\n");
  }
  else {
    $ts = array();
  }

  // Format the table rows:
  if (!empty($rows)) {
    $output .= "<tbody>\n";
    foreach ($rows as $row) {
      // Check if we're dealing with a simple or complex row.
      if (isset($row['data'])) {
        $cells = $row['data'];

        // Set the attributes array and exclude 'data' and 'no_striping'.
        $attributes = $row;
        unset($attributes['data']);
        unset($attributes['no_striping']);
      }
      else {
        $cells = $row;
        $attributes = array();
      }
      if (count($cells)) {
        // Build row.
        $output .= ' <tr' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cells as $cell) {
          $cell = tablesort_cell($cell, $header, $ts, $i++);
          $output .= _theme_table_cell($cell);
        }
        $output .= " </tr>\n";
      }
    }
    $output .= "</tbody>\n";
  }

  // Format the table footer:
  if (!empty($footer)) {
    $output .= "<tfoot>\n";
    foreach ($footer as $row) {
      // Check if we're dealing with a simple or complex row.
      if (isset($row['data'])) {
        $cells = $row['data'];

        // Set the attributes array and exclude 'data'.
        $attributes = $row;
        unset($attributes['data']);
      }
      else {
        $cells = $row;
        $attributes = array();
      }
      if (count($cells)) {
        // Build row.
        $output .= ' <tr' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cells as $cell) {
          $cell = tablesort_cell($cell, $header, $ts, $i++);
          $output .= _theme_table_cell($cell);
        }
        $output .= " </tr>\n";
      }
    }
    // Using ternary operator to close the tags based on whether or not there
    // are rows.
    $output .= "</tfoot>\n";
  }

  $output .= "</table>\n";

  if ($responsive) {
    $output .= "</div>\n";
  }

  return $output;
}
/**
 * Pre-processes variables for the "table" theme hook.
 *
 * See theme function for list of available variables.
 *
 * @see ua_zen_table()
 * @see theme_table()
 *
 * @ingroup theme_preprocess
 */
function ua_zen_preprocess_table(&$variables) {
  // Prepare classes array if necessary.
  if (!isset($variables['attributes']['class'])) {
    $variables['attributes']['class'] = array();
  }
  // Convert classes to an array.
  elseif (isset($variables['attributes']['class']) && is_string($variables['attributes']['class'])) {
    $variables['attributes']['class'] = explode(' ', $variables['attributes']['class']);
  }

  // Add the necessary classes to the table.
  _ua_zen_table_add_classes($variables['attributes']['class'], $variables);
}

/**
 * Helper function for adding the necessary classes to a table.
 *
 * @param array $classes
 *   The array of classes, passed by reference.
 * @param array $variables
 *   The variables of the theme hook, passed by reference.
 */
function _ua_zen_table_add_classes(&$classes, &$variables) {
  if (isset($variables['context'])) {
    $context = $variables['context'];
  }

  // Generic table class for all tables.
  $classes[] = 'table';

  // Bordered table.
  if (!empty($context['bordered']) || (!isset($context['bordered']) && theme_get_setting('ua_zen_table_bordered'))) {
    $classes[] = 'table-bordered';
  }

  // Condensed table.
  if (!empty($context['condensed']) || (!isset($context['condensed']) && theme_get_setting('ua_zen_table_condensed'))) {
    $classes[] = 'table-condensed';
  }

  // Hover rows.
  if (!empty($context['hover']) || (!isset($context['hover']) && theme_get_setting('ua_zen_table_hover'))) {
    $classes[] = 'table-hover';
  }

  // Striped rows.
  if (!empty($context['striped']) || (!isset($context['striped']) && theme_get_setting('ua_zen_table_striped'))) {
    $classes[] = 'table-striped';
  }

  // Responsive table.
  $variables['responsive'] = isset($context['responsive']) ? $context['responsive'] : theme_get_setting('ua_zen_table_responsive');
}

function ua_zen_radios($variables) {
  $element = $variables['element'];
  $attributes = array();
  if (isset($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }
  if (!empty($element['#attributes']['class'])) {
    $attributes['class'] = implode(' ', $element['#attributes']['class']);
  }
  if (isset($element['#attributes']['title'])) {
    $attributes['title'] = $element['#attributes']['title'];
  }
  return '<div' . drupal_attributes($attributes) . '>' . (!empty($element['#children']) ? $element['#children'] : '') . '</div>';
}

function ua_zen_checkboxes($variables) {
  $element = $variables['element'];
  $attributes = array();
  if (isset($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }
  if (!empty($element['#attributes']['class'])) {
    $attributes['class'] = $element['#attributes']['class'];
  }
  if (isset($element['#attributes']['title'])) {
    $attributes['title'] = $element['#attributes']['title'];
  }
  return '<div' . drupal_attributes($attributes) . '>' . (!empty($element['#children']) ? $element['#children'] : '') . '</div>';
}

/**
 * Implements hook_pre_render().
 */
function ua_zen_pre_render($element) {
  if (!empty($element['#bootstrap_ignore_pre_render'])) {
    return $element;
  }

    // Only add the "form-control" class to supported theme hooks.
  $theme_hooks = array(
    'password',
    'select',
    'textarea',
    'textfield',
  );

  // Additionally, support some popular 3rd-party modules that don't follow
  // standards by creating custom theme hooks to use in their element types.
  // Go ahead and merge in the theme hooks as a start since most elements mimic
  // their theme hook counterparts as well.
  $types = array_merge($theme_hooks, array(
    // Elements module (HTML5).
    'date',
    'datefield',
    'email',
    'emailfield',
    'number',
    'numberfield',
    'range',
    'rangefield',
    'search',
    'searchfield',
    'tel',
    'telfield',
    'url',
    'urlfield',

    // Webform module.
    'webform_email',
    'webform_number',
  ));

  // Some elements have a supported type that usually has form-control set,
  // but the specific theme hook implementation should not be used with
  // the form-control class since it doesn't end up as an input field.
  $limit_hooks = array(
    // Better Exposed Filters.
    'select_as_checkboxes',
  );

  // Determine element theme hook.
  $theme = !empty($element['#theme']) ? $element['#theme'] : FALSE;

  // Handle array of theme hooks, just use first one (rare, but could happen).
  if (is_array($theme)) {
    $theme = array_shift($theme);
  }

  // Remove any suggestions.
  $parts = explode('__', $theme);
  $theme = array_shift($parts);

  // Determine element type.
  $type = !empty($element['#type']) ? $element['#type'] : FALSE;

  // Add necessary classes for specific element types/theme hooks.
  if (($theme && in_array($theme, $theme_hooks)) || ($type && in_array($type, $types) && !in_array($theme, $limit_hooks, TRUE)) || ($type === 'file' && empty($element['#managed_file']))) {
    $element['#attributes']['class'][] = 'form-control';
  }
  if ($type === 'machine_name') {
    $element['#wrapper_attributes']['class'][] = 'form-inline';
  }

  // Add smart descriptions to the element, if necessary.
  // bootstrap_element_smart_description($element);

  // Return the modified element.
  return $element;
}

/**
 * Implements hook_element_info_alter().
 */
function ua_zen_element_info_alter(&$info) {
  global $theme_key;

  $cid = "theme_registry:ua_zen:element_info";
  $cached = array();
  if (($cache = cache_get($cid)) && !empty($cache->data)) {
    $cached = $cache->data;
  }

  $themes = _ua_zen_get_base_themes($theme_key, TRUE);
  foreach ($themes as $theme) {
    if (!isset($cached[$theme])) {
      $cached[$theme] = array();
      foreach (array_keys($info) as $type) {
        $element = array();
        $properties = array(
          '#process' => array(
            'form_process',
            'form_process_' . $type,
          ),
          '#pre_render' => array(
            'pre_render',
            'pre_render_' . $type,
          ),
        );
        foreach ($properties as $property => $callbacks) {
          foreach ($callbacks as $callback) {
            $function = $theme . '_' . $callback;
            if (function_exists($function)) {
              // Replace direct core function correlation.
              if (!empty($info[$type][$property]) && array_search($callback, $info[$type][$property]) !== FALSE) {
                $element['#ua_zen_replace'][$property][$callback] = $function;
              }
              // Check for a "form_" prefix instead (for #pre_render).
              elseif (!empty($info[$type][$property]) && array_search('form_' . $callback, $info[$type][$property]) !== FALSE) {
                $element['#ua_zen_replace'][$property]['form_' . $callback] = $function;
              }
              // Otherwise, append the function.
              else {
                $element[$property][] = $function;
              }
            }
          }
        }
        $cached[$theme][$type] = $element;
      }

      // Cache the element information.
      cache_set($cid, $cached);
    }

    // Merge in each theme's cached element info.
    $info = _ua_zen_element_info_array_merge($info, $cached[$theme]);
  }
}

/**
 * Merges the cached element information into the runtime array.
 *
 * @param array $info
 *   The element info array to merge data into.
 * @param array $cached
 *   The cached element info data array to merge from.
 *
 * @return array
 *   The altered element info array.
 */
function _ua_zen_element_info_array_merge($info, $cached) {
  foreach ($cached as $type => $element) {
    $replacement_data = isset($element['#ua_zen_replace']) ? $element['#ua_zen_replace'] : array();
    unset($element['#ua_zen_replace']);
    foreach ($element as $property => $data) {
      if (is_array($data)) {
        if (!isset($info[$type][$property])) {
          $info[$type][$property] = array();
        }
        // Append the values if not already in the array.
        foreach ($data as $key => $value) {
          if (!in_array($value, $info[$type][$property])) {
            $info[$type][$property][] = $value;
          }
        }
      }
      // Create the property, if not already set.
      elseif (!isset($info[$type][$property])) {
        $info[$type][$property] = $data;
      }
    }
    // Replace data, if necessary.
    foreach ($replacement_data as $property => $data) {
      if (is_array($data)) {
        foreach ($data as $needle => $replacement) {
          if (!empty($info[$type][$property]) && ($key = array_search($needle, $info[$type][$property])) !== FALSE) {
            $info[$type][$property][$key] = $replacement;
          }
        }
      }
      // Replace the property with the new data.
      else {
        $info[$type][$property] = $data;
      }
    }
  }

  // Return the altered element info array.
  return $info;
}

/**
 * Returns HTML for a form element.
 *
 * Each form element is wrapped in a DIV container having the following CSS
 * classes:
 * - form-item: Generic for all form elements.
 * - form-type-#type: The internal element #type.
 * - form-item-#name: The internal form element #name (usually derived from the
 *   $form structure and set via form_builder()).
 * - form-disabled: Only set if the form element is #disabled.
 *
 * In addition to the element itself, the DIV contains a label for the element
 * based on the optional #title_display property, and an optional #description.
 *
 * The optional #title_display property can have these values:
 * - before: The label is output before the element. This is the default.
 *   The label includes the #title and the required marker, if #required.
 * - after: The label is output after the element. For example, this is used
 *   for radio and checkbox #type elements as set in system_element_info().
 *   If the #title is empty but the field is #required, the label will
 *   contain only the required marker.
 * - invisible: Labels are critical for screen readers to enable them to
 *   properly navigate through forms but can be visually distracting. This
 *   property hides the label for everyone except screen readers.
 * - attribute: Set the title attribute on the element to create a tooltip
 *   but output no label element. This is supported only for checkboxes
 *   and radios in form_pre_render_conditional_form_element(). It is used
 *   where a visual label is not needed, such as a table of checkboxes where
 *   the row and column provide the context. The tooltip will include the
 *   title and required marker.
 *
 * If the #title property is not set, then the label and any required marker
 * will not be output, regardless of the #title_display or #required values.
 * This can be useful in cases such as the password_confirm element, which
 * creates children elements that have their own labels and required markers,
 * but the parent element should have neither. Use this carefully because a
 * field without an associated label can cause accessibility challenges.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #title, #title_display, #description, #id, #required,
 *     #children, #type, #name.
 *
 * @return string
 *   The constructed HTML.
 *
 * @see theme_form_element()
 *
 * @ingroup theme_functions
 */
function ua_zen_form_element($variables) {
  $element = &$variables['element'];
  $name = !empty($element['#name']) ? $element['#name'] : FALSE;
  $type = !empty($element['#type']) ? $element['#type'] : FALSE;
  $checkbox = $type && $type === 'checkbox';
  $radio = $type && $type === 'radio';

  // Create an attributes array for the wrapping container.
  if (empty($element['#wrapper_attributes'])) {
    $element['#wrapper_attributes'] = array();
  }
  $wrapper_attributes = &$element['#wrapper_attributes'];

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
    '#title_display' => 'before',
  );

  // Add wrapper ID for 'item' type.
  if ($type && $type === 'item' && !empty($element['#markup']) && !empty($element['#id'])) {
    $wrapper_attributes['id'] = $element['#id'];
  }

  // Add necessary classes to wrapper container.
  $wrapper_attributes['class'][] = 'form-item';
  if ($name) {
    $wrapper_attributes['class'][] = 'form-item-' . drupal_html_class($name);
  }
  if ($type) {
    $wrapper_attributes['class'][] = 'form-type-' . drupal_html_class($type);
  }
  if (!empty($element['#attributes']['disabled'])) {
    $wrapper_attributes['class'][] = 'form-disabled';
  }
  if (!empty($element['#autocomplete_path']) && drupal_valid_path($element['#autocomplete_path'])) {
    $wrapper_attributes['class'][] = 'form-autocomplete';
  }

  // Checkboxes and radios do no receive the 'form-group' class, instead they
  // simply have their own classes.
  if ($checkbox || $radio) {
    $wrapper_attributes['class'][] = drupal_html_class($type);
  }
  elseif ($type && $type !== 'hidden') {
    $wrapper_attributes['class'][] = 'form-group';
  }

  // Create a render array for the form element.
  $build = array(
    '#theme_wrappers' => array('container__form_element'),
    '#attributes' => $wrapper_attributes,
  );

  // Render the label for the form element.
  $build['label'] = array(
    '#markup' => theme('form_element_label', $variables),
    '#weight' => $element['#title_display'] === 'before' ? 0 : 2,
  );

  // Checkboxes and radios render the input element inside the label. If the
  // element is neither of those, then the input element must be rendered here.
  if (!$checkbox && !$radio) {
    $prefix = isset($element['#field_prefix']) ? $element['#field_prefix'] : '';
    $suffix = isset($element['#field_suffix']) ? $element['#field_suffix'] : '';
    if ((!empty($prefix) || !empty($suffix)) && (!empty($element['#input_group']) || !empty($element['#input_group_button']))) {
      if (!empty($element['#field_prefix'])) {
        $prefix = '<span class="input-group-' . (!empty($element['#input_group_button']) ? 'btn' : 'addon') . '">' . $prefix . '</span>';
      }
      if (!empty($element['#field_suffix'])) {
        $suffix = '<span class="input-group-' . (!empty($element['#input_group_button']) ? 'btn' : 'addon') . '">' . $suffix . '</span>';
      }

      // Add a wrapping container around the elements.
      $input_group_attributes = &_ua_zen_get_attributes($element, 'input_group_attributes');
      $input_group_attributes['class'][] = 'input-group';
      $prefix = '<div' . drupal_attributes($input_group_attributes) . '>' . $prefix;
      $suffix .= '</div>';
    }

    // Build the form element.
    $build['element'] = array(
      '#markup' => $element['#children'],
      '#prefix' => !empty($prefix) ? $prefix : NULL,
      '#suffix' => !empty($suffix) ? $suffix : NULL,
      '#weight' => 1,
    );
  }

  // Construct the element's description markup.
  if (!empty($element['#description'])) {
    $build['description'] = array(
      '#type' => 'container',
      '#attributes' => array(
        'class' => array('help-block'),
      ),
      '#weight' => isset($element['#description_display']) && $element['#description_display'] === 'before' ? 0 : 2,
      0 => array('#markup' => filter_xss_admin($element['#description'])),
    );
  }

  // Render the form element build array.
  return drupal_render($build);
}

/**
 * Returns HTML for a form element label and required marker.
 *
 * Form element labels include the #title and a #required marker. The label is
 * associated with the element itself by the element #id. Labels may appear
 * before or after elements, depending on theme_form_element() and
 * #title_display.
 *
 * This function will not be called for elements with no labels, depending on
 * #title_display. For elements that have an empty #title and are not required,
 * this function will output no label (''). For required elements that have an
 * empty #title, this will output the required marker alone within the label.
 * The label will use the #id to associate the marker with the field that is
 * required. That is especially important for screenreader users to know
 * which field is required.
 *
 * @param array $variables
 *   An associative array containing:
 *   - element: An associative array containing the properties of the element.
 *     Properties used: #required, #title, #id, #value, #description.
 *
 * @return string
 *   The constructed HTML.
 *
 * @see theme_form_element_label()
 *
 * @ingroup theme_functions
 */
function ua_zen_form_element_label(&$variables) {
  $element = $variables['element'];

  // Extract variables.
  $output = '';

  $title = !empty($element['#title']) ? filter_xss_admin($element['#title']) : '';

  // Only show the required marker if there is an actual title to display.
  if ($title && $required = !empty($element['#required']) ? theme('form_required_marker', array('element' => $element)) : '') {
    $title .= ' ' . $required;
  }

  $display = isset($element['#title_display']) ? $element['#title_display'] : 'before';
  $type = !empty($element['#type']) ? $element['#type'] : FALSE;
  $checkbox = $type && $type === 'checkbox';
  $radio = $type && $type === 'radio';

  // Immediately return if the element is not a checkbox or radio and there is
  // no label to be rendered.
  if (!$checkbox && !$radio && ($display === 'none' || !$title)) {
    return '';
  }

  // Retrieve the label attributes array.
  $attributes = &_ua_zen_get_attributes($element, 'label_attributes');

  // Add Bootstrap label class.
  $attributes['class'][] = 'control-label';

  // Add the necessary 'for' attribute if the element ID exists.
  if (!empty($element['#id'])) {
    $attributes['for'] = $element['#id'];
  }

  // Checkboxes and radios must construct the label differently.
  if ($checkbox || $radio) {
    if ($display === 'before') {
      $output .= $title;
    }
    elseif ($display === 'none' || $display === 'invisible') {
      $output .= '<span class="element-invisible">' . $title . '</span>';
    }
    // Inject the rendered checkbox or radio element inside the label.
    if (!empty($element['#children'])) {
      $output .= $element['#children'];
    }
    if ($display === 'after') {
      $output .= $title;
    }
  }
  // Otherwise, just render the title as the label.
  else {
    // Show label only to screen readers to avoid disruption in visual flows.
    if ($display === 'invisible') {
      $attributes['class'][] = 'element-invisible';
    }
    $output .= $title;
  }

  // The leading whitespace helps visually separate fields from inline labels.
  return ' <label' . drupal_attributes($attributes) . '>' . $output . "</label>\n";
}

/**
 * Pre-processes variables for the "webform_element" theme hook.
 *
 * See theme function for list of available variables.
 *
 * @see theme_webform_element()
 *
 * @ingroup theme_preprocess
 */
function ua_zen_preprocess_webform_element(&$variables) {
  $element = $variables['element'];
  $wrapper_attributes = array();
  if (isset($element['#wrapper_attributes'])) {
    $wrapper_attributes = $element['#wrapper_attributes'];
  }

  // See http://getbootstrap.com/css/#forms-controls.
  if (isset($element['#type'])) {
    if ($element['#type'] === 'radio') {
      $wrapper_attributes['class'][] = 'radio';
    }
    elseif ($element['#type'] === 'checkbox') {
      $wrapper_attributes['class'][] = 'checkbox';
    }
    elseif ($element['#type'] !== 'hidden') {
      $wrapper_attributes['class'][] = 'form-group';
    }
  }

  $variables['element']['#wrapper_attributes'] = $wrapper_attributes;
}

/**
 * Returns HTML for a webform element.
 *
 * @see theme_webform_element()
 * @see ua_zen_form_element()
 */
function ua_zen_webform_element(&$variables) {
  $element = &$variables['element'];

  // Inline title.
  if ($element['#title_display'] === 'inline') {
    $element['#title_display'] = 'before';
    $element['#wrapper_attributes']['class'][] = 'form-inline';
  }

  // Description above field.
  if (!empty($element['#webform_component']['extra']['description_above'])) {
    $element['#description_display'] = 'before';
  }

  // If field prefix or suffix is present, make this an input group.
  if (!empty($element['#field_prefix']) || !empty($element['#field_suffix'])) {
    $element['#input_group'] = TRUE;
  }

  // Render with ua_zen_form_element().
  return ua_zen_form_element($variables);
}

/**
 * Retrieves an element's "attributes" array.
 *
 * @param array $element
 *   The individual renderable array element. It is possible to also pass the
 *   $variables parameter in [pre]process functions and it will logically
 *   determine the correct path to that particular theme hook's attribute array.
 *   Passed by reference.
 * @param string $property
 *   Determines which attributes array to retrieve. By default, this is the
 *   normal attributes, but can be "wrapper_attributes" or
 *   "input_group_attributes".
 *
 * @return array
 *   The attributes array. Passed by reference.
 */
function &_ua_zen_get_attributes(&$element, $property = 'attributes') {
  // Attempt to retrieve a renderable element attributes first.
  if (
    isset($element['#type']) ||
    isset($element['#theme']) ||
    isset($element['#pre_render']) ||
    isset($element['#markup']) ||
    isset($element['#theme_wrappers']) ||
    isset($element["#$property"])
  ) {
    if (!isset($element["#$property"])) {
      $element["#$property"] = array();
    }
    return $element["#$property"];
  }
  // Treat $element as if it were a [pre]process function $variables parameter
  // and look for a renderable "element".
  elseif (isset($element['element'])) {
    if (!isset($element['element']["#$property"])) {
      $element['element']["#$property"] = array();
    }
    return $element['element']["#$property"];
  }

  // If all else fails, create (if needed) a default "attributes" array. This
  // will, at the very least, either work or cause an error that can be tracked.
  if (!isset($element[$property])) {
    $element[$property] = array();
  }

  return $element[$property];
}

/**
 * Returns a list of base themes for active or provided theme.
 *
 * @param string $theme_key
 *   The machine name of the theme to check, if not set the active theme name
 *   will be used.
 * @param bool $include_theme_key
 *   Whether to append the returned list with $theme_key.
 *
 * @return array
 *   An indexed array of base themes.
 */
function _ua_zen_get_base_themes($theme_key = NULL, $include_theme_key = FALSE) {
  static $themes;
  if (!isset($theme_key)) {
    $theme_key = $GLOBALS['theme_key'];
  }
  if (!isset($themes[$theme_key])) {
    $themes[$theme_key] = array_unique(array_filter((array) ua_zen_get_theme_info($theme_key, 'base theme')));
  }
  if ($include_theme_key) {
    $themes[$theme_key][] = $theme_key;
  }
  return $themes[$theme_key];
}

/**
 * Implements hook_form_webform_client_form_alter.
 */
function ua_zen_form_webform_client_form_alter(&$form, &$form_state, $form_id) {

  // Multi-page webform "Previous" button.
  if (!empty($form['actions']) && isset($form['actions']['previous'])) {
   $form['actions']['previous']['#attributes'] = array('class' => array('btn', 'btn-hollow-primary mr-1', 'radius'));
  }

  // Multi-page webform "Next" button.
  if (!empty($form['actions']) && isset($form['actions']['next'])) {
   $form['actions']['next']['#attributes'] = array('class' => array('btn', 'btn-hollow-primary mr-1', 'radius'));
  }

}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function ua_zen_process_block(&$variables, $hook) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = isset($variables['block']->subject) ? $variables['block']->subject : '';
}

/**
 * Implements hook_page_alter().
 *
 * Look for the last block in the region. This is impossible to determine from
 * within a preprocess_block function.
 *
 * @param $page
 *   Nested array of renderable elements that make up the page.
 */
function ua_zen_page_alter(&$page) {
  // Look in each visible region for blocks.
  foreach (system_region_list($GLOBALS['theme'], REGIONS_VISIBLE) as $region => $name) {
    if (!empty($page[$region])) {
      // Find the last block in the region.
      $blocks = array_reverse(element_children($page[$region]));
      while ($blocks && !isset($page[$region][$blocks[0]]['#block'])) {
        array_shift($blocks);
      }
      if ($blocks) {
        $page[$region][$blocks[0]]['#block']->last_in_region = TRUE;
      }
    }
  }
}

/**
 * Implements hook_form_BASE_FORM_ID_alter().
 *
 * Zen Theme workaround for a Drupal 7 Core bug, fixed in 8.
 * @see https://www.drupal.org/project/drupal/issues/1245218
 */
function ua_zen_form_node_form_alter(&$form, &$form_state, $form_id) {
  foreach (array_keys($form) as $item) {
    if (strpos($item, 'field_') === 0) {
      if (!empty($form[$item]['#attributes']['class'])) {
        foreach ($form[$item]['#attributes']['class'] as &$class) {
          // Core bug: the field-type-text-with-summary class is used as a JS hook.
          if ($class != 'field-type-text-with-summary' && strpos($class, 'field-type-') === 0 || strpos($class, 'field-name-') === 0) {
            // Make the class different from that used in theme_field().
            $class = 'form-' . $class;
          }
        }
      }
    }
  }
}

/**
 * Implements hook_form_alter.
 */
function ua_zen_form_alter(&$form, &$form_state, $form_id) {
  if (!empty($form['actions'])) {
    foreach ($form['actions'] as $key => $value) {
      if ($key == 'submit') {
        switch ($form_id) {
          case 'search_form':
            $form['actions']['submit']['#attributes'] = array('class' => array('btn', 'btn-search', 'radius'));
            break;
          case 'search_block_form':
            $form['actions']['submit']['#attributes'] = array('class' => array('btn', 'btn-search', 'radius'));
            break;
          default:
            $form['actions']['submit']['#attributes'] = array('class' => array('btn', 'btn-default', 'radius', 'mr-1'));
        }
      }
      elseif (!strstr($key, '#')) {
        $form['actions'][$key]['#attributes'] = array('class' => array('btn', 'btn-primary', 'radius', 'mr-1'));
      }
    }
  }

  // Basic Search
  if (!empty($form['basic']) && isset($form['basic']['submit'])) {
    $form['basic']['submit']['#attributes'] = array('class' => array('btn', 'btn-default', 'radius', 'mr-1'));
  }

  // Advanced Search
  if (!empty($form['advanced']) && isset($form['advanced']['submit'])) {
    $form['advanced']['submit']['#attributes'] = array('class' => array('btn', 'btn-default', 'radius', 'mr-1'));
  }

  // Webforms
  if (!empty($form['add']) && isset($form['add']['add'])) {
    $form['add']['add']['#attributes'] = array('class' => array('btn', 'btn-default', 'radius', 'mr-1'));
  }
}
