<?php

/**
 * @file
 * uaqs_content_chunks_card_deck.field_group.inc
 */

/**
 * Implements hook_field_group_info().
 */
function uaqs_content_chunks_card_deck_field_group_info() {
  $field_groups = array();

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_block|field_collection_item|field_uaqs_cards|default';
  $field_group->group_name = 'group_card_block';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Card Block',
    'weight' => '9',
    'children' => array(
      0 => 'field_uaqs_links',
      1 => 'group_card_text',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Block',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-block',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_block|field_collection_item|field_uaqs_cards|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_deck_wrapper|paragraphs_item|uaqs_card_deck|default';
  $field_group->group_name = 'group_card_deck_wrapper';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_card_deck';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card deck wrapper',
    'weight' => '0',
    'children' => array(
      0 => 'group_card_deck',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card deck wrapper',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-deck-wrapper',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_deck_wrapper|paragraphs_item|uaqs_card_deck|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_deck_wrapper|paragraphs_item|uaqs_card_deck|uaqs_borderless_card';
  $field_group->group_name = 'group_card_deck_wrapper';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_card_deck';
  $field_group->mode = 'uaqs_borderless_card';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card deck wrapper',
    'weight' => '0',
    'children' => array(
      0 => 'group_card_deck',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card deck wrapper',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-deck-wrapper',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_deck_wrapper|paragraphs_item|uaqs_card_deck|uaqs_borderless_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_deck_wrapper|paragraphs_item|uaqs_card_deck|uaqs_landing_grid';
  $field_group->group_name = 'group_card_deck_wrapper';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_card_deck';
  $field_group->mode = 'uaqs_landing_grid';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card deck wrapper',
    'weight' => '0',
    'children' => array(
      0 => 'group_card_deck',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card deck wrapper',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-deck-wrapper',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_deck_wrapper|paragraphs_item|uaqs_card_deck|uaqs_landing_grid'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_deck|paragraphs_item|uaqs_card_deck|default';
  $field_group->group_name = 'group_card_deck';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_card_deck';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card_deck_wrapper';
  $field_group->data = array(
    'label' => 'Card Deck',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_cards',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Deck',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-deck',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_deck|paragraphs_item|uaqs_card_deck|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_deck|paragraphs_item|uaqs_card_deck|uaqs_borderless_card';
  $field_group->group_name = 'group_card_deck';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_card_deck';
  $field_group->mode = 'uaqs_borderless_card';
  $field_group->parent_name = 'group_card_deck_wrapper';
  $field_group->data = array(
    'label' => 'Card Deck',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_cards',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Deck',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-deck card-deck-borderless',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_deck|paragraphs_item|uaqs_card_deck|uaqs_borderless_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_deck|paragraphs_item|uaqs_card_deck|uaqs_landing_grid';
  $field_group->group_name = 'group_card_deck';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_card_deck';
  $field_group->mode = 'uaqs_landing_grid';
  $field_group->parent_name = 'group_card_deck_wrapper';
  $field_group->data = array(
    'label' => 'Card Deck',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_cards',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Deck',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-deck',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_deck|paragraphs_item|uaqs_card_deck|uaqs_landing_grid'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_header|field_collection_item|field_uaqs_cards|default';
  $field_group->group_name = 'group_card_header';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Card Header',
    'weight' => '7',
    'children' => array(
      0 => 'group_card_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Header',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-header',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_header|field_collection_item|field_uaqs_cards|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_text|field_collection_item|field_uaqs_cards|default';
  $field_group->group_name = 'group_card_text';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card_block';
  $field_group->data = array(
    'label' => 'Card Text',
    'weight' => '16',
    'children' => array(
      0 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Text',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-text',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_text|field_collection_item|field_uaqs_cards|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_text|field_collection_item|field_uaqs_cards|uaqs_borderless_card';
  $field_group->group_name = 'group_card_text';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_borderless_card';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Card Text',
    'weight' => '4',
    'children' => array(
      0 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Text',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-text text-blue',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_text|field_collection_item|field_uaqs_cards|uaqs_borderless_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_text|field_collection_item|field_uaqs_cards|uaqs_landing_grid';
  $field_group->group_name = 'group_card_text';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_landing_grid';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Card Text',
    'weight' => '6',
    'children' => array(
      0 => 'field_uaqs_summary',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Text',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-text',
        'element' => 'p',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_text|field_collection_item|field_uaqs_cards|uaqs_landing_grid'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card_title|field_collection_item|field_uaqs_cards|default';
  $field_group->group_name = 'group_card_title';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'default';
  $field_group->parent_name = 'group_card_header';
  $field_group->data = array(
    'label' => 'Card Title',
    'weight' => '6',
    'children' => array(
      0 => 'field_uaqs_short_title',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card Title',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-title',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card_title|field_collection_item|field_uaqs_cards|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|field_collection_item|field_uaqs_cards|default';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'default';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'group_card_block',
      2 => 'group_card_header',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|field_collection_item|field_uaqs_cards|default'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|field_collection_item|field_uaqs_cards|uaqs_borderless_card';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_borderless_card';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '0',
    'children' => array(
      0 => 'group_link',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card card-borderless',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_card|field_collection_item|field_uaqs_cards|uaqs_borderless_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_card|field_collection_item|field_uaqs_cards|uaqs_landing_grid';
  $field_group->group_name = 'group_card';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_landing_grid';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_short_title',
      1 => 'group_card_text',
      2 => 'group_links',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Card',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_links',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'card card-landing-grid',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_card|field_collection_item|field_uaqs_cards|uaqs_landing_grid'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_display_settings|paragraphs_item|uaqs_card_deck|form';
  $field_group->group_name = 'group_display_settings';
  $field_group->entity_type = 'paragraphs_item';
  $field_group->bundle = 'uaqs_card_deck';
  $field_group->mode = 'form';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Display Settings',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_setting_deck_width',
    ),
    'format_type' => 'tab',
    'format_settings' => array(
      'formatter' => 'closed',
      'instance_settings' => array(
        'description' => '',
        'classes' => 'group-display-settings field-group-tab',
        'required_fields' => 1,
      ),
    ),
  );
  $field_groups['group_display_settings|paragraphs_item|uaqs_card_deck|form'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = TRUE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_image_link|field_collection_item|field_uaqs_cards|uaqs_borderless_card';
  $field_group->group_name = 'group_image_link';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_borderless_card';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Image link',
    'weight' => '20',
    'children' => array(
      0 => 'field_uaqs_photo',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Image link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_links',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_image_link|field_collection_item|field_uaqs_cards|uaqs_borderless_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_links|field_collection_item|field_uaqs_cards|uaqs_landing_grid';
  $field_group->group_name = 'group_links';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_landing_grid';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Links',
    'weight' => '7',
    'children' => array(
      0 => 'field_uaqs_links',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Links',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-link margin-align-bottom psuedo-link',
        'element' => 'div',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_links|field_collection_item|field_uaqs_cards|uaqs_landing_grid'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|field_collection_item|field_uaqs_cards|uaqs_borderless_card';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_borderless_card';
  $field_group->parent_name = 'group_card';
  $field_group->data = array(
    'label' => 'Link',
    'weight' => '1',
    'children' => array(
      0 => 'field_uaqs_photo',
      1 => 'field_uaqs_short_title',
      2 => 'group_card_text',
      3 => 'group_strong',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_links',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'remove-external-link-icon borderless-link-container mt-0',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|field_collection_item|field_uaqs_cards|uaqs_borderless_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_link|field_collection_item|field_uaqs_cards|uaqs_landing_grid';
  $field_group->group_name = 'group_link';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_landing_grid';
  $field_group->parent_name = '';
  $field_group->data = array(
    'label' => 'Card Link',
    'weight' => '0',
    'children' => array(
      0 => 'field_uaqs_short_title',
      1 => 'group_card_text',
      2 => 'group_links',
    ),
    'format_type' => 'link',
    'format_settings' => array(
      'label' => 'Card Link',
      'instance_settings' => array(
        'link_to' => 'field_uaqs_links',
        'custom_url' => '',
        'custom_url_normalize' => 0,
        'target' => 'default',
        'classes' => 'card card-landing-grid remove-external-link-icon',
      ),
      'formatter' => 'open',
    ),
  );
  $field_groups['group_link|field_collection_item|field_uaqs_cards|uaqs_landing_grid'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_span|field_collection_item|field_uaqs_cards|uaqs_borderless_card';
  $field_group->group_name = 'group_span';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_borderless_card';
  $field_group->parent_name = 'group_strong';
  $field_group->data = array(
    'label' => 'Span',
    'weight' => '31',
    'children' => array(
      0 => 'field_uaqs_links',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Span',
      'instance_settings' => array(
        'id' => '',
        'classes' => '',
        'element' => 'span',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_span|field_collection_item|field_uaqs_cards|uaqs_borderless_card'] = $field_group;

  $field_group = new stdClass();
  $field_group->disabled = FALSE; /* Edit this to true to make a default field_group disabled initially */
  $field_group->api_version = 1;
  $field_group->identifier = 'group_strong|field_collection_item|field_uaqs_cards|uaqs_borderless_card';
  $field_group->group_name = 'group_strong';
  $field_group->entity_type = 'field_collection_item';
  $field_group->bundle = 'field_uaqs_cards';
  $field_group->mode = 'uaqs_borderless_card';
  $field_group->parent_name = 'group_link';
  $field_group->data = array(
    'label' => 'Strong',
    'weight' => '5',
    'children' => array(
      0 => 'group_span',
    ),
    'format_type' => 'html-element',
    'format_settings' => array(
      'label' => 'Strong',
      'instance_settings' => array(
        'id' => '',
        'classes' => 'card-link psuedo-link text-uppercase bold',
        'element' => 'strong',
        'show_label' => '0',
        'label_element' => '',
        'attributes' => '',
      ),
    ),
  );
  $field_groups['group_strong|field_collection_item|field_uaqs_cards|uaqs_borderless_card'] = $field_group;

  // Translatables
  // Included for use with string extractors like potx.
  t('Card');
  t('Card Block');
  t('Card Deck');
  t('Card Header');
  t('Card Link');
  t('Card Text');
  t('Card Title');
  t('Card deck wrapper');
  t('Display Settings');
  t('Image link');
  t('Link');
  t('Links');
  t('Span');
  t('Strong');

  return $field_groups;
}
