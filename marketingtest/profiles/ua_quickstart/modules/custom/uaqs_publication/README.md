# UAQS Publication #

## Overview ##
The UA QuickStart component that describes a publication reference. This repository contains a module made with [Features](https://www.drupal.org/project/features) that provides a UAQS Publication content type.

## Requirements ##
- In order to use this feature, you must first download and enable the [Features](https://www.drupal.org/project/features) module.
- Place the feature from this repository into your site's module folder and enable it as you would any other module.
- Dependencies:
  - Drupal Core modules
    - Image
    - Taxonomy
    - Text
  - Contributed modules
    - [CTools](https://www.drupal.org/project/ctools) used in support of the Strongarm module
    - [Date](https://www.drupal.org/project/date) used for the publications's publishing date
    - [Entity Reference](https://www.drupal.org/project/entityreference) used to reference relating publications
    - [Link](https://www.drupal.org/project/link) used for the more information link
    - [StrongArm](https://www.drupal.org/project/strongarm) used to save content type settings
  - UAQS modules
    - [UAQS Fields](...) Provides base fields for the uaqs_publication content type

Handy Drush dl/en command:

```
#!

drush en ctools date entityreference link strongarm
```
## Views ##
Not yet known if this feature will contain views.