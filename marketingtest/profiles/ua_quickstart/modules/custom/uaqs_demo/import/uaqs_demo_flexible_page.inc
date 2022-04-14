<?php

/**
 * @file
 * Add content to demonstrate the UAQS Flexible Page feature.
 *
 * The main contributed Migrate module does not support the Paragraphs-based
 * entities that are the main point of a UAQS Flexible Page, but the Paragraphs
 * module itself includes Migrate support.
 *
 * @see https://www.drupal.org/node/2271181
 */

/**
 * Defines migration into the UAQS Plain Text type of Paragraphs entity.
 */
class UaqsDemoPlainTextMigration extends UaqsParagraphsItemMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_plain_text', 'field_uaqs_main_content',
      t('Populate demonstration UAQS Plain Text entities (based on Paragraphs).'));

    // Fields to import to the bundle.
    $data_fields = array(
      'uaqs_text_area' => t('Generic multi-line text area'),
      'path' => t('URL path settings'),
      'pathauto' => t('Pathauto flag: generate automatic URL alias')
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    $this->addSimpleMappings(array('path'));
    $this->addFieldMapping('pathauto', 'pathauto')
         ->defaultValue(0);
    // Map JSON names to simple content type fields and subfields.
    $this->addFieldMapping('field_uaqs_text_area', 'uaqs_text_area');
    // Allow limited HTML markup in the text area field.
    $this->addFieldMapping('field_uaqs_text_area:format')
         ->defaultValue('uaqs_textual_content');
  }

}

/**
 * Defines migration into the UAQS Headed Text type of Paragraphs entity.
 */
class UaqsDemoHeadedTextMigration extends UaqsParagraphsItemMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_headed_text', 'field_uaqs_main_content',
      t('Populate demonstration UAQS Headed Text entities (based on Paragraphs).'));

    // Fields to import to the bundle.
    $data_fields = array(
      'uaqs_summary' => t('Generic multi-line text area'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // Map JSON names to simple content type fields and subfields.
    $this->addFieldMapping('field_uaqs_summary', 'uaqs_summary');
    // Allow limited HTML markup in the text area field.
    $this->addFieldMapping('field_uaqs_summary:format')
         ->defaultValue('uaqs_standard');
  }

}

/**
 * Defines migration into the UAQS Column Image type of Paragraphs entity.
 */
class UaqsDemoColumnImageMigration extends UaqsParagraphsItemMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_column_image', 'field_uaqs_main_content',
      t('Populate demonstration UAQS Column Image entities (based on Paragraphs).'));
    // Paragraphs view_mode
    $paragraphs_core = array (
      'view_mode' => t('View Mode'),
    );
    // Fields to import to the bundle.
    $data_fields = array(
      'uaqs_caption_text' => t('Image caption'),
      'uaqs_image_credit' => t('Image source or copyright holder'),
    );
    // Image fields...
    $image_src_field = 'uaqs_photo';
    $image_fields = array(
      $image_src_field => t('Image to place in content'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $paragraphs_core + $data_fields + $image_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    $this->addSimpleMappings(array('view_mode'));

    // Map JSON names to simple content type fields and subfields.
    $this->addFieldMapping('field_uaqs_caption_text', 'uaqs_caption_text');
    $this->addFieldMapping('field_uaqs_image_credit', 'uaqs_image_credit');

    // Images.
    $image_dst_field = 'field_' . $image_src_field;
    $this->addFieldMapping($image_dst_field, $image_src_field)
         ->separator('|');
    $this->addFieldMapping($image_dst_field . ':file_replace')
         ->defaultValue(FILE_EXISTS_REPLACE);
    $this->addFieldMapping($image_dst_field . ':file_class')
         ->defaultValue('MigrateFileUri');
    $this->addFieldMapping($image_dst_field . ':source_dir')
         ->defaultValue($this->imagePath());
  }

}

/**
 * Defines migration into the UAQS Extra Info type of Paragraphs entity.
 */
class UaqsDemoExtraInfoMigration extends UaqsParagraphsItemMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_extra_info', 'field_uaqs_main_content',
      t('Populate demonstration UAQS Extra Info entities (based on Paragraphs).'));

    // Fields to import to the bundle.
    $data_fields = array(
      'uaqs_link' => t('More information links'),
    );
    // Titles for link...
    $link_title_fields = array(
      'uaqs_link_title' => t('More information link title'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields + $link_title_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // Map JSON names to simple content type fields and subfields.
    $this->addFieldMapping('field_uaqs_link', 'uaqs_link');
    // Link title is a special case.
    $this->addFieldMapping('field_uaqs_link:title', 'uaqs_link_title');

  }

}

