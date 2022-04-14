<?php

/**
 * @file
 * Add content to demonstrate the UAQS Navigation feature.
 */

/**
 * Makes demonstration Menu Item content from pre-defined data.
 *
 * The menu item contents come from a JSON file.
 */
class UaqsDemoNavigationMigration extends UaqsMenuLinksMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'parent_id',
      t('Make demonstration UAQS Navigation menu from pre-defined data.'));

    // Documented lists of source data fields.
    $menu_fields = array(
      'menu_name' => t('Name of the menu within which this link appears'),
      'link_path' => t('Menu item link Drupal path or external path'),
      'link_title' => t('Text displayed for this menu link'),
      'external' => t('Whether the link is a full external URL (1 = external, 0 = internal)'),
      'expanded' => t('Determine whether a menu item is expanded'),
      'weight' => t('Weight to order links at the same depth in a menu'),
    );

    $fields = $this->getSourceKeyField() + $this->getParentLinkField() + $menu_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    $this->addSimpleMappings(array_keys($menu_fields));
  }

  /**
   * Implementation of prepareRow(), to convert aliases to node paths.
   *
   * See the Migration migrate_example code, in particular wine.inc.
   *
   * @param object $row
   *   Object containing raw source data (from the JSON file).
   *
   * @return bool
   *   TRUE to process this row, FALSE to have the source skip it.
   */
  public function prepareRow($row) {
    // Recommended boilerplate section: invoke the parent classes on the
    // current row first, and pass on their status (whether to process
    // or skip the row).
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }
    $node_path = drupal_lookup_path('source', $row->link_path);
    if ($node_path) {
      $row->link_path = $node_path;
      // Make node path available to complete callback.
      $row->node_path = $node_path;
    }
    return TRUE;
  }

  /**
   * Implementation of MigrateDestination::complete().
   *
   * The default url alias uses menu tokens, but in migration, menu entries
   * are migrated after their nodes, so at the time nodes are created, their
   * menu tokens do not exist. In order for the url aliases to be correct, it
   * is necessary to save the nodes referred to by a menu entry after the menu
   * entry is created, via complete callback on the menu link migration.
   *
   * @param object $entity
   *   The menu entry that has just been migrated.
   * @param object $row
   *   Object containing raw source data.
   */
  public function complete(stdClass $entity, stdClass $row) {
    if (!empty($row->node_path)) {
      // Find the node referred to by the menu link.
      $node_menu = menu_get_object("node", 1, $row->node_path);
      if ($node_menu) {
        // The token cache needs to be rebuilt. The tokens are wrong due to
        // Migrate already likely having saved this node without its menu
        // entry earlier in the request.
        token_clear_cache();
        // The following is required to fill out the node object for saving.
        node_object_prepare($node_menu);
        if (isset($node_menu->menu['mlid'])) {
          // Calling node_object_prepare(), node_save() will cause data loss
          // unless we do this. Normally this happens within the Form API.
          $node_menu->menu['enabled'] = TRUE;
        }
        // Save the node again, now that the menu entry token is available.
        node_save($node_menu);
      }
    }
  }

}
