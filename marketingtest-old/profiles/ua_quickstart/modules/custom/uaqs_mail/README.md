# UAQS Mail Module #

### Authors
* Kevin Cooper, UITS Campus Web Services

## Summary
This module enables a Drupal site to send mail via SMTP server and provides
helper functions to configure AWS SES credentials. If you've configured SES in
us-west-2 (Oregon), all you'll have to do after enabling this module is run the
following drush commands:

`drush vset smtp_username <AWS_IAM_KEY>`

`drush ses-smtp-secret <AWS_IAM_SECRET_KEY>`

## Building
Start at the root of your site's codebase and follow these steps:

1.  Clone this module into your codebase:
    *  `git clone https://bitbucket.org/uitsweb/uaqs_mail.git sites/all/modules/uaqs_mail`
2.  Delete the `.git` directory from the module
    *  `rm -rf sites/all/modules/uaqs_mail/.git`

## Dependencies
This module requires the contrib [SMTP module](https://www.drupal.org/project/smtp)
