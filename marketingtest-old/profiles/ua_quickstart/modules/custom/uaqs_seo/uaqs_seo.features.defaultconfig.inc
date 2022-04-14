<?php

/**
 * @file
 * uaqs_seo.features.defaultconfig.inc
 */

/**
 * Implements hook_defaultconfig_features().
 */
function uaqs_seo_defaultconfig_features() {
  return array(
    'uaqs_seo' => array(
      'metatag_config_default' => 'metatag_config_default',
      'strongarm' => 'strongarm',
    ),
  );
}

/**
 * Implements hook_defaultconfig_metatag_config_default().
 */
function uaqs_seo_defaultconfig_metatag_config_default() {
  $export = array();

  $config = new stdClass();
  $config->disabled = FALSE; /* Edit this to true to make a default config disabled initially */
  $config->api_version = 1;
  $config->instance = 'global';
  $config->config = array(
    'title' => array(
      'value' => '[current-page:title] | [current-page:pager][site:name]',
    ),
    'description' => array(
      'value' => '',
    ),
    'abstract' => array(
      'value' => '',
    ),
    'keywords' => array(
      'value' => '',
    ),
    'robots' => array(
      'value' => array(
        'index' => 0,
        'follow' => 0,
        'noindex' => 0,
        'nofollow' => 0,
        'noarchive' => 0,
        'nosnippet' => 0,
        'noodp' => 0,
        'noydir' => 0,
        'noimageindex' => 0,
        'notranslate' => 0,
      ),
    ),
    'news_keywords' => array(
      'value' => '',
    ),
    'standout' => array(
      'value' => '',
    ),
    'rating' => array(
      'value' => '',
    ),
    'referrer' => array(
      'value' => '',
    ),
    'generator' => array(
      'value' => 'UA Quickstart 7 (https://quickstart.arizona.edu)',
    ),
    'rights' => array(
      'value' => '© [current-date:custom:Y] The Arizona Board of Regents on behalf of <a href="https://www.arizona.edu" target="_blank">The University of Arizona</a>.',
    ),
    'image_src' => array(
      'value' => '',
    ),
    'canonical' => array(
      'value' => '[current-page:url:absolute]',
    ),
    'set_cookie' => array(
      'value' => '',
    ),
    'shortlink' => array(
      'value' => '[current-page:url:unaliased]',
    ),
    'original-source' => array(
      'value' => '',
    ),
    'prev' => array(
      'value' => '',
    ),
    'next' => array(
      'value' => '',
    ),
    'content-language' => array(
      'value' => '',
    ),
    'geo.position' => array(
      'value' => '',
    ),
    'geo.placename' => array(
      'value' => '',
    ),
    'geo.region' => array(
      'value' => '',
    ),
    'icbm' => array(
      'value' => '',
    ),
    'refresh' => array(
      'value' => '',
    ),
    'revisit-after' => array(
      'value' => '',
      'period' => '',
    ),
    'pragma' => array(
      'value' => '',
    ),
    'cache-control' => array(
      'value' => '',
    ),
    'expires' => array(
      'value' => '',
    ),
    'itemtype' => array(
      'value' => '',
    ),
    'itemprop:name' => array(
      'value' => '',
    ),
    'itemprop:description' => array(
      'value' => '',
    ),
    'itemprop:image' => array(
      'value' => '',
    ),
    'author' => array(
      'value' => '',
    ),
    'publisher' => array(
      'value' => '',
    ),
    'og:site_name' => array(
      'value' => '[site:name]',
    ),
    'og:type' => array(
      'value' => 'article',
    ),
    'og:url' => array(
      'value' => '[current-page:url:absolute]',
    ),
    'og:title' => array(
      'value' => '[current-page:title]',
    ),
    'og:determiner' => array(
      'value' => '',
    ),
    'og:description' => array(
      'value' => '',
    ),
    'og:updated_time' => array(
      'value' => '',
    ),
    'og:see_also' => array(
      'value' => '',
    ),
    'og:image' => array(
      'value' => '',
    ),
    'og:image:url' => array(
      'value' => '',
    ),
    'og:image:secure_url' => array(
      'value' => '',
    ),
    'og:image:type' => array(
      'value' => '',
    ),
    'og:image:width' => array(
      'value' => '',
    ),
    'og:image:height' => array(
      'value' => '',
    ),
    'og:latitude' => array(
      'value' => '',
    ),
    'og:longitude' => array(
      'value' => '',
    ),
    'og:street_address' => array(
      'value' => '',
    ),
    'og:locality' => array(
      'value' => '',
    ),
    'og:region' => array(
      'value' => '',
    ),
    'og:postal_code' => array(
      'value' => '',
    ),
    'og:country_name' => array(
      'value' => '',
    ),
    'og:email' => array(
      'value' => '',
    ),
    'og:phone_number' => array(
      'value' => '',
    ),
    'og:fax_number' => array(
      'value' => '',
    ),
    'og:locale' => array(
      'value' => '',
    ),
    'og:locale:alternate' => array(
      'value' => '',
    ),
    'article:author' => array(
      'value' => '',
    ),
    'article:publisher' => array(
      'value' => '',
    ),
    'article:section' => array(
      'value' => '',
    ),
    'article:tag' => array(
      'value' => '',
    ),
    'article:published_time' => array(
      'value' => '',
    ),
    'article:modified_time' => array(
      'value' => '',
    ),
    'article:expiration_time' => array(
      'value' => '',
    ),
    'profile:first_name' => array(
      'value' => '',
    ),
    'profile:last_name' => array(
      'value' => '',
    ),
    'profile:username' => array(
      'value' => '',
    ),
    'profile:gender' => array(
      'value' => '',
    ),
    'og:audio' => array(
      'value' => '',
    ),
    'og:audio:secure_url' => array(
      'value' => '',
    ),
    'og:audio:type' => array(
      'value' => '',
    ),
    'book:author' => array(
      'value' => '',
    ),
    'book:isbn' => array(
      'value' => '',
    ),
    'book:release_date' => array(
      'value' => '',
    ),
    'book:tag' => array(
      'value' => '',
    ),
    'og:video:url' => array(
      'value' => '',
    ),
    'og:video:secure_url' => array(
      'value' => '',
    ),
    'og:video:width' => array(
      'value' => '',
    ),
    'og:video:height' => array(
      'value' => '',
    ),
    'og:video:type' => array(
      'value' => '',
    ),
    'video:actor' => array(
      'value' => '',
    ),
    'video:actor:role' => array(
      'value' => '',
    ),
    'video:director' => array(
      'value' => '',
    ),
    'video:writer' => array(
      'value' => '',
    ),
    'video:duration' => array(
      'value' => '',
    ),
    'video:release_date' => array(
      'value' => '',
    ),
    'video:tag' => array(
      'value' => '',
    ),
    'video:series' => array(
      'value' => '',
    ),
    'twitter:card' => array(
      'value' => 'summary',
    ),
    'twitter:site' => array(
      'value' => '',
    ),
    'twitter:site:id' => array(
      'value' => '',
    ),
    'twitter:creator' => array(
      'value' => '',
    ),
    'twitter:creator:id' => array(
      'value' => '',
    ),
    'twitter:url' => array(
      'value' => '[current-page:url:absolute]',
    ),
    'twitter:title' => array(
      'value' => '[current-page:title]',
    ),
    'twitter:description' => array(
      'value' => '',
    ),
    'twitter:dnt' => array(
      'value' => '',
    ),
    'twitter:image' => array(
      'value' => '',
    ),
    'twitter:image:width' => array(
      'value' => '',
    ),
    'twitter:image:height' => array(
      'value' => '',
    ),
    'twitter:image:alt' => array(
      'value' => '',
    ),
    'twitter:image0' => array(
      'value' => '',
    ),
    'twitter:image1' => array(
      'value' => '',
    ),
    'twitter:image2' => array(
      'value' => '',
    ),
    'twitter:image3' => array(
      'value' => '',
    ),
    'twitter:player' => array(
      'value' => '',
    ),
    'twitter:player:width' => array(
      'value' => '',
    ),
    'twitter:player:height' => array(
      'value' => '',
    ),
    'twitter:player:stream' => array(
      'value' => '',
    ),
    'twitter:player:stream:content_type' => array(
      'value' => '',
    ),
    'twitter:app:country' => array(
      'value' => '',
    ),
    'twitter:app:name:iphone' => array(
      'value' => '',
    ),
    'twitter:app:id:iphone' => array(
      'value' => '',
    ),
    'twitter:app:url:iphone' => array(
      'value' => '',
    ),
    'twitter:app:name:ipad' => array(
      'value' => '',
    ),
    'twitter:app:id:ipad' => array(
      'value' => '',
    ),
    'twitter:app:url:ipad' => array(
      'value' => '',
    ),
    'twitter:app:name:googleplay' => array(
      'value' => '',
    ),
    'twitter:app:id:googleplay' => array(
      'value' => '',
    ),
    'twitter:app:url:googleplay' => array(
      'value' => '',
    ),
    'twitter:label1' => array(
      'value' => '',
    ),
    'twitter:data1' => array(
      'value' => '',
    ),
    'twitter:label2' => array(
      'value' => '',
    ),
    'twitter:data2' => array(
      'value' => '',
    ),
    'schema_organization.@type' => array(
      'value' => 'EducationalOrganization',
    ),
    'schema_organization.additionalType' => array(
      'value' => 'CollegeOrUniversity',
    ),
    'schema_organization.@id' => array(
      'value' => '[current-page:url:absolute]',
    ),
    'schema_organization.name' => array(
      'value' => 'The University of Arizona',
    ),
    'schema_organization.address' => array(
      'value' => 'a:5:{s:5:"@type";s:13:"PostalAddress";s:15:"addressLocality";s:6:"Tucson";s:13:"addressRegion";s:2:"AZ";s:10:"postalCode";s:5:"85721";s:14:"addressCountry";s:3:"USA";}',
    ),
    'schema_organization.url' => array(
      'value' => '[site:url]',
    ),
    'schema_organization.image' => array(
      'value' => 'a:2:{s:5:"@type";s:11:"ImageObject";s:3:"url";s:23:"[node:field_uaqs_photo]";}',
    ),
  );
  $export['global'] = $config;

  $config = new stdClass();
  $config->disabled = FALSE; /* Edit this to true to make a default config disabled initially */
  $config->api_version = 1;
  $config->instance = 'node';
  $config->config = array(
    'title' => array(
      'value' => '[node:title] | [current-page:pager][site:name]',
    ),
    'description' => array(
      'value' => '[node:field_uaqs_summary]',
    ),
    'robots' => array(
      'value' => array(
        'index' => 0,
        'follow' => 0,
        'noindex' => 0,
        'nofollow' => 0,
        'noarchive' => 0,
        'nosnippet' => 0,
        'noodp' => 0,
        'noydir' => 0,
        'noimageindex' => 0,
        'notranslate' => 0,
      ),
    ),
    'image_src' => array(
      'value' => '[node:field_uaqs_photo]',
    ),
    'og:title' => array(
      'value' => '[node:title]',
    ),
    'og:description' => array(
      'value' => '[node:field_uaqs_summary]',
    ),
    'og:updated_time' => array(
      'value' => '[node:changed:custom:c]',
    ),
    'og:image' => array(
      'value' => '[node:field_uaqs_photo]',
    ),
    'og:image:url' => array(
      'value' => '[node:field_uaqs_photo]',
    ),
    'og:image:secure_url' => array(
      'value' => '[node:field_uaqs_photo]',
    ),
    'article:published_time' => array(
      'value' => '[node:created:custom:c]',
    ),
    'article:modified_time' => array(
      'value' => '[node:changed:custom:c]',
    ),
    'twitter:title' => array(
      'value' => '[node:title]',
    ),
    'twitter:description' => array(
      'value' => '[node:field_uaqs_summary]',
    ),
    'twitter:image' => array(
      'value' => '[node:field_uaqs_photo]',
    ),
  );
  $export['node'] = $config;

  return $export;
}

