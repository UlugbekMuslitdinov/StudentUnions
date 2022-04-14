<?php

/**
 * @file
 * Add content to demonstrate a UAQS CTA Card block.
 */

/**
 * Makes demonstration UAQS CTA Card bean content from pre-defined data.
 *
 * The UAQS Block Types feature for fieldable blocks based on the Bean module
 * provides the entity used for this.
 *
 * The field contents come from a JSON file.
 */
class UaqsDemoBeanRelatedLinksMigration extends UaqsPlacedBeanMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_related_links', 'ua_zen', 'sidebar_second', BLOCK_VISIBILITY_LISTED, '<front>', 1, t('Make demonstration UAQS Related Links content from pre-defined data.'));

    // Documented lists of source data fields.
    // See uaqs_block_types.features.field_instance.inc.
    $data_fields = array(
      'label' => t('Descriptive title that the administrative interface uses'),
      'title' => t('The human-readable name of this bean.'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // JSON names to fields mappings.
    $this->addSimpleMappings(array('label'));

    // The title has no prefix.
    $this->addSimpleMappings(array('title'));
  }
}

/**
 * Populate the uaqs_card field collection within UAQS the card deck paragraphs.
 */
class UaqsDemoCtaMigration extends UaqsBeanFieldCollectionMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'field_uaqs_cta', 'uaqs_related_links_id', 'UaqsDemoBeanRelatedLinks', t('Populate demonstration UAQS Block Types - Related Links field collections.'));

    // Data fields.
    $data_fields = array(
      'uaqs_short_title' => t('Short Title'),
      'uaqs_summary' => t('Summary'),
    );

    $link_fields = array(
      'uaqs_links' => t('Links'),
      'uaqs_links_titles' => t('Link titles'),
      'uaqs_links_attributes' => t('Link attributes'),
    );

    $fields = $this->getSourceKeyField() + $this->getForeignKeyField() + $data_fields + $link_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);
    $this->addFieldMapping('field_uaqs_links', 'uaqs_links', FALSE);
    $this->addFieldMapping('field_uaqs_links:title', 'uaqs_links_titles', FALSE)->defaultValue('uaqs_standard');
    $this->addFieldMapping('field_uaqs_links:attributes', 'uaqs_links_attributes', FALSE)->defaultValue(array('class'=>'btn btn-hollow btn-block'));


    foreach (array_keys($data_fields) as $src_field) {
      $this->addFieldMapping('field_' . $src_field, $src_field);
    }

    // Allow limited HTML markup in the summary field.
    $this->addFieldMapping('field_uaqs_summary:format')->defaultValue('uaqs_standard');
  }

  public function prepareRow($row) {
    $links = (array) $row->uaqs_links;
    $link_attributes = array();
    $link_titles = array();
    $link_urls = array();
    foreach($links as $link){
      $link_urls[] = $link->url;
      $link_titles[] = $link->title;
      $link_attributes[] = (array) $link->attributes;
    }
    $row->uaqs_links = (array) $link_urls;
    $row->uaqs_links_titles = (array) $link_titles;
    $row->uaqs_links_attributes = (array) $link_attributes;
    return TRUE;
  }
}
