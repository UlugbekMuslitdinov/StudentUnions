<?php

/**
 * @file
 * uaqs_person.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function uaqs_person_taxonomy_default_vocabularies() {
  return array(
    'uaqs_person_category' => array(
      'name' => 'Person Categories',
      'machine_name' => 'uaqs_person_category',
      'description' => 'Taxonomy for categorizing people',
      'hierarchy' => 1,
      'module' => 'taxonomy',
      'weight' => 0,
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
    'uaqs_person_category_secondary' => array(
      'name' => 'Person Categories (Secondary)',
      'machine_name' => 'uaqs_person_category_secondary',
      'description' => 'Secondary taxonomy for categorizing people',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
  );
}
