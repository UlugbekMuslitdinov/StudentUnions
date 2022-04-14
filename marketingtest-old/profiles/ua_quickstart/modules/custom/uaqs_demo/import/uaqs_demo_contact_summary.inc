<?php

/**
 * @file
 * Add content to demonstrate a UAQS Contact Summary block.
 */

/**
 * Makes demonstration UAQS Contact Summary bean content from pre-defined data.
 *
 * The UAQS Block Types feature for fieldable blocks based on the Bean module
 * provides the entity used for this.
 *
 * The field contents come from a JSON file.
 */
class UaqsDemoContactSummaryMigration extends UaqsBeanMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_contact_summary',
      t('Make demonstration UAQS Contact Summary content from pre-defined data.'));

    // Documented lists of source data fields.
    // See uaqs_block_types.features.field_instance.inc.
    $data_fields = array(
      'label' => t('Descriptive title that the administrative interface uses'),
      'uaqs_contact_address' => t('Postal address'),
      'uaqs_contact_mail_link' => t('Email address'),
      'uaqs_contact_phone' => t('Phone number'),
    );

    // Titles for links...
    $link_title_fields = array(
      'uaqs_contact_mail_link_title' => t('Email address title'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields + $link_title_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // JSON names to fields mappings.
    $this->addSimpleMappings(array('label'));

    $this->addFieldMapping('field_uaqs_contact_address', 'uaqs_contact_address')
         ->separator('|');
    $this->addFieldMapping('field_uaqs_contact_mail_link', 'uaqs_contact_mail_link');
    $this->addFieldMapping('field_uaqs_contact_phone', 'uaqs_contact_phone');

    $this->addFieldMapping('field_uaqs_contact_mail_link:title', 'uaqs_contact_mail_link_title');
  }

}
