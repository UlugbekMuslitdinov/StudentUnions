<?php

/**
 * @file
 * uaqs_news.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function uaqs_news_taxonomy_default_vocabularies() {
  return array(
    'uaqs_news_tags' => array(
      'name' => 'News Tags',
      'machine_name' => 'uaqs_news_tags',
      'description' => 'Tagging news has never been easier.',
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
