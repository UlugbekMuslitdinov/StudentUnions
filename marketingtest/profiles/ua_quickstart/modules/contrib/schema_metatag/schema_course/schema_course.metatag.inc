<?php

/**
 * @file
 * Metatag integration for the schema_course module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_course_metatag_info() {
  $info['groups']['schema_course'] = array(
    'label' => t('Schema.org: Course'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>, Google\'s recommendations at <a href="!google_url">!google_url</a>.', ['!url' => 'http://schema.org/Course', '!google_url' => 'https://developers.google.com/search/docs/data-types/course']),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_course',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_course.@type'] = array(
    'class' => 'SchemaCourseType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of course.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_course.name'] = array(
    'label' => t('name'),
    'description' => t("REQUIRED BY GOOGLE. The title of the course."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_course.courseCode'] = array(
    'label' => t('brand'),
    'description' => t("The identifier for the Course used by the course provider (e.g. CS101 or 6.001)."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_course.description'] = array(
    'label' => t('description'),
    'description' => t('REQUIRED BY GOOGLE. A description of the item.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_course.coursePrerequisites'] = array(
    'label' => t('coursePrerequisites'),
    'description' => t("Requirements for taking the Course."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_course.educationalCredentialAwarded'] = array(
    'label' => t('educationalCredentialAwarded'),
    'description' => t("A description of the qualification, award, certificate, diploma or other educational credential awarded as a consequence of successful completion of this course."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_course.provider'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('provider'),
    'description' => t("RECOMMENDED BY GOOGLE. The provider of the course."),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;
}
