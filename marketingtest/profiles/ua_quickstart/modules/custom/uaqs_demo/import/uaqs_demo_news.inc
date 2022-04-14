<?php

/**
 * @file
 * Add content to demonstrate the UAQS News feature.
 */

/**
 * Makes demonstration UAQS News content from pre-defined data.
 *
 * This migration imports most of the UAQS News content from a JSON file, but
 * the contacts list for the news item is a distinct entity and needs its own
 * migration (see below).
 *
 * @see https://www.drupal.org/node/1152160
 */
class UaqsDemoNewsMigration extends UaqsNodeMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_news',
      t('Make demonstration UAQS News content from pre-defined data.'));

    // Documented lists of source data fields.
    // See uaqs_news uaqs_news.features.field_instance.inc
    // First, the node title field...
    $title_field = array(
      'title' => t('Title'),
    );
    // Core node settings
    $node_core = array(
      'promote' => t('Promoted to front page'),
    );

    // The single-value text fielda...
    $single_value_fields = array(
      'uaqs_summary_short' => t('Sub-title'),
      'uaqs_short_title' => t('Short title'),
      'uaqs_byline' => t('Byline'),
      'uaqs_published' => t('Published'),
      'uaqs_expiration_date' => t('Expiration date'),
      'uaqs_summary' => t('Summary'),
      'uaqs_body' => t('Article body'),
      'uaqs_link' => t('Link to more information'),
    );
    // Titles for links...
    $link_title_fields = array(
      'uaqs_link_title' => t('Information link title'),
    );
    // Content Chunks...
    $content_chunks = array(
      'uaqs_main_content' => t('Main Content'),
    );
    // Image fields...
    $image_src_field = 'uaqs_photo';
    $image_fields = array(
      $image_src_field => t('Photo filename'),
      $image_src_field . '_title' => t('Photo title'),
      $image_src_field . '_alt' => t('Photo alt text'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $title_field + $node_core + $single_value_fields + $link_title_fields + $image_fields + $content_chunks;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // The title has no prefix.
    $this->addSimpleMappings(array('title'));

    $this->addFieldMapping('promote', 'promote', FALSE);

    // One-to-one correspondence: JSON names and simple content type fields.
    foreach (array_keys($single_value_fields) as $src_field) {
      $this->addFieldMapping('field_' . $src_field, $src_field);
    }

    // Link title is a special case.
    $this->addFieldMapping('field_uaqs_link:title', 'uaqs_link_title');

    // Images and attachments.
    foreach (array($image_src_field) as $src_field) {
      $dst_field = 'field_' . $src_field;
      $this->addFieldMapping($dst_field, $src_field)
           ->separator('|');
      $this->addFieldMapping($dst_field . ':file_replace')
           ->defaultValue(FILE_EXISTS_REPLACE);
      $this->addFieldMapping($dst_field . ':file_class')
           ->defaultValue('MigrateFileUri');
      $this->addFieldMapping($dst_field . ':source_dir')
           ->defaultValue($this->imagePath());
    }

    // Image alt and title fields.
    foreach (array('alt', 'title') as $label) {
      $this->addFieldMapping('field_' . $image_src_field . ':' . $label, $image_src_field . '_' . $label)
           ->separator('|');
    }

    // Paragraphs (UAQS Content Chunks).
    $this->addFieldMapping('field_uaqs_main_content', 'uaqs_main_content')
         ->separator('|')
         ->sourceMigration(array(
           'UaqsDemoColumnImage',
           'UaqsDemoExtraInfo',
           'UaqsDemoFileAttachment'
         ));

    // Allow limited HTML markup in the body field.
    $this->addFieldMapping('field_uaqs_body:format')
         ->defaultValue('uaqs_unconstrained');
    // Allow limited HTML markup in the summary field.
    $this->addFieldMapping('field_uaqs_summary:format')
         ->defaultValue('uaqs_standard');
  }

}

/**
 * Populate the Contacts field collection within UAQS News content.
 */
class UaqsDemoNewsContactMigration extends UaqsFieldCollectionMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'field_uaqs_contacts', 'uaqs_news_id', 'UaqsDemoNews',
      t('Populate demonstration UAQS News contact field collections.'));

    // Data fields.
    $data_fields = array(
      'uaqs_contact_name' => t('Contact Name'),
      'uaqs_contact_email' => t('Contact Email'),
      'uaqs_contact_phone' => t('Contact Phone'),
    );

    $fields = $this->getSourceKeyField() + $this->getForeignKeyField() + $data_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    foreach (array_keys($data_fields) as $src_field) {
      $this->addFieldMapping('field_' . $src_field, $src_field);
    }
  }

}
