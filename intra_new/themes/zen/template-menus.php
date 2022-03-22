<?php
// $Id: template-menus.php,v 1.1.2.1 2007/11/08 08:20:46 johnalbin Exp $

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
?><?php
function is_top_menu($mid){
	$item = menu_get_item($mid);
	if($item['pid']==1 || $item['pid']==-100){
		return 0;
	}
	else{
		return (1+is_top_menu($item['pid']));
	}
} 
 
function phptemplate_menu_item($mid, $children = '', $leaf = TRUE) {
 	//var_dump(menu_get_menu());
	$item = menu_get_item($mid);
	$class = array();
	//var_dump(menu_get_active_title()).var_dump($item['title']).'<br>';
	
	
	if($item['pid']!=1 && $item['pid']!=-100 && $item['title']!='My account'){
		$class[] = 'submenu';
	}
	$level = is_top_menu($mid);
	if($level > 0 && $item['title']!='My account'){
		$class[]= 'menu_level'.$level;
	}
	if(menu_get_active_item() == $mid || menu_get_active_title() == $item['title']){
		$class[] = 'active_menu_item';
	}
	//var_dump($item);
  return '<div style="margin:0px 10px 0px 20px;" class="menu_div '. ($leaf ? 'leaf' : ($children ? 'expanded' : 'collapsed')) .' '.implode(' ',$class).' ">'. menu_item_link($mid) ."</div>". $children;
 }

 
function phptemplate_menu_item_link($item, $link_item) {
//var_dump($item);
//var_dump($link_item);
  // If an item is a LOCAL TASK, render it as a tab
  $tab = ($item['type'] & MENU_IS_LOCAL_TASK) ? TRUE : FALSE;
  return l(
  // $tab ? '<span class="tab">'. check_plain($item['title']) .'</span>': check_plain($item['title']),
   $tab ? '<span class="tab">'. html_entity_decode($item['title'], ENT_QUOTES) .'</span>': html_entity_decode($item['title'], ENT_QUOTES),
    $link_item['path'],
    !empty($item['description']) ? array('title' => $item['description']) : array(),
    !empty($item['query']) ? $item['query'] : NULL,
    !empty($link_item['fragment']) ? $link_item['fragment'] : NULL,
    FALSE,
    $tab
  );
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clear-block to tabs.
 */
function phptemplate_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= '<ul class="tabs primary clear-block">'. $primary .'</ul>';
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clear-block">'. $secondary .'</ul>';
  }

  return $output;
}
