<?php

/**
 * @file
 * Metatag integration for the schema_special_announcement module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_special_announcement_metatag_info() {
  $info['groups']['schema_special_announcement'] = array(
    'label' => t('Schema.org: SpecialAnnouncement'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'https://schema.org/SpecialAnnouncement')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_special_announcement',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_special_announcement.@type'] = array(
    'class' => 'SchemaSpecialAnnouncementType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of specialAnnouncement.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.name'] = array(
    'label' => t('name'),
    'description' => t("The short title of the COVID-19 announcement. For example: 'Stanford announces COVID-19 testing facility'."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.category'] = array(
    'label' => t('category'),
    'description' => t('The URL that describes the category for the special announcement. Set the category to the Wikipedia page for COVID-19: https://www.wikidata.org/wiki/Q81068910.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.datePosted'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('datePosted'),
    'description' => t('The date that the COVID-19 announcement was published in ISO-8601 format.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.expires'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('expires'),
    'description' => t("The date in which the content expires and is no longer useful or available in ISO-8601 format. Don't include this property if you don't know when the content will expire."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.text'] = array(
    'label' => t('text'),
    'description' => t('You must include either text, or one of the following urls that point to more info about the announcement, depending on the subject matter: diseasePreventionInfo, diseaseSpreadStatistics, gettingTestedInfo, governmentBenefitsInfo, newsUpdatesAndGuidelines, publicTransportClosuresInfo, quarantineGuidelines, schoolClosuresInfo, and/or travelBans.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.diseasePreventionInfo'] = array(
    'label' => t('diseasePreventionInfo'),
    'description' => t("Url to information about disease prevention, if applicable to the announcement."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.diseaseSpreadStatistics'] = array(
    'label' => t('diseaseSpreadStatistics'),
    'description' => t("If applicable to the announcement, url to statistical information about the spread of a disease."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.gettingTestedInfo'] = array(
    'label' => t('gettingTestedInfo'),
    'description' => t("Url to information about getting tested (for a MedicalCondition) in the context of COVID-19, if applicable to the announcement."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.newsUpdatesAndGuidelines'] = array(
    'label' => t('newsUpdatesAndGuidelines'),
    'description' => t("Url to a page with news updates and guidelines in the context of COVID-19, if applicable to the announcement. This could be (but is not required to be) the main page containing SpecialAnnouncement markup on a site."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.publicTransportClosuresInfo'] = array(
    'label' => t('publicTransportClosuresInfo'),
    'description' => t("Url to information about public transport closures in the context of COVID-19, if applicable to the announcement."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.quarantineGuidelines'] = array(
    'label' => t('quarantineGuidelines'),
    'description' => t("Url to guidelines about quarantine rules in the context of COVID-19, if applicable to the announcement."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.schoolClosuresInfo'] = array(
    'label' => t('schoolClosuresInfo'),
    'description' => t("Url to information about school closures in the context of COVID-19, if applicable to the announcement."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.travelBans'] = array(
    'label' => t('travelBans'),
    'description' => t("Url to information about travel bans in the context of COVID-19, if applicable to the announcement."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.governmentBenefitsInfo'] = array(
    'class' => 'SchemaGovernmentServiceBase',
    'label' => t('governmentBenefitsInfo'),
    'description' => t("Information about new government benefits in the context of COVID-19, if applicable to the announcement."),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.announcementLocation'] = array(
    'class' => 'SchemaPlaceBase',
    'label' => t('announcementLocation'),
    'description' => t("The specific location that is associated with the SpecialAnnouncement. For example, a specific testing facility or business with special opening hours. For a larger geographic region, like a quarantine of an entire region, we recommend that you use spatialCoverage."),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_special_announcement.spatialCoverage'] = array(
    'class' => 'SchemaPlaceBase',
    'label' => t('spatialCoverage'),
    'description' => t("The geographic region that is the focus of the special announcement, if applicable. For example, the announcement may be about a shelter-in-place that affects multiple regions. If the announcement affects both a region and a specific location (for example, a library closure that serves an entire region), use both spatialCoverage and announcementLocation."),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  return $info;

}
