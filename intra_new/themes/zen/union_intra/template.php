<?php
// $Id: template.php,v 1.1.2.4 2008/06/24 11:18:36 johnalbin Exp $

/**
 * @file
 *
 * OVERRIDING THEME FUNCTIONS
 *
 * The Drupal theme system uses special theme functions to generate HTML output
 * automatically. Often we wish to customize this HTML output. To do this, we
 * have to override the theme function. You have to first find the theme
 * function that generates the output, and then "catch" it and modify it here.
 * The easiest way to do it is to copy the original function in its entirety and
 * paste it here, changing the prefix from theme_ to phptemplate_ or zen_. For
 * example:
 *
 *   original: theme_breadcrumb()
 *   theme override: zen_breadcrumb()
 *
 * DIFFERENCES BETWEEN ZEN SUB-THEMES AND NORMAL DRUPAL SUB-THEMES
 *
 * The Zen theme allows its sub-themes to have their own template.php files. The
 * only restriction with these files is that they cannot redefine any of the
 * functions that are already defined in Zen's main template files:
 *   template.php, template-menus.php, and template-subtheme.php.
 * Every theme override function used in those files is documented below in this
 * file.
 *
 * Also remember that the "main" theme is still Zen, so your theme override
 * functions should be named as such:
 *  theme_block()      becomes  zen_block()
 *  theme_feed_icon()  becomes  zen_feed_icon()  as well
 *
 * However, there are two exceptions to the "theme override functions should use
 * 'zen' and not 'mytheme'" rule. They are as follows:
 *
 * Normally, for a theme to define its own regions, you would use the
 * THEME_regions() fuction. But for a Zen sub-theme to define its own regions,
 * use the function name
 *   union_intra_regions()
 * where union_intra is the name of your sub-theme. For example, the zen_classic
 * theme would define a zen_classic_regions() function.
 *
 * For a sub-theme to add its own variables, instead of _phptemplate_variables,
 * use these functions:
 *   union_intra_preprocess_page(&$vars)     to add variables to the page.tpl.php
 *   union_intra_preprocess_node(&$vars)     to add variables to the node.tpl.php
 *   union_intra_preprocess_comment(&$vars)  to add variables to the comment.tpl.php
 *   union_intra_preprocess_block(&$vars)    to add variables to the block.tpl.php
 */


/*
 * Initialize theme settings
 */
include_once 'theme-settings-init.php';


/*
 * Sub-themes with their own page.tpl.php files are seen by PHPTemplate as their
 * own theme (seperate from Zen). So we need to re-connect those sub-themes
 * with the main Zen theme.
 */
include_once './'. drupal_get_path('theme', 'zen') .'/template.php';


/*
 * Add the stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that are in the main Zen folder, use path_to_theme().
 * To add stylesheets that are in your sub-theme's folder, use path_to_subtheme().
 */

// Add any stylesheets you would like from the main Zen theme.
drupal_add_css(path_to_theme() .'/html-elements.css', 'theme', 'all');
drupal_add_css(path_to_theme() .'/tabs.css', 'theme', 'all');

// Then add styles for this sub-theme.
drupal_add_css(path_to_subtheme() .'/layout.css', 'theme', 'all');
drupal_add_css(path_to_subtheme() .'/union_intra.css', 'theme', 'all');

// Avoid IE5 bug that always loads @import print stylesheets
zen_add_print_css(path_to_subtheme() .'/print.css');

//Commented out 11-27-2012

function phptemplate_item_list($items = array(), $title = NULL) {
  // Pass to phptemplate, including translating the parameters to an associative array. 
  // The element names are the names that the variables
  // will be assigned within your template.
  return _phptemplate_callback('item_list', array('items' => $items, 'title' => $title));
}


function phptemplate_menu_tree($pid = 1){
	//var_dump($tree = menu_tree(1));
	//print menu_tree($pid).'<br>';
	if ($tree = menu_tree($pid)) {
    	return '<div class="menu1">'. $tree .'</div>';
	}
	
}

