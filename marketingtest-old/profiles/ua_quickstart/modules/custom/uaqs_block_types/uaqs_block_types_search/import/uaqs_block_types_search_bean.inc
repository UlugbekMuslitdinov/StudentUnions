<?php
/**
 * @file
 * Add content to demonstrate a UAQS Block Types - Search Bean.
 */

/**
 * The field contents come from a JSON file.
 */
class UaqsBlockTypesSearchBeanMigration extends UaqsPlacedBeanMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_search', 'ua_zen', 'content', BLOCK_VISIBILITY_LISTED, '*', 1,
      t('Make Search Bean Block content from pre-defined data.'));

    // Documented lists of source data fields.
    // See uaqs_block_types.features.field_instance.inc.
    $data_fields = array(
      'label' => t('Descriptive title that the administrative interface uses'),
      'data' => t('Data'),
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

