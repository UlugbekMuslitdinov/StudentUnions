<?php

/**
 * @file
 * Add content to demonstrate a UAQS Navigation Resources Menu Bean.
 */

/**
 * The field contents come from a JSON file.
 */
class UaqsNavigationSelectMenuBeanMigration extends UaqsPlacedBeanMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_select_menu', 'ua_zen', 'header_2', BLOCK_VISIBILITY_LISTED, '*', 1,
      t('Make demonstration UAQS Navigation Select Menu content from pre-defined data.'));

    // Documented lists of source data fields.
    // See uaqs_block_types.features.field_instance.inc.
    $data_fields = array(
      'label' => t('Descriptive title that the administrative interface uses'),
      'data' => t('Data'),
      'menu_name' => t('Set which menu to use in this menu bean'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // JSON names to fields mappings.
    $this->addSimpleMappings(array('label'));

    // The title has no prefix.
    $this->addSimpleMappings(array('title'));

    // JSON names to fields mappings.
    $this->addSimpleMappings(array('data'));

  }

  public function prepareRow($row) {
    $row->data = json_decode(json_encode($row->data), JSON_OBJECT_AS_ARRAY);

    return TRUE;
  }
}