function phptemplate_user_profile($account, $fields) {

//$fields = user_modification_user('view', NULL, $user, NULL);
$output = '<div class="profile">';
  
  //$output .= theme('user_picture', $account);
  $fieldss = $fields[""];
  $output .='<h2>'.$fieldss['first']['value'].' '.$fieldss['last']['value'].'</h2><div style="width:100%;"><div style="float:left; width:50%;"><h3>Personal Info</h3>Home Phone: '.$fieldss['h_phone']['value'].'<br>Email: '.$fieldss['email']['value'].'<br></div><div style="float:left; width:50%;"><h3>Work Info</h3> Unit: '.$fieldss['portals']['value'].'<br>work phone:'.$fieldss['w_phone']['value'].'</div><div style="clear:both;"></div></div><hr style="clear:both; "><div><h3>New Employee Orientation</h3>NEO Quiz: '.$fieldss['neo']['value'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Customer Service Training: '.$fieldss['cst']['value'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sexual Harassment Training: '.$fieldss['sht']['value'].'</div>';
  
  if($fieldss['hours']['value'] != 0)
  $output .= '<hr><div><h3>Evaluations</h3><div style="border:1px solid; height:20px; width:300px;"><div style="height:100%; width:'.$fieldss['hours']['value'].'px; background-color:blue;">'.$fieldss['hours']['value'].'</div></div>Hours Since Last Evaluation<br><br>Previous Evaluations On:<ul><li>10/05/2009</li><li>05/01/2009</li></ul></div></div>';

  /*
  foreach ($fields as $category => $items) {
    if (strlen($category) > 0) {
      $output .= '<h2 class="title">'. check_plain($category) .'</h2>';
    }
    $output .= '<dl>';
    foreach ($items as $item) {
      if (isset($item['title'])) {
        $output .= '<dt class="'. $item['class'] .'">'. $item['title'] .'</dt>';
      }
      $output .= '<dd class="'. $item['class'] .'">'. $item['value'] .'</dd>';
    }
    $output .= '</dl>';
  }
  $output .= '</div>';
*/
  return $output;
}


/**
 * Declare the available regions implemented by this theme.
 *
 * @return
 *   An array of regions.
 */
/* -- Delete this line if you want to use this function
function union_intra_regions() {
  return array(
    'left' => t('left sidebar'),
    'right' => t('right sidebar'),
    'navbar' => t('navigation bar'),
    'content_top' => t('content top'),
    'content_bottom' => t('content bottom'),
    'header' => t('header'),
    'footer' => t('footer'),
    'closure_region' => t('closure'),
  );
}
// */


/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
/* -- Delete this line if you want to use this function
function zen_breadcrumb($breadcrumb) {
  return '<div class="breadcrumb">'. implode(' › ', $breadcrumb) .' ›</div>';
}
// */


/**
 * Override or insert PHPTemplate variables into all templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 * @param $hook
 *   The name of the theme function being called (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function union_intra_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert PHPTemplate variables into the page templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function union_intra_preprocess_page(&$vars) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert PHPTemplate variables into the node templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function union_intra_preprocess_node(&$vars) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert PHPTemplate variables into the comment templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function union_intra_preprocess_comment(&$vars) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert PHPTemplate variables into the block templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function union_intra_preprocess_block(&$vars) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */


/**
 * Override the theme's search form using the search-theme-form.tpl.php file.
 *
 * This is the form that appears when toggling the checkbox for "Enable or
 * disable the display of... Search Box" on the theme settings page.
 */
/* -- Delete this line if you want to use this function
function phptemplate_search_theme_form($form) {
  return _phptemplate_callback('search_theme_form', array('form' => $form), array('search-theme-form'));
}
// */

/**
 * Override the search block's form using the search-block-form.tpl.php file.
 *
 * This is the form that appears when enabling the "Search form" block.
 */
/* -- Delete this line if you want to use this function
function phptemplate_search_block_form($form) {
  return _phptemplate_callback('search_block_form', array('form' => $form), array('search-block-form'));
}
// */

/**
 * Generate the HTML representing a given menu item ID.
 *
 * An implementation of theme_menu_item_link()
 *
 * @param $item
 *   array The menu item to render.
 * @param $link_item
 *   array The menu item which should be used to find the correct path.
 * @return
 *   string The rendered menu item.
 */
/* -- Delete this line if you want to use this function
function zen_menu_item_link($item, $link_item) {
  // If an item is a LOCAL TASK, render it as a tab
  $tab = ($item['type'] & MENU_IS_LOCAL_TASK) ? TRUE : FALSE;
  return l(
    $tab ? '<span class="tab">'. check_plain($item['title']) .'</span>' : $item['title'],
    $link_item['path'],
    !empty($item['description']) ? array('title' => $item['description']) : array(),
    !empty($item['query']) ? $item['query'] : NULL,
    !empty($link_item['fragment']) ? $link_item['fragment'] : NULL,
    FALSE,
    $tab
  );
}
// */

/**
 * Duplicate of theme_menu_local_tasks() but adds clear-block to tabs.
 */
/* -- Delete this line if you want to use this function
function zen_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= '<ul class="tabs primary clear-block">'. $primary .'</ul>';
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clear-block">'. $secondary .'</ul>';
  }

  return $output;
}
// */

/**
 * Overriding theme_comment_wrapper to add CSS id around all comments
 * and add "Comments" title above
 */
/* -- Delete this line if you want to use this function
function zen_comment_wrapper($content) {
  return '<div id="comments"><h2 id="comments-title" class="title">'. t('Comments') .'</h2>'. $content .'</div>';
}
// */

/**
 * Duplicate of theme_username() with rel=nofollow added for commentators.
 */
/* -- Delete this line if you want to use this function
function zen_username($object) {

  if ($object->uid && $object->name) {
    // Shorten the name when it is too long or it will break many tables.
    if (drupal_strlen($object->name) > 20) {
      $name = drupal_substr($object->name, 0, 15) .'...';
    }
    else {
      $name = $object->name;
    }

    if (user_access('access user profiles')) {
      $output = l($name, 'user/'. $object->uid, array('title' => t('View user profile.')));
    }
    else {
      $output = check_plain($name);
    }
  }
  else if ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if ($object->homepage) {
      $output = l($object->name, $object->homepage, array('rel' => 'nofollow'));
    }
    else {
      $output = check_plain($object->name);
    }

    $output .= ' ('. t('not verified') .')';
  }
  else {
    $output = variable_get('anonymous', t('Anonymous'));
  }

  return $output;
}
// */

function zen_webform_mail_headers($form_values, $node, $sid, $cid) {
  $headers = array(
	'MIME-Version'	=> '1.0',
    'Content-Type'  => 'text/html; charset=UTF-8; format=flowed; delsp=yes',
    'X-Mailer'      => 'Drupal Webform (PHP/'. phpversion() .')',
  );
  return $headers;
}

function zen_webform_mail_message_667($form_values, $node, $sid, $cid) {
  return _phptemplate_callback('webform-mail', array('form_values' => $form_values, 'node' => $node, 'sid' => $sid, 'cid' => $cid));
}

function zen_webform_mail_message_668($form_values, $node, $sid, $cid) {
  return _phptemplate_callback('webform-mail', array('form_values' => $form_values, 'node' => $node, 'sid' => $sid, 'cid' => $cid));
}

function zen_webform_mail_message_669($form_values, $node, $sid, $cid) {
  return _phptemplate_callback('webform-mail', array('form_values' => $form_values, 'node' => $node, 'sid' => $sid, 'cid' => $cid));
}