/**
 * Defines migration into the UAQS File Attachment type of Paragraphs entity.
 */
class UaqsDemoFileAttachmentMigration extends UaqsParagraphsItemMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_file_download', 'field_uaqs_main_content',
      t('Populate demonstration UAQS File Attachment entities (based on Paragraphs).'));

    // The single-value text fielda...
    $single_value_fields = array(
      'uaqs_download_name' => t('Name'),
      'uaqs_download_description' => t('Description'),
    );
    // File fields...
    $file_src_field = 'uaqs_download_file';
    $file_fields = array(
      $file_src_field => t('Attachment filename'),
      $file_src_field . '_description' => t('Attachment description'),
    );
    // Image fields...
    $image_src_field = 'uaqs_download_preview';
    $image_fields = array(
      $image_src_field => t('Download Preview'),
      $image_src_field . '_title' => t('Photo title'),
      $image_src_field . '_alt' => t('Photo alt text'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $single_value_fields + $file_fields + $image_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // One-to-one correspondence: JSON names and simple content type fields.
    foreach (array_keys($single_value_fields) as $src_field) {
      $this->addFieldMapping('field_' . $src_field, $src_field);
    }

    // Images and attachments.
    foreach (array($image_src_field, $file_src_field) as $src_field) {
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

    // Attachment description field.
    $label = 'description';
    $this->addFieldMapping('field_' . $file_src_field . ':' . $label, $file_src_field . '_' . $label)
         ->separator('|');
  }
}

/**
 * Defines migration into the UAQS Card Deck type of Paragraphs entity.
 */
class UaqsDemoParagraphCardDeckMigration extends UaqsParagraphsItemMigration {
  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_card_deck', 'field_uaqs_main_content',
      t('Populate demonstration UAQS Card Deck entities (based on Paragraphs).'));
    // Paragraphs view_mode
    $paragraphs_core = array (
      'view_mode' => t('View Mode'),
    );
    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $paragraphs_core;

    $this->addSimpleMappings(array('view_mode'));
    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

  }
}

/**
 * Populate the uaqs_card field collection within UAQS the card deck paragraphs.
 */
class UaqsDemoCardDeckMigration extends UaqsParagraphsFieldCollectionMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'field_uaqs_cards', 'uaqs_card_deck_id', 'UaqsDemoParagraphCardDeck',
      t('Populate demonstration UAQS Content Chunks - Card Deck field collections.'));

    // Data fields.
    $data_fields = array(
      'uaqs_short_title' => t('Short Title'),
      'uaqs_summary' => t('Summary'),
    );

    // Image fields...
    $image_src_field = 'uaqs_photo';
    $image_fields = array(
      $image_src_field => t('Image to place in content'),
    );

    $link_fields = array(
      'uaqs_links' => t('Links'),
      'uaqs_links_titles' => t('Link titles'),
      'uaqs_links_attributes' => t('Link attributes'),
    );

    $image_fields = array(
      'uaqs_photo' => t('Image to place in content'),
    );

    $fields = $this->getSourceKeyField() + $this->getForeignKeyField() + $data_fields + $image_fields + $link_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);
    $this->addFieldMapping('field_uaqs_links', 'uaqs_links', FALSE);
    $this->addFieldMapping('field_uaqs_links:title', 'uaqs_links_titles', FALSE);
    $this->addFieldMapping('field_uaqs_links:attributes', 'uaqs_links_attributes', FALSE);

    foreach (array_keys($data_fields) as $src_field) {
      $this->addFieldMapping('field_' . $src_field, $src_field);
    }

    // Allow limited HTML markup in the summary field.
    $this->addFieldMapping('field_uaqs_summary:format')
         ->defaultValue('uaqs_standard');

    // Images.
    $image_dst_field = 'field_' . $image_src_field;
    $this->addFieldMapping($image_dst_field, $image_src_field)
         ->separator('|');
    $this->addFieldMapping($image_dst_field . ':file_replace')
         ->defaultValue(FILE_EXISTS_REPLACE);
    $this->addFieldMapping($image_dst_field . ':file_class')
         ->defaultValue('MigrateFileUri');
    $this->addFieldMapping($image_dst_field . ':source_dir')
         ->defaultValue($this->imagePath());
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

/**
 * Defines migration into the UAQS Panel Group type of Paragraphs entity.
 */
class UaqsDemoParagraphPanelGroupMigration extends UaqsParagraphsItemMigration {
  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_panel_group', 'field_uaqs_main_content',
      t('Populate demonstration UAQS Panel Group entities (based on Paragraphs).'));
    // Paragraphs view_mode
    $paragraphs_core = array (
      'view_mode' => t('View Mode'),
    );
    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $paragraphs_core;
    $this->addSimpleMappings(array('view_mode'));

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

  }
}

