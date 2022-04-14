# UAQS Navigation Feature Module - Global Footer Menu Beans

Provides an editable footer menu system.

## Features

- Adds a number of menus and menu links.
- Configures a number of menu beans and places them in their respective footer
  regions.

#### Menus

Imports four menus into the drupal menu system.

| Menu Name                       | Edit Page                                                     |
|---------------------------------|---------------------------------------------------------------|
| Footer links -- Information For | /admin/structure/menu/manage/uaqs-footer-information-for/edit |
| Footer links -- Main            | /admin/structure/menu/manage/uaqs-footer-main/edit            |
| Footer links -- Resources       | /admin/structure/menu/manage/uaqs-footer-resources/edit       |
| Footer links -- Topics          | /admin/structure/menu/manage/uaqs-footer-topics/edit          |

#### Menu Beans

Imports and places four menu beans.

| Bean Label                               | Bean Title      | Edit Page                                    |
|------------------------------------------|-----------------|----------------------------------------------|
| UAQS Footer Links Bean - Main            | None            | /block/uaqs-footer-links-bean---main/edit    |
| UAQS Footer Links Bean - Information For | Information for | /block/uaqs-footer-links-bean---informa/edit |
| UAQS Footer Links Bean - Resources       | Resources       | /block/uaqs-footer-links-bean---resourc/edit |
| UAQS Footer Links Bean - Topics          | Topics          | /block/uaqs-footer-links-bean---topics/edit  |

## Packaged Dependencies

When the UAQS Navigation  module is used as part of a Drupal distribution (such as [UA
Quickstart](https://bitbucket.org/ua_drupal/(ua_quickstart)), the following
dependencies will be automatically packaged with the distribution.

### Drupal Contrib Modules

- [Menu Bean](https://www.drupal.org/project/menu_bean)
- [xAutoload](https://www.drupal.org/project/xautoload)

## Migration Dependencies
In order to import the menus and menu beans you will need to enable [UAQS Core](https://bitbucket.org/ua_drupal/uaqs_core) for it's Migration Classes.
This also means that you need the following modules to import.

- [Migrate](https://www.drupal.org/project/migrate)
- [UAQS Core](https://bitbucket.org/ua_drupal/uaqs_core)

## Best if used with UA Zen or a subtheme
- [UA Zen](https://bitbucket.org/ua_drupal/ua_zen)