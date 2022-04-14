<?php

/**
 * @file
 * Metatag integration for the schema_how_to module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_how_to_metatag_info() {
  $info['groups']['schema_how_to'] = array(
    'label' => t('Schema.org: HowTo'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/HowTo', '!google_url' => 'https://developers.google.com/search/docs/data-types/how-to']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_how_to',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_how_to.@type'] = array(
    'class' => 'SchemaHowToType',
    'label' => t('@type'),
    'description' => t("REQUIRED. The type of how-to."),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_how_to.name'] = array(
    'label' => t('text'),
    'description' => t('REQUIRED BY GOOGLE. The title of the how-to. For example, "How to tie a tie".'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_how_to.step'] = array(
    'class' => 'SchemaHowToStepBase',
    'label' => t('name'),
    'description' => t("REQUIRED BY GOOGLE. An array of HowToStep elements which comprise the full instructions of the how-to."),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_how_to.description'] = array(
    'label' => t('description'),
    'description' => t('RECOMMENDED BY GOOGLE. A description of the how-to.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_how_to.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('RECOMMENDED BY GOOGLE. Image of the completed how-to.'),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_how_to.estimatedCost'] = array(
    'class' => 'SchemaMonetaryAmountBase',
    'label' => t('estimatedCost'),
    'description' => t('RECOMMENDED BY GOOGLE. The estimated cost of the supplies consumed when performing instructions.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_how_to.supply'] = array(
    'label' => t('supply'),
    'description' => t("RECOMMENDED BY GOOGLE. A supply consumed when performing instructions or a direction."),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_how_to.tool'] = array(
    'label' => t('tool'),
    'description' => t('RECOMMENDED BY GOOGLE. An object used (but not consumed) when performing instructions or a direction.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
