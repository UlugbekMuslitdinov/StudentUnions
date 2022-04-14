# UAQS Event #

## Overview ##
The UA QuickStart component for calendar entries and other events. This repository contains a module made with [Features](https://www.drupal.org/project/features) that provides a UAQS Event content type.

## Requirements ##
- In order to use this feature, you must first download and enable the [Features](https://www.drupal.org/project/features) module.
- Place the feature from this repository into your site's module folder and enable it as you would any other module.
- Dependencies:
  - Drupal Core modules
    - File
    - Image
    - List
    - Options
    - Text
  - Contributed modules
    - [Date](https://www.drupal.org/project/date) used for the event date
    - [Email](https://www.drupal.org/project/email) used for the contact email
    - [Field Collection](https://www.drupal.org/project/field_collection) used for the contact persons (includes fields Name, Email, and Phone)
    - [Link](https://www.drupal.org/project/link) used for the location and more information links

  - UAQS modules
    - [UAQS Fields](...) Provides base fields for the uaqs_news content type

Handy Drush dl/en command:

```
#!

drush en date date_all_day date_api date_repeat date_repeat_field email field_collection link
```
## Views ##

There are two views: a block with a list of 6 events and a full calendar view (responsive and not table-based).

**Note about full calendar view:** By default, the full calendar view is paginating by month. If you do not have *at least* the 7.x-2.9-alpha version of the date module, the calendar will show the wrong date format at the top of the page (see https://www.drupal.org/node/2294973 for full details).

### Structure ###

Included fields:

- Event title (block and page)
- Event date (block and page - several different formats used)
- Event summary (page only)

### Styling ###
To facilitate styling, the view displays have classes added to them via the Views UI.

#### Styling classes are as follows: ####

- **Full Calendar class:** *uaqs-event-calendar*
- **Block class:** *uaqs-event-block-list*
- **Row class:** *uaqs-event-row*
- **Field Classes (block):**
    - Date  *uaqs-event-date*
    - Title  *uaqs-event-title*
- **Field Classes (page):**
    - Date  *uaqs-event-date*
    - Title  *uaqs-event-title*
    - Left Global Text group (contains month and day)  *uaqs-event-left-group*
    - Right Global Text group (contains title, time and summary) *uaqs-event-right-group*


### Screenshots ###

![calendar_block_view.png](https://bitbucket.org/repo/B5gRzX/images/2893604340-calendar_block_view.png)

![calendar_view.PNG](https://bitbucket.org/repo/B5gRzX/images/2530656555-calendar_view.PNG)