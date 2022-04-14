
CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Recommended modules
 * Installation
 * Configuration
 * Troubleshooting
 * Maintainers


INTRODUCTION
------------

This project integrates the site with the Google Tag Manager (GTM) application.
GTM allows you to deploy analytics and measurement tag configurations from a
web-based user interface (hosted by Google) instead of requiring administrative
access to your website.

 * For a full description, visit the project page:
   https://www.drupal.org/project/google_tag

 * To submit bug reports and feature suggestions, or to track changes:
   https://www.drupal.org/project/issues/google_tag


REQUIREMENTS
------------

Sign up for GTM and obtain a 'container ID' for your website. Enter the
'container ID' on the settings form for this module (see Configuration).

 * https://tagmanager.google.com/


INSTALLATION
------------

Place the project files in an appropriate modules directory and enable the
module as you would any other contributed module. For further information see:

 * https://www.drupal.org/node/895232


CONFIGURATION
-------------

Users in roles with the 'Administer Google Tag Manager' permission will be able
to manage the settings for this module. Configure permissions as usual at:

 * Administration » People » Permissions
 * admin/people/permissions

From the module settings page, configure the conditions on which the tags are
inserted on a page response. Conditions exist for: page paths, user roles, and
response statuses. See:

 * Administration » Configuration » System » Google Tag Manager
 * admin/config/system/google_tag

The module implements the Variable API, so that settings may be separately
configured by realm, thus enabling support for multiple languages and domains.
If these features are needed, then review the other projects at:

 * https://www.drupal.org/project/variable
 * https://www.drupal.org/project/18n
 * https://www.drupal.org/project/domain_variable

For development purposes, create a GTM environment for your website and enter
the 'environment ID' on the 'Advanced' tab of the settings form.

 * https://tagmanager.google.com/#/admin

For additional data layer management, consider the dataLayer module. It supports
the default name for the data layer. To use a non-default name, apply a patch to
the code from that module module.

 * https://www.drupal.org/project/dataLayer


TROUBLESHOOTING
---------------

If the JavaScript snippets are not present in the HTML output, try the following
steps to debug the situation:

 * Confirm the snippet files exist at public://google_tag/ (on most sites this
   equates to sites/default/files/google_tag/).

   If missing, then recreate the snippet files by clearing all caches (e.g. from
   the command line using drush or from the performance administration page) OR
   by submitting the module settings page. The need to do this may arise if the
   project is deployed from one environment to another (e.g. development to
   production) but the snippet files are not deployed.

 * Enable debug output on the 'Advanced' tab of the settings page to display the
   result of each snippet insertion condition in the message area. Modify the
   insertion conditions as needed.

If you retain the default configuration setting to 'Include the snippet as a
file', then the Google 'verification' bot will report that the site is NOT setup
to use the Tag Manager. This report is a FALSE POSITIVE as the bot only checks
for inline code on the script tag. It does not load the snippet file and inspect
the code therein. Instead of relying on this bot, check whether the GTM snippets
are loaded as a result of the snippet added by this project.


MAINTAINERS
-----------

Current maintainer:

 * Jim Berry (https://www.drupal.org/u/solotandem)
