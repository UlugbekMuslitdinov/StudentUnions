<?php

/**
 * @file
 * Metatag integration for the tests.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_metatag_test_metatag_info() {
  $info['groups']['testing'] = array(
    'label' => t('Testing'),
    'form' => array(
      '#weight' => 100,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'testing',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_metatag_test.@type'] = array(
    'class' => 'SchemaWebSiteType',
    'label' => t('@type'),
    'description' => t('The type of article.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.address'] = array(
    'class' => 'SchemaAddressBase',
    'label' => t('address'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.rating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('rating'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.date'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('date'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.duration'] = array(
    'class' => 'SchemaDurationBase',
    'label' => t('duration'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.geo'] = array(
    'class' => 'SchemaGeoBase',
    'label' => t('geo'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => '',
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.mainEntityOfPage'] = array(
    'class' => 'SchemaMainEntityOfPageBase',
    'label' => t('mainEntityOfPage'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.name'] = array(
    'class' => 'SchemaNameBase',
    'label' => t('name'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.offer'] = array(
    'class' => 'SchemaOfferBase',
    'label' => t('offer'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.organization'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('organization'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.place'] = array(
    'class' => 'SchemaPlaceBase',
    'label' => t('place'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => '',
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.action'] = array(
    'class' => 'SchemaWebSitePotentialAction',
    'label' => t('action'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.country'] = array(
    'class' => 'SchemaCountryBase',
    'label' => t('country'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.creativeWork'] = array(
    'class' => 'SchemaCreativeWorkBase',
    'label' => t('creativeWork'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.entryPoint'] = array(
    'class' => 'SchemaEntryPointBase',
    'label' => t('entryPoint'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.event'] = array(
    'class' => 'SchemaEventBase',
    'label' => t('event'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.hasPart'] = array(
    'class' => 'SchemaHasPartBase',
    'label' => t('hasPart'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.nutritionInformation'] = array(
    'class' => 'SchemaNutritionInformationBase',
    'label' => t('nutritionInformation'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.openingHoursSpecification'] = array(
    'class' => 'SchemaOpeningHoursSpecificationBase',
    'label' => t('openingHoursSpecification'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.programMembership'] = array(
    'class' => 'SchemaProgramMembershipBase',
    'label' => t('programMembership'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.thing'] = array(
    'class' => 'SchemaThingBase',
    'label' => t('thing'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.trueFalse'] = array(
    'class' => 'SchemaTrueFalseBase',
    'label' => t('trueFalse'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.monetaryAmount'] = array(
    'class' => 'SchemaMonetaryAmountBase',
    'label' => t('monetaryAmount'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.contactPoint'] = array(
    'class' => 'SchemaContactPointBase',
    'label' => t('contactPoint'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.speakable'] = array(
    'class' => 'SchemaSpeakableBase',
    'label' => t('speakable'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.idReference'] = array(
    'class' => 'SchemaIdReferenceBase',
    'label' => t('idReference'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.step'] = array(
    'class' => 'SchemaHowToStepBase',
    'label' => t('step'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.question'] = array(
    'class' => 'SchemaQuestionBase',
    'label' => t('question'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.answer'] = array(
    'class' => 'SchemaAnswerBase',
    'label' => t('answer'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_metatag_test.governmentService'] = array(
    'class' => 'SchemaGovernmentServiceBase',
    'label' => t('governmentService'),
    'description' => '',
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
