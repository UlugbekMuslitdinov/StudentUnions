<?php
/**
 * @file
 * Add content to demonstrate a UAQS Block Types - Call To Action Bean.
 */

/**
 * The field contents come from a JSON file.
 */
class UaqsBlockTypesCallToActionBeanMigration extends UaqsPlacedBeanMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_call_to_action', 'ua_zen', 'content', BLOCK_VISIBILITY_LISTED, '*', 1,
      t('Make Call To Action Bean Block content from pre-defined data.'));

    // Documented list of source data fields.
    $data_fields = array(
      'label' => t('Descriptive title that the administrative interface uses'),
      'title' => t('Title'),
      'data' => t('Data'),
      'uaqs_link_title' => t('Link title'),
      'uaqs_link_attributes' => t('Link attributes'),
      'uaqs_link' => t('Link'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // JSON names to fields mappings.
    $this->addSimpleMappings(array('label'));
    $this->addSimpleMappings(array('title'));
    $this->addSimpleMappings(array('data'));

    // We need to add the field names here.
    $this->addFieldMapping('field_uaqs_link:title', 'uaqs_link_title');
    $this->addFieldMapping('field_uaqs_link:attributes', 'uaqs_link_attributes');
    $this->addFieldMapping('field_uaqs_link', 'uaqs_link');
  }

  public function prepareRow($row) {
    $row->data = json_decode(json_encode($row->data), JSON_OBJECT_AS_ARRAY);
    $row->uaqs_link_attributes = json_decode(json_encode($row->uaqs_link_attributes), JSON_OBJECT_AS_ARRAY);
    return TRUE;
  }
}
