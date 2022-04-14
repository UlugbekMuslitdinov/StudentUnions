<?php

/**
 * @file
 * Metatag integration for the schema_job_posting module.
 */

/**
 * Implements hook_metatag_info().
 */
function schema_job_posting_metatag_info() {
  $info['groups']['schema_job_posting'] = array(
    'label' => t('Schema.org: JobPosting'),
    'description' => t('See Schema.org definitions for this Schema type at <a href="!url">!url</a>.', array('!url' => 'http://schema.org/JobPosting')),
    'form' => array(
      '#weight' => 10,
    ),
  );

  $weight = 10;

  // Basic tags.
  $defaults = array(
    'class' => 'SchemaNameBase',
    'group' => 'schema_job_posting',
    'form' => array(
      '#type' => 'textfield',
    ),
  );

  $info['tags']['schema_job_posting.@type'] = array(
    'class' => 'SchemaJobPostingType',
    'label' => t('@type'),
    'description' => t('REQUIRED. The type of jobPosting.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.title'] = array(
    'label' => t('title'),
    'description' => t('REQUIRED BY GOOGLE. Title of the job.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.description'] = array(
    'label' => t('description'),
    'description' => t('REQUIRED BY GOOGLE. Description of the job.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.baseSalary'] = array(
    'class' => 'SchemaMonetaryAmountBase',
    'label' => t('baseSalary'),
    'description' => t('RECOMMENDED BY GOOGLE. The baseSalary of the job_posting.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.datePosted'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('datePosted'),
    'description' => t('REQUIRED BY GOOGLE. Date the job_posting was published.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.validThrough'] = array(
    'class' => 'SchemaDateBase',
    'label' => t('validThrough'),
    'description' => t('REQUIRED BY GOOGLE. The validThrough of the job_posting.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.employmentType'] = array(
    'label' => t('employmentType'),
    'description' => t('RECOMMENDED BY GOOGLE. The employment type of the jobPosting. Should be one of FULL_TIME, PART_TIME, CONTRACTOR, TEMPORARY, INTERN, VOLUNTEER, PER_DIEM, OTHER.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.hiringOrganization'] = array(
    'class' => 'SchemaPersonOrgBase',
    'label' => t('Company'),
    'description' => t('REQUIRED BY GOOGLE. Company offering the job_posting.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.jobLocation'] = array(
    'class' => 'SchemaPlaceBase',
    'label' => t('jobLocation'),
    'description' => t('REQUIRED BY GOOGLE. The location of the job_posting.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.identifier'] = array(
    'label' => t('identifier'),
    'description' => t('RECOMMENDED BY GOOGLE. The identifier of the job.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.industry'] = array(
    'label' => t('industry'),
    'description' => t('Comma separated industry list of industries, for instance taxonomy terms or categories.'),
    'multiple' => TRUE,
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.responsibilities'] = array(
    'label' => t('responsibilities'),
    'description' => t('The responsibilities of the job.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.jobBenefits'] = array(
    'label' => t('jobBenefits'),
    'description' => t('The benefits of the job.'),
    'weight' => ++$weight,
  ) + $defaults;

  $info['tags']['schema_job_posting.qualifications'] = array(
    'label' => t('qualifications'),
    'description' => t('The qualifications of the job.'),
    'weight' => ++$weight,
  ) + $defaults;

  return $info;

}