/**
 * Populate field collection within UAQS Panel Group
 */
class UaqsDemoPanelGroupMigration extends UaqsParagraphsFieldCollectionMigration {
  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'field_uaqs_panel', 'uaqs_panel_group_id', 'UaqsDemoParagraphPanelGroup',
      t('Populate demonstration UAQS Content Chunks - Panel Group field collections.'));

    // Data fields.
    $data_fields = array(
      'uaqs_setting_collapse' => t('Collapsed'),
      'uaqs_short_title' => t('Panel heading'),
      'uaqs_summary' => t('Panel body'),
    );

    $fields = $this->getSourceKeyField() + $this->getForeignKeyField() + $data_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    foreach (array_keys($data_fields) as $src_field) {
      $this->addFieldMapping('field_' . $src_field, $src_field);
    }

    // Allow limited HTML markup in the summary field.
    $this->addFieldMapping('field_uaqs_summary:format')
         ->defaultValue('uaqs_standard');
  }
}
/**
 * Defines migration into the UAQS Carousel type of Paragraphs entity.
 */
class UaqsDemoParagraphCarouselMigration extends UaqsParagraphsItemMigration {
  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_carousel', 'field_uaqs_main_content',
      t('Populate demonstration UAQS Carousel entities (based on Paragraphs).'));
    // Paragraphs view_mode
    $paragraphs_core = array (
      'view_mode' => t('View Mode'),
    );
    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $paragraphs_core;
    $this->addSimpleMappings(array('view_mode'));

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

  }
}

/**
 * Populate the Contacts field collection within UAQS News content.
 */
class UaqsDemoCarouselMigration extends UaqsParagraphsFieldCollectionMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'field_uaqs_carousel', 'uaqs_carousel_id', 'UaqsDemoParagraphCarousel',
      t('Populate demonstration UAQS Content Chunks - Carousel field collections'));

    // Data fields.
    $data_fields = array(
      'uaqs_short_title' => t('Carousel Captions'),
    );

    // Image fields...
    $image_src_field = 'uaqs_photo';
    $image_fields = array(
      $image_src_field => t('Photo'),
    );


    $fields = $this->getSourceKeyField() + $this->getForeignKeyField() + $data_fields + $image_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);


    foreach (array_keys($data_fields) as $src_field) {
      $this->addFieldMapping('field_' . $src_field, $src_field);
    }

    // Images.
    $image_dst_field = 'field_' . $image_src_field;
    $this->addFieldMapping($image_dst_field, $image_src_field)
         ->separator('|');
    $this->addFieldMapping($image_dst_field . ':file_replace')
         ->defaultValue(FILE_EXISTS_REPLACE);
    $this->addFieldMapping($image_dst_field . ':file_class')
         ->defaultValue('MigrateFileUri');
    $this->addFieldMapping($image_dst_field . ':source_dir')
         ->defaultValue($this->imagePath());
  }
}

/**
 * Defines migration into the UAQS Marquee type of Paragraphs entity.
 */
