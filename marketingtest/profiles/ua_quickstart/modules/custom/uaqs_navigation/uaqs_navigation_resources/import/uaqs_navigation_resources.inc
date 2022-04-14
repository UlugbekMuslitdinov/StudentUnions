<?php

/**
 * @file
 * Add content to demonstrate the UAQS Navigation Resources feature.
 */

/**
 * Makes demonstration Menu Item content from pre-defined data.
 *
 * The menu item contents come from a JSON file.
 */
class UaqsNavigationResourcesMigration extends UaqsMenuLinksMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'parent_id',
      t('Make demonstration UAQS Navigation Resources menu from pre-defined data.'));

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
    }
    return TRUE;
  }

}

