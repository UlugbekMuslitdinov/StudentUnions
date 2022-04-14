# UAQS D8cache Enhancements

## What this module does

Out of the box, the [Drupal 8 Cache Backport](https://www.drupal.org/project/d8cache) module for Drupal 7 (D8cache) adds cache tag support for entities, menus, blocks and search as well as basic support for views.  These cache tags can be used by platform-specific modules (e.g. [Pantheon Advanced Page Cache](https://www.drupal.org/project/pantheon_advanced_page_cache)) to automatically clear relevant objects from an edge cache (e.g. Varnish, CDN) whenever site content is updated.

D8cache works by attaching cache tags to content, users, entities, taxonomy terms etc, using Drupal hooks to listen for a variety of CRUD operations. The tags look like `node:1234`, `taxonomy_term:5678`, `views:view_name`, etc.

The views support provided by the D8cache module adds entity-specific tags to rendered views that allow cache entries for pages containing views content listings to be invalidated when existing content entities listed in the view are updated but not when content is added, deleted, published or unpublished.  This is because, out of the box, the D8cache module does not know which content type(s) views contain.

This module solves this problem by adding entity-type specific cache tags to all views using a `Content: Type` filter with an `Is one of` operator and causing those tags to be invalidated any time content is added, updated or deleted.  The cache tags added by this module look like `views.node_type.page`, `views.node_type.person`, etc.

This module also improves one other minor D8cache module annoyance which is that, out of the box, the D8cache module adds entity-specific cache tags for *all* entity types, including entities like field collection items and paragraph items.  Because paragraph and field collection entities are normally only ever rendered as part of their parent entity, this module excludes all field collection and paragraph item specific tags from the cache tags emitted by the D8cache module.  This feature can be optionally disabled by setting the `uaqs_d8cache_exclude_field_collection_tags` and `uaqs_d8cache_exclude_paragraph_tags` variables to `FALSE` in a site's `settings.php` file or via drush.

## What this module does not do

This module does not do anything to improve cache invalidation for views that do not use a `Content: Type` filter with an `Is one of` operator.  That means views that use `Conetent: Type` filter with a `Is not one of` or other operator will not be covered by this module.

This module also does not do anything for content listings created using something other than the Views module (e.g., custom modules constructing content listings with Entity Field Query, `db_select()`, or other database calls).

Sites using these types of views or other content listings will need to improve D8cache support for them in a site-specific custom module.

## Dependencies

- [Drupal 8 Cache Backport](https://www.drupal.org/project/d8cache)
- A hosting platform employing an edge cache that supports cache tags (e.g. Pantheon)
- A platform-specific edge cache integration module (e.g. [Pantheon Advanced Page Cache](https://www.drupal.org/project/pantheon_advanced_page_cache)))

## Credits

Most of the code in this module is based on examples taken from an article published by Aaron Wolfe of Capellic:
https://capellic.com/2017/11/28/using-pantheon-advanced-page-cache-in-drupal-7/