class UaqsDemoMarqueeMigration extends UaqsParagraphsItemMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_content_chunks_marquee', 'field_uaqs_main_content',
      t('Populate demonstration UAQS Marquee entities (based on Paragraphs).'));
    // Paragraphs view_mode
    $paragraphs_core = array (
      'view_mode' => t('View Mode'),
    );
    // Fields to import to the bundle.
    $data_fields = array(
      'uaqs_summary_short' => t('Title'),
      'uaqs_summary' => t('Body'),
      'uaqs_link' => t('Read more'),
      'uaqs_setting_bg_attach' => t('Background attachment'),
      'uaqs_setting_bg_size' => t('Background size'),
      'uaqs_setting_text_bg_color' => t('Text box background color')
    );
    // Image fields...
    $image_src_field = 'uaqs_photo';
    $image_fields = array(
      $image_src_field => t('Image to place in content'),
    );

    // Sub-fields for field_uaqs_link.
    $link_fields = array(
      'uaqs_link_title' => t('Read more link title'),
      'uaqs_link_attributes' => t('Read more link attributes'),
    );

    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $paragraphs_core + $data_fields + $image_fields + $link_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    $this->addSimpleMappings(array('view_mode'));
    $this->addFieldMapping('field_uaqs_summary_short', 'uaqs_summary_short');
    $this->addFieldMapping('field_uaqs_setting_bg_attach', 'uaqs_setting_bg_attach');
    $this->addFieldMapping('field_uaqs_setting_bg_size', 'uaqs_setting_bg_size');
    $this->addFieldMapping('field_uaqs_setting_text_bg_color', 'uaqs_setting_text_bg_color');

    // Images.
    $image_dst_field = 'field_' . $image_src_field;
    $this->addFieldMapping($image_dst_field, $image_src_field)
         ->separator('|');
    $this->addFieldMapping($image_dst_field . ':file_replace')
         ->defaultValue(FILE_EXISTS_REPLACE);
    $this->addFieldMapping($image_dst_field . ':file_class')
         ->defaultValue('MigrateFileUri');
    $this->addFieldMapping($image_dst_field . ':source_dir')
         ->defaultValue($this->imagePath());
    // Map JSON names to simple content type fields and subfields.
    $this->addFieldMapping('field_uaqs_summary', 'uaqs_summary');
    // Allow limited HTML markup in the text area field.
    $this->addFieldMapping('field_uaqs_summary:format')
         ->defaultValue('uaqs_standard');
    // Map JSON names to simple content type fields and subfields.
    $this->addFieldMapping('field_uaqs_link', 'uaqs_link');
    // Link title is a special case.
    $this->addFieldMapping('field_uaqs_link:title', 'uaqs_link_title');
    // Allow for link attributes, such as classes.
    $this->addFieldMapping('field_uaqs_link:attributes', 'uaqs_link_attributes');
  }

  /**
   * Implementation of prepareRow(), to provide a link attributes array.
   *
   * @param object $row
   *   Object containing raw source data.
   *
   * @return bool
   *   TRUE to process this row, FALSE to have the source skip it.
   */
  public function prepareRow($row) {

    // Allow the parent to vote for skipping the row.
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }

    // Compute an array of attributes for the link field.
    $attributes = array(
      'class' => $row->uaqs_link_classes,
    );
    $row->uaqs_link_attributes = $attributes;
    return TRUE;
  }

}

/**
 * Defines migration into the UAQS Full width media row type of Paragraphs entity.
 */
class UaqsDemoFullWidthMediaRowMigration extends UaqsParagraphsItemMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_full_width_media_row', 'field_uaqs_main_content',
      t('Populate demonstration UAQS Full width media row entities (based on Paragraphs).'));
    // Paragraphs view_mode
    $paragraphs_core = array (
      'view_mode' => t('View Mode'),
      'bottom_spacing' => t('Bottom Spacing'),
    );
    // Fields to import to the bundle.
    $data_fields = array(
      'uaqs_summary_short' => t('Title'),
      'uaqs_summary' => t('Body'),
      'uaqs_setting_bg_attach' => t('Background attachment'),
      'uaqs_setting_bg_size' => t('Background size'),
      'uaqs_setting_text_bg_color' => t('Text box background color')
    );

    $link_fields = array(
      'uaqs_links' => t('Links'),
      'uaqs_links_titles' => t('Link titles'),
      'uaqs_links_attributes' => t('Link attributes'),
    );

    // Image fields...
    $image_src_field = 'uaqs_photo';
    $image_fields = array(
      $image_src_field => t('Image to place in content'),
    );


    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $paragraphs_core + $data_fields + $image_fields + $link_fields ;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    $this->addSimpleMappings(array('view_mode'));
    $this->addSimpleMappings(array('bottom_spacing'));
    $this->addFieldMapping('field_uaqs_summary_short', 'uaqs_summary_short');
    $this->addFieldMapping('field_uaqs_setting_bg_attach', 'uaqs_setting_bg_attach');
    $this->addFieldMapping('field_uaqs_setting_bg_size', 'uaqs_setting_bg_size');
    $this->addFieldMapping('field_uaqs_setting_text_bg_color', 'uaqs_setting_text_bg_color');

    $this->addFieldMapping('field_uaqs_links', 'uaqs_links', FALSE);
    $this->addFieldMapping('field_uaqs_links:title', 'uaqs_links_titles', FALSE);
    $this->addFieldMapping('field_uaqs_links:attributes', 'uaqs_links_attributes', FALSE);

    // Images.
    $image_dst_field = 'field_' . $image_src_field;
    $this->addFieldMapping($image_dst_field, $image_src_field)
         ->separator('|');
    $this->addFieldMapping($image_dst_field . ':file_replace')
         ->defaultValue(FILE_EXISTS_REPLACE);
    $this->addFieldMapping($image_dst_field . ':file_class')
         ->defaultValue('MigrateFileUri');
    $this->addFieldMapping($image_dst_field . ':source_dir')
         ->defaultValue($this->imagePath());
    // Map JSON names to simple content type fields and subfields.
    $this->addFieldMapping('field_uaqs_summary', 'uaqs_summary');
    // Allow limited HTML markup in the text area field.
    $this->addFieldMapping('field_uaqs_summary:format')
         ->defaultValue('uaqs_standard');
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

