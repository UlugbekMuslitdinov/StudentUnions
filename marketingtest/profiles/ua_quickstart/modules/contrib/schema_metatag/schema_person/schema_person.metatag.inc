<?php

/**
 * @file
 * Metatag integration for the schema_person module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_person_metatag_info() {
  $info['groups']['schema_person'] = array(
    'label' => t('Schema.org: Person'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/Person')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_person',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_person.@type'] = array(
    'class' => 'SchemaPersonType',
    'label' => t('@type'),
    'description' => t('The type of person.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.@id'] = array(
    'label' => t('@id'),
    'description' => t('Globally unique @id, usually a url, used to to link other properties to this object.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.name'] = array(
    'label' => t('name'),
    'description' => t('The name of the person.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.givenName'] = array(
    'label' => t('givenName'),
    'description' => t('Given name. In the U.S., the first name of a Person. This can be used along with familyName instead of the name property.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.familyName'] = array(
    'label' => t('familyName'),
    'description' => t('Family name. In the U.S., the last name of an Person. This can be used along with givenName instead of the name property.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.additionalName'] = array(
    'label' => t('additonalName'),
    'description' => t('An additional name for a Person, can be used for a middle name. Multiple values may be used, separated by a comma. Note: Tokens that return multiple values will be handled automatically.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.alternateName'] = array(
    'label' => t('alternateName'),
    'description' => t('An alias for the person.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.birthDate'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('birthDate'),
    'description' => t('Date of birth of the person in ISO 8601 format, 2017-12-31. To format the date properly, use a token like [node:created:html_datetime].'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.gender'] = array(
    'label' => t('gender'),
    'description' => t('Gender of the person.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.jobTitle'] = array(
    'label' => t('jobTitle'),
    'description' => t('The job title of the person (for example, Financial Manager).'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.url'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('url'),
    'description' => t('The url of the person.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.sameAs'] = array(
    'class' => 'SchemaUrlBase',
    'label' => t('sameAs'),
    'description' => t('Social links and other urls of the person.'),
    'url' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.address'] = array(
    'class' => 'SchemaAddressBase',
    'label' => t('address'),
    'description' => t('The address of the person.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.email'] = array(
    'label' => t('email'),
    'description' => t('The email address of the person.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.telephone'] = array(
    'label' => t('telephone'),
    'description' => t('The primary telephone number of the person.'),
    'multiple' => FALSE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.contactPoint'] = array(
    'class' => 'SchemaContactPointBase',
    'label' => t('contactPoint'),
    'description' => t("Telephone and other contact point information. See <a href=\":url\">ContactPoint</a>.", [":url" => "https://schema.org/ContactPoint"]),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.description'] = array(
    'label' => t('description'),
    'description' => t('A description of the person.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.image'] = array(
    'class' => 'SchemaImageBase',
    'label' => t('image'),
    'description' => t('The primary image for the person.'),
    'image' => TRUE,
    'url' => TRUE,
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.brand'] = array(
    'class' => 'SchemaBrandBase',
    'label' => t('brand'),
    'description' => t('The brand of the person.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.affiliation'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('affiliation'),
    'description' => t('An organization that this person is affiliated with. For example, a school/university, a club, or a team.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.memberOf'] = array(
    'class' => 'SchemaProgramMembershipBase',
    'label' => t('memberOf'),
    'description' => t('An Organization (or ProgramMembership) to which this Person belongs.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_person.worksFor'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('worksFor'),
    'description' => t('Organizations that the person works for.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;

}
