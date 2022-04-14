<?php

/**
 * @file
 * uaqs_admin.features.menu_links.inc
 */

/**
 * Implements hook_menu_default_menu_links().
 */
function uaqs_admin_menu_default_menu_links() {
  $menu_links = array();

  // Exported menu link: administrator_add-content:node/add.
  $menu_links['administrator_add-content:node/add'] = array(
    'menu_name' => 'administrator',
    'link_path' => 'node/add',
    'router_path' => 'node/add',
    'link_title' => 'Add content',
    'options' => array(
      'identifier' => 'administrator_add-content:node/add',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
    'customized' => 0,
  );
  // Exported menu link: administrator_cas-logout:cas/logout.
  $menu_links['administrator_cas-logout:cas/logout'] = array(
    'menu_name' => 'administrator',
    'link_path' => 'cas/logout',
    'router_path' => 'cas',
    'link_title' => 'CAS Logout',
    'options' => array(
      'identifier' => 'administrator_cas-logout:cas/logout',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -44,
    'customized' => 0,
  );
  // Exported menu link: administrator_find-content:admin/content.
  $menu_links['administrator_find-content:admin/content'] = array(
    'menu_name' => 'administrator',
    'link_path' => 'admin/content',
    'router_path' => 'admin/content',
    'link_title' => 'Find content',
    'options' => array(
      'identifier' => 'administrator_find-content:admin/content',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -49,
    'customized' => 0,
  );
  // Exported menu link: administrator_find-or-add-blocks:admin/content/blocks.
  $menu_links['administrator_find-or-add-blocks:admin/content/blocks'] = array(
    'menu_name' => 'administrator',
    'link_path' => 'admin/content/blocks',
    'router_path' => 'admin/content/blocks',
    'link_title' => 'Find or add blocks',
    'options' => array(
      'identifier' => 'administrator_find-or-add-blocks:admin/content/blocks',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -47,
    'customized' => 0,
  );
  // Exported menu link: administrator_menus:admin/structure/menu.
  $menu_links['administrator_menus:admin/structure/menu'] = array(
    'menu_name' => 'administrator',
    'link_path' => 'admin/structure/menu',
    'router_path' => 'admin/structure/menu',
    'link_title' => 'Menus',
    'options' => array(
      'identifier' => 'administrator_menus:admin/structure/menu',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -46,
    'customized' => 0,
  );
  // Exported menu link: administrator_performance:admin/config/development/performance.
  $menu_links['administrator_performance:admin/config/development/performance'] = array(
    'menu_name' => 'administrator',
    'link_path' => 'admin/config/development/performance',
    'router_path' => 'admin/config/development/performance',
    'link_title' => 'Performance',
    'options' => array(
      'identifier' => 'administrator_performance:admin/config/development/performance',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -45,
    'customized' => 0,
  );
  // Exported menu link: administrator_place-blocks:admin/structure/block.
  $menu_links['administrator_place-blocks:admin/structure/block'] = array(
    'menu_name' => 'administrator',
    'link_path' => 'admin/structure/block',
    'router_path' => 'admin/structure/block',
    'link_title' => 'Place blocks',
    'options' => array(
      'identifier' => 'administrator_place-blocks:admin/structure/block',
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -48,
    'customized' => 0,
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Add content');
  t('CAS Logout');
  t('Find content');
  t('Find or add blocks');
  t('Menus');
  t('Performance');
  t('Place blocks');

  return $menu_links;
}