/**
 * Defines migration into the UAQS view type of Paragraphs entity.
 */
class UaqsDemoViewMigration extends UaqsParagraphsItemMigration {

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_content_chunks_view', 'field_uaqs_main_content',
      t('Populate demonstration views.'));
    // Paragraphs view_mode
    $paragraphs_core = array (
      'view_mode' => t('View Mode'),
    );
    // Fields to import to the bundle.
    $data_fields = array(
      'uaqs_view' => t('View to be embedded'),
      'uaqs_view_arguments' => t('Argument(s) that view should use as contexual filter')
    );
    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $paragraphs_core + $data_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    $this->addSimpleMappings(array('view_mode'));

    // Map JSON names to simple content type fields and subfields.
    $this->addFieldMapping('field_uaqs_view', 'uaqs_view');
    $this->addFieldMapping('field_uaqs_view:vargs', 'uaqs_view_arguments');
  }
}

/**
 * Makes demonstration UAQS Flexible Page content from pre-defined data.
 *
 * This migration imports a small part of the UAQS FlexiblePage content directly
 * from a JSON file, but most of it is encapsulated in a series of entities
 * from the Paragraphs module, which get their own migrations (see above).
 */
class UaqsDemoFlexiblePageMigration extends UaqsNodeMigration {

  /**
   * Numeric ID of the JSON file entry for the front page.
   */
  const FRONT_PAGE_SOURCE_ID = 4;

  /**
   * The UAQS Flexible Page (as a Drupal node) to use as the site front page.
   *
   * @return string
   *   The non-aliased Drupal node path, or 'node' if there is none.
   */
  public function getFrontPageNode() {
    $dest_keys = $this->getMap()->lookupDestinationID(array(self::FRONT_PAGE_SOURCE_ID));
    if (is_array($dest_keys)) {
      $front_nid = reset($dest_keys);
      return "node/{$front_nid}";
    }
    else {
      return 'node';
    }
  }

  /**
   * Constructor.
   *
   * @param array $arguments
   *   Arguments for the parent constructor (Migration standard behavior).
   */
  public function __construct(array $arguments) {
    parent::__construct($arguments, 'uaqs_flexible_page',
      t('Make demonstration UAQS Flexible Page content from pre-defined data.'));

    // Source data fields:
    $data_fields = array(
      'title' => t('Title'),
      'exclude_node_title' => t('Exclude node title'),
      'uaqs_flexible_page_subtitle' => t('Sub-title'),
      'path' => t('URL path settings'),
      'uaqs_main_content' => t('Main Content'),
      'uaqs_summary' => t('Summary')
    );

    // Image fields...
    $image_src_field = 'uaqs_photo';
    $image_fields = array(
      $image_src_field => t('Photo filename'),
      $image_src_field . '_title' => t('Photo title'),
      $image_src_field . '_alt' => t('Photo alt text'),
    );

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
    // All the fields to migrate.
    $fields = $this->getSourceKeyField() + $data_fields + $image_fields;

    // Source definition.
    $this->source = new MigrateSourceJSON($this->jsonFilePath(), $this->getSourceKeyFieldName(), $fields);

    // Allow limited HTML markup in the summary field.
    $this->addFieldMapping('field_uaqs_summary:format')
         ->defaultValue('uaqs_standard');

    // The title and path have no prefixes.
    $this->addSimpleMappings(array('title'));
    $this->addSimpleMappings(array('path'));
    $this->addFieldMapping('field_uaqs_flexible_page_sub', 'uaqs_flexible_page_subtitle');
    $this->addFieldMapping('field_uaqs_summary', 'uaqs_summary');

    // Paragraphs (UAQS Content Chunks).
    $this->addFieldMapping('field_uaqs_main_content', 'uaqs_main_content')
         ->separator('|')
         ->sourceMigration(array(
           'UaqsDemoPlainText',
           'UaqsDemoHeadedText',
           'UaqsDemoColumnImage',
           'UaqsDemoParagraphCardDeck',
           'UaqsDemoParagraphPanelGroup',
           'UaqsDemoParagraphCarousel',
           'UaqsDemoMarquee',
           'UaqsDemoFullWidthMediaRow',
           'UaqsDemoView',
         ));
  }

  public function complete($node, stdClass $row) {
    if(module_exists('exclude_node_title')) {
      exclude_node_title_set_flag($node, $row->exclude_node_title);
    }
    return TRUE;
  }

}
