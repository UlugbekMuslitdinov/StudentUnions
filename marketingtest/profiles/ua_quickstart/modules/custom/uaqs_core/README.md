# UAQS Core Module

Provides core dependencies and features for the [UA Quickstart](https://bitbucket.org/ua_drupal/ua_quickstart) Drupal Distribution (or any other distributions wishing to make use of it).

Provides an optional uncached page. This is intended for use with uptime monitoring tools in environments with edge caching. Monitoring the status of a page that is excluded from the cache lets uptime monitoring tools detect downtime that might otherwise be concealed by caching. This functionality can be enabled by setting the uaqs_monitoring_page_enabled variable to TRUE in a site's settings.php file (or via Drush). By default, this page will be at `/uaqs_monitoring_page`. Optionally, this path can be changed by setting the uaqs_monitoring_page_path variable to your preferred path in the site's settings.php file (or via Drush).


## Packaged Dependencies

When this module is used as part of a Drupal distribution (such as [UA Quickstart](https://bitbucket.org/ua_drupal/ua_quickstart)), the following dependencies will be automatically packaged with the distribution.

### Drupal Contrib Modules

#### Common Contrib Module Dependencies
- [Chaos tool suite (ctools)](https://www.drupal.org/project/ctools)
- [Elements](https://www.drupal.org/project/elements)
- [Entity API](https://www.drupal.org/project/entity)
- [HTML5 tools](https://www.drupal.org/project/html5_tools)
- [jQuery update](https://www.drupal.org/project/jquery_update)
- [Libraries API](https://www.drupal.org/project/libraries)
- [Pathauto](https://www.drupal.org/project/pathauto)
- [Token](https://www.drupal.org/project/token)
- [Views](https://www.drupal.org/project/views)
- [Views Bootstrap](https://www.drupal.org/project/views_bootstrap)

#### Common Contrib Field Modules
- [Automatic entity label](https://www.drupal.org/project/auto_entitylabel)
- [Date](https://www.drupal.org/project/date)
- [Email field](https://www.drupal.org/project/email)
- [Entity reference](https://www.drupal.org/project/entityreference)
- [Field collection](https://www.drupal.org/project/field_collection)
- [Field formatter settings](https://www.drupal.org/project/field_formatter_settings)
- [Field group](https://www.drupal.org/project/field_group)
- [Field group link](https://www.drupal.org/project/field_group_link)
- [Field multiple limit](https://www.drupal.org/project/field_multiple_limit)
- [Image class](https://www.drupal.org/project/image_class)
- [Link](https://www.drupal.org/project/link)
- [Title](https://www.drupal.org/project/title)

#### Features-related Contrib Modules
- [Default config](https://www.drupal.org/project/defaultconfig)
- [Features](https://www.drupal.org/project/features)
- [Migrate](https://www.drupal.org/project/migrate)
- [Strongarm](https://www.drupal.org/project/strongarm)

### Drupal Contrib Themes

- [Zen](https://www.drupal.org/project/zen)
