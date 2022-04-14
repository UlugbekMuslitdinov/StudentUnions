<?php

/**
 * @file
 * Add content to demonstrate a UAQS Card block.
 */

/**
 * Makes demonstration UAQS Card bean content from pre-defined data.
 *
 * The UAQS Block Types feature for fieldable blocks based on the Bean module
 * provides the entity used for this.
 *
 * The field contents come from a JSON file.
 */
class UaqsDemoCardMigration extends UaqsPlacedBeanMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_card', 'ua_zen', 'content', BLOCK_VISIBILITY_LISTED, '*', 1,
      t('Make demonstration UAQS Card content from pre-defined data.'));

    // Documented lists of source data fields.
    // See uaqs_block_types.features.field_instance.inc.
    $data_fields = array(
      'label' => t('Descriptive title that the administrative interface uses'),
      'title' => t('Title'),
      'uaqs_link' => t('Link'),
      'uaqs_summary' => t('Summary text'),
    );

    // Image fields...
    $image_src_field = 'uaqs_photo';
    $image_fields = array(
      $image_src_field => t('Slide image'),
    );

    // Titles for links...
    $link_title_fields = array(
      'uaqs_link_title' => t('Link title'),
    );

    // Attributes for links...
    $link_attributes_fields = array(
      'uaqs_link_attributes' => t('Link attributes'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields + $link_title_fields + $image_fields + $link_attributes_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // JSON names to fields mappings.
    $this->addSimpleMappings(array('label'));

    // The title has no prefix.
    $this->addSimpleMappings(array('title'));

    $this->addFieldMapping('field_uaqs_link', 'uaqs_link');
    $this->addFieldMapping('field_uaqs_link:attributes','uaqs_link_attributes');
    $this->addFieldMapping('field_uaqs_link:title', 'uaqs_link_title');

    $this->addFieldMapping('field_uaqs_summary', 'uaqs_summary');
    // Allow limited HTML markup in the text area field.
    $this->addFieldMapping('field_uaqs_summary:format')
         ->defaultValue('uaqs_standard');

    // Images.
    $image_dst_field = 'field_' . $image_src_field;
    $this->addFieldMapping($image_dst_field, $image_src_field);
    $this->addFieldMapping($image_dst_field . ':file_replace')
         ->defaultValue(FILE_EXISTS_REPLACE);
    $this->addFieldMapping($image_dst_field . ':file_class')
         ->defaultValue('MigrateFileUri');
    $this->addFieldMapping($image_dst_field . ':source_dir')
         ->defaultValue($this->imagePath());
  }

  public function prepareRow($row) {

    $row->uaqs_link_attributes = (array) $row->uaqs_link_attributes;

    return TRUE;
  }

}
