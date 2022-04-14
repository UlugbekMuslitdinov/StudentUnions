# UA CAS Drupal module

Pre-configures the contrib Drupal [CAS module](https://www.drupal.org/project/cas) to work with the University of Arizona's [WebAuth central authentication service](http://uits.arizona.edu/services/webauth?id=1717).

## Requirements

### UA WebAuth
In order to use UA WebAuth with your Drupal website, you must first [request WebAuth website access](http://uits.arizona.edu/forms/webauth-website-access-request).

### Dependencies
This module requires the following modules and libraries to be available.

#### Packaged Dependencies
When this module is used as part of a Drupal distribution (such as [UA Quickstart](https://bitbucket.org/ua_drupal/ua_quickstart)), the following dependencies will be automatically packaged with the distribution via drush make.

- [CAS module](https://www.drupal.org/project/cas)
- [phpCAS Library](https://wiki.jasig.org/display/casc/phpcas)

#### Other Dependencies
When this module is used outside of a Drupal distribution, the packaged dependencies above as well as these additional module dependencies will need to be installed manually.

- [Features](https://www.drupal.org/project/features)
- [Default config](https://www.drupal.org/project/defaultconfig)
- [Strongarm](https://www.drupal.org/project/strongarm)
