<?php

/**
 * @file
 * Add content to demonstrate a UAQS Block Types - Quick Links block.
 */

/**
 * Makes demonstration UA Quickstart Quick Links bean content from pre-defined data.
 *
 * The UAQS Block Types feature for fieldable blocks based on the Bean module
 * provides the entity used for this.
 *
 * The field contents come from a JSON file.
 */
class UaqsDemoQuickLinksMigration extends UaqsPlacedBeanMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_quick_links', 'ua_zen', 'content', BLOCK_VISIBILITY_LISTED, '*', 1,
      t('Make demonstration UA Quickstart Quick Links content from pre-defined data.'));

    // Documented lists of source data fields.
    // See uaqs_block_types.features.field_instance.inc.
    $data_fields = array(
      'label' => t('Descriptive title that the administrative interface uses'),
      'title' => t('Title'),
      'uaqs_links' => t('Links'),
      'uaqs_links_titles' => t('Link titles'),
      'uaqs_links_attributes' => t('Link attributes'),
    );
    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields;
    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);
    $this->addSimpleMappings(array('label'));
    $this->addSimpleMappings(array('title'));
    $this->addFieldMapping('field_uaqs_links', 'uaqs_links');
    $this->addFieldMapping('field_uaqs_links:title', 'uaqs_links_titles');
    $this->addFieldMapping('field_uaqs_links:attributes', 'uaqs_links_attributes');
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
