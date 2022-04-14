<?php

/**
 * @file
 * Add content to demonstrate the UAQS Alphabetical List feature.
 */

/**
 * Makes demonstration UAQS Alphabetical List majors from pre-defined data.
 *
 * Majors come from a local JSON-formatted text file.
 *
 * @see UaqsAlphabeticalListMajorsMigration
 */
class UaqsAlphabeticalListMajorsMigration extends UaqsNodeMigration {
  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_major',
      t('Make demonstration UAQS Major content from pre-defined data.'));

    // Documented lists of source data fields:.
    // See uaqs_major uaqs_alphabetical_list.features.field_instance.inc
    // First, the node title field...
    $title_field = array(
      'title' => t('Title'),
    );

    // Next, the single-value text fielda...
    $single_value_fields = array(
      'uaqs_link'    => t('Link settings'),
      'uaqs_link_title' => t('Link settings title'),
    );

    // Then the multi-value text fields and terms...
    $multi_value_fields = array(
      'uaqs_index_letter' => t('Alpha index letters'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $title_field + $single_value_fields + $multi_value_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // The title has no prefix.
    $this->addSimpleMappings(array('title'));
    $this->addFieldMapping('title_field', 'title', FALSE);
    $this->addFieldMapping('field_uaqs_link', 'uaqs_link', FALSE);
    $this->addFieldMapping('field_uaqs_link:title', 'uaqs_link_title', FALSE);

    // Multi-value fields need an explicit sparator.
    foreach (array_keys($multi_value_fields) as $src_field) {
      $this->addFieldMapping('field_' . $src_field, $src_field)
           ->separator('|');
    }
  }
}