/**
 * Implements hook_defaultconfig_strongarm().
 */
function uaqs_seo_defaultconfig_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'default_metatag_config';
  $strongarm->value = array(
    'global:frontpage' => TRUE,
  );
  $export['default_metatag_config'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node';
  $strongarm->value = 1;
  $export['metatag_enable_node'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_carousel_item';
  $strongarm->value = 0;
  $export['metatag_enable_node__uaqs_carousel_item'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_event';
  $strongarm->value = 1;
  $export['metatag_enable_node__uaqs_event'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_flexible_page';
  $strongarm->value = 1;
  $export['metatag_enable_node__uaqs_flexible_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_major';
  $strongarm->value = TRUE;
  $export['metatag_enable_node__uaqs_major'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_news';
  $strongarm->value = 1;
  $export['metatag_enable_node__uaqs_news'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_page';
  $strongarm->value = 1;
  $export['metatag_enable_node__uaqs_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_person';
  $strongarm->value = 1;
  $export['metatag_enable_node__uaqs_person'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_program';
  $strongarm->value = 0;
  $export['metatag_enable_node__uaqs_program'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_pub';
  $strongarm->value = 1;
  $export['metatag_enable_node__uaqs_pub'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__uaqs_unit';
  $strongarm->value = 0;
  $export['metatag_enable_node__uaqs_unit'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'metatag_enable_node__webform';
  $strongarm->value = 1;
  $export['metatag_enable_node__webform'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_batch_limit';
  $strongarm->value = '100';
  $export['xmlsitemap_batch_limit'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_chunk_size';
  $strongarm->value = 'auto';
  $export['xmlsitemap_chunk_size'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_developer_mode';
  $strongarm->value = 0;
  $export['xmlsitemap_developer_mode'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_disable_cron_regeneration';
  $strongarm->value = 0;
  $export['xmlsitemap_disable_cron_regeneration'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_frontpage_changefreq';
  $strongarm->value = '86400';
  $export['xmlsitemap_frontpage_changefreq'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_frontpage_priority';
  $strongarm->value = '1.0';
  $export['xmlsitemap_frontpage_priority'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_lastmod_format';
  $strongarm->value = 'Y-m-d\\TH:i\\Z';
  $export['xmlsitemap_lastmod_format'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_minimum_lifetime';
  $strongarm->value = '86400';
  $export['xmlsitemap_minimum_lifetime'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_output_elements';
  $strongarm->value = array(
    0 => 'lastmod',
    1 => 'changefreq',
    2 => 'priority',
  );
  $export['xmlsitemap_output_elements'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_path';
  $strongarm->value = 'xmlsitemap';
  $export['xmlsitemap_path'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_prefetch_aliases';
  $strongarm->value = 1;
  $export['xmlsitemap_prefetch_aliases'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_menu_link_main-menu';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '1.0',
  );
  $export['xmlsitemap_settings_menu_link_main-menu'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_menu_link_uaqs-footer-information-for';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_menu_link_uaqs-footer-information-for'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_menu_link_uaqs-footer-main';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_menu_link_uaqs-footer-main'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_menu_link_uaqs-footer-resources';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_menu_link_uaqs-footer-resources'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_menu_link_uaqs-footer-topics';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_menu_link_uaqs-footer-topics'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_menu_link_uaqs-header-resources';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_menu_link_uaqs-header-resources'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_menu_link_uaqs-select-menu';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_menu_link_uaqs-select-menu'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_menu_link_uaqs-utility-links';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_menu_link_uaqs-utility-links'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_carousel_item';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_carousel_item'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_event';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_event'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_flexible_page';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_flexible_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_major';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_major'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_news';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_news'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_page';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_page'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_person';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_person'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_program';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_program'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_pub';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_pub'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_uaqs_unit';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_uaqs_unit'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'xmlsitemap_settings_node_webform';
  $strongarm->value = array(
    'status' => '1',
    'priority' => '0.5',
  );
  $export['xmlsitemap_settings_node_webform'] = $strongarm;

  return $export;
}
