<?php

/**
 * @file
 * uaqs_content_chunks.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function uaqs_content_chunks_taxonomy_default_vocabularies() {
  return array(
    'uaqs_flexible_categories' => array(
      'name' => 'Flexible Page Categories',
      'machine_name' => 'uaqs_flexible_categories',
      'description' => '',
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
  );
}
