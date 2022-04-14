<?php

/**
 * @file
 * Metatag integration for the schema_qa_page module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_qa_page_metatag_info() {
  $info['groups']['schema_qa_page'] = array(
    'label' => t('Schema.org: QAPage/FAQPage'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a> and <a href="!url2">!url2</a>, Google\'s recommendations at <a href="!google_url">!google_url</a> and <a href="!google_url2">!google_url2</a>.', [
      '!url' => 'http://schema.org/QAPage',
      '!url2' => 'http://schema.org/FAQPage',
      '!google_url' => 'https://developers.google.com/search/docs/data-types/qapage',
      '!google_url2' => 'https://developers.google.com/search/docs/data-types/faqpage',
    ]),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_qa_page',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_qa_page.@type'] = array(
    'class' => 'SchemaQAPageType',
    'label' => t('@type'),
    'description' => t("REQUIRED. The type of object."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_qa_page.mainEntity'] = array(
    'class' => 'SchemaQuestionBase',
    'label' => t('text'),
    'description' => t('REQUIRED BY GOOGLE. An array of Question elements which comprise the list of answered questions that this QAPage or FAQPage is about.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
