# UAQS Person #

## Overview ##
The UA QuickStart component that describes the contact information and brief biography of a person. This repository contains a module made with [Features](https://www.drupal.org/project/features) that provides a UAQS Person content type and a simple view display for a profile directory.

## Requirements ##
- In order to use this feature, you must first download and enable the [Features](https://www.drupal.org/project/features) module.
- Place the feature from this repository into your site's module folder and enable it as you would any other module.
- Dependencies:
  - Drupal Core modules
    - Image
    - Text
  - Contributed modules
    - [Automatic Node Titles](https://www.drupal.org/project/auto_nodetitle)
    - [Email](https://www.drupal.org/project/email) used for the email field
    - [Entity API](https://www.drupal.org/project/entity)
       - Entity Token (part of Entity API)
    - [Field Group](https://www.drupal.org/project/field_group) used to group profile information for layout reasons
    - [Token](https://www.drupal.org/project/token)
    - [Views](https://www.drupal.org/project/views)

Handy Drush dl/en command:

```
#!

drush en auto_nodetitle email entity entity_token field_group token views views_ui
```
## Automatically Generated Titles ##

### Why: ###
Drupal does not allow you to simply not fill in a node's title-it's necessary, but in a person content type it doesn't make much sense to have it. The Automatic Nodetitles module makes it possible to hide a node's title and populate it with the first and last name fields. Instead of having a content manager put in the person's full name (in the title field) and then redundantly fill in the first and last name, they only have to put in the person's first and last name. This also makes it easier for developers to make views of people which can be sorted by last or first name, or make URLs based on part of a name (e.g. mysite.com/people/macaulay).

### Tokens: ###
Entity Tokens is necessary because it provides tokens for generating the full name field. These tokens (with dashes, not underscores) translate apostrophes or any other type of special character (e.g. generates Taters O'Brian instead of Taters O&#039;Brian).

## Views ##

### Structure ###
The views included are modeled after a wireframe mockup provided by Student Affairs Marketing and the Eller College of Management person directory ( https://www.eller.arizona.edu/directory)
Included fields:

- Photo (124px x 124px)
- Full name
- Job title(s)
- Email
- Phone number(s)

Both views are pages. The grid option is located at the alias "/people" and the list option is at the alias "/people-list" please choose the desired view and disable the other. Change the aliases as you wish.

#### Grid Style View: ####
![people-grid.png](https://bitbucket.org/repo/qeEk4j/images/926911236-people-grid.png)

#### List Style View: ####
![people-list.png](https://bitbucket.org/repo/qeEk4j/images/2185589448-people-list.png)

### Styling ###
The view display for the persons content type has classes added to it through the Views UI to facilitate styling.

Styling classes are as follows:

- **Grid View class:** *uaqs-people-grid* (the word "grid" is used because this display will show persons 3-across on large screens, 2-across on medium screens and 1-across on smallest screens)
- **List View class:** *uaqs-people-list* (the word "list" is used because this display is stacked in rows)
- **Row class:** *uaqs-people-row* and *row* ("row" class is added for bootstrap layout purposes)
- **Field Classes:**
    - Photo  *uaqs-person-photo*
    - Full name  *uaqs-person-name*
    - Job title(s)  *uaqs-person-job-titles*
    - Email  *uaqs-person-email*
    - Phone number(s)  *uaqs-person-phone*
- **Note about the list view fields:** The list view has fields but all fields except image are excluded from display and put in global text fields for layout purposes. The list has three columns for its layout and corresponding classes for column layout:
    - Photo  *uaqs-person-photo col-sm-3*
    - Name and job titles  *uaqs-person-col col-sm-5*
    - Email and phone numbers  *uaqs-person-col col-sm-4*