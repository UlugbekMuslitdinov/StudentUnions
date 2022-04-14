# UAQS Program #

## Overview ##
The UA QuickStart component that describes academic programs at the University of Arizona. This repository contains a module made with [Features](https://www.drupal.org/project/features) that provides a UAQS Program content type.

## Requirements ##
- In order to use this feature, you must first download and enable the [Features](https://www.drupal.org/project/features) module.
- Place the feature from this repository into your site's module folder and enable it as you would any other module.
- Dependencies:
  - Drupal Core modules
    - Taxonomy
    - Text
  - Contributed modules
    - [CTools](https://www.drupal.org/project/ctools) used in support of the Strongarm module
    - [StrongArm](https://www.drupal.org/project/strongarm) used to save content type settings
  - UAQS modules
    - [UAQS Fields](...) Provides base fields for the uaqs_program content type
    - [UAQS Unit](...) Provides base fields for the uaqs_program content type and taxonomy

Handy Drush dl/en command:

```
#!

drush en ctools strongarm
```
## Views ##
Not yet known if this feature will contain views.