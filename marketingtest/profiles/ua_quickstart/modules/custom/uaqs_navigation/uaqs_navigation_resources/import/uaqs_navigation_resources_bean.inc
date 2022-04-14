<?php

/**
 * @file
 * Add content to demonstrate a UAQS Navigation Resources Menu Bean.
 */

/**
 *
 *
 * The field contents come from a JSON file.
 */
class UaqsNavigationResourcesBeanMigration extends UaqsPlacedBeanMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'menu_bean', 'ua_zen', 'header_ua_utilities', BLOCK_VISIBILITY_LISTED, '*', 1,
      t('Make demonstration UAQS Navigation Resources content from pre-defined data.'));

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
    $row->data = (array) $row->data;
    return TRUE;
  }
}
