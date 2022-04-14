# UAQS Block Types

A library of pre-defined fieldable Drupal blocks, based on the [Bean](https://www.drupal.org/project/bean) module, for use in conjunction with the University of Arizona's UA Zen theme.

For a similar approach at a different university, see the [Stanford Bean Types](https://github.com/SU-SWS/stanford_bean_types).

#### UAQS Card

Built to use ua-bootstrap card styles.

#### UAQS Captioned Image

An image wrapped in an HTML5 `figure` with optional attribution and caption information.

#### UAQS Contact Summary

A list of department or unit contact information fields (postal address, email address, phone number) arranged inline; paragraphs within headers or footers are common places to find this kind of summary.

#### UAQS Illustrated Blurb

A paragraph or two of freestanding text, with a heading, decorative or supplementary image and a “Read more” link.

#### UAQS Illustrated Link

A link associated with a decorative or supplementary image.

#### UAQS Mini Blurb

A paragraph or two of freestanding text, with a heading.

## Requirements ##
- In order to use this feature, you must first download and enable the [Features](https://www.drupal.org/project/features) module.
- Place the feature from this repository into your site's module folder and enable it as you would any other module.

## Packaged Dependencies

When this module is used as part of a Drupal distribution (such as [UA
Quickstart](https://bitbucket.org/ua_drupal/ua_quickstart)), the following
dependencies will be automatically packaged with the distribution.


### Contributed modules
- [Bean](https://drupal.org/project/bean) Makes blocks entities allowing them to be fieldable and displayed using view modes.

## Dependencies not packaged with uaqs_block_types

In order to allow site builders maximum flexibility using shared fields, the following feature
module is required.

### UAQS modules
- [UAQS Fields](https://bitbucket.org/ua_drupal/uaqs_fields) Provides base fields and their required modules for the uaqs_block_types.