<?php

/**
 * @file
 * Metatag integration for the schema_organization module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_organization_metatag_info() {
  $info['groups']['schema_organization'] = array(
    'label' => t('Schema.org: Organization'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/Organization', '!google_url' => 'https://developers.google.com/search/docs/data-types/local-business']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_organization',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_organization.@type'] = array(
    'class' => 'SchemaOrganizationType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of organization.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.additionalType'] = array(
    'class' => 'SchemaOrganizationType',
    'label' => t('additionalType'),
    'description' => t(" An additional type for the item, typically used for adding more specific types from external vocabularies in microdata syntax. This is a relationship between something and a class that the thing is in."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.@id'] = array(
    'label' => t('@id'),
    'description' => t('REQUIRED BY GOOGLE. Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.name'] = array(
    'label' => t('name'),
    'description' => t('REQUIRED BY GOOGLE. The name of the organization.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.address'] = array(
    'class' => 'SchemaAddressBase',
    'label' => t('address'),
    'description' => t('REQUIRED BY GOOGLE. The address of the organization.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.geo'] = array(
    'class' => 'SchemaGeoBase',
    'label' => t('geo'),
    'description' => t('RECOMMENDED BY GOOGLE. The geographic coordinates of the organization.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.telephone'] = array(
    'label' => t('telephone'),
    'description' => t("RECOMMENDED BY GOOGLE. A business phone number meant to be the primary contact method for customers. Be sure to include the country code and area code in the phone number."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.contactPoint'] = array(
    'class' => 'SchemaContactPointBase',
    'label' => t('contactPoint'),
    'description' => t("Telephone and other contact point information. See <a href=\":url\">Google Corporate Contact</a>.", [":url" => "https://developers.google.com/search/docs/data-types/corporate-contact"]),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => t('RECOMMENDED BY GOOGLE. The url of the organization.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.sameAs'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('sameAs'),
    'description' => t('Additional urls, such as wikipedia page or social profiles.'),
    'multiple' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.description'] = array(
    'label' => t('description'),
    'description' => t('RECOMMENDED BY GOOGLE. A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.brand'] = array(
    'class' => 'SchemaBrandBase',
    'label' => t('brand'),
    'description' => t('The brand of the organization.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.acceptsReservations'] = array(
    'class' => 'SchemaTrueFalseBase',
    'label' => t('acceptsReservations'),
    'description' => t('RECOMMENDED BY GOOGLE FOR Food Establishments.'),
    'multiple' => FALSE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.menu'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('menu'),
    'description' => t('RECOMMENDED BY GOOGLE FOR Food Establishments. The url of the menu.'),
    'url' => TRUE,
    'multiple' => FALSE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.openingHoursSpecification'] = array(
    'class' => 'SchemaOpeningHoursSpecificationBase',
    'label' => t('openingHoursSpecification'),
    'description' => t('RECOMMENDED BY GOOGLE. Hours during which the business location is open.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('REQUIRED BY GOOGLE. The primary image for this organization.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.logo'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('logo'),
    'description' => t('The logo for this organization.'),
    'image' => TRUE,
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.potentialAction'] = array(
    'class' => 'SchemaOrganizationPotentialAction',
    'label' => t('memberOf'),
    'description' => t('RECOMMENDED BY GOOGLE. Potential action provided by this organization.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.priceRange'] = array(
    'label' => t('priceRange'),
    'description' => t('The price range of products of the organization.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.memberOf'] = array(
    'class' => 'SchemaProgramMembershipBase',
    'label' => t('memberOf'),
    'description' => t('An Organization (or ProgramMembership) to which this Organization belongs.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.aggregateRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('aggregateRating'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.starRating'] = array(
    'class' => 'SchemaRatingBase',
    'label' => t('starRating'),
    'description' => t('An official rating for a lodging business or food establishment, e.g. from national associations or standards bodies.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_organization.review'] = array(
    'class' => 'SchemaReviewBase',
    'label' => t('review'),
    'description' => '',
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;

